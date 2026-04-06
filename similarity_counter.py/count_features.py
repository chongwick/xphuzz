#!/usr/bin/env python3
import os
import re
import json
import subprocess

def count_js_features_regex(file_path):
    """Count features in JavaScript using regex patterns (approximate)"""
    with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
        content = f.read()

    # Remove comments to avoid false positives
    content_clean = re.sub(r'//.*', '', content)
    content_clean = re.sub(r'/\*.*?\*/', '', content_clean, flags=re.DOTALL)

    features = {
        'control': 0,
        'data': 0,
        'object': 0
    }

    # Control features (count occurrences)
    control_patterns = [
        r'\bif\s*\(',  r'\belse\b',  r'\bwhile\s*\(',  r'\bfor\s*\(',
        r'\bswitch\s*\(',  r'\bcase\s+',  r'\bbreak\b',  r'\bcontinue\b',
        r'\breturn\b',  r'\bdo\s*\{',  r'\btry\s*\{',  r'\bcatch\s*\(',
        r'\bfinally\s*\{',  r'\bthrow\b',  r'\?[^:]+:',  # ternary
    ]

    # Data features (count occurrences)
    data_patterns = [
        r'[+\-*/%]=',  # compound assignment
        r'(?<=[^+\-])[+\-](?=[^+\-=])',  # + or - (not ++ or --)
        r'[*/%]',  # multiply, divide, modulo
        r'\+\+',  r'--',  # increment/decrement
        r'===?',  r'!==?',  # equality
        r'[<>]=?',  # comparison
        r'&&',  r'\|\|',  # logical
    ]

    # Object features (count occurrences)
    object_patterns = [
        r'\bclass\s+\w+',  r'\bfunction\s*[\w(]',  r'=>',  # functions/classes
        r'\bnew\s+\w+',  # instantiation
        r'\w+\.\w+\s*\(',  # method calls
        r'\w+\.\w+',  # property access
        r'\w+\s*\(',  # function calls
        r'\[[^\]]+\]',  # array indexing
    ]

    for pattern in control_patterns:
        features['control'] += len(re.findall(pattern, content_clean))

    for pattern in data_patterns:
        features['data'] += len(re.findall(pattern, content_clean))

    for pattern in object_patterns:
        features['object'] += len(re.findall(pattern, content_clean))

    return features

def count_php_ast_features(ast_node):
    """Recursively count features from PHP AST"""
    features = {'control': 0, 'data': 0, 'object': 0}

    if isinstance(ast_node, list):
        for node in ast_node:
            sub = count_php_ast_features(node)
            for k in features:
                features[k] += sub[k]
        return features

    if not isinstance(ast_node, dict):
        return features

    node_type = ast_node.get('nodeType', '')

    # Classify node types
    control_types = [
        'Stmt_If', 'Stmt_Else', 'Stmt_ElseIf', 'Stmt_While', 'Stmt_For',
        'Stmt_Foreach', 'Stmt_Switch', 'Stmt_Case', 'Stmt_Break',
        'Stmt_Continue', 'Stmt_Return', 'Stmt_Do', 'Stmt_TryCatch',
        'Stmt_Catch', 'Stmt_Finally', 'Stmt_Throw', 'Expr_Ternary',
    ]

    data_types = [
        'Expr_BinaryOp_Plus', 'Expr_BinaryOp_Minus', 'Expr_BinaryOp_Mul',
        'Expr_BinaryOp_Div', 'Expr_BinaryOp_Mod', 'Expr_BinaryOp_Pow',
        'Expr_AssignOp', 'Expr_PostInc', 'Expr_PostDec',
        'Expr_PreInc', 'Expr_PreDec', 'Expr_BinaryOp_Equal',
        'Expr_BinaryOp_NotEqual', 'Expr_BinaryOp_Identical',
        'Expr_BinaryOp_NotIdentical', 'Expr_BinaryOp_Greater',
        'Expr_BinaryOp_GreaterOrEqual', 'Expr_BinaryOp_Smaller',
        'Expr_BinaryOp_SmallerOrEqual', 'Expr_BinaryOp_BooleanAnd',
        'Expr_BinaryOp_BooleanOr', 'Expr_BooleanNot', 'Expr_Assign',
    ]

    object_types = [
        'Stmt_Class', 'Stmt_Function', 'Expr_New', 'Expr_MethodCall',
        'Expr_PropertyFetch', 'Expr_StaticCall', 'Expr_StaticPropertyFetch',
        'Stmt_ClassMethod', 'Expr_FuncCall', 'Expr_Variable',
        'Expr_ArrayDimFetch', 'Expr_Array', 'Expr_Closure',
    ]

    # Count this node
    if any(node_type.startswith(t) for t in control_types):
        features['control'] += 1
    elif any(node_type.startswith(t) for t in data_types):
        features['data'] += 1
    elif any(node_type.startswith(t) for t in object_types):
        features['object'] += 1

    # Recurse into children
    for key, value in ast_node.items():
        if key not in ('nodeType', 'attributes'):
            sub = count_php_ast_features(value)
            for k in features:
                features[k] += sub[k]

    return features

def php_2_ast(target_file):
    """Parse PHP file to AST"""
    try:
        command = ['bash', './php_to_ast.sh', target_file]
        child = subprocess.Popen(command, stdout=subprocess.PIPE,
                                stderr=subprocess.PIPE, text=True)
        stdout, stderr = child.communicate(timeout=120)
        child.kill()
        return json.loads(stdout)
    except Exception as e:
        print(f"Error parsing {target_file}: {e}")
        return None

def count_php_features(file_path):
    """Count features in PHP file"""
    ast = php_2_ast(file_path)
    if ast is None:
        return {'control': 0, 'data': 0, 'object': 0}
    return count_php_ast_features(ast)

def calculate_similarity(js_features, php_features):
    """Calculate similarity as percentage of features preserved"""
    # Use a weighted similarity that accounts for:
    # 1. Feature overlap (min/max ratio)
    # 2. Lenient scoring for approximate translations

    total_js = sum(js_features.values())
    if total_js == 0:
        return 0.0

    # Weighted sum across categories
    total_similarity = 0
    total_weight = 0

    for key in ['control', 'data', 'object']:
        js_count = js_features[key]
        php_count = php_features[key]

        if js_count == 0:
            continue

        total_weight += js_count

        if php_count == 0:
            # Lost in translation - contribute partial score
            # (some features might be implicit or optimized out)
            total_similarity += js_count * 0.3
        else:
            # Both present - use min/max ratio with bonus for presence
            ratio = min(js_count, php_count) / max(js_count, php_count)
            # Add a base score for feature category being present
            score = 0.5 + 0.5 * ratio
            total_similarity += js_count * score

    if total_weight == 0:
        return 0.0

    return (total_similarity / total_weight) * 100

def main():
    import sys
    debug = '--debug' in sys.argv

    # Get corpus pairs
    php_files = [f for f in os.listdir("php_corpus") if f.endswith('.php')]
    corpus_pairs = []

    for php_file in php_files:
        js_file = php_file.replace('.php', '.js')
        php_path = os.path.join("php_corpus", php_file)
        js_path = os.path.join("js_corpus", js_file)

        if os.path.exists(js_path):
            corpus_pairs.append((js_path, php_path))

    print(f"Found {len(corpus_pairs)} corpus pairs")
    print("-" * 80)

    total_similarity = 0
    valid_pairs = 0

    for i, (js_path, php_path) in enumerate(corpus_pairs):
        try:
            js_features = count_js_features_regex(js_path)
            php_features = count_php_features(php_path)

            similarity = calculate_similarity(js_features, php_features)
            total_similarity += similarity
            valid_pairs += 1

            if debug and i < 10:
                print(f"\nPair {i}: {os.path.basename(js_path)}")
                print(f"  JS:  {js_features}")
                print(f"  PHP: {php_features}")
                print(f"  Similarity: {similarity:.2f}%")

            if (i + 1) % 50 == 0:
                avg = total_similarity / valid_pairs
                print(f"Processed {i + 1}/{len(corpus_pairs)} pairs... Avg: {avg:.2f}%")

        except Exception as e:
            print(f"Error processing pair {i}: {e}")
            continue

    print("-" * 80)
    print(f"\nResults:")
    print(f"Total pairs analyzed: {valid_pairs}")
    print(f"Average similarity: {total_similarity / valid_pairs:.2f}%")

if __name__ == "__main__":
    main()

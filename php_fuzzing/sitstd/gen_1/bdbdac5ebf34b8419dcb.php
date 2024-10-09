?><?php
$vars["ReflectionMethod"]->setAccessible(true);
$vars["ReflectionMethod"]->invoke($this, array('a', 'b', 'c'));
$vars["ReflectionMethod"]->setModifiers(0x12345678);
$vars["ReflectionMethod"]->setDeclaringClass(new stdClass());
$vars["ReflectionMethod"]->setFileName('non_existent_file.php');
$vars["ReflectionMethod"]->setNamespaceName('non_existent_namespace');
$vars["ReflectionMethod"]->setClassConstants(array('PI' => 3.14, 'E' => 2.718));
$vars["ReflectionMethod"]->setMethods(array('add' => function($a, $b) { return $a + $b; }));
$vars["ReflectionMethod"]->setProperties(array('name' => 'John', 'age' => 30));
$vars["ReflectionMethod"]->setInterfaces(array('interface1', 'interface2'));
$vars["ReflectionMethod"]->setExtends('stdClass');
$vars["ReflectionMethod"]->setTraitNames(array('trait1', 'trait2'));
$vars["ReflectionMethod"]->setStaticProperties(array('static_name' => 'Static','static_age' => 40));
$vars["ReflectionMethod"]->setStaticMethods(array('static_add' => function($a, $b) { return $a + $b; }));

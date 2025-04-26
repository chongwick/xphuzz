#!/bin/bash
#Usage, ./sanitize.sh [target_script] [san_types(0/1)]

script=$1
#san_type=$2 #0 for other, 1 for leak
#php_engine=$3
#options=$4

#OUTPUT=$(timeout -s SIGTERM 120 php run-tests.php -p "$php_engine" "$script" 2>&1)
#OUTPUT=$(timeout -s SIGTERM 120 ./run-tests.php -p "$php_engine" "$script" 2>&1)
#if [[ -z "$options" ]]; then
#        #OUTPUT=$(timeout -s SIGTERM 120 "$php_engine" "$script" 2>&1)
#        OUTPUT=$(timeout -s SIGTERM 120 ./nightly_php/php-src/sapi/cli/php "$script" 2>&1)
#else
#        #OUTPUT=$(timeout -s SIGTERM 120 "$php_engine" "$options" "$script" 2>&1)
#        OUTPUT=$(timeout -s SIGTERM 120 ./nightly_php/php-src/sapi/cli/php "$options" "$script" 2>&1)
#fi
OUTPUT=$(timeout -s SIGTERM 120 ./fuzzbuild/d8 --allow-natives-syntax "$script" 2>&1)
RET=$?
if [ $RET -ne 0 ]; then
       if [ $RET -eq 255 ]; then
               mv "$script" "${script}.tr"
               exit 0
       fi
       if [ $RET -eq 124 ]; then
               mv "$script" "${script}.tr"
               exit 0
       fi
       if [ $RET -eq 153 ]; then
               mv "$script" "${script}.tr"
               exit 0
       fi
       if [ $RET -eq 1 ]; then
               mv "$script" "${script}.tr"
               exit 0
       fi
       if [ $(echo "$OUTPUT" | grep "AddressSanitizer failed to allocate" | wc -l) -gt 0 ]; then
               mv "$script" "${script}.tr"
	       exit 0
       fi
       if [ $(echo "$OUTPUT" | grep "SyntaxError" | wc -l) -gt 0 ]; then
               mv "$script" "${script}.tr"
	       exit 0
       fi
       if [ $(echo "$OUTPUT" | grep "ReferenceError" | wc -l) -gt 0 ]; then
               mv "$script" "${script}.tr"
	       exit 0
       fi
       mv "$script" "${script}.er"
       echo "$OUTPUT" > san.log
elif [ $(echo "$OUTPUT" | grep "runtime error:" | wc -l) -gt 0 ]; then
       mv "$script" "${script}.er"
       echo "$OUTPUT" > san.log
       exit 0
fi

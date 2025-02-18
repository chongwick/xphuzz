#!/bin/bash
#Usage, ./sanitize.sh [target_script] [san_types(0/1)]

script=$1
san_type=$2 #0 for other, 1 for leak
#php_engine=$3
options=$4
if [ $san_type = "0" ]; then
        export USE_ZEND_ALLOC=0
        export ASAN_OPTIONS=detect_leaks=0
fi
#OUTPUT=$(timeout -s SIGTERM 120 php run-tests.php -p "$php_engine" "$script" 2>&1)
#OUTPUT=$(timeout -s SIGTERM 120 ./run-tests.php -p "$php_engine" "$script" 2>&1)
if [[ -z "$options" ]]; then
        #OUTPUT=$(timeout -s SIGTERM 120 "$php_engine" "$script" 2>&1)
        OUTPUT=$(timeout -s SIGTERM 120 ./nightly_php/php-src/sapi/cli/php "$script" 2>&1)
else
        #OUTPUT=$(timeout -s SIGTERM 120 "$php_engine" "$options" "$script" 2>&1)
        OUTPUT=$(timeout -s SIGTERM 120 ./nightly_php/php-src/sapi/cli/php "$options" "$script" 2>&1)
fi
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
       if [ $RET -eq 153 ]; then
               mv "$script" "${script}.tr"
               exit 0
       fi
       if [ $(echo "$OUTPUT" | grep "Allowed memory size of" | wc -l) -gt 0 ]; then
               mv "$script" "${script}.tr"
	       exit 0
       fi
       if [ $(echo "$OUTPUT" | grep "AddressSanitizer failed to allocate" | wc -l) -gt 0 ]; then
               mv "$script" "${script}.tr"
	       exit 0
       fi
       if [ $(echo "$OUTPUT" | grep ": Assertion " | wc -l) -gt 0 ]; then
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

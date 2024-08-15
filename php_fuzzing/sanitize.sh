#!/bin/bash
#Usage, ./sanitize.sh [target_script] [san_types(0/1)]

script=$1
san_type=$2 #0 for leak, 1 for asan, 2 for undefined
if [ $san_type = "0" ]; then
        OUTPUT=$(timeout -s SIGTERM 120 ~/san_php "$script" 2>&1)
elif [ $san_type = "1" ]; then
        export USE_ZEND_ALLOC=0
        export ASAN_OPTIONS=detect_leaks=0
        OUTPUT=$(timeout -s SIGTERM 120 ~/san_php "$script" 2>&1)
elif [ $san_type = "2" ]; then
        OUTPUT=$(timeout -s SIGTERM 120 ~/php_engines/undefined_php "$script" 2>&1)
fi
RET=$?
if [ $RET -ne 0 ]; then
       if [ $RET -eq 255 ]; then
               exit 0
       fi
       if [ $RET -eq 124 ]; then
               exit 0
       fi
       if [ $RET -eq 153 ]; then
               exit 0
       fi
       if [ $RET -eq 153 ]; then
               exit 0
       fi
       if [ $(echo "$OUTPUT" | grep "Allowed memory size of" | wc -l) -gt 0 ]; then
	       exit 0
       fi
       if [ $(echo "$OUTPUT" | grep "AddressSanitizer failed to allocate" | wc -l) -gt 0 ]; then
	       exit 0
       fi
       if [ $(echo "$OUTPUT" | grep ": Assertion " | wc -l) -gt 0 ]; then
	       exit 0
       fi
       mv "$script" "${script}.er"
elif [ $(echo "$OUTPUT" | grep "runtime error:" | wc -l) -gt 0 ]; then
       mv "$script" "${script}.er"
       exit 0
fi

## Directory containing the Python scripts
#SCRIPT_DIR="/autest/php_fuzzing/gen_0"
#
## Iterate over each .py file in the directory
##set -e
#for script in *.php; do
#  echo "Executing $script..."
#  USE_ZEND_ALLOC=0 ~/san_php "$script"
#  RET $?
#  if [ $RET -ne 0 ]; then
#	  if [ $RET -eq 255 ]; then
#		  exit 0
#	  fi
#	  if [ $RET -eq 124 ]; then
#		  exit 0
#	  fi
#	  if [ $RET -eq 153 ]; then
#		  exit 0
#	  fi
#	  if [ $RET -eq 153 ]; then
#		  exit 0
#	  fi
#
#
#	  mv "$script" "${script}.error"
#  fi
#  echo "$script executed."
#done

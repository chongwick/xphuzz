#!/bin/bash
#Usage, ./sanitize.sh [target_script] [detect_leaks(0/1)]

script=$1
detect_leak=$2
export USE_ZEND_ALLOC=0
if [ $detect_leak -ne 1 ]; then
        export ASAN_OPTIONS=detect_leaks=0
fi
OUTPUT=$(timeout -s SIGTERM 120 ~/san_php "$script" 2>&1)
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
       if [ $detect_leak -ne 1 ]; then
               mv "$script" "${script}.pv"
       else
               mv "$script" "${script}.er"
               leaked_bytes=$(echo $OUTPUT | grep -oP 'AddressSanitizer: \K[0-9]+')
               echo $leaked_bytes
       fi
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

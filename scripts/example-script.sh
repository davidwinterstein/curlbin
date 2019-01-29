#!/bin/bash
###############
# DESCRIPTION: this text will be displayed as description on the web page
###############
set -euo pipefail

echo "I am an example script. I can count to 10!"
for (( i=1; i<=10; i++ )); do
	printf " $i"
done
echo -e "\nSee?"

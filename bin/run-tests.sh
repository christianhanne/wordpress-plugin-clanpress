#!/bin/bash

# Check for required binaries.
command -v phpunit >/dev/null 2>&1 || { echo >&2 "phpunit not installed. Aborting."; exit 1; }
command -v phpbrew >/dev/null 2>&1 || { echo >&2 "phpbrew not installed. Aborting."; exit 1; }

# Iterate over all main php versions.
versions=(7.0.2 5.6.17 5.5.31 5.4.45 5.3.29)
for version in ${versions[*]}
do
  echo "Running tests on PHP ${version}..."
  phpbrew use $version
  phpunit
done

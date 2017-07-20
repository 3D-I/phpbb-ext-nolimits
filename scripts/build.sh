#!/bin/bash

tmpdir="/tmp"
rootdir="$(realpath $(dirname $(dirname $0)))"
cd "$rootdir"

rm -rf "$tmpdir/s9e"
mkdir -p "$tmpdir/s9e/nolimits/config"

files="
	LICENSE
	README.md
	composer.json
	config/services.yml
	listener.php
";
for file in $files;
do
	cp "$file" "$tmpdir/s9e/nolimits/$file"
done

cd "$tmpdir"
rm -f "$tmpdir/nolimits.zip"
kzip -r -y "$tmpdir/nolimits.zip" s9e
advzip -z4 "$tmpdir/nolimits.zip"

rm -rf "$tmpdir/s9e"
<?php

/**
 * @Author: Softbery Group
 * @Date:   2020-10-26 01:16:27
 * @Last Modified by:   Softbery Group
 * @Last Modified time: 2020-10-26 02:47:21
 */
$ver = "4.10.20." . rand(0, 9999);
$name = "Softbery&copy;";
$author = "Paweł Tobis";
$license = "BSD-3-Clause";
$filename = 'varsion.xml';
$content = "<?xml version='1.0' encoding='UTF-8' ?>\n
\t<version value='" . $ver . "'/>\n
\t<name value='" . $name . "'/>\n
\t<author value='" . $author . "'/>
\t<license value='" . $license . "'";

// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {

// In our example we're opening $filename in append mode.
	// The file pointer is at the bottom of the file hence
	// that's where $content will go when we fwrite() it.
	if (!$handle = fopen($filename, 'a')) {
		echo "Cannot open file ($filename)";
		exit;
	}

// Write $content to our opened file.
	if (fwrite($handle, $content) === FALSE) {
		echo "Cannot write to file ($filename)";
		exit;
	}

	echo "Success, wrote ($content) to file ($filename)";

	fclose($handle);

} else {
	echo "The file $filename is not writable";
}
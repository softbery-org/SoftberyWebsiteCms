<?php

$gfz = filesize_dir("d:\\starwars.mkv"); // 11,5GB
echo 'Z:', $gfz, PHP_EOL;

$fz = fopen('d:\\test2.mkv', 'wb');
$fp = fopen('d:\\starwars.mkv', 'rb');
echo PHP_EOL;
$a = (float) 0;
while (($l = fread($fp, 65536))) {
	fwrite($fz, $l);
	if (($a += 65536) % 5) {
		echo "\r", '>', $a, ' : ', $gfz;
	}

}

fclose($fp);
fclose($fz);

// test2.mkv' is 11,5GB

function filesize_dir($file) {
	exec('dir ' . $file, $inf);
	$size_raw = $inf[6];
	$size_exp = explode(" ", $size_raw);
	$size_ext = $size_exp[19];
	$size_int = (float) str_replace(chr(255), '', $size_ext);
	return $size_int;
}
?>
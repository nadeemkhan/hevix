<?php

Header("content-type: application/javascript");
header("Content-Encoding: gzip");

$path = __DIR__ . '/application/';
$files = array();

$Directory = new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS);
$Iterator = new RecursiveIteratorIterator($Directory);
foreach ($Iterator as $filename => $object) {
if ($object->getFilename() == 'main.js') continue;
if ($object->getFilename() == '_main.js') continue;
if (strpos($object->getFilename(), "_") === 0) continue;
$files[substr_count($object->getPath(), '/')][] = $filename;
}

$sortedFiles = array();

foreach ($files as $len => $lenfiles) {
$sortedFiles = array_merge($sortedFiles, $lenfiles);
}

$output = "";

foreach ($sortedFiles as $file) {
//$output .= "console.log('$file');\n";
$output .= file_get_contents($file);
$output .= ";\n";
};

echo gzencode($output, 9);
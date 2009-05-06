<?php
/*/
some edits by Till, 2009-05-06

security improved by by TRUI
www.trui.net

Originally posted at www.flashcomguru.com

//*/


//full path to dir with video.
$path = 'C:/.../clips/';


$seekat   = (int) $_GET["position"];
$filename = basename($_GET["file"]);
$ext      = strrchr($filename, '.');
$file     = realpath($path . $filename);
$self     = basename($_SERVER['PHP_SELF']);
$error    = "ERORR: The file does not exist";

if ($self == $file) {
    die($error);
}
if (substr($file, 0, strlen($path)) !== $path) {
    die($error);
}
if (!file_exists($file)) {
    die($error);
}
if ($ext !== '.flv') {
    die($error);
}
if (is_dir($filename)) {
    die($error);
}
if ($seekat != 0) {
    echo 'FLV';
    echo pack('C', 1);
    echo pack('C', 1);
    echo pack('N', 9);
    echo pack('N', 9);
}
if (!($fh = fopen($file, 'rb'))) {
    die($error);
}
header('Content-Type: video/x-flv');
fseek($fh, $seekat);
while (!feof($fh)) {
    echo fread($fh, filesize($file));
}
fclose($fh);
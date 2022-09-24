<?php



$card = $_GET['hex'];
//echo $a = dechex(130);
echo "<br>";
//echo $b = dechex(6074);

$c = $a.$b;
echo "<br>";
//echo $d = hexdec($c);
// 8525754

$d = "0008525754";
$d = $card;
echo "<br>";
 $e = dechex($d);
//8217ba
$e1 = str_split($e);
// print_r($e1);
// echo $e;
// //139614036
$g = $e1[0].$e1[1];
// echo "<br>";
$h = $e1[2].$e1[3].$e1[4].$e1[5];
 $h;
echo hexdec($h);
echo "<br>";

//echo dechex($e);

?>
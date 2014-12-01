<?php

/*$data = array(
array("firstname" => "Mary", "lastname" => "Johnson", "age" => 25),
array("firstname" => "Amanda", "lastname" => "Miller", "age" => 18),
array("firstname" => "James", "lastname" => "Brown", "age" => 31),
array("firstname" => "Patricia", "lastname" => "Williams", "age" => 7),
array("firstname" => "Michael", "lastname" => "Davis", "age" => 43),
array("firstname" => "Sarah", "lastname" => "Miller", "age" => 24),
array("firstname" => "Patrick", "lastname" => "Miller", "age" => 27)
);*/



// file name for download
$filename = $loja . "_" . date('Ymd') . ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel charset=utf-8; ");

$flag = false;
foreach($data as $row)
{
    if(!$flag)
    {
        // display field/column names as first row
        echo implode("\t", array_keys($row)) . "\n";
        $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
}




function cleanData(&$str)
{
    //$str = utf8_encode($str);
    $str = str_replace('á', 'a', $str);
    $str = str_replace('à', 'a', $str);
    $str = str_replace('â', 'a', $str);
    $str = str_replace('ã', 'a', $str);
    $str = str_replace('Á', 'A', $str);
    $str = str_replace('À', 'A', $str);
    $str = str_replace('Â', 'A', $str);
    $str = str_replace('Ã', 'A', $str);
    $str = str_replace('é', 'e', $str);
    $str = str_replace('è', 'e', $str);
    $str = str_replace('ê', 'e', $str);
    $str = str_replace('É', 'E', $str);
    $str = str_replace('È', 'E', $str);
    $str = str_replace('Ê', 'E', $str);
    $str = str_replace('í', 'i', $str);
    $str = str_replace('ì', 'i', $str);
    $str = str_replace('Í', 'I', $str);
    $str = str_replace('Ì', 'I', $str);
    $str = str_replace('ó', 'o', $str);
    $str = str_replace('ò', 'o', $str);
    $str = str_replace('Ò', 'O', $str);
    $str = str_replace('Ó', 'O', $str);
    $str = str_replace('ç', 'c', $str);
    $str = str_replace('Ç', 'C', $str);
    $str = mb_convert_encoding($str,'utf-16','utf-8');
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

exit;
?>
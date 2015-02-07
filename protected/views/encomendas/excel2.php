<?php


// file name for download
$filename = $fornecedor->nome. ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel charset=utf-8; ");

$fullArray = array();
$array1 = array();
$array1[0] = "Artigo";
$array1[1] = "Unidade";
$count = 2;
foreach($rows1 as $r1 )
{
    $array1[$count] = "" . $r1['ano']."-".$r1['mes']." SOMA";
    $count++;
    $array1[$count] = "" . $r1['ano']."-".$r1['mes']." MEDIA";
    $count++;
}
array_push($fullArray,$array1);
foreach($rows0 as $r0 )
{
    $array2 = array();
    $array2[0] = $r0["artigo"];
    $array2[1] = $r0["unidade"];
    $count2 = 2;
    foreach($rows1 as $r1 )
    {
        $avg = 0;
        $soma = 0;
        foreach($rows2 as $r2)
        {
            if($r1["ano"] == $r2["ano"] && $r1["mes"] == $r2["mes"] && $r0["id"] == $r2["artigo"])
            {
                $avg = number_format((float)$r2['AVG'],2,",","");
                $soma = number_format((float)$r2['Qt'],2,",","");
                break;
            }
        }
        $array2[$count2] = $soma;
        $count2++;
        $array2[$count2] = $avg;
        $count2++;
    }


    array_push($fullArray,$array2);
}


$flag = false;
foreach($fullArray as $row)
{
    if(!$flag)
    {
        // display field/column names as first row
        //echo implode("\t", array_keys($row)) . "\n";
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
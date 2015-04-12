<?php

require_once("table2arr.php");
require_once("./DbClass.php");

//http://www.bangladeshpost.gov.bd/PostCodeList.asp?DivID=3
$content = file_get_contents('index.php');
$g = new table2arr($content);
$cnt = $g->tablecount;
$index = 0;
$db = new DbClass();
//for($i=0;$i<$cnt;$i++)
//{
$g->getcells(0);
//print_r($g->cells);
//echo $i;
foreach ($g->cells as $cell):

    $db->insertThis($cell);
//    break;
endforeach;

        echo '<h1>Data Entry successfull: total rows: </h1>'.$db->count;

//}
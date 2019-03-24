<?php
function bulan_to_angka($month)
{

$val="";

if($month == 'jan')
{
$val = "01";
}else
if($month == 'feb')
{
$val = "02";
 
}else
if($month == 'mar')
{
$val = "03";
 
}else
if($month == 'apr')
{
$val = "04";
 
}else
if($month == 'may')
{
$val = "05";
 
}else
if($month == 'jun')
{
$val = "06";
}else
if($month == 'jul')
{
$val = "07";
}else
if($month == 'aug')
{
$val = "08";
}else
if($month == 'sep')
{
$val = "09";
}else
if($month == 'oct')
{
$val = "10";
}else
if($month == 'nov')
{
$val = "11";
}else
if($month == 'dec')
{
$val = "12";
}
return $val;
}
//echo bulan_to_angka("sep");
?>
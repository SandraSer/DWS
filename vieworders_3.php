<?php
require('header.inc');
?>

<?php

  // ������� �������� ����� ����������
  $DOCUMENT_ROOT = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];
?>

<html>
<head>
  <title>������������ �� ���� - ������ ��������</title>
</head>
<body>
<h1>������������ ������ � 2 �� ���� ���������� � ������������� ������ ����������� ��������� ������</h1>
<h2>������������ �� ����</h2>
<h3>������ ��������</h3>

<?php
mb_internal_encoding("UTF-8");
//������������ � ���� ������
$hostname="localhost";
$user="root";
$password="root";
$db="lab3";

if(!$link = mysql_connect($hostname, $user, $password))
{
echo "<br> �� ���� ����������� � �������� ���� ������ <br>";
exit();
}
echo "<br> C����������� � �������� ���� ������ ������ ������� <br>";

if (!mysql_select_db($db, $link))
{ 
echo "<br> �� ���� ������� ���� ������<br>";
exit();
}
else
{
echo "<br> ����� ���� ������ ������ ������� <br>";
}

$query_1="select zakaz.id, zakaz.fio, zakaz.adress, zakaz.data, tovar.id, tovar.tiregty, tovar.oilgty, tovar.sparkgty, tovar.ballbearing FROM zakaz, tovar where  zakaz.id=tovar.id order by zakaz.data";
$result_1=mysql_query ($query_1);
?>

<table border=1 color=black width=100% height=100%>

<tr>
<td><b>�</b></td><td><b>���</b></td><td><b>�����</b></td><td><b>���� ������</b></td><td><b>��������</b></td><td><b>�����</b></td><td><b>�����</b></td><td><b>�������</b></td>
<?

while ($row_1=mysql_fetch_array ($result_1)) {
$id=$row_1["id"];
$fio=$row_1["fio"];
$fio = mb_convert_encoding($fio, 'cp1251');
$adress=$row_1["adress"];
$adress = mb_convert_encoding($adress, 'cp1251');
$data=$row_1["data"];
$tireqty=$row_1["tiregty"];
$oilqty=$row_1["oilgty"];
$sparkqty=$row_1["sparkgty"];
$ballbearing=$row_1["ballbearing"];

?><tr>
<td> <? echo $id ?> </td><td> <? echo $fio ?> </td><td> <? echo $adress ?> </td><td> <? echo $data ?> </td><td> <? echo $tireqty ?> </td><td> <? echo $oilqty ?> </td><td> <? echo $sparkqty ?> </td><td> <? echo $ballbearing ?> </td>
</tr>

<?
}
?> </table> <?
?>
</body>
</html>
<?php
require('header.inc');
?>

<?php
  mb_internal_encoding("UTF-8");
  // ������� �������� ����� ����������
  $tireqty = $_POST['tireqty'];
  $oilqty = $_POST['oilqty'];
  $sparkqty = $_POST['sparkqty'];
  $address = $_POST['address'];
  $fio = $_POST['fio'];
  $ballbearing = $_POST['ballbearing'];
  $DOCUMENT_ROOT = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];

//������������ � ���� ������
$hostname="localhost";
$user="root";
$password="";
$db="lab3";

if(!$link = mysql_pconnect($hostname, $user, $password))
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
?>

<html>
<head>
  <title>������������ �� ���� - ���������� ������</title>
</head>

<body>
<h1>������������ ������ � 3 �� ���� ���������� � ������������� ������ ����������� ����� - MySQL</h1>
<h2>������������ �� ����</h2>
<h3>���������� ������</h3>

<?php 

  $totalqty = 0;
  $totalqty += $tireqty;
  $totalqty += $oilqty;
  $totalqty += $sparkqty;
  $totalqty += $ballbearing;
  $totalamount = 0.00;

  define('TIREPRICE', 100);
  define('OILPRICE', 10);
  define('SPARKPRICE', 4);
  define('BALLB', 25);

  $date = date('H:i, jS F');

  echo '<p>����� ��������� � ';
  echo $date;
  echo '<br />';
  echo '<p>������ ������ ������:';
  echo '<br />';

  if( $totalqty == 0 )
  {
    echo '�� ������ �� �������� �� ���������� ��������!<br />';
  }
  else
  {
    if ( $tireqty>0 )
      echo $tireqty.' ������������<br />';
    if ( $oilqty>0 )
      echo $oilqty.' ������� � ������<br />';
    if ( $sparkqty>0 )
      echo $sparkqty.' ������ ���������<br />';
	if ( $ballbearing>0 )
      echo $ballbearing.' ������� ����<br />';
  }

  $total = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE + $ballbearing * BALLB; 
  $total=number_format($total, 2, '.', ' ');
  echo '<P>����� �� ������: '.$total.'</p>';
  echo '<P>��� �������: '.$fio.'</p>';
  echo '<P>����� ��������: '.$address.'<br />';
  $outputstring = $date."\t".$tireqty." ������������ \t".$oilqty." �����\t"
                  .$sparkqty." ������ \t".$ballbearing." �������\t\$".$total
                  ."\t ����� �������� ������\t ". $address."\t ��� �������:".$fio." \n";

  // ������� ���� ��� ����������
$date_1=date ( "Y-m-d H:i:s",mktime ());
$address = mb_convert_encoding($address, 'utf-8', 'cp1251');
$fio = mb_convert_encoding($fio, 'utf-8', 'cp1251');
$query="insert into zakaz (fio,adress,data) values ('$fio','$address','$date_1')";
$result=mysql_query ($query);
$query_1="select zakaz.id from zakaz where zakaz.fio='$fio' ";
$result_1=mysql_query ($query_1);

while ($row=mysql_fetch_array ($result_1)) {
$id=$row["id"];
}
$query="insert into tovar (id, tiregty,oilgty,sparkgty, ballbearing) values ('$id','$tireqty','$oilqty','$sparkqty', '$ballbearing')";
$result=mysql_query ($query);
echo '<p>����� ��������.</p>'; 

?>
<a href="vieworders_3.php"> ��������� ��������� ��� ��������� ����� ������� </a>
</body>
</html>

<?php
require('footer.inc');
?>



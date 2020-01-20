<?php
require('header.inc');
?>

<?php
  mb_internal_encoding("UTF-8");
  // Создать короткие имена переменных
  $tireqty = $_POST['tireqty'];
  $oilqty = $_POST['oilqty'];
  $sparkqty = $_POST['sparkqty'];
  $address = $_POST['address'];
  $fio = $_POST['fio'];
  $ballbearing = $_POST['ballbearing'];
  $DOCUMENT_ROOT = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];

//подключаемся к базе данных
$hostname="localhost";
$user="root";
$password="";
$db="lab3";

if(!$link = mysql_pconnect($hostname, $user, $password))
{
echo "<br> Не могу соединиться с сервером базы данных <br>";
exit();
}
echo "<br> Cоедининение с сервером базы данных прошло успешно <br>";

if (!mysql_select_db($db, $link))
{ 
echo "<br> Не могу выбрать базу данных<br>";
exit();
}
else
{
echo "<br> Выбор базы данных прошел успешно <br>";
}
?>

<html>
<head>
  <title>Автозапчасти от Боба - Результаты заказа</title>
</head>

<body>
<h1>Лабораторная работа № 3 по теме сохранение и востановление данных посредством СУРБД - MySQL</h1>
<h2>Автозапчасти от Боба</h2>
<h3>Результаты заказа</h3>

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

  echo '<p>Заказ обработан в ';
  echo $date;
  echo '<br />';
  echo '<p>Список вашего заказа:';
  echo '<br />';

  if( $totalqty == 0 )
  {
    echo 'Вы ничего не заказали на предыдущей странице!<br />';
  }
  else
  {
    if ( $tireqty>0 )
      echo $tireqty.' автопокрышек<br />';
    if ( $oilqty>0 )
      echo $oilqty.' бутылок с маслом<br />';
    if ( $sparkqty>0 )
      echo $sparkqty.' свечей зажигания<br />';
	if ( $ballbearing>0 )
      echo $ballbearing.' шаровых опор<br />';
  }

  $total = $tireqty * TIREPRICE + $oilqty * OILPRICE + $sparkqty * SPARKPRICE + $ballbearing * BALLB; 
  $total=number_format($total, 2, '.', ' ');
  echo '<P>Итого по заказу: '.$total.'</p>';
  echo '<P>ФИО клиента: '.$fio.'</p>';
  echo '<P>Адрес доставки: '.$address.'<br />';
  $outputstring = $date."\t".$tireqty." автопокрышек \t".$oilqty." масла\t"
                  .$sparkqty." свечей \t".$ballbearing." шаровых\t\$".$total
                  ."\t Адрес доставки товара\t ". $address."\t ФИО клиента:".$fio." \n";

  // Открыть файл для добавления
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
echo '<p>Заказ сохранен.</p>'; 

?>
<a href="vieworders_3.php"> Интерфейс персонала для просмотра файла заказов </a>
</body>
</html>

<?php
require('footer.inc');
?>



<?php

// ������� �������� ����� ����������
  $tireqty = $_POST['tireqty'];
  $oilqty = $_POST['oilqty'];
  $sparkqty = $_POST['sparkqty'];
  $ballbearing = $_POST['ballbearing'];
  $address = $_POST['address'];
  $fio = $_POST['fio'];
  $DOCUMENT_ROOT = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];

//echo "$tireqty";
//echo "$oilqty";
  require ('page_5.inc');
  class OrderformPage extends Page
  {

    var $row2buttons = array( 'Re-engineering' => 'reengineering.php',
                              'Standards Compliance' => 'standards.php',
                              'Buzzword Compliance' => 'buzzword.php', 
                              'Mission Statements' => 'mission.php'
                            );
// var $tireqty ;
// var $oilqty ;
// var $sparkqty ;
// var $address ;

      function Display_1($tireqty)
    {
    //$this->tireqty=$tireqty ;
      //echo $this->tireqty;

        echo $tireqty; }
   

    function Display($tireqty, $oilqty, $sparkqty, $ballbearing, $address, $DOCUMENT_ROOT, $fio)
    {
      echo "<html>\n<head>\n";
      $this -> DisplayTitle();
      $this -> DisplayKeywords();
      $this -> DisplayStyles();
      echo "</head>\n<body>\n";
      $this -> DisplayHeader();
      $this -> DisplayMenu($this->buttons);
      $this -> DisplayMenu($this->row2buttons);
?> <table width=100% height=100% border=1><tr><td class=cont > <? echo $this->zakaz($tireqty, $oilqty, $sparkqty, $ballbearing, $address, $DOCUMENT_ROOT, $fio); ?> </td></table> <?

      $this -> DisplayFooter();
      //echo "</body>\n</html>\n";
    }

function zakaz($tireqty, $oilqty, $sparkqty, $ballbearing, $address, $DOCUMENT_ROOT, $fio)
{
 //<?php

//������������ � ���� ������

$hostname="localhost";

$user="root";

$password="root";

$db="lab3";

if(!$link = mysql_connect($hostname, $user, $password))
{
//echo "<br> �� ���� ����������� � �������� ���� ������ <br>";
exit();
}
//echo "<br> C����������� � �������� ���� ������ ������ ������� <br>";
if (!mysql_select_db($db, $link))
{ 
//echo "<br> �� ���� ������� ���� ������<br>";
exit();
}
else
{
//echo "<br> ����� ���� ������ ������ ������� <br>";
}
?>

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
                  .$sparkqty." ������\t\$".$total
                  ."\t ����� �������� ������\t ". $address."\t ��� �������:".$fio." \n";

  // ������� ���� ��� ����������
$date_1=date ( "Y-m-d H:i:s",mktime ());
$address = mb_convert_encoding($address, 'utf-8', 'cp1251');
$fio = mb_convert_encoding($fio, 'utf-8', 'cp1251');
$query="insert into zakaz (fio,adress,data) values ('$fio','$address','$date_1')";
$result=mysql_query ($query);
$query_1="select zakaz.id  from zakaz where  zakaz.fio='$fio' ";
$result_1=mysql_query ($query_1);
while ($row=mysql_fetch_array ($result_1)) {
$id=$row["id"];
}
$query="insert into tovar (id, tiregty,oilgty,sparkgty, ballbearing) values ('$id','$tireqty','$oilqty','$sparkqty', '$ballbearing')";
$result=mysql_query ($query);
echo '<p>����� ��������.</p>'; 
?>

<a href="vieworders_5.php"> ��������� ��������� ��� ��������� ����� ������� </a> <?}}

$services = new OrderformPage();
$content ='cddc';
$services -> SetContent($content);
$services -> SetTitle('������������ ������ �� ����: ��� �� ���');
$services -> Setnazvanie('������������ ������ �� ����� ���������� �������� ���������� � ����� ���������� ����������� PHP � MySQL <br> ��������� ������ ���-171: ����������� ���������� ��������� <br> ��������: �.�.�. ���. ������� �.�.');
//$services -> Display_1($tireqty);
 $services -> Display($tireqty, $oilqty, $sparkqty, $ballbearing, $address, $DOCUMENT_ROOT, $fio);
// $services -> zakaz($tireqty, $oilqty, $sparkqty, $address, $DOCUMENT_ROOT, $fio);

?>
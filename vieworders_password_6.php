<?session_start ();

//echo session_is_registered('pass'); 

//echo session_is_registered('login'); 

//echo $_SESSION ['pass']; 
//echo $_SESSION ['login'];

require ('page_6.inc');

  class OrderformPage extends Page
  {
    var $row2buttons = array( 'Re-engineering' => 'reengineering.php',
                              'Standards Compliance' => 'standards.php',
                              'Buzzword Compliance' => 'buzzword.php', 
                              'Mission Statements' => 'mission.php'
                            );

    function Display()
    {
      echo "<html>\n<head>\n";
      $this -> DisplayTitle();
      $this -> DisplayKeywords();
      $this -> DisplayStyles();
      echo "</head>\n<body>\n";
      $this -> DisplayHeader();
      $this -> DisplayMenu($this->buttons);
      $this -> DisplayMenu($this->row2buttons);
?> <table width=100% height=100% border=1><tr><td class=cont > <? echo $this->proverka($nick, $passwd); ?> </td></table> <?

//      echo $this->content;
      $this -> DisplayFooter();
      echo "</body>\n</html>\n";

    }

function Display_1()
    { ?> <table width=100% height=100% border=1><tr><td class=cont > <? echo $this->content; ?> </td></table> <? 
    }

function proverka()
{
if (isset($_SESSION ['pass']) && isset($_SESSION ['login'])) { 
echo $this->spisok();
}else{
$services = new OrderformPage();
$content ='
<form action="vieworders_password_6_2.php" name="reply" method="POST">
<table width=60% align=center >
<tr><td><b>�����:</b><td><input type="text" name="nick" size=20>
<tr><td><b>������:</b><td><input type="password" name="passwd" size=20>
<tr><td colspan=2 align=center>&nbsp;<br><input type="submit" value="Submit"></table> </form>
';
$services -> SetContent($content);
echo $this->display_1();
}
    }

function spisok ()
{
  // ������� �������� ����� ����������

  $DOCUMENT_ROOT = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];

//������������ � ���� ������

$hostname="localhost";

$user="root";
$password="root";
$db="lab3";

$link = mysqli_connect($hostname, $user, $password, $db);

if(!$link)
{
//echo "<br> �� ���� ����������� � �������� ���� ������ <br>";
exit();
}

//echo "<br> C����������� � �������� ���� ������ ������ ������� <br>";


$query_1="select zakaz.id, zakaz.fio, zakaz.adress, zakaz.data, tovar.id, tovar.tiregty, tovar.oilgty, tovar.sparkgty FROM zakaz, tovar where  zakaz.id=tovar.id order by zakaz.data";

$result_1 = mysqli_query($link, $query_1);
?>

<table border=1 color=black width=100% height=100%>

<tr>

<td><b>�</b></td><td><b>���</b></td><td><b>�����</b></td><td><b>���� ������</b></td><td><b>��������</b></td><td><b>�����</b></td><td><b>�����</b></td>

<?

while ($row_1=mysqli_fetch_array ($result_1)) {

$id=$row_1["id"];
$fio=$row_1["fio"];
$fio = mb_convert_encoding($fio, 'cp1251', 'utf-8');
$adress=$row_1["adress"];
$adress = mb_convert_encoding($adress, 'cp1251', 'utf-8');
$data=$row_1["data"];

$tireqty=$row_1["tiregty"];

$oilqty=$row_1["oilgty"];

$sparkqty=$row_1["sparkgty"];

?><tr>

<td> <? echo $id ?> </td><td> <? echo $fio ?> </td><td> <? echo $adress ?> </td><td> <? echo $data ?> </td><td> <? echo $tireqty ?> </td><td> <? echo $oilqty ?> </td><td> <? echo $sparkqty ?> </td>

</tr>
<?
}

?> </table> <? 

}}$services = new OrderformPage();

  $content ='
<form action="vieworders_password_6_2.php" name="reply" method="POST">
<table width=60% align=center >
<tr><td><b>�����:</b><td><input type="text" name="nick" size=20>
<tr><td><b>������:</b><td><input type="password" name="passwd" size=20>
<tr><td colspan=2 align=center>&nbsp;<br><input type="submit" value="Submit"></table> </form>
';

$services -> SetContent($content);

$services -> SetTitle('������������ ������ �� ����: ��� �� ���');

$services -> Setnazvanie('������������ ������ �� ����� ���������� �������� ���������� � ����� ���������� ����������� PHP � MySQL <br> ��������� ������ ���-171: ����������� ���������� ��������� <br> ��������: �.�.�. ���. ������� �.�.');

$services -> Display();


?>
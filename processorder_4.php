<?php

require('header.inc');

?>

<?php

  // ������� �������� ����� ����������
  $tireqty = $HTTP_POST_VARS['tireqty'];
  $oilqty = $HTTP_POST_VARS['oilqty'];
  $sparkqty = $HTTP_POST_VARS['sparkqty'];
  $address = $HTTP_POST_VARS['address'];
  $DOCUMENT_ROOT = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];

?>

<html>
<head>
  <title>������������ �� ���� - ���������� ������</title>
</head>

<body>

<h1>������������ ������ � 4 �� ���� ���������� � ������������� ������ ����������� ������������� �������� � ��������� ������</h1>

<h2>������������ �� ����</h2>

<h3>���������� ������</h3>

<?php 

  // ������� �������� ����� ����������
  $tireqty = $_POST['tireqty'];
  $oilqty = $_POST['oilqty'];
  $sparkqty = $_POST['sparkqty'];
  $address = $_POST['address'];
  $fio = $_POST['fio'];
  $ballbearing = $_POST['ballbearing'];
  $DOCUMENT_ROOT = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];

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
$products=array("$date", "$tireqty", "$oilqty", "$sparkqty", "$ballbearing","$address", "$fio","$total");

//echo "$products[0] <br>";
//echo "$products[1] <br>";
//echo "$products[2] <br>";
//echo "$products[3] <br>";
//echo "$products[4] <br>";
//echo "$products[5] <br>";
//echo "$products[6] <br>";

  $outputstring = $products[0]."\t".$products[1]." ������������\t".$products[2]." �����\t"

                  .$products[3]." ������\t".$products[4]." �������\t"
				  .$products[5]."\t ����� �������� ������\t". $products[6]."\t ��� �������:\t\$"
                  .$products[7]." \n";

// ������� ���� ��� ����������
  $fp = fopen("orders_4.txt", 'a');

  flock($fp, LOCK_EX); 
  if (!$fp)
  {
    echo '<p><strong>� ��������� ������ ��� ������ �� ����� ���� ���������.  '
         .'����������, ����������� �����.</strong></p></body></html>';
    exit;
  } 
  fwrite($fp, $outputstring);
  flock($fp, LOCK_UN); 
  fclose($fp);
  echo '<p>����� ��������.</p>'; 
?>

<a href="vieworders_4.php"> ��������� ��������� ��� ��������� ����� ������� </a>

</body>

</html>

<?php

require('footer.inc');

?>


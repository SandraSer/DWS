<?php
require('header.inc');
?>

<html>
<head>
  <title>������������ �� ���� - ���������� ������</title>
</head>
<body>
<h1>������������ ������ � 1 �� ���� �������� ������ �� ����� � �������� ��������� � �� ����������� ���������</h1>
<h2>������������ �� ����</h2>
<h3>���������� ������</h3>
<?php
  echo '<p>����� ��������� � ';
  echo date('H:i, jS F');
  echo '</p>';

  //������� �������� ����� ���������� 
  $tireqty = $_POST['tireqty'];
  $oilqty = $_POST['oilqty'];
  $sparkqty = $_POST['sparkqty'];
  $ballbearing = $_POST['ballbearing'];
  $find = $_POST['find'];

  echo '<p>������ ������ ������: </p>';
  echo $tireqty . ' ������������</br>';
  echo $oilqty . ' ������� � ������</br>';
  echo $sparkqty . ' ������ ���������</br>';
  echo $ballbearing . ' ������� ����</br>';
  $totalqty = 0;
  $totalqty = $tireqty + $oilqty + $sparkqty + $ballbearing;
  echo '�������� �������: '.$totalqty.'</br>';
  $totalamount = 0.00;
  define('TIREPRICE',100); 
  define('OILPRICE',10);
  define('SPARKPRICE',4);
  define('BALLB', 25);
  $totalamount =  $tireqty * TIREPRICE 
    + $oilqty * OILPRICE
    + $sparkqty * SPARKPRICE
    + $ballbearing * BALLB;
  echo '�����: $'.number_format($totalamount,3).'</br>'; 
  $taxrate = 0.10;  // ������� ����� � ������ ���������� 10%
  $totalamount = $totalamount * (1 + $taxrate);
  echo '�����, ������� ����� � ������: $'. number_format($totalamount,2).'<br>';
?>
�� ������ ��� �� ����� ���� �������� ��� ������� �����: <? echo $find; ?>
</body>
</html>
<?php
require('footer.inc');
?>


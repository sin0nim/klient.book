<?
// �������� ���������� �������
include("inc/lib.inc");
// �������� ����� SQL-������� - ���������� ����
$nrq = sql_place();

// �������� ����� SQL-������� - �����
$clq = sql_class();

// �������� ����� SQL-������� - ����
$flq = sql_floor();

// �������� ����� SQL-������� - ������ ����������
$perq = sql_period();

//������� ���� ������

include("inc/mysql.inc");
$conn = open_db();

$table = "number";
$order = "order";

$data = $_GET['data'];
$data = ($data == "")? date('Y-m-d'): $data;
$dout = $_GET['dout'];
if (($dout == "")||($dout <= $data))
	$dout = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")+1, date("Y"))); 
$days = getdays($data, $dout);

// ������� ������ ���� ��������� �������
$sql = "SELECT * FROM $table" 
." WHERE (`busy`=0";

if ($nrq != "") {$sql .= " AND ".$nrq;} 

if ($clq != "") {$sql .= " AND ".$clq;} 

if ($flq != "") {$sql .= " AND ".$flq;} 

//if ($perq != "") {$sql .= " AND ".$perq;} 

$sql .= " )";

$q = mysql_query($sql, $conn);
if($q == false) {
  echo "\n***q = false\n";
}
$nroom = mysql_num_rows($q);
if ($nroom > 0) {
	$result = array();
	for ($i=0; $i<$nroom; $i++) { 
		$result = mysql_fetch_assoc($q);
		$id[] = $result['id'];
		$class[] = $result['class'];
		$place[] = $result['place'];
		$room[] = $result['room'];
		$floor[] = $result['floor'];
		$price[] = $result['price'];
	}
}
?>

<html>
<head>
<title>�������������� ����� � ��������� -- ������</title>
<link rel=stylesheet href="css/klient.css" type="text/css">
<meta charset="cp-1251">
</head>
<script src="js/date.js"></script>

<body>

<div class="header" id="hd">
  <? include("inc/header.inc"); ?>
</div>

<div class="left">
  <? include("inc/left.inc"); ?>
</div>

<div class="middle">
<div class="head">
  <center>
    <h2>������� ��������� ������� � ���������</h2>
  	 <h4>
	 �����&nbsp;
      &nbsp;�����&nbsp;
      &nbsp;����&nbsp;&nbsp;
      &nbsp;����&nbsp;&nbsp; 
      &nbsp;����&nbsp;��&nbsp;�����
	 &nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	 </h4>
</center>
</div>
<div class="list" id="main">
<center>
<table>
<? 
  for ($i=0; $i<$nroom; $i++) {
    echo "<tr>\n";
    echo "<td>$room[$i] </td>\n".
	"<td>".( $class[$i]==0 ? "����" : $class[$i] )."</td>\n".
	"<td>$place[$i] </td>\n".
	"<td>$floor[$i] </td>\n".
	"<td>$price[$i] </td>\n".
	"<td><a href=\"order.php?id= $id[$i] &data=$data &dout=$dout &days= $days\" target=_blank>	��������</a></td>\n\n";
    echo "</tr>\n";
  }

@mysql_close();
?>
</table>
</center>
</div>
</div>

<div class="right" id="news">
  <? include("inc/right.inc"); ?>
</div>

<div class="footer" id="ft">
  <? include("inc/footer.inc"); ?>
</div>

</body>
</html>
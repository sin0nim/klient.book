<?
$data = $_GET['data'];
$data = ($data == "")? date('Y-m-d'): $data;

include("../inc/mysql.inc");
$conn = open_db();

$number = "number";
$order = "order";
$klient = "klient";

$in_sql = "SELECT * FROM `hotel`.$order,`hotel`.$number,`hotel`.$klient "
." WHERE (`$order`.`n_nom`=`$number`.`id`"
." AND `$order`.`n_kl`=`$klient`.`id`"
." AND `$order`.`data`='$data')";

//echo "\n***** in_sql = ".$in_sql." *****\n";

$out_sql = "SELECT * FROM `hotel`.$order,`hotel`.$number,`hotel`.$klient "
." WHERE (`$order`.`n_nom`=`$number`.`id`"
." AND `$order`.`n_kl`=`$klient`.`id`"
." AND `$order`.`dout`='$data')";

//echo "\n***** out_sql = ".$out_sql." *****\n";

$qin = mysql_query($in_sql, $conn);
if($qin == false) {

  echo "\n***qin = false\n";
}
if($qin != "")
  $nin = mysql_num_rows($qin);
else
  $nin = 0;
if ($nin > 0) {
//
//echo "\n***** nin = ".$nin." *****\n";
	$result = array();
	for ($i=0; $i<$nin; $i++) { 
		$result = mysql_fetch_assoc($qin);
		$iid[$i] = $result[$order.'.id'];
		$iroom[$i] = $result['room'];
		$iklient[$i] = $result['fam'].' '.$result['nam'].' '.$result['otc'];
		$isum[$i] = $result['sum'];
		$dout[$i] = $result['dout'];
		$price[$i] = $result['price'];
	}
}

$qout = mysql_query($out_sql, $conn);
if($qout == false) {
  echo "\n***qout = false\n";
}
if($qout != "")
  $nout = mysql_num_rows($qout);
else
  $nout = 0;
if ($nout > 0) {
//
//echo "\n***** nout = ".$nout." *****\n";

	$result = array();
	for ($i=0; $i<$nout; $i++) { 
		$result = mysql_fetch_assoc($qout);
		$oid[$i] = $result[$order.'.id'];
		$oroom[$i] = $result['room'];
		$oklient[$i] = $result['fam'].' '.$result['nam'].' '.$result['otc'];
		$osum[$i] = $result['sum'];
		$din[$i] = $result['data'];
		$price[$i] = $result['price'];
	}
}

@mysql_close();
?>

<html>
<head>
<title>Резервирование места в гостинице -- администратор</title>
<link rel=stylesheet href="../css/admin.css" type="text/css">
<meta charset="cp-1251">
</head>
<body>
<div class="adm_table">
<p><h2>Дата:</h2><? echo $data; ?>
<p><center>
    <h2>Прибытие</h2>
</center></p>
<center>
<table>
<tr>
<th>Номер</th>
<th>Фамилия, Имя, Отчество</th>
<th>Дата убытия</th>
<th>Сумма</th>
</tr>
<?
for($i=0; $i<$nin; $i++) {
  echo "<tr>\n";
  echo "<td>".$iroom[$i]."</td>\n";
  echo "<td>".$iklient[$i]."</td>\n";
  echo "<td>".$dout[$i]."</td>\n";
  echo "<td>".$isum[$i]."</td>\n";
  echo "</tr>\n";
}
?>
</table>
</center>

<center>
    <h2>Убытие</h2>
</center>
<center>
<table>
<tr>
<th>Номер</th>
<th>Фамилия, Имя, Отчество</th>
<th>Дата прибытия</th>
<th>Сумма</th>
</tr>
<?
for($i=0; $i<$nout; $i++) {
  echo "<tr>\n";
  echo "<td>".$oroom[$i]."</td>\n";
  echo "<td>".$oklient[$i]."</td>\n";
  echo "<td>".$din[$i]."</td>\n";
  echo "<td>".$osum[$i]."</td>\n";
  echo "</tr>\n";
}
?>
</table>
</center>
</div>

</body>
</html>
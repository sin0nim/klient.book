<?
$fam = $_GET['fam'];
$nam = $_GET['nam'];
$otc = $_GET['otc'];
$pass = $_GET['pass'];
$pasn = $_GET['pasn'];
$pdat = $_GET['pdat'];
$pwho = $_GET['pwho'];
$room = $_GET['room'];
$data = $_GET['data'];
$dout = $_GET['dout'];
$n_id = $_GET['n_id'];
$sum = $_GET['sum'];

include("inc/mysql.inc");
$conn = open_db();

$table = "number";
$order = "order";
$klient = "klient";

$kl_sql = "INSERT INTO `hotel`.`klient` (`id`, `fam`, `nam`, `otc`, `pass`, `pasn`, `pdat`, `pwho`) VALUES (NULL, '$fam', '$nam', '$otc', $pass, $pasn, '$pdat', '$pwho')";

//echo "\n***** kl_sql = ".$kl_sql."*****\n";

$res = mysql_query($kl_sql, $conn);
if ($res == "") {
	// Ошибка
echo "\n*****mysql_query klient failed = ".$res." *****\n";
}

$or_sql = "INSERT INTO `hotel`.`order` (`id`, `n_kl`, `n_nom`, `data`, `dout`, `sum`) VALUES (NULL, (SELECT MAX(`id`) FROM `hotel`.`klient`), '$n_id', '$data', '$dout', '$sum')";

//echo "\n***** or_sql = ".$or_sql."*****\n";
$res = mysql_query($or_sql, $conn);
if ($res == "") {
	// Ошибка
echo "\n*****mysql_query order failed = ".$res." *****\n";
}
//echo "\n*****mysql_query order res = ".$res." *****\n";

$fio_sql = "SELECT * FROM `hotel`.`order` WHERE `id`=(SELECT MAX(`id`) FROM `hotel`.`order`)";
$res = mysql_query($fio_sql, $conn);
if ($res == "") {
	// Ошибка
echo "\n*****mysql_query order failed = ".$res." *****\n";
}

$result = mysql_fetch_assoc($res);
$nord = $result['id'];

@mysql_close();
//
//echo "\n*****".$fio." *****\n";

?>

<html>
<head>
<title>Резервирование места в гостинице -- клиент</title>
<link rel=stylesheet href="css/reg.css" type="text/css">
<meta charset="cp-1251">
</head>
<body>
<h2>Уважаемый(ая) клиент!</h2>
<h3>Для вас забронирован номер в гостинице "Евразия"</h3>
<div class="list">
<table class="reg_table">
<tr>
<th>НОМЕР</th>
<th>С КАКОГО ЧИСЛА</th>
<th>ПО КАКОЕ ЧИСЛО</th>
</tr>
<tr>
<td><? echo $room; ?></td>
<td><? echo $data; ?></td>
<td><? echo $dout; ?></td>
</tr>
</table>
<h3>Номер вашего заказа: <font color=red><?echo $nord ?></font></h3>
</div>
</body>
</html>
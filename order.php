<?
$id = $_GET['id'];
$host = "localhost";
$user = "root";
$pass = "";
$bd = "hotel";
$table = "number";
$conn = @mysql_pconnect($host, $user, $pass) or die("Could not connect to MySQL server!");
@mysql_select_db($bd, $conn) or die("Could not select $bd database!");
// Выбрать номер
$sql = "SELECT * FROM $table WHERE `id`=$id";
$q = mysql_query($sql, $conn);

$result = mysql_fetch_assoc($q);
$id = $result['id'];
$class = $result['class'];
$place = $result['place'];
$room = $result['room'];
$floor = $result['floor'];
$price = $result['price'];
$data = $_GET['data'];
$dout = $_GET['dout'];
$days = $_GET['days'];

//$dtill = date('Y-m-d', mktime(0, 0, 0, date("m",$data), date("d",$data)+$days, date("Y",$data))); 
$sum = $price * $days;

?>

<html>
<head>
<title>Заполнение личных данных -- клиент</title>
<link rel=stylesheet href="css/order.css" type="text/css">
<meta charset="cp-1251">
</head>
<body>
<div class="order">
<center><h2>Резервирование номера в гостинице</h2></center>
<div class="list">
<table class="order_table">

<tr>
<th>НОМЕР</th>
<th>КЛАСС</th>
<th>МЕСТ</th>
<th>ЭТАЖ</th>
<th>Дата заселения</th>
<th>Кол-во дней</th>
<th>Цена за сутки</th>
<th>Общая сумма</th>
</tr>
<tr align=center>
<?
echo "<td>$room</td>\n
<td>$class</td>\n
<td>$place</td>\n
<td>$floor</td>\n
<td>$data</td>\n
<td>$days</td>\n
<td>$price</td>\n
<td>$sum</td>\n
</tr>\n";
?>

</table>
</div>
<div class="klient_data">
<form method=GET action="registrate.php">
<h2>Заполните личные данные</h2>
<p>Фамилия &nbsp;<font color=red><sup>*</sup></font> &nbsp; 
<input type="text" name="fam">
<p>Имя &nbsp;&nbsp;<font color=red><sup>*</sup></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="nam">
<p>Отчество <font color=red><sup>*</sup></font>&nbsp;&nbsp;
<input type="text" name="otc">
<p><b>Паспорт</b><br>
Серия &nbsp;<font color=red><sup>*</sup></font>
<input type="text" name="pass" size=4><br>
Номер &nbsp;<font color=red><sup>*</sup></font>
<input type="text" name="pasn" size=6>
<p><b>Выдан</b><br>
Когда &nbsp;<font color=red><sup>*</sup></font>&nbsp;&nbsp;<input type="text" name="pdat" size=10><br>
Кем &nbsp;<font color=red><sup>*</sup></font>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="pwho" size=40>
<hr>
<font color=red><sup>*</sup>Все поля обязательны для заполнения</font>
<input type="hidden" name="n_id" value=<? echo $id; ?>>
<input type="hidden" name="data" value=<? echo $data; ?>>
<input type="hidden" name="dout" value=<? echo $dout; ?>>
<input type="hidden" name="sum" value=<? echo $sum; ?>>
<input type="hidden" name="room" value=<? echo $room; ?>>


<p><h4>Резервирование номера</h4>
<input type="submit" value="Подтвердить ">
<input type="reset" value="Отменить">
</form>
</div>
</div>

</body>
</html>

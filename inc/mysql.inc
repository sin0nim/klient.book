<?
//Открыть базу данных
function open_db() {
  $host = "localhost";
  $user = "root";
  $pass = "";
  $bd = "hotel";
  $conn = @mysql_pconnect($host, $user, $pass) or die("Could not connect to MySQL server!");
  if($conn == false) {
// Обработка ошибки
  }
  @mysql_select_db($bd, $conn) or die("Could not select hotel database!");
  mysql_query("SET NAMES cp1251");
  return($conn);
}
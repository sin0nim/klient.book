<form action = "index.php" method = "GET">
<p><h4>На сколько мест номер:</h4>
<p><input type=checkbox name="n1" value="1">&nbsp;-&nbsp;Одноместный
<p><input type=checkbox name="n2" value="2">&nbsp;-&nbsp;Двухместный
<p><input type=checkbox name="n3" value="3">&nbsp;-&nbsp;Трёхместный
<p><h4>Класс:</h4>
<p><input type=checkbox name="cl0" value="0">&nbsp;-&nbsp;Люкс
<p><input type=checkbox name="cl1" value="1">&nbsp;-&nbsp;1-й класс
<p><input type=checkbox name="cl2" value="2">&nbsp;-&nbsp;2-й класс
<p><h4>Этаж:</h4>
<p>
<? for($i=1; $i<=4; $i++) 
  echo ("&nbsp;".$i.":&nbsp;<input type=checkbox name=\"fl".(string)$i."\" value=\"".(string)$i."\">&nbsp;&nbsp;\n");
?>
<p><h4>На какой период:</h4>
<p>С &nbsp;&nbsp; <input type="text" id="date" name="pin" onfocus="js/date.js" onchange="chDate()">
<p>По &nbsp;<input type="text" id="date" name="pout" onfocus="js/date.js" onchange="chDate()">
<p><input type=submit name=seek value="Найти">


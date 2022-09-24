<?
function sql_place() {
  $n1 = $_GET['n1'];
  $n2 = $_GET['n2'];
  $n3 = $_GET['n3'];
  $nr = "";
  if($n1 == "" && $n2 == "" && $n3 == "")
    return($nrq);
  $or = "";
  if ($n1 != "") {
    $nr .= "`place`=".$n1;
    $or = " OR ";
  }
  if ($n2 != "") {
    $nr .= $or."`place`=".$n2;
    $or = " OR ";
  }
  if ($n3 != "") {
    $nr .= $or."`place`=".$n3;
  }
  if ($nr != "")
    $nr = "(".$nr.")";

  return ($nr);
}

function sql_class() {
  $cl0 = $_GET['cl0'];
  $cl1 = $_GET['cl1'];
  $cl2 = $_GET['cl2'];
  $or = "";
  if ($cl0 != "") {
    $clq = "`class`=".$cl0;
    $or = " OR ";
  }

  if ($cl1 != "") {
    $clq .= $or."`class`=".$cl1;
    $or = " OR ";
  }
  if ($cl2 != "")
    $clq .= $or."`class`=".$cl2;

  if ($clq != "")
    $clq = "(".$clq.")";

  return ($clq);
}

function sql_floor() {

  $flq = "";
  $flcnt = 0; 
  $fl = array();
  $or = "";
  for($i=1; $i<=4; $i++) {
    $fls = "fl".(string)$i;
    $fl[$i] = $_GET['fl'.(string)$i];

    if ($fl[$i] != "") {
      $flq .= $or."`floor`=".$fl[$i];
      $or = " OR ";
      $flcnt++;
    }
  }
  if ($flcnt == 4)
    return ("");
  if ($flq != "")
    $flq = "(".$flq.")";

  return ($flq);
}

function sql_period() {

  return (date('Y-m-d'));
}

function getdays($pin, $pout) {
  return (1);
}

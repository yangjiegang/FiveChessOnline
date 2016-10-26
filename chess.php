<?php
require_once("database.php");

if (!empty($_POST["choiceColor"])&&$_POST["choiceColor"]==true) {
	$query = mysql_query("select mark from flag order by id DESC limit 0,1");
	$row = mysql_fetch_array($query);
	$flag = $row["mark"];
	if($flag=='b'){
		mysql_query("update flag set mark='w' where id=1");
		echo ("true");
	}else if($flag=='w'){
		mysql_query("update flag set mark='b' where id=1");
		echo ("false");
	}
}

if (!empty($_POST["sendPos"])) {
	$pos = $_POST["pos"];
	if ($_POST["clr"]==1) {
		$back = mysql_query("insert into black(posX,posY) values($pos[0],$pos[1])");
	}else if($_POST["clr"]==-1) {
		$back = mysql_query("insert into white(posX,posY) values($pos[0],$pos[1])");
	}
	var_dump($back, $_POST['clr']);
}

if (!empty($_POST["getPos"])) {
	if ($_POST["color"]==1){
		$pos = mysql_query("select id,posX,posY from white order by id DESC limit 0,1");
	} else if($_POST["color"]==-1) {
		$pos = mysql_query("select id,posX,posY from black order by id DESC limit 0,1");
	}

	$res = mysql_fetch_array($pos);
	echo json_encode($res);
}

if (isset($_POST["backChess"])&&$_POST["backChess"]==true) {

	$isBlack = $_POST["isBlack"];
	if ($isBlack==1) {
		$pos = mysql_query("SELECT posX,posY FROM black order by id DESC LIMIT 0,1");
		$res=mysql_query("DELETE FROM black ORDER BY id LIMIT 1");
	}else if($isBlack==-1) {
		$pos = mysql_query("SELECT posX,posY FROM white order by id DESC LIMIT 0,1");
		$res=mysql_query("DELETE FROM white ORDER BY id LIMIT 1");
	}
	$row=mysql_fetch_array($pos);
	echo json_encode($row);
}

?>
<?php
require "../Class/autoload.php";
use Database\Database;


$db = new Database();
$db->prepare("INSERT INTO tbl_dth (temp,humi,date) VALUES (:temp,:humi,NOW())");
$db->bind(":temp",20);
$db->bind(":humi",31);
$db->execute();

$row = $db->getOne("SELECT * FROM tbl_dth WHERE id=".$db->lastInsertId());
    echo $row->date."<br>";

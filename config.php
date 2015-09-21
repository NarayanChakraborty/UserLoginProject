<?php
$dbhost="localhost";
$dbname="loginproject";
$dbuser="root";
$dbpass=" ";

mysql_connect('localhost','root','') or die('Cannot Connect to The Server');
mysql_select_db('loginproject') or die('cannot select database');
/*
try{
$db=new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){

echo "Connection error".$e->getMessage();

}
*/
?>
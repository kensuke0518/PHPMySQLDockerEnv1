<?php
$dsn = 'mysql:host=db:3306;dbname=';  //dbname=自分で作成したデータベーススペース名（database space name）を入れる
$user = 'root';
$pass = 'secret';

$dbn = new PDO($dsn,$user,$pass);
echo 'データベースに接続しました';
?>
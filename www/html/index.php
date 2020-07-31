<?php
$dsn = 'mysql:host=db:3306;dbname=データベーススペース名';    //dbname=自分で作成したデータベーススペース名（database space name）を入れる
$user = 'root';
$pass = 'secret';

try{
    $dbh = new PDO($dsn,$user,$pass);
    $dbh->query("set names utf8");
    echo 'データベースに接続しました';
    //以下に命令を記述

} catch(PDOException $e){
    echo $e->getMessage();
    die();
}
?>

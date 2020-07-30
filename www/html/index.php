<?php
// phpinfo();

mysqli_connect('db:3306','root','secret');    //rootはID,secretはPASSWORD。docker-compose.ymlのdb:environmentの箇所を参照。
echo 'データベースに接続しました';
?>
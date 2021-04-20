# docker_php_mysql
PHPとMySQLの仮想サーバーを使って開発ができる。  
  
## 1. 使い方
1. Dockerを起動する。
2. ターミナル上で該当のディレクトリに移動する  
3. docker-compose up -dで起動する。  
http://localhost:8080 に移動すると作業ページが開く。  
http://localhost:8888 に移動するとphpmyadminが開く  
`SQLSTATE[HY000] [1049] Unknown database 'データベーススペース名'`と出るが、この解決方法は下で述べる。  
  
## 2. Browser-Syncとの同時利用
1. `npm ci` でpackage.lock.jsonを基にnode_modules内の「browser-sync」をインストール
2. `docker-compose up -d` でnginx、php、mysqlのコンテナを立ち上げる
3. `npm run browsersync` でファイルを監視して、ブラウザを自動更新する。

## 3. データベーススペース名の解決
1. phpmyadminにログインする
2. ユーザー名はroot、ログインパスワードはsecret
3. 上メニューの「データベース」→データベース名欄に作成したいデータベーススペース名を自由に入力。文字コードは「utf8 / utf8_general_ci」？
4. www/html/index.phpを開く。`$dsn = 'mysql:host=db:3306;dbname=データベーススペース名'`の`データベーススペース名`に先ほど自由に入力したデータベーススペース名を入力する。
5. 4が成功したら（ http://localhost:8080/ を更新して確認）`データベースに接続しました`という表記がなされる。


## 注意：MySQLへの接続
PHPファイルであるindex.phpからMySQLへの接続のため、`mysql_connect()`を使用していたが、現在は非推奨とのこと。  
https://sagara.ink/docker_compose-mysqli/  
`Fatal error: Uncaught Error: Call to undefined function mysql_connect() in /var/www/html/index.php:4 Stack trace: #0 {main} thrown in /var/www/html/index.php on line 4`  
上記のエラーが出るため、`mysqli_connect()`を追加する措置を取った。  
  
また、mysqli_connect()の引数に入れるURLについては、phpが動いているnginxのURLではなく、docker-compose.ymlの「php」で記載した`depends_on`の値（ここではdb）と「db」に書かれている`ports`の右側（コンテナにバインドした側？）のポート番号を記載する（`db:3306`）こと。

### 注意
- Browser-Syncでルートディレクトリを設定する必要はない。docker-compose.yml内でルートディレクトリを設定しているから  
https://qiita.com/ma_me/items/802059e8f1fadcb691eb  
https://orfool.com/programing/1505/  
https://www.browsersync.io/docs/command-line#start
- Browser-Syncを起動するとhttp://localhost:3000/ で起動する。package.jsonのnpm scriptsで"browsersync"の項目に`--proxy localhost:8080`と言う風にプロクシを通しているのでこうなる。

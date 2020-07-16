# docker_php_mysql
PHPとMySQLの仮想サーバーを使って開発ができる。  
  
## 使い方
ターミナル上で該当のディレクトリに移動する  
docker-compose up -dで起動する。  
http://localhost:8080 に移動すると作業ページが開く  
http://localhost:8888 に移動するとphpmyadminが開く  
  
## Browser-Syncとの同時利用
1. `npm ci` でpackage.lock.jsonを基にnode_modules内の「browser-sync」をインストール
2. `docker-compose up -d` でnginx、php、mysqlのコンテナを立ち上げる
3. `npm run browsersync` でファイルを監視して、ブラウザを自動更新する。

### 注意
- Browser-Syncでルートディレクトリを設定する必要はない。docker-compose.yml内でルートディレクトリを設定しているから  
https://qiita.com/ma_me/items/802059e8f1fadcb691eb  
https://orfool.com/programing/1505/  
https://www.browsersync.io/docs/command-line#start

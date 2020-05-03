《アプリ名》
リンク集

《バージョン》
3.0

《動作環境》
・サーバ
（PHPの脆弱性対策が十分とはいえませんので、ローカルサーバで使用してください）
・データベース：MySQL
・ブラウザ：Chrome、Firefox
（他のブラウザでの動作確認は、実施しておりません）


《納品物一式》
1）設計書　：下記に記載。
https://docs.google.com/spreadsheets/d/1g-Q1iyC6-47U-fGUwgl12wZMCMTD4sKHMNnxVokKDBE/edit#gid=501582612


《動作確認上の前提事項》
データベース（MySQL）に対し、事前設定が必要になります（phpMyadminにて）。

◎データベースの作成
・データベース名は任意です。
（参考）システムでは「links」という名前で設定しています。そのため、
「links」という名前でデータベースを新規作成した場合、次の「データベース名の設定」作業が不要となります。

◎テーブルの作成
・設計書の「データベース定義」の頁に記載された内容で、テーブル定義を行います。
（レコードの事前登録は、不要です）

・以下の2テーブルを用意します。

1.テーブル名：groups
・リンク先を分類するためのグループ名を登録します。

2.テーブル名；pages 
・リンク先の情報を登録します。

《セットアップおよび初期設定》
1）localhostと直結したフォルダー「htdocs」の配下に、フォルダー「links」を新規作成する。

2）当システムのすべてのファイル（フォルダー「user」一式も含む）を、1）で作成したフォルダー「links」の直下におく。

3）フォルダー「links」配下のフォルダー「user」内のファイル「cst_php.php」をエディタで開き、その記述にしたがって、データベースの情報を使用する環境の情報に変更する。

4）注釈の記述を参考に、各変数の値を、実際に使用するデータベースにあわせて変更する。

5）ファイル「cst_php.php」を上書き保存する。

6）ヘッダ画像をお好みの画像に差し替えたい場合に限り、
「cst_php.php」と同じフォルダー内のファイル「cst_style.css」をエディタで開き、その記述にしたがう。

7）ファイル「cst_style.css」を上書き保存する。


《起動方法》
1）ローカルホストにて、MySQLを起動する。

2）ブラウザにて、以下の文字列を入力し、ENTERキーを押す。
http://localhost/links/ver03.php
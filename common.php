<?php
//// ヴァージョン管理
// 
  global $dateupd,$mainpage,$cpywrt;
  
  $dateupd = "2020年5月3日";  //最終更新日
  $mainpage = "ver03.php";  //最新バージョン
  $cpywrt = 'copywright 2020-2020 Takeyama Yoshito';  // 著作権表示

//// サ二タイズ
function sanitize($before) {
  foreach ($before as $key => $value) {
    $after[$key] = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
  }
  return $after;
}

//// データベースの接続
//
function dbConnect($dbname,$dbhost,$user,$password) {
  $dsn = 'mysql:dbname='.$dbname.';host='.$dbhost.';charset=utf8';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  return $dbh;
}

//// データベースの排他制御（ロック・アンロック）
//
function dbLock($table) {
  global $sql,$stmt,$dbh;

  // lock
  $sql = "LOCK TABLES ".$table." WRITE";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
}

function dbUnlock() {
  global $sql,$stmt,$dbh;

  // unlock
  $sql = "UNLOCK TABLES";
  $stmt = $dbh->prepare($sql);
  $stmt->execute();  
}

//// データベース障害発生時の処理
//
function dberror($e) {
  // 発生した例外の情報をファイルに出力
    $messages = "";
    $messages .= $e->getFile(); //例外の発生したファイル名を取得
    $messages = "  ";
    $messages .= $e->getLine(); //例外の発生した行数を取得
    $messages = "  ";
    $messages .= $e->getCode(); //例外の発生したコードを取得
    $messages = "  ";
    $messages .= $e->getMessage(); //発生した例外についてのメッセージを取得
    error_log($messages, 3, __DIR__ . "/exceptions.log");

    print 'ただいま障害により、大変ご迷惑をお掛けしております。';
    print 'システム管理者に連絡してください。';
    exit();
}

//// イレギュラー時のメッセージ表示処理
//
function chk_back($msg) {
  // 発生した例外の情報をファイルに出力
  print $msg.'<br>';
  print '<form><input class="btnR" type="button" value="前の画面へ戻る" onclick="history.back()"></form>';
}

//// ダンプ表示
function dump($expression){
  echo "<pre>";
  var_dump($expression);
  echo "</pre>";
  exit;
}
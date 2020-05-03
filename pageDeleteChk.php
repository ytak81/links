<?php 
 
  header("Content-type: text/html; charset=utf-8");

  require_once("common.php");
    
  $post = sanitize($_POST);
  $code = $post['code'];

  try {
    require_once("user/cst_php.php");
    $dbh =  dbConnect($dbname,$dbhost,$user,$password);
  
    $sql = "SELECT * FROM pages where code=?";
    $stmt = $dbh->prepare($sql);
    $data = [];
    $data[] = $code;
    $stmt->execute($data);
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    // データベース切断
    $dbh = null;
    
    if ($rec){
      $grp = $rec['grp'];
      $seqingrp = $rec['seqingrp'];
      $url = $rec['url'];
      $dt = $rec['dt'];
      $dd = $rec['dd'];
    } else {
      $err_message = "システムエラー発生：レコード無し";
      chk_back($err_message);
      exit();
    }
  }

  catch (Exception $e) {
    dberror($e);
    exit();
  }
?>  
<!DOCTYPE html>
<html lang="jp">
<head>
	<meta charset="utf-8">
	<title>リンク集</title>
	<meta name="application name" content="myportfolio">
	<meta name="description" content="リンク集">
	<meta name="author" content="Takeyama Yoshito">
	<meta name="generator" content="VSCode">
	<meta name="keywords" content="HTML/CSS,JavaScript,JQuery,JQuery-UI">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- レスポンシブデザインのため、viewpoint使用 -->
  <link rel="stylesheet" type="text/css" href="cascade.css">
</head>
<body>
<header class="headerp">
  <nav>
    <div><form method="post" action="<?php echo($mainpage) ?>">
      <input class="btnS" type="submit" value="メニューへ">
    </form></div>
  </nav>
  <h3>以下のページを削除します。よろしいですか？</h3>
</header>
<main>
<form method="post" action="pageDelete.php">
  <input type="hidden" name="code" value="<?php echo($code) ?>">
  <h3>ＧrpＩＤ:　<?php echo($grp) ?></h3>
  <br>
  <h3>表示順　:　<?php echo($seqingrp) ?></h3>
  <br>
  <h3>ＵＲＬ　:　<?php echo($url) ?></h3>
  <br>
  <h3>名称　　:　<?php echo($dt) ?></h3>
  <br>
  <h3>備考　　:　<?php echo($dd) ?></h3>
  <br><br><br>
  <div style="display:inline-flex">
    <input class="btnL" type="submit" value="はい（削除する）"></form>
    <form method="post" action="pageSelect.php"><input class="btnR" type="submit" value="いいえ（一覧に戻る）"></form>
  </div>
  <br><br>
</main>
</body>
</html>
<?php 
 
  header("Content-type: text/html; charset=utf-8");

  require_once("common.php");
    
  $post = sanitize($_POST);
  $grp = $post['grp'];

  try {
    require_once("user/cst_php.php");
    $dbh =  dbConnect($dbname,$dbhost,$user,$password);
  
    $sql = "SELECT * FROM groups where grp=?";
    $stmt = $dbh->prepare($sql);
    $data = [];
    $data[] = $grp;
    $stmt->execute($data);
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    // データベース切断
    $dbh = null;
    
    if ($rec){
      $nm = $rec['nm'];
      $seq = $rec['seq'];
      $cmnt = $rec['cmnt'];
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
<header class="headerg">
  <nav>
    <div><form method="post" action="<?php echo($mainpage) ?>">
      <input class="btnS" type="submit" value="メニューへ">
    </form></div>
  </nav>
  <h3>以下のグループを削除します。よろしいですか？</h3>
</header>
<main>
<form method="post" action="grpDelete.php">
  <input type="hidden" name="grp" value="<?php echo($grp) ?>">
  <h3>ＩＤ　　:　<?php echo($grp) ?></h3>
  <br>
  <h3>名称　　:　<?php echo($nm) ?></h3>
  <br>
  <h3>表示順　:　<?php echo($seq) ?></h3>
  <br>
  <h3>備考　　:　<?php echo($cmnt) ?></h3>
  <br><br><br>
  <div style="display:inline-flex">
    <input class="btnL" type="submit" value="はい（削除する）"></form>
    <form method="post" action="grpSelect.php"><input class="btnR" type="submit" value="いいえ（一覧に戻る）"></form>
  </div>
  <br><br>
</main>
</body>
</html>
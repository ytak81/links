<?php
 
  header("Content-type: text/html; charset=utf-8");
  
  require_once("common.php");

  $post = sanitize($_POST);

  if (empty($post)) {
    echo "<a href='".$mainpage."'>こちらのページ</a>からどうぞ";
    exit();
  } else {
    //名前入力判定
    if ($post['grp'] === "") {
      $err_message = "システムエラー発生：レコード無し";
      chk_back($err_message);
      exit();
    } else {
      try {
        require_once("user/cst_php.php");
        $dbh =  dbConnect($dbname,$dbhost,$user,$password);
        // レコードを削除
        $sql = "DELETE FROM groups WHERE grp=?";
        $stmt = $dbh->prepare($sql);
        $data = [];
        $data[] = $post['grp'];
        $stmt->execute($data);
        // データベース切断
        $dbh = null;
      }
      catch (Exception $e) {
        dberror($e);
        exit();
      }
    }
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
  <h3>グループを削除しました。</h3>
</header> 
<main>
  <form method="post" action="grpSelect.php">
    <input class="btnR" type="submit" value="グループ一覧へ">
  </form>
</main>
<footer>
  <h6><?php print $cpywrt ?></h6>
</footer>
</body>
</html>
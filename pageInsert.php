<?php
 
  header("Content-type: text/html; charset=utf-8");
  
  require_once("common.php");

  $post = sanitize($_POST);

  if (empty($post)) {
    echo "<a href='".$mainpage."'>こちらのページ</a>からどうぞ";
  } else {
    //名前入力判定
    if (($post['grp'] === "") || ($post['seqingrp'] === "")) {
      echo "入力必須項目の中に、未入力項目があります。";
      exit();        
    } else {
      try {
        require_once("user/cst_php.php");
        $dbh =  dbConnect($dbname,$dbhost,$user,$password);
        // レコードを追加
        $sql = "INSERT INTO pages (grp,seqingrp,url,dt,dd) VALUES (?,?,?,?,?)";
        $stmt = $dbh->prepare($sql);
        $data = [];
        $data[] = $post['grp'];
        $data[] = $post['seqingrp'];        
        $data[] = $post['url'];
        $data[] = $post['dt'];
        $data[] = $post['dd'];
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
<header class="headerp">
  <nav>
      <div><form method="post" action="<?php echo($mainpage) ?>">
        <input class="btnS" type="submit" value="メニューへ">
      </form></div>
  </nav>
  <h3>ぺージを追加しました。</h3>
</header> 
<main>
  <form method="post" action="pageSelect.php">
    <input class="btnR" type="submit" value="ぺージ一覧へ">
  </form>
</main>
<footer>
  <h6><?php print $cpywrt ?></h6>
</footer>
</body>
</html>
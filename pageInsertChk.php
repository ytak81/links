<?php 
 
  header("Content-type: text/html; charset=utf-8");

  require_once("common.php");

  $seqingrp = '';
  $url = '';
  $dt = '';
  $dd = '';

  try {
    require_once("user/cst_php.php");
    $dbh =  dbConnect($dbname,$dbhost,$user,$password);
   
    $sql = "SELECT * FROM groups";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //各レコードを連想配列として取得
    while($rec){
      $rows[] = $rec;
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    }
        
    // データベース切断
    $dbh = null;
  
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
    <h1>ページ追加</h1>
  </header>
  <main> 
    <form action="pageInsert.php" method="post">
      <h3>ＩＤ　　　<span class="fontSmall">（各ページに自動的に付与されます）</span></h3>
    <br><br>
    <div style="display:inline-flex">
      <h3><label for="grp">＊GrpＩＤ: </label>
      <select id="grp" name="grp">
 
      <?php 
      foreach($rows as $rec){
      ?>
 
        <option value="<?php echo($rec['grp']) ?>"><?php echo($rec['grp']) ?>:<?php echo($rec['nm']) ?></option>
 
      <?php 
      } 
      ?>
 
      </select>　　<span class="fontSmall">（このページが所属するグループのID）</span></h3>
    </div>
    <br><br>
    <div style="display:inline-flex">
      <h3><label for="seqingrp">＊表示順　: </label>
      <input id="seqingrp" type="text" name="seqingrp" size="5" value="<?php echo($seqingrp); ?>" placeholder="50">　　　　　　<span class="fontSmall">（グループ内での表示位置を示す番号）</span></h3>
    </div>
    <br><br>
    <div style="display:inline-flex">
      <h3><label for="url">　ＵＲＬ　: </label>
      <input id="url" type="text" name="url" size="100" value="<?php echo($url); ?>" placeholder="http;//~">
    </div>
    <br><br>
    <div style="display:inline-flex">
      <h3><label for="dt">　名称　　: </label>
      <input id="dt" type="text" name="dt" size="100" value="<?php echo($dt); ?>" placeholder="ページのタイトル"></h3>
    </div>
    <br><br>
    <div style="display:inline-flex">
      <h3><label for="dd">　説明　　: </label>
      <input id="dd" type="text" name="dd" size="100" value="<?php echo($dd); ?>" placeholder="ご自由にお書きください！"></h3>
    </div>
    <br><br><br>
    <input class="btnL" type="submit" value="登録する">
    </form>
  </main> 
</body>
</html>
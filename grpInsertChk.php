<?php 
 
  header("Content-type: text/html; charset=utf-8");

  require_once('common.php');
  
	$grp = '';
  $nm = '';
  $seq = '';
  $cmnt = '';
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
    <h1>グループ追加</h1>
  </header>
  <main> 
    <form action="grpInsert.php" method="post">
    <div style="display:inline-flex">
      <h3><label for="grp">＊ＩＤ　　: </label>
      <input id="grp" type="text" name="grp" size="5" value="<?php echo($grp); ?>" placeholder="99">　　　　　<span class="fontSmall">（各グループに付けられた背番号）</span></h3>
    </div>
    <br><br>
    <div style="display:inline-flex">
      <h3><label for="nm">＊名称　　: </label>
      <input id="nm" type="text" name="nm" size="30" value="<?php echo($nm); ?>" placeholder="◎◎動画"></h3>
    </div>
    <br><br>
    <div style="display:inline-flex">
      <h3><label for="seq">＊表示順　: </label>
      <input id="seq" type="text" name="seq" size="5" value="<?php echo($seq); ?>" placeholder="50">　　　　　<span class="fontSmall">（画面上の表示位置を示す番号）</span></h3>
    </div>
    <br><br>
    <div style="display:inline-flex">
      <h3><label for="cmnt">　備考　　: </label>
      <input id="cmnt" type="text" name="cmnt" size="100" value="<?php echo($cmnt); ?>" placeholder="ご自由にお書きください！"></h3>
    </div>
    <br><br><br>
    <input class="btnL" type="submit" value="登録する">
    </form>
  </main> 
</body>
</html>
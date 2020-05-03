<?php 
 
  header("Content-type: text/html; charset=utf-8");

  require_once("common.php");
    
  $post = sanitize($_POST);
  $grp = $post['grp'];
  $item = $post['item'];
 
  switch ($item) {
    case "nm":
      $before = $post['nm'];
      $itemName = '名称　';
      $wsize = 30; 
      break;
    case "seq":
      $before = $post['seq'];
      $itemName = '表示順';
      $wsize = 5;   
      break;
    case "cmnt":
      $before = $post['cmnt'];
      $itemName = '備考　';
      $wsize = 100;    
      break;
    default:
      $err_message = "システムエラー：項目名不明";
      chk_back($err_message);
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
  <h3>以下の項目を変更します。よろしいですか？</h3>
</header>
<main>
<form method="post" action="grpModify.php">
  <input type="hidden" name="grp" value="<?php echo($grp) ?>">
  <h3>ＩＤ　: <?=$grp?></h3>
  <br>
  <h3><label for="field"><?=$itemName?>: </label>
      <input id="field" type="text" name="field" size="<?=$wsize?>" value="<?=$before?>"></h3>
  <br><br><br>
    <input type="hidden" name="item" value="<?=$item?>"></h3>
  <div style="display:inline-flex">
    <input class="btnL" type="submit" value="変更する"></form>
    <form method="post" action="grpSelect.php"><input class="btnR" type="submit" value="変更しない（一覧に戻る）"></form>
  </div>
  <br><br>
</main>
</body>
</html>
<?php
 
	header("Content-type: text/html; charset=utf-8");
	
	require_once("common.php");

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

	// リストを「表示順」にソート（多次元連想配列のソート）
	foreach ((array) $rows as $key => $value) {
    $sort[$key] = $value['seq'];
	}
	array_multisort($sort, SORT_ASC, $rows);

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
  <h1>グループ一覧</h1>
</header>
<main>
	<table>
	<tr><td></td><td>ID</td><td class="caldate">表示順</td><td class="caldate"></td><td class="caldate2">名称</td><td class="caldate2"></td><td class="caldate3">備考</td><td class="caldate3"></td></tr>
	
	<?php 
	foreach($rows as $row){
	?>
	
	<tr> 
		<td>
			<form action="grpDeleteChk.php" method="post">
			<input type="hidden" name="grp" value="<?=$row['grp']?>">
			<input type="submit" value="削除">
			</form>
		</td>
		<td><?=$row['grp']?></td>
		<td class="caldate"><?=$row['seq']?></td>
		<td class="caldate">
			<form action="grpModifyChk.php" method="post">
			<input type="submit" value="変更">
			<input type="hidden" name="grp" value="<?=$row['grp']?>">
			<input type="hidden" name="seq" value="<?=$row['seq']?>">
			<input type="hidden" name="item" value="seq">
			</form>
		</td>
		<td class="caldate2"><?=htmlspecialchars($row['nm'], ENT_QUOTES, 'UTF-8')?></td>
		<td class="caldate2">
			<form action="grpModifyChk.php" method="post">
			<input type="submit" value="変更">
			<input type="hidden" name="grp" value="<?=$row['grp']?>">
			<input type="hidden" name="nm" value="<?=$row['nm']?>">
			<input type="hidden" name="item" value="nm">
			</form>
		</td>
		<td class="caldate3"><?=htmlspecialchars($row['cmnt'], ENT_QUOTES, 'UTF-8')?></td>
		<td class="caldate3">
			<form action="grpModifyChk.php" method="post">
			<input type="submit" value="変更">
			<input type="hidden" name="grp" value="<?=$row['grp']?>">
			<input type="hidden" name="cmnt" value="<?=$row['cmnt']?>">
			<input type="hidden" name="item" value="cmnt">
			</form>
		</td>
	</tr>
	
	<?php 
	} 
	?>
	
	</table>
</main> 
</body>
</html>
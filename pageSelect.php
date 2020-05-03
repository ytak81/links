<?php
 
	header("Content-type: text/html; charset=utf-8");
	
	require_once("common.php");

	try {
		require_once("user/cst_php.php");
		$dbh =  dbConnect($dbname,$dbhost,$user,$password);
	
		$sql = "SELECT * FROM pages";
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

//// リスト（多次元連想配列）をソート
//  「grp」の降順
//  「seqingrp」の昇順
	// ソートの基準となる「grp」と「seqingrp」を配列に入れる
	foreach( $rows as $value) { 
		$grp_array[] = $value['grp'];
		$seqingrp_array[] = $value['seqingrp'];
	}
	// ソートの基準となる「grp」と「seqingrp」を配列に入れる
	array_multisort( $grp_array, SORT_DESC, SORT_NUMERIC, $seqingrp_array, SORT_ASC, SORT_NUMERIC, $rows);
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
  <h1>ぺージ一覧</h1>
</header>
<section class="widespace">
	<table>
	<tr><td></td><td>ID</td><td>GrpID</td><td></td><td class="caldate">表示順</td><td class="caldate"></td><td class="caldate2">名称</td><td class="caldate2"></td><td>URL</td><td></td><td class="caldate3">説明</td><td class="caldate3"></td></tr>
	
	<?php 
	foreach($rows as $row){
	?>
	
	<tr> 
		<td>
			<form action="pageDeleteChk.php" method="post">
			<input type="hidden" name="code" value="<?=$row['code']?>">
			<input type="submit" value="削除">
			</form>
		</td>
		<td><?=$row['code']?></td>
		<td><?=$row['grp']?></td>
		<td>
			<form action="pageModifyChk.php" method="post">
			<input type="submit" value="変更">
			<input type="hidden" name="code" value="<?=$row['code']?>">
			<input type="hidden" name="grp" value="<?=$row['grp']?>">
			<input type="hidden" name="item" value="grp">
			</form>
		</td>
		<td class="caldate"><?=$row['seqingrp']?></td>
		<td class="caldate">
			<form action="pageModifyChk.php" method="post">
			<input type="submit" value="変更">
			<input type="hidden" name="code" value="<?=$row['code']?>">
			<input type="hidden" name="seqingrp" value="<?=$row['seqingrp']?>">
			<input type="hidden" name="item" value="seqingrp">
			</form>
		</td>
		<td class="caldate2"><?=htmlspecialchars($row['dt'], ENT_QUOTES, 'UTF-8')?></td>
		<td class="caldate2">
			<form action="pageModifyChk.php" method="post">
			<input type="submit" value="変更">
			<input type="hidden" name="code" value="<?=$row['code']?>">
			<input type="hidden" name="dt" value="<?=$row['dt']?>">
			<input type="hidden" name="item" value="dt">
			</form>
		</td>
		<td><?=htmlspecialchars($row['url'], ENT_QUOTES, 'UTF-8')?></td>
		<td>
			<form action="pageModifyChk.php" method="post">
			<input type="submit" value="変更">
			<input type="hidden" name="code" value="<?=$row['code']?>">
			<input type="hidden" name="dt" value="<?=$row['url']?>">
			<input type="hidden" name="item" value="url">
			</form>
		</td>
		<td class="caldate3"><?=htmlspecialchars($row['dd'], ENT_QUOTES, 'UTF-8')?></td>
		<td class="caldate3">
			<form action="pageModifyChk.php" method="post">
			<input type="submit" value="変更">
			<input type="hidden" name="code" value="<?=$row['code']?>">
			<input type="hidden" name="dd" value="<?=$row['dd']?>">
			<input type="hidden" name="item" value="dd">
			</form>
		</td>
	</tr>
	
	<?php 
	} 
	?>
	
	</table>
</section> 
</body>
</html>
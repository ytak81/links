<?php 
// 準備
	require_once('common.php');
	$objarr = [];
	$objarr2 = [];
// データベース検索
  try {  
    require_once('user/cst_php.php');
		$dbh =  dbConnect($dbname,$dbhost,$user,$password);

    // グループ情報の取得
    $sql = 'SELECT * FROM groups WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		while ($rec) {
			$objarr[] = $rec;
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		}
    // リンク先情報の取得
    $sql = 'SELECT * FROM pages WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		while ($rec) {
			$objarr2[] = $rec;
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		}

		$dbh = null;
	}

	catch (Exception $e) {
		dberror($e);
		exit();
	}

	// 配列をスクリプトに引渡
  $json_objarr = json_encode($objarr,JSON_HEX_TAG |JSON_HEX_AMP |JSON_HEX_APOS |JSON_HEX_QUOT );
  $json_objarr2 = json_encode($objarr2,JSON_HEX_TAG |JSON_HEX_AMP |JSON_HEX_APOS |JSON_HEX_QUOT );

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
	<link rel="stylesheet" type="text/css" href="ver03.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
		integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
	<script>
		var objarr = JSON.parse('<?php echo($json_objarr) ?>');
		var objarr2 = JSON.parse('<?php echo($json_objarr2) ?>');		
	</script>
		<script src="ver03.js"></script>
</head>
<body>
	<header>
		<h1><?php echo($title) ?></h1>
		<h5>最終更新日：<?=$dateupd?></h5>
	</header>
	<section>
		<div id="sub1">
			<h4>【索引】<h4>
			<ul id="indexList">
			</ul>	
			<br>
		</div>
	</section>

	<div id="mains" class="accordion">
		<h2>【リスト】</h2>
	</div>

	<div id="sub2">
		<h4>《データメンテナンス》</h4>
		<br>		
		<h5>グループ</h5>
		<ul>
			<li><a href="grpInsertChk.php">グループ追加</a></li>
			<br>	
			<li><a href="grpSelect.php">グループ一覧</a>（変更・削除）</li>
		</ul>
		<br>		
		<h5>ページ</h5>
		<ul>
			<li><a href="pageInsertChk.php">ページ追加</a></li>
			<br>				
			<li><a href="pageSelect.php">ページ一覧</a>（変更・削除）</li>
		</ul>
	</div>

	<footer>
  	<h6><?php print $cpywrt ?></h6>
	</footer>

</body>
</html>
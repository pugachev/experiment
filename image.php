<?php
$dsn = "mysql:host=localhost; dbname=test; charset=utf8";
$username = "mtake";
$password = "Manabu2010";
// $id = rand(1, 5);
$id=1;
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}

    $sql = "SELECT * FROM input";
    $stmt = $dbh->prepare($sql);
    // $stmt->bindValue(':id', $id);
    $stmt->execute();
    $images = $stmt->fetch(PDO::FETCH_ASSOC);
    $tgtimage="";
    // print_r($images);
    foreach($images as $key => $image){
        // print_r("debug0 ".$image.'  '.strpos($image,'dinner'));
        if(strpos($image,'dinner') !== false){
            // 現在日時を YYYY/MM/DD hh:mm:ss の書式の文字列で取得する
            // $now = date('Y/m/d H:i:s');

            $tgtimage=$image;
            // print_r("debug1 ".$tgtimage);
        }
    }

    // print_r("debug2 ".$tgtimage);
    // die();
?>


<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>サイトタイトル</title>
		<meta name="description" content="サイトキャプションを入力">
		<meta name="keywords" content="サイトキーワードを,で区切って入力">
        <style>

        </style>
	</head>

	<body>
        <h1>画像表示</h1>
        <img src="images/<?php echo $tgtimage; ?>" width="500" height="300">
        <a href="upload.php">画像アップロード</a>
	</body>
</html>
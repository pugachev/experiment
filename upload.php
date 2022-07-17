<?php
$dsn = "mysql:host=localhost; dbname=test; charset=utf8";
$username = "mtake";
$password = "Manabu2010";
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$timezone="";
    if (isset($_POST['upload'])) {//送信ボタンが押された場合
		if(!empty($_POST['tgttimezone'])){
			$dtime = $_POST['tgttimezone'];
			switch($dtime){
				case 1:
					$timezone="morning";
					break;
				case 2:
					$timezone="daytime";
					break;
				case 3:
					$timezone="dinner";
					break;
				default:
				$timezone="no data";
				break;
			}
		}
        // $image = uniqid(mt_rand(), true);//ファイル名をユニーク化
		$now = date('Y-m-d');

		$image = $now.'_'.$timezone;
        $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
        $file = "images/$image";
        $sql = "INSERT INTO input(picname) VALUES (:image)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);
		//$_FILES['image']['name'] 元ファイル名
        if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
			//$_FILES['image']['tmp_name'] /tm/xxxx てな感じのファイル名 現在ファイル本体がある仮のパスがあるっぽい
            move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);//imagesディレクトリにファイル保存
            if (exif_imagetype($file)) {//画像ファイルかのチェック
                $message = '画像をアップロードしました';
                $stmt->execute();
            } else {
                $message = '画像ファイルではありません';
            }
        }
    }
?>
<style>
.myform{
	margin: 0 auto;
	text-align: center;
}

</style>

<h1 class="myform">画像アップロード</h1><br /><br />
<!--送信ボタンが押された場合-->
<?php if (isset($_POST['upload'])): ?>
    <p><?php echo $message; ?></p>
    <p><a href="image.php">画像表示へ</a></p>
<?php else: ?>
    <form method="post" enctype="multipart/form-data" class="myform">
        <p class="myform">アップロード画像</p><br />
        <input type="file" name="image"><br /><br />

		<input id="morning" type="radio" name="tgttimezone" value="1" checked/>
		<label for="morning">朝</label>
		<input id="daytime" type="radio" name="tgttimezone" value="2"/>
		<label for="daytime">昼</label>
		<input id="dinner" type="radio" name="tgttimezone" value="3"/>
		<label for="dinner">夜</label><br /><br />

        <button><input type="submit" name="upload" value="送信"></button>
    </form>
<?php endif;?>
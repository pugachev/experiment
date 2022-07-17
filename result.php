<?php
$rcvname='';
$rcvaddress='';
$rcvfavolite='';
//この形で飛んでくるので初期化しておく
$rcvFoodsArray["foods"]['カレー']="";
$rcvFoodsArray["foods"]['餃子']="";
$rcvFoodsArray["foods"]['ラーメン']="";

if(!isset($_POST['yourname']) && !empty($_POST['yourname']))
{
    $rcvname=$_POST['yourname'];
}

if(!empty($_POST['hiddenname']))
{
    $rcvname=$_POST['hiddenname'];
}

if(!empty($_POST['youraddress']))
{
    $rcvaddress=$_POST['youraddress'];
}

if(!empty($_POST['favolite']))
{
    $rcvfavolite = $_POST['favolite'];
}

if(!empty($_POST['hiddenfavolite']))
{
    $rcvfavolite = $_POST['hiddenfavolite'];
}

if(!empty($_POST['foods']) && isset($_POST['foods']))
{
    foreach($_POST['foods'] as $food)
    {
        if(!empty($food))
        {
            //「checked」がつくとチェック済状態となる 文字列で「checked」を加えるだけでよい
            $rcvFoodsArray["foods"][$food] = "checked";
        }
    }
}

if(!empty($_POST['hiddenfoods']) && isset($_POST['hiddenfoods']))
{
    foreach($_POST['hiddenfoods'] as $food)
    {
        if(!empty($food))
        {
            $rcvFoodsArray["foods"][$food] = "checked";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <title>結果画面</title>
</head>
<body>
    <div style="text-align: center;margin-top:30px;">
        名前: <input type="text" name="rcvname" value="<?php echo $rcvname; ?>" disabled=disabled /> <br><br>
        住所: <input type="text" name="rcvaddress" value="<?php echo $rcvaddress; ?>" disabled=disabled /> <br><br>
        職業: <select name="rcvfavolite" style="width:145px;">
                    <option value="">選択肢して下さい</option>
                    <option value="会社員" <?php if($rcvfavolite=='会社員') echo 'selected'; ?>>会社員</option>
                    <option value="フリーランサー" <?php if($rcvfavolite=='フリーランサー') echo 'selected'; ?>>フリーランサー</option>
                    <option value="公務員" <?php if($rcvfavolite=='公務員') echo 'selected'; ?>>公務員</option>
                </select><br><br>
        好物:
        <?php
            print <<<eof
                    <input type="checkbox" name="foods[]" value="カレー" {$rcvFoodsArray["foods"]['カレー']} disabled=disabled>カレー
                    <input type="checkbox" name="foods[]" value="餃子" {$rcvFoodsArray["foods"]['餃子']} disabled=disabled>餃子
                    <input type="checkbox" name="foods[]" value="ラーメン" {$rcvFoodsArray["foods"]['ラーメン']} disabled=disabled>ラーメン
            eof;
        ?>
                <br><br>
        <a href="regi.php">戻る</a>
</div>
</body>
</html>
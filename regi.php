<?php
$hiddenname="相場詩織";
// $hiddenfavolite="会社員";
$tgtfoods=array('カレー','餃子');
// var_dump($hiddenfoods);
// die();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <title>登録画面</title>
</head>
<body>
    <form style="text-align: center;margin-top:30px;" action="result.php" method="post">
        名前: <input type="text" name="yourname" value="<?php echo $hiddenname; ?>" disabled=disabled /> <br><br>
        住所: <input type="text" name="youraddress"/> <br><br>
        職業: <select name="favolite" style="width:145px;">
                    <option value="">選択肢して下さい</option>
                    <option value="会社員">会社員</option>
                    <option value="フリーランサー">フリーランサー</option>
                    <option value="公務員">公務員</option>
                </select><br><br>
        好物:
                <input type="checkbox" name="foods[]" value="カレー"  disabled=disabled >カレー
                <input type="checkbox" name="foods[]" value="餃子"  disabled=disabled >餃子
                <input type="checkbox" name="foods[]" value="ラーメン"  disabled=disabled >ラーメン
                <br><br>

        <?php 
                foreach($tgtfoods as $tmp){
                    print <<<eof
                        <input type="hidden" name="hiddenfoods[]" value=$tmp  />
                    eof;
                }
        ?>
        <input type="hidden" name="hiddenname" value='<?php echo $hiddenname ?>' />
        <input type="submit" value="Submit"/>
    </form>
</body>
</html>
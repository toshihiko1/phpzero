<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false) {
    print 'ログインされていません。<br/>';
    print '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
    exit();
}else{
    print $_SESSION['staff_name'];
    print 'さんログイン中<br/>';
    print '<br/>';
    }

try {
  $staff_code = $_GET['staffcode'];

  $dsn ='mysql:dbname=shop;host=db;charset=utf8';
  $user ='zero';
  $password ='secret';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql = 'SELECT name FROM mst_staff WHERE code=?';
  $stmt=$dbh->prepare($sql);
  $data[] = $staff_code;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $staff_name = $rec['name'];

  $dbh = null;

}
  catch(EXCEPTION $e)
{
  print 'ただいま障害により大変ご迷惑をお掛けしております。' . $e->getMessage() . "<br/>";
  exit;
}

?>

スタッフ削除<br/>
<br/>
スタッフコード<br/>
<?php print $staff_code;?>
<br/>
スタッフ名<br/>
<?php print $staff_name;?>
<br/>
このスタッフを削除してよろしいですか？<br/>
<br/>
<form action="staff_delete_done.php" method="post">
<input type="hidden" name="code" value="<?php print $staff_code;?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

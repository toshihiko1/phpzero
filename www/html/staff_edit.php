<?php

try {
  $staff_code = $_POST['staffcode'];

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

スタッフ修正<br/>
<br/>
スタッフコード<br/>
<?php print $staff_code;?>
<br/>
<br/>
<form action="staff_edit_check.php" method="post">
<input type="hidden" name="code" value="<?php print $staff_code;?>">
  スタッフ名</br>
  <input type="text" name="name" style="width:200px" value="<?php print $staff_name;?>"></br>
  パスワードを入力してください。</br>
  <input type="password" name="pass" style="width:200px"></br>
  パスワードをもう一度入力してください。</br>
  <input type="password" name="pass2" style="width:200px"></br>
  </br>
  <input type="button" onclick="history.back()" value="戻る">
  <input type="submit" value="OK">
</form>

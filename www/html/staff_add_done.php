<?php

try {
  $staff_name = $_POST['name'];
  $staff_pass = $_POST['pass'];

  $staff_name = htmlspecialchars($staff_name, ENT_QUOTES,'UTF-8');
  $staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES,'UTF-8');

  $dsn ='mysql:dbname=shop;host=db;charset=utf8';
  $user ='zero';
  $password ='secret';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql = 'INSERT INTO mst_staff(name,password)VALUES(?,?)';
  $stmt=$dbh->prepare($sql);
  $data[] = $staff_name;
  $data[] = $staff_pass;
  $stmt->execute($data);

  $dbh = null;

  print $staff_name;
  print 'さんを追加しました。<br/>';

}
  catch(EXCEPTION $e)
{
  print 'ただいま障害により大変ご迷惑をお掛けしております。' . $e->getMessage() . "<br>";
  exit;
}

?>

<a href="staff_list.php">戻る</a>

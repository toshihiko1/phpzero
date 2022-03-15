<?php

try {
  $pro_code = $_POST['code'];
  $pro_gazou_name = $_POST['gazou_name'];

  $dsn ='mysql:dbname=shop;host=db;charset=utf8';
  $user ='zero';
  $password ='secret';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql = 'DELETE FROM mst_product WHERE code=?';
  $stmt=$dbh->prepare($sql);
  $data[] = $pro_code;
  $stmt->execute($data);

  $dbh = null;

  if($pro_gazou_name != '') {
    unlink('./gazou/'.$pro_gazou_name);
  }

}
  catch(EXCEPTION $e)
{
  print 'ただいま障害により大変ご迷惑をお掛けしております。' . $e->getMessage() . "<br>";
  exit;
}

?>

削除しました。<br/>
<br/>

<a href="pro_list.php">戻る</a>

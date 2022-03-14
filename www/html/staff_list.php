<?php

try {
  $dsn ='mysql:dbname=shop;host=db;charset=utf8';
  $user ='zero';
  $password ='secret';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql = 'SELECT code,name FROM mst_staff WHERE 1';
  $stmt=$dbh->prepare($sql);
  $stmt->execute($data);

  $dbh = null;

  print 'スタッフ一覧<br/><br/>';

  print '<form method="post" action="staff_branch.php">';
  while(true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec == false) {
      break;
    }
    print '<input type="radio" name="staffcode" value="'.$rec['code'].'">';
    print $rec['name'];
    print '<br/>';
  }
  print '<input type="submit" name="disp" value="参照">';
  print '<input type="submit" name="add" value="追加">';
  print '<input type="submit" name="edit" value="修正">';
  print '<input type="submit" name="delete" value="削除">';
  print '</form>';
}
  catch(EXCEPTION $e)
{
  print 'ただいま障害により大変ご迷惑をお掛けしております。' . $e->getMessage() . "<br>";
  exit;
}

?>

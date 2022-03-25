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

require_once('../common/common.php');

$post = sanitize($_POST);

try {
  $staff_name = $post['name'];
  $staff_pass = $post['pass'];

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

<?php
// session_start();
// session_regenerate_id(true);
// if(isset($_SESSION['login']) == false) {
//     print 'ログインされていません。<br/>';
//     print '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
//     exit();
// }else{
//     print $_SESSION['staff_name'];
//     print 'さんログイン中<br/>';
//     print '<br/>';
//     }

try {

  require_once('../common/common.php');

  $post = sanitize($_POST);

  $member_email = $post['email'];
  $member_pass = $post['pass'];

  $member_pass = md5($member_pass);

  $dsn = 'mysql:dbname=shop;host=db;charset=utf8';
  $user ='zero';
  $password ='secret';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql = 'SELECT code,name FROM dat_member WHERE email=? AND password=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $member_email;
  $data[] = $member_pass;
  $stmt->execute($data);

  $dbh = null;

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);

  if($rec == false) {
    print'メールアドレスかパスワードが間違っています。<br/>';
    print'<a href = "member_login.php">戻る</a>';
  }else{
    session_start();
    $_SESSION['member_login'] = 1;
    $_SESSION['member_code'] = $rec['code'];
    $_SESSION['member_name'] = $rec['name'];
    header('Location:shop_list.php');
    exit();
  }


}catch(Exception $e) {
    print 'ただいま障害により大変ご迷惑をお掛けしております。' . $e->getMessage() . "<br>";
    exit();
  }

?>

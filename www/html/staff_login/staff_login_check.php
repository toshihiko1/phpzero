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

  $staff_code = $_POST['code'];
  $staff_pass = $_POST['pass'];

  $staff_code = htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');
  $staff_pass = htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

  $staff_pass = md5($staff_pass);

  $dsn = 'mysql:dbname=shop;host=db;charset=utf8';
  $user ='zero';
  $password ='secret';
  $dbh = new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql = 'SELECT name FROM mst_staff WHERE code=? AND password=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_code;
  $data[] = $staff_pass;
  $stmt->execute($data);

  $dbh = null;

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);

  if($rec == false) {
    print'スタッフコードかパスワードが間違っています。<br/>';
    print'<a href = "staff_login.php">戻る</a>';
  }else{
    session_start();
    $_SESSION['login'] = 1;
    $_SESSION['staff_code'] = $staff_code;
    $_SESSION['staff_name'] = $rec['name'];
    header('Location:staff_top.php');
    exit();
  }
  

}catch(Exception $e) {
    print 'ただいま障害により大変ご迷惑をお掛けしております。' . $e->getMessage() . "<br>";
    exit();
  }

?>
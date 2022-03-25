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
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ろくまる農園</title>
</head>
<body>
スタッフの追加</br>
<form action="staff_add_check.php" method="post">
  スタッフ名を入力してください。</br>
  <input type="text" name="name" style="width:200px"></br>
  パスワードを入力してください。</br>
  <input type="password" name="pass" style="width:200px"></br>
  パスワードをもう一度入力してください。</br>
  <input type="password" name="pass2" style="width:200px"></br>
  </br>
  <input type="button" onclick="history.back()" value="戻る">
  <input type="submit" value="OK">
</form>
</body>
</html>

<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) == false) {
  print 'ようこそゲスト様<br/>';
  print '<a href="member_login.php">会員ログイン</a><br/>';
} else {
  print 'ようこそ';
  print $_SESSION['member_name'];
  print '様<br/>';
  print '<a href="member_logout.php">ログアウト</a>';
  print '<br/>';
}
?>

<?php
try {
  $cart = $_SESSION['cart'];
  var_dump($cart);
  exit();

  $dsn = 'mysql:dbname=shop;host=db;charset=utf8';
  $user = 'zero';
  $password = 'secret';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  foreach($cart as $key => $val) {
    $sql = 'SELECT code,name,price,gazou FROM mst_product WHERE=?';
    $stmt = $dbh->prepare($sql);
    $data[0] = $val;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    $pro_name[] = $rec['name'];
    $pro_price[] = $rec['price'];
    if($rec['gazou'] == '') {
      $pro_gazou[] = '';
    }else{
      $pro_gazou[] = '<img src="../product/gazou/'.$rec['gazou'].'>';
    }
  }

  $dbh = null;

} catch (EXCEPTION $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。' . $e->getMessage() . "<br/>";
  exit();
}
?>

<form>
<input type="button" onclick="history.back()" value="戻る">
</form>

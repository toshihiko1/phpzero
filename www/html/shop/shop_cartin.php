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
  $pro_code = $_GET['procode'];

  if(isset($_SESSION['cart']) == true) {
  $cart = $_SESSION['cart'];
  }

  $cart[] = $pro_code;
  $_SESSION['cart'] = $cart;

} catch (EXCEPTION $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。' . $e->getMessage() . "<br/>";
  exit;
}
?>

カートに追加しました。<br/>
<br/>
<a href="shop_list.php">商品一覧に戻る</a>

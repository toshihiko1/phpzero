<?php
session_start();
session_regenerate_id(true);

require_once('../common/common.php');

try {


$post = sanitize($_POST);

$onamae = $post['onamae'];
$email = $post['email'];
$postal1 = $post['postal1'];
$postal2 = $post['postal2'];
$address = $post['address'];
$tel = $post['tel'];

  print $onamae.'様<br/>';
  print 'ご注文ありがとうございました<br/>';
  print $email.'にメールを送りましたのでご確認ください。<br/>';
  print '商品は以下の住所に発送させていただきます。<br/>';
  print $postal1.'-'.$postal2.'<br>';
  print $address.'<br/>';
  print $tel.'<br/>';

  $honbun = "";
  $honbun .= $onamae."様\n\nこの度はご注文ありがとうございました。\n";
  $honbun .= "\n";
  $honbun .= "ご注文商品\n";
  $honbun .= "------------------------\n";

  $cart = $_SESSION['cart'];
  $kazu = $_SESSION['kazu'];
  $max = count($cart);

  $dsn = 'mysql:dbname=shop;host=db;charset=utf8';
  $user = 'zero';
  $password = 'secret';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  for($i = 0; $i < $max; $i++) {
    $sql = 'SELECT name,price FROM mst_product WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[0] = $cart[$i];
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    $name = $rec['name'];
    $price = $rec['price'];
    $suryo = $kazu[$i];
    $shokei = $price * $suryo;

    $honbun .= $name.' ';
    $honbun .= $price.'円 x';
    $honbun .= $suryo.'個 =';
    $honbun .= $shokei."円\n";
  }

  $dbh = null;

  $honbun .= "送料は無料です\n";
  $honbun .= "------------------------\n";
  $honbun .= "\n";
  $honbun .= "代金は以下の口座にお振り込み下さい\n";
  $honbun .= "ろくまる銀行　やさい支店　普通口座　1234567\n";
  $honbun .= "入金確認が取れ次第、梱包、発送させて頂きます。\n";
  $honbun .= "\n";
  $honbun .= "□□□□□□□□□□□□□□□□□□□□□□\n";
  $honbun .= " 〜安心野菜ろくまる農園〜\n";
  $honbun .= "\n";
  $honbun .= "○○県マルマルモリモリ市\n";
  $honbun .= "電話 090-0000-9999\n";
  $honbun .= "メール info@rokuroku.co.jp\n";
  $honbun .= "□□□□□□□□□□□□□□□□□□□□□□\n";
  //print '<br/>';
  //print nl2br($honbun);

  $title = 'ご注文ありがとうございます。';
  $header = 'From:info@rokumarunouen.co.jp';
  $honbun = html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
  mb_language('Japanese');
  mb_internal_encoding('UTF-8');
  mb_send_mail($email,$title,$honbun,$header);

  $title = 'お客様からご注文がありました。';
  $header = 'From:'.$email;
  $honbun = html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
  mb_language('Japanese');
  mb_internal_encoding('UTF-8');
  mb_send_mail('info@rokumarunouen.co.jp',$title,$honbun,$header);

}catch(Exception $e){
  print 'ただいま障害により大変ご迷惑をお掛けしております。' . $e->getMessage() . "<br/>";
  exit();
}

?>
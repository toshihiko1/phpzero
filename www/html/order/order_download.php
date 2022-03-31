<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
    print 'ログインされていません。<br/>';
    print '<a href="../staff_login/staff_login.php">ログイン画面へ</a>';
    exit();
} else {
    print $_SESSION['staff_name'];
    print 'さんログイン中<br/>';
    print '<br/>';
}
?>

<?php
require_once('../common/common.php');
?>

ダウンロードしたい日を選んで下さい。<br />
<form action="order_download_done.php" method="post">
    <?php pulldown_year(); ?>
    年
    <?php pulldown_month(); ?>
    月
    <?php pulldown_day(); ?>
    日<br />
    <br />
    <input type="submit" value="ダウンロードへ">
</form>

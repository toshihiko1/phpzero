会員ログイン
<br />
<form action="member_login_check.php" method="post">
  登録メールアドレス<br />
  <input type="text" name="email"><br />
  パスワード<br />
  <input type="password" name="pass"><br />
  <br />
  <input type="submit" value="ログイン">
  <?php print '<input type="button" onclick="history.back()" value="戻る">'; ?>
</form>

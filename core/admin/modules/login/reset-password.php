<?
	$hash = mysql_real_escape_string(end($path));
	$user = sqlfetch(sqlquery("SELECT * FROM bigtree_users WHERE change_password_hash = '$hash'"));
	$failure = false;
	
	if ($_POST["password"]) {
		if ($_POST["password"] != $_POST["confirm_password"]) {
			$failure = true;
		} else {
			$admin->changePassword(end($path),$_POST["password"]);
		}
	}
?>
<div id="login">
	<form method="post" action="" class="module">
		<h2>Reset Your Password</h2>
		<? if ($failure) { ?><p class="error_message clear">Passwords did not match. Please try again.</p><? } ?>
		<? if (!$user) { ?>
		<fieldset class="clear">
			<p>This reset request has expired. <a href="<?=$admin_root?>login/forgot-password/">Click Here</a> to request a new link.</p>
		</fieldset>
		<br />
		<? } else { ?>
		<fieldset>
			<label>New Password</label>
			<input class="text" type="password" name="password" />
		</fieldset>
		<fieldset>
			<label>Confirm New Password</label>
			<input class="text" type="password" name="confirm_password" />
		</fieldset>
		<fieldset class="lower">
			<input type="submit" class="button blue" value="Reset" />
		</fieldset>
		<? } ?>
	</form>
</div>
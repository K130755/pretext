<?php
$submit = trim(addslashes(strip_tags($_POST['submit'])));
$login = trim(addslashes(strip_tags($_POST['login'])));
$password = trim(addslashes(strip_tags($_POST['password'])));
if(!empty($submit) AND isset($submit)){
if(!empty($login) AND !empty($password)){
$password = sha1(md5($password));
	$q = mysqli_query($connect,"SELECT * FROM `admins` WHERE `login` = '$login' AND `password` = '$password'");
	$n = mysqli_num_rows($q);
	if($n > 0){
	$s = mysqli_fetch_array($q);
	$id = $s['id'];
	$_SESSION['admin_id'] = $id;
	$_SESSION['admin_login'] = $login;
	header("Location: index");
	} else {header("Location: login-2");}
} else {header("Location: login-1");}
}
?>
<form name="form" action='' method='post' class="form-validation mt-20" novalidate="">
  <div class="form-group">
    <input type="text" name='login' class="form-control underline-input" placeholder="Login" style="padding-left: 7px;" required>
  </div>
	<div class="form-group">
    <input type="password" name='password' placeholder="Hasło" class="form-control underline-input" style="padding-left: 7px;" required>
  </div>
  <div class="form-group text-left mt-20">
    <input type='submit' class="btn btn-greensea b-0 br-2 mr-5 pull-right" value='Zaloguj' name='submit'>
  </div>
		<div style='clear: both;'></div>
</form>
<?php
if(!empty($_GET['error'])){
echo "<div style='clear: both; height: 10px;'></div>";
	if($_GET['error'] == "1"){
	error("Nie wypełniono wszystkich pól!");
	} else if($_GET['error'] == "2"){
	error("Wprowadzono błędne dane!");
	}
}
?>
<?php
require_once "config.php"; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $name=trim($_POST['name']??''); $email=filter_var(trim($_POST['email']??''),FILTER_VALIDATE_EMAIL); $pass=$_POST['password']??'';
  if (!$name || !$email || strlen($pass)<8) $error="Enter your name, a valid email and a password of at least 8 characters.";
  else {
    try { $s=$pdo->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)"); $s->execute([$name,$email,password_hash($pass,PASSWORD_DEFAULT)]); $_SESSION['user_id']=$pdo->lastInsertId(); $_SESSION['user_name']=$name; $_SESSION['is_admin']=0; header("Location: index.php"); exit; }
    catch(PDOException $e) { $error="That email address may already be registered."; }
  }
}
$page_title="Create account"; include "header.php";
?>
<main class="auth-wrap"><form class="auth-card" method="post"><span class="eyebrow">JOIN THE JOURNEY</span><h1>Create your account</h1><p>Save destinations and keep your travel inspiration close.</p><?php if($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?><label>Full name<input name="name" required value="<?= e($_POST['name']??'') ?>"></label><label>Email address<input type="email" name="email" required></label><label>Password<input type="password" name="password" minlength="8" required></label><button class="btn btn-wide">Create account</button><p>Already a member? <a href="login.php">Log in</a></p></form></main>
<?php include "footer.php"; ?>

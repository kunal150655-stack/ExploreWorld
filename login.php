<?php
require_once "config.php"; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
 $s=$pdo->prepare("SELECT * FROM users WHERE email=?"); $s->execute([trim($_POST['email']??'')]); $u=$s->fetch();
 if ($u && password_verify($_POST['password']??'',$u['password'])) { session_regenerate_id(true); $_SESSION['user_id']=$u['id']; $_SESSION['user_name']=$u['name']; $_SESSION['is_admin']=(int)$u['is_admin']; header("Location: index.php"); exit; }
 $error="Email or password is incorrect.";
}
$page_title="Log in"; include "header.php";
?>
<main class="auth-wrap"><form class="auth-card" method="post"><span class="eyebrow">WELCOME BACK</span><h1>Log in</h1><p>Continue exploring with WonderWorld.</p><?php if($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?><label>Email address<input type="email" name="email" required></label><label>Password<input type="password" name="password" required></label><button class="btn btn-wide">Log in</button><p>New here? <a href="register.php">Create an account</a></p></form></main>
<?php include "footer.php"; ?>

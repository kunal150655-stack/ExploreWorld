<?php
require_once "config.php"; $message='';
if($_SERVER['REQUEST_METHOD']==='POST') {
 $name=trim($_POST['name']??''); $email=filter_var(trim($_POST['email']??''),FILTER_VALIDATE_EMAIL); $body=trim($_POST['message']??'');
 if($name && $email && $body) { $s=$pdo->prepare("INSERT INTO messages(name,email,message) VALUES(?,?,?)"); $s->execute([$name,$email,$body]); $message="Thanks! Your message has been received."; }
 else $message="Please complete every field with a valid email address.";
}
$page_title="Contact us"; include "header.php";
?>
<main class="auth-wrap"><form class="auth-card" method="post"><span class="eyebrow">WE'D LOVE TO HEAR FROM YOU</span><h1>Contact us</h1><p>Have a question or suggestion? Send our team a message.</p><?php if($message): ?><p class="notice"><?= e($message) ?></p><?php endif; ?><label>Your name<input name="name" required></label><label>Email address<input type="email" name="email" required></label><label>Message<textarea name="message" rows="5" required></textarea></label><button class="btn btn-wide">Send message</button></form></main>
<?php include "footer.php"; ?>

<?php
require_once "config.php"; if(!logged_in()){header("Location: login.php");exit;}
$s=$pdo->prepare("SELECT d.* FROM destinations d JOIN favorites f ON f.destination_id=d.id WHERE f.user_id=? ORDER BY f.created_at DESC"); $s->execute([$_SESSION['user_id']]); $places=$s->fetchAll();
$page_title="Your favourites"; include "header.php";
?>
<main class="page-wrap"><div class="page-intro"><span class="eyebrow">YOUR PERSONAL TRAVEL LIST</span><h1>Saved favourites</h1><p>All the places you want to explore, together in one place.</p></div><div class="cards"><?php foreach($places as $place): ?><a class="destination-card" href="destination.php?id=<?= (int)$place['id'] ?>"><img src="<?= e($place['image_url']) ?>" alt="<?= e($place['name']) ?>"><div class="card-info"><span><?= e($place['country']) ?></span><h3><?= e($place['name']) ?></h3><p><?= e(mb_strimwidth($place['description'],0,100,'…')) ?></p></div></a><?php endforeach; ?></div><?php if(!$places): ?><p class="notice">You have not saved any destinations yet. <a href="destinations.php">Explore destinations</a>.</p><?php endif; ?></main>
<?php include "footer.php"; ?>

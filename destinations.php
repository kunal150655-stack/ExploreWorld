<?php
require_once "config.php";
$q = trim($_GET['q'] ?? '');
$sql = "SELECT * FROM destinations";
$params = [];
if ($q !== '') { $sql .= " WHERE name LIKE ? OR country LIKE ? OR city LIKE ?"; $like = "%$q%"; $params = [$like,$like,$like]; }
$sql .= " ORDER BY name";
$stmt = $pdo->prepare($sql); $stmt->execute($params); $places = $stmt->fetchAll();
$page_title = "Explore destinations";
include "header.php";
?>
<main class="page-wrap"><div class="page-intro"><span class="eyebrow">THE WORLD IS YOURS TO DISCOVER</span><h1>Explore destinations</h1><p>Find inspiration for your next great story.</p></div>
<form class="search-bar search-page" method="get"><span>⌕</span><input name="q" value="<?= e($q) ?>" placeholder="Search by destination, city or country"><button class="btn">Search</button></form>
<div class="cards">
<?php foreach ($places as $place): ?><a class="destination-card" href="destination.php?id=<?= (int)$place['id'] ?>"><img src="<?= e($place['image_url']) ?>" alt="<?= e($place['name']) ?>"><div class="card-info"><span><?= e($place['country']) ?></span><h3><?= e($place['name']) ?></h3><p><?= e(mb_strimwidth($place['description'],0,105,'…')) ?></p></div></a><?php endforeach; ?>
</div><?php if (!$places): ?><p class="notice">No destinations matched your search.</p><?php endif; ?></main>
<?php include "footer.php"; ?>

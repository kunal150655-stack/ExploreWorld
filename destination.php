<?php
require_once "config.php";
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM destinations WHERE id = ?"); $stmt->execute([$id]); $place = $stmt->fetch();
if (!$place) { http_response_code(404); exit("Destination not found."); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!logged_in()) { header("Location: login.php"); exit; }
  $check = $pdo->prepare("SELECT id FROM favorites WHERE user_id=? AND destination_id=?"); $check->execute([$_SESSION['user_id'],$id]);
  if ($check->fetch()) { $del=$pdo->prepare("DELETE FROM favorites WHERE user_id=? AND destination_id=?"); $del->execute([$_SESSION['user_id'],$id]); }
  else { $add=$pdo->prepare("INSERT IGNORE INTO favorites(user_id,destination_id) VALUES(?,?)"); $add->execute([$_SESSION['user_id'],$id]); }
  header("Location: destination.php?id=$id"); exit;
}
$fav = false;
if (logged_in()) { $s=$pdo->prepare("SELECT id FROM favorites WHERE user_id=? AND destination_id=?"); $s->execute([$_SESSION['user_id'],$id]); $fav=(bool)$s->fetch(); }
$hasCoordinates = $place['latitude'] !== null && $place['longitude'] !== null
  && is_numeric($place['latitude']) && is_numeric($place['longitude'])
  && (float)$place['latitude'] >= -90 && (float)$place['latitude'] <= 90
  && (float)$place['longitude'] >= -180 && (float)$place['longitude'] <= 180;
if ($hasCoordinates) {
  $lat = (float)$place['latitude']; $lon = (float)$place['longitude'];
  $bbox = implode(',', [$lon - 0.02, $lat - 0.02, $lon + 0.02, $lat + 0.02]);
  $mapUrl = 'https://www.openstreetmap.org/export/embed.html?bbox=' . rawurlencode($bbox)
    . '&layer=mapnik&marker=' . rawurlencode($lat . ',' . $lon);
  $directionsUrl = 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode($lat . ',' . $lon);
}
$page_title = $place['name']; include "header.php";
?>
<main class="page-wrap detail-page"><img class="detail-image" src="<?= e($place['image_url']) ?>" alt="<?= e($place['name']) ?>"><div class="detail-content"><span class="eyebrow"><?= e($place['city']) ?> · <?= e($place['country']) ?></span><h1><?= e($place['name']) ?></h1><p class="lead"><?= nl2br(e($place['description'])) ?></p><?php if ($place['best_time']): ?><p><strong>Best time to visit:</strong> <?= e($place['best_time']) ?></p><?php endif; ?><?php if ($place['travel_tips']): ?><h2>Travel tips</h2><p><?= nl2br(e($place['travel_tips'])) ?></p><?php endif; ?><form method="post"><button class="btn" type="submit"><?= $fav ? '♥ Remove from favourites' : '♡ Save to favourites' ?></button></form></div>
<?php if ($hasCoordinates): ?>
<section class="map-section">
  <div><span class="eyebrow">FIND YOUR WAY</span><h2>Explore the location</h2><p>Use the map to see where this destination is located. Open directions for navigation and route options.</p><a class="btn" href="<?= e($directionsUrl) ?>" target="_blank" rel="noopener noreferrer">Get directions ↗</a></div>
  <iframe class="destination-map" title="Map showing <?= e($place['name']) ?>" src="<?= e($mapUrl) ?>" loading="lazy" referrerpolicy="no-referrer"></iframe>
</section>
<?php endif; ?>
</main>
<?php include "footer.php"; ?>

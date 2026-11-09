<?php
require_once "config.php";
$featured = $pdo->query("SELECT * FROM destinations ORDER BY id DESC LIMIT 6")->fetchAll();
$q = trim($_GET['q'] ?? '');
?>
<?php include "header.php"; ?>
<main>
<section class="hero">
  <div class="hero-content">
    <span class="eyebrow">YOUR NEXT ADVENTURE STARTS HERE</span>
    <h1>Explore the world.<br><em>Find your wonder.</em></h1>
    <p>Discover unforgettable places, local experiences and travel inspiration with WonderWorld.</p>
    <form class="search-bar" action="destinations.php" method="get">
      <span>⌕</span><input name="q" placeholder="Search a city, country or destination..." aria-label="Search destinations">
      <button class="btn" type="submit">Explore</button>
    </form>
  </div>
</section>
<section class="section">
  <div class="section-heading"><div><span class="eyebrow">CURATED FOR CURIOUS TRAVELLERS</span><h2>Popular destinations</h2></div><a class="text-link" href="destinations.php">View all destinations →</a></div>
  <div class="cards">
  <?php foreach ($featured as $place): ?>
    <a class="destination-card" href="destination.php?id=<?= (int)$place['id'] ?>">
      <img src="<?= e($place['image_url']) ?>" alt="<?= e($place['name']) ?>">
      <div class="card-info"><span><?= e($place['country']) ?></span><h3><?= e($place['name']) ?></h3><p><?= e(mb_strimwidth($place['description'], 0, 95, '…')) ?></p></div>
    </a>
  <?php endforeach; ?>
  <?php if (!$featured): ?><p>No destinations yet. Import the sample data from database.sql.</p><?php endif; ?>
  </div>
</section>
<section class="cta"><div><span class="eyebrow">MAKE IT YOUR JOURNEY</span><h2>Your world is waiting.</h2><p>Save the places you love and start building your travel wish list.</p></div><a class="btn btn-light" href="<?= logged_in() ? 'favorites.php' : 'register.php' ?>">Get started</a></section>
</main>
<?php include "footer.php"; ?>

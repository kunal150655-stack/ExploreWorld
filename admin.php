<?php
require_once "config.php"; if(!is_admin()){http_response_code(403);exit("Admin access only. Set is_admin=1 for your account in the database.");}
$notice='';
if($_SERVER['REQUEST_METHOD']==='POST') {
 $name=trim($_POST['name']??'');$country=trim($_POST['country']??'');$city=trim($_POST['city']??'');$desc=trim($_POST['description']??'');$image=trim($_POST['image_url']??'');
 $latRaw=trim($_POST['latitude']??''); $lonRaw=trim($_POST['longitude']??'');
 $lat = ($latRaw === '') ? null : filter_var($latRaw, FILTER_VALIDATE_FLOAT);
 $lon = ($lonRaw === '') ? null : filter_var($lonRaw, FILTER_VALIDATE_FLOAT);
 $coordsValid = ($latRaw === '' && $lonRaw === '') ||
   ($lat !== false && $lon !== false && $lat >= -90 && $lat <= 90 && $lon >= -180 && $lon <= 180);
 if($name && $country && $desc && filter_var($image,FILTER_VALIDATE_URL) && $coordsValid && (($latRaw === '') === ($lonRaw === ''))) {
  $s=$pdo->prepare("INSERT INTO destinations(name,country,city,description,image_url,best_time,travel_tips,latitude,longitude) VALUES(?,?,?,?,?,?,?,?,?)");
  $s->execute([$name,$country,$city,$desc,$image,trim($_POST['best_time']??''),trim($_POST['travel_tips']??''),$lat,$lon]);$notice="Destination added.";
 } else $notice="Enter the required details, a valid image URL, and either both valid coordinates or leave both coordinate fields blank.";
}
$places=$pdo->query("SELECT id,name,country FROM destinations ORDER BY id DESC")->fetchAll();
$page_title="Admin dashboard";include "header.php";
?>
<main class="page-wrap"><div class="page-intro"><span class="eyebrow">SITE MANAGEMENT</span><h1>Admin dashboard</h1><p>Add new destinations to WonderWorld.</p></div><?php if($notice): ?><p class="notice"><?= e($notice) ?></p><?php endif; ?><form class="admin-form" method="post"><label>Destination name<input name="name" required></label><label>Country<input name="country" required></label><label>City<input name="city"></label><label>Image URL<input type="url" name="image_url" required></label><label>Best time to visit<input name="best_time"></label><label>Latitude (optional)<input type="number" name="latitude" step="any" min="-90" max="90" placeholder="e.g. 27.1751"></label><label>Longitude (optional)<input type="number" name="longitude" step="any" min="-180" max="180" placeholder="e.g. 78.0421"></label><label class="full">Description<textarea name="description" rows="4" required></textarea></label><label class="full">Travel tips<textarea name="travel_tips" rows="3"></textarea></label><button class="btn">Add destination</button></form><h2>Existing destinations</h2><ul class="admin-list"><?php foreach($places as $p): ?><li><?= e($p['name']) ?> — <?= e($p['country']) ?></li><?php endforeach; ?></ul></main>
<?php include "footer.php"; ?>

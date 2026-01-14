<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
body { font-family: Arial, sans-serif; margin: 0; padding: 30px; color:#333; }
.header { text-align:center; border-bottom:2px solid #333; padding-bottom:20px; }
.header h1 { margin:0; font-size:24pt; }
.contact { text-align:center; font-size:10pt; margin:15px 0; }
.contact span { margin:0 10px; }
.contact img { width:12px; vertical-align:middle; margin-right:4px; }

.section-title {
    text-transform: uppercase;
    font-weight: bold;
    border-bottom: 1px solid #ddd;
    margin: 25px 0 10px;
}

.item { margin-bottom:15px; }
.item-head { display:flex; justify-content:space-between; font-weight:bold; }
.skill-list { columns:2; list-style:none; padding:0; }
</style>
</head>
<body>

<?php if(!empty($_FILES['profile_pic']['tmp_name'])):
$data = file_get_contents($_FILES['profile_pic']['tmp_name']);
$type = $_FILES['profile_pic']['type'];
?>
<img src="data:<?= $type ?>;base64,<?= base64_encode($data) ?>"
     style="width:120px;height:120px;border-radius:50%;display:block;margin:0 auto 15px;">
<?php endif; ?>

<div class="header">
    <h1><?= htmlspecialchars($_POST['firstname'].' '.$_POST['lastname']) ?></h1>
    <div><?= htmlspecialchars($_POST['job_title']) ?></div>
</div>

<div class="contact">
<?php if($_POST['email']): ?>
<span>
    <img src="<?= $iconEmail ?>" style="width:12px;vertical-align:middle;">
    <?= htmlspecialchars($_POST['email']) ?>
</span>
<?php endif; ?>

<?php if($_POST['phone']): ?>
<span>
    <img src="<?= $iconPhone ?>" style="width:12px;vertical-align:middle;">
    <?= htmlspecialchars($_POST['phone']) ?>
</span>
<?php endif; ?>

<?php if($_POST['address']): ?>
<span>
    <img src="<?= $iconLocation ?>" style="width:12px;vertical-align:middle;">
    <?= htmlspecialchars($_POST['address']) ?>
</span>
<?php endif; ?>

<?php if($_POST['about']): ?>
<div class="section-title">Profil</div>
<p><?= nl2br(htmlspecialchars($_POST['about'])) ?></p>
<?php endif; ?>

<?php if(!empty(array_filter($_POST['exp_company'] ?? []))): ?>
<div class="section-title">Expériences</div>
<?php foreach($_POST['exp_company'] as $i => $c):
if($c || $_POST['exp_title'][$i]): ?>
<div class="item">
    <div class="item-head">
        <span><?= htmlspecialchars($_POST['exp_title'][$i]) ?></span>
        <span><?= $_POST['exp_start'][$i] ?> - <?= $_POST['exp_end'][$i] ?: 'Présent' ?></span>
    </div>
    <em><?= htmlspecialchars($c) ?></em>
    <p><?= nl2br(htmlspecialchars($_POST['exp_description'][$i])) ?></p>
</div>
<?php endif; endforeach; ?>
<?php endif; ?>

<?php if(!empty(array_filter($_POST['skill_name'] ?? []))): ?>
<div class="section-title">Compétences</div>
<ul class="skill-list">
<?php foreach($_POST['skill_name'] as $i => $s):
if($s): ?>
<li><?= htmlspecialchars($s) ?> (<?= $_POST['skill_level'][$i] ?>)</li>
<?php endif; endforeach; ?>
</ul>
<?php endif; ?>

</body>
</html>

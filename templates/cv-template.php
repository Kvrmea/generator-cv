<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { font-family: sans-serif; margin: 0; padding: 0; color: #333; }

        .sidebar {
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 33%;
            background: #212529;
            color: white;
            padding: 30px 20px;
        }

        .main {
            margin-left: 33%;
            padding: 40px;
        }

        .photo-placeholder {
            width: 120px; height: 120px;
            background: #6c757d;
            border-radius: 50%;
            border: 3px solid white;
            margin: 0 auto 20px;
        }

        .name {
            text-transform: uppercase;
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .job {
            color: #0dcaf0;
            font-size: 11pt;
            margin-bottom: 30px;
        }

        .contact-title {
            text-transform: uppercase;
            border-bottom: 1px solid #444;
            padding-bottom: 5px;
            margin-top: 25px;
            font-size: 10pt;
            font-weight: bold;
        }

        .contact-item {
            font-size: 9pt;
            margin: 10px 0;
            display: flex;
            align-items: center;
        }

        .contact-icon {
            width: 14px;
            height: 14px;
            margin-right: 8px;
        }

        .section-title {
            text-transform: uppercase;
            font-weight: bold;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin: 30px 0 20px;
            font-size: 14pt;
        }

        .item { margin-bottom: 20px; }
        .item-header { font-weight: bold; font-size: 12pt; }
        .item-sub { color: #0d6efd; font-size: 10pt; }
        .item-date { float: right; font-size: 9pt; color: #6c757d; }
        .item-desc { font-size: 10pt; color: #555; margin-top: 5px; }

        .skill-item { margin-bottom: 15px; }
        .skill-name { font-size: 9pt; margin-bottom: 5px; }
        .progress-bg { background: rgba(255,255,255,0.2); height: 5px; border-radius: 3px; }
        .progress-bar { background: #0dcaf0; height: 5px; border-radius: 3px; }
    </style>
</head>
<body>

<?php

// $basePath = realpath(__DIR__ . '/../assets/images/') . '/';

// $iconEmail    = $basePath . 'email.png';
// $iconPhone    = $basePath . 'phone.png';
// $iconLocation = $basePath . 'location.png';

$photoData = '';
if (!empty($_FILES['profile_pic']['tmp_name'])) {
    $type = $_FILES['profile_pic']['type'];
    $data = file_get_contents($_FILES['profile_pic']['tmp_name']);
    $photoData = "data:$type;base64," . base64_encode($data);
}
?>

<div class="sidebar">
    <?php if ($photoData): ?>
        <div class="photo-placeholder" style="background-image:url('<?= $photoData ?>'); background-size:cover;"></div>
    <?php else: ?>
        <div class="photo-placeholder"></div>
    <?php endif; ?>

    <div class="name"><?= htmlspecialchars($_POST['firstname'].' '.$_POST['lastname']) ?></div>
    <div class="job"><?= htmlspecialchars($_POST['job_title']) ?></div>

    <div class="contact-title">Contact</div>

    <?php if(!empty($_POST['email'])): ?>
    <div class="contact-item">
        <img src="<?= $iconEmail ?>" class="contact-icon">
        <?= htmlspecialchars($_POST['email']) ?>
    </div>
    <?php endif; ?>

    <?php if(!empty($_POST['phone'])): ?>
    <div class="contact-item">
        <img src="<?= $iconPhone ?>" class="contact-icon">
        <?= htmlspecialchars($_POST['phone']) ?>
    </div>
    <?php endif; ?>

    <?php if(!empty($_POST['address'])): ?>
    <div class="contact-item">
        <img src="<?= $iconLocation ?>" class="contact-icon">
        <?= htmlspecialchars($_POST['address']) ?>
    </div>
    <?php endif; ?>

    <?php if(!empty(array_filter($_POST['skill_name'] ?? []))): ?>
        <div class="contact-title">Compétences</div>
        <?php foreach($_POST['skill_name'] as $i => $name):
            if($name):
                $lvl = $_POST['skill_level'][$i];
                $w = $lvl === 'Expert' ? '100%' : ($lvl === 'Intermédiaire' ? '60%' : '30%');
        ?>
        <div class="skill-item">
            <div class="skill-name"><?= htmlspecialchars($name) ?></div>
            <div class="progress-bg"><div class="progress-bar" style="width:<?= $w ?>"></div></div>
        </div>
        <?php endif; endforeach; ?>
    <?php endif; ?>
</div>

<div class="main">

<?php if(!empty($_POST['about'])): ?>
<div class="section-title">Profil</div>
<div class="item-desc"><?= nl2br(htmlspecialchars($_POST['about'])) ?></div>
<?php endif; ?>

<?php if(!empty(array_filter($_POST['exp_company'] ?? []))): ?>
<div class="section-title">Expériences</div>
<?php foreach($_POST['exp_company'] as $i => $c):
    if($c || $_POST['exp_title'][$i]):
?>
<div class="item">
    <span class="item-date"><?= $_POST['exp_start'][$i] ?> - <?= $_POST['exp_end'][$i] ?: 'Présent' ?></span>
    <div class="item-header"><?= htmlspecialchars($_POST['exp_title'][$i]) ?></div>
    <div class="item-sub"><?= htmlspecialchars($c) ?></div>
    <div class="item-desc"><?= nl2br(htmlspecialchars($_POST['exp_description'][$i])) ?></div>
</div>
<?php endif; endforeach; ?>
<?php endif; ?>

<?php if(!empty(array_filter($_POST['edu_school'] ?? []))): ?>
<div class="section-title">Formations</div>
<?php foreach($_POST['edu_school'] as $i => $s):
    if($s || $_POST['edu_degree'][$i]):
?>
<div class="item">
    <span class="item-date"><?= $_POST['edu_start'][$i] ?> - <?= $_POST['edu_end'][$i] ?></span>
    <div class="item-header"><?= htmlspecialchars($_POST['edu_degree'][$i]) ?></div>
    <div class="item-sub"><?= htmlspecialchars($s) ?></div>
</div>
<?php endif; endforeach; ?>
<?php endif; ?>

</div>
</body>
</html>

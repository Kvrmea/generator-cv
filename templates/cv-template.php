<?php
// On prépare les contenus
ob_start(); ?>
    <div class="photo-placeholder" style="background-image: url('<?= $userPhoto ?>');"></div>
    <div style="text-align:center; margin-bottom:20px; color: white;">
        <div style="font-size:18pt; font-weight:bold;"><?= strtoupper($firstname . ' ' . $lastname) ?></div>
        <div style="font-size:11pt; opacity:0.9;"><?= htmlspecialchars($_POST['job_title'] ?? '') ?></div>
    </div>
    <div class="section-title sidebar-title">Contact</div>
    <div class="contact-item"><img src="<?= $iconEmail ?>" width="10"> <?= htmlspecialchars($_POST['email'] ?? '') ?></div>
    <div class="contact-item"><img src="<?= $iconPhone ?>" width="10"> <?= htmlspecialchars($_POST['phone'] ?? '') ?></div>
    <div class="contact-item"><img src="<?= $iconLocation ?>" width="10"> <?= htmlspecialchars($_POST['address'] ?? '') ?></div>
    <?php if (!empty($_POST['skill_name'])): ?>
        <div class="section-title sidebar-title">Compétences</div>
        <?php foreach ($_POST['skill_name'] as $i => $name): if ($name): 
            $w = ($_POST['skill_level'][$i] === 'Expert' ? '100%' : ($_POST['skill_level'][$i] === 'Intermédiaire' ? '60%' : '30%')); ?>
            <div style="margin-bottom:8px;">
                <div style="font-size:8pt; color: white;"><?= htmlspecialchars($name) ?></div>
                <div class="skill-bar-bg"><div class="skill-bar-fill" style="width:<?= $w ?>;"></div></div>
            </div>
        <?php endif; endforeach; ?>
    <?php endif; ?>
<?php $sidebar_html = ob_get_clean();

ob_start(); ?>
    <div class="section-title">Profil</div>
    <p style="font-size:10pt; line-height:1.4;"><?= nl2br(htmlspecialchars($_POST['about'] ?? '')) ?></p>
    <?php $main_html = ob_get_clean(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        /* 1. RESET TOTAL POUR DOMPDF */
        @page { margin: 0; size: A4; }
        body { margin: 0; padding: 0; font-family: sans-serif; height: 297mm; }

        /* 2. LE TRUC MAGIQUE : L'arrière-plan de la sidebar */
        .sidebar-bg {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 33%;
            z-index: -1; /* Derrière le texte */
            background-color: <?= ($template === 'classic') ? $mainColor : '#212529' ?>;
            /* On force l'affichage de la couleur pour le PDF */
            height: 100%; 
        }

        /* 3. Placement du contenu */
        .container { width: 100%; position: relative; }
        
        .col-sidebar {
            width: 33%;
            float: <?= ($template === 'modern') ? 'left' : 'right' ?>;
            padding: 30px 20px;
            box-sizing: border-box;
        }

        .col-main {
            width: 67%;
            float: <?= ($template === 'modern') ? 'left' : 'right' ?>;
            padding: 40px;
            box-sizing: border-box;
            background-color: white;
        }

        /* Nettoyage du float */
        .clearfix::after { content: ""; clear: both; display: table; }

        /* Styles visuels */
        .section-title { border-bottom: 2px solid <?= $mainColor ?>; color: <?= $mainColor ?>; font-weight: bold; text-transform: uppercase; margin: 20px 0 10px; padding-bottom: 5px; }
        .sidebar-title { border-bottom-color: white; color: white; }
        .contact-item { font-size: 9pt; color: white; margin-bottom: 8px; }
        .skill-bar-bg { background: rgba(255,255,255,0.2); height: 6px; }
        .skill-bar-fill { background: white; height: 100%; }
        .photo-placeholder { width: 120px; height: 120px; border-radius: 50%; border: 3px solid white; margin: 0 auto 20px; background-size: cover; }
    </style>
</head>
<body>
    <div class="sidebar-bg" style="<?= ($template === 'classic') ? 'right:0;' : 'left:0;' ?>"></div>

    <div class="container clearfix">
        <?php if ($template === 'modern'): ?>
            <div class="col-sidebar"><?= $sidebar_html ?></div>
            <div class="col-main"><?= $main_html ?></div>
        <?php else: ?>
            <div class="col-main"><?= $main_html ?></div>
            <div class="col-sidebar"><?= $sidebar_html ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
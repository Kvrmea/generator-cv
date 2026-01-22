<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon CV - Classique</title>
    <style>
        /* Inclusion du fichier CSS externe pour le template classique */
        <?php include 'assets/css/cv-classic.css'; ?>

        /* Injection de la couleur dynamique */
        :root {
            --main-color: <?= $mainColor ?>;
        }

        /* Forçage pour Dompdf */
        .sidebar { background-color: var(--main-color); }
        .section-title { border-bottom-color: var(--main-color); }
    </style>
</head>
<body class="cv-classic-body">

<div class="wrapper">
    <div class="sidebar">
        <div class="photo-placeholder" 
             style="background-image: url('<?= $userPhoto ?>'); background-size: cover; background-position: center; width: 100px; height: 100px;">
        </div>

        <div class="contact">
            <div class="section-title" style="color: white; border-bottom-color: white;">Contact</div>
            
            <?php if(!empty($_POST['email'])): ?>
            <span><img src="<?= $iconEmail ?>" width="12"> <?= htmlspecialchars($_POST['email']) ?></span>
            <?php endif; ?>

            <?php if(!empty($_POST['phone'])): ?>
            <span><img src="<?= $iconPhone ?>" width="12"> <?= htmlspecialchars($_POST['phone']) ?></span>
            <?php endif; ?>

            <?php if(!empty($_POST['address'])): ?>
            <span><img src="<?= $iconLocation ?>" width="12"> <?= htmlspecialchars($_POST['address']) ?></span>
            <?php endif; ?>
        </div>

        <?php if(!empty(array_filter($_POST['skill_name'] ?? []))): ?>
        <div class="section" style="margin-top: 30px;">
            <div class="section-title" style="color: white; border-bottom-color: white;">Compétences</div>
            <?php foreach($_POST['skill_name'] as $i => $name): 
                if(!empty($name)): ?>
                <div style="margin-bottom: 5px; font-size: 10pt;">
                    <?= htmlspecialchars($name) ?> (<?= htmlspecialchars($_POST['skill_level'][$i]) ?>)
                </div>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="content">
        <h1><?= htmlspecialchars($_POST['firstname']) ?> <?= htmlspecialchars($_POST['lastname']) ?></h1>
        <div class="job" style="color: var(--main-color);"><?= htmlspecialchars($_POST['job_title']) ?></div>

        <?php if(!empty($_POST['about'])): ?>
        <div class="section">
            <div class="section-title">Profil</div>
            <p><?= nl2br(htmlspecialchars($_POST['about'])) ?></p>
        </div>
        <?php endif; ?>

        <?php if(!empty(array_filter($_POST['exp_company'] ?? []))): ?>
        <div class="section">
            <div class="section-title">Expériences</div>
            <?php foreach($_POST['exp_company'] as $i => $comp):
                if(!empty($comp) || !empty($_POST['exp_title'][$i])): ?>
                <div class="item">
                    <div class="item-title"><?= htmlspecialchars($_POST['exp_title'][$i]) ?></div>
                    <div class="dates"><?= $_POST['exp_start'][$i] ?> - <?= $_POST['exp_end'][$i] ?: 'Présent' ?></div>
                    <div style="font-style: italic;"><?= htmlspecialchars($comp) ?></div>
                    <p><?= nl2br(htmlspecialchars($_POST['exp_description'][$i])) ?></p>
                </div>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if(!empty(array_filter($_POST['edu_school'] ?? []))): ?>
        <div class="section">
            <div class="section-title">Formations</div>
            <?php foreach($_POST['edu_school'] as $i => $school):
                if(!empty($school) || !empty($_POST['edu_degree'][$i])): ?>
                <div class="item">
                    <div class="item-title"><?= htmlspecialchars($_POST['edu_degree'][$i]) ?></div>
                    <div class="dates"><?= $_POST['edu_start'][$i] ?> - <?= $_POST['edu_end'][$i] ?></div>
                    <div><?= htmlspecialchars($school) ?></div>
                </div>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
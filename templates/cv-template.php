<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon CV</title>
    <style>
        <?php include 'assets/css/cv-modern.css'; ?>

        :root {
            --main-color: <?= $mainColor ?>;
        }

        /* Forçage de la couleur sur les éléments spécifiques (pour Dompdf) */
        .job { color: var(--main-color); }
        .section-title { border-bottom-color: var(--main-color); }
        .progress-bar { background-color: var(--main-color); }
    </style>
</head>
<body class="cv-body">

<div class="sidebar">
    <div class="photo-placeholder" 
         style="background-image: url('<?= $userPhoto ?>'); background-size: cover; background-position: center;">
    </div>

    <div class="name"><?= htmlspecialchars($_POST['firstname']) ?> <?= htmlspecialchars($_POST['lastname']) ?></div>
    <div class="job"><?= htmlspecialchars($_POST['job_title']) ?></div>

    <div class="contact-title">Contact</div>
    
    <?php if(!empty($_POST['email'])): ?>
    <div class="contact-item">
        <img src="<?= $iconEmail ?>" class="contact-icon"> <?= htmlspecialchars($_POST['email']) ?>
    </div>
    <?php endif; ?>

    <?php if(!empty($_POST['phone'])): ?>
    <div class="contact-item">
        <img src="<?= $iconPhone ?>" class="contact-icon"> <?= htmlspecialchars($_POST['phone']) ?>
    </div>
    <?php endif; ?>

    <?php if(!empty($_POST['address'])): ?>
    <div class="contact-item">
        <img src="<?= $iconLocation ?>" class="contact-icon"> <?= htmlspecialchars($_POST['address']) ?>
    </div>
    <?php endif; ?>

    <?php if(!empty(array_filter($_POST['skill_name'] ?? []))): ?>
    <div class="contact-title">Compétences</div>
    <?php foreach($_POST['skill_name'] as $i => $name): 
        if(!empty($name)):
            $level = $_POST['skill_level'][$i];
            $w = ($level === 'Expert') ? '100%' : (($level === 'Intermédiaire') ? '60%' : '30%');
    ?>
        <div class="skill-item">
            <div class="skill-name"><?= htmlspecialchars($name) ?></div>
            <div class="progress-bg">
                <div class="progress-bar" style="width: <?= $w ?>;"></div>
            </div>
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
    <?php foreach($_POST['exp_company'] as $i => $comp):
        if(!empty($comp) || !empty($_POST['exp_title'][$i])):
    ?>
    <div class="item">
        <span class="item-date"><?= $_POST['exp_start'][$i] ?> - <?= $_POST['exp_end'][$i] ?: 'Présent' ?></span>
        <div class="item-header"><?= htmlspecialchars($_POST['exp_title'][$i]) ?></div>
        <div class="item-sub"><?= htmlspecialchars($comp) ?></div>
        <div class="item-desc"><?= nl2br(htmlspecialchars($_POST['exp_description'][$i])) ?></div>
    </div>
    <?php endif; endforeach; ?>
    <?php endif; ?>

    <?php if(!empty(array_filter($_POST['edu_school'] ?? []))): ?>
    <div class="section-title">Formations</div>
    <?php foreach($_POST['edu_school'] as $i => $school):
        if(!empty($school) || !empty($_POST['edu_degree'][$i])):
    ?>
    <div class="item">
        <span class="item-date"><?= $_POST['edu_start'][$i] ?> - <?= $_POST['edu_end'][$i] ?></span>
        <div class="item-header"><?= htmlspecialchars($_POST['edu_degree'][$i]) ?></div>
        <div class="item-sub"><?= htmlspecialchars($school) ?></div>
    </div>
    <?php endif; endforeach; ?>
    <?php endif; ?>

</div>

</body>
</html>
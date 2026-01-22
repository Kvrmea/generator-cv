<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer mon CV - CV Generator</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

<div class="container-fluid p-0">
    <div class="row g-0 main-row">
        
        <div class="col-md-6 form-column p-4 p-lg-5">
            <a href="index.php" class="btn btn-outline-secondary btn-sm mb-4">← Retour</a>
            
            <form id="cv-form" action="export.php" method="POST" enctype="multipart/form-data">
                <div class="card card-body shadow-sm mb-4 border-0">
                    <h5 class="fw-bold mb-3">Personnalisation</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Template</label>
                            <select name="template_choice" id="template-choice" class="form-select">
                                <option value="modern">Moderne (Sidebar gauche)</option>
                                <option value="classic">Classique (Sidebar droite colorée)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Typographie</label>
                            <select name="font_choice" id="font-choice" class="form-select">
                                <option value="'Segoe UI', sans-serif">Standard</option>
                                <option value="'Montserrat', sans-serif">Montserrat</option>
                                <option value="'Playfair Display', serif">Playfair (Élégant)</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Couleur principale</label>
                            <input type="color" name="main_color" id="main-color" value="#0dcaf0" class="form-control form-control-color w-100">
                        </div>
                    </div>
                </div>

                <div class="card card-body shadow-sm mb-4 border-0">
                    <h5 class="fw-bold mb-3">Informations Personnelles</h5>
                    <div class="row g-3">
                        <div class="col-md-12 mb-2">
                            <label class="form-label fw-bold">Photo de profil</label>
                            <input type="file" name="profile_pic" id="in-photo" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6"><label class="form-label">Nom</label><input type="text" name="lastname" id="in-lastname" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Prénom</label><input type="text" name="firstname" id="in-firstname" class="form-control" required></div>
                        <div class="col-md-12"><label class="form-label">Titre du CV</label><input type="text" name="job_title" id="in-job" class="form-control"></div>
                        <div class="col-md-12"><label class="form-label">Email</label><input type="email" name="email" id="in-email" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Téléphone</label><input type="text" name="phone" id="in-phone" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Adresse</label><input type="text" name="address" id="in-address" class="form-control"></div>
                        <div class="col-md-12"><label class="form-label">À propos</label><textarea name="about" id="in-about" class="form-control" rows="3"></textarea></div>
                    </div>
                </div>

                <div id="experience-list"></div>
                <button type="button" id="add-experience" class="btn btn-outline-primary mb-3 w-100">+ Expérience</button>
                <div id="education-list"></div>
                <button type="button" id="add-education" class="btn btn-outline-primary mb-3 w-100">+ Formation</button>
                <div id="skill-list"></div>
                <button type="button" id="add-skill" class="btn btn-outline-primary mb-5 w-100">+ Compétence</button>

                <div class="sticky-bottom bg-light py-3 border-top">
                    <button type="submit" class="btn btn-success btn-lg w-100 shadow">Générer le PDF</button>
                </div>

                </form>
        </div>

        <div class="col-md-6 d-none d-md-block preview-container">
            <div id="cv-preview">
                <div class="sidebar">
                    <div id="preview-photo" class="photo-placeholder"></div>
                    <div class="name" id="out-fullname">PRÉNOM NOM</div>
                    <div class="job" id="out-job">TITRE DU POSTE</div>
                    <div class="contact-title">Contact</div>
                    <div class="contact-item"><i class="bi bi-envelope"></i> <span id="out-email"></span></div>
                    <div class="contact-item"><i class="bi bi-telephone"></i> <span id="out-phone"></span></div>
                    <div class="contact-item"><i class="bi bi-geo-alt"></i> <span id="out-address"></span></div>
                    <div id="preview-skill-section"></div>
                </div>
                <div class="main">
                    <div id="preview-about-section"></div>
                    <div id="preview-exp-section"></div>
                    <div id="preview-edu-section"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/form.js"></script>
</body>
</html>
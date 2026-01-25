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
                        <div class="col-md-12"><label class="form-label">Titre du CV</label><input type="text" name="job_title" id="in-job" class="form-control" placeholder="ex: Développeur Web Fullstack"></div>
                        <div class="col-md-12"><label class="form-label">Email</label><input type="email" name="email" id="in-email" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Téléphone</label><input type="text" name="phone" id="in-phone" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Adresse</label><input type="text" name="address" id="in-address" class="form-control"></div>
                        <div class="col-md-12"><label class="form-label">À propos</label><textarea name="about" id="in-about" class="form-control" rows="3"></textarea></div>
                    </div>
                </div>

                <div id="experience-list"></div>
                <button type="button" class="btn btn-outline-primary mb-3 w-100 btn-add" data-template="experience-template" data-list="experience-list">+ Expérience</button>

                <div id="education-list"></div>
                <button type="button" class="btn btn-outline-primary mb-3 w-100 btn-add" data-template="education-template" data-list="education-list">+ Formation</button>

                <div id="skill-list"></div>
                <button type="button" class="btn btn-outline-primary mb-5 w-100 btn-add" data-template="skill-template" data-list="skill-list">+ Compétence</button>

                <div class="sticky-bottom bg-light py-3 border-top">
                    <button type="submit" class="btn btn-success btn-lg w-100 shadow">Générer le PDF</button>
                </div>

                <template id="experience-template">
                    <div class="card card-body mb-3 border-0 shadow-sm position-relative">
                        <button type="button" class="btn-close remove-btn position-absolute top-0 end-0 m-2"></button>
                        <div class="row g-2">
                            <div class="col-md-6"><label class="small fw-bold">Entreprise</label><input type="text" name="exp_company[]" class="form-control form-control-sm"></div>
                            <div class="col-md-6"><label class="small fw-bold">Poste</label><input type="text" name="exp_title[]" class="form-control form-control-sm"></div>
                            <div class="col-md-6"><label class="small fw-bold">Début</label><input type="text" name="exp_start[]" class="form-control form-control-sm" placeholder="MM/AAAA"></div>
                            <div class="col-md-6"><label class="small fw-bold">Fin</label><input type="text" name="exp_end[]" class="form-control form-control-sm" placeholder="MM/AAAA"></div>
                            <div class="col-12"><label class="small fw-bold">Description</label><textarea name="exp_description[]" class="form-control form-control-sm" rows="2"></textarea></div>
                        </div>
                    </div>
                </template>

                <template id="education-template">
                    <div class="card card-body mb-3 border-0 shadow-sm position-relative">
                        <button type="button" class="btn-close remove-btn position-absolute top-0 end-0 m-2"></button>
                        <div class="row g-2">
                            <div class="col-md-6"><label class="small fw-bold">École / Université</label><input type="text" name="edu_school[]" class="form-control form-control-sm"></div>
                            <div class="col-md-6"><label class="small fw-bold">Diplôme</label><input type="text" name="edu_degree[]" class="form-control form-control-sm"></div>
                            <div class="col-md-6"><label class="small fw-bold">Début</label><input type="text" name="edu_start[]" class="form-control form-control-sm"></div>
                            <div class="col-md-6"><label class="small fw-bold">Fin</label><input type="text" name="edu_end[]" class="form-control form-control-sm"></div>
                        </div>
                    </div>
                </template>

                <template id="skill-template">
                    <div class="card card-body mb-2 border-0 shadow-sm position-relative">
                        <div class="row g-2 align-items-end">
                            <div class="col-6"><label class="small fw-bold">Compétence</label><input type="text" name="skill_name[]" class="form-control form-control-sm"></div>
                            <div class="col-4">
                                <label class="small fw-bold">Niveau</label>
                                <select name="skill_level[]" class="form-select form-select-sm">
                                    <option value="Débutant">Débutant</option>
                                    <option value="Intermédiaire">Intermédiaire</option>
                                    <option value="Expert">Expert</option>
                                </select>
                            </div>
                            <div class="col-2"><button type="button" class="btn btn-outline-danger btn-sm remove-btn w-100"><i class="bi bi-trash"></i></button></div>
                        </div>
                    </div>
                </template>
            </form>
        </div>

        <div class="col-md-6 d-none d-md-block preview-container">
            <div id="cv-preview">
                <div class="cv-container">
                    <div class="cv-row">
                        <div class="cv-sidebar ltr-content">
                            <div class="photo-placeholder"></div>
                            
                            <div style="text-align:center; margin-bottom:30px;">
                                <div id="out-fullname" style="font-size:18pt; font-weight:bold;">PRÉNOM NOM</div>
                                <div id="out-job" style="font-size:11pt; opacity:0.9;">TITRE DU POSTE</div>
                            </div>

                            <div class="section-title sidebar-title">Contact</div>
                            <div class="contact-item">
                                <i class="bi bi-envelope-fill contact-icon"></i> <span id="out-email-text">email@exemple.com</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-telephone-fill contact-icon"></i> <span id="out-phone-text"></span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-geo-alt-fill contact-icon"></i> <span id="out-address-text"></span>
                            </div>

                            <div id="preview-skill-section"></div>
                        </div>

                        <div class="cv-main ltr-content">
                            <div id="preview-about-section"></div>
                            <div id="preview-exp-section"></div>
                            <div id="preview-edu-section"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/form.js"></script>
</body>
</html>
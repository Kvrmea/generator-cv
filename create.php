<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer mon CV - CV Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body, html {
            height: 100%;
            overflow-x: hidden;
        }

        .main-row {
            height: 100vh;
        }

        .form-column {
            height: 100vh;
            overflow-y: auto;
            padding-bottom: 50px;
        }

        .preview-container {
            background: gray;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            overflow-y: auto;
        }

        #cv-preview {
            background: white;
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            transform-origin: top center;
            zoom: 0.6;
        }

        @media (max-width: 768px) {
            #cv-preview {
                width: 100%;
                zoom: 1;
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid p-0">
    <div class="row g-0 main-row">
        
        <div class="col-md-6 form-column p-4 p-lg-5">
            <a href="index.php" class="btn btn-outline-secondary btn-sm mb-4">← Retour</a>
            
            <form id="cv-form" action="export.php" method="POST" enctype="multipart/form-data">
                
                <div class="card card-body shadow-sm mb-4 border-0">
                    <h5 class="fw-bold mb-3">Choix du Design</h5>
                    <select name="template_choice" id="template-choice" class="form-select">
                        <option value="modern">Moderne (Sidebar sombre)</option>
                        <option value="classic">Classique (Épuré)</option>
                    </select>
                </div>

                <div class="card card-body shadow-sm mb-4 border-0">
                    <h5 class="fw-bold mb-3">Informations Personnelles</h5>
                    <div class="row g-3">
                        <div class="col-md-12 mb-2">
                            <label class="form-label fw-bold">Photo de profil</label>
                            <input type="file" name="profile_pic" id="in-photo" class="form-control" accept="image/*">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nom</label>
                            <input type="text" name="lastname" id="in-lastname" class="form-control" placeholder="Ex: Munoz">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Prénom</label>
                            <input type="text" name="firstname" id="in-firstname" class="form-control" placeholder="Ex: Hugo">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Métier / Titre du CV</label>
                            <input type="text" name="job_title" id="in-job" class="form-control" placeholder="Ex: Développeur Web">
                        </div>
                    </div>
                </div>

                <div class="card card-body shadow-sm mb-4 border-0">
                    <h5 class="fw-bold mb-3">Coordonnées & Introduction</h5>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" id="in-email" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Téléphone</label><input type="text" name="phone" id="in-phone" class="form-control"></div>
                        <div class="col-md-12"><label class="form-label">Adresse</label><input type="text" name="address" id="in-address" class="form-control"></div>
                        <div class="col-md-12"><label class="form-label">À propos de moi</label><textarea name="about" id="in-about" class="form-control" rows="3"></textarea></div>
                    </div>
                </div>

                <h5 class="fw-bold mb-3">Expériences</h5>
                <div id="experience-list"></div>
                <button type="button" id="add-experience" class="btn btn-outline-primary mb-4 w-100">+ Ajouter une expérience</button>

                <h5 class="fw-bold mb-3">Formations</h5>
                <div id="education-list"></div>
                <button type="button" id="add-education" class="btn btn-outline-primary mb-4 w-100">+ Ajouter une formation</button>

                <h5 class="fw-bold mb-3">Compétences</h5>
                <div id="skill-list"></div>
                <button type="button" id="add-skill" class="btn btn-outline-primary w-100 mb-5">+ Ajouter une compétence</button>

                <div class="sticky-bottom bg-light py-3 border-top">
                    <button type="submit" class="btn btn-success btn-lg w-100 shadow">Générer mon CV en PDF</button>
                </div>

                <template id="experience-template">
                    <div class="card card-body shadow-sm mb-3 experience-item border-0">
                        <div class="row g-3">
                            <div class="col-md-6"><input type="text" name="exp_company[]" class="form-control" placeholder="Entreprise"></div>
                            <div class="col-md-6"><input type="text" name="exp_title[]" class="form-control" placeholder="Poste"></div>
                            <div class="col-md-6"><input type="month" name="exp_start[]" class="form-control"></div>
                            <div class="col-md-6"><input type="month" name="exp_end[]" class="form-control"></div>
                            <div class="col-md-12"><textarea name="exp_description[]" class="form-control" rows="3" placeholder="Description..."></textarea></div>
                            <button type="button" class="btn btn-sm btn-link text-danger remove-btn text-end">Supprimer</button>
                        </div>
                    </div>
                </template>

                <template id="education-template">
                    <div class="card card-body shadow-sm mb-3 education-item border-0">
                        <div class="row g-3">
                            <div class="col-md-6"><input type="text" name="edu_school[]" class="form-control" placeholder="École"></div>
                            <div class="col-md-6"><input type="text" name="edu_degree[]" class="form-control" placeholder="Diplôme"></div>
                            <div class="col-md-6"><input type="month" name="edu_start[]" class="form-control"></div>
                            <div class="col-md-6"><input type="month" name="edu_end[]" class="form-control"></div>
                            <button type="button" class="btn btn-sm btn-link text-danger remove-btn text-end">Supprimer</button>
                        </div>
                    </div>
                </template>

                <template id="skill-template">
                    <div class="card card-body shadow-sm mb-3 skill-item border-0">
                        <div class="row g-3 align-items-center">
                            <div class="col-7"><input type="text" name="skill_name[]" class="form-control" placeholder="Compétence"></div>
                            <div class="col-5">
                                <select name="skill_level[]" class="form-select">
                                    <option value="Débutant">Débutant</option>
                                    <option value="Intermédiaire">Intermédiaire</option>
                                    <option value="Expert">Expert</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-sm btn-link text-danger remove-btn text-end">Supprimer</button>
                        </div>
                    </div>
                </template>
            </form>
        </div>

        <div class="col-md-6 d-none d-md-block preview-container">
            <div id="cv-preview" class="rounded shadow-lg p-0 border-0">
                <div class="row g-0 h-100">
                    <div class="col-4 bg-dark text-white p-4" style="min-height: 297mm;">
                        <div class="text-center mb-4">
                            <div id="preview-photo" class="rounded-circle bg-secondary d-inline-block" style="width: 100px; height: 100px; border: 3px solid white; background-size: cover; background-position: center;"></div>
                        </div>
                        <div class="mb-4">
                            <h2 id="out-fullname" class="h4 fw-bold mb-1 text-uppercase">Nom Prénom</h2>
                            <p id="out-job" class="small text-info opacity-75">Titre du poste</p>
                        </div>
                        <!-- <div id="preview-contact-section"></div> -->
                         <div id="preview-contact-section" class="mb-4 small">

                            <div class="d-flex align-items-start mb-2">
                                <span class="me-2">
                                    <!-- EMAIL -->
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v.217L8 8.414.002 4.217V4z"/>
                                        <path d="M0 4.697v7.104l5.803-3.558L0 4.697z"/>
                                        <path d="M6.761 8.83l-6.761 4.146A2 2 0 0 0 2 14h12a2 2 0 0 0 1.999-1.024l-6.76-4.146L8 9.586l-1.239-.757z"/>
                                        <path d="M16 4.697l-5.803 3.546L16 11.801V4.697z"/>
                                    </svg>
                                </span>
                                <span id="out-email">email@email.com</span>
                            </div>

                            <div class="d-flex align-items-start mb-2">
                                <span class="me-2">
                                    <!-- TÉLÉPHONE -->
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 1 .737-.166l2.79 1.186c.329.14.445.515.27.833l-1.272 2.27a.678.678 0 0 1-.746.314l-1.02-.255a11.42 11.42 0 0 0 5.516 5.516l.255-1.02a.678.678 0 0 1 .314-.746l2.27-1.272a.678.678 0 0 1 .833.27l1.186 2.79a.678.678 0 0 1-.166.737l-2.29 2.29c-.329.329-.82.44-1.222.27-2.985-1.24-5.45-3.705-6.69-6.69-.17-.402-.06-.893.27-1.222l2.29-2.29z"/>
                                    </svg>
                                </span>
                                <span id="out-phone">06 00 00 00 00</span>
                            </div>

                            <div class="d-flex align-items-start">
                                <span class="me-2">
                                    <!-- LOCALISATION -->
                                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 0a5 5 0 0 0-5 5c0 3.25 5 11 5 11s5-7.75 5-11a5 5 0 0 0-5-5zm0 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                                    </svg>
                                </span>
                                <span id="out-address">Ville, Pays</span>
                            </div>

                        </div>

                        <div id="preview-skill-section" class="mt-4"></div>
                    </div>
                    <div class="col-8 bg-white p-5">
                        <div id="preview-about-section" class="mb-4"></div>
                        <div id="preview-exp-section" class="mb-5"></div>
                        <div id="preview-edu-section"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="assets/js/form.js"></script>
</body>
</html>
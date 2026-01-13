<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer mon CV - CV Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background: #e9ecef;
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
            <h2 class="fw-bold mb-4">Informations Personnelles</h2>
            
            <form id="cv-form" action="export.php" method="POST">
                <div class="card card-body shadow-sm mb-4 border-0">
                    <div class="row g-3">
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
                            <input type="text" name="job_title" id="in-job" class="form-control" placeholder="Ex: Développeur Web Fullstack">
                        </div>
                    </div>
                </div>

                <div class="card card-body shadow-sm mb-4 border-0">
                    <h5 class="fw-bold mb-3">Coordonnées & À propos</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="in-email" class="form-control" placeholder="exemple@mail.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="phone" id="in-phone" class="form-control" placeholder="06 00 00 00 00">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Adresse</label>
                            <input type="text" name="address" id="in-address" class="form-control" placeholder="Paris, France">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">À propos de moi</label>
                            <textarea name="about" id="in-about" class="form-control" rows="3" placeholder="Brève présentation..."></textarea>
                        </div>
                    </div>
                </div>

                <h2 class="fw-bold mb-4 mt-5">Expériences professionnelles</h2>
                <div id="experience-list"></div>
                <button type="button" id="add-experience" class="btn btn-outline-primary mb-4 w-100">+ Ajouter une expérience</button>

                <h2 class="fw-bold mb-4 mt-4">Formations & Diplômes</h2>
                <div id="education-list"></div>
                <button type="button" id="add-education" class="btn btn-outline-primary mb-5 w-100">+ Ajouter une formation</button>

                <h2 class="fw-bold mb-4 mt-4">Compétences</h2>
                <div id="skill-list"></div>
                <button type="button" id="add-skill" class="btn btn-outline-primary w-100 mb-5">+ Ajouter une compétence</button>

                <div class="sticky-bottom bg-light py-3 border-top">
                    <button type="submit" class="btn btn-success btn-lg w-100 shadow">Générer mon CV en PDF</button>
                </div>

                <template id="experience-template">
                    <div class="card card-body shadow-sm mb-3 experience-item border-0">
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Entreprise</label><input type="text" name="exp_company[]" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Poste</label><input type="text" name="exp_title[]" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Date de début</label><input type="month" name="exp_start[]" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Date de fin</label><input type="month" name="exp_end[]" class="form-control"></div>
                            <div class="col-md-12"><label class="form-label">Description</label><textarea name="exp_description[]" class="form-control" rows="3"></textarea></div>
                            <div class="col-md-12 text-end"><button type="button" class="btn btn-sm btn-link text-danger remove-btn">Supprimer</button></div>
                        </div>
                    </div>
                </template>

                <template id="education-template">
                    <div class="card card-body shadow-sm mb-3 education-item border-0">
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Établissement</label><input type="text" name="edu_school[]" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Diplôme</label><input type="text" name="edu_degree[]" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Début</label><input type="month" name="edu_start[]" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Fin</label><input type="month" name="edu_end[]" class="form-control"></div>
                            <div class="col-md-12 text-end"><button type="button" class="btn btn-sm btn-link text-danger remove-btn">Supprimer</button></div>
                        </div>
                    </div>
                </template>

                <template id="skill-template">
                    <div class="card card-body shadow-sm mb-3 skill-item border-0">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-7"><input type="text" name="skill_name[]" class="form-control" placeholder="Ex: JavaScript"></div>
                            <div class="col-md-5">
                                <select name="skill_level[]" class="form-select">
                                    <option value="">Niveau</option>
                                    <option value="Débutant">Débutant</option>
                                    <option value="Intermédiaire">Intermédiaire</option>
                                    <option value="Expert">Expert</option>
                                </select>
                            </div>
                            <div class="col-12 text-end"><button type="button" class="btn btn-sm btn-link text-danger remove-btn">Supprimer</button></div>
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
                            <div class="rounded-circle bg-secondary d-inline-block" style="width: 100px; height: 100px; border: 3px solid white;"></div>
                        </div>
                        <div class="mb-5">
                            <h2 id="out-fullname" class="h4 fw-bold mb-1 text-uppercase">Nom Prénom</h2>
                            <p id="out-job" class="small text-info opacity-75">Titre du poste</p>
                        </div>
                        <div id="preview-contact-section"></div>
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
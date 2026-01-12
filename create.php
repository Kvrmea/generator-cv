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
            zoom: 0.7;
            margin-left: 10%;

            /* transform: scale(0.70); */
        }

        .btn-outline-secondary {
        transition: 0.2s ease-in-out;
        }


        .btn-outline-secondary:hover { 
            background-color: #2575fc;
            color: white; 
            border-color: #2575fc; 
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

                <h2 class="fw-bold mb-4 mt-5">Expériences professionnelles</h2>
                <div id="experience-list">
                    </div>
                <button type="button" id="add-experience" class="btn btn-outline-primary mb-4 w-100">
                    + Ajouter une expérience
                </button>

                <h2 class="fw-bold mb-4 mt-4">Formations & Diplômes</h2>
                <div id="education-list">
                    </div>
                <button type="button" id="add-education" class="btn btn-outline-primary mb-5 w-100">
                    + Ajouter une formation
                </button>

                <div class="sticky-bottom bg-light py-3 border-top">
                    <button type="submit" class="btn btn-success btn-lg w-100 shadow">Générer mon CV en PDF</button>
                </div>

                <template id="experience-template">
                    <div class="card card-body shadow-sm mb-3 experience-item border-0">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Entreprise</label>
                                <input type="text" name="exp_company[]" class="form-control exp-input" placeholder="Ex: Google">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Poste</label>
                                <input type="text" name="exp_title[]" class="form-control exp-input" placeholder="Ex: Développeur">
                            </div>
                            <div class="col-md-12 text-end">
                                <button type="button" class="btn btn-sm btn-link text-danger remove-btn">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </template>

                <template id="education-template">
                    <div class="card card-body shadow-sm mb-3 education-item border-0">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">École / Université</label>
                                <input type="text" name="edu_school[]" class="form-control edu-input" placeholder="Ex: Epitech">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Diplôme</label>
                                <input type="text" name="edu_degree[]" class="form-control edu-input" placeholder="Ex: Master">
                            </div>
                            <div class="col-md-12 text-end">
                                <button type="button" class="btn btn-sm btn-link text-danger remove-btn">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </template>

            </form>
        </div>

        <div class="col-md-6 d-none d-md-block preview-container">
            <div id="cv-preview" class="rounded">
                <h1 id="out-fullname" class="fw-bold" style="color: #2575fc; margin-bottom: 5px;">Nom Prénom</h1>
                <p id="out-job" class="fs-4 text-muted mb-4">Titre du poste</p>
                
                <div id="preview-exp-section" class="mt-4"></div>
                <div id="preview-edu-section" class="mt-4"></div>
            </div>
        </div>

    </div>
</div>

<script src="assets/js/form.js"></script>
</body>
</html>
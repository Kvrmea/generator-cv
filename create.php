<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer mon CV - CV Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .preview-container {
            background: #e9ecef;
            padding: 20px;
            min-height: 100vh;
            position: sticky;
            top: 0;
        }
        #cv-preview {
            background: white;
            width: 210mm; /* Largeur A4 */
            min-height: 297mm; /* Hauteur A4 */
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 p-4">
            <h2 class="mb-4">Informations Personnelles</h2>
            
            <form id="cv-form" action="export.php" method="POST">
                <div class="card card-body shadow-sm mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" name="lastname" id="in-lastname" class="form-control" placeholder="Munoz">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="firstname" id="in-firstname" class="form-control" placeholder="Hugo">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Métre / Titre du CV</label>
                            <input type="text" name="job_title" id="in-job" class="form-control" placeholder="Développeur Web Fullstack">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100">Générer mon PDF</button>
            </form>
        </div>

        <div class="col-md-6 d-none d-md-block preview-container">
            <h2 class="text-center mb-4">Aperçu en direct</h2>
            <div id="cv-preview">
                <h1 id="out-fullname" style="color: #2575fc;">Nom Prénom</h1>
                <p id="out-job" class="lead text-muted">Titre du poste</p>
                <hr>
                </div>
        </div>
    </div>
</div>

<script src="assets/js/form.js"></script>
</body>
</html>
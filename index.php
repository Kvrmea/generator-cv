<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Generator - Créez votre CV professionnel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .hero-section {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 100px 0;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }
        .btn-start {
            padding: 15px 40px;
            font-size: 1.2rem;
            border-radius: 30px;
            transition: transform 0.3s;
        }
        .btn-start:hover { transform: scale(1.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="index.php">📄 CV Generator</a>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container text-center text-md-start">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h1 class="display-3 fw-bold mb-4">Créez votre CV pro en quelques minutes.</h1>
                    <p class="lead mb-5">Un outil simple pour générer un CV élégant, moderne et prêt à l'emploi au format PDF. Pas d'inscription requise.</p>
                    <a href="create.php" class="btn btn-light text-primary fw-bold btn-start shadow">
                        Créer mon CV maintenant
                    </a>
                </div>
                <div class="col-md-5 d-none d-md-block">
                    <div class="text-center">
                        <span style="font-size: 10rem;">📝</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <footer class="py-4 text-center text-muted">
        <small>&copy; 2025 CV Generator - Projet Epitech by Hugo Munoz</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
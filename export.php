<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sécurisation et récupération des données
    $firstname = $_POST['firstname'] ?? '';
    $lastname  = $_POST['lastname']  ?? '';
    $template  = $_POST['template_choice'] ?? 'modern';
    $mainColor = $_POST['main_color'] ?? '#0dcaf0';

    if ($firstname === '' || $lastname === '') {
        die('Le prénom et le nom sont obligatoires.');
    }
    
    try {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Gestion des Icônes en Base64
        function iconBase64($path) {
            if (!file_exists($path)) return '';
            $type = mime_content_type($path);
            $data = file_get_contents($path);
            return "data:$type;base64," . base64_encode($data);
        }

        $iconEmail    = iconBase64(__DIR__ . '/assets/images/email.png');
        $iconPhone    = iconBase64(__DIR__ . '/assets/images/phone.png');
        $iconLocation = iconBase64(__DIR__ . '/assets/images/location.png'); 

        // Gestion de la Photo de profil
        $userPhoto = ''; 
        if (!empty($_FILES['profile_pic']['tmp_name'])) {
            $type = $_FILES['profile_pic']['type'];
            $data = file_get_contents($_FILES['profile_pic']['tmp_name']);
            $userPhoto = "data:$type;base64," . base64_encode($data);
        }

        // Génération du HTML via le template
        ob_start();
        // if ($template === 'classic') {
        //     include 'templates/cv-template-classic.php';
        // } else {
        //     include 'templates/cv-template.php';
        // }
        include 'templates/cv-template.php';
        $html = ob_get_clean();

        // Rendu PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $fileName = "CV_" . strtoupper($lastname) . "_" . ucfirst($firstname) . ".pdf";
        $dompdf->stream($fileName, ["Attachment" => false]);
        
    } catch (Exception $e) {
        error_log("Erreur PDF : " . $e->getMessage());
        die("Erreur lors de la génération du PDF.");
    }
} else {
    echo "Méthode non autorisée.";
}
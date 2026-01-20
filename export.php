<?php
// Activer l'affichage des erreurs pour le debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Securisation des données
     $_POST['firstname']   = $_POST['firstname']   ?? '';
    $_POST['lastname']    = $_POST['lastname']    ?? '';
    $_POST['job_title']   = $_POST['job_title']   ?? '';
    $_POST['email']       = $_POST['email']       ?? '';
    $_POST['phone']       = $_POST['phone']       ?? '';
    $_POST['address']     = $_POST['address']     ?? '';
    $_POST['about']       = $_POST['about']       ?? '';
    $_POST['template_choice'] = $_POST['template_choice'] ?? 'modern';

    $_POST['skill_name']      = $_POST['skill_name']      ?? [];
    $_POST['skill_level']     = $_POST['skill_level']     ?? [];
    $_POST['exp_company']     = $_POST['exp_company']     ?? [];
    $_POST['exp_title']       = $_POST['exp_title']       ?? [];
    $_POST['exp_start']       = $_POST['exp_start']       ?? [];
    $_POST['exp_end']         = $_POST['exp_end']         ?? [];
    $_POST['exp_description'] = $_POST['exp_description'] ?? [];
    $_POST['edu_school']      = $_POST['edu_school']      ?? [];
    $_POST['edu_degree']      = $_POST['edu_degree']      ?? [];
    $_POST['edu_start']       = $_POST['edu_start']       ?? [];
    $_POST['edu_end']         = $_POST['edu_end']         ?? [];

    // Blocage si nom/prenom vides
    if ($_POST['firstname'] === '' || $_POST['lastname'] === '') {
        die('Le prénom et le nom sont obligatoires pour générer le CV.');
    }
    
    try {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        // Récupération du template choisi
        $template = $_POST['template_choice'] ?? 'modern';
        
        // Debug : afficher les données reçues
        error_log("Template choisi : " . $template);
        error_log("Fichier uploadé : " . print_r($_FILES, true));

        function iconBase64($path) {
            if (!file_exists($path)) return '';
            $type = mime_content_type($path);
            $data = file_get_contents($path);
            return "data:$type;base64," . base64_encode($data);
        }

        $iconEmail    = iconBase64(__DIR__ . '/assets/images/email.png');
        $iconPhone    = iconBase64(__DIR__ . '/assets/images/phone.png');
        $iconLocation = iconBase64(__DIR__ . '/assets/images/location.png'); 
        
        // Inclusion dynamique du template
        ob_start();
        if ($template === 'classic') {
            include 'templates/cv-template-classic.php';
        } else {
            include 'templates/cv-template.php';
        }
        $html = ob_get_clean();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("mon-cv.pdf", ["Attachment" => false]);
        
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
        echo "<br>Ligne : " . $e->getLine();
        echo "<br>Fichier : " . $e->getFile();
        error_log("Erreur PDF : " . $e->getMessage());
    }
} else {
    echo "Méthode non autorisée. Utilisez POST.";
}
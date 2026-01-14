<?php
// Activer l'affichage des erreurs pour le debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
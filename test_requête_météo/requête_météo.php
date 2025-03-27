<?php
// Remplacez par votre clé API
$apiKey = "bfb575189521f2f6765a3920615c97a6fd23761babca9d059e6069c83e8a00b0";

// URL de l'API pour récupérer les informations météorologiques
$apiUrl = "https://api.meteo-concept.com/api/forecast/daily?token=" . $apiKey . "&insee=14000";

// Initialisation de la session cURL
$ch = curl_init();

// Configuration des options cURL
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Exécution de la requête et récupération de la réponse
$response = curl_exec($ch);

// Vérification des erreurs
if (curl_errno($ch)) {
    echo 'Erreur cURL: ' . curl_error($ch);
} else {
    // Décodage de la réponse JSON
    $data = json_decode($response, true);

    // Vérification si la réponse est valide
    if (isset($data['forecast'])) {
        $forecast = $data['forecast'][0];

        // Récupération des informations demandées
        $latitude = $data['city']['latitude'];
        $longitude = $data['city']['longitude'];
        $cumulPluie = $forecast['rr1']; // Cumul de pluie sur la journée en mm
        $ventMoyen = $forecast['wind10m'] * 3.6; // Vent moyen à 10 mètres en km/h (converti de m/s)
        $directionVent = $forecast['dirwind10m']; // Direction du vent en degrés

        // Affichage des informations
        echo "Latitude décimale de la commune: " . $latitude . "\n";
        echo "Longitude décimale de la commune: " . $longitude . "\n";
        echo "Cumul de pluie sur la journée en mm: " . $cumulPluie . "\n";
        echo "Vent moyen à 10 mètres en km/h: " . $ventMoyen . "\n";
        echo "Direction du vent en degrés: " . $directionVent . "\n";
    } else {
        echo 'Erreur: Réponse invalide de l\'API';
    }
}

// Fermeture de la session cURL
curl_close($ch);
?>

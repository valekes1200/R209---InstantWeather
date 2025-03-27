<?php
// Remplacez par votre clé API obtenue de https://api.meteo-concept.com/
$inseeCode = "14000"; // Code INSEE de la commune pour Caen (remplacez par celui de votre ville)

// URL de l'API pour récupérer les informations météo
$apiUrl = "https://api.meteo-concept.com/api/forecast/daily?token=bfb575189521f2f6765a3920615c97a6fd23761babca9d059e6069c83e8a00b0&insee= 14000";

// Initialisation de la session cURL
$ch = curl_init();

// Configuration des options cURL
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Exécution de la requête et récupération de la réponse
$response = curl_exec($ch);

// Vérification des erreurs
if (curl_errno($ch)) {
    // Si une erreur se produit lors de la requête
    echo 'Erreur cURL: ' . curl_error($ch);
} else {
    // Décodage de la réponse JSON
    $data = json_decode($response, true);

    // Vérification si les données météo sont valides
    if (isset($data['forecast'])) {
        $forecast = $data['forecast'][0];

        // Récupération des informations
        $latitude = $data['city']['latitude'];
        $longitude = $data['city']['longitude'];
        $cumulPluie = $forecast['rr1']; // Cumul de pluie sur la journée en mm
        $ventMoyen = $forecast['wind10m'] * 3.6; // Vent moyen à 10 mètres en km/h (converti de m/s)
        $directionVent = $forecast['dirwind10m']; // Direction du vent en degrés

        // Affichage des informations
        echo "Latitude de la commune : " . $latitude . "<br>";
        echo "Longitude de la commune : " . $longitude . "<br>";
        echo "Cumul de pluie sur la journée : " . $cumulPluie . " mm<br>";
        echo "Vent moyen à 10 mètres : " . $ventMoyen . " km/h<br>";
        echo "Direction du vent : " . $directionVent . "°<br>";
    } else {
        echo "Erreur: Réponse invalide de l'API.<br>";
    }
}

// Fermeture de la session cURL
curl_close($ch);
?>

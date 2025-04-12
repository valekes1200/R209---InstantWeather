// Ajoute un écouteur d'événement pour le formulaire avec l'ID 'weatherForm'
document.getElementById('weatherForm').addEventListener('submit', function(événement) {
    // Empêche le comportement par défaut de soumission du formulaire
    événement.preventDefault();

    // Récupère la valeur du champ avec l'ID 'postalCode' et supprime les espaces en début et fin
    const codePostal = document.getElementById('postalCode').value.trim();

    // Définit un motif pour valider un code postal de 5 chiffres
    const motifCodePostal = /^\d{5}$/;

    // Vérifie si le code postal correspond au motif
    if (!motifCodePostal.test(codePostal)) {
        // Affiche une alerte si le code postal n'est pas valide
        alert('Veuillez entrer un code postal valide de 5 chiffres.');
        return; // Arrête l'exécution de la fonction
    }

    // Appelle la fonction pour récupérer les communes associées au code postal
    récupérerCommunes(codePostal);
});

// Fonction pour récupérer les communes à partir d'un code postal
function récupérerCommunes(codePostal) {
    // Effectue une requête fetch vers l'API pour obtenir les communes
    fetch(`https://geo.api.gouv.fr/communes?codePostal=${codePostal}`)
        .then(réponse => réponse.json()) // Convertit la réponse en JSON
        .then(données => afficherCommunes(données)) // Appelle la fonction pour afficher les communes
        .catch(erreur => console.error('Erreur lors de la récupération des communes:', erreur)); // Gère les erreurs
}

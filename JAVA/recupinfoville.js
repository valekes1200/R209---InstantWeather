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


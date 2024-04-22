
<?php
// Inclure le fichier contenant la fonction addRDVInCalendar
include("database.php");

// Simuler une connexion à la base de données
$db = dbConnect(); // Assurez-vous que cette fonction est correctement définie ou incluse

// Appeler la fonction avec une adresse e-mail connue
$email = 'ancelin.valentin@gmail.com';
$result = addRDVInCalendar($db, $email);

// Afficher le résultat pour vérification
var_dump($result);
?>
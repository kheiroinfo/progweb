<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message de réponse</title>
    <style>
        body {
            background-color: #f5f5dc;
            padding-left: 20%;
            padding-right: 20%;
            padding-top: 7%;
        }
        .message {
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
            color: orange;
            background-color: white;
        }
        .user-info {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
            color: navy;
        }
        .cadre-info {
    
            border: 3px solid red;
            background-color: aqua;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    // Fonction pour vérifier les informations saisies
    function verifier($nom, $prenom, $date_naissance, $telephone, $specialite, $langues) {
        // Tableau pour stocker les erreurs
        $erreurs = [];

        // Vérification du nom
        if (empty($nom)) {
            $erreurs[] = "Le champ Nom est obligatoire.";
        }

        // Vérification du prénom
        if (empty($prenom)) {
            $erreurs[] = "Le champ Prénom est obligatoire.";
        }

        // Vérification de la date de naissance
        if (empty($date_naissance)) {
            $erreurs[] = "Le champ Date de naissance est obligatoire.";
        }

        // Vérification du numéro de téléphone
        if (empty($telephone)) {
            $erreurs[] = "Le champ Numéro de téléphone est obligatoire.";
        }

        // Vérification du choix de spécialité
        if (empty($specialite)) {
            $erreurs[] = "Le champ Domaine d'études est obligatoire.";
        }

        // Vérification des langues sélectionnées
        if (empty($langues)) {
            $erreurs[] = "Vous devez sélectionner au moins une langue.";
        }

        // Si des erreurs sont détectées, les afficher avec un lien de retour vers le formulaire
        if (!empty($erreurs)) {
            echo "<h2>Erreurs :</h2>";
            foreach ($erreurs as $erreur) {
                echo "<p>$erreur</p>";
            }
            echo '<p><a href="index.html">Retour au formulaire</a></p>';
            // Terminer l'exécution du script
            exit;
        }
    }

    // Vérifier si les données ont été soumises via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $genre = $_POST['genre'];
        $nom = $_POST['nom'];
        $civilite = '';

        // Déterminer la civilité en fonction du genre
        if ($genre == 'masculin') {
            $civilite = 'Mr';
        } elseif ($genre == 'feminin') {
            // Déterminer la civilité en fonction de la civilité cochée
            if (isset($_POST['civilite'])) {
                $civilite_cochée = $_POST['civilite'];
                if ($civilite_cochée == 'Marié') {
                    $civilite = 'Mme';
                } elseif ($civilite_cochée == 'Célibataire') {
                    $civilite = 'Mlle';
                }
            }
        }

        // Afficher le message complet
        echo "<div class='message'>";
        echo "Merci d’avoir rempli le formulaire ! ";
        if (!empty($civilite)) {
            echo $civilite . ' ';
        }
        echo $nom;
        echo "</div>";

        // Récupération des données saisies par l'utilisateur
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST['date_naissance'];
        $telephone = $_POST['telephone'];
        $specialite = $_POST['domaine_etudes'];

        // Récupération des langues sélectionnées
        $langues = isset($_POST['langues']) ? $_POST['langues'] : [];

        // Vérifier si "Aucune" est sélectionné et désélectionner les autres langues si c'est le cas
        if (in_array("aucune_preference", $langues)) {
            $langues = ["aucune_preference"]; // Garder seulement "Aucune" sélectionné
        }

        // Appel de la fonction pour vérifier les informations saisies
        verifier($nom, $prenom, $date_naissance, $telephone, $specialite, $langues);
        
        // Function to display information
        function afficherInformations($nom, $prenom, $date_naissance, $telephone, $specialite, $langues) {
            echo '<div class="cadre-info">';
            echo '<h2>Informations saisies :</h2>';
            echo '<p><strong>Nom :</strong> ' . $nom . '</p>';
            echo '<p><strong>Prénom :</strong> ' . $prenom . '</p>';
            echo '<p><strong>Date de naissance :</strong> ' . $date_naissance . '</p>';
            echo '<p><strong>Numéro de téléphone :</strong> ' . $telephone . '</p>';
            echo '<p><strong>Choix de spécialité :</strong> ' . $specialite . '</p>';
            
            // Affichage des langues sélectionnées
            echo '<p><strong>Langues souhaitées :</strong> ';
            if (!empty($langues)) {
                // Si $langues n'est pas déjà un tableau, le convertir en tableau
                if (!is_array($langues)) {
                    $langues = [$langues];
                }
                $totalLangues = count($langues);
                $i = 0;
                foreach ($langues as $langue) {
                    echo $langue;
                    if ($i < $totalLangues - 1) {
                        echo " - ";
                    }
                    $i++;
                }
            } else {
                echo 'Aucune langue sélectionnée';
            }
            echo '</p>';
            
            echo '</div>';
        }
        
        // Utilisation de la fonction afficherInformations avec les variables appropriées
        afficherInformations($nom, $prenom, $date_naissance, $telephone, $specialite, $langues);
    }
    ?>
</body>
</html>

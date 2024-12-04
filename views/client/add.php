<?php

$host = "tcp:mini-projet-serveur.database.windows.net,1433";
$db_name = "societé";
$username = "yasmine";
$password = "azerty123@";


try {
    $conn = new PDO(
        "sqlsrv:server=" . $host . ";Database=" . $db_name . ";Encrypt=true;TrustServerCertificate=false",
        $username,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
    die();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $ID_region = $_POST['ID_region'];

    
    $query = "INSERT INTO client (nom, prenom, age, ID_region) VALUES (:nom, :prenom, :age, :ID_region)";
    $stmt = $conn->prepare($query);

    try {
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':age' => $age,
            ':ID_region' => $ID_region
        ]);
        
        header('Location: list.php');
        exit();
    } catch (PDOException $e) {
        echo "Error adding client: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="../../public/styles/index.css">
    <style>
        /* Style pour centrer le formulaire */
        body {
            background-color: #e0f7fa; /* Fond bleu clair */
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            color: #00796b; /* Couleur du titre */
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #00796b;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #00796b;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #004d40;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #00796b;
            font-size: 16px;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div>
        <h1>Ajouter un client</h1>
        <form action="add.php" method="POST">
            <div>
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div>
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div>
                <label for="age">Âge:</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div>
                <label for="ID_region">Région:</label>
                <select id="ID_region" name="ID_region" required>
                    <?php
                    // Re-establish the database connection to fetch regions
                    $conn = mysqli_connect($host, $username, $password, $db_name);
                    if ($conn) {
                        $regionsQuery = "SELECT ID_region, libelle FROM region";
                        $regionsResult = mysqli_query($conn, $regionsQuery);

                        // Populate the dropdown with regions
                        while ($region = mysqli_fetch_assoc($regionsResult)) {
                            echo "<option value=\"{$region['ID_region']}\">{$region['libelle']}</option>";
                        }

                        // Close the connection
                        mysqli_close($conn);
                    } else {
                        echo "<option value=\"\">Erreur lors du chargement des régions</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit">Ajouter</button>
        </form>
        <a class="back-link" href="list.php">&larr; Retour à la liste</a>
    </div>
</body>
</html>

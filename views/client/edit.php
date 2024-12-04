<?php
// Database connection
$host = "tcp:mini-projet-serveur.database.windows.net,1433";
$db_name = "societé";
$username = "yasmine";
$password = "azerty123@";
$conn = new PDO("sqlsrv:server=$host;Database=$db_name;Encrypt=true;TrustServerCertificate=false", $username, $password);

$id = $_GET['id'] ?? null;
if ($id) {
    $query = "SELECT * FROM client WHERE ID_client = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $ID_region = $_POST['ID_region'];
    $query = "UPDATE client SET nom = ?, prenom = ?, age = ?, ID_region = ? WHERE ID_client = ?";
    $stmt = $conn->prepare($query);
    if ($stmt->execute([$nom, $prenom, $age, $ID_region, $_POST['id']])) {
        header('Location: list.php');
        exit();
    } else {
        echo "Error updating client.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un client</title>
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
        <h1>Modifier un client</h1>
        <?php if ($client): ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($client['ID_client']) ?>">
                <label>Nom:</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($client['nom']) ?>" required><br>
                <label>Prénom:</label>
                <input type="text" name="prenom" value="<?= htmlspecialchars($client['prenom']) ?>" required><br>
                <label>Âge:</label>
                <input type="number" name="age" value="<?= htmlspecialchars($client['age']) ?>" required><br>
                <label>Région:</label>
                <select id="ID_region" name="ID_region" required>
                    <?php
                    // Re-establish the database connection to fetch regions
                    $conn = mysqli_connect($host, $username, $password, $db_name);
                    if ($conn) {
                        $regionsQuery = "SELECT ID_region, libelle FROM region";
                        $regionsResult = mysqli_query($conn, $regionsQuery);

                        // Populate the dropdown with regions
                        while ($region = mysqli_fetch_assoc($regionsResult)) {
                            $selected = ($region['ID_region'] == $client['ID_region']) ? 'selected' : '';
                            echo "<option value=\"{$region['ID_region']}\" $selected>{$region['libelle']}</option>";
                        }

                        // Close the connection
                        mysqli_close($conn);
                    } else {
                        echo "<option value=\"\">Erreur lors du chargement des régions</option>";
                    }
                    ?>
                </select><br>
                <button type="submit">Mettre à jour</button>
            </form>
        <?php else: ?>
            <p>Client non trouvé.</p>
        <?php endif; ?>
        <a class="back-link" href="list.php">&larr; Retour à la liste</a>
    </div>
</body>
</html>

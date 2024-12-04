<?php
$host = "tcp:mini-projet-serveur.database.windows.net,1433";
$db_name = "societé";
$username = "yasmine";
$password = "azerty123@";
$conn = new PDO("sqlsrv:server=$host;Database=$db_name;Encrypt=true;TrustServerCertificate=false", $username, $password);


$query = "SELECT ID_region, libelle FROM region";
$stmt = $conn->query($query);
$regions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Region List</title>
    <link rel="stylesheet" href="../../public/styles/index.css">
</head>
<body>
    <h1>Region List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Region Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($regions as $region): ?>
                <tr>
                    <td><?= $region['ID_region']; ?></td>
                    <td><?= $region['libelle']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <a href="../client/list.php">Back to Client List</a>
</body>
</html> -->


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Régions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 60%;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f0f0f0;
            color: #333;
        }

        /* Style pour alterner les couleurs des lignes du tableau */
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Gris clair pour les lignes paires */
        }

        tr:nth-child(odd) {
            background-color: #fff; /* Blanc pour les lignes impaires */
        }

        tr:hover {
            background-color: #f5f5f5; /* Couleur au survol */
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ccc;
            color: #333;
            font-size: 16px;
            text-decoration: none;
            border-radius: 25px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color: #b3b3b3;
        }

        .back-btn:before {
            content: "← ";
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <h1>Liste des Régions</h1>

    <!-- Tableau des régions -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de la Région</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($regions)): ?>
                <?php foreach ($regions as $region): ?>
                    <tr>
                        <td><?= htmlspecialchars($region['ID_region']); ?></td>
                        <td><?= htmlspecialchars($region['libelle']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Aucune région trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Bouton retour avec flèche -->
    <a href="../client/list.php" class="back-btn">Retour à la liste des clients</a>
</body>
</html>

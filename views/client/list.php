<?php

$host = "tcp:mini-projet-serveur.database.windows.net,1433";
$db_name = "societé";
$username = "yasmine";
$password = "azerty123@";
$conn = new PDO("sqlsrv:server=$host;Database=$db_name;Encrypt=true;TrustServerCertificate=false", $username, $password);


$clients = [];
$searchQuery = "";


if (isset($_GET['search'])) {
    
    $searchQuery = "%" . $_GET['search'] . "%"; 
    $sql = "SELECT c.ID_client, c.nom, c.prenom, c.age, r.libelle AS region 
            FROM client c 
            LEFT JOIN region r ON c.ID_region = r.ID_region 
            WHERE c.nom LIKE ? OR c.prenom LIKE ?";
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$searchQuery, $searchQuery]); 
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    
    $sql = "SELECT c.ID_client, c.nom, c.prenom, c.age, r.libelle AS region 
            FROM client c 
            LEFT JOIN region r ON c.ID_region = r.ID_region";
    
    $stmt = $conn->query($sql);
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <link rel="stylesheet" href="../../public/styles/index.css">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            font-size: 14px;
            border-radius: 25px;
            padding: 10px 20px;
        }
        .btn-edit {
            background-color: #28a745;
            text-decoration: none; 
            color: white;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-edit:hover {
            background-color: #218838;
        }
        .btn-delete {
            background-color: #dc3545;
            text-decoration: none; 
            color: white;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th {
            background-color: #6c757d;
            color: white;
            text-align: center;
            padding: 10px;
        }
        td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .search-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            align-items: center;
        }
        .search-bar input {
            flex: 1;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 25px;
            padding: 10px;
        }
        .search-bar button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    font-size: 14px;
    border-radius: 25px;
    border: none;
    transition: background-color 0.3s;
}

.search-bar button:hover {
    background-color: #0056b3;
}

.search-bar a {
    padding: 10px 20px;
    background-color: #6c757d;
    color: white;
    text-decoration: none;
    font-size: 14px;
    border-radius: 25px;
    transition: background-color 0.3s;
    margin-left: 15px; /* Ajout d'espace entre les boutons */
}

.search-bar a:hover {
    background-color: #5a6268;
}
        .add-client-btn {
            text-align: center;
            margin-bottom: 20px;
        }
        .add-client-btn a {
    padding: 10px 20px; /* Même dimensions que le bouton Effacer */
    background-color: #868e96; /* Couleur de fond gris clair */
    color: white;
    border-radius: 25px;
    text-decoration: none;
    font-size: 14px; /* Alignement avec les autres boutons */
    transition: background-color 0.3s;
}
.add-client-btn a:hover {
    background-color: #6c757d; /* Gris plus foncé au survol */
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des Clients</h1>

        <!-- Bouton Ajouter un client centré au-dessus du tableau -->
        <div class="add-client-btn">
            <a href="add.php">Ajouter un client</a>
        </div>

        <!-- Barre de recherche -->
        <form method="GET" class="search-bar">
            <input type="text" name="search" class="form-control" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" placeholder="Rechercher un client">
            <button type="submit" class="btn btn-dark btn-custom">Rechercher</button>
            <a href="list.php" class="btn btn-secondary btn-custom">Effacer</a>
        </form>

        <!-- Tableau des clients -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Âge</th>
                    <th>Région</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clients)): ?>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?= htmlspecialchars($client['ID_client']) ?></td>
                            <td><?= htmlspecialchars($client['nom']) ?></td>
                            <td><?= htmlspecialchars($client['prenom']) ?></td>
                            <td><?= htmlspecialchars($client['age']) ?></td>
                            <td><?= htmlspecialchars($client['region']) ?></td>
                            <td>
                                <a href="edit.php?action=editClient&id=<?= htmlspecialchars($client['ID_client']) ?>" class="btn btn-edit btn-custom">Modifier</a>
                                <a href="delete.php?action=deleteClient&id=<?= htmlspecialchars($client['ID_client']) ?>" class="btn btn-delete btn-custom" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Aucun client trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

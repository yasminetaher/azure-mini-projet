<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Project Cloud</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        .nav {
            margin-top: 20px;
        }

        .nav a {
            display: inline-block;
            margin-right: 15px;
            text-decoration: none;
            color: #007bff;
            font-size: 18px;
        }

        .nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Welcome to the Mini Project Cloud !</h1>
    <p>Select one of the options below to manage data:</p>
    
    <div class="nav">
        <a href="./views/client/list.php">Manage Clients</a>
        <a href="./views/region/list.php">View Regions</a>
    </div>
</body>
</html> -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Projet Cloud</title>
    <style>
        /* Style global */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f8fb;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Conteneur principal */
        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        /* Style du titre */
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #0078d7;
        }

        p {
            font-size: 16px;
            margin-bottom: 30px;
            color: #555;
        }

        /* Style des boutons de navigation */
        .nav a {
            display: block;
            margin: 10px auto;
            text-decoration: none;
            font-size: 16px;
            color: #fff;
            background-color: #0078d7;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
            max-width: 200px;
        }

        .nav a:hover {
            background-color: #0056a8;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Bienvenue dans Mon Mini Projet<br/> Cloud !</h1>
        <p>Choisissez l'une des options ci-dessous pour gérer les données :</p>
        
        <div class="nav">
            <a href="./views/client/list.php">Gérer les Clients</a>
            <a href="./views/region/list.php">Voir les Régions</a>
        </div>
    </div>

</body>
</html>

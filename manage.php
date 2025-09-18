<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        h1 {
            margin-bottom: 30px;
        }
        .button-container {
            display: flex;
            gap: 20px;
        }
        .manage-button {
            padding: 15px 30px;
            font-size: 18px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .manage-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <h1>Manage Dashboard</h1>
    
    <div class="button-container">
        <form action="manage_users.php" method="get">
            <button class="manage-button" type="submit">Manage Utilisateurs</button>
        </form>
        <form action="manage_prop.php" method="get">
            <button class="manage-button" type="submit">Manage Propriétés</button>
        </form>
    </div>

</body>
</html>

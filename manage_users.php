<?php
session_start(); // Needed for session variables

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immobilier"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add user functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    // Check if username or email already exists
    $stmt = $conn->prepare('SELECT * FROM utilisateurs WHERE nom_utilisateur = ? OR email = ?');
    $stmt->bind_param('ss', $nom_utilisateur, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<p>Nom d'utilisateur ou email déjà utilisé.</p>";
    } else {
        // Store in session to use in sendconf.php
        $_SESSION['nom_utilisateur'] = $nom_utilisateur;
        $_SESSION['email'] = $email;
        $_SESSION['mot_de_passe'] = $mot_de_passe;
        $_SESSION['role'] = $role;

        // Redirect to sendconf.php
        header("Location: sendconf_admin.php");
        exit();
    }
}

// Modify and delete code remains unchanged...


// Modify user functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modify_user'])) {
    $id = $_POST['id'];
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $sql_modify = "UPDATE utilisateurs SET nom_utilisateur = ?, email = ?, mot_de_passe = ?, role = ? WHERE id = ?";
    $stmt_modify = $conn->prepare($sql_modify);
    $stmt_modify->bind_param("ssssi",$nom_utilisateur, $email, $mot_de_passe, $role, $id);
    $stmt_modify->execute();
    $stmt_modify->close();
    echo "<p>User modified successfully!</p>";
}

// Delete user functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $id = $_POST['id'];

    $sql_delete = "DELETE FROM utilisateurs WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);
    $stmt_delete->execute();
    $stmt_delete->close();
    echo "<p>User deleted successfully!</p>";
}

// Fetch all users
$sql_users = "SELECT id, nom_utilisateur, email, mot_de_passe, role FROM utilisateurs";
$result_users = $conn->query($sql_users);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo2.png">
    <title>User Management</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f8;
        margin: 0;
        padding: 20px;
    }

    h1, h2 {
        text-align: center;
        color: #333;
    }

    form {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        max-width: 600px;
        margin: 20px auto;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    form input[type="text"],
    form input[type="password"],
    form select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 8px;
    }

    form button {
        background-color:rgb(0, 0, 0);
        color: white;
        padding: 10px 16px;
        margin-top: 10px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    form button:hover {
        background-color:rgb(0, 0, 0);
    }

    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color:rgb(0, 0, 0);
        color: white;
    }

    td form {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        justify-content: center;
    }

    td form input[type="text"],
    td form input[type="password"],
    td form select {
        width: 120px;
        padding: 5px;
        font-size: 0.9em;
    }

    td form button {
        padding: 5px 10px;
        font-size: 0.9em;
    }

    p {
        text-align: center;
        color: #777;
    }
</style>

</head>
<body>
    <h1>Gestion des utilisateurs</h1>

    <!-- Add User Form -->
    <h2>Ajouter un utilisateur</h2>
    <form method="POST">
    <input type="text" name="nom_utilisateur" placeholder="nom d'utilisateur" required>
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="mot_de_passe" placeholder="mot de passe" required>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="visiteur">visiteur</option>
        </select>
        <button type="submit" name="add_user">ajouter un utilisateur</button>
    </form>

    <!-- Display Users -->
    <h2>Tous les utilisateurs</h2>
    <?php
    if ($result_users->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Nom d'utilisateur</th>
                    
                    
                    <th>Role</th>
                    <th>Actions</th>
                </tr>";
        while ($row = $result_users->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['nom_utilisateur']) . "</td>
                    
                    
                    <td>" . htmlspecialchars($row['role']) . "</td>
                    <td>
                        <!-- Modify User Form -->
                        <form method='POST' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            
                            
                            
                            <select name='role' required>
                                <option value='admin' " . ($row['role'] === 'admin' ? 'selected' : '') . ">Admin</option>
                                <option value='visiteur' " . ($row['role'] === 'visiteur' ? 'selected' : '') . ">visiteur</option>
                            </select>
                            <button type='submit' name='modify_user'>Modifier</button>
                        </form>
                        <!-- Delete User Form -->
                        <form method='POST' style='display:inline-block;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' name='delete_user'>Supprimer</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No users found.</p>";
    }
    ?>
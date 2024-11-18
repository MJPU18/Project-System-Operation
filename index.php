<?php
// Conectar a la base de datos SQLite
$db = new PDO('sqlite:myapp.db');

// Verificar si se envió un formulario para agregar un usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    // Insertar usuario en la base de datos
    $stmt = $db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}

// Consultar todos los usuarios
$users = $db->query("SELECT * FROM users")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aplicación PHP con SQLite</title>
</head>
<body>
    <h1>Agregar usuario</h1>
    <form method="POST">
        Nombre: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Agregar</button>
    </form>

    <h2>Lista de usuarios</h2>
    <ul>
        <?php foreach ($users as $user): ?>
            <li><?php echo htmlspecialchars($user['name']); ?> (<?php echo htmlspecialchars($user['email']); ?>)</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>


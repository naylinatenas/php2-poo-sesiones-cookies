<?php
session_start();

// verificar si usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #bbdefb;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .welcome-box {
            max-width: 600px;
            margin: 100px auto;
            background-color: #fff;
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #0d6efd;
            font-weight: 600;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .btn-logout {
            background-color: #dc3545;
            border: none;
            border-radius: 10px;
            color: #fff;
            padding: 10px 20px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background-color: #bb2d3b;
            color: #fff;
        }

        footer {
            text-align: center;
            color: #777;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <div class="welcome-box">
        <h2>¡Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?>!</h2>
        <p>Has iniciado sesión correctamente.</p>
        <a href="logout.php" class="btn btn-logout">Cerrar sesión</a>
    </div>

</body>

</html>
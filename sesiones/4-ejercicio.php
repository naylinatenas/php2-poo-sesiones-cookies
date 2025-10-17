<?php
session_start();

// Establecer zona horaria de Perú
date_default_timezone_set('America/Lima');

// Reiniciar temporizador si el usuario hace clic en el botón
if (isset($_POST['reiniciar'])) {
    unset($_SESSION['hora_inicio']);
}

// Si no hay hora de inicio, se guarda la hora actual
if (!isset($_SESSION['hora_inicio'])) {
    $_SESSION['hora_inicio'] = date("h:i:s A");
}

$horaInicio = $_SESSION['hora_inicio'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 04 - Temporizador de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #FFF8E1;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #FFD54F;
            color: #5D4037;
            padding: 1rem;
        }

        .hora {
            font-size: 1.8rem;
            font-weight: 600;
            color: #5D4037;
        }

        .btn-primary {
            background-color: #FFD54F;
            color: #5D4037;
            border: none;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #FFCA28;
            color: #4E342E;
        }

        .btn-home {
            display: inline-block;
            background-color: #FFC107;
            color: #5D4037;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            margin-top: 20px;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .btn-home:hover {
            background-color: #FFB300;
            color: #4E342E;
        }
    </style>
</head>

<body>
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card shadow">
            <div class="card-header text-center">
                <h4><i class="fa-solid fa-clock"></i> Temporizador de Sesión Activa</h4>
            </div>
            <div class="card-body p-4 text-center">
                <p class="mb-3">
                    <i class="fa-solid fa-circle-info text-warning me-2"></i>
                    Ingresaste por primera vez a esta página a las:
                </p>
                <div class="hora mb-4"><?= htmlspecialchars($horaInicio) ?></div>
                <form method="POST">
                    <button type="submit" name="reiniciar" class="btn btn-primary">
                        <i class="fa-solid fa-rotate-left me-2"></i> Reiniciar Temporizador
                    </button>
                </form>
            </div>
        </div>
        <div class="text-center">
            <a href="../home.php" class="btn-home">
                <i class="fa-solid fa-house me-2"></i> Volver al Home
            </a>
        </div>
    </div>
</body>

</html>
<?php
session_start();

$preguntas = [
    "¿Cuál es tu lenguaje de programación favorito?",
    "¿Qué sistema operativo usas más?",
    "¿Prefieres frontend o backend?",
    "¿Qué base de datos te gusta más?",
    "¿Trabajas con control de versiones?"
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['favoritas'] = $_POST['favoritas'] ?? [];
    header("Location: favoritas.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 03 - Simulador de Favoritos</title>
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
            box-shadow: 0px 10px 25px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #FFD54F;
            color: #5D4037;
        }
        .btn-primary {
            background-color: #FFD54F;
            color: #5D4037;
            border: none;
            font-weight: 500;
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
        }
        .btn-home:hover {
            background-color: #FFB300;
            color: #4E342E;
        }
    </style>
</head>
<body>
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header text-center">
            <h4>Selecciona tus preguntas favoritas</h4>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="">
                <?php foreach ($preguntas as $index => $pregunta): ?>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="favoritas[]" 
                               value="<?= htmlspecialchars($pregunta) ?>"
                               id="pregunta<?= $index ?>"
                               <?= (isset($_SESSION['favoritas']) && in_array($pregunta, $_SESSION['favoritas'])) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="pregunta<?= $index ?>">
                            <?= htmlspecialchars($pregunta) ?>
                        </label>
                    </div>
                <?php endforeach; ?>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        Guardar selección <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </form>
            <div class="text-center">
                <a href="../../home.php" class="btn-home">
                    <i class="fa-solid fa-house me-2"></i> Volver al Home
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

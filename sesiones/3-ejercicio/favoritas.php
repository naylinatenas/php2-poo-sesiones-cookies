<?php
session_start();

if (!isset($_SESSION['favoritas'])) {
    $_SESSION['favoritas'] = [];
}

if (isset($_POST['limpiar'])) {
    unset($_SESSION['favoritas']);
}

if (isset($_POST['eliminar']) && isset($_POST['pregunta'])) {
    $preguntaEliminar = $_POST['pregunta'];
    $_SESSION['favoritas'] = array_filter($_SESSION['favoritas'], function ($item) use ($preguntaEliminar) {
        return $item !== $preguntaEliminar;
    });
}

$favoritas = $_SESSION['favoritas'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 03 - Mis Favoritos</title>
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
        .btn-outline-secondary {
            border-radius: 8px;
        }
        .btn-eliminar {
            background: none;
            border: none;
            color: #E64A19;
        }
        .btn-eliminar:hover {
            color: #BF360C;
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
            <h4><i class="fa-solid fa-heart"></i> Tus Preguntas Favoritas</h4>
        </div>
        <div class="card-body p-4">
            <?php if (!empty($favoritas)): ?>
                <ul class="list-group mb-4">
                    <?php foreach ($favoritas as $favorita): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa-solid fa-check text-success me-2"></i>
                                <?= htmlspecialchars($favorita) ?>
                            </div>
                            <form method="POST" class="m-0">
                                <input type="hidden" name="pregunta" value="<?= htmlspecialchars($favorita) ?>">
                                <button type="submit" name="eliminar" class="btn-eliminar" title="Eliminar esta pregunta">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="d-flex justify-content-between">
                    <a href="formulario.php" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-arrow-left me-2"></i> Volver
                    </a>
                    <form method="POST" class="m-0">
                        <button type="submit" name="limpiar" class="btn btn-primary">
                            <i class="fa-solid fa-rotate-left me-2"></i> Limpiar selección
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    <i class="fa-solid fa-circle-info me-2"></i>
                    No tienes preguntas favoritas seleccionadas.
                </div>
                <div class="text-center">
                    <a href="formulario.php" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left me-2"></i> Volver a seleccionar
                    </a>
                </div>
            <?php endif; ?>

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

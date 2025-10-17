<?php
session_start();
date_default_timezone_set('America/Lima');

// Inicializar conteo de votos en la sesión si no existe
if (!isset($_SESSION['votos'])) {
    $_SESSION['votos'] = [
        'PHP' => 12,
        'Python' => 8,
        'JavaScript' => 15,
        'Java' => 5,
        'C#' => 10
    ];
}

// Procesar el voto si el usuario no ha votado aún
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['ya_voto']) && isset($_POST['lenguaje'])) {
    $opcion = $_POST['lenguaje'];
    if (array_key_exists($opcion, $_SESSION['votos'])) {
        $_SESSION['votos'][$opcion]++;
        $_SESSION['ya_voto'] = $opcion;
    }
}

// Reiniciar encuesta
if (isset($_POST['reiniciar'])) {
    unset($_SESSION['ya_voto']);
    $_SESSION['votos'] = [
        'PHP' => 12,
        'Python' => 8,
        'JavaScript' => 15,
        'Java' => 5,
        'C#' => 10
    ];
}

$votos = $_SESSION['votos'];
$yaVoto = $_SESSION['ya_voto'] ?? null;
$totalVotos = array_sum($votos);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5 - Simulador de Encuesta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #FFF8E1;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #FFD54F;
            color: #5D4037;
        }

        .card-header h4 {
            margin: 0;
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

        .btn-secondary {
            background-color: #FFE082;
            color: #5D4037;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #FFD54F;
            color: #4E342E;
        }

        .progress-bar {
            background-color: #FFC107;
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
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow">
            <div class="card-header text-center">
                <h4><i class="fa-solid fa-poll"></i> Encuesta de Lenguaje Favorito</h4>
            </div>
            <div class="card-body p-4">

                <?php if (!$yaVoto): ?>
                    <p class="text-center mb-4">
                        <i class="fa-solid fa-circle-info text-warning me-2"></i>
                        Selecciona tu lenguaje favorito 👇
                    </p>
                    <form method="POST" class="text-center">
                        <?php foreach ($votos as $lenguaje => $cantidad): ?>
                            <div class="form-check text-start ms-5">
                                <input class="form-check-input" type="radio" name="lenguaje" id="<?= $lenguaje ?>" value="<?= $lenguaje ?>" required>
                                <label class="form-check-label" for="<?= $lenguaje ?>">
                                    <?= htmlspecialchars($lenguaje) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-primary mt-4 w-100">
                            <i class="fa-solid fa-paper-plane me-2"></i> Enviar Voto
                        </button>
                    </form>

                <?php else: ?>
                    <div class="alert alert-success text-center">
                        <i class="fa-solid fa-check-circle me-2"></i>
                        Gracias, ya registraste tu voto por <strong><?= htmlspecialchars($yaVoto) ?></strong>.
                    </div>
                <?php endif; ?>

                <hr>

                <h5 class="text-center mb-3"><i class="fa-solid fa-chart-bar me-2"></i> Resultados Actuales</h5>

                <?php foreach ($votos as $lenguaje => $cantidad):
                    $porcentaje = $totalVotos > 0 ? round(($cantidad / $totalVotos) * 100) : 0;
                ?>
                    <div class="mb-2">
                        <div class="d-flex justify-content-between">
                            <span><?= htmlspecialchars($lenguaje) ?></span>
                            <span><?= $cantidad ?> voto(s) - <?= $porcentaje ?>%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" style="width: <?= $porcentaje ?>%;"></div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <form method="POST" class="text-center mt-4">
                    <button type="submit" name="reiniciar" class="btn btn-secondary btn-sm">
                        <i class="fa-solid fa-rotate-left me-1"></i> Reiniciar
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
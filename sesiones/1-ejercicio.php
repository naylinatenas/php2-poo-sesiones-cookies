<?php
session_start();

// Inicializar el contador
if (!isset($_SESSION['visitas'])) {
    $_SESSION['visitas'] = 0;
}

$_SESSION['visitas']++;
$visitas = $_SESSION['visitas'];

// Reiniciar contador
if (isset($_POST['reset'])) {
    $_SESSION['visitas'] = 0;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Contador de Sesiones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #FFF3CD;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            font-weight: 600;
            color: #FFC107;
            text-align: center;
            margin-bottom: 25px;
        }

        .card-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 420px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .card-container:hover {
            box-shadow: 0px 15px 35px rgba(0, 0, 0, 0.15);
        }

        .contador-box {
            background: #1A1A1A;
            color: #FFFFFF;
            padding: 20px;
            border-radius: 12px;
            font-size: 1.5rem;
            font-weight: 500;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            margin-top: 15px;
        }

        .contador-box i {
            color: #FFC107;
            font-size: 2rem;
        }

        .btn-reset {
            background: #FFC107;
            border: none;
            padding: 12px;
            color: #FFFFFF;
            border-radius: 12px;
            margin-top: 20px;
            width: 100%;
            font-size: 1rem;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .btn-reset:hover {
            background: #E0A800;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #FFC107;  
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
            margin-top: 25px;
        }

        .btn-back:hover {
            background-color: #E0A800;
            text-decoration: none;
        }

        .footer-text {
            font-size: 0.85rem;
            color: #666;
            margin-top: 15px;
        }

        @media (max-width: 576px) {
            .card-container {
                padding: 25px;
            }

            .btn-back {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <h1><i class="fa-solid fa-chart-line me-2"></i> Contador de Visitas</h1>

    <div class="card-container">
        <div class="contador-box">
            <i class="fa-solid fa-eye"></i>
            <span>
                Has visitado esta página <strong><?= $visitas ?></strong> 
                <?= $visitas == 1 ? 'vez' : 'veces' ?>.
            </span>
        </div>

        <form method="POST">    
            <button type="submit" name="reset" class="btn-reset">
                <i class="fa-solid fa-rotate-right me-2"></i> Reiniciar contador
            </button>
        </form>

        <p class="footer-text">Este contador se mantiene activo durante la sesión actual.</p>
    </div>

    <div class="text-center">
        <a href="../home.php" class="btn-back">
            <i class="fa-solid fa-house"></i> Volver al Home
        </a>
    </div>

</body>
</html>

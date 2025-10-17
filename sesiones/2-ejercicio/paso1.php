<?php
session_start();

// Si se presionó "reiniciar", destruir la sesión completamente
if (isset($_GET['reset'])) {
    session_destroy();
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['nombre'] = $_POST['nombre'];
    $_SESSION['correo'] = $_POST['correo'];
    header('Location: paso2.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Paso 1 - Formulario Wizard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #FFF3CD;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #FFC107;
        }
        .btn-primary {
            background-color: #FFC107;
            border: none;
        }
        .btn-primary:hover {
            background-color: #E0A800;
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
            margin-top: 20px;
        }
        .btn-back:hover {
            background-color: #E0A800;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header text-white text-center">
            <h4><i class="fa-solid fa-user"></i> Paso 1 de 2</h4>
        </div>
        <div class="card-body p-4">
            <form method="post" action="">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required
                           value="<?= isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" name="correo" id="correo" required
                           value="<?= isset($_SESSION['correo']) ? htmlspecialchars($_SESSION['correo']) : '' ?>">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Siguiente <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </form>

            <div class="text-center">
                <a href="../../home.php" class="btn-back">
                    <i class="fa-solid fa-house"></i> Volver al Home
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

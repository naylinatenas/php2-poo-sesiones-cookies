<?php
session_start();

if (!isset($_SESSION['nombre']) || !isset($_SESSION['correo'])) {
    header('Location: paso1.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['edad'] = $_POST['edad'];
    $_SESSION['pais'] = $_POST['pais'];
    header('Location: resultado.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Paso 2 - Formulario Wizard</title>
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
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
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
                <h4><i class="fa-solid fa-globe"></i> Paso 2 de 2</h4>
            </div>
            <div class="card-body p-4">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="edad" class="form-label">Edad</label>
                        <input type="number" class="form-control" name="edad" id="edad" required
                            value="<?= isset($_SESSION['edad']) ? htmlspecialchars($_SESSION['edad']) : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="pais" class="form-label">País</label>
                        <input type="text" class="form-control" name="pais" id="pais" required
                            value="<?= isset($_SESSION['pais']) ? htmlspecialchars($_SESSION['pais']) : '' ?>">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="paso1.php" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-2"></i> Volver
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Finalizar <i class="fa-solid fa-check ms-2"></i>
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
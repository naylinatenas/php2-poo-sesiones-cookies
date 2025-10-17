<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'])) {
    $nombre = trim($_POST['nombre']);
    if (!empty($nombre)) {
        setcookie("usuario", $nombre, time() + 3600);
        header("Location: bienvenida_cookie.php");
        exit();
    }
}

if (isset($_GET['borrar'])) {
    setcookie("usuario", "", time() - 3600);
    header("Location: bienvenida_cookie.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bienvenida con Cookie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #FFF0F5;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background-color: #F48FB1;
            color: #fff;
        }

        .btn-primary {
            background-color: #F48FB1;
            border: none;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #EC407A;
        }

        .btn-outline-danger {
            border-color: #F48FB1;
            color: #F48FB1;
        }

        .btn-outline-danger:hover {
            background-color: #F48FB1;
            color: #fff;
        }

        .btn-home {
            display: inline-block;
            background-color: #F48FB1;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            margin-top: 20px;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .btn-home:hover {
            background-color: #EC407A;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card shadow">
            <div class="card-header text-center">
                <h4><i class="fa-solid fa-cookie-bite me-2"></i> Bienvenida Personalizada</h4>
            </div>
            <div class="card-body p-4">

                <?php if (isset($_COOKIE['usuario'])): ?>
                    <div class="alert alert-success text-center" style="background-color:#F8BBD0; color:#4A148C;">
                        🙋‍♀️ Hola, <strong><?= htmlspecialchars($_COOKIE['usuario']) ?></strong>. ¡Bienvenido de nuevo!
                    </div>
                    <form method="GET" class="text-center mt-3">
                        <button type="submit" name="borrar" value="1" class="btn btn-outline-danger w-100">
                            <i class="fa-solid fa-eraser me-1"></i> Olvidar mi nombre
                        </button>
                    </form>

                <?php else: ?>
                    <p class="text-center mb-4">
                        <i class="fa-solid fa-circle-info text-danger me-2"></i>
                        Ingresa tu nombre para personalizar tu experiencia
                    </p>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Escribe tu nombre" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-solid fa-save me-1"></i> Guardar y continuar
                        </button>
                    </form>
                <?php endif; ?>


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
<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: productos.php");
    exit();
}

$usuarios = [
    "admin" => "1234",
    "docente" => "abcd"
];

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST['usuario'] ?? "");
    $clave   = $_POST['clave'] ?? "";

    if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $clave) {
        session_regenerate_id(true);
        $_SESSION['usuario'] = $usuario;
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
        header("Location: productos.php");
        exit();
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Login | Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fa;
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            max-width: 420px;
            margin: 60px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        }

        h3{
            color: #6f42c1;
        }

        .btn-custom {
            background-color: #6f42c1;
            color: white;
            transition: all .2s;
        }

        .btn-custom:hover {
            background-color: #59309c;
            transform: scale(1.05);
            color: #fff;
        }

        .suggestion-box {
            background: #e9ecef;
            border-radius: 10px;
            padding: 12px;
            margin: 8px 0;
            font-size: 14px;
            color: #444;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #dc3545;
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
            background-color: #bb2d3b;
            text-decoration: none;
            color: #fff;
        }   
    </style>
</head>

<body>
    <div class="login-card">
        <h3 class="text-center"><b>Iniciar Sesión</b></h3>

        <?php if ($mensaje): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>

        <form method="post" action="login.php" autocomplete="off">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="clave" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="clave" name="clave" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">
                <i class="fa fa-sign-in-alt"></i> Ingresar
            </button>
        </form>

        <h6 class="mt-4 text-secondary">Credenciales de acceso:</h6>
        <div class="suggestion-box"><i class="fa fa-user"></i> Usuario: <strong>admin</strong> | Contraseña: <strong>1234</strong></div>
        <div class="suggestion-box"><i class="fa fa-user"></i> Usuario: <strong>docente</strong> | Contraseña: <strong>abcd</strong></div>
    </div>

    <div class="text-center">
        <a href="../../home.php" class="btn-back">
            <i class="fa-solid fa-house"></i> Volver al Home
        </a>
    </div>

</body>

</html>
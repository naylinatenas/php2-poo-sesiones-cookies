<?php
session_start();

// procesar formulario si se envío
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['clave']);

    if ($usuario === "admin" && $clave === "1234") {
        $_SESSION['usuario'] = $usuario;
        header("Location: bienvenida.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #bbdefb;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            min-width: 400px;
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            text-align: center;
            margin-bottom: 25px;
            color: #0d6efd;
            font-weight: 600;
        }

        .form-control {
            border-radius: 12px;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            cursor: pointer;
            color: #666;
            font-size: 1.2rem;
        }

        .toggle-password:hover {
            color: #0d6efd;
        }

        .btn-primary {
            width: 100%;
            border-radius: 12px;
            padding: 10px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .alert-danger {
            border-radius: 10px;
            text-align: center;
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
    <div>
        <div class="login-container">
            <h2 class="login-title">Iniciar Sesión</h2>

            <?php if (isset($error)) : ?>
                <div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label fw-semibold">Usuario</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" required placeholder="Ingrese su usuario">
                </div>

                <div class="mb-4 password-wrapper">
                    <label for="clave" class="form-label fw-semibold">Contraseña</label>
                    <input type="password" class="form-control" name="clave" id="clave" required placeholder="Ingrese su contraseña">
                    <i class="bi bi-eye toggle-password" id="togglePassword"></i>
                </div>

                <input type="submit" value="Ingresar" class="btn btn-primary">
            </form>
        </div>
        <div class="text-center">
            <a href="../../home.php" class="btn-back">
                <i class="fa fa-home"></i> Volver al Home
            </a>
        </div>
    </div>



    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('clave');

        togglePassword.addEventListener('click', () => {
            const tipo = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', tipo);

            togglePassword.classList.toggle('bi-eye');
            togglePassword.classList.toggle('bi-eye-slash');
        });
    </script>

</body>

</html>
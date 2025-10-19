<?php
// home.php
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Home - Ejercicios PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f9fafc, #f1f3f6);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        html,
        body {
            height: 100%;
        }

        .footer {
            background: linear-gradient(135deg, rgba(255, 71, 87, 0.9), rgba(255, 107, 107, 0.9));
            color: white;
            margin-top: auto;
        }
        

        .text-heart i {
            color: #ffccd2;
            filter: drop-shadow(0 0 2px rgba(255, 255, 255, 0.6));
        }

        .footer a {
            color: white;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: #ffeaea;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(90deg, #ff6b6b, #ff4757);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: #fff !important;
            font-size: 1.4rem;
        }

        /* TARJETAS */
        .card {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            color: #fff;
        }

        .card-header {
            background: linear-gradient(90deg, #ff6b6b, #ff4757);
            color: white;
            text-align: center;
            padding: 1.5rem 0;
        }

        .card-header i {
            display: block;
            margin-bottom: 0.4rem;
        }

        .card-header h5 {
            font-weight: 600;
            margin: 0;
        }

        /* BOTONES */
        .btn-ejercicio {
            background: linear-gradient(90deg, #ff6b6b, #ff4757);
            border: none;
            color: white;
            border-radius: 10px;
            font-weight: 500;
            padding: 0.7rem 0;
            transition: all 0.25s ease;
        }

        .btn-ejercicio:hover {
            background: linear-gradient(90deg, #ff4a4a, #ff2e43);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 71, 87, 0.3);
        }

        /* TÍTULOS */
        h5.fw-bold {
            font-size: 1.2rem;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold" href="home.php">
                <i class="fa-solid fa-code me-2"></i> Ejercicios PHP
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row g-4">

            <!-- POO -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="fa-solid fa-cubes fa-2x"></i>
                        <h5 class="fw-bold">POO</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><a href="poo/1-ejercicio.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio 1</a></li>
                            <li><a href="poo/2-ejercicio.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio 2</a></li>
                            <li><a href="poo/3-ejercicio.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio 3</a></li>
                            <li><a href="poo/4-ejercicio.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio 4</a></li>
                            <li><a href="poo/5-ejercicio.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio 5</a></li>
                            <li><a href="poo/ejercicio-propuesto.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio Propuesto - Cálculo de rectangulo</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Sesiones -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="fa-solid fa-lock fa-2x"></i>
                        <h5 class="fw-bold">Sesiones</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><a href="sesiones/1-ejercicio.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio 1</a></li>
                            <li><a href="sesiones/2-ejercicio/paso1.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio 2</a></li>
                            <li><a href="sesiones/3-ejercicio/formulario.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio 3</a></li>
                            <li><a href="sesiones/4-ejercicio.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio 4</a></li>
                            <li><a href="sesiones/5-ejercicio.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio 5</a></li>
                            <li><a href="sesiones/ejercicio-propuesto/bienvenida.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio Propuesto 1 - Inicio de sesión</a></li>
                            <li><a href="sesiones/ejercicio-propuesto2/login.php" class="btn btn-ejercicio w-100 mb-2">Ejercicio Propuesto 2 - Carrito de compra </a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Cookies -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="fa-solid fa-cookie-bite fa-2x"></i>
                        <h5 class="fw-bold">Cookies</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><a href="cookie/bienvenida_cookie.php" class="btn btn-ejercicio w-100 mb-2">Bienvenida Cookie</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer class="footer mt-auto py-4 text-center">
        <p class="mb-2">
            &copy; <?php echo date('Y'); ?> | Hecho con
            <span class="text-heart"><i class="fa-solid fa-heart"></i></span>
            por <strong>Naylin Acosta Plasencia</strong>
        </p>
        <div>
            <a href="https://github.com/naylinatenas" target="_blank" class="text-white me-3"><i class="fa-brands fa-github fa-lg"></i></a>
            <a href="https://linkedin.com/in/nacostadev" target="_blank" class="text-white me-3"><i class="fa-brands fa-linkedin fa-lg"></i></a>
        </div>
    </footer>

</body>

</html>
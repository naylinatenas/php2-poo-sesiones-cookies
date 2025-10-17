<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - Generador de Credenciales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        h1 {
            font-weight: 600;
            color: #0d6efd;
            text-align: center;
            margin-top: 40px;
        }

        h2 {
            text-align: center;
            color: #6c757d;
            margin-bottom: 30px;
            font-size: 1rem;
        }

        .form-container {
            background-color: #ffffff;
            max-width: 650px;
            margin: auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(13, 110, 253, 0.06);
        }

        .result-box {
            background-color: #e8f0fe;
            border-radius: 8px;
            padding: 20px;
            margin-top: 25px;
        }

        .btn i {
            margin-right: 6px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
            margin-top: 28px;
        }

        .btn-back:hover {
            background-color: #0056b3;
            text-decoration: none;
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 20px;
            }

            .btn-back {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    <script>
        function limpiarResultados() {
            document.getElementById("resultado").innerHTML = "";
            document.getElementById("resultado").style.display = "none";
            document.getElementById("formUsuario").reset();
        }
    </script>
</head>

<body>

    <h1><i class="fa-solid fa-id-card me-2"></i> Generador de Credenciales</h1>
    <h2>Valida el usuario y genera una contraseña segura</h2>

    <div class="form-container">
        <form id="formUsuario" method="post">
            <div class="mb-3">
                <label class="form-label fw-semibold">Nombre completo:</label>
                <input type="text" class="form-control" name="nombreCompleto" placeholder="Ej. Juan Pérez" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">DNI (8 dígitos):</label>
                <input type="number" class="form-control" name="dni" placeholder="Ej. 12345678" pattern="\d{8}" title="Debe tener 8 dígitos" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" name="generar" class="btn btn-primary px-4">
                    <i class="fa-solid fa-gears"></i> Generar
                </button>
                <button type="button" onclick="limpiarResultados()" class="btn btn-secondary px-4">
                    <i class="fa-solid fa-eraser"></i> Borrar
                </button>
            </div>
        </form>

        <?php
        $resultadoVisible = false;
        $contenidoResultado = "";

        class Usuario
        {
            private $nombreCompleto;
            private $dni;

            public function __construct($nombreCompleto, $dni)
            {
                $this->nombreCompleto = $nombreCompleto;
                $this->dni = $dni;
            }

            public function getNombreCompleto()
            {
                return $this->nombreCompleto;
            }
            public function getDni()
            {
                return $this->dni;
            }

            public function setNombreCompleto($nombreCompleto)
            {
                $this->nombreCompleto = $nombreCompleto;
            }
            public function setDni($dni)
            {
                $this->dni = $dni;
            }

            public function generarUsuario()
            {
                $nombreLimpio = preg_replace('/\s+/', '', $this->nombreCompleto);
                $nombreMin = strtolower($nombreLimpio);
                $primerasTres = substr($nombreMin, 0, 3);
                $ultimosCuatro = substr($this->dni, -4);
                return $primerasTres . $ultimosCuatro;
            }

            public function generarClave()
            {
                $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $clave = '';
                for ($i = 0; $i < 8; $i++) {
                    $clave .= $caracteres[random_int(0, strlen($caracteres) - 1)];
                }
                return $clave;
            }
        }

        if (isset($_POST["generar"])) {
            $nombre = trim($_POST["nombreCompleto"]);
            $dni = trim($_POST["dni"]);

            try {
                if (empty($nombre)) {
                    $contenidoResultado = "<p class='text-danger fw-bold'><i class='fa-solid fa-triangle-exclamation me-1'></i> El nombre es obligatorio.</p>";
                } elseif (!preg_match('/^\d{8}$/', $dni)) {
                    $contenidoResultado = "<p class='text-danger fw-bold'><i class='fa-solid fa-triangle-exclamation me-1'></i> El DNI debe tener exactamente 8 dígitos.</p>";
                } else {
                    $usuario = new Usuario($nombre, $dni);
                    $usuarioSugerido = $usuario->generarUsuario();
                    $claveGenerada = $usuario->generarClave();

                    $contenidoResultado = "
                        <h3 class='mb-3'><i class='fa-solid fa-circle-info me-1'></i> Resultado:</h3>
                        <p><strong>Nombre completo:</strong> " . htmlspecialchars($usuario->getNombreCompleto()) . "</p>
                        <p><strong>DNI:</strong> " . htmlspecialchars($usuario->getDni()) . "</p>
                        <hr>
                        <p><strong>Usuario sugerido:</strong> {$usuarioSugerido}</p>
                        <p><strong>Clave generada:</strong> {$claveGenerada}</p>";
                }
                $resultadoVisible = true;
            } catch (Exception $e) {
                $contenidoResultado = "<p class='text-danger'><i class='fa-solid fa-circle-exclamation me-1'></i> Error: " . htmlspecialchars($e->getMessage()) . "</p>";
                $resultadoVisible = true;
            }
        }
        ?>

        <div id="resultado" class="result-box" style="display: <?= $resultadoVisible ? 'block' : 'none' ?>;">
            <?= $contenidoResultado ?>
        </div>
    </div>

    <div class="text-center">
        <a href="../home.php" class="btn-back">
            <i class="fa-solid fa-house"></i> Volver al Home
        </a>
    </div>

</body>

</html>

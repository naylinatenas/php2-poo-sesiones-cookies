<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 02 - Gestión de estudiantes y promedio de notas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Inter', 'Poppins', sans-serif;
            color: #333;
        }

        h1 {
            font-weight: 600;
            text-align: center;
            margin-top: 40px;
            color: #0d6efd;
        }

        h2 {
            text-align: center;
            font-size: 1rem;
            color: #666;
            margin-bottom: 40px;
        }

        .form-container {
            background-color: #fff;
            border-radius: 12px;
            padding: 30px;
            max-width: 700px;
            margin: auto;
            border: 1px solid #e0e0e0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            color: #333;
            transition: 0.3s;
        }

        .btn-secondary:hover {
            background-color: #e0e0e0;
        }

        .result-box {
            background-color: #e8f0fe;
            border-left: 5px solid #007bff;
            border-radius: 8px;
            padding: 20px;
            margin-top: 25px;
            transition: opacity 0.4s ease;
        }

        .result-box h3 {
            color: #007bff;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .estado-aprobado {
            font-weight: bold;
            color: #4caf50;
        }

        .estado-desaprobado {
            font-weight: bold;
            color: #d32f2f;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-back:hover {
            background-color: #0056b3;
            text-decoration: none;
        }

        .back-container {
            text-align: center;
            margin-top: 30px;
        }
    </style>

    <script>
        function limpiarResultados() {
            document.getElementById("resultado").innerHTML = "";
            document.getElementById("resultado").style.display = "none";
            document.getElementById("formEstudiante").reset();
        }
    </script>
</head>

<body>
    <div class="container py-4">
        <h1>Ejercicio 02 - Gestión de estudiantes y promedio de notas</h1>  

        <div class="form-container">
            <form id="formEstudiante" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label fw-semibold"> Nombre del estudiante: </label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold"> Nota 1: </label>
                        <input type="number" class="form-control" name="nota1" step="0.01" max="20" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold"> Nota 2: </label>
                        <input type="number" class="form-control" name="nota2" step="0.01" max="20" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold"> Nota 3: </label>
                        <input type="number" class="form-control" name="nota3" step="0.01" max="20" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <input type="submit" name="calcular" value="Calcular" class="btn btn-primary px-4">
                    <input type="button" value="Borrar" onclick="limpiarResultados()" class="btn btn-secondary px-4">
                </div>
            </form>

            <?php
            $resultadoVisible = false;
            $contenidoResultado = "";

            class Estudiante {
                private $nombre;
                private $notas = [];

                public function __construct($nombre) {
                    $this->nombre = $nombre;
                }

                public function agregarNota($nota) {
                    if ($nota >= 0 && $nota <= 20) {
                        $this->notas[] = $nota;
                    } else {
                        throw new Exception("Las notas deben estar entre 0 y 20");
                    }
                }

                public function calcularPromedio() {
                    if (count($this->notas) === 0) {
                        return 0;
                    } else {
                        return round(array_sum($this->notas) / count($this->notas), 2);
                    }
                }

                public function estado() {
                    $promedio = $this->calcularPromedio();
                    return $promedio >= 13
                        ? "<span class='estado-aprobado'>Aprobado</span>"
                        : "<span class='estado-desaprobado'>Desaprobado</span>";
                }

                public function getNombre() {
                    return $this->nombre;
                }

                public function getNotas() {
                    return $this->notas;
                }
            }

            if (isset($_POST["calcular"])) {
                $nombre = trim($_POST["nombre"]);
                $nota1 = floatval($_POST["nota1"]);
                $nota2 = floatval($_POST["nota2"]);
                $nota3 = floatval($_POST["nota3"]);

                try {
                    if (empty($nombre)) {
                        $contenidoResultado = "<p class='text-danger fw-bold'>⚠️ El nombre del estudiante es obligatorio.</p>";
                    } else {
                        $estudiante = new Estudiante($nombre);
                        $estudiante->agregarNota($nota1);
                        $estudiante->agregarNota($nota2);
                        $estudiante->agregarNota($nota3);

                        $contenidoResultado = "
                            <h3>Resultados:</h3>
                            <p><strong>Estudiante:</strong> {$estudiante->getNombre()}</p>
                            <p><strong>Notas:</strong> " . implode(', ', $estudiante->getNotas()) . "</p>
                            <p><strong>Promedio:</strong> {$estudiante->calcularPromedio()}</p>
                            <p><strong>Estado:</strong> {$estudiante->estado()}</p>";
                    }
                    $resultadoVisible = true;
                } catch (Exception $e) {
                    $contenidoResultado = "<p class='text-danger'>Error: " . $e->getMessage() . "</p>";
                    $resultadoVisible = true;
                }
            }
            ?>
            <div id="resultado" class="result-box" style="display: <?= $resultadoVisible ? 'block' : 'none' ?>;">
                <?= $contenidoResultado ?>
            </div>
        </div>

        <div class="back-container">
            <a href="../home.php" class="btn-back">
                <i class="fa-solid fa-house"></i> Volver al Home
            </a>
        </div>
    </div>
</body>
</html>

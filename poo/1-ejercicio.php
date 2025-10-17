<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 01 - Cálculo del IMC</title>
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
            color: #007bff;
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
            max-width: 600px;
            margin: auto;
            border: 1px solid #e0e0e0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .btn-primary {
            background-color: #007bff;
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

        .classification {
            font-weight: bold;
        }

        .bajo { color: #ff9800; }
        .normal { color: #4caf50; }
        .sobrepeso { color: #ff5722; }
        .obesidad { color: #d32f2f; }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #007bff;
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

        footer {
            text-align: center;
            color: #aaa;
            font-size: 0.9rem;
            margin-top: 60px;
        }
    </style>

    <script>
        function limpiarResultados() {
            document.getElementById("resultado").innerHTML = "";
            document.getElementById("resultado").style.display = "none";
            document.getElementById("formIMC").reset();
        }
    </script>
</head>
<body>
    <div class="container py-4">
        <h1>Ejercicio 01 - Cálculo del IMC</h1>
        <h2>(Índice de masa corporal)</h2>

        <div class="form-container">
            <form id="formIMC" method="post">
                <div class="mb-3">
                    <label for="peso" class="form-label fw-semibold"> Peso(Kg): </label>
                    <input type="number" class="form-control" name="peso" step="0.01" min="0" required>
                </div>
                <div class="mb-3">
                    <label for="altura" class="form-label fw-semibold"> Altura(M): </label>
                    <input type="number" class="form-control" name="altura" step="0.01" min="0" required>
                </div>
                <div class="d-flex justify-content-between">
                    <input type="submit" name="calcular" value="Calcular" class="btn btn-primary px-4">
                    <input type="button" value="Borrar" onclick="limpiarResultados()" class="btn btn-secondary px-4">
                </div>
            </form>

            <?php
            $resultadoVisible = false;
            $contenidoResultado = "";

            class Persona {
                private $peso;
                private $altura;

                public function __construct($peso, $altura) {
                    $this->setPeso($peso);
                    $this->setAltura($altura);
                }

                public function setPeso($peso) {
                    if ($peso > 0) {
                        $this->peso = $peso;
                    } else {
                        throw new Exception("La peso debe ser un valor positivo.");
                    }
                }

                public function setAltura($altura) {
                    if ($altura > 0) {
                        $this->altura = $altura;
                    } else {
                        throw new Exception("La altura debe ser un valor positivo.");
                    }
                }

                public function getPeso() {
                    return $this->peso;
                }

                public function getAltura() {
                    return $this->altura;
                }

                public function calcularIMC() {
                    $imc = $this->peso / pow($this->altura, 2);
                    return round($imc, 2);
                }

                public function clasificarIMC() {
                    $imc = $this->calcularIMC();
                    if ($imc < 18.5) {
                        return "<span class='classification bajo'>Bajo peso</span>";
                    } elseif ($imc < 25) {
                        return "<span class='classification normal'>Normal</span>";
                    } elseif ($imc < 30) {
                        return "<span class='classification sobrepeso'>Sobrepeso</span>";
                    } else {
                        return "<span class='classification obesidad'>Obesidad</span>";
                    }
                }
            }

            if (isset($_POST["calcular"])) {
                $peso = floatval($_POST["peso"]);
                $altura = floatval($_POST["altura"]);

                try {
                    if ($peso <= 0 || $altura <= 0) {
                        $contenidoResultado = "<p class='text-danger fw-bold'>⚠️ Ambos valores deben ser mayores a cero.</p>";
                    } else {
                        $persona = new Persona($peso, $altura);
                        $contenidoResultado = "
                            <h3>Resultados:</h3>
                            <p><strong>Peso:</strong> {$persona->getPeso()}</p>
                            <p><strong>Altura:</strong> {$persona->getAltura()}</p>
                            <p><strong>IMC:</strong> {$persona->calcularIMC()}</p>
                            <p><strong>Clasificación:</strong> {$persona->clasificarIMC()}</p>";
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

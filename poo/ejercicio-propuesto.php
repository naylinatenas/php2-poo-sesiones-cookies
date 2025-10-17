<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rectangulo con POO y botón borrar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #fafafa;
            font-family: 'Inter', 'Poppins', sans-serif;
            color: #333;
        }

        h1 {
            font-weight: 600;
            text-align: center;
            margin-top: 40px;
            color: #ff6f00;
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
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background-color: #ff6f00;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #e65100;
        }

        .btn-secondary {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            color: #333;
        }

        .btn-secondary:hover {
            background-color: #e0e0e0;
        }

        .btn i {
            margin-right: 6px;
        }

        .result-box {
            background-color: #fff8e1;
            border: 5px dashed #ffe0b2;
            border-radius: 10px;
            padding: 20px;
            margin-top: 25px;
        }

        .result-box h3 {
            color: #ff6f00;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #ff6f00;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.2s;
            margin-top: 30px;
        }

        .btn-back:hover {
            background-color: #e65100;
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
            document.getElementById("formRectangulo").reset();
        }
    </script>
</head>

<body>

    <div class="container py-4">
        <h1><i class="fa-solid fa-draw-polygon me-2"></i> Cálculo de Rectángulo</h1>
        <h2>Área, Perímetro y Diagonal</h2>

        <div class="form-container">
            <form method="POST" id="formRectangulo">
                <div class="mb-3">
                    <label for="base" class="form-label fw-semibold">Base (en unidades):</label>
                    <input type="number" class="form-control" name="base" step="0.01" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="altura" class="form-label fw-semibold">Altura (en unidades):</label>
                    <input type="number" class="form-control" name="altura" step="0.01" min="0" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" name="calcular" class="btn btn-primary px-4">
                        <i class="fa-solid fa-calculator"></i> Calcular
                    </button>
                    <button type="button" onclick="limpiarResultados()" class="btn btn-secondary px-4">
                        <i class="fa-solid fa-eraser"></i> Borrar
                    </button>
                </div>
            </form>

            <?php
            $resultadoVisible = false;
            $contenidoResultado = "";

            class Rectangulo
            {
                private $base;
                private $altura;

                public function __construct($base, $altura)
                {
                    $this->setBase($base);
                    $this->setAltura($altura);
                }

                public function setBase($base)
                {
                    if ($base > 0) {
                        $this->base = $base;
                    } else {
                        throw new Exception("La base debe ser un valor positivo.");
                    }
                }

                public function setAltura($altura)
                {
                    if ($altura > 0) {
                        $this->altura = $altura;
                    } else {
                        throw new Exception("La altura debe ser un valor positivo.");
                    }
                }

                public function getBase()
                {
                    return $this->base;
                }

                public function getAltura()
                {
                    return $this->altura;
                }

                public function calcularArea()
                {
                    return $this->base * $this->altura;
                }

                public function calcularPerimetro()
                {
                    return 2 * ($this->base + $this->altura);
                }

                public function calcularDiagonal()
                {
                    return sqrt(pow($this->base, 2) + pow($this->altura, 2));
                }
            }

            if (isset($_POST["calcular"])) {
                $base = floatval($_POST["base"]);
                $altura = floatval($_POST["altura"]);

                try {
                    if ($base <= 0 || $altura <= 0) {
                        $contenidoResultado = "<p class='text-danger fw-bold'><i class='fa-solid fa-triangle-exclamation me-1'></i> Ambos valores deben ser mayores a cero.</p>";
                    } else {
                        $rectangulo = new Rectangulo($base, $altura);
                        $contenidoResultado = "
                            <h3><i class='fa-solid fa-ruler-combined me-1'></i> Resultados:</h3>
                            <p><strong>Base:</strong> {$rectangulo->getBase()}</p>
                            <p><strong>Altura:</strong> {$rectangulo->getAltura()}</p>
                            <hr>
                            <p><strong>Área:</strong> " . number_format($rectangulo->calcularArea(), 2) . "</p>
                            <p><strong>Perímetro:</strong> " . number_format($rectangulo->calcularPerimetro(), 2) . "</p>
                            <p><strong>Diagonal:</strong> " . number_format($rectangulo->calcularDiagonal(), 2) . "</p>";
                    }
                    $resultadoVisible = true;
                } catch (Exception $e) {
                    $contenidoResultado = "<p class='text-danger'><i class='fa-solid fa-circle-exclamation me-1'></i> Error: " . $e->getMessage() . "</p>";
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

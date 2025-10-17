<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 - Validación de Límite</title>
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
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            border: 1px solid rgba(13,110,253,0.06);
        }
        .result-box {
            background-color: #e8f0fe;
            border-radius: 8px;
            padding: 20px;
            margin-top: 25px;
        }
        .aprobado {
            color: #198754;
            font-weight: 600;
        }
        .rechazado {
            color: #d32f2f;
            font-weight: 600;
        }
        .btn i { margin-right: 6px; }
        .back-container {
            text-align: center;
            margin-top: 28px;
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
        }
        .btn-back:hover {
            background-color: #0056b3;
            text-decoration: none;
        }

        /* small improvements for mobile spacing */
        @media (max-width: 576px) {
            .form-container { padding: 20px; }
            .btn-back { width: 100%; justify-content: center; }
        }
    </style>
    <script>
        function limpiarResultados() {
            document.getElementById("resultado").innerHTML = "";
            document.getElementById("resultado").style.display = "none";
            document.getElementById("formTarjeta").reset();
        }
    </script>
</head>
<body>

    <h1><i class="fa-solid fa-credit-card me-2"></i> Tarjeta de Crédito</h1>
    <h2>Validación de límite de crédito</h2>

    <div class="form-container">
        <form id="formTarjeta" method="post">
            <div class="mb-3">
                <label class="form-label fw-semibold">Titular:</label>
                <input type="text" class="form-control" name="titular" placeholder="Ingrese el nombre del titular" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Límite de crédito (S/):</label>
                <input type="number" step="0.01" class="form-control" name="limite" min="0.01" placeholder="Ej. 2000.00" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Monto a comprar (S/):</label>
                <input type="number" step="0.01" class="form-control" name="monto" min="0.01" placeholder="Ej. 350.50" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" name="calcular" class="btn btn-primary px-4">
                    <i class="fa-solid fa-circle-check"></i> Realizar Compra
                </button>
                <button type="button" onclick="limpiarResultados()" class="btn btn-secondary px-4">
                    <i class="fa-solid fa-eraser"></i> Borrar
                </button>
            </div>
        </form>

        <?php
        $resultadoVisible = false;
        $contenidoResultado = "";

        class TarjetaCredito {
            private $titular;
            private $limite;
            private $consumo;

            public function __construct($titular, $limite) {
                $this->titular = $titular;
                $this->limite = $limite;
                $this->consumo = 0;
            }

            public function realizarCompra($monto) {
                if ($monto <= 0) {
                    throw new Exception("El monto debe ser mayor que 0");
                }
                if ($this->consumo + $monto > $this->limite) {
                    return false; // excede límite
                } else {
                    $this->consumo += $monto;
                    return true;
                }
            }

            public function saldoDisponible() {
                return $this->limite - $this->consumo;
            }

            public function getTitular() {
                return $this->titular;
            }

            public function getLimite() {
                return $this->limite;
            }

            public function getConsumo() {
                return $this->consumo;
            }
        }

        if (isset($_POST["calcular"])) {
            $titular = trim($_POST["titular"]);
            $limite = floatval($_POST["limite"]);
            $monto = floatval($_POST["monto"]);

            try {
                if (empty($titular)) {
                    $contenidoResultado = "<p class='text-danger fw-bold'><i class='fa-solid fa-triangle-exclamation me-1'></i> El nombre del titular es obligatorio.</p>";
                } elseif ($limite <= 0 || $monto <= 0) {
                    $contenidoResultado = "<p class='text-danger fw-bold'><i class='fa-solid fa-triangle-exclamation me-1'></i> El límite y el monto deben ser valores positivos.</p>";
                } else {
                    $tarjeta = new TarjetaCredito($titular, $limite);
                    $compraAprobada = $tarjeta->realizarCompra($monto);
                    $saldo = number_format($tarjeta->saldoDisponible(), 2);
                    $limiteFormateado = number_format($tarjeta->getLimite(), 2);
                    $montoFormateado = number_format($monto, 2);

                    if ($compraAprobada) {
                        $contenidoResultado = "
                            <h3 class='mb-3'><i class='fa-solid fa-circle-info me-1'></i> Resultado:</h3>
                            <p><strong>Titular:</strong> " . htmlspecialchars($tarjeta->getTitular()) . "</p>
                            <p><strong>Límite:</strong> S/ {$limiteFormateado}</p>
                            <p><strong>Monto de compra:</strong> S/ {$montoFormateado}</p>
                            <p class='aprobado'><i class='fa-solid fa-check-circle me-1'></i> Compra aprobada</p>
                            <hr>
                            <p><strong>Saldo disponible:</strong> S/ {$saldo}</p>";
                    } else {
                        $contenidoResultado = "
                            <h3 class='mb-3'><i class='fa-solid fa-circle-info me-1'></i> Resultado:</h3>
                            <p><strong>Titular:</strong> " . htmlspecialchars($tarjeta->getTitular()) . "</p>
                            <p><strong>Límite:</strong> S/ {$limiteFormateado}</p>
                            <p><strong>Monto de compra:</strong> S/ {$montoFormateado}</p>
                            <p class='rechazado'><i class='fa-solid fa-ban me-1'></i> Compra rechazada: excede el límite</p>
                            <hr>
                            <p><strong>Saldo disponible:</strong> S/ {$saldo}</p>";
                    }
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

    <div class="back-container">
        <a href="../home.php" class="btn-back" title="Volver al Home">
            <i class="fa-solid fa-house"></i> Volver al Home
        </a>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 03 - Simulador de Compra</title>

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
            max-width: 650px;
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
            document.getElementById("formProducto").reset();
        }
    </script>
</head>

<body>

    <div class="container py-4">
        <h1>Ejercicio 03 - Simulador de Compra</h1>
        <h2>Calcula el IGV (18%) y el total a pagar</h2>

        <div class="form-container">
            <form id="formProducto" method="post">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nombre del producto:</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Precio unitario (S/):</label>
                    <input type="number" step="0.01" class="form-control" name="precio" min="0.01" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Cantidad:</label>
                    <input type="number" class="form-control" name="cantidad" min="1" required>
                </div>
                <div class="d-flex justify-content-between">
                    <input type="submit" name="calcular" value="Calcular" class="btn btn-primary px-4">
                    <input type="button" value="Borrar" onclick="limpiarResultados()" class="btn btn-secondary px-4">
                </div>
            </form>

            <?php
            $resultadoVisible = false;
            $contenidoResultado = "";

            class Producto {
                private $nombre;
                private $precioUnitario;
                private $cantidad;

                public function __construct($nombre, $precioUnitario, $cantidad) {
                    $this->nombre = $nombre;
                    $this->precioUnitario = $precioUnitario;
                    $this->cantidad = $cantidad;
                }

                public function calcularSubtotal() {
                    return $this->precioUnitario * $this->cantidad;
                }

                public function calcularIGV() {
                    return $this->calcularSubtotal() * 0.18;
                }

                public function calcularTotal() {
                    return $this->calcularSubtotal() + $this->calcularIGV();
                }

                public function getNombre() {
                    return $this->nombre;
                }

                public function getPrecioUnitario() {
                    return $this->precioUnitario;
                }

                public function getCantidad() {
                    return $this->cantidad;
                }

                public function setNombre($nombre) {
                    $this->nombre = $nombre;
                }

                public function setPrecioUnitario($precioUnitario) {
                    if ($precioUnitario > 0) {
                        $this->precioUnitario = $precioUnitario;
                    } else {
                        throw new Exception("El precio unitario debe ser mayor que 0");
                    }
                }

                public function setCantidad($cantidad) {
                    if ($cantidad > 0) {
                        $this->cantidad = $cantidad;
                    } else {
                        throw new Exception("La cantidad debe ser mayor que 0");
                    }
                }
            }

            if (isset($_POST["calcular"])) {
                $nombre = trim($_POST["nombre"]);
                $precio = floatval($_POST["precio"]);
                $cantidad = intval($_POST["cantidad"]);

                try {
                    if (empty($nombre)) {
                        $contenidoResultado = "<p class='text-danger fw-bold'>⚠️ El nombre del producto es obligatorio.</p>";
                    } elseif ($precio <= 0 || $cantidad <= 0) {
                        $contenidoResultado = "<p class='text-danger fw-bold'>⚠️ El precio y la cantidad deben ser valores positivos.</p>";
                    } else {
                        $producto = new Producto($nombre, $precio, $cantidad);

                        $subtotal = number_format($producto->calcularSubtotal(), 2);
                        $igv = number_format($producto->calcularIGV(), 2);
                        $total = number_format($producto->calcularTotal(), 2);

                        $contenidoResultado = "
                            <h3>Resultado:</h3>
                            <p><strong>Producto:</strong> {$producto->getNombre()}</p>
                            <p><strong>Precio unitario:</strong> S/ {$producto->getPrecioUnitario()}</p>
                            <p><strong>Cantidad:</strong> {$producto->getCantidad()}</p>
                            <hr>
                            <p><strong>Subtotal:</strong> S/ {$subtotal}</p>
                            <p><strong>IGV (18%):</strong> S/ {$igv}</p>
                            <p><strong>Total a pagar:</strong> S/ {$total}</p>";
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

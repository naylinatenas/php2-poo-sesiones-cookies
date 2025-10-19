<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$productos = [
    ["id" => "P100", "nombre" => "Laptop 14''", "precio" => 2100.00],
    ["id" => "P200", "nombre" => "Mouse Inalámbrico", "precio" => 75.90],
    ["id" => "P300", "nombre" => "Teclado Mecánico", "precio" => 159.00],
    ["id" => "P400", "nombre" => "Monitor 24'' FHD", "precio" => 680.50],
    ["id" => "P500", "nombre" => "Headset USB", "precio" => 129.90],
];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

function buscarProducto($productos, $id) {
    foreach ($productos as $p) {
        if ($p['id'] === $id) return $p;
    }
    return null;
}

// Añadir
if (isset($_GET['add'])) {
    $id = $_GET['add'];
    $prod = buscarProducto($productos, $id);
    if ($prod) {
        $_SESSION['carrito'][$id] = ($_SESSION['carrito'][$id] ?? 0) + 1;
    }
    header("Location: productos.php");
    exit();
}

// Quitar
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]--;
        if ($_SESSION['carrito'][$id] <= 0) unset($_SESSION['carrito'][$id]);
    }
    header("Location: productos.php");
    exit();
}

// Vaciar
if (isset($_GET['clear'])) {
    $_SESSION['carrito'] = [];
    header("Location: productos.php");
    exit();
}

$total = 0.0;
foreach ($_SESSION['carrito'] as $id => $cant) {
    $p = buscarProducto($productos, $id);
    if ($p) $total += $p['precio'] * $cant;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Productos | Carrito</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body { background: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
    .navbar { background: #6f42c1; }
    .navbar .nav-link, .navbar .navbar-brand { color: white !important; }
    .navbar .btn { transition: transform 0.2s; }
    .navbar .btn:hover { transform: scale(1.05); }

    .card-product {
      border: none; border-radius: 12px; transition: all 0.2s ease-in-out;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .card-product:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    }
    .btn-add {
      background: #28a745; border: none;
    }
    .btn-add:hover {
      background: #218838;
    }

    .carrito-card {
      border-radius: 12px; padding: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      background: white;
    }
    .table thead { background: #e9ecef; }
    .total-row { font-size: 1.1rem; color: #28a745; font-weight: bold; }
  </style>
</head>
<body>

<nav class="navbar px-4">
  <span class="navbar-brand fw-bold"><i class="fa fa-shopping-cart"></i> Mini Carrito</span>
  <div class="d-flex align-items-center">
    <span class="me-3 text-white"><i class="fa fa-user"></i> <?= htmlspecialchars($_SESSION['usuario']) ?></span>
    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#logoutModal">
      <i class="fa fa-sign-out-alt"></i> Cerrar sesión
    </button>
  </div>
</nav>

<div class="container py-4">

  <h4 class="text-secondary mb-3">Catálogo</h4>
  <div class="row g-3">
    <?php foreach ($productos as $p): ?>
      <div class="col-md-4">
        <div class="card card-product h-100 text-center p-3">
          <h5 class="text-dark"><?= htmlspecialchars($p['nombre']) ?></h5>
          <p class="text-muted small">ID: <?= $p['id'] ?></p>
          <p class="fw-bold text-success">S/ <?= number_format($p['precio'], 2) ?></p>
          <a href="productos.php?add=<?= urlencode($p['id']) ?>" class="btn btn-add text-white w-100">
            <i class="fa fa-cart-plus"></i> Añadir
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <h4 class="text-secondary mt-5">Carrito</h4>
  <div class="carrito-card mt-3">
    <?php if (empty($_SESSION['carrito'])): ?>
      <p class="text-muted">Tu carrito está vacío.</p>
    <?php else: ?>
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Producto</th><th>Cant.</th><th>Precio</th><th>Subtotal</th><th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($_SESSION['carrito'] as $id => $cant): 
            $prod = buscarProducto($productos, $id);
            if (!$prod) continue;
            $subtotal = $prod['precio'] * $cant;
          ?>
          <tr>
            <td><?= htmlspecialchars($prod['nombre']) ?></td>
            <td><?= $cant ?></td>
            <td>S/ <?= number_format($prod['precio'], 2) ?></td>
            <td>S/ <?= number_format($subtotal, 2) ?></td>
            <td>
              <a href="productos.php?add=<?= urlencode($id) ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
              <a href="productos.php?remove=<?= urlencode($id) ?>" class="btn btn-sm btn-warning"><i class="fa fa-minus"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" class="text-end">Total</td>
            <td colspan="2" class="total-row">S/ <?= number_format($total, 2) ?></td>
          </tr>
        </tfoot>
      </table>
      <a href="productos.php?clear=1" class="btn btn-outline-danger">
        <i class="fa fa-trash"></i> Vaciar carrito
      </a>
    <?php endif; ?>
  </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirmar cierre de sesión</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        ¿Seguro que quieres cerrar sesión?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="logout.php" class="btn btn-danger">Sí, cerrar sesión</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

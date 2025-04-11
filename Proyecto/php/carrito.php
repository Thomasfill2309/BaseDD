<?php
include '../php/db.php';

$sql = "SELECT carrito.id, productos.nombre, productos.precio, productos.imagen, carrito.cantidad
        FROM carrito
        JOIN productos ON carrito.producto_id = productos.id";
$result = $conn->query($sql);

$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Carrito de Compras</h1>
    <div class="cart-icon">
            🛒 <span id="cart-count">0</span>
        </div>
        <div id="cart-modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Tu Carrito</h2>
                <div id="cart-items"></div>
                <div class="cart-total">
                    <p>Total: $<span id="cart-total">0.00</span></p>
                    <button id="checkout-btn">Finalizar Compra</button>
                </div>
            </div>
        </div>
        <div id="product-modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Editar Producto</h2>
                <form id="product-form">
                    <input type="hidden" id="product-id">
                    <input type="text" id="product-name" placeholder="Nombre" required>
                    <textarea id="product-description" placeholder="Descripción" required></textarea>
                    <input type="number" id="product-price" placeholder="Precio" step="0.01" required>
                    <input type="text" id="product-image" placeholder="URL de la imagen">
                    <input type="number" id="product-stock" placeholder="Stock" required>
                    <button type="submit">Guardar</button>
                </form>
            </div>
        </div>
</header>

<nav>
    <a href="index.html">Inicio</a>
    <a href="nosotros.html">Nosotros</a>
    <a href="tienda.html">Tienda</a>
    <a href="envios.html">Envíos</a>
    <a href="carrito.php">Carrito</a>
    <a href="favoritos.html">Favoritos</a>
</nav>

<section>
    <h2>Tu Carrito de Compras</h2>
    <div class="carrito">
        <?php while ($row = $result->fetch_assoc()): 
            $subtotal = $row['precio'] * $row['cantidad'];
            $total += $subtotal;
        ?>
        <div class="producto-carrito">
            <img src="<?php echo $row['imagen']; ?>" alt="<?php echo $row['nombre']; ?>" width="100">
            <div class="info-producto">
                <h3><?php echo $row['nombre']; ?></h3>
                <p><strong>Precio:</strong> $<?php echo $row['precio']; ?> MXN</p>
                <form action="actualizar_carrito.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label>Cantidad: <input type="number" name="cantidad" value="<?php echo $row['cantidad']; ?>" min="1"></label>
                    <button type="submit">Actualizar</button>
                </form>
                <p><strong>Subtotal:</strong> $<?php echo $subtotal; ?> MXN</p>
            </div>
            <form action="eliminar_carrito.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit" class="eliminar-producto">Eliminar</button>
            </form>
        </div>
        <?php endwhile; ?>
    </div>

    <div class="total-carrito">
        <h3>Total</h3>
        <p><strong>Subtotal:</strong> $<?php echo $total; ?> MXN</p>
        <p><strong>Envío:</strong> $90 MXN (Envío estándar)</p>
        <p><strong>Total a Pagar:</strong> $<?php echo $total + 90; ?> MXN</p>
    </div>

    <div class="acciones-carrito">
        <a href="tienda.html"><button class="seguir-comprando">Seguir Comprando</button></a>
        <button class="procesar-pago">Proceder a Pago</button>
    </div>
</section>

<footer>
    <p>© 2025 Periféricos Tech | Todos los derechos reservados</p>
</footer>
<script src="js/scp.js"></script>
</body>
</html>

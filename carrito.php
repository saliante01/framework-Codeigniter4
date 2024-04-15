<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="/css/styles.css"> 
</head>
<body>
    <h1>Carrito de Compras</h1>
    <div>
        <?php if ($carrito && count($carrito) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carrito as $id => $item): ?>
                        <tr>
                            <td><?= esc($item['nombre']) ?></td>
                            <td>$<?= esc(number_format($item['precio'], 2)) ?></td>
                            <td>
                                <?= esc($item['cantidad']) ?>
                                
                                <a href="<?= site_url('tienda/aumentarCantidad/' . $id) ?>">+</a>
                                <a href="<?= site_url('tienda/disminuirCantidad/' . $id) ?>">-</a>
                            </td>
                            <td>$<?= esc(number_format($item['precio'] * $item['cantidad'], 2)) ?></td>
                            <td>
                                <a href="<?= site_url('tienda/eliminarDelCarrito/' . $id) ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>El carrito está vacío.</p>
        <?php endif; ?>
        <p><a href="<?= site_url('tienda') ?>">Volver al catálogo</a></p>
    </div>
</body>
</html>
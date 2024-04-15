<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="/css/styles.css"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Catálogo de Productos</h1>
    
    <div id="catalogo">
        <?php foreach ($productos as $producto): ?>
            <div>
                <h3><?= esc($producto['nombre']) ?></h3>
                <p><?= esc($producto['descripcion']) ?></p>
                <p>Precio: $<?= esc(number_format($producto['precio'], 2)) ?></p>
                <button class="btn-agregar" data-id="<?= $producto['id'] ?>">Añadir al Carrito</button>
            </div>
        <?php endforeach; ?>
    </div>
    
   
    <div id="carrito">
        <h2>Carrito de Compras</h2>
        <p>El carrito está vacío</p>
    </div>

    
    <script>
    $(document).ready(function() {
        
        var carrito = [];

        $('.btn-agregar').on('click', function() {
            var idProducto = $(this).data('id');
            $.ajax({
                url: '<?= site_url("tienda/agregarACarritoAjax") ?>',
                type: 'POST',
                data: {id: idProducto},
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                    } else {
                    
                        carrito.push(data.producto);
                        
                        mostrarCarrito();
                    }
                },
                error: function() {
                    alert('Error al añadir producto.');
                }
            });
        });

        
        function mostrarCarrito() {
            var carritoHTML = '<h2>Carrito de Compras</h2>';
            if (carrito.length > 0) {
                carritoHTML += '<ul>';
                carrito.forEach(function(producto) {
                    carritoHTML += '<li>' + producto.nombre + ' - Precio: $' + producto.precio + '</li>';
                });
                carritoHTML += '</ul>';
            } else {
                carritoHTML += '<p>El carrito está vacío</p>';
            }
            $('#carrito').html(carritoHTML);
        }
    });
    </script>
</body>
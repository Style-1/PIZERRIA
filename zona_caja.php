<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Zona Caja</title>
    <link rel="stylesheet" href="Estilos/style_caja.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .text-brown { color: #6f4e37; }
        .btn-brown { background-color: #6f4e37; border-color: #6f4e37; color: white; }
        .btn-brown:hover { background-color: #5a3f2d; border-color: #5a3f2d; }
        .btn-outline-brown { border: 1px solid #6f4e37; color: #6f4e37; }
        .btn-outline-brown:hover { background-color: #6f4e37; color: white; }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-brown">Zona Caja</h1>
            <a class="btn btn-outline-brown" href="zona_pedidos.php"><i class="bi bi-plus-circle"></i> Agregar pedidos</a>
        </div>

        <?php
        include("conexion.php");
        $sql = "SELECT * FROM TBPEDIDOS P JOIN TBPIZZA Z ON P.ID_PIZZA = Z.ID_PIZZA WHERE P.ESTADO = '0'";
        $resultado = mysqli_query($con, $sql);

        echo "<table class='table table-striped table-hover text-center'>";
        echo "<thead class='table-dark'><tr>
                <th>ID PEDIDO</th>
                <th>CLIENTE</th>
                <th>DNI</th>
                <th>PIZZA</th>
                <th>CANTIDAD</th>
                <th>ACCIONES</th>
              </tr></thead><tbody>";

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>
                    <td>{$fila['ID_PEDIDO']}</td>
                    <td>{$fila['CLIENTE']}</td>
                    <td>{$fila['DNI']}</td>
                    <td>{$fila['NOMBRE']}</td>
                    <td>{$fila['CANTIDAD']}</td>
                    <td>
                        <a class='btn btn-primary btn-sm me-2' 
                            href='pagar_pedido.php?id={$fila['ID_PEDIDO']}&nombre={$fila['ID_PIZZA']}&cantidad={$fila['CANTIDAD']}&precio={$fila['PRECIO']}&dni={$fila['DNI']}'>
                            <i class='bi bi-credit-card'></i> Pagar
                        </a>
                        <a class='btn btn-danger btn-sm' 
                            href='eliminar_pedido.php?id={$fila['ID_PEDIDO']}'>
                            <i class='bi bi-trash3'></i> Eliminar
                        </a>
                    </td>
                  </tr>";
        }
        echo "</tbody></table>";
        ?>

        <div class="d-grid gap-2 d-md-flex justify-content-center mt-4">
            <a class='btn btn-danger me-3' href='zona_cocina.php'>
                <i class='bi bi-fire'></i> Zona Cocina
            </a>
            <a class='btn btn-danger' href="boleta.php">
                <i class='bi bi-receipt'></i> Cierre Caja
            </a>
        </div>
    </div>
</body>
</html>

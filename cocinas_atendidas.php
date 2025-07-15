<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cocinas Atendidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .text-brown { color: #6f4e37; }
        .btn-brown { background-color: #6f4e37; color: white; }
        .btn-outline-brown { border: 1px solid #6f4e37; color: #6f4e37; }
        .btn-outline-brown:hover { background-color: #6f4e37; color: white; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-end mb-4">
            <a class="btn btn-brown text-white btn-lg" href="zona_cocina.php">
                <i class="bi bi-arrow-left-circle"></i> Volver
            </a>
        </div>

        <h1 class="display-4 text-center text-brown mb-4">Cocinas Atendidas</h1>

        <?php
        include("conexion.php");
        $sql = "SELECT P.ID_PEDIDO, P.CANTIDAD, Z.NOMBRE, Z.ID_PIZZA 
                FROM TBPEDIDOS P 
                JOIN TBPIZZA Z ON P.ID_PIZZA = Z.ID_PIZZA 
                WHERE P.ESTADO='2'";
        $resultado = mysqli_query($con, $sql);
        $total_pizzas = 0;

        echo "<div class='card-body'>";
        echo "<table class='table table-hover text-center'>";
        echo "<thead class='table-dark'>";
        echo "<tr>
                <th>Código</th>
                <th>Pizza</th>
                <th>Cantidad</th>
              </tr>";
        echo "</thead><tbody>";

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>{$fila['ID_PEDIDO']}</td>";
            echo "<td>{$fila['NOMBRE']}</td>";
            echo "<td>{$fila['CANTIDAD']}</td>";
            echo "</tr>";
            $total_pizzas += $fila['CANTIDAD'];
        }

        echo "</tbody>";
        echo "<tfoot><tr><td><strong>Total</strong></td><td></td><td><strong>{$total_pizzas}</strong></td></tr></tfoot>";
        echo "</table></div>";
        
        echo "<div class='d-grid gap-2 col-4 mx-auto mt-4'>";
        echo "<a class='btn btn-brown text-white btn-lg' href='cierre_caja.php'>";
        echo "<i class='bi bi-receipt'></i> Cierre Caja</a>";
        echo "</div>";
        ?>
    </div>
</body>
</html>
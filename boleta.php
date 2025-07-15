<?php
// Conexión a la base de datos
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Boletas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .text-brown {
            color: #6f4e37;
        }

        .btn-brown {
            background-color: #6f4e37;
            color: white;
        }

        .btn-outline-brown {
            border: 1px solid #6f4e37;
            color: #6f4e37;
        }

        .btn-outline-brown:hover {
            background-color: #6f4e37;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h1 class="display-4 text-center text-brown mt-5 mb-4">Boleta Cabecera</h1>
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Número</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">DNI Cliente</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">IGV</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM TBBOLETA_CAB ORDER BY FECHA DESC";
                    $resultado = mysqli_query($con, $sql);
                    if (!$resultado) {
                        echo "Error en la consulta: " . mysqli_error($con);
                        exit();
                    }
                    $suma_cabecera = 0;

                    if (mysqli_num_rows($resultado) > 0) {
                        while ($elem = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>{$elem['NUMERO']}</td>";
                            echo "<td>{$elem['FECHA']}</td>";
                            echo "<td>{$elem['DNI_CLIENTES']}</td>";
                            echo "<td>{$elem['SUBTOTAL']}</td>";
                            echo "<td>{$elem['IGV']}</td>";
                            echo "<td>{$elem['TOTAL']}</td>";
                            echo "</tr>";

                            $suma_cabecera += $elem['TOTAL'];
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td colspan="4"></td>
                        <td><strong><?php echo number_format($suma_cabecera, 2); ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <!-- Detalles de Boletas (Pizzas vendidas) -->
        <h1 class="display-4 text-center text-brown mb-4">Boleta Detalles</h1>
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Número</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">ID Pizza</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Importe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_detalle = "SELECT * FROM TBBOLETA_DET ORDER BY FECHA DESC";
                    $resultado_detalle = mysqli_query($con, $sql_detalle);
                    
                    if (!$resultado_detalle) {
                        echo "Error en la consulta de detalles: " . mysqli_error($con);
                        exit();
                    }

                    $suma_detalle = 0;

                    if (mysqli_num_rows($resultado_detalle) > 0) {
                        while ($elem = mysqli_fetch_assoc($resultado_detalle)) {
                            echo "<tr>";
                            echo "<td>{$elem['NUMERO']}</td>";
                            echo "<td>{$elem['FECHA']}</td>";
                            echo "<td>{$elem['ID_PIZZA']}</td>";
                            echo "<td>{$elem['CANTIDAD']}</td>";
                            echo "<td>{$elem['PRECIO']}</td>";
                            echo "<td>{$elem['IMPORTE']}</td>";
                            echo "</tr>";

                            $suma_detalle += $elem['IMPORTE'];
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td colspan="4"></td>
                        <td><strong><?php echo number_format($suma_detalle, 2); ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Botones -->
        <div class="d-grid gap-2 col-4 mx-auto mt-4">
            <a class="btn btn-outline-brown btn-lg" href="cierre_caja.php"><i class="bi bi-x-circle"></i> Cierre Caja</a>
            <a class="btn btn-brown text-white btn-lg" href="zona_caja.php"><i class="bi bi-arrow-left-circle"></i> Volver</a>
        </div>
    </div>
</body>

</html>
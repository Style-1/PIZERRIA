<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Zona Cocina</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #fdfcfb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .text-brown { color: #6f4f28; }

        h1 {
            color: #6f4f28;
            font-weight: bold;
        }

        .btn-brown {
            background-color: #6f4f28;
            border-color: #6f4f28;
            color: white;
        }

        .btn-brown:hover {
            background-color: #5a4021;
            border-color: #5a4021;
            color: white;
        }

        .btn {
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-warning:hover {
            background-color: #e7a500;
        }

        .table-hover tbody tr:hover {
            background-color: #fcf1e8;
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .table th, .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .container {
            padding-top: 60px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="text-end mb-4">
            <a class="btn btn-brown text-white" href="zona_caja.php">
                <i class="bi bi-arrow-left-circle"></i> Volver
            </a>
        </div>

        <h1 class="display-4 text-center mb-4">Zona Cocina</h1>

        <div class="card-body">
            <?php
            include("conexion.php");
            $sql = "SELECT P.*, Z.NOMBRE FROM TBPEDIDOS P JOIN TBPIZZA Z ON P.ID_PIZZA = Z.ID_PIZZA WHERE P.ESTADO='1'";
            $resultado = mysqli_query($con, $sql);

            echo "<table class='table table-hover text-center'>";
            echo "<thead class='table-dark'>
                    <tr>
                        <th scope='col'>Código</th>
                        <th scope='col'>Cliente</th>
                        <th scope='col'>DNI</th>
                        <th scope='col'>Pizza</th>
                        <th scope='col'>Cantidad</th>
                        <th scope='col'>Acciones</th>
                    </tr>
                </thead>
                <tbody>";

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>
                        <td>{$fila['ID_PEDIDO']}</td>
                        <td>{$fila['CLIENTE']}</td>
                        <td>{$fila['DNI']}</td>
                        <td>{$fila['NOMBRE']}</td>
                        <td>{$fila['CANTIDAD']}</td>
                        <td>
                            <a class='btn btn-warning btn-sm' href='atender_pedido.php?id={$fila['ID_PEDIDO']}'>
                                <i class='bi bi-check-circle'></i> Atender
                            </a>
                        </td>
                    </tr>";
            }

            echo "</tbody></table>";
            ?>
        </div>

        <div class="d-grid gap-2 col-4 mx-auto mt-4">
            <a class="btn btn-brown text-white btn-lg" href="cocinas_atendidas.php">
                <i class="bi bi-clock-history"></i> Atendidas
            </a>
        </div>
    </div>
</body>
</html>
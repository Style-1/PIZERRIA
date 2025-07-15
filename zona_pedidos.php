<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona de Pedidos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .pedido-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 600px;
        }

        .pedido-header {
            background-color: #fff5ef;
            padding: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pedido-title {
            margin-bottom: 0;
            font-size: 1.8rem;
            color: #6f4e37;
        }

        .volver-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: #6f4e37;
            border: 2px solid #6f4e37;
            padding: 0.7rem 1.2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: background-color 0.3s, color 0.3s;
        }

        .volver-btn:hover {
            background-color: #6f4e37;
            color: white;
        }

        .pedido-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.75rem;
        }

        .form-label {
            font-weight: 600;
            color: #6f4e37;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .form-input, .form-select {
            border-radius: 10px;
            padding: 0.9rem;
            border: 1px solid #ced4da;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
        }

        .form-input:focus, .form-select:focus {
            border-color: #6f4e37;
            box-shadow: 0 0 0 0.2rem rgba(111, 78, 55, 0.25);
            outline: none;
        }

        .agregar-btn {
            background-color: #6f4e37;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 10px;
            padding: 0.9rem 1.5rem;
            border: none;
            cursor: pointer;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: background-color 0.3s;
        }

        .agregar-btn:hover {
            background-color: #5a3d2b;
        }

        .invalid-feedback {
            font-size: 0.9rem;
            color: #dc3545;
            margin-top: 0.25rem;
            display: none; /* Ocultar los mensajes de error inicialmente */
        }

        .was-validated .invalid-feedback {
            display: block; /* Mostrar los mensajes de error cuando la validación falla */
        }
    </style>
</head>
<body class="bg-light">
    <div class="pedido-container">
        <div class="pedido-header">
            <h2 class="pedido-title"><i class="bi bi-bag-plus-fill me-2"></i>Nuevo Pedido</h2>
            <a class="volver-btn" href="zona_caja.php">
                <i class="bi bi-arrow-left-circle-fill me-2"></i> Volver
            </a>
        </div>
        <div class="pedido-body">
            <form id="pedidoForm" action="registrar_ped.php" method="post" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="cliente" class="form-label"><i class="bi bi-person-fill"></i> Cliente:</label>
                    <input type="text" class="form-input" id="cliente" name="cliente" placeholder="Ingrese el nombre del cliente" required>
                    <div class="invalid-feedback">Por favor ingrese el nombre del cliente.</div>
                </div>

                <div class="form-group">
                    <label for="dni" class="form-label"><i class="bi bi-credit-card-2-back-fill"></i> DNI:</label>
                    <input type="text" class="form-input" id="dni" name="dni" maxlength="9" placeholder="Ingrese el DNI" required>
                    <div class="invalid-feedback">Por favor ingrese un DNI válido (máximo 9 dígitos).</div>
                </div>

                <div class="form-group">
                    <label for="pizza" class="form-label"><i class="bi bi-pizza"></i> Pizza:</label>
                    <select class="form-select" id="pizza" name="pizza" required>
                        <option value="" disabled selected>Seleccione una pizza</option>
                        <?php
                        include("conexion.php");
                        $sql = "SELECT * FROM TBPIZZA ORDER BY NOMBRE";
                        $result = mysqli_query($con, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['ID_PIZZA']}'>{$row['NOMBRE']} - S/ {$row['PRECIO']}</option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">Por favor seleccione una pizza.</div>
                </div>

                <div class="form-group">
                    <label for="cantidad" class="form-label"><i class="bi bi-calculator-fill"></i> Cantidad:</label>
                    <input type="number" class="form-input" id="cantidad" name="cantidad" min="1" value="1" required>
                    <div class="invalid-feedback">La cantidad debe ser al menos 1.</div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="agregar-btn">
                        <i class="bi bi-cart-plus-fill me-2"></i> Agregar al Pedido
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>
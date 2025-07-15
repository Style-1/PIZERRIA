<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <limk rel="stylesheet" href="Estilos/style_login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .text-brown { color: #6f4e37; }
        .btn-brown { background-color: #6f4e37; }
        .btn-outline-brown { border: 1px solid #6f4e37; color: #6f4e37; }
        .btn-outline-brown:hover { background-color: #6f4e37; color: white; }
    </style>
</head>
<body style="background-color: #f5f5f5; font-family: 'Arial', sans-serif; color: #333;">

<div class="d-flex justify-content-center align-items-center min-vh-100">
    <form action="ingreso.php" method="post" class="p-5 border-0 rounded-4 shadow-lg bg-white text-center" style="width: 400px; max-width: 90%;">
        <div class="mb-4">
            <img src="https://thumbs.dreamstime.com/b/plantilla-de-logotipo-pizzas-antiguas-vectorial-la-del-pizza-vintage-175718458.jpg" alt="Logo" class="img-fluid rounded-circle shadow" style="max-width: 150px;">
        </div>

        <legend class="text-brown fw-bold mb-4" style="font-size: 1.8rem;">Iniciar Sesión</legend>

        <div class="mb-4 text-start">
            <label for="usuario" class="form-label text-brown">Usuario</label>
            <input type="text" name="usuario" class="form-control form-control-lg shadow-sm" placeholder="Admin/Usuario" required>
        </div>

        <div class="mb-4 text-start">
            <label for="clave" class="form-label text-brown">Clave</label>
            <input type="password" name="clave" class="form-control form-control-lg shadow-sm" placeholder="12345/54321" required>
        </div>

        <div class="mt-4">
            <button type="reset" class="btn btn-outline-brown btn-lg px-4 py-2 mx-2">
                <i class="bi bi-door-open"></i> Salir
            </button>
            <button type="submit" class="btn btn-brown btn-lg px-4 py-2 mx-2">
                <i class="bi bi-check-circle"></i> Ingresar
            </button>
        </div>
    </form>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página principal</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      background-color: #f5f6fa;
      margin: 0;
      padding: 100px 20px;
    }

    h1 {
      color: #333;
    }

    .btn-login {
      display: inline-block;
      padding: 12px 25px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn-login:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <h1>Funciona 🎉</h1>
  <p>Haz clic para ir al inicio de sesión:</p>

  <!-- Botón que redirige al login -->
  <a href="/auth/login" class="btn-login">Ir al Login</a>
</body>
</html>

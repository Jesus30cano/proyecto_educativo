<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="/../../../public/css/boostrap_dashboard/style.css" />
  <title>Perfil</title>
</head>

<body>
  <!-- navbar -->
      <?php include __DIR__ . '/../components/student/navbar.php'; ?>

    <!-- sidebar -->
      <?php include __DIR__ . '/../components/student/sidebar.php'; ?>


  <main class="mt-5 pt-3">
    <div class="container-fluid">

      <!-- Bienvenida al estudiante -->
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="card bg-primary text-white">
            <div class="card-body">
              <h3 class="mb-2"><i class="bi me-2"></i>Perfil Estudiante</h3>
            </div>
          </div>
        </div>
      </div>

      <?php include __DIR__ . '/../components/perfil.php'; ?>

             
             


            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="./../../public/js/boostrap_dashboard/student/script.contactos.js"></script>
  <script src="./../../public/js/boostrap_dashboard/bootstrap.bundle.min.js"></script>
  <script src="./../../public/js/boostrap_dashboard/script.js"></script>
</body>

</html>
<?php
    require_once("../system/config.php");
    session_start();

    $mensaje='';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $cedula = $_POST['correo'];
        $password = $_POST['contrasena'];

        $query = "SELECT ID, Contraseña FROM `usuarios` WHERE Cedula = '".$cedula."'" ." OR correo = '".$cedula."' LIMIT 1";

        $resultado = mysqli_query($conn, $query);

        $filasEncontradas = mysqli_num_rows($resultado); 
        
        if($filasEncontradas > 0) {
            $usuario = mysqli_fetch_assoc($resultado);
            $passwordHash= hash("sha256", $password);

            if($usuario['Contraseña'] === $passwordHash) {
                $_SESSION['ID'] = $usuario['ID'];
                header("Location: index.php");
                exit();
            } else {
                $mensaje = "Contraseña incorrecta";
            }

        } else {
            $mensaje = "Usuario no encontrado";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="../assets/img/draw2.svg" class="img-fluid" alt="Test image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form method="POST" action="">
                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" name="correo" id="form1Example13"
                                class="form-control form-control-lg" />
                            <label class="form-label" for="form1Example13">Correo electronico o cedula</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" name="contrasena" id="form1Example23"
                                class="form-control form-control-lg" />
                            <label class="form-label" for="form1Example23">Contraseña</label>
                        </div>

                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                <label class="form-check-label" for="form1Example3"> Remember me </label>
                            </div>
                            <a href="signup.php">No tiene cuenta? ¡Regístrate!</a>
                        </div>
                        <?php
                            if($mensaje != '') {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $mensaje; ?>
                                </div>
                                <?php
                            }
                        ?>

                        <!-- Submit button -->
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-primary btn-lg btn-block">Sign in</button>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/scripts.js"></script>

</body>

</html>
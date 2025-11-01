<?php
    require_once("../system/config.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST['inputPassword'] !== $_POST['inputCPassword']) {
                echo "<div class='alert alert-danger' role='alert'>Las contraseñas no coinciden.</div>";
                exit();
            }

            
            $nombreUsuario = $_POST['inputName'];
            $cedulaUsuario = $_POST['inputCedula'];
            $emailUsuario = $_POST['inputEmail'];
            $contraseñaUsuario = $_POST['inputPassword'];
            $confirmarContraseñaUsuario = $_POST['inputCPassword'];
            $contraseñaHash = hash("sha256", $contraseñaUsuario);


            $sql ="INSERT INTO usuarios (Nombre, Cedula, Contraseña, correo) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("siss", $nombreUsuario, $cedulaUsuario, $contraseñaHash, $emailUsuario);

            if (empty($nombreUsuario) || empty($cedulaUsuario) || empty($contraseñaUsuario) || empty($confirmarContraseñaUsuario) || empty($emailUsuario)) {
                echo "<div class='alert alert-danger' role='alert'>Todos los campos deben estar llenos.</div>";
                exit();
            }

            if ($stmt->execute()) {
                $nuevoID = $conn->insert_id;
                $_SESSION['ID'] = $nuevoID;
                header("Location: index.php");
                exit();

            } else {
                echo "Error en el registro: " . $stmt->error;
            }
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                    <form class="mx-1 mx-md-4" method="POST" action="">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="text" name="inputName" id="form3Example1cN"
                                                    class="form-control" required />
                                                <label class="form-label" for="form3Example1c">Nombre</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="number" name="inputCedula" id="form3Example4cdC"
                                                    class="form-control" required />
                                                <label class="form-label" for="form3Example4cd">Cedula</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="email" name="inputEmail" id="form3Example3cE"
                                                    class="form-control" required />
                                                <label class="form-label" for="form3Example3c">Correo
                                                    electronico</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="password" name="inputPassword" id="form3Example4cP"
                                                    class="form-control" required />
                                                <label class="form-label" for="form3Example4c">Contraseña</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <input type="password" name="inputCPassword" id="form3Example4cdCP"
                                                    class="form-control" required />
                                                <label class="form-label" for="form3Example4cd">Repita su
                                                    Contraseña</label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary btn-lg">Sign-up</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="../assets/img/draw1.webp" class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/scripts.js"></script>
</body>

</html>
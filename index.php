<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./assets/images/logo.png">
    <!-- Bootstrap CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Chevrolet </title>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <style>
        .last {
            font-size: xxx-large;
        }
    </style>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "teacher";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }

    $qry = "select * from edit_table limit 1";
    $result  = $conn->query($qry);
    $getRow = $result->fetch_assoc();
    $images = json_decode($getRow['image']);
    $total_images = count($images);

    $folder_name = explode("/", $_SERVER['REQUEST_URI']);
    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $folder_name[1];



  if (isset($_POST['save'])) {
    // echo "<pre>";
    // print_r($_POST);die;
    $toEmail = 'shahbaaj@codenomad.net';
    $name = 'Amit';
    $email = 'amit@codenomad.net';
    $message = 'Saved';
    $name = 'Amit';

    $emailSubject = 'New email from your contact form';
    $headers = ['From' => 'test@gmail.com', 'Reply-To' => 'amit@codenomad.net', 'Content-type' => 'text/html; charset=utf-8'];
    $bodyParagraphs = ["Name: {$name}", "Email: {$email}", "Message:", $message];
    $body = join(PHP_EOL, $bodyParagraphs);

    if (mail($toEmail, $emailSubject, $body, $headers)) 

        header('Location: thank-you.html');
    } else {
        $errorMessage = 'Oops, something went wrong. Please try again later';
    }
    $sql = "INSERT INTO `contact`(`name`, `email`, `phone`, `description`) VALUES ('$name','$email','$phone','$description')";
    $result = $conn->query($sql);
    if ($result == TRUE) {
        $_SESSION['status'] = 'Record inserted successfully.';
    }else{
      echo "Error:". $sql . "<br>". $conn->error;
    } 
    $conn->close(); 
  

?>

<?php
  if (isset($_SESSION['status'])) {
  ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong></strong><?php echo $_SESSION['status']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    unset($_SESSION['status']);
  }
  ?>
    <section class="header">
        <div class="container">
            <div class="row pt-3">
                <div class="col-md-2">
                    <img src="./images/logo.png" class="img-fluid" />
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control searchinput" placeholder="Buscar productos, marcas y más…" aria-label="Username" aria-describedby="basic-addon1">
                        <div class="buttonserch">
                            <span class="material-symbols-outlined">
                                search
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="./images/adds.webp" class="img-fluid" style="max-width: 340px; max-height: 39px;" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <a href="" class="postal" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="material-symbols-outlined">
                            location_on
                        </span> Ingresa tu <b> código postal </b> </a>
                </div>
                <div class="col-md-6">
                    <ul class="categories">
                        <li><a href="#">Categorías</a></li>
                        <li><a href="#">Ofertas</a></li>
                        <li><a href="#">Historial</a></li>
                        <li><a href="#">Supermercado</a></li>
                        <li><a href="#">Moda</a></li>
                        <li><a href="#">Vender</a></li>
                        <li><a href="#">Ayuda</a></li>
                    </ul>
                </div>
                <div class="col-md-4 text-end">
                    <ul class="account1">
                        <li><a href="#">Crea tu cuenta</a></li>
                        <li><a href="#">Ingresa</a></li>
                        <li><a href="#">Mis compras</a></li>
                        <li><a href="#"><span class="material-symbols-outlined">
                                    shopping_cart
                                </span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="mobileheader">
        <div class="">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <img src="./assets/images/logo__small@2x.png" width="50" />
                    <div class="mobileserch">
                        <span class="material-symbols-outlined">
                            search
                        </span>
                        <input type="search" class="form-control" />
                    </div>
                    <button id="hide" onclick="hide()">
                        <span class="material-symbols-outlined">
                            menu
                        </span>
                    </button>
                    <span class="material-symbols-outlined">
                        shopping_cart
                    </span>
                </div>
            </nav>
        </div>
    </div>
    <div class="mobile-menu" style="display:none;">
        <div class="account">
            <div class="account-detail">
                <div class="photoaccount">
                    <svg class="nav-header-menu-mobile-guest-icon" width="28" height="35" xmlns="http://www.w3.org/2000/svg">
                        <path d="M27.343 33.706l-1.356.64A13.25 13.25 0 0 0 14 26.75c-5.17 0-9.8 2.988-11.978 7.578l-1.356-.643A14.75 14.75 0 0 1 14 25.25a14.75 14.75 0 0 1 13.343 8.456zM14 21.75C8.063 21.75 3.25 16.937 3.25 11S8.063.25 14 .25 24.75 5.063 24.75 11 19.937 21.75 14 21.75zm0-1.5a9.25 9.25 0 1 0 0-18.5 9.25 9.25 0 0 0 0 18.5zm0-2.5v-1.5a5.25 5.25 0 1 0 0-10.5v-1.5a6.75 6.75 0 0 1 0 13.5z" fill="#BBB" fill-rule="nonzero"></path>
                    </svg>
                </div>
                <div class="">
                    <p class="m-0">Bienvenido</p>
                    <small>Ingresa a tu cuenta para ver tus compras, favoritos, etc.</small>
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary w-50" type="button">Ingresa</button>
                <button class="btn btn-primary w-50" type="button">Crea tu cuenta</button>
            </div>
        </div>
        <div class="sell">
            <ul>
                <li><span class="material-symbols-outlined">
                        home
                    </span> Inicio</li>
                <li><span class="material-symbols-outlined">
                        sell
                    </span> Ofertas</li>
                <li><span class="material-symbols-outlined">
                        schedule
                    </span> Historial</li>
                <li><span class="material-symbols-outlined">
                        headset_mic
                    </span> Ayuda</li>
            </ul>
            <hr />
            <ul>
                <li><span class="material-symbols-outlined">
                        shopping_basket
                    </span> Supermercado</li>
                <li><span class="material-symbols-outlined">
                        laundry
                    </span> Moda</li>
                <li> <span class="material-symbols-outlined">
                        star
                    </span> Más vendidos <span class="nuevo">Nuevo</span></li>
                <li><span class="material-symbols-outlined">
                        public
                    </span> Compra Internacional <span class="nuevo">Nuevo</span></li>
                <li><span class="material-symbols-outlined">
                        storefront
                    </span> Tiendas oficiales</li>
                <li><span class="material-symbols-outlined">
                        format_list_bulleted
                    </span> Categorías</li>
            </ul>
            <hr />
            <ul>
                <li><span class="material-symbols-outlined">
                        article
                    </span> Resumen</li>
                <li><span class="material-symbols-outlined">
                        sell
                    </span> Vender</li>
            </ul>
            <hr />
            <ul>
                <li><span class="material-symbols-outlined">
                        download
                    </span> ¡Compra y vende con la app!</li>
            </ul>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <h5 class="modal-title" id="exampleModalLabel">Elige dónde recibir tus compras </h5>
                    <p>Podrás ver costos y tiempos de entrega precisos en todo lo que busques. </p>
                    <form class="row g-3">

                        <div class="col-auto">
                            <label for="inputPassword2" class="visually-hidden">Código Postal </label>
                            <div class="position-relative">
                                <input type="tel" class="form-control" id="inputPassword2" placeholder="Ingresar un código postal">
                                <div class="usar_button">
                                    <button type="submit" class="btn btn-primary mb-3">Usar</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-outline-primary mb-3 mt-2">No sé mi código</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <section class="backtolist">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                </div>
                <div class="col-md-4  mb-3 text-end">
                    <div class="Share">
                        <a href="#">Share</a>
                        <span class="mx-3">|</span>
                        <a class="vehicle" href="#">Sell my vehicle for free</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product">
        <div class="container">
            <div class="row product_detail">
                <div class="col-md-8">
                    <div class="demo">
                        <ul class="list-unstyled">
                            <?php
                            $imageCounter = 0;
                            foreach (json_decode($getRow['image']) as $image) {
                                $imageCounter++;
                            ?>
                                <li>
                                    <img src="<?php echo $url . '/images/' . $image; ?>" height="60px" width="60px" class="small_img" />

                                </li>
                            <?php
                                if ($imageCounter % 6 == 0) {
                                    break;
                                }
                            }
                            ?>
                            <li class="last"><?php echo $total_images; ?></li>
                        </ul>
                        <img src="<?php echo $url . '/images/' . $image; ?>" class="img-fluid big_img" />
                    </div>
                    <!-- <?php
                            foreach ($images as $image) {
                            ?>
                        <img src="<?php echo $url . '/images/' . $image ?>" class="" />
                    <?php
                            }
                    ?> -->

                    <div class="p-3">
                        <hr />
                        <h2 class="description-tittle">Características principales
                        </h2>

                        <table class="table table-bordered table-striped table-hover mt-4">
                            <tr>
                                <th>Brand</th>
                                <td><?php echo $getRow['brand']; ?></td>
                            </tr>
                            <tr>
                                <th>Model</th>
                                <td><?php echo $getRow['model']; ?></td>
                            </tr>
                            <tr>
                                <th>Year</th>
                                <td><?php echo $getRow['year']; ?></td>
                            </tr>
                            <tr>
                                <th>Version</th>
                                <td><?php echo $getRow['version']; ?></td>
                            </tr>
                            <tr>
                                <th>Color</th>
                                <td><?php echo $getRow['color']; ?></td>
                            </tr>
                            <tr>
                                <th>Fuel type</th>
                                <td><?php echo $getRow['fuel_type']; ?></td>
                            </tr>
                            <tr>
                                <th>Doors</th>
                                <td><?php echo $getRow['doors']; ?></td>
                            </tr>
                            <tr>
                                <th>Transmission</th>
                                <td><?php echo $getRow['transmission']; ?></td>
                            </tr>
                            <tr>
                                <th>Engine </th>
                                <td><?php echo $getRow['engine']; ?></td>
                            </tr>
                            <tr>
                                <th>body type</th>
                                <td><?php echo $getRow['body_type']; ?></td>
                            </tr>
                            <tr>
                                <th>Kilometres</th>
                                <td><?php echo $getRow['kilometres']; ?></td>
                            </tr>
                        </table>
                        <hr class="my-5" />
                        <h2 class="description-tittle">Descripción</h2>
                        <p class="description">
                            <?php echo $getRow['description']; ?></p>
                        <hr class="my-5" />
                        <h2 class="description-tittle" id="form">Contact the individual </h2>
                        <p class="contact"><?php echo $getRow['email']; ?></b> </p>
                        <div class="alert alert-secondary  d-flex align-items-center" role="alert">
                            <svg aria-hidden="true" class="andes-badge__icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <g fill="none" fill-rule="evenodd"><svg width="16" height="16" viewBox="0 0 16 16" fill="white">
                                        <path d="M8.96967 3.87878H7.03027L7.2727 9.21212H8.72724L8.96967 3.87878Z" fill="white"></path>
                                        <path d="M7.99997 10.1818C8.53552 10.1818 8.96967 10.616 8.96967 11.1515C8.96967 11.6871 8.53552 12.1212 7.99997 12.1212C7.46442 12.1212 7.03027 11.6871 7.03027 11.1515C7.03027 10.616 7.46442 10.1818 7.99997 10.1818Z" fill="white"></path>
                                    </svg></g>
                            </svg>
                            <div>
                                <b> Evita el fraude. </b>Nunca compartas tus datos ni tu contraseña.
                            </div>
                        </div>
                        <form method="post" action="">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" name="name">
                                        <label for="floatingInput">Nombre</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" name="email">
                                        <label for="floatingInput">E-mail</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="tel" class="form-control" id="floatingInput" name="phone">
                                        <label for="floatingInput">Teléfono (fijo o móvil) </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="description"></textarea>
                                    <label for="floatingTextarea2">Escribe tu pregunta...</label>
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Acepto los Términos y condiciones y autorizo el uso de mis datos de acuerdo a la Declaración de Privacidad.</label>
                            </div>
                            <button type="submit" name="save" class="btn btn-primary">Preguntar</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sticky">
                        <div class="card p-3">
                            <p class="days"><?php echo $getRow['year']; ?> | <?php echo $getRow['kilometres']; ?> Date <?php echo $getRow['time']; ?> </p>
                            <h3 class="colorado"><?php echo $getRow['product']; ?></h3>
                            <p class="post">Individual with <a href=""> verified identity <img src="<?php echo $url . '/images/' . $image; ?>" width="20px" /></a></p>
                            <h1 class="prizes"><?php echo $getRow['price']; ?></h1>
                            <div class="my-3 col-md-6">
                                <a href="#form" class="btn btn-primary btn-lg form-control"> Preguntar </a>
                            </div>
                            <div class="post">
                                <p>¿Tuviste un problema con la publicación?<a href="#">Avísanos.</a></p>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="p-3">
                                <h2>Information of the individual</h2>
                                <h3 class="mb-4"><?php echo $getRow['name']; ?><img src="<?php echo $url . '/images/' . $image; ?>" width="30px" /></h3>
                                <div class="d-flex">
                                    <span class="material-symbols-outlined location mt-2 fs-4">
                                        location_on
                                    </span>
                                    <div class="vehiclelo ps-2">
                                        <h6 class="m-0"> vehicle location </h6>
                                        <p><?php echo $getRow['location']; ?></p>
                                    </div>
                                </div>
                                <a href="#">Ver teléfono</a>
                            </div>
                            <hr />
                            <div class="p-3">
                                <h2>Cotiza un vehículo <span class="NUEVO">NUEVO</span> </h2>
                                <p>Obtendrás valores de referencia para asegurarte de elegir un buen precio.</p>
                                <a href="#">Ver teléfono</a>
                            </div>
                            <hr />
                            <div class="p-3">
                                <h2>Consejos de seguridad</h2>
                                <ul>
                                    <li>
                                        <p style="
                                        font-size: 14px;
                                    ">Desconfía de ofertas por debajo del precio de mercado.</p>
                                    </li>
                                    <li>
                                        <p style="
                                        font-size: 14px;
                                    ">
                                            Pide el número de placa y búscalo en <a href="#"> RAPI </a> para ver sus antecedentes y en <a href=""> REPUVE </a> para verificar que coincida con el auto publicado y que no tenga reporte de robo.
                                        </p>
                                    </li>
                                    <li>
                                        <p style="
                                        font-size: 14px;
                                    ">No hagas pagos anticipados para garantizar la negociación sin antes ver el vehículo.</p>
                                    </li>
                                    <li>
                                        <p style="
                                        font-size: 14px;
                                    ">
                                            Mercado Libre no tiene vehículos bajo su custodia. Si te dicen eso, denúncialo.
                                        </p>
                                    </li>
                                    <li>
                                        <p style="
                                        font-size: 14px;
                                    ">
                                            Nunca te pediremos contraseñas, PIN o códigos de verificación a través de WhatsApp, teléfono, SMS o email.
                                        </p>
                                    </li>
                                    <li>
                                        <p style="
                                        font-size: 14px;
                                    ">
                                            Verifica el remitente de los e-mails que recibas para asegurarte de que sean de Mercado Libre.<a href="#"> Conoce más sobre cómo detectar un correo falso. </a>
                                        </p>
                                    </li>
                                </ul>

                                <a href="#">Ver más consejos de seguridad</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="add my-5">
        <div class="container">
            <div class="addss">
                <div class="row g-0">
                    <div class="col-md-8">
                        <img src="./images/added.jpg" class="img-fluid">
                    </div>
                    <div class="col-md-4">
                        <div class="adds-content">
                            <h6>OFERTAS DEL DÍA</h6>
                            <h3>APROVECHA LAS <br />
                                MEJORAS OFERTAS</h3>
                            <p>Ver más <span class="material-symbols-outlined">
                                    chevron_right
                                </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer py-3">
        <div class="container">
            <div class="footer-link">
                <ul>
                    <li><a href="#">Trabaja con nosotros</a></li>
                    <li><a href="#">Términos y condiciones</a></li>
                    <li><a href="#">Cómo cuidamos tu privacidad</a></li>
                    <li><a href="#">Accesibilidad</a></li>
                    <li><a href="#">Ayuda</a></li>
                </ul>

                <small>Copyright © 1999-2023 El presente canal de instrucción o ambiente, es operado por DeRemate.Com de México, S. de R.L. de C.V. identificada bajo la marca comercial "Mercado Libre".
                </small>
                <br />
                <small>
                    Insurgentes Sur 1602 Piso 9 Suite 900, Crédito Constructor Benito Juarez, 03940 Ciudad de México, CDMX, Mexico
                </small>
            </div>
        </div>
    </footer>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".small_img").hover(function() {
                $(".big_img").attr('src', $(this).attr('src'));
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".big_img").imagezoomsl({
                zoomrange: [2, 2]
            });
        });
    </script>
    <script>
        function hide() {
            $(".mobile-menu").toggle();

        }
    </script>
    <script src="zoomsl.js" type="text/javascript"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
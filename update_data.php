<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<style>
  .header {
    background: #fff159;
    padding: 10px;
    position: relative;
  }

  .viewpage a {
    color: black;
    text-decoration: none;
  }

  .viewpage {
    position: absolute;
    right: 26px;
    top: 15px;
  }

  .update {
    padding: 50px 0px;
  }
</style>

<body>

  <?php
  session_start();
  // $url = "http://www.domain.com/folder1/folder2/THIS_ONE/file.php";
  // $urlParts = explode("/", $url);
  // echo $urlParts[3];

  $url_folder = explode("/", $_SERVER['REQUEST_URI']);

  $url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $url_folder[1] . '/index.php';

    // -----------------------------images url---------------------------------

  $folder_name = explode("/", $_SERVER['REQUEST_URI']);
  $img_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $folder_name[1];


  
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "teacher";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {

    die("Connection failed:" . $conn->connect_error);
  }

  if (isset($_POST['update'])) {
    // echo "<pre>";
    // print_r($_POST);die;
    $folder = 'images/';
    foreach ($_FILES['image']['name'] as $key => $val) {

      $image = $_FILES['image']['name'][$key];
      $tempname = $_FILES['image']['tmp_name'][$key];
      $data = move_uploaded_file($tempname, $folder . $image);
      $img_array[] = $_FILES['image']['name'][$key];
    }
    $id = $_POST['id'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $version = $_POST['version'];
    $color = $_POST['color'];
    $fuel_type = $_POST['fuel_type'];
    $doors = $_POST['doors'];
    $transmission = $_POST['transmission'];
    $engine = $_POST['engine'];
    $body_type = $_POST['body_type'];
    $kilometres = $_POST['kilometres'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $time = $_POST['time'];
    $multiple_image  = json_encode($img_array);

    $sql = "UPDATE edit_table SET image='$multiple_image', brand='$brand',
  model='$model', year='$year', version='$version', 
  color='$color', fuel_type='$fuel_type', doors='$doors', transmission='$transmission', 
  engine='$engine', body_type='$body_type', kilometres='$kilometres', product='$product', 
  price='$price', description='$description', location='$location', email='$email', name='$name', time='$time' WHERE id='$id'";

    $result = $conn->query($sql);

    if ($result == TRUE) {
      $_SESSION['status'] = 'Record updated successfully.';
      // echo "Record updated successfully.";
    } else {

      echo "Error:" . $sql . "<br>" . $conn->error;
    }
  }

  ?>


<!-------------------------------------Fetch Data form table-------------------------------------->

<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "teacher"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

$qry = "select * from edit_table limit 1";
$result  = $conn->query($qry);
$getRow = $result->fetch_assoc();
$images = json_decode($getRow['image']);

?>



  <div class="header">
    <h3 style="text-align: center; color:red">Update Record</h3>
    <div class="viewpage">
      <a href="<?php echo $url; ?>">View Page </a>
    </div>
  </div>
  <?php
  if (isset($_SESSION['status'])) {

  ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Hollo!</strong><?php echo $_SESSION['status']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    unset($_SESSION['status']);
  }
  ?>
  <form method="post" action="" enctype="multipart/form-data">
    <section>
      <div class="container">
        <div class="update">
          <div class="row">
            <div class="col-md-8">
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Edit Image Slider
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Slider Image</label>
                        <input type="file" class="form-control" id="" value="<?php echo $images; ?>"  aria-describedby="emailHelp" name="image[]" multiple >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Edit vehicle information
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="" value="<?php echo $getRow['brand']?>" name="brand">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Model</label>
                            <input type="text" class="form-control" id="" value="<?php echo $getRow['model']?>" name="model">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Year</label>
                            <input type="text" class="form-control" id="" value="<?php echo $getRow['year']?>" name="year">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Version</label>
                            <input type="text" class="form-control" id="" value="<?php echo $getRow['version']?>" name="version">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Color</label>
                            <input type="text" class="form-control" id="" value="<?php echo $getRow['color']?>" name="color">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Fuel Type</label>
                            <input type="text" class="form-control" id="" value="<?php echo $getRow['fuel_type']?>" name="fuel_type">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Doors</label>
                            <input type="text" class="form-control" id="" value="<?php echo $getRow['doors']?>" name="doors">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Transmission</label>
                            <input type="text" class="form-control" id="" value="<?php echo $getRow['transmission']?>" name="transmission">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Engine</label>
                            <input type="text" class="form-control" id="" value="<?php echo $getRow['engine']?>" name="engine">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Body Type</label>
                            <input type="text" class="form-control" id="" value="<?php echo $getRow['body_type']?>" name="body_type">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Kilometres</label>
                            <input type="text" class="form-control" id="" value="<?php echo $getRow['kilometres']?>" name="kilometres">
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Edit Description
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="my-3">
                        <label for="exampleInputPassword1" class="form-label">Description</label>
                        <input type="text" class="form-control" id="" value="<?php echo $getRow['description']?>" name="description">
                      </div>

                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">email</label>
                        <input type="email" class="form-control" id="" value="<?php echo $getRow['email']?>" name="email">
                      </div>
                      <div class="text-center">
                        <h3>Edit Location</h3>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Location</label>
                        <input type="text" class="form-control" id="" value="<?php echo $getRow['location']?>" name="location">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                      Edit Product Name
                    </button>
                  </h2>
                  <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Product</label>
                        <input type="text" class="form-control" id="" value="<?php echo $getRow['product']?>" name="product">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Price</label>
                        <input type="text" class="form-control" id="" value="<?php echo $getRow['price']?>" name="price">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                      Edit Information of the individual
                    </button>
                  </h2>
                  <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Name</label>
                        <input type="text" class="form-control" id="" value="<?php echo $getRow['name']?>" name="name">
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Time</label>
                        <input type="date" class="form-control" id="" value="<?php echo $getRow['time']?>" name="time">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="update_button">
            <div class="row">
              <div class="col-md-12 text-center">
                <input type="hidden" name="id" value="1">
                <button type="submit" name="update" class="btn btn-primary mt-5">Update</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
</body>

</html>
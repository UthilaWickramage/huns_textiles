<?php

session_start();
require "connection.php";
$pageno;
if (isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Manage Customers</title>
        <link rel="icon" href="./resources/logo.svg">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap2.css">
    <link rel="stylesheet" href="ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    </head>

    <body style="overflow-x: hidden;" onload="manageUsers(1); ">
    <?php
    require "./components/aside.php";
    ?>

<main class="main-wrap">
        
        <section class="content-main">

            <div class="content-header">
                <h2 class="content-title">Manage Customers </h2>
              
            </div>

            <div class="card mb-4">
                <header class="card-header">
                    <div class="row d-flex justify-content-end">
                        <div class="col-6">
                            <div class="input-group ms-2">
                                <input class="form-control" id="search" type="text" placeholder="Search by Title" >
                                <button class="btn btn-primary" onclick="manageUsers(1)">Search</button>
                            </div>
                        </div>
                        
                    </div>
                </header> <!-- card-header end// -->

                <div class="card-body" id="card-body">

                   

                </div> <!-- card-body end// -->
            </div> <!-- card end// -->


        </section> <!-- content-main end// -->
    </main>
     

    <div class="spinner-bg" id="customSpinner">
        <div class="spinner-border text-white border-5 " style="width: 5rem; height: 5rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
                
              

                

               
           
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>

    </html>

<?php
}else{
    ?>
    <script>
        window.location="adminSignin.php";
    </script>
        <?php
}
?>
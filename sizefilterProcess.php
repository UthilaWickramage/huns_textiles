<?php
session_start();
require "connection.php";
$cid = $_GET["c"];
$pageno = $_GET["page"];
$results_per_page = 3;


if (isset($_GET["size"])) {
    $size = $_GET["size"];
    $sizers = Database::select("SELECT * FROM `category_has_size` WHERE `size_id`='" . $size . "' AND `category_id`='".$cid."'");
    $sizenum = $sizers->num_rows;
    

    for ($j = 0; $j < $sizenum; $j++) {
        $sizerow = $sizers -> fetch_assoc();
        $products = Database::select("SELECT * FROM `product` WHERE `category_has_size_id`='" . $sizerow["id"] . "'");
        $pn = $products->num_rows;
    
        $number_of_pages = ceil($pn / $results_per_page);
    
    
        $page_first_result = ((int)$pageno - 1) * $results_per_page;
        $selectedrs = Database::select("SELECT * FROM `product` WHERE `category_has_size_id`='" . $sizerow["id"] . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "");
        $srn = $selectedrs->num_rows;
    
        if ($srn > 0) {
            for ($i = 0; $i < $srn; $i++) {
                $sr = $selectedrs->fetch_assoc();
    
    ?>
                <div class="col-9 offset-3 offset-lg-0 col-lg-4">
                    <div class="box">
    
                        <!--img-box---------->
                        <div class="slide-img" style="height: 350px;">
                        <?php
                        $imagers = Database::select("SELECT * FROM `images` WHERE `product_id`='".$sr["id"]."'");
                        $imagerow = $imagers->fetch_assoc();
                        ?>
                            <img alt="1" src="<?php echo $imagerow["code"] ?>">
                            <!--overlayer---------->
                            <div class="overlay">
                                <!--buy-btn------>
                                <a href="<?php echo "singleProductView.php?pid=" . ($sr["id"]); ?>" class="buy-btn">Buy Now</a>
                            </div>
                        </div>
                        <!--detail-box--------->
                        <div class="detail-box" style="height: 100px;">
                            <!--type-------->
                            <div class="type">
                                <a href="#"><?php echo $sr["title"] ?></a>
                                <?php
                                $brs = Database::select("SELECT * FROM `brand` WHERE `id` = '" . $sr["brand_id"] . "'");
                                $bfr = $brs->fetch_assoc();
                                ?>
                                <span><?php echo $bfr["name"] ?></span>
                                <?php
                                if ($sr["qty"] == 0) {
                                ?>
                                    <span class="card-text text-danger">Out of Stock</span>
                                <?php
                                } else {
                                ?>
                                    <span class="card-text text-warning">In Stock</span>
                                <?php
                                }
    
                                ?>
    
                            </div>
                            <!--price-------->
                            <a href="#" class="price">Rs. <?php echo $sr["price"] ?></a>
    
                        </div>
    
                    </div>
                </div>
            <?php
            }
      }  else {
        ?>
            <div class="col-12">
                <div class="row text-center">
                    <p class="fs-3 fw-bold text-black-50"> No Products from this Size</p>
                </div>
            </div>
    <?php
        }}
    

    


        ?>
        <div class="row">
            <div class="float-end mt-4">
                <div class="pagination">

                    <?php

                    if ($pageno != 1) {
                    ?>
                        <li class="page-item"><a class="page-link" onclick="bringSize(<?php echo $pageno - 1 ?>, <?php echo $cid ?>)">Previous</a></li>
                    <?php

                    }
                    ?>


                    <?php
                    for ($i = 1; $i <= $number_of_pages; $i++) {
                        if ($i == $pageno) {
                    ?>
                            <li class="page-item active"><a class="page-link" onclick="bringSize(<?php echo $i ?>,<?php echo $cid ?>)"><?php echo $i ?></a></li>

                        <?php
                        } else {
                        ?>
                            <li class="page-item"><a class="page-link" onclick="bringSize(<?php echo $i ?>,<?php echo $cid ?>)"><?php echo $i ?></a></li>

                    <?php
                        }
                    }

                    ?>

                    <?php
                    if ($pageno != $number_of_pages) {
                    ?> <li class="page-item"><a class="page-link" onclick="bringSize(<?php echo $pageno + 1 ?>, <?php echo $cid ?>)">Next</a></li>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
     } 



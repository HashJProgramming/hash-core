<?php
include_once 'sign-in.php';
include_once 'sign-up.php';
include_once 'sign-out.php';
// ----------------------------------------- SETTINGS ----------------------------------------- //
// check if session is already start if not then session start
if (!isset($_SESSION)) {
    session_start();
}

function settings($data, $value) {
    $str = file_get_contents('./settings.json');
    $json = json_decode($str, true);
    return $json[$data][$value];
}

function site_name() {
    echo settings('site-settings', 'site-name');
}

function head(){

    foreach (settings('site-config','head') as $head){
        echo $head;
    }
}


function js(){
    foreach (settings('site-config','js') as $js){
        echo $js;
    }
}

function authenticator($option): bool
{
    switch($option){
        case 'auth':
            if (!isset($_SESSION['ID'])){
                $location = settings('site-settings', 'site-sign-in');
                header("Location: $location");
            } else{
                $location = settings('site-settings', 'dashboard');
                header("Location: $location");
            }
            break;
        case 'auth-bool':
            if (!isset($_SESSION['ID'])){
                return true;
            } else{
                return false;
            }
    }
}

function currency($price): string
{
    return settings('ecommerce-config','currency').number_format($price, 2);
}
// ----------------------------------------- END SETTINGS ----------------------------------------- //












// ----------------------------------------- PRODUCT LIST SETTINGS ----------------------------------------- //
function products(){
    $conn = mysqli_connect(settings('database','host'), settings('database','username'), settings('database','password'), settings('database','database'));
    echo '
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container bg-white">
    <nav class="navbar navbar-expand-md navbar-light bg-white">
        <div class="container-fluid p-0"> '.settings('ecommerce-config', 'product-list-title').' <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNav" aria-controls="myNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="fas fa-bars"></span> </button>
            <div class="collapse navbar-collapse" id="myNav">
                <div class="navbar-nav ms-auto"> <a class="nav-link active" aria-current="page" href="#">All</a> <a class="nav-link" href="#">Womens</a> <a class="nav-link" href="#">Mens</a> <a class="nav-link" href="#">Kids</a> <a class="nav-link" href="#">Accessories</a> <a class="nav-link" href="#">Cosmetics</a> </div>
            </div>
        </div>
    </nav>
    ';

        $sql = "SELECT * FROM `products` order by `product_id` desc";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result-> fetch_assoc()) {
                product_list($row['product_id'],$row['product_name'], currency($row['product_price']), $row['product_picture']);
            }
        }

    echo '
    </div>
</div>';
}




function product_list($product_id, $product_name, $product_price, $product_picture){

    echo "<div class=\"row\">
            <div class=\"col-lg-3 col-sm-6 d-flex flex-column align-items-center justify-content-center product-item my-3\">
                <div class=\"product\"> <img src=\"$product_picture\" alt=\"\">
                    <ul class=\"d-flex align-items-center justify-content-center list-unstyled icons\">
                        <li class=\"icon mx-3\"><a href='#$product_id'><span  class=\"fas fa-expand-arrows-alt\"></span></a></li>
                        <li class=\"icon\"><a href='#$product_id'><span class=\"fas fa-shopping-bag\"></span></a></li>
                    </ul>
                </div>
                <div class=\"tag bg-red\">ID $product_id</div>
                <div class=\"title pt-4 pb-1\">$product_name</div>
                <div class=\"d-flex align-content-center justify-content-center\">";

            for ($i = 0; $i < rand(1, 5); $i++) {
                echo '<span class="fas fa-star"></span>';
            }


    echo "</div>
            <div class=\"price\">$product_price</div>
        </div>";
}
// ----------------------------------------- END PRODUCT LIST SETTINGS ----------------------------------------- //

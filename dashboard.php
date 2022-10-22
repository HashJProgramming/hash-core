<?php 
include_once 'functions/functions.php';
authenticator('auth');
?>

<html lang="en">
<head>
    <title><?php site_name(); ?> </title>
    <?php head(); echo settings('ecommerce-config', 'product-css')[0] ?>
</head>
<body>


<!--    ADD YOU CODE HERE -->
<?php
sign_out_button();
products();

?>
<!--    ADD YOU CODE HERE -->


    <?php js(); ?>
</body>
</html>


<?php include_once 'functions/functions.php';
    authenticator('auth');
?>
<html lang="en">
<?php 
head();
echo settings('ecommerce-config', 'product-css')[0]?>

<body>

    <?php
    products();
    sign_out_button();
    js();
    ?>

</body>

</html>
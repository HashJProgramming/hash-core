<?php
include_once 'functions/functions.php';

if (!isset($_GET['auth'])) {
//    echo '<script>window.location.href="#auth='.hash('sha512',  date('m/d/Y h:i:s a', time())).'hash='.hash('sha512', time()).'"</script>';
echo $_SERVER['HTTP_USER_AGENT'];
}
sign_in_form();
//sign_up_form();
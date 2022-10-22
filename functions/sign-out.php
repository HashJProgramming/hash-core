<?php
include_once 'functions/functions.php';

function sign_out(){
    if(isset($_POST['sign-out'])){
        session_destroy();
        $location = settings('site-settings','site-sign-in');
        header("Location:$location");
    }
}

function sign_out_button(){
    echo '<form action="'.sign_out().'" method="post">
        <button type="submit" name="sign-out" class="btn btn-primary btn-block">Sign Out</button>
    </form>';
}
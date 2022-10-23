<?php
function sign_up(){
    $con = mysqli_connect(settings('database','host'), settings('database','username'), settings('database','password'), settings('database','database'));
    if (isset($_POST['submit'])){
        $username = base64_encode($_POST['username']);
        $password = base64_encode($_POST['password']);
        $confirm_password = base64_encode($_POST['cnf-password']);
        $firstname = base64_encode($_POST['firstname']);
        $lastname = base64_encode($_POST['lastname']);
        $gender = base64_encode($_POST['gender']);
        $email = base64_encode($_POST['email']);
        $locality = base64_encode($_POST['locality']);
        $address = base64_encode($_POST['address']);
        $state = base64_encode($_POST['state']);
        $country = base64_encode($_POST['country']);
        $zip = base64_encode($_POST['zip']);
        $phone = base64_encode($_POST['phone']);
        $country_code = base64_encode($_POST['country-code']);
        $dob = base64_encode($_POST['dob']);


        $sql = "SELECT * FROM `users` WHERE `username`='$username'";
        $result = $con->query($sql);
        if (mysqli_num_rows($result) < 1) {
            if($password == $confirm_password){
                    $sql = "INSERT INTO `users` (`username`, `password`, `firstname`, `lastname`, `gender`, `email`, `locality`, `address`, `state`, `country`, `zip`, `phone`, `contrycode`, `dob`, `hash`)
                            VALUES ('$username', '$password', '$firstname', '$lastname','$gender' , '$email', '$locality', '$address', '$state', '$country', '$zip', '$phone', '$country_code', '$dob', '".hash('sha512', $username)."')";
                   $con->query($sql);
                    $location_success = settings('site-settings','site-sign-in');
                    header("Location: $location_success?sign-up-success=true");
            }
            sign_up_error_message('A problem has been occurred while creating your account. Password and Confirm Password does not match.');
        }else{
            sign_up_error_message('A problem has been occurred while creating your account. Username is already been taken.');
        }
    }
}

function sign_up_error_message($message){
    echo '
        <div class="m-4">
            <div class="alert alert-danger alert-dismissible fade show">
                <h4 class="alert-heading"><i class="bi-exclamation-octagon-fill"></i> Oops! Something went wrong.</h4>
                <p>'.$message.'</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    ';
}

function sign_up_form(){
    if(authenticator('auth-bool')){
        $location = settings('site-settings','dashboard');
        header("Location: $location");
    }
    echo '
        <div class="container-sm mt-2 shadow-lg rounded">
            <form method="post" action="'.sign_up().'" class="p-4">
            <h2 class="text-center">Here you can Sign up</h2>
            <div class="row mt-4 g-3 align-items-center">
                <div class="col-sm-6 form-group">
                    <label for="name-f">First Name</label>
                    <input type="text" class="form-control" name="firstname" id="name-f" placeholder="Enter your first name." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="name-l">Last name</label>
                    <input type="text" class="form-control" name="lastname" id="name-l" placeholder="Enter your last name." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-1">Address Line-1</label>
                    <input type="text" class="form-control" name="locality" id="address-1" placeholder="Locality/House/Street no." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-2">Address Line-2</label>
                    <input type="text" class="form-control" name="address" id="address-2" placeholder="Village/City Name." required>
                </div>
                <div class="col-sm-4 form-group">
                    <label for="State">State</label>
                    <input type="text" class="form-control" name="state" id="state" placeholder="Enter your state name." required>
                </div>
                <div class="col-sm-2 form-group">
                    <label for="zip">Postal-Code</label>
                    <input type="text" class="form-control" name="zip" id="zip" placeholder="Postal-Code." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="Country">Country</label>
                    <select class="form-control custom-select browser-default" name="country">
                                ';

                        foreach (settings('site-config','country') as $country){
                            echo $country;
                        }

                    echo '
                    </select>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="Date">Date Of Birth</label>
                    <input type="Date" name="dob" class="form-control" id="Date" placeholder="" required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="sex">Gender</label>
                    <select id="sex" class="form-control browser-default custom-select" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="unspecified">Unspecified</option>
                </select>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="cod">Country code</label>
                    <select class="form-control browser-default custom-select" name="country-code">
                    ';

                        foreach (settings('site-config','country-code') as $country_code){
                            echo $country_code;
                        }

                        echo '
                    </select>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="tel">Phone</label>
                    <input type="tel" name="phone" class="form-control" id="tel" placeholder="Enter Your Contact Number." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="user">Username</label>
                    <input type="text" name="username" class="form-control" id="pass" placeholder="Enter your username." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="pass">Password</label>
                    <input type="Password" name="password" class="form-control" id="pass" placeholder="Enter your password." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="pass2">Confirm Password</label>
                    <input type="Password" name="cnf-password" class="form-control" id="pass2" placeholder="Re-enter your password." required>
                </div>
                <div class="col-sm-12">
                    <input type="checkbox" class="form-check d-inline" id="chb" required><label for="chb" class="form-check-label">&nbsp;I accept all terms and conditions.
                    </label>
                </div>
    
                <div class="col-sm-12 form-group mb-0">
                   <button class="btn btn-primary float-end" name="submit">Sign Up</button>
                </div>
                
            </div>
            </form>
        </div>
    ';


}
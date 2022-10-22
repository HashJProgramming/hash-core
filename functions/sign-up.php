<?php
function sign_up(){
    $con = mysqli_connect(settings('database','host'), settings('database','username'), settings('database','password'), settings('database','database'));
    if (isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password'";
        $result = $con->query($sql);
        if (mysqli_num_rows($result) < 1) {
            if ($row = $result-> fetch_assoc()) {
                $_SESSION['ID'] = hash('sha256', $row['ID']);
                $location_success = settings('site-settings','dashboard');
                header("Location: $location_success?sign-up-success=true");
                exit();
            }
        }else {
            $location_failed = settings('site-settings','site-sign-in');
            header("Location: $location_failed?sign-up-failed=true");
            exit();
        }
    }
}

function sign_up_form(){
    if(!authenticator('auth-bool')){
        $location = settings('site-settings','dashboard');
        header("Location: $location");
    }
    echo '
        <div class="container-sm mt-2 shadow-lg rounded">
            <form class="p-4">
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
                    <input type="text" class="form-control" name="Locality" id="address-1" placeholder="Locality/House/Street no." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="address-2">Address Line-2</label>
                    <input type="text" class="form-control" name="address" id="address-2" placeholder="Village/City Name." required>
                </div>
                <div class="col-sm-4 form-group">
                    <label for="State">State</label>
                    <input type="text" class="form-control" name="State" id="State" placeholder="Enter your state name." required>
                </div>
                <div class="col-sm-2 form-group">
                    <label for="zip">Postal-Code</label>
                    <input type="text" class="form-control" name="Zip" id="zip" placeholder="Postal-Code." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="Country">Country</label>
                    <select class="form-control custom-select browser-default">
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
                    <select id="sex" class="form-control browser-default custom-select">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="unspecified">Unspecified</option>
                </select>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="cod">Country code</label>
                    <select class="form-control browser-default custom-select">
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
                   <button class="btn btn-primary float-end">Sign Up</button>
                </div>
                
            </div>
            </form>
        </div>
    ';


}
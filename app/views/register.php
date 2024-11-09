<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>La MinSU</title>
  <link rel="shortcut icon" type="image/png" href="public/assets/images/logos/favicon.ico" />
  <link rel="stylesheet" href="public/assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
              <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="public/assets/images/logos/logo.png" width="100" alt="">
                </a>
                <form action="<?php echo site_url('/signup'); ?>" method="post" onsubmit="return validateForm()">
                  <div class="mb-3">
                    <label for="exampleInputtext1" class="form-label" >First Name</label>
                    <input type="text" class="form-control" name ="firstname" id="firstname" aria-describedby="textHelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputtext1" class="form-label" >Last Name</label>
                    <input type="text" class="form-control" name ="lastname" id="lastname" aria-describedby="textHelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" >Email Address</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label" >Password</label>
                    <input type="password" class="form-control" name= "password" id="password">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control"  name= "confirmpassword" id="confirmpassword" oninput="validatePassword()">
                    <span id="password-status" style="font-size: 16px; position: absolute; top: 50%; transform: translateY(-50%); right: 5px;"></span>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="/login">Sign In</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="public/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="public/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<script>
    function validatePassword() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmpassword").value;
        var passwordStatus = document.getElementById("password-status");

        if (confirmPassword === "") {
            passwordStatus.innerHTML = "";
        } else if (password === confirmPassword) {
            passwordStatus.innerHTML = "&#10004;";
            passwordStatus.style.color = "green";
        } else {
            passwordStatus.innerHTML = "&#10006;";
            passwordStatus.style.color = "red";
        }
    }

    function validateForm() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmpassword").value;

        if (password !== confirmPassword) {
            alert("Passwords do not match!");
            return false;
        }

        return true;
    }
</script>
<?php
// header('Location: authenticated/');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTR-System</title>
    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script>
        if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_RELOAD) {
            window.location.href = window.location.pathname;
        }
    </script>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body{
        background-color: #1269db;
    }

    .login-container{
        width: 100%;
        display: flex;
        justify-content: end;
        box-shadow: 4px #000;
    }

    .login-form{
        background-color: white;
        width: 40%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
    }

    .form {
        background-color: #fff;
        display: block;
        padding: 1rem;
        max-width: 350px;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .form-title {
        font-size: 1.25rem;
        line-height: 1.75rem;
        font-weight: 600;
        text-align: center;
        color: #000;
    }

    .input-container {
        position: relative;
    }

    .input-container input,
    .form button {
        outline: none;
        border: 1px solid #e5e7eb;
        margin: 8px 0;
    }

    .input-container input {
        background-color: #fff;
        padding: 1rem;
        padding-right: 3rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        width: 300px;
        border-radius: 0.5rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .input-container span {
        display: grid;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        padding-left: 1rem;
        padding-right: 1rem;
        place-content: center;
    }

    .input-container span i {
        color: #9CA3AF;
        width: 1rem;
        height: 1rem;
    }

    .submit {
        display: block;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
        background-color: #1269DB;
        color: #ffffff;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        width: 100%;
        border-radius: 0.5rem;
        text-transform: uppercase;
    }

    .signup-link {
        color: #6B7280;
        font-size: 0.875rem;
        line-height: 1.25rem;
        text-align: center;
    }

    .signup-link a {
        text-decoration: underline;
    }
</style>

<body>
    <div style="display:flex;">
        <div class="login-container">
            <div class="login-form" style="position:relative;">
                <?php if(isset($_GET['error-login'])): ?>
                    <div class="" style="position:absolute; top:8rem; ">
                        <div class="" style="background-color:#F1AEB5;">
                            <p style="text-align:center; font-size:small; width:18rem; padding:.5rem 0;">Invalid Credentials, please try again.</p>
                        </div>
                    </div>
                <?php endif; ?>
                <form class="form" action="backend/authenticate.php" method="POST">
                    <p class="form-title">Sign in to your account</p>
                    <div class="input-container">
                        <input type="text" name="username" placeholder="Enter Username">
                        <span>
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>
                    <div class="input-container">
                        <input type="password" name="password" id="password" placeholder="Enter Password">
                        <span style="cursor:pointer;" onclick="showPassword()">
                            <i id="eye" class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                    <button class="submit" type="submit" name="login">
                        Sign in
                    </button>

                    <p class="signup-link">
                        No account?
                        <a href="">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showPassword() {
            var password = document.getElementById("password");
            if(password.type === "password"){
                password.type = "text";
                document.getElementById("eye").classList.replace("fa-eye", "fa-eye-slash");
            }
            else{
                password.type = "password";
                document.getElementById("eye").classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>

    <!-- Bootstrap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
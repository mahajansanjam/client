<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login To Dashboard</title>
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }

        .login-page {
            font-family: "Inter", sans-serif;
            font-weight: 600;
            background: #ffffff !important;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        .login-page .login-form {
            width: 100%;
            height: 100%;
        }

        .login-page .inner-login-form {
            width: 100%;
            /* display: flex
; */
            /* flex-direction: row; */
            height: 100%;
        }

        .login-page .login-left-sec {
            float: left;
            height: 100%;
            width: 35%;
            margin: 37px 37px 37px 75px;
            position: relative;
        }

        .login-page .inner-left-sec {
            overflow: hidden;
            border-radius: 20px;
            position: relative;
            width: 100%;
            height: 90%;
            background: linear-gradient(318deg, rgba(204, 158, 252, 1) 0%, rgba(130, 51, 213, 1) 100%);
        }

        .login-page .login-heading {
            padding: 103px 33px 0;
            position: absolute;
            top: 0;
        }

        .login-page .login-heading h1 {
            margin-bottom: 18px;
            color: #ffffff;
            font-size: 51px;
            font-weight: 700;
        }

        .login-page .login-heading p {
            color: #ffffff;
            font-weight: 300;
            font-size: 14px;
            /* max-width: 300px; */
        }

        .login-page .computer-img {
            position: absolute;
            bottom: -65px;
            left: 20px;
            width: 86%;
            height: 91%;
            z-index: 2;
        }

        .login-page .computer-img::before {
            content: "";
            position: relative;
            background: url(./images/computer.png) no-repeat center center / contain;
            width: 100%;
            height: 100%;
            display: block;
        }

        .login-page .computer-img::after {
            left: -67px;
            opacity: 0.5;
            /* top: 46px; */
            border-radius: 50%;
            bottom: 82%;
            display: inline-block;
            content: "";
            width: 400px;
            height: 400px;
            background: rgb(225 225 225 / 40%);
            z-index: 111;
            position: relative;
        }

        .login-page .ellipse {
            position: relative;
        }

        .login-page .ellipse::before {
            left: -51px;
            opacity: 0.5;
            top: 258px;
            border-radius: 50%;
            /* bottom: 130%; */
            display: inline-block;
            content: "";
            width: 403px;
            height: 348px;
            background: #CC9EFC;
            position: relative;
        }




        .login-page .login-right-sec {
            align-content: center;
            height: 100%;
            float: right;
            width: 55%;
            /* display: flex
; */
            justify-content: center;
            /* align-items: center; */
        }

        .login-page .login-input-fields-group {
            margin: 0 auto;
            width: 70%;
            /* max-width: 465px; */
            /* padding: 40px; */
        }

        .login-page .heading-right-login h1 {
            font-size: 45px;
            font-weight: 700;
            color: #50267A;
            margin-bottom: 40px;
            text-align: center;
        }

        .login-page .login-input-fields {
            margin-bottom: 25px;
        }

        .login-page .login-input-fields label {
            display: block;
            font-size: 17px;
            color: #000000;
            margin-bottom: 10px;
        }

        .login-page .login-input-icon {
            background-color: rgb(192 166 218 / 30%);
            border-radius: 8px;
            padding: 10px 12px;
        }

        .login-page .login-input-icon i {
            margin-right: 10px;
            color: #6b21a8;
        }

        .login-page .login-input-icon input {
            height: 48px;
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            font-size: 14px;
            color: #1c0e2a;
        }

        .login-page .login-button {
            margin-top: 20px;
            width: 100%;
            height: 68px;
            padding: 14px;

            background: linear-gradient(318deg, rgba(132, 53, 214, 1) 0%, rgba(189, 146, 233, 1) 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 22px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
        }


        .login-page .forgot {
            margin-top: 20px;
            text-align: center;
        }

        .login-page .forgot a {
            text-decoration: underline;
            color: #000000;
            font-size: 15px;
        }

        /* for validation */
        .login-page .error-msg {
            color: red;
            font-size: 13px;
            margin-top: 5px;
            display: none;
        }

        @media only screen and (max-width: 1679px) {
           .login-page .login-heading h1 {

                font-size: 47px;

            }

           .login-page .login-heading {
                padding: 32px 33px 0;

            }

            .login-page .computer-img::after {
                bottom: 88%;
            }

            .login-page .ellipse::before {

                top: 198px;

            }
        }

        @media only screen and (max-width: 1439px) {
            .login-page .login-heading h1 {
                font-size: 40px;
            }
        }

        @media only screen and (max-width: 1365px) {
            .login-page .computer-img::after {
                bottom: 91%;
                height: 380px;
            }
        }

        @media only screen and (max-width: 1279px) {
            .login-page .login-heading h1 {
                font-size: 34px;
            }
        }

        @media only screen and (max-width: 1199px) {
            .login-page .login-left-sec {

                width: 40%;
                margin: 37px 15px 10px 30px;

            }
        }

        @media only screen and (max-width: 991px) {
            .login-page .login-left-sec {
                float: none;
                width: 92%;
                margin: 30px 30px 30px;
            }

            .login-page .login-right-sec {
                align-content: start;

                float: none;
                width: 100%;

            }

            .login-page {

                overflow: visible;
            }

            .login-page .computer-img {
                right: 0;
                transform: translateX(50%);

                left: 0;
                width: 50%;

            }

            .login-page .computer-img::after {
                bottom: 84%;
                height: 250px;
                width: 250px;
            }

            .login-page .login-left-sec {

                height: 70%;

            }

            .login-page .login-right-sec {
                height: 80%;
            }

            .login-page .ellipse::before {
                transform: translateX(53%);
                left: 0;
                width: 248px;
                height: 248px;
                top: 149px;
                right: 0;
            }
        }
    </style>
</head>

<body>
    <div class="login-page">
        <div class="login-form">
            <div class="inner-login-form">
                <div class="login-left-sec">
                    <div class="inner-left-sec">

                        <div class="login-heading">
                            <h1>Login To Dashboard</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce fringilla rhoncus nunc, et
                                vulputate orci. Aliquam scelerisque lacus non.</p>
                        </div>
                        <div class="computer-img">
                            <img src="./images/3556960_prev_ui 1.png" alt="">
                        </div>
                        <div class="ellipse">
                        </div>
                    </div>
                </div>
                <div class="login-right-sec">
                    <div class="login-input-fields-group">
                        <div class="heading-right-login">
                            <h1>Login</h1>
                        </div>
                        <form id="login-form">
                            <div class="login-input-fields">
                                <label>Username</label>
                                <div class="login-input-icon">
                                    <input type="text" id="username" />
                                </div>
                                <div class="error-msg" id="username-error"></div>
                            </div>

                            <div class="login-input-fields">
                                <label>Password</label>
                                <div class="login-input-icon">
                                    <input type="password" id="password" />
                                </div>
                                <div class="error-msg" id="password-error"></div>
                            </div>

                            <button class="login-button" type="submit">Login</button>
                        </form>

                        <div class="forgot">
                            <a href="#">Forget Password</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="./js/script.js" defer></script>
</body>

</html>
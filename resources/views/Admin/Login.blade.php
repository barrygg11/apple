<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" /> -->
        <title>Barry</title>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Abel|Abril+Fatface|Alegreya|Arima+Madurai|Dancing+Script|Dosis|Merriweather|Oleo+Script|Overlock|PT+Serif|Pacifico|Playball|Playfair+Display|Share|Unica+One|Vibur');
            * {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                }
                body {
                    background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
                    background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
                    background-attachment: fixed;
                    background-repeat: no-repeat;

                        font-family: 'Vibur', cursive;
                        font-family: 'Abel', sans-serif;
                    opacity: .95;
                }
                form {
                    width: 450px;
                    min-height: 500px;
                    height: auto;
                    border-radius: 5px;
                    margin: 2% auto;
                    box-shadow: 0 9px 50px hsla(20, 67%, 75%, 0.31);
                    padding: 2%;
                    background-image: linear-gradient(-225deg, #E3FDF5 50%, #FFE6FA 50%);
                }
                /* form Container */
                form .con {
                    display: -webkit-flex;
                    display: flex;

                    -webkit-justify-content: space-around;
                    justify-content: space-around;

                    -webkit-flex-wrap: wrap;
                    flex-wrap: wrap;

                    margin: 0 auto;
                }

                /* the header form form */
                header {
                    margin: 2% auto 10% auto;
                    text-align: center;
                }
                /* Login title form form */
                header h2 {
                    font-size: 250%;
                    font-family: 'Playfair Display', serif;
                    color: #3e403f;
                }
                /*  A welcome message or an explanation of the login form */
                header p {letter-spacing: 0.05em;}

                .input-item {
                    background: #fff;
                    color: #333;
                    padding: 14.5px 0px 15px 15px;
                    border-radius: 5px 0px 0px 5px;
                }
                /* #eye {
                    background: #fff;
                    color: #333;

                    margin: 5.9px 0 0 0;
                    margin-left: -20px;
                    padding: 15px 9px 19px 0px;
                    border-radius: 0px 5px 5px 0px;

                    float: right;
                    position: relative;
                    right: 1%;
                    top: -.2%;
                    z-index: 5;
                    
                    cursor: pointer;
                } */
                /* inputs form  */
                input[class="form-input"]{
                    width: 250px;
                    height: 50px;

                    margin-top: 2%;
                    padding: 15px;
                    
                    font-size: 16px;
                    font-family: 'Abel', sans-serif;
                    color: #5E6472;

                    outline: none;
                    border: none;

                    border-radius: 0px 5px 5px 0px;
                    transition: 0.2s linear;     
                }
                input[id="txt-input"] {width: 250px;}
                /* focus  */
                input:focus {
                    transform: translateX(-2px);
                    border-radius: 5px;
                }
                button {
                    display: inline-block;
                    color: #252537;

                    width: 280px;
                    height: 50px;

                    padding: 0 20px;
                    background: #fff;
                    border-radius: 5px;
                    
                    outline: none;
                    border: none;

                    cursor: pointer;
                    text-align: center;
                    transition: all 0.2s linear;
                    
                    margin: 7% auto;
                    letter-spacing: 0.05em;
                }
                /* Submits */
                .submits {
                    width: 48%;
                    display: inline-block;
                    float: left;
                    margin-left: 2%;
                }
                .frgt-pass {background: transparent;}
                .sign-up {background: #B8F2E6;}
                button:hover {
                    transform: translatey(3px);
                    box-shadow: none;
                }

                button:hover {
                    animation: ani9 0.4s ease-in-out infinite alternate;
                }
                @keyframes ani9 {
                    0% {
                        transform: translateY(3px);
                    }
                    100% {
                        transform: translateY(5px);
                    }
                }
        </style>
        <script>
            function show() {
                var p = document.getElementById('pwd');
                p.setAttribute('type', 'text');
            }

            function hide() {
                var p = document.getElementById('pwd');
                p.setAttribute('type', 'password');
            }
            // var pwShown = 0;
            // document.getElementById("eye").addEventListener("click", function () {
            //     if (pwShown == 0) {
            //         pwShown = 1;
            //         show();
            //     } else {
            //         pwShown = 0;
            //         hide();
            //     }
            // }, false);
        </script>
    </head>
    <body>
        <div class="overlay">
        <form method="POST" action="">
            @csrf
        <div class="con">
            <header class="head-form">
                <h2>登入</h2>
                <p>請在下方輸入您的名稱與密碼</p>
            </header>
            <br>
            <div class="field-set">
                <span class="input-item">
                    <i class="fa fa-key"></i>
                </span>
                    <input class="form-input" type="text" placeholder="Name" name="username" required>
                <br>
                <span class="input-item">
                    <i class="fa fa-key"></i>
                </span>
                <input class="form-input" type="password" placeholder="Password" name="password" required>
                <!-- <span>
                    <i class="fa fa-eye" aria-hidden="true"  type="button" id="eye"></i>
                </span> -->
                <br>
                <!-- <input type="submit" value="{{ trans('admin.login') }}" /> -->
                <button class="log-in">登入</button>
            </div>
            <!-- <div class="other">
                <button class="btn submits frgt-pass">Forgot Password</button>
                <button class="btn submits sign-up">Sign Up 
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                </button>
            </div> -->
        </div>
            </form>
        </div>
    </body>
</html>
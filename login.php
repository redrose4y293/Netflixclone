    <!DOCTYPE html>
    <?php
    require_once("class/fillterform.php");
    require_once("class/config.php");
    require_once("class/Account.php");
    require_once("class/Constants.php");
    $account  = new Account($con);
    if(isset($_POST["submitbutton"])){

            if (isset($_POST["submitbutton"])) {
        
            $username = filterform::sanitizerFormusername($_POST["username"]);
            $password = filterform::sanitizerFormpassword($_POST["password"]);
            
            $sucess = $account->login($username,$password);
            if($sucess){
                $_SESSION["userloggedin"] = $username;
                header("Location: index.php");
            }
        }
        
    }
    function getInputvalue($name){
     if(isset($_POST[$name])){
         echo $_POST[$name];
     }
    }
    ?>
    <html>
        <head>
            <title>Welcome to flex Login page</title>
            <link rel="stylesheet" type="text/css" href="assest/style.css"/>
        </head>
        <body>
            <div class="signincontainer">
                <div class="column">
                    <div>
                    <div class="header">
                        <h3>Welcome to Flex</h3>
                        <span>To continue to watch the Videos</span>
                    </div>
                    </div>
                            <form method="POST">    
                            <?php echo $account->getError(Constants::$loginfailed);?>
                            <input type="text" name="username" placeholder= "User Name" value="<?php getInputvalue("username");?>"required>

                            
                            <input type="password" name="password" placeholder="Enter Password" required>
            
                            <input type="submit" value="submit" name="submitbutton">

                            </form>
                             <a href="register.php" class="signInMessage"> Need and account SignUp Here! </a>
                </div>
            </div>
        </body>
    </html>
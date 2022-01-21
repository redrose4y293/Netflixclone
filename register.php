    <!DOCTYPE html>
    <?php
    require_once("class/fillterform.php");
    require_once("class/config.php");
    require_once("class/Account.php");
    require_once("class/Constants.php");
    $account  = new Account($con);

    if (isset($_POST["submitbutton"])) {
    $firstName = filterform::sanitizerFormstring($_POST["firstName"]);
    $lastName = filterform::sanitizerFormstring($_POST["lastName"]);
    $username = filterform::sanitizerFormusername($_POST["username"]);
    $email = filterform::sanitizerFormEmail($_POST["email"]);
    $email2 = filterform::sanitizerFormEmail($_POST["email2"]);
    $password = filterform::sanitizerFormpassword($_POST["password"]);
    $password2 = filterform::sanitizerFormpassword($_POST["password2"]);
    
    $sucess = $account->register($firstName,$lastName,$username,$email,$email2,$password,$password2);
    if($sucess){
        $_SESSION["userloggedin"] = $username;
        header("Location: index.php");
    }
}
function getinputvalue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}

?>
<html>

<head>
    <title>Welcome to Flex Register page</title>
    <link rel="stylesheet" type="text/css" href="assest/style.css" />
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
                <?php  echo $account->getError(Constants::$firstNameChracters); ?>           
                <input type="text" name="firstName" placeholder="First Name" value="<?php getinputvalue("firstName"); ?>"required>
                
                <?php echo $account->getError(Constants::$lastNameChracters);   ?>
                <input type="text" name="lastName" placeholder="Last Name" value = "<?php getinputvalue("lastName");?>"required>

                <?php echo $account->getError(Constants::$usernameCheck);?>
                <?php echo $account->getError(Constants::$usernametaken);      ?>
                <input type="text" name="username" placeholder="User Name" value = "<?php getinputvalue("username");?>" required>

                <?php echo $account->getError(Constants::$emaildontmatch); ?>
                <?php echo $account->getError(Constants::$emailtaken);?>
                <?php echo $account->getError(Constants::$invalidemailformat);?>
                <input type="email" name="email" placeholder="Enter Email" value = "<?php getinputvalue("email");?> "required>

                <input type="email" name="email2" placeholder="Confirm Email" value = "<?php getinputvalue("email2");?> "required>
                
                <?php echo $account->getError(Constants::$passlenght);?>
                <?php echo $account->getError(Constants::$pwnotmatch);?>       
                <input type="password" name="password" placeholder="Enter Password" required>

                <input type="password" name="password2" placeholder="Confirm Password" required>

                <input type="submit" value="submit" name="submitbutton">

            </form>
            <a href="login.php" class="signInMessage"> Already Have a Account Login Here </a>


        </div>
    </div>
</body>

</html>
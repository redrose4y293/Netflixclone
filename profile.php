    <?php
    require_once("assest/header.php");
    require_once("class/Account.php");
    require_once("class/fillterform.php");
    require_once("class/Constants.php");
    
    $user= new User($con,$userLoggedin);


    if(isset($_POST["SaveButtonDetails"])) {
        
        $account = new Account($con);
        $firstName = filterform::sanitizerFormstring($_POST["firstName"]);
        $lastName = filterform::sanitizerFormstring($_POST["lastName"]);
        $email = filterform::sanitizerFormEmail($_POST["email"]);

        if($account->UpdateDetails($firstName,$lastName,$email,$userLoggedin)){
            //Sucess

            echo "update";
        }
        else {
            ///failure
            echo "No update";
           
         }
    }
    ?>

    <div class="SettingContainers column">

        <div class="formSection">

        <form method="POST">

        <h2> User Details</h2>

        <?php
            
            $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : $user->getfirstName();
            $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : $user->getlastName();
            $email = isset($_POST["email"]) ? $_POST["email"] : $user->getUsername();
        ?>

        <input type="text" name="firstName" placeholder="Enter First name" value="<?php echo $firstName; ?>">
        <input type="text" name="lastName" placeholder="Enter Last Name" value="<?php echo $lastName; ?>">
        <input type="email" name="email" placeholder="Pleas Enter Email" value="<?php  echo $email; ?>">
        <input type="submit" name="SaveButtonDetails" value="Save" >
        </form>

        </div>

        <div class="formSection">

    <form method="POST">

    <h2> Update Password</h2>

    <input type="password" name="oldpassword" placeholder="Enter Old PassWord">
    <input type="password" name="newpassword" placeholder="Enter New Password">
    <input type="password" name="confirmpassword" placeholder="Confirm New Password">
    <input type="submit" name="SavepasswordDetails" value="Submit" >
    </form>




    </div>

    </div>
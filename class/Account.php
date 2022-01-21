    <?php

    class Account {
    private $con;
    private $error_array = array();
    public function __construct($con){
    $this->con = $con;
    }

    public function UpdateDetails($fn,$ln,$un,$em) {
    $this->validateFirstname($fn);
    $this->validateLastname($ln);
    $this->validatenewEmail($em,$un);

    if(empty($this->error_array)){
        
    $query = $this->con->prepare("UPDATE users SET firstName=:fn, lastName=:ln, email=:em
    WHERE username=:un");
                        $query->bindValue(":fn",$fn);
                        $query->bindValue(":ln",$ln);
                        $query->bindValue(":em",$em);
                        $query->bindValue(":un",$un);

                        return $query->execute();
    }

    return false;

    }
    public function register($fn,$ln,$un,$em,$em2,$pw,$pw2){
    $this->validateFirstname($fn);
    $this->validateLastname($ln);
    $this->validateUsername($un);
    $this->validateEmail($em,$em2);
    $this->validatePassword($pw,$pw2);
    if(empty($this->error_array)){
    return $this->insterUserdetails($fn,$ln,$un,$em,$pw);
    }

    return false;
    }

    public function login($un,$pw){
        $pw = hash("sha512", $pw);
        $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
            
            $query->bindValue(":un",$un);
           
            $query->bindValue(":pw",$pw);
            
            $query->execute();
            if($query->rowCount()==1)  {
                return true;
            }
            array_push($this->error_array,Constants::$loginfailed);
            return false;
    }
    private function insterUserdetails($fn,$ln,$un,$em,$pw){
    $pw = hash("sha512" , $pw);
    $query = $this->con->prepare("INSERT INTO users (firstname,lastname,username,email,password)
                                VALUES(:fn,:ln,:un,:em,:pw)");
            $query->bindValue(":fn", $fn); 
            $query->bindValue(":ln",$ln);
            $query->bindValue(":un",$un);
            $query->bindValue(":em",$em);
            $query->bindValue(":pw",$pw);
            
            return $query->execute();
    }
    private function validateFirstname($fn){
    if(strlen($fn) < 2 || strlen($fn) > 25){
        array_push($this->error_array,Constants::$firstNameChracters);
        }
    }
    private function validateLastname($ln){
        if(strlen($ln) < 2 || strlen($ln) > 25){
            array_push($this->error_array,Constants::$lastNameChracters);
        }
    }
    private function validateUsername($un){
    if(strlen($un) < 2 || strlen($un) > 25){
        array_push($this->error_array,Constants::$usernameCheck);
        return;
    }
        $query = $this->con->prepare("SELECT * FROM users WHERE username = :un");

        $query->bindvalue(":un" , $un);

        $query->execute();
        if($query->rowCount() != 0) {
            array_push($this->error_array,Constants::$usernameCheck);
        }
    }
    private function validateEmail($em,$em2){
    if($em != $em2){

        array_push($this->error_array,Constants::$emaildontmatch);
        return;
    }
    if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
        array_push($this->error_array,Constants::$invalidemailformat);
        return;
    }
    $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");

    $query->bindvalue(":em",$em);

    $query->execute();

    if($query->rowCount() != 0 ){

        array_push($this->error_array,Constants::$emailtaken);
    }

    }
    private function validateNewEmail($em, $un) {

        if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->error_array, Constants::$invalidemailformat);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE email=:em AND username != :un");
        $query->bindValue(":em", $em);
        $query->bindValue(":un", $un);

        $query->execute();
        
        if($query->rowCount() != 0) {
            array_push($this->error_array, Constants::$emailtaken);
        }
    }
    private function validatepassword($pw,$pw2){
    if($pw != $pw2){
        array_push($this->error_array,Constants::$pwnotmatch);
    }
    if(strlen($pw) < 5 || strlen($pw) > 25 ){
        array_push($this->error_array,Constants::$passlenght);
    }
    }
    public function getError($error){
        if(in_array($error,$this->error_array)){
            return  "<span class='errorMessage'> $error </span>" ;
        }
    }
    public function validateEror(){

        return $this->error_array;
    }
    
    }

    ?>
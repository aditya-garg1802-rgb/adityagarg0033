<?php
    require_once("config.php");
    require_once("account.php");
    $account=new Account($exc);
    if(isset($_POST["submitButton"]))/*i want to checkthe submit button is in there if its there then form is submitted*/
    {
       $firstName=correctformfirstname($_POST["firstName"]);
       $lastName=correctformfirstname($_POST["lastName"]);
       $username=correctformusername($_POST["username"]);
       $email=correctformemail($_POST["email"]);
       $email2=correctformemail($_POST["email2"]);
       $password=correctformpassword($_POST["password"]);
       $password2=correctformpassword($_POST["password2"]);
        $success=$account->register($firstName,$lastName,$username,$email,$email2,$password,$password2);
        if($success)
         {
             //it will store session(sessions are just ways of saving variables and values,even after the page has been closed or in some cases even after the browser has been closed.)
             $_SESSION["userLoggedIn"]=$username;
             header("Location:index.php");//header function sends a raw http response to the client.  
         }   
    }
    function correctformfirstname($input)
    {
        $input=strip_tags($input);
        $input=str_replace(" ","",$input);
        $input=strtolower($input);
        $input=ucfirst($input);
        return $input;
    }
    function correctformusername($input)
    {
        $input=strip_tags($input);
        $input=str_replace(" ","",$input);
        return $input;
    }
    function correctformpassword($input)
    {
        $input=strip_tags($input);
        return $input;
    }
    function correctformemail($input)
    {
        $input=strip_tags($input);
        $input=str_replace(" ","",$input);
        return $input;
    }
    function getinput($name)
    {
        if(isset($_POST[$name]))
        {
            echo $_POST[$name];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Adiflix</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <div class="sign-in">
        <div class="col">
            <div class="header">
              <img src="images\logo.png" title="logo" alt="Adiflix Logo"/>
              <h3>Sign Up</h3> 
              <span>to continue to Adiflix</span>
            </div>
            <form method="POST">
                <?php echo $account->getError("First name should be of minimum 2 letters"); ?>
                <?php echo $account->getError("First name should be of maximum 30 letters"); ?>
                <input type="text" name="firstName" placeholder="First Name"value="<?php getinput("firstName"); ?>" required>
                <?php echo $account->getError("Last name should be of minimum 2 letters"); ?>
                <?php echo $account->getError("Last name should be of maximum 30 letters"); ?>
                <input type="text" name="lastName" placeholder="Last Name"value="<?php getinput("lastName"); ?>" required>
                <?php echo $account->getError("Username should be of minimum 2 letters"); ?>
                <?php echo $account->getError("Username should be of maximum 55 letters"); ?>
                <?php echo $account->getError("Username already exists"); ?>
                <input type="text" name="username" placeholder="Username"value="<?php getinput("username"); ?>" required>
                <?php echo $account->getError("Emails don't match"); ?>
                <?php echo $account->getError("Email Invalid"); ?>
                <input type="email" name="email" placeholder="Email"value="<?php getinput("email"); ?>" required>
                <input type="email" name="email2" placeholder="Confirm Email"value="<?php getinput("email2"); ?>" required>
                <?php echo $account->getError("Passwords don't match"); ?>
                <?php echo $account->getError("Passwords length should be between 2 and 30 letters");?>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password2" name="password2" placeholder="Confirm Password" required>
                <input type="submit" name="submitButton" value="SUBMIT">
            </form>
            <a href="login.php" class="signinlink">Already have an account? Sign in here!</a>
        </div>
    </div>
</body>
</html>
<?php
    require_once("config.php");
    require_once("account.php");
    $account=new Account($exc);
    if(isset($_POST["submitButton"]))/*i want to checkthe submit button is in there if its there then form is submitted*/
    {
        $username=correctformusername($_POST["username"]);
        $password=correctformpassword($_POST["password"]);
         $success=$account->login($username,$password);
         if($success)
         {
             //it will store session(sessions are just ways of saving variables and values,even after the page has been closed or in some cases even after the browser has been closed.)
             $_SESSION["userLoggedIn"]=$username;
             header("Location:index.php");//header function sends a raw http response to the client.  
         }   
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
              <h3>Sign In</h3> 
              <span>to continue to Adiflix</span>
            </div>
            <form method="POST">
                <?php echo $account->getError("Username and password are incorrect");?>
                <input type="text" name="username" placeholder="Username" value="<?php getinput("username"); ?>"required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="submitButton" value="SUBMIT">
            </form>
            <a href="registeruser.php" class="signinlink">Need an account? Sign up here!</a>
        </div>
    </div>
</body>
</html>
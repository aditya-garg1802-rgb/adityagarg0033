<?php
class Account
{
    private $exc;
    private $errorArray = array();
    public function __construct($exc)
    {
        $this->exc=$exc;
    }
    public function register($fn,$ln,$un,$em,$em2,$pw,$pw2)
    {
        $this->validatefirstname($fn);
        $this->validatefirstname($ln);
        $this->validateusername($ln);
        $this->validateemail($em,$em2);
        $this->validatepassword($pw,$pw2);
        if(empty($this->errorArray))
        {
            return $this->insertUserDetails($fn,$ln,$un,$em,$pw);
        }
        return false;
    }
    public function login($un,$pw)
    {
        $query=$this->exc->prepare("SELECT * FROM adiflix WHERE username=:un AND password=:pw");
        $query->bindValue(":un",$un);
        $query->bindValue(":pw",$pw);
        $query->execute();
        if($query->rowCount()==1)
        {
            return true;
        }
        array_push($this->errorArray,"Username and password are incorrect");
        return false;
    }
    private function insertUserDetails($fn,$ln,$un,$em,$pw)
    {
        $query=$this->exc->prepare("INSERT INTO adiflix (firstName, lastName, username, email, password) 
                                     VALUES (:fn,:ln,:un,:em,:pw)");
        $query->bindValue(":fn",$fn);
        $query->bindValue(":ln",$ln);
        $query->bindValue(":un",$un);
        $query->bindValue(":em",$em);
        $query->bindValue(":pw",$pw);
        return ($query->execute());
    }
    private function validatefirstname($fn)
  {
    if(strlen($fn)<2)
    {
        array_push($this->errorArray,"First name should be of minimum 2 letters");
    }
    elseif(strlen($fn)>30)
    {
       array_push($this->errorArray,"First name should be of maximum 30 letters"); 
    }
  }
  private function validatelasttname($ln)
  {
    if(strlen($ln)<2)
    {
        array_push($this->errorArray,"Last name should be of minimum 2 letters");
    }
    elseif(strlen($ln)>30)
    {
       array_push($this->errorArray,"Last name should be of maximum 30 letters"); 
    }
  }
  private function validateusername($un)
  {
    if(strlen($un)<2)
    {
        array_push($this->errorArray,"Username should be of minimum 2 letters");
        return;
    }
    elseif(strlen($un)>55)
    {
       array_push($this->errorArray,"Username should be of maximum 55 letters"); 
       return;
    }
    $query=$this->exc->prepare("SELECT * FROM adiflix WHERE username=:un");
    $query->bindValue(":un",$un);
    $query->execute();
    if($query->rowCount() != 0)
    {
        array_push($this->errorArray,"Username already exists");
    }
  }
  private function validateemail($em,$em2)
  {
    if($em != $em2)
    {
        array_push($this->errorArray,"Emails don't match");
        return;
    }
    if(!filter_var($em, FILTER_VALIDATE_EMAIL))
    {
        array_push($this->errorArray,"Email Invalid");
    }
  }
  private function validatepassword($pw,$pw2)
  {
    if($pw != $pw2)
    {
        array_push($this->errorArray,"Passwords don't match");
        return;
    }
    if(strlen($pw)<2 || strlen($pw)>30)
    {
        array_push($this->errorArray,"Passwords length should be between 2 and 30 letters");
    }
  }
    public function getError($error)
    {
        if(in_array($error,$this->errorArray))
        {
            return "<span style='color:#f00;font-size: 14px; font-weight: 400; text-align:center;'>$error</span>";
        }
    }

}
?>

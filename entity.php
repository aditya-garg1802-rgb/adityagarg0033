<?php
class Entity{
    private $exc,$sqldata;
    public function __construct($exc,$input)
    {
        $this->exc=$exc;

        if(is_array($input))
        {
            $this->sqldata=$input;
        }
        else
        {
            $query = $this->exc->prepare("SELECT * FROM entities where id=:id");
            $query->bindValue(":id",$input);
            $query->execute();
            $this->sqldata=$query->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function getId()
    {
        return $this->sqldata["id"];
    }
    public function getName()
    {
        return $this->sqldata["name"];
    }
    public function getThumbnail()
    {
        return $this->sqldata["thumbnail"];
    }
    public function getPreview()
    {
        return $this->sqldata["preview"];
    }
}
?>
<?php
require_once("header.php");
class PreviewProvider{
    private $exe,$username;
    public function __construct($exc,$username)
    {
        $this->exc=$exc;
        $this->username=$username;
    }
    public function createPreviewVideo($entity)
    {
        if($entity==NULL)
        {
            $entity=$this->getRandomEntity();
        }
        $id=$entity->getId();
        $name=$entity->getName();
        $preview=$entity->getPreview();
        $thumbnail=$entity->getThumbnail();
        return "<div class='previewContainer'>
            <img src='$thumbnail' class='previewImage' hidden style='width:100%;height:auto;'>
            <video autoplay muted class='previewVideo'style='width:100%;height:auto;'>
            <source src='$preview' type='video/mp4'> 
            </video>
        </div>";
    }
    private function getRandomEntity()
    {
        $query=$this->exc->prepare("SELECT * FROM entities ORDER BY RAND()");
        $query->execute();

        $row=$query->fetch(PDO::FETCH_ASSOC);
        return new Entity($this->exc,$row);
    }
}
?>
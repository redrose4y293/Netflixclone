<?php
 
 class SearchResultProvider{
 

    private $con;
    private $username;

    public function __construct($con,$username)
    {
        $this->con = $con;
        $this->username = $username;
        
    }
    public function getResults($inputtext){

        $entites = EntityProvider::getSearchEntities($this->con,$inputtext);

        $html = "<div class='categorypreview noScroll'>";
        $html .= $this->getResultHtml($entites);
        
        return $html . "</div>";
    }
    private function getResultHtml($entities) {

        if(sizeof($entities) == 0) {
            return;
        }
        $entitiesHtml = "";
        $previewprovider = new PreviewProvider($this->con,$this->username);
        foreach($entities as $entity) {

            $entitiesHtml .=$previewprovider->createEntityPreviewsqure($entity);
        }
    return "<div class='category'>
        <div class='entites'>
            $entitiesHtml
       </div>
        </div>";

    }
 }




?>
    <?php
    class CategoryContainers {

        private $con,$username;

        public function __construct($con,$username)
        {
            $this->con = $con;
            $this->username  = $username;
        }
        public function showAllCategories(){

        $query = $this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html = "<div class='categorypreview'>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $html .= $this->getcategoryhtml($row,null,true,true);

        }

        return $html . "</div>";

        }
        public function showtvCategories(){

            $query = $this->con->prepare("SELECT * FROM categories");
            $query->execute();
    
            $html = "<div class='categorypreview'>
                    <h1>Tv Shows</h1>";
    
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $html .= $this->getcategoryhtml($row,null,true,false);
    
            }
    
            return $html . "</div>";
    
            }
            public function showMoviesCategories(){

                $query = $this->con->prepare("SELECT * FROM categories");
                $query->execute();
        
                $html = "<div class='categorypreview'>
                        <h1>Movies</h1>";
        
                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $html .= $this->getcategoryhtml($row,null,false,true);
        
                }
        
                return $html . "</div>";
        
                }
    
        public function showCategory($categoryid , $title = null) {
            $query = $this->con->prepare("SELECT * FROM categories WHERE id=:id");

            $query->bindValue(":id",$categoryid);

            $query->execute();
    
            $html = "<div class='categorypreview noScroll'>";
    
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                $html .= $this->getcategoryhtml($row,$title,true,true);
    
            }
    
            return $html . "</div>";
        }
        private function getcategoryhtml($sqldata,$title,$tvShows,$movies){
            $categoryid = $sqldata["id"];
            $title = $title ==null ? $sqldata["name"] : $title ;

            if($tvShows && $movies) {
                $entities = EntityProvider::getEntities($this->con,$categoryid,30);
            }
            else if($tvShows){
                $entities = EntityProvider::getTvShowsEntities($this->con,$categoryid,30);
            }
            else{
                $entities = EntityProvider::getMovieShowsEntities($this->con,$categoryid,30);
            }
            if(sizeof($entities) == 0) {
                return;
            }
            $entitiesHtml = "";
            $previewprovider = new PreviewProvider($this->con,$this->username);
            foreach($entities as $entity) {

                $entitiesHtml .=$previewprovider->createEntityPreviewsqure($entity);
            }
        return "<div class='category'>
            <a href='category.php?id=$categoryid'>
              <h3>$title</h3>
            </a>
            <div class='entites'>
                $entitiesHtml
           </div>
            </div>";
        }
    }
    ?>
<?php 

	require_once 'google/autoload.php';
    require_once  "Database.php";
    require_once "Zend/Loader.php";
        // $service = new Google_Service_YouTube($client);
    require_once 'Icrud.php';
	class GoogleApiYoutube implements Icrud{
    
   
    private $youtube_object;
    private $client;
    private $service;
    private $db;

    function __construct() {
        $this->db = new Database('Yoories');
       
         $this->client = new Google_Client();
         
         $this->client->setApplicationName("Yoories");
         $this->client->setDeveloperKey("AIzaSyD4UsaxhiSdIIPS6wsVcWkCRxNw4qRvz-c");
        // parent::__construct($this->client);
         $this->service = new Google_Service_YouTube($this->client);
        
    }

        function showsAll(){
            $sql ="select * from videos";
            $query = $this->db->query($sql);
            while( $row = mysqli_fetch_assoc($query)){
                $id[] = $row['vidid'];            }

            return $id;

        }
    function vidInfo($id){
          
        echo "<iframe width=\"560\" height=\"315\" id=\"player\"
        src=\"https://www.youtube.com/embed/{$id}?autohide=1&enablejsapi=1&origin=https://appsocial-yvens47.c9.io&showinfo=0\"
       class=\"embed-responsive-item\" frameborder=\"0\" allowfullscreen ></iframe>";
    }
    
    function video($id){
      
         $videos = $this->service->videos->listvideos('snippet', array(
           'id'=>"$id",
         
         ));
         $iterator = new RecursiveArrayIterator ($videos['items']);
         
        //print_r($iterator);
     
        while($iterator->valid()){
             $id = $iterator->current()['id'];
              $title = $iterator->current()['snippet']['title'];
              // print_r($iterator->current()['snippet']);
               $img = $iterator->current()['snippet']['thumbnails']['high']['url'];
              echo '<div class="trends">
                            <a href="view.php?id='.$id.'">
                            <img src="'.$img.'" alt="'. $title.'" ></a> ';
            //$title =ereg_replace('/((.*)) /'," ", $title);
                         echo '   <p class="name">'.$title.'</p>
                            
                                </div>';
             
              $iterator->next();
        }
        
      
                
    }
    
    
    function addToFavs(){
        
    }
    
    function mostPopularYoutube(){
        $search = $this->service->search->listSearch('id, snippet',array(
            'q' =>'funny haitian videos',
            'maxResults'=>6,
            
            'order'=>'rating'
            ));
        
        $it = new RecursiveArrayIterator ($search['items']);
        while($it->valid()){
             $id = $it->current()['id']['videoId'];
             $title = $it->current()['snippet']['title'];
              $img = $it->current()['snippet']['thumbnails']['high']['url'];
              
              echo "<li>
                        <a href=\"profile.php?id=$id\">
                       <img src=\"$img\" alt=\"$title\">
                        </a>
                        <p class=\"ltitle\"> $title</p>

                </li>";
             
              $it->next();
        }
       
    }

        function playlist($id){
           $playlist =  $this->service->playlistItems->listPlaylistItems('id, snippet',

                array("playlistId"=>"$id",
                    "maxResults"=>50));

            return $playlist['items'];

        }


        function save($id){
            $sql ="select * from videos where vidId ='$id'";
            if(mysqli_num_rows($this->db->query($sql)) == 0){
                // insert video id  to database
                $sql = "Insert into videos VALUE (NULL , '$id')";
                $q = $this->db->query($sql);
            };
        }

        function commentsfeed($id){
            Zend_Loader::loadClass("Zend_Gdata_YouTube");
            $yt = new Zend_Gdata_YouTube();
            $commentFeed = $yt->getVideoCommentFeed($id);


            foreach ($commentFeed as $commentEntry) {
                echo "<div>
                    <img src=\"\" class='picthumb'/>";
                echo "<p class='name'>".$commentEntry->author[0]->name->text."</p>";
                //echo $commentEntry->title->text . "<br/>";
                echo "<p class='body'>". $commentEntry->content->text . "</p>";

                echo $commentEntry->author[0]->uri->text. "\n";
                //echo $commentEntry->published->text. "\n";
                echo "</div>";
            }

          

        }







}

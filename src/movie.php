<?php
  include "conf/info.php";
  
  $id_movie = $_GET['id'];
    include_once "api/api_movie_id.php";
    include_once "api/api_movie_video_id.php";
    include_once "api/api_movie_similar.php";
    $title = "Detail Movie (".$movie_id->original_title.")";
    include_once "header.php";
  
?>

    <?php 
    if(isset($_GET['id'])){
    $id_movie = $_GET['id']; 
    ?>
    <h1 id="orgTitle"><?php echo $movie_id->original_title ?></h1>
    <?php
      echo '<h5> <span style="color:#ffffff;text-align:center;">'.$movie_id->tagline." </h5>";
    ?>

    <?php 

      foreach($movie_video_id->results as $video){
                    echo '<iframe width="560" height="315" src="'."https://www.youtube.com/embed/".$video->key.'" frameborder="0" allowfullscreen></iframe>';
      }
     ?>"

    <hr >
    <div class="ispis">
          <img id= "image" src="<?php echo $imgurl_2 ?><?php echo $movie_id->poster_path ?>">
          <p>Title : <?php echo $movie_id->original_title ?></p>
          <p id="tagline">Tagline : <?php echo $movie_id->tagline ?></p>
          <p>Genres : 
              <?php
                foreach($movie_id->genres as $g){
                  echo '<span>' . $g->name . '</span> ';
                }
              ?>
          </p>
          <p>Overview : <?php echo $movie_id->overview ?></p>
          <p>Release Date : <?php $rel = date('d F Y', strtotime($movie_id->release_date)); echo $rel ?>
          <p>Production Companies :
              <?php
                foreach($movie_id->production_companies as $pc){
                  echo $pc->name." ";
                }
              ?>
          </p>
          <p>Production Countries:
              <?php
                foreach($movie_id->production_countries as $pco){
                  echo $pco->name. "&nbsp;&nbsp;" ;
                }
              ?>
          </p>
          <p>Budget: $ <?php echo $movie_id->budget ?> </p>
          <p>Vote Average : <?php echo $movie_id->vote_average ?></p>
          <p>Vote Count : <?php echo $movie_id->vote_count ?></p>
     </div>     
    <hr>
    <div class="similarClass">
    <h3 id="similar">Similar Movies</h3>
      
      <?php
        $count = 4;
        
        foreach($movie_similar_id->results as $sim){

          echo '<div class="column2">
                  <div class="row2">
                  <a href="movie.php?id='.$sim->id.'"><img src="http://image.tmdb.org/t/p/w300'.$sim->backdrop_path.'" width="280" height="200" ></a><h5><span style="color:#aee8e0;text-align:center;font-size:18px">'.$sim->title.'</h5>
                   </div>
                  </div>';
          if($count <=0){
            break;
            $count--;
          }
        }
        
      ?>
      
  
    <?php 
    } else{
      echo "<h5>Movie not found.</h5>";
    }

    ?>
    </div>


<?php
  include_once "footer.php";
?>
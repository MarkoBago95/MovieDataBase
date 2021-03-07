<?php
  include "conf/info.php";
  $title="Now Playing Movies";
  include_once "header.php";
?>

    <h1 id="odjeljak">Now Playing Movies</h1>
    <?php
      include_once "api/api_now.php";
      $min = date('d F Y', strtotime($nowplaying->dates->minimum));
      $max = date('d F Y', strtotime($nowplaying->dates->maximum));
      echo "<h5><sub style=color:#ffffff;text-align:center;>from</sub> <span style=color:#ffffff;text-align:center;>". $min . "</span>  <sub style=color:#ffffff;text-align:center;>, until</sub> <span span style=color:#ffffff;text-align:center;>" . $max . "</span></h5>";
    ?>
    <hr>
      <?php
        
        foreach($nowplaying->results as $p){
          echo '<div class="column">
                  <div class="row">
                  <a href="movie.php?id=' . $p->id . '"><img src="'.$imgurl_1.''. $p->poster_path . '" width="140" height="180"></a><h4><span style="color:#aee8e0;text-align:center;">' . $p->original_title . " (" . substr($p->release_date, 0, 4) .")</h4><h5><span style=color:#aee8e0;text-align:center;>"." Rate : " . $p->vote_average . " | Vote : " . $p->vote_count ."</h5> </h6><span style=color:#aee8e0;text-align:center;>"."Popularity : " . round($p->popularity) . "</h6>
                     </div>
                  </div>";
        }
      ?>
   

<?php
  include_once "footer.php";
?>
<?php

  include "conf/info.php";
  $title="Welcome to";
  include_once "header.php";
?>
    <h1 id="odjeljak"> Top Rated Movies </h1>
    <hr>
    
      <?php
      
        include_once "api/api_toprated.php";
        foreach($toprated->results as $p){
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
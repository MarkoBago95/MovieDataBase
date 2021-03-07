<?php
  include "conf/info.php";
  $title="TV Series";
  include_once "header.php";
?>

    <?php
      include_once "api/api_tv.php";
    ?>
    <div class="tvseries">
        <h3>On Air TV Show</h3>
        <hr>
          <?php
            foreach($tv_onair->results as $tp){
              $dd = date('d F Y', strtotime($tp->first_air_date));
              echo '<div class="column">
                  <div class="row">
                  <h3><a href="tvshow.php?id=' . $tp->id . '"><img src="'.$imgurl_2.''. $tp->poster_path . '" width="140" height="180"></h3></a><h4><span style="color:#aee8e0;text-align:center;">'. $tp->original_name .'</h4><p style="color:#aee8e0;">First Air Date : '.$dd.'</p><p style="color:#aee8e0;">Popularity : '.round($tp->popularity).'</p>
                  </div>
                  </div>';
            }
          ?>

        
        <hr>
        
          
          <?php
            foreach($tv_top->results as $tt){
              $de = date('d F Y', strtotime($tt->first_air_date));
              echo '<div class="column">
                  <div class="row">
                  <h3><a href="tvshow.php?id=' . $tt->id . '"><img src="'.$imgurl_2.''. $tt->poster_path . '" width="140" height="180"></h3></a><h4><span style="color:#aee8e0;text-align:center;">'. $tp->original_name .'</h4><p style="color:#aee8e0;" >First Air Date : '.$tt->first_air_date.'</p><p style="color:#aee8e0;">Popularity : '.round($tt->popularity).'</p>
                  </div>
                  </div>';
             
            }
          ?>
        
      </div>
    </div>
     </div>
    

    

<?php
  include_once "footer.php";
?>
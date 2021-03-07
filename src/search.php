<?php
$input=$_GET['search'];
$channel=$_GET['channel'];
$search=$input;
include_once "conf/info.php";
$title = 'Result Search | '.$input;
include_once "header.php";
include_once "api/api_search.php";
?>
    <h3 id="porukaSearch">Result Search: <em><?php echo $input?></em></h3>
    <hr>
    <div class="search">
    
<?php
	if($channel=="movie"){	
                foreach($search->results as $results){
			$title 		= $results->title;
			$id 		= $results->id;
			$release	= $results->release_date;
			if (!empty($release) && !is_null($release)){
				$tempyear 	= explode("-", $release);
				$year 		= $tempyear[0];
				if (!is_null($year)){
					$title = $title.' ('.$year.')';
				}
			}
			$backdrop 	= $results->backdrop_path;
			if (empty($backdrop) && is_null($backdrop)){
				$backdrop =  dirname($_SERVER['PHP_SELF']).'/image/no-gambar.jpg';
			} else {
				$backdrop = 'http://image.tmdb.org/t/p/w300'.$backdrop;
			}
			echo '<div class="column2">
                  <div class="row2">
                          <a href="movie.php?id=' . $id . '"><img src="'. $backdrop . '" width="200" height="180"  ></a>' . '<h4><span style="color:#ffffff;text-align:center;">'.$title. "</h4>
                  </div>
                  </div>";
                 
			
		}
        }elseif($channel=="tv"){
            foreach($search->results as $results){
			$title 		= $results->original_name;
			$id 		= $results->id;
			if (!empty($release) && !is_null($release)){
				$tempyear 	= explode("-", $release);
				$year 		= $tempyear[0];
				if (!is_null($year)){
					$title = $title.' ('.$year.')';
				}
			}
			$backdrop 	= $results->backdrop_path;
			if (empty($backdrop) && is_null($backdrop)){
				$backdrop =  dirname($_SERVER['PHP_SELF']).'/image/no-gambar.jpg';
				// $backdrop =  dirname($_SERVER['PHP_SELF']).'image/no-backdrop.png';
			} else {
				$backdrop = 'http://image.tmdb.org/t/p/w300'.$backdrop;
			}
			echo '<div class="column2">
                  <div class="row2">
                          <a href="tvshow.php?id=' . $id . '"><img src="'. $backdrop . '" width="200" height="180"  ></a>' . '<h4><span style="color:#ffffff;text-align:center;">'.$title. "</h4>
                  </div>
                  </div>";

		}
        }
        ?>
        
        </div>

 <?php
include_once('footer.php');
?>


<?php

$title = 'Search Results';
require_once 'includes/header.php';
require_once 'includes/law.php';
require_once 'includes/nav.php';

$rest_name_counter =0;
$rest_alt_counter =0;
$rest_loc_counter =0;

    $keys=array();
    
    foreach ($results['name'] as $restaurant) {
        if($rest_name_counter==0){
            echo "Direct Matches: ";
            $rest_name_counter++;
        }
        display($restaurant, $party, $time, $lin);
        array_push($keys, $restaurant->key);
        echo "<br>";
    }

    foreach ($results['tags'] as $restaurant) {
        if(in_array($restaurant->key, $keys)){
            continue;       
        }
        if($rest_alt_counter==0){
            echo "Suggestions: ";
            $rest_alt_counter++;
        }
        display($restaurant, $party, $time, $lin);
        array_push($keys, $restaurant->key);
        echo "<br>";
    }
    foreach($results['city'] as $restaurant){
        if(in_array($restaurant->key, $keys)){
            continue;
        }
        if($rest_loc_counter==0){
            echo "By Location: ";
            $rest_loc_counter++;
        }
        display($restaurant, $party, $time, $lin);
    }
    
    if(count($keys)==0){
        ?><center>
        No Results.  Please try again.
        </center>
<?php
    }


require_once 'includes/footer.php';

function display($restaurant, $party, $time, $lin) {
?>
    <center>
        <div class='restaurant-box' id="<?php echo $restaurant->key ?>">
                        
            <div class='display-box'>
                <img class='restaurant-picture' src=<?php echo ImageHelper::getMainImage($restaurant->key);?>>
                <div class='display-info' >
                    <h1><a href="restaurant.php?v=<?php echo $restaurant->key;?>&s=<?php echo $party;?>&t=<?php echo $time;?>&l=<?php echo $lin;?>"><?php echo $restaurant->name?></a></h1>
                    <?php echo $restaurant->shortDesc ?><br>
                    <?php echo "party of".": ".$party." on ".$time?><br>
                    <div>$$</div>
                    <div><a href="confirmation.php?">Time reservation buttons here</a></div>
                    <?php $counter =0 ;
                    $days=array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                    foreach($restaurant->hours as $day){
                        if( date("l")==$days[$counter])
                        {
                        echo  $days[$counter]." hours: ".$day[0]."-".$day[1] ."<br>";   
                        }
                        
                        $counter++;
                    }
                    ?>
                    
                    <p>contact information </p>
                </div>
            </div>
            <p> </p>
            <div class='description-box'>
                <p style='font-size:16px'>Restaurant Search Tags:
                    <span style='font-size:12px'><?php echo $restaurant->tags ?></span>
                </p>                  
            </div>
            
        </div>
    </center>
<?php
}

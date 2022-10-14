<?php

$realwed = array();
$display_realwed =$little->shaz_curl(json_encode($realwed), \NsLittle\Little::ROUTE. '/dispaly_realwed.php');
//print_r($display_realwed);
$realwed_decoded = json_decode($display_realwed);
$realweddata = $realwed_decoded->data;
//print_r($realweddata);

?>



<style>
   .breadcrumbs-page {     
   background-image: url(images/native/realwed-cover.jpg);
   margin-bottom: 0;
   }
   
    </style>
<section class="breadcrumbs-page">
        <div class="container">
            <h1>Real Wedding List</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Real Wedding List</li>
                </ol>
            </nav>
        </div>
    </section>

        <!-- Real Wedding Start -->
        <section class="wide-tb-90">
            <div class="container">          
                <div class="row">
                    <?php 
                    for ($r =0; $r < count($realweddata); $r++){
                        ?>
                    <!-- Real Wedding Stories -->
                    <div class="col-lg-4 col-md-6">
                        <div class="real-wedding-wrap">
                            <div class="real-wedding">
                                <div class="img">
                                    <div class="overlay">
                                        <i class="weddingdir_heart_double_alt"></i>
                                        Our Story
                                    </div>
                                    <a href="realweddings/<?php echo $realweddata[$r]->user_id;?>"><img src="images/realwed/<?php echo $realweddata[$r]->featured_image;   ?>" alt=""></a>
                                    <div class="date">
                                        <?php $weddate = strtotime($realweddata[$r]->wedding_date); echo date("F d, Y",$weddate);?>
                                    </div>
                                </div>
                                <ul class="list-unstyled gallery">
                                    <?php
                               $realwed_gallery = $realweddata[$r]->gallery;
                              $explode_gallery = explode(',', $realwed_gallery);
                             // print_r($explode_gallery);
                               $prefixed_array = preg_filter('/^/', 'images/realwed/', $explode_gallery);
                                 $remove = array_pop($prefixed_array); 
                                  // print_r($prefixed_array);
                                   
                                         
                                    ?>
                                    <li>
                                        <a href="realweddings/<?php echo $realweddata[$r]->user_id;?>">
                                            <img src="<?php echo $prefixed_array[0];?>" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="realweddings/<?php echo $realweddata[$r]->user_id;?>">
                                            <img src="<?php echo $prefixed_array[1];?>" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="realweddings/<?php echo $realweddata[$r]->user_id;?>">
                                            <div class="load-more">
                                                Load <br>More
                                            </div>
                                            <img src="<?php echo $prefixed_array[3];?>" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <h3><a href="realweddings/<?php echo $realweddata[$r]->user_id;?>"><?php $bride = $realweddata[$r]->bride_name; $explode_bride = explode(" ", $bride); echo $explode_bride[0]; ?> Weds <?php $groom = $realweddata[$r]->groom_name; $explode_groom = explode(" ", $groom); echo $explode_groom[0]; ?> </a></h3>
                            <p><i class="fa fa-map-marker"></i> <?php echo  $realweddata[$r]->town;?></p>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- Real Wedding Stories -->                    

                    
                </div>

                
            </div>
        </section>
        <!-- Real Wedding End -->
    
   
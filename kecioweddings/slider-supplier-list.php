<?php
$catid = array("cat_id"  => $url_id,);
$cdata = $little->shaz_curl(json_encode($catid), \NsLittle\Little::ROUTE.'/get_category_name.php');
$cdata_decode = json_decode($cdata);
$cat_name = $cdata_decode->data->name;


?>

<section class="search-result-header mt-lg-5 mt-md-5">
        <div class="container">
            <div class="row">
                 <input type="hidden" id="user_name" value="<?php echo $_SESSION['name'];?>">
                 <input type="hidden" id="user_phonenumber" value="<?php echo $_SESSION['phone_number'];?>">
                <div class="col-lg-9 mx-auto">
                    <h1><?php echo $cat_name;?></h1>
                    <?php 
                    if(empty($cat_name)){  ?>
                     <h1>All Vendors</h1>
                    <?php
                    }
                    ?>
                    <p class="lead">We are here to help you get the best vendors for your event.</p>
                    <div class="input-group">
                         <option id="catdata" value="<?php echo $catid['cat_id']; ?>" class="form-control form-light"><?php if(empty($cat_name)){echo "Category";}else{ echo $cat_name; }?></option> 
                         
                        <input type="text" id="box"  list="categories" name="category" class="form-control form-light" style="display:none" placeholder="Category" />
                       <datalist id="categories">
                         <?php 
                            for($n = 0; $n < count($cat); $n++){
                              $cat_ids = $cat[$n]->cat_id; 
                               $cat_name = $cat[$n]->name; 

                               //echo $cat_name;  
                            ?>
                       <option data-value="<?php  echo $cat_ids ;?>"  value="<?php echo $cat_name ;?>"></option>
                            <?php  } ?>   
                      </datalist>
                         <input type="text" id="location-box" list="locations" class="form-control form-light left-border" placeholder="Location">
                         <datalist id="locations">
                         <?php
                        for($lo= 0; $lo < count($mylocations); $lo++){
                          $records = $mylocations[$lo]->records;      
                         ?>
                   <option data-value="<?php echo $mylocations[$lo]->county_id;?>" value="<?php echo $mylocations[$lo]->county_name ;?>" style="font-size: 20px;"> </option>
                   
                        <?php    }?>  
                      </datalist>
                        <div class="input-group-prepend" id="defaultbutton" style="display:none">
                            <input id="mymama" class="btn btn-default" type="submit">
                        </div>
                         <div class="input-group-prepend" id="searchgtn">
                            <button type="button" class="btn btn-default" type="submit">Search Now</button>
                        </div>
                    </div>
                </div>
            </div>
                        
        </div>
                       
        </div>
    </section>
<?php
session_start();
error_reporting(0);
include '../classes/security.class.php';
include '../classes/little.class.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();

$counties = array(
    "County_id" => $security->sane_inputs("County_id", "POST")
);

$gettowns = $little->shaz_curl(json_encode($counties), \NsLittle\Little::ROUTE.'/selectSubregionbyid.php');
//print_r($gettowns);
$gettown_decode = json_decode($gettowns);
$mytowns = $gettown_decode->data;
//print_r($mytowns);
?>

<style>
    
  .nice-select {
    border-radius: 0px;
}

.nice-select .list {
    border-radius: 0px;
    height: 200px;
    overflow-y: auto;
}
.nice-select .option:hover, .nice-select .option.focus, .nice-select .option.selected.focus {
  color:red;
  background: none;
}  
    
</style>
<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                      <div class="form-group">
                                          <select class="theme-combo" style="width: 100%;" id="town">
                                                <option value="">Choose Area</option>
                                             <?php for($t = 0; $t < count($mytowns); $t++){  ?>
                                                <option value="<?php echo $mytowns[$t]->town_id;?>"><?php echo $mytowns[$t]->Town_name;?></option>
                                             <?php } ?> 
                                           </select>
                                         
                                          <div id="townfield" class="text-danger small" style="display:none">This field is required!</div>
                                        </div>
                                    </div>
                                      

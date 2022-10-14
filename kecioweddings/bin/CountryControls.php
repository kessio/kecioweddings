<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';
include '../add-listing-cssfile.php';
include '../add-listing-jsfile.php';

$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();


 $country = $security->sane_inputs("country", "POST"); 
 
 

 if($country == 'Kenya') { ?> 
 
     

                            <div class="form-group">
                                            <label class="control-label" for="County">County</label>
                                            <select class="wide" id="county">
                                                <option value="Select Category">Select County</option>
                                                <option value="Nairobi">Nairobi</option>
                                                <option value="Kisumu">Kisumu</option>
                                                <option value="Kisii">Kisii</option>
                                                <option value="Uansin-gishu">Uansin-gishu</option>
                                                <option value="Trans-nzoia">Trans-nzoia</option>
                                                <option value="Nyamira">Nyamira</option>
                                                <option value="Nandi">Nandi</option>
                                                <option value="Narok">Narok</option>
                                                <option value="Kajiado">Kajiado</option>
                                                <option value="Kiambu">Kiambu</option>
                                            </select>
                                        </div>

                           

<?php  }?>



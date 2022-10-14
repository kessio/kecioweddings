
<?php
error_reporting(0);

include '../classes/security.class.php';
include '../classes/little.class.php';


$little   = new \NsLittle\Little();
$security = new \NsSecurity\Security();


 $category = $security->sane_inputs("cat_id", "POST"); 
 
 

 if($category == '5') { ?> 
 
 

    
                               <div class="form-group" style="margin-bottom:1rem" >
                                            <select class="select2-container--form-light"  style="width: 100%;" id="subcategory">
                                                <option value="Select Category">Select Sub Category</option>
                                                <option value="Hotel">Hotels</option>
                                                <option value="Garden">Gardens</option>
                                                <option value="Country Clubs">Country Clubs</option>
                                                <option value="Beach">Beach</option>
                                                <option value="Waterfronts">Water-fronts</option>
                                                <option value="RoofTops">RoofTops</option>
                                            </select>
                                            </div>
                          
                                         <div id="subcategoryfield" class="text-danger small" style="display:none">Sub-Category Required!</div>
                             
                                        <div class="form-group" style="display: none">
                                            
                                            <textarea class="form-control" id="facilities" name="editordata" rows="6" placeholder="Description of your facility(Size, capacity etc)"></textarea>
                                        </div>
                                    

                                    

<?php  }elseif($category == '6') {    

 ?>
    

                
                              <div class="px-4 pt-0 mb-5">
                            <h3>Tents Offered</h3>
                                <div class="row row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2">
                                   
                                     <div class="col">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="tent" class="custom-control-input" id="customCheck14" value="Alpine Tents">
                                            <label class="custom-control-label" for="customCheck14"> Alpine Tents</label>
                                        </div>
                                         </div>
                                     </div>
                                     <div class="col">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="tent" class="custom-control-input" id="customCheck15" value="Clear Tents">
                                            <label class="custom-control-label" for="customCheck15">Clear Tents</label>
                                        </div>
                                         </div>
                                     </div>
                                     <div class="col">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="tent" class="custom-control-input" id="customCheck16" value="Marquee Tents">
                                            <label class="custom-control-label" for="customCheck16">Marquee Tents</label>
                                        </div>
                                         </div>
                                        
                                     </div>
                                   <div class="col">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="tent" class="custom-control-input" id="customCheck17" value="Dome Tents">
                                            <label class="custom-control-label" for="customCheck17">Dome Tents</label>
                                        </div>
                                         </div>
                                   </div>
                                    <div class="col">
                                         <div class="form-group">
                                      <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="tent" class="custom-control-input" id="customCheck20" value="Stretch Tents">
                                            <label class="custom-control-label" for="customCheck20"> Stretch Tents</label>
                                        </div>
                                         </div>
                                    </div>
                                    <div class="col">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="tent" class="custom-control-input" id="customCheck21" value="Canopy Tents">
                                            <label class="custom-control-label" for="customCheck21"> Canopy Tents</label>
                                        </div>
                                       </div>
                                    </div>
                                    
                                   <div class="col">
                                         <div class="form-group">                                    
                                    <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="tent" class="custom-control-input" id="customCheck18" value="A-Frame Tents">
                                            <label class="custom-control-label" for="customCheck18">A-Frame Tents</label>
                                        </div>
                                         </div>
                                   </div>
                                       <div class="col">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="tent" class="custom-control-input" id="customCheck22" value="Cheese Tents">
                                            <label class="custom-control-label" for="customCheck22"> Cheese Tents</label>
                                        </div>
                                         </div>
                                    </div>
                                    
</div>
</div>
                          
                     
    
    
<?php }elseif($category == '3'){ ?>
    
                   <div class="form-group" style="margin-bottom:1rem" >
                            <select class="theme-combo" id="entertainment">
                                <option value="Select Category">Select Sub Category</option>
                                <option value="Dj">Dj</option>
                                <option value="Band">Music Band</option>
                                <option value="Mc">Mc</option>
                                <option value="System">Sound & Visual System</option>
                            </select>
                        </div>
    
    
    
    
<?php }elseif($category == '10') {    

 ?> 

                        <div class="px-4 pt-0 mb-5">
                            <h4 >Chairs</h4>
                                <div class="row row-cols-1 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2">
                                    <div class="row">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck24" value="plastic Chairs">
                                            <label class="custom-control-label" for="customCheck24">plastic chairs</label>
                                        </div>
                                         </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck25" value="Chiavari Chairs">
                                            <label class="custom-control-label" for="customCheck25">Chiavari Chairs</label>
                                        </div>
                                         </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck26" value="Wimbeldon Foldable Chairs">
                                            <label class="custom-control-label" for="customCheck26">Foldable Chairs</label>
                                        </div>
                                         </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck27" value="Lounge Chairs">
                                            <label class="custom-control-label" for="customCheck27">Lounge Chairs</label>
                                        </div>
                                         </div>
                                    </div>
                                   <div class="row">
                                         <div class="form-group">
                                    
                                      <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck28" value="King Chairs">
                                            <label class="custom-control-label" for="customCheck28"> King & Queen Chairs</label>
                                        </div>
                                         </div>
                                   </div>
                                    <div class="row">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck29" value="Cross-back Chairs">
                                            <label class="custom-control-label" for="customCheck29"> Cross-back Chairs</label>
                                        </div>
                                         </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck30" value="Clear Chairs">
                                            <label class="custom-control-label" for="customCheck30">Clear Chairs</label>
                                        </div>
                                         </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group">
                                         <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck31" value="round-Back Chairs">
                                            <label class="custom-control-label" for="customCheck31"> Round-Back Chairs</label>
                                        </div>
                                       </div>
                                    </div>
                                    <h4 class="col-12">Tables</h4> 
                                   <div class="row">
                                         <div class="form-group">                                
                                          <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck32" value="Round Tables">
                                            <label class="custom-control-label" for="customCheck32">Round Tables</label>
                                        </div>
                                         </div>
                                   </div>
                                    <div class="row">
                                         <div class="form-group">
                                      <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck33" value="Rectangle Tables">
                                            <label class="custom-control-label" for="customCheck33"> Rectangle Tables</label>
                                        </div>
                                         </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck34" value="Square Tables">
                                            <label class="custom-control-label" for="customCheck34"> Square Tables</label>
                                        </div>
                                         </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="furniture" class="custom-control-input" id="customCheck35" value="Cocktail Tables">
                                            <label class="custom-control-label" for="customCheck35"> Cocktail Tables</label>
                                        </div>
                                         </div>
                                    </div>
                                    
                                </div>
                            </div>

<?php   } ?>

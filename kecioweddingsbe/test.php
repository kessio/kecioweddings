<?php
//error_reporting(0);
include 'classes/connection.class.php';
include 'classes/couple_profile.class.php';
include 'classes/security.class.php';
include 'classes/todolist.class.php';
include 'classes/budget.class.php';
include 'classes/guest_manager.class.php';
include 'classes/users.class.php';
include 'classes/add_listing.class.php';
include 'classes/listing.class.php';
include 'classes/category.class.php';
include 'classes/favourites.class.php';
include 'classes/wedding_website.class.php';
include 'classes/filter_list.class.php';
include 'classes/admin.class.php';
include 'classes/vendor_profile.class.php';
include 'classes/real_wedding.class.php';
include 'classes/recovery_password.class.php';
include 'classes/pricing.class.php';
include 'classes/cronjob.class.php';

$connection        = new \NsDbconnect\Dbconnect();
$couple_profile    = new \NsCoupleProfile\CoupleProfile();
$security          = new \NsSecurity\Security();
$todolist          = new \NsTodolist\Todolist();
$budget            = new \NsBudget\Budget();
$guestmanager      = new \NsGuestmanager\Guestmanager();
$users             = new \NsUsers\Users();
$listing           = new \NsAddListing\AddListing();
$mylisting         = new \NsListing\Listing();
$category          = new \NsCategory\Category();
$favs              = new \NsFavourite\Favourite();
$website           = new \NsWebsite\Website();
$filterlist        = new \NsFilterListing\FilterListing();
$admin             = new \NsAdmin\Admin();
$vendorpro         = new \NsVendorProfile\VendorProfile();
$realwed           = new \NsRealWedding\RealWedding();
$pass_recovery     = new \NsRecoverPassword\RecoverPassword();
$pricing           = new \NsPricing\Pricing();
$cronjobs          = new \NsCronJob\CronJob();

$views = $mylisting->total_user_reviews(132);
print_r($views);

//$paymes = $listing->publish_listing(2, 127);
//print_r($paymes);

//$selectpays  = $cronjobs->check_duetasks();
//print_r($selectpays);

//$price  = $pricing->display_invoice(127);
//print_r($price);
//$login   = $users->Login("", "qwdqwed@gmail.com", "qwerty");
///print_r($login);

//$recoverycode = $pass_recovery->keycode("4781");
//print_r($recoverycode);
//$randomno  = $pass_recovery->recover_password("chep@gmail.com");
//print_r($randomno);

///$real = $realwed->myrealwedding(3, 120, 'Jackline Chep', 'Amos Kiprotich', '', '', '', '', '' );
//print_r($real);
        
//$di= $couple_profile->display_profile(121);
///print_r($di);
 
//$faveexist = $favs->fav_exists(120, 6);
//print_r($faveexist);
//$favorites = $favs->group_favourite(121);
//print_r($favorites);

//$ratings = $mylisting->average_review(7);
//print_r($ratings);

//$locatioj = $filterlist->loop_location();
//print_r($locatioj);

//$price = $mylisting->request_pricing(119, 5, "kecio", "0721257726");
//print_r($price);

//$list = $filterlist->filterlist($cat_id, $subcategory, $region, $subregion, $amenities, $tents, $entertaiment, $furniture);
//print_r($list);

//$delete_guest = $website->delete_web_gallery(120, "397818858.jpg");
//print_r($delete_guest);
//$realwedding = $realwed->select_realwed(120);
//print_r($realwedding);

//$totals = $budget->budget_total($user_id);
//print_r($totals);
///$displayprof = $vendorpro->display_vendor_profile(119);
//print_r($displayprof);


//$phone_number = $users->phone_exists("0768230001");
//print_r($phone_number);

//$vendorsignup = $users->vendorSignup("Adrienne events", "kmercyd@gmail.com", "qwerty", "07682300013");
//print_r($vendorsignup);

//$websdite =$website->website_gallery("sha.jpg,she.jpg,co.jpg,sec.jpg,sha.jpg,she.jpg,co.jpg,sec.jpg,sha.jpg,she.jpg,co.jpg,sec.jpg,sha.jpg,she.jpg,co.jpg,sec.jpg,sha.jpg,she.jpg,co.jpg,sec.jpg,sha.jpg,she.jpg,co.jpg,sec.jpg,sha.jpg,she.jpg,co.jpg,sec.jpg,sha.jpg,she.jpg,co.jpg,sec.jpg,sha.jpg,she.jpg,co.jpg,sec.jpg,sha.jpg,she.jpg,co.jpg,sec.jpg,sha.jpg,she.jpg,co.jpg,sec.jpg,sha.jpg,she.jpg,co.jpg,sec.jpg,sha.jpg,she.jpg,co.jpg,sec.jpg", 44);
//print_r($websdite);
//$deatls = $website->website_info(101);
//print_r($deatls);

//$replace = $listing->add_listing("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "0724773603", "","");
//print_r($replace);


///$mylistings = $admin->count_listing();
//print_r($mylistings);
//$revieexist = $listing->get_maxListingid();
//print_r($revieexist);

//$couties = $filterlist->get_subregionname_by_id(1);
//print_r($couties);


//$select_county = $filterlist->selectCounties();
//print_r($select_county);

//$select_contituency = $filterlist->selectSubregion();
//print_r($select_contituency);


//$select_gallery = $listing->add_gallery(121,"dsc2020,dsc3030");
//print_r($select_gallery);

//$delete_img = $listing->edit_gallery(123, "1502542513.jpg");
//print_r($delete_img);

//$last_id = $mylisting->get_next_last_id(103,15);
//print_r($last_id);

//$reviews = $mylisting->display_review(103,15);
//print_r($reviews);


//$getpass = $users->getPassword(89);
//print_r($getpass);
//$passwordchange = $users->passwordChange(89, "shaz", "qwerty");
//print_r($passwordchange);

//$profile = $couple_profile->cprof_pic(44, "DSC_00445678");
//print_r($profile);

//$edit_users = $couple_profile->edit_users("tanisha Nyakundi", "tanisha05@gmail.com",44);
//print_r($edit_users);


//$disreviews = $mylisting->display_review(103, 0);
//print_r($disreviews);

//$add_guest = $guestmanager->add_guest(44, "Abby Shiku", "Bride Family", "073346890");
//print_r($add_guest);
//$list = $listing->add_listing(58, "testing klisting", 2, 'beauty', "tents", "entertainment", "furniture", "facility", "price", "country", "region", "subregion", "about", "services", "amenities", "facebook", "instagram", "gallery", "featured_image");
//print_r($list);

//$create_website  = $website->send_rsvp(44, "Waiting");
//print_r($create_website);
//$remove_prof_pic = $couple_profile->remove_prof_pic(44,'');
//print_r($remove_prof_pic);
//$display_website = $website->display_create_website('44');
//print_r($display_website);

//$display_prof = $couple_profile->display_profile(44);
//print_r($display_prof);
//
//$create_website  = $website->search_guest_rsvp(44, "4565u764");
//print_r($create_website);
//$create_website  = $website->create_website(44, 'img.jpg');
//print_r($create_website);


//$update_budget = $budget->update_budget(433, 44,2,'15000', '10000', '5000');
//print_r($update_budget);

//$delete_guest = $guestmanager->delete_guest(12);
///print_r($delete_guest);

/*$today = strtotime('today');
//$now = date('Y F d',$today);
//echo $now;

$duedate = '01/24/2021' ;


if($today > strtotime($duedate)){ echo "task is due"; }else{ echo "Task not due";};  */

//$task_due = $todolist->update_task_due(215);
//print_r($task_due);

//$status_update = $todolist->status_update(214, 44, "complete");
//print_r($status_update);

//$pending_status = $todolist->pending_status_update(177, 44);
//print_r($pending_status);

//$delete_todo_item = $todolist->delete_todo_item(60, 44);
//print_r($delete_todo_item);

//$tasks = $todolist->loop_startdate(44);
//print_r($tasks);


//$status_update = $todolist->status_update('pending', 59, 44);
//print_r($status_update);
//$dispaly_budgetmodal = $budget->displaybudget_modal(211);
//print_r($dispaly_budgetmodal);
//$delete_budget_cat = $budget->delete_budget_category(5);
//print_r($delete_budget_cat);
//$delete_budget = $budget->delete_budget_item('399','1','44');
//print_r($delete_budget);


//$budget_total = $budget->budget_total(44);
//print_r($budget_total);
//$update_budget = $budget->update_budget(22, 44, 20000, 25000, 25000);
//print_r($update_budget);
//$estimate_total = $budget->estimate_total(2);
//print_r($estimate_total);

//$pending = $todolist->count_tasks(44);
//print_r($pending);

//$result = $budget->actual_total(44);
//print_r($result);

//$unique_cat_array = $budget->unique_cat_array(44);
//print_r($unique_cat_array);

//$group_category_id = $budget->group_category_id(44);
//print_r($group_category_id);

//$display_budgetcategory = $budget->display_budgetcategory(44);
//print_r($display_budgetcategory);


//$all_furniture = $mylisting->display_all_furniture();
//print_r($all_furniture);

//$all_tents = $mylisting->display_all_tents();
//print_r($all_tents);
//$edit_listing = $listing->edit_listing("", "", "facility", "price", "about", "fthf", "amenities", "facebook", "instagram", 98);
//print_r($edit_listing);

//$listing->edit_listing($listing_name, $tents, $facility, $price, $about, $services, $amenities, $facebook, $instagram, $listing_id);

//$add_listing = $listing->edit_listing("Chiavari chairs Kitale", "Clear Tents", "Wehave everything you need", "3000", "We are located in nairobi", "chivari chairs,Wimbeldon Chirs, Plastic Chairs,Round Table", "", "www.facebook.com/chiavari", "www.instgaram.com/chiavari",74);
//print_r($add_listing);

//$get_category = $budget->get_category();
//print_r($get_category);


//$add_listing = $listing->add_listing(58, "Chiavari chairs", 10, "", "", "", "chivari chairs,Wimbeldon Chirs, Plastic Chairs", "", "", "Kenya", "Nairobi", "Dagoretti", "we are open everyday. we have all sort of rentals", "Our chairs and tables are of the best quality and clean", "Tables & chairs", "www.facebook.com/chiavari", "www.instgaram.com/chiavari");
//print_r($add_listing);






//$display_reviews = $mylisting->display_review(40);
//print_r($display_reviews);

//$add_review = $mylisting->add_review(16, 44, "Tanisha", "tanisha@gmail.com", "My flowers were spectacular! My bouquet was divine and I am thrilled with ho", "4", "DSC_014");
//print_r($add_review);

//$group_favourites = $favs->group_favourite(44);
//print_r($group_favourites);

//$get_unique_cat_array = $mylisting->get_unique_cat_array(44);
//print_r($get_unique_cat_array);

//$display_allfavourites = $mylisting->display_allfavourites();
//print_r($display_allfavourites);

//$get_category_array = $mylisting->get_categories_array(44);
//print_r($get_category_array);

//$get_category = $mylisting->get_category_by_id("6");
//print_r($get_category);
//$myfavs = $mylisting->myfavs("44");
//print_r($myfavs);

//$get_fav_listing_id = $favs->get_fav_listing_id(120);
//print_r($get_fav_listing_id);


//$fav_deatuils = $mylisting->favs_listing_details(42);
//print_r($fav_deatuils);


//$display_fav_listing = $mylisting->display_favs_listing();
//print_r($display_fav_listing);


//$favourite = $favs->display_favourites(44);
//print_r($favourite);


//$favourites = $mylisting->favourites(44, 10,5);
//print_r($favourites);
//$result = $mylisting->display_request_pricing(38);
//print_r($result);


//$pricing = $mylisting->request_pricing(" ",59 , "Sarah Kwamboka", "sarah@gmail.com", "073456783493", "iam testing if i can request privcing. testiong my functions");
//print_r($pricing);

//$mycat = $category->single_suppliers_listing(27);
//print_r($mycat);

//$mycat = $category->display_category();
//print_r($mycat);

//$flowers = $mylisting->display_flowers_listing();
//print_r($flowers);


//$drsslist = $mylisting->display_dress_listing();
//print_r($drsslist);
//$couplelgin = $users->vendorLogin("tanisha@gmail.com", "qwerty");
//print_r($couplelgin);

// = $mylisting->single_cake_listing(38);
//print_r($result);

//$result = $mylisting->display_cake_listing();
//echo $result;

//$result = $mylisting->display_tents_listing(27);
//print_r($result);

//$result = $listing->display_listing(58);
//print_r($result);


//$result = $listing->venue_filter(2,"Hotel","Nairoi","");
//print_r($result);
//$result = $mylisting->add_review(10, 60, "Jojo Ericson ", "jojo@gmail.com", "We loved having them DJ our wedding! They knew exactly when to talk and just kept the music playing and EVERYONE had a great time! We had a few songs that didn't play from our must play, but we were ok with that since it seemed more like they were going with the vibe of the evening. No complaints from our end. Most importantly, as a theater-management person, I appreciated their knowledge, how professional and to the point they were with us. I'd hire them again!", "4", "3", "2", "5", "5");
//print_r($result);


//$image = $listing->add_image(59, "DSC_0149DSC_0150DSC_0151");
//print_r($image);

//$vprofile = $users->display_vprofile(58);
//print_r($vprofile);


//$result = $users->vendorSignup("Mary cakes", "mary@gmail.com", "qwerty", "ycv hfec fvqebvf", "Venue");
//print_r($result);

//$result = $budget->display_budgetcategory(44);
//echo $result;

//$result = $budget->delete_category(19);
//print_r($result);

//$add_budget = $budget->add_budget(44, 2, "Fruit Cake", "30000", "15000", "10000");
//print_r($add_budget);
//$result = $budget->pending(44, 19);
//print_r($result);

//$guests = $guestmanager->guest_invite("Yes", 2, 44);

//print_r($guests);


//$guests = $guestmanager->display_guests(44);

//print_r($guests);

//$user_id    = $security->sane_inputs("user_id", "POST");

//$cprofile = $couple_profile->display_wedinfo(49);

//$ctasks = $todolist->count_status(44);
//print_r($ctasks);

//$loopstart = $todolist->group_startdate(44);
//print_r($loopstart);

//$statusupdate = $todolist->status_update("completed", 53);
//print_r($statusupdate);
//$completedtasks = $todolist->completed_task(44);
//print_r($completedtasks);

//$pending_task = $todolist->pending_task(44);
//print_r($pending_task);

//$list =    $todolist->couple_todolist(44,"shopping","1week", "07/30/2020");
//echo $list;

//$result = $couple_profile->weddinginfo(44, "Sheila", "Sam", "Nakuru", "2020/04/21");
//print_r($result);


//$result = $todolist->status_display(44);
//print_r($result[1]);

//$result = $todolist->status_update("pending",44);
//print_r($result);

//$result = $budget->update_budget(29, 44, 60000, 50000, 30000, 20000);
//print_r($result);

//$result = $couple_profile->cProfile(58, "George", "072466754", "my name is sharon chebet kessio", "http://www.instgaram.com/sharon", "http://www.instgaram.com/sharon");
//print_r($result);       
//$result = $budget->displaybudget_modal(5);
//print_r($result);
//$result = $budget->pending_total(44);
//print_r($result);

//$result = $guest->add_guest(44, "Sharon Kessio", "Bride Family", "0724773603");
//print_r($result);




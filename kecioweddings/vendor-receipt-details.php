<?php 
if($_SESSION['user_session_exists'] === "TRUE"){
    
?>
<div class="body-content">
<div class="main-contaner">
                <div class="container">
                    <!-- Page Heading -->
                    <div class="section-title">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <div class="invoice-logo"><img src="assets/images/logo_dark.svg" alt=""></div>
                            <div class="invoice-number">
                                <h3>
                                    Receipt
                                    <span>February 11, 2020</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!-- Page Heading -->

                    <!-- My Invoice Section -->
                    <div class="card-shadow">
                        <div class="card-shadow-body">                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="invoice-detail-wrap">
                                        <div class="invoice-detail-head">
                                            <span>From:</span>
                                            Gerald A. Garcia
                                        </div>
                                        <address>
                                            2546 Penn Street<br>
                                            Sikeston, MO 63801<br>
                                            
                                            Email : <a href="mailto:info@gerald.com.pl" class="btn btn-link btn-link-primary text-lowercase p-0">info@gerald.com.pl</a><br>
                                            Phone : <a href="tel:+573-282-9117" class="btn btn-link btn-link-primary text-lowercase p-0">+573-282-9117</a>
                                        </address>
                                    </div>
                                </div>

                                <div class="col-md-6 border-left mt-4 mt-md-0 no-mobile">
                                    <div class="invoice-detail-wrap">
                                        <div class="invoice-detail-head">
                                            <span>To:</span>
                                            Symond Kelly
                                        </div>
                                        <address>
                                            Kapuzinerstr. 8 Bonn<br>
                                            
                                            Email : <a href="mailto:hiteshmahavar22@gmail.com" class="btn btn-link btn-link-primary text-lowercase p-0">hiteshmahavar22@gmail.com</a><br>
                                            Phone : <a href="tel:8888877373" class="btn btn-link btn-link-primary text-lowercase p-0">8888877373</a>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-shadow">
                        <div class="card-shadow-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Invoice Id</th>
                                            <th scope="col">Plan Name</th>
                                            <th scope="col">Payment Mode</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">#1</th>
                                            <td>PREMIUM</td>
                                            <td>PayPal</td>
                                            <td>1</td>
                                            <td>$30</td>
                                        </tr>
                                    </tbody>
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Subtotal</th>
                                            <th scope="col">Paypal Fee</th>
                                            <th scope="col">&nbsp;</th>
                                            <th scope="col">&nbsp;</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">$30.00</th>
                                            <td>$0.10</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><span class="txt-success">$30.10</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-shadow shadow-none bg-transparent">
                        <div class="text-center">
                            <a href="javascript:" class="btn btn-outline-success btn-rounded mx-2"><i class="fa fa-print"></i> Print Invoice</a>
                            <a href="javascript:" class="btn btn-outline-danger  btn-rounded mx-2"><i class="fa fa-envelope-o"></i> Mail Invoice</a>
                        </div>
                    </div>
                    <!-- My Invoice Section -->  
                </div>
            </div>
 </div>
<?php }else{include_once 'login.php';}?>
<!DOCTYPE html>
<html>

<head>
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>Reimbursement</title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


	<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

  <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<style>
.navbar-nav .nav-item-header:nth-of-type(7) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(7)::after {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    width: 3px;
    bottom: 0;
    content: "";
    background: var(--orange1);
}
</style>
</head>

<body>


<div class="wrapperContainer">
  <?php include 'headerNew.php'; ?>
	<div class="containers scrollY" id="containers" >
		<div class="timesheetContainer ">
            <div class="d-flex pageHead heading-bar">
                <span class="events_title">Reimbursement</span>
                <span class="sort-by rightHeader">
                    <a href="javascript:void(0)" id="addReimbursement" class="btn btn-default btn-small btnOrange pull-right">
                        <span class="material-icons-outlined">add</span> Add Reimbursement
                    </a>
                </span>
            </div>

            <div class="table-div pageTableDiv">
                <table class="table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Employee Name</th>
                            <th>Date</th>
                            <th>Total Claim</th>
                            <th>Total Reimbursement</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
            
                    <tbody id="tbody">							 
                        <tr>
                            <td>1</td>
                            <td>Arpita Saxena</td>
                            <td>Sep 06,2021</td>
                            <td>$106</td>
                            <td>$126.36</td>
                            <td><span class="labelStatus approve">Approved</span></td>
                            <td><span id="actionDetails" class="material-icons-outlined">chevron_right</span></td>
                        </tr>							 
                        <tr>
                            <td>1</td>
                            <td>Arpita Saxena</td>
                            <td>Sep 06,2021</td>
                            <td>$106</td>
                            <td>$126.36</td>
                            <td><span class="labelStatus notapprove">Not Approved</span></td>
                            <td><span class="material-icons-outlined">chevron_right</span></td>
                        </tr>
                    </tbody>
                </table>			
            </div>
        </div>
    </div>
</div>


    <div id="myModal" class="templateModal modalNew" style="display: none;">
        <div class="modal-dialog mw-75">
        <!-- Modal content -->
            <div class="template-modal-content modal-content NewFormDesign">
                <div class="modal-header">
                    <h3 class="modal-title">Reimbursement Deatils</h3>
                </div>
                <div class="modal-body container">
                    <section class="tab-buttons">
						<div class="tab-buttons-div">
                            <span class="nav-button tab1 arrow"><span>Suppliar Details</span></span>
                            <span class="nav-button tab2"><span>Location Details</span></span>
                            <span class="hover" style="width:50%;"></span>
                        </div>
                    </section>

                    <section class="tab1Cont" style="display: block;">
                        <div class="reimbursementTemplateTable">
                            <table class="template_table">
                                <thead>
                                    <tr class="template_header_row">
                                        <th >Suppliar Name</th>
                                        <th >Description</th>
                                        <th >Expense Category</th>
                                        <th >Center/General</th>
                                        <th style="text-align: center;" >Reciept Attached</th>
                                        <th >Amount</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody class="template_tbody">
                                    <tr class="template_row">
                                        <td>Ishita Ray</td>
                                        <td>Lorem ipsum dolor sit amet</td>
                                        <td>Category Name</td>
                                        <td>Greenvale</td>
                                        <td style="text-align: center;"><a href="#"><img src="<?php echo base_url("assets/images/file1.png") ?>"></a></td>
                                        <td>$15.08</td>
                                        <td>
                                            <div class="actionIcon">
                                                <span class="doneIcon material-icons-outlined">done</span>
                                                <span class="closeIcon material-icons-outlined">close</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <section class="tab2Cont" style="display: none;">

                    <div class="reimbursementTemplateTable">
                        <table class="template_table">
                            <thead>
                                <tr class="template_header_row">
                                    <th>Location From</th>
                                    <th>Location to</th>
                                    <th>Date of Travel</th>
                                    <th>Center/General</th>
                                    <th>Kms</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="template_tbody">
                                <tr class="template_row">
                                    <td>Home</td>
                                    <td>Greenvale</td>
                                    <td>Jul 07, 2021</td>
                                    <td>Greenvale</td>
                                    <td>25Kms</td>
                                    <td>$15.08</td>
                                    <td>
                                        <div class="actionIcon">
                                            <span class="doneIcon material-icons-outlined">done</span>
                                            <span class="closeIcon material-icons-outlined">close</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    </section>
                    
                    <div class="modal-footer">
                        <input type="button" name="cancel" value="Cancel" class="close button btn btn-default btn-small">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal2" class="templateModal modalNew" style="display: none;">
        <div class="modal-dialog mw-75">
        <!-- Modal content -->
            <div class="template-modal-content modal-content NewFormDesign">
                <div class="modal-header">
                    <h3 class="modal-title">Add Reimbursement</h3>
                </div>
                <div class="modal-body container">
                   
                <div class="row">
                    <div class="col-md-4">
                        <div class="input_box form-floating">
                            <input type="text" class="form-control" name="emp_name" id="emp_name" placeholder="Employee Name" value="" required="">
                            <label for="emp_name">Employee Name</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input_box form-floating">
                            <input type="text" class="form-control" name="emp_name" id="emp_date" placeholder="Employee Date" value="" required="">
                            <label for="emp_date">Employee Date</label>
                        </div>
                    </div>
                </div>

                <div class="popHead">
                    <h3>Suppliar Details</h3>
                    <a href="javascript:void(0)" id="addSuppliar" class="btn btn-default btn-small btnBlue pull-right">
                        <span class="material-icons-outlined">add</span> Add Suppliar
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input_box form-floating">
                            <input type="text" class="form-control" name="sup_name" id="sup_name" placeholder="Suppliar Name" value="" required="">
                            <label for="sup_name">Suppliar Name</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-control" name="exp_category" id="exp_category">
                                <option value="Y">Lorem</option>
                                <option value="N">Ipsum</option>
                            </select>
                            <label for="exp_category">Expence Category</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-control" name="center_name" id="center_name">
                                <option value="Y">Lorem</option>
                                <option value="N">Ipsum</option>
                            </select>
                            <label for="center_name">Center Name</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <span class="d-block inputfile-box">
                            <input id="profileImage" class="profileImage inputfile" type="FILE" name="profileImage" onchange="uploadFile(this)">
                            <label for="profileImage">
                                <span id="file-name" class="file-box"></span>
                                <span class="file-button">
                                    <span class="material-icons-outlined">publish</span>
                                    Select File
                                </span>
                            </label>
                        </span>
                    </div>
                    <div class="col-md-4">
                        <div class="input_box form-floating">
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="" required="">
                            <label for="amount">Amount</label>
                        </div>
                    </div>
                </div>

                
                <div class="popHead">
                    <h3>Location Details</h3>
                    <a href="javascript:void(0)" id="addSuppliar" class="btn btn-default btn-small btnBlue pull-right">
                        <span class="material-icons-outlined">add</span> Add Location
                    </a>
                </div>

                
                <div class="row">
                        <div class="col-md-4">
                            <div class="input_box form-floating">
                                <input type="text" class="form-control" name="locationfrom" id="locationfrom" placeholder="Location From" value="" required="">
                                <label for="locationfrom">Location From</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_box form-floating">
                                <input type="text" class="form-control" name="locationto" id="locationto" placeholder="Location To" value="" required="">
                                <label for="locationto">Location To</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-control" name="center_name" id="center_name">
                                    <option value="Y">Lorem</option>
                                    <option value="N">Ipsum</option>
                                </select>
                                <label for="center_name">Center Name</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_box form-floating">
                                <input type="text" class="form-control" name="traveldate" id="traveldate" placeholder="Date of Travel" value="" required="">
                                <label for="traveldate">Date of Travel</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_box form-floating">
                                <input type="text" class="form-control" name="distance" id="distance" placeholder="Distance(Kms)" value="" required="">
                                <label for="distance">Distance(Kms)</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_box form-floating">
                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="" required="">
                                <label for="amount">Amount</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <input type="submit" name="roster-submit" id="roster-submit" class="button btn btn-default btn-small btnOrange" value="Save">
                        <input type="button" name="cancel" value="Cancel" class="close2 button btn btn-default btn-small">	
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        var modal = document.getElementById("myModal");
        var modal2 = document.getElementById("myModal2");

        $(document).on('click','#actionDetails',function(){
            modal.style.display = "block";
        });
        
        $(document).on('click','.close',function(){
            modal.style.display = "none";
        });

        $(document).on('click','#addReimbursement',function(){
            modal2.style.display = "block";
        });
        $(document).on('click','.close2',function(){
            modal2.style.display = "none";
        });

        $('.tab1').click(function(){
			$('.tab1 ').addClass('arrow');
        	$('.tab2 ').removeClass('arrow');
            $(".tab1Cont").show();
            $(".tab2Cont").hide();
        });
        $('.tab2').click(function(){
			$('.tab1 ').removeClass('arrow');
        	$('.tab2 ').addClass('arrow');
            $(".tab1Cont").hide();
            $(".tab2Cont").show();
        });


    </script>

</body>

</html>
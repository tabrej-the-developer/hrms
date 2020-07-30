<?php 
	$colorcodes = ['#0041C2','#254117','#FBB117','#C35817','#E42217','#9F000F','#7D0552'];
 ?>
<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header'); ?>
<title>Leaves</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<!-- Draggable plugin -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style type="text/css">
	*{
    font-family: 'Open Sans', sans-serif;
	}
	body{
		background: rgb(243, 244, 247) !important;

	}
    thead{
      background:#8D91AA;
    }
    tr:nth-child(even){
      background:#D2D0D0 !important;
    }
    tr:nth-child(odd){

      background: #F1EEEE !important;
    }
    td:nth-child(8){
      background: white
    }
    th{
      background: #8D91AA;
      color: #F3F4F7;
    }
	.containers{
		background:	rgb(243, 244, 247);
		height: calc(100vh);
	}
  
		.leave-heading{
			font-size: 1.75rem;
			font-weight: bolder
		}
        .card-header {
            padding: 0.2rem 1.25rem;
            /* margin-bottom: 0; */
            background-color: transparent;
            border-bottom: 0px;
        }
        .card{
        	background-color: transparent;
          padding: 0 !important
        }
        .sort-by{
        	margin:0 0 0 2rem !important;
        }
        .card-body {
            padding: 0;
            height:80vh;
        }
        
        p {
            margin-top: 0;
            margin-bottom: 10px;
        }
        .balance-tile{
        	padding: 0 2rem !important;
        	position: relative;
        }
        .balance-tile-div{
        	height: 8rem;
		    background: white;
		    font-weight: bolder;
		    position: relative;
        }
        .leave-name{
        	width: 100%;
			display: inline-block;
        	text-align: center;
        }
        .leave-balance{
        	font-size:2rem;
        	padding-top: 1rem;
        }
        .leave-balance:before{
        	content: 'Hrs : ';
        	color: black;
        	font-size:1rem;
        }

        .cardContainer {
				  display: flex;
				  justify-content: center;
				}
				.cardItem {
				  text-align: center;
				  transition: all 500ms ease-in-out;
				}
				.cardItem:hover {
					  cursor: pointer;
					  box-shadow: 0px 12px 30px 0px rgba(0, 0, 0, 0.2);
					  transition: all 800ms cubic-bezier(0.19, 1, 0.22, 1);
				}
        
        .card {
            border-radius: 0px;
            padding-top: 15px;
            padding-bottom: 15px;
			border:none;
			box-shadow: none;
        }
        
        .flex-wrap {
            margin-bottom: -35px;
        }

        .nav-tabs{
        	border-bottom: none;
        }
        .heading-leave-approval{
        	display: flex;
        	justify-content: flex-start;
        	color: black;
        	font-weight: bolder;
        	font-size: 1.5rem
        }
        
        div.dataTables_wrapper div.dataTables_paginate {
            margin-top: -25px;
        }
        
        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #5D78FF;
            border-color: #5D78FF;
			
        }
		.btn.focus, .btn:focus {
			outline: 0;
			box-shadow: none;
		}
		.btn-group-sm>.btn, .btn-sm {
			padding: .25rem .5rem;
			font-size: .875rem;
			line-height: 1.5;
			border-radius: 1.2rem;
			border: 1px solid #ccc;
		}
		#example_filter input {
		  border-radius: 1.2rem;
		}
		.border-shadow{
			    box-shadow: 0;

		}
		.no-gutters > div{
			display: inline-block !important;
		}
		.modal-header {
			border-bottom:none;
			border-top-left-radius:0;
			border-top-right-radius:0;
			background-color: #307bd3;
			color: #fff;
      display: flex;
    justify-content: center;
		}
		.modal-content {
			border-radius:0;	
		}
	.row{
		margin-right: 0px;
   		margin-left: 0px;
	}
		
		/* tabs */


.tab-content{
    line-height: 25px;
    padding:0 !important;
}

		/* tabs end */
		
		
/* Toggle */
.switchToggle input[type=checkbox]{height: 0; width: 0; visibility: hidden; position: absolute; }
.switchToggle label {cursor: pointer; text-indent: -9999px; width: 70px; max-width: 70px; height: 30px; background: #d1d1d1; display: block; border-radius: 100px; position: relative; }
.switchToggle label:after {content: ''; position: absolute; top: 2px; left: 2px; width: 26px; height: 26px; background: #fff; border-radius: 90px; transition: 0.3s; }
.switchToggle input:checked + label, .switchToggle input:checked + input + label  {background: #4caf50a6; }
.switchToggle input + label:before, .switchToggle input + input + label:before {content: 'No'; position: absolute; top: 1px; left: 35px; width: 26px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
.switchToggle input:checked + label:before, .switchToggle input:checked + input + label:before {content: 'Yes'; position: absolute; top: 1px; left: 10px; width: 26px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
.switchToggle input:checked + label:after, .switchToggle input:checked + input + label:after {left: calc(100% - 2px); transform: translateX(-100%); }
.switchToggle label:active:after {width: 60px; } 
.toggle-switchArea { margin: 10px 0 10px 0; }
/* Toggle end */
		/*leaves balance bar*/
.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.chat_img {
  float: left;
  width: 11%;
}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}

.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}
img{ max-width:140%;}

.vdivide{
	background: transparent;
}
.row.vdivide [class*='col-']:not(:last-child):after {
  background: #e0e0e0;
  width: 1px;
  content: "";
  display:block;
  position: absolute;
  top:0;
  bottom: 0;
  right: 0;
  min-height: 70px;
}
/*leaves balance bar end*/
.dropdown-toggle::after {
            content: none;
            display: none;
        }

 /* Data Tables */
    select{
  background: rgb(164, 217, 214);
  font-weight: 700;
  color: rgb(23, 29, 75);
  border-radius: 20px;
    padding: 5px;
    padding-left: 20px;
    border: 2px solid #e9e9e9 !important;
    font-size: 1rem !important;
    }
    select:hover{
      cursor: pointer;
    }
.dataTables_wrapper {
	height:100%;
	overflow-y: hidden;
	background: white;
	/*box-shadow: 0 0 4px 1px rgba(0,0,0,0.1);*/
}
table.dataTable tbody th, table.dataTable tbody td{
	padding:1rem;
	border-bottom: none;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 1rem;
    border-bottom: none;
}
table.dataTable.no-footer{
	border-bottom: none
}
table.dataTable{
	margin-top: 0 !important;
	margin-bottom: 0 !important;
}
	.dataTables_paginate span .paginate_button{
		background:none !important;
		border:none !important;
		border-color: transparent;
	}
	.dataTables_paginate{
		position: absolute;
		bottom: 0;
		right: 0
	}
 /* Data Tables */
/*corousel*/	
.carousel-control-next, .carousel-control-prev {
   
    width: 2%;
   
}
.carousel-control-next-icon, .carousel-control-prev-icon {
    height: 40px;
    background-color: #ccc;
}
	
/*corousel end*/		
		

   .modal-logout {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        visibility: hidden;
        transform: scale(1.1);
        transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
        text-align: center;
    }
    .modal-content-logout {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 1rem 1.5rem;
        width: 50%;
        border-radius: 0.5rem;
    }
    .show-modal {
        opacity: 1;
        visibility: visible;
        transform: scale(1.0);
        transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
    }
 	.buttonn{
		background-color: #9E9E9E;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 2px;
       float:none; 
     font-size: 1rem; 
     font-weight: bolder; 
     line-height: inherit; 
     text-shadow: none; 
     opacity: 1;
	}
	.close{
		float: none; 
	    font-size: inherit; 
	    font-weight: inherit; 
	    line-height: inherit; 
	    color: inherit; 
	    text-shadow: inherit; 
	    opacity: inherit; 
	    border-radius:0 !important;
	    background:#6c757d !important;
	    padding: .375rem .75rem !important;
	    color: white !important;
	}


	.confirm_button{
		background-color: #9E9E9E;
  	border: none;
  	color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 40px;
  	text-align: center;
  	text-decoration: none;
  	display: inline-block;
  	margin: 2px;
  	float:none; 
  	font-size: 1rem; 
  	font-weight: bolder; 
  	line-height: inherit; 
  	text-shadow: none; 
  	opacity: 1;
    width: 150px;
    border-radius: 20px;
	}
	.close:hover{
		background:#9E9E9E;
	}   
/*	.card-header .row{
		display: none;
	}*/
	#nav-contact1{
		box-shadow: 0 0 5px 5px rgba(0,0,0,0.1);
	}


	/*-------------------------
		Confirm Box Css
	--------------------------*/

#modal_confirm__container {
  position: fixed;
  display: table;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  transform: scale(0);
  z-index: 1;
}
#modal_confirm__container.five {
  transform: scale(1);
}
#modal_confirm__container.five .modal_confirm__background {
  background: rgba(0, 0, 0, 0);
  animation: fadeIn 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#modal_confirm__container.five .modal_confirm__background .modal_confirm_ {
  transform: translateX(-1500px);
  animation: roadRunnerIn 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#modal_confirm__container.five.out {
  animation: quickScaleDown 0s .5s linear forwards;
}
#modal_confirm__container.five.out .modal_confirm__background {
  animation: fadeOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#modal_confirm__container.five.out .modal_confirm__background .modal_confirm_ {
  animation: roadRunnerOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
}
#modal_confirm__container .modal_confirm__background {
  display: table-cell;
  background: rgba(0, 0, 0, 0.8);
  text-align: center;
  vertical-align: middle;
}
#modal_confirm__container .modal_confirm__background .modal_confirm_ {
  background: white;
  min-height: 50%;
  width: 50%;
  padding: 50px;
  display: inline-block;
  border-radius: 3px;
  font-weight: 300;
  position: relative;
}
#modal_confirm__container .modal_confirm__background .modal_confirm_ h2 {
  font-size: 25px;
  line-height: 25px;
  margin-bottom: 15px;
}
#modal_confirm__container .modal_confirm__background .modal_confirm_ p {
  font-size: 18px;
  line-height: 22px;
}
.modal_icon{
  width: 80px;
  height: 80px;
  cursor: move;
}
.confirm__span textarea{
      width: 300px;
    border-radius: 10px;
    border: 1px solid rgb(23, 29, 75,0.6);
    box-shadow: none;
    text-shadow: none;
    padding: 3px;
}
.confirm__span textarea::placeholder{
  color: rgb(23, 29, 75,0.6);
  text-align: center;
}
.confirm_button:disabled{
  cursor:not-allowed;
}
.confirm_save{
  background: #A4D9D6 !important;
  border: 1px solid white;
  color: #171D4B !important;
  font-weight: 700 !important;
  font: 65 Medium 18px/22px Avenir LT Std !important;
}
.confirm_cancel{
  background: #D2D0D0 !important;
  border: 1px solid white;
  color: #171D4B !important;
  font-weight: 700 !important;
  font: 65 Medium 18px/22px Avenir LT Std !important;
}
.confirm_span{
  color: rgba(23, 29, 75,0.6);
}
.confirm_buttons{
  justify-content: space-evenly !important;
}

/*  .status-appr{
    font-size: 0.9rem;
    background: rgba(0,200,0,0.1)
  }*/
  .status-appr:before{
    content: ' ';
    background: url;
    background-size: 20px;
    padding: 20px;
    position: absolute;
    background-repeat: no-repeat;
    margin-left: -23px
  }
  .immg{
    height:1.3rem;
    padding-right:0.5rem;
  }


 /* ::before{
    content: ' ';
    padding: 3px;
    height: 4rem;
    border: 3px;
    background: red;
    position: absolute;
    margin-left: -130px;
    margin-top: -20px;
  };*/

/*confirm modal end */


@keyframes unfoldIn {
  0% {
    transform: scaleY(0.005) scaleX(0);
  }
  50% {
    transform: scaleY(0.005) scaleX(1);
  }
  100% {
    transform: scaleY(1) scaleX(1);
  }
}
@keyframes fadeIn {
  0% {
    background: rgba(0, 0, 0, 0);
  }
  100% {
    background: rgba(0, 0, 0, 0.7);
  }
}
@keyframes fadeOut {
  0% {
    background: rgba(0, 0, 0, 0.7);
  }
  100% {
    background: rgba(0, 0, 0, 0);
  }
}
@keyframes scaleForward {
  0% {
    transform: scale(0.85);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes quickScaleDown {
  0% {
    transform: scale(1);
  }
  99.9% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes roadRunnerIn {
  0% {
    transform: translateX(-1500px) skewX(30deg) scaleX(1.3);
  }
  70% {
    transform: translateX(30px) skewX(0deg) scaleX(0.9);
  }
  100% {
    transform: translateX(0px) skewX(0deg) scaleX(1);
  }
}
@keyframes roadRunnerOut {
  0% {
    transform: translateX(0px) skewX(0deg) scaleX(1);
  }
  30% {
    transform: translateX(-30px) skewX(-5deg) scaleX(0.9);
  }
  100% {
    transform: translateX(1500px) skewX(30deg) scaleX(1.3);
  }
}

	/*-------------------------
		Confirm Box Css
	--------------------------*/

    @media only screen and (max-width:600px){
    	.col-sm-12{
    		padding-left: 0 !important;
    		padding-right: 0 !important;
    	}
    }

</style>
</head>
<body>
	<?php $permissions = json_decode($permissions); ?>
<div class="containers">

  <div class="row">
    <div class="col-sm-12 ">
		<div class="row d-flex pt-3">
	    <div class="ml-2"><span class="leave-heading">Leave Management</span></div>
	    	<div class="btn sort-by m-3 <?php if($this->session->userdata('UserType') == ADMIN) {echo "ml-auto"; }?>">
		<?php if($this->session->userdata('UserType') == SUPERADMIN){?> 
			<!-- 			<div class="filter-icon d-flex">
				<span class="">Sort&nbsp;by</span>
				<span class=""><img src="../assets/images/filter-icon.png" height="20px"></span>
			</div> -->

			<select class="center-list " id="center-list">
				<?php $centers = json_decode($centers);	
					for($i=0;$i<count($centers->centers);$i++){
				?>
			<option href="javascript:void(0)" class="center-class" id="<?php echo $centers->centers[$i]->centerid ?>" value="<?php echo $centers->centers[$i]->centerid; ?>"><?php echo $centers->centers[$i]->name?></option>
		<?php } ?>
		</select>	
				<?php } ?>
	</div>
	    </div>

<?php
	if($this->session->userdata('UserType') != SUPERADMIN){ ?>
				<div class="row mt-3">
                    <div class="col-md-12"><h6>Leave Balance</h6></div>
                </div>
				<div class="row shadow-sm mb-4  rounded vdivide">
                    
					<!-- <div class="col-sm-3">
					<div class="chat_people">
					<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
					<div class="chat_ib">
					  <h4>Admin Name(You)</h4>
					  <p>Emp45698</p>
					</div>
					</div>
					</div> -->
					
		<div class="col-sm-12">	
			<div id="recipeCarousel" class="carousel slide w-100" data-ride="">
        <div class="carousel-inner w-100" role="listbox">
        	<?php
        		// print_r($balance);
        		$balance = json_decode($balance);
        		// var_dump($balance);
            if(count($balance->balance)==0){
        		for($i=0;$i<count($balance->balance);$i+=3){ ?>
            <div class="carousel-item row no-gutters  <?php if($i == 0) echo 'active';?>">
        	<?php 
        		$var = 0;
        		while($var < 3){ 
        			if($var+$i < count($balance->balance)){
    			?>
        <div class="col-md-3 balance-tile cardContainer">
         	<div class="balance-tile-div cardItem">
				
				<div class="leave-balance" style="color:<?php echo $colorcodes[rand(0,6)];?>"><?php echo sprintf('%.2f',$balance->balance[$i + $var]->leavesRemaining);?></div>
				<div class="leave-name" ><?php echo $balance->balance[$i + $var]->leaveName;?></div>
			</div>
		</div> 
			<?php 
				}	
				$var++;
			}?>
            </div>
        	<?php } }?>

        </div>
        <!-- <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a> -->
        <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    		</div>

					
					
                </div>
                </div>
<?php }?>

                 <nav>
                    <div class="nav  nav-fill" id="nav-tab" >

	              <?php
	              if((isset($permissions->permissions) ? $permissions->permissions->editRosterYN : "N") == "N"){ ?>
                      <a class="nav-item nav-link heading-leave-approval" >Leave Approvals</a>
                  <?php }?>
                     
                  	<!-- <a class="nav-item nav-link <?php ?>" id="nav-contact-tab1" data-toggle="tab" href="#nav-contact1" role="tab" aria-controls="nav-contact" aria-selected="false">My Leave Requests</a> -->
					  

                     
                    </div>
                  </nav>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
          	<?php
          	if((isset($permissions->permissions) ? $permissions->permissions->editLeaveTypeYN : "N") == "N"){ ?>
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
	              	<div class="card">
	                <div class="card-header">
					<div class="row">
	                </div>
	                </div>

	                <div class="card-body">
	                    <table class="table table-striped table-borderless table-hover border-shadow" id="example1" style="width:100%;">
	                        <thead>
	                            <tr class="text-muted">
	                            <th>Name</th>
	                            <th>Role</th>
	                            <th>Start Date </th>
	                            <th>End Date</th>
	                            <th>Leave Type</th>
	                            <th>Reason</th>
	                            <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	<?php
	                        	// print_r($leaveRequests);
	                        		$leaveRequests = json_decode($leaveRequests);
	                        		foreach ($leaveRequests->leaves as $leave) { 

                        			?>
									<tr>
										<td><?php echo $leave->name;?></td>
										<td><?php echo $leave->title;?></td>
										<td>
											<?php 
												$date = date_create($leave->startDate);
												echo date_format($date,"d/m/Y");
											?>
										</td>
										<td>
											<?php 
												$date = date_create($leave->endDate);
												echo date_format($date,"d/m/Y");
											?>
										</td>
										<td><?php echo $leave->leaveTypeName;?></td>
										<td>
										<div class="dropdown">
		                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                                        <i class="far fa-file-alt"></i>
		                                    </button>
		                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
		                                        <p><?php echo $leave->notes;?></p>
		                                    </div>
		                                </div>
										</td>
										<td class="d-flex justify-content-around">
										<?php 
							if($leave->userid == $this->session->userdata('LoginId')){
								echo $leave->status;
							}else{
											if($leave->status == "Applied"){ 

												?>
												<div onclick="updateLeaveApp('<?php echo $leave->id;?>','2')" class="pr-1">
													<img src="<?php echo base_url("assets/images/accept.png"); ?>" style="max-width:1.3rem;cursor: pointer" />
												</div>
												<div onclick="updateLeaveApp('<?php echo $leave->id;?>','3')" class="pl-1">
													<img src="<?php echo base_url("assets/images/deny.png"); ?>"  style="max-width:1.3rem;cursor: pointer">
												</div>
										<?php }
											else{
												$color = $leave->status == "Approved" ? '#4CAF50' : '#F44336'; 
                        $img = $leave->status == "Approved" ? 'accept' : 'deny'; ?>
												<span style="color: <?php echo $color;?>;">
													<span><img src="<?php echo base_url('assets/images/'.$img.'.png'); ?>"></span><?php echo $leave->status;?>
												</span>
												<?php
											}}
										?>
										</td>
									</tr>
								<?php }?>
								
	                        </tbody>
	                    </table>

	                </div>

	            	</div>
	      		</div>
	      	<?php }?>

              
				  <div class="tab-pane fade <?php if((isset($permissions->permissions) ? $permissions->permissions->editLeaveTypeYN : "N") == "Y") echo 'show active';?>" id="nav-contact1" role="tabpanel" aria-labelledby="nav-home-tab">
	                  	<div class="card">
			                <div class="card-header">
							<div class="row">
			                    <div class="col-md-6"></div>
								<div class="col-md-6 text-right">
									<?php 
									if($this->session->userdata('UserType') != SUPERADMIN){ ?>
										<button type="button" name="apply_button" id="apply_button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus-circle"></i> Apply Leave</button>
									<?php }?>
								</div>
			                </div>
			                </div>
			                <div class="card-body">
			                    <table class="table table-striped table-borderless table-hover border-shadow" id="example3" style="width:100%;">
			                        <thead>
			                            <tr class="text-muted">
	                            	<?php
	                            		//if($this->session->userdata('UserType') == SUPERADMIN ){ ?>
			                            <th>Name</th>
			                            <th>Role</th>
			                        <?php // }?>
			                            <th>Leave Type</th>
                                  <th>Applied Date</th>
			                            <th>Start Date</th>
			                            <th>End Date </th>
			                            <th>Reason</th>
			                            <th>Status</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        	<?php 
                                $leaves = json_decode($leaves);
			                        	if(isset($leaves) && count($leaves->leaves)>0){
			                        	
			                        	foreach ($leaves->leaves as $l) { ?>
										<tr>
	                            		<?php
	                if((isset($permissions->permissions) ? $permissions->permissions->editLeaveTypeYN : "N") == "Y"){ ?>
											<td><?php  echo $l->name;?></td>
								<?php if($l->title != "Centre Manager"){ ?>
											<!-- <td><?php // echo $l->title;?></td> -->
			                       		<?php } else {echo "<td>--</td>";} }?>
											<td><?php echo isset($l->leaveTypeSlug) ? $l->leaveTypeSlug : "" ;?></td>
                      <td ><?php
                        $date = date_create($l->appliedDate);
                        echo date_format($date,"d/m/Y");?></td>
											<td><?php
												$date = date_create($l->startDate);
												echo date_format($date,"d/m/Y");?></td>
											<td><?php
												$date = date_create($l->endDate);
												echo date_format($date,"d/m/Y");?></td>
											<td>
											<div class="dropdown">
			                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                                        <i class="far fa-file-alt"></i>
			                                    </button>
			                                    <div class="dropdown-menu dropdown-menu-right p-3 " aria-labelledby="gedf-drop1">
			                                        <p><?php echo $l->notes;?></p>
			                                    </div>
			                                </div>
											</td>
												<?php
													$color = '#F44336';
													if($l->status == "Applied") $color = '#9E9E9E';
													else if($l->status == "Approved") $color = '#4CAF50';
												?>
											<td class="d-flex justify-content-center span__">
										<?php 
							if($l->userid == $this->session->userdata('LoginId')){
								echo $l->status;
							}else{
											if($l->status == "Applied"){ 

												?>
												<div onclick="updateLeaveApp('<?php echo $l->id;?>','2')" class="pr-3">
													<img src="<?php echo base_url("assets/images/accept.png"); ?>" style="max-width:1.3rem;cursor: pointer" />
												</div>
												<div onclick="updateLeaveApp('<?php echo $l->id;?>','3')" class="pl-3">
													<img src="<?php echo base_url("assets/images/deny.png"); ?>"  style="max-width:1.3rem;cursor: pointer">
												</div>
										<?php }
											else{
												$color = $l->status == "Approved" ? '#4CAF50' : '#F44336'; 
                        $sta = $l->status == "Approved" ? 'appr' : 'reje'; 
                        $img = $l->status == "Approved" ? 'accept' : 'deny'; ?>
												<span style="color: <?php echo $color;?>; " class="status-<?php echo $sta; ?>">
													<span><img src="<?php echo base_url('assets/images/'.$img.'.png'); ?>" class="immg"></span><?php echo $l->status;?>
												</span>
												<?php
											}}
										?>
										</td>
											
											
										</tr>
									<?php } }?>
										
			                        </tbody>
			                    </table>
			                </div>

			            </div>
			      </div>
              

                  </div>
                
                </div>
              </div>
        </div>

<div id="modal_confirm__container">
  <div class="modal_confirm__background">
    <div class="modal_confirm_">
      <h2 class="confirm__"></h2>
      <span class="d-flex justify-content-center p-3 confirm_span">Are you sure you want to&nbsp;<p class="confirm_p"></p>&nbsp;the leave?</span>
      <span class="confirm__span pb-3 d-block"></span>
      <span class="confirm_buttons d-flex justify-content-center p-2">
      	<input class="confirm_button confirm_cancel" type="button" value="Cancel" status="no">
      	<input class="confirm_button confirm_save" type="button" value="Confirm" status="yes">
      </span>
    </div>
  </div>
</div>    
 <!-- apply leave modal start here -->
            <div class="modal fade" id="applyModal">
                <div class="modal-dialog">
                    
					<form id="applyLeaveForm" action="<?php echo base_url().'leave/applyLeave';?>" method="POST">
					<div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >Apply Leave</h5>

                        </div>
                <div class="modal-body">						
					<div class="col-md-12 col-xl-12">
							<div class="row">
								<div class="col-md-12" style="padding-left:0">
									<div class="md-form">
									<label>Leave Type</label>
									<?php // $balance = json_decode($balance) ?>
										<select class="form-control" id="applyLeaveId" name="applyLeaveId" required >
										  <option value="" selected disabled>Select Leave Type </option>
											<?php 
												foreach ($balance->balance as $bal) { ?>
										  <option value="<?php echo $bal->leaveTypeId;?>"><?php echo $bal->leaveName;?></option>
											<?php }?>
										</select>
									</div>
								</div>
							</div>
							<span style="color: red" id="applyLeaveIdError"></span>
							<div class="row">
								<div class="col-md-6" style="padding-left:0">
									<div class="md-form">
										<label>Start Date</label>
										<div class="input-group date" id="datetimepicker12" data-target-input="nearest">
										<input type="text" name="applyLeaveFromDate" id="applyLeaveFromDate" class="form-control datetimepicker-input" data-target="#datetimepicker12"  />
										<div class="input-group-append" data-target="#datetimepicker12" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="md-form" style="padding-left:0">
									<label>End Date</label>
									<div class="input-group date" id="datetimepicker13" data-target-input="nearest">
                                    <input type="text" name="applyLeaveToDate" id="applyLeaveToDate" class="form-control datetimepicker-input" data-target="#datetimepicker13"  />
                                    <div class="input-group-append" data-target="#datetimepicker13" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
									</div>
									</div>
								</div>
							</div>
							<span style="color: red" id="applyLeaveDateError"></span>
								
									<div class="md-form">
										<label for="message">Leave Reason</label>
										<textarea id="applyLeaveNotes" name="applyLeaveNotes" class="form-control" placeholder="Reason" ></textarea>
										
									</div>	
						</div>
		<div class="row">
			<div class="col-md-12">
				<div class="md-form">
					<label>Total leave hours</label>
				<span class="row pl-5">
					<input type="number" name="total-leave-hours" id="total-leave-hours" step="0.5">
				</span>		
				</div>
			</div>
		</div>	
					</div>
					<div class="text-center mt-2 mb-4 f-flex">
						<span>
							<button class="btn btn-secondary rounded-0" type="button" onclick="applyLeave()">Apply</button>
						</span>
						<span>
							<button type="button" class="close btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
						</span>
					</div>
                    </div>
					</form>
                </div>
            </div>
            <!-- modal end here -->       

 <div class="modal-logout">
      <div class="modal-content-logout">
          <h3>You have been logged out!!</h3>
          <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>
          
      </div>
  </div>

</body>
<script type="text/javascript" language="javascript" >
	$('#datetimepicker12').datetimepicker({
                defaultDate: new Date(),
                format: 'DD-MM-YYYY'
    });
	$('#datetimepicker121').datetimepicker({
                defaultDate: new Date(),
                format: 'DD-MM-YYYY'
    });
    $('#datetimepicker13').datetimepicker({
                defaultDate: new Date(),
                //format: 'YYYY-MM-DD hh:mm:ss A'
                format: 'DD-MM-YYYY'
    });
	$('#datetimepicker131').datetimepicker({
                defaultDate: new Date(),
                //format: 'YYYY-MM-DD hh:mm:ss A'
                format: 'DD-MM-YYYY'
    });
	$('#apply_button').click(function(){
        
        $('#applyModal').modal('show');
    });
</script>
<script>
	$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});

	</script>


	<script type="text/javascript">
		var base_url = "<?php echo base_url();?>";

		function editLeaveType(leaveId){
			document.getElementById("leaveId").value = leaveId;
			document.getElementById("leaveName").value = document.getElementById(leaveId+"name").innerHTML;
			document.getElementById("leaveSlug").value = document.getElementById(leaveId+"slug").innerHTML;
			document.getElementById("switch").checked = document.getElementById(leaveId+"isPaidYN").innerHTML == "Y";
			document.getElementById("updateLeaveType").style.display = "block";
			document.getElementById("addLeaveType").style.display = "none";
			jQuery(function($) {
		        $("#userModal").modal('show');
		    });
		}

		function addLeaveType(){
			document.getElementById("leaveName").value =  "";
			document.getElementById("leaveSlug").value = "";
			document.getElementById("switch").checked = true;
			document.getElementById("updateLeaveType").style.display = "none";
			document.getElementById("addLeaveType").style.display = "block";
			jQuery(function($) {
		        $("#userModal").modal('show');
		    });
		}

		function addLeave(){
			var leaveName = document.getElementById("leaveName").value.trim();
			if(leaveName == ""){
				document.getElementById("leaveNameError").innerHTML = "Required field";
			}
			var leaveSlug = document.getElementById("leaveSlug").value.trim();
			if(leaveSlug == ""){
				document.getElementById("leaveSlugError").innerHTML = "Required field";
			}

			if(leaveName != "" && leaveSlug != ""){
				document.getElementById("leaveTypeForm").submit();
			}

		}

		function deleteLeave(){
			document.getElementById("leaveTypeForm").action = "<?php echo base_url();?>" + 'leave/deleteLeaveType';
			document.getElementById("leaveTypeForm").submit();
		}

		function updateLeaveApp(leaveId,status){
			console.log(leaveId+" "+status);
      //confirm box is a modal
      if(status == 3){
			confirmBox(`<img src="<?php echo base_url('assets/images/deny.png'); ?>" class="modal_icon">`,status);
        }
        else{
      confirmBox(`<img src="<?php echo base_url('assets/images/accept.png'); ?>" class="modal_icon">`,status);
        }
      //confirm status adds the attr
			confirmStatus('update_leave_no','update_leave_yes',status);
      //disables the button
      if(($('.reject_leave_text').length > 0) && status == 3) {
        $('.confirm_save').attr('disabled',true);
        $(document).on('keyup','.reject_leave_text',function(){
          if($('.reject_leave_text').val() !=""){
          $('.confirm_save').attr('disabled',false);
            }
            else{
              $('.confirm_save').attr('disabled',true);
            }
        })
      }

					$(document).on('click','.confirm_button',function(){
						console.log($(this).attr('button-attr'))
						if(($(this).attr('button-attr')) == 'update_leave_no' ){
            $('.confirm_p').empty();
            $('.confirm__').empty();
            $('.confirm__span').empty();
             $('.confirm_save').attr('disabled',false);
							console.log(leaveId+" "+status);
			  			removeAttribute()
						}

						if(($(this).attr('button-attr')) == 'update_leave_yes'  ){
					  removeAttribute()
					  console.log(leaveId+" "+status)
            
            if($('.reject_leave_text').length >0){
              let rejectLeaveText = $('.reject_leave_text').val();
              console.log(leaveId+""+status+""+rejectLeaveText)
						var data = 'leaveId='+leaveId+'&status='+status+'&message='+rejectLeaveText;
            }else{
              var data = 'leaveId='+leaveId+'&status='+status;
            }
				
					    var params = typeof data == 'string' ? data : Object.keys(data).map(
					        function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
					    ).join('&');
						var xhr = new XMLHttpRequest();
						xhr.open('POST', base_url+"leave/updateLeaveApp");
					    xhr.onreadystatechange = function() {
					        if (xhr.readyState>3 && xhr.status==200) { 
					        	location.reload();
					        }
					    };
					    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
					    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					    xhr.send(params);
							}
				})
		};

	function confirmStatus(attr1,attr2){
		  $(this).addClass('out');
		  let yesOrNo;
		  $('.confirm_button').eq(0).attr('button-attr',`${attr1}`);
		  $('.confirm_button').eq(1).attr('button-attr',`${attr2}`);
		  $('.confirm_button').on('click',function(){	
		  	if(($('.reject_leave_text').val() != null || $('.reject_leave_text').val() != "") && ($('.reject_leave_text').length > 0)){
          console.log($('.reject_leave_text').val() +""+$('.reject_leave_text').val() != null)
	  	  $('#modal_confirm__container').addClass('out');
			  $('body').removeClass('modal_confirm__active');
			  	}
        if($('.reject_leave_text').length == 0){
        $('#modal_confirm__container').addClass('out');
        $('body').removeClass('modal_confirm__active');
			  	}
		  })
		};
		function confirmBox(heading,status){
		  $('#modal_confirm__container').removeAttr('class').addClass('five');
		  let modalHeading = `${heading}`;
		  if(status == 3){
		  	$('.confirm_p').empty();
		  	$('.confirm__').empty();
		  	$('.confirm__span').empty();
		  let code = `<textarea type="text" class="reject_leave_text" placeholder="Please mention the reason" required></textarea>`;
			  $('.confirm__span').append(code);
		  	$('.confirm_p').html('<span style="color:rgba(226, 90, 83,0.6)">Reject</span>');
		  }
	  	if(status == 2){
		  	$('.confirm_p').empty();
		  	$('.confirm__').empty();
        $('.confirm__span').empty();
	  		$('.confirm_p').html('<span style="color:rgba(129, 178, 113,0.6)">Approve</span>');
	  	}
		  $('.confirm__').append(modalHeading);
		  $('body').addClass('modal_confirm__active');
		};	

		function removeAttribute(){
			  $('.confirm_button').eq(0).removeAttr('button-attr');
			  $('.confirm_button').eq(1).removeAttr('button-attr');
		}


		function applyLeave(){
			var leaveId = document.getElementById("applyLeaveId").value;
			var startDate = document.getElementById("applyLeaveFromDate").value;
			var endDate = document.getElementById("applyLeaveToDate").value;
			var hours = document.getElementById("total-leave-hours").value;
			var notes = document.getElementById("applyLeaveNotes").value;
			 (leaveId);
			console.log(startDate);
			console.log(endDate);
			console.log(notes);
			if(leaveId == ""){
				document.getElementById("applyLeaveIdError").innerHTML = "Select a leave type";
			}
			else{
				document.getElementById("applyLeaveIdError").innerHTML = "";
			}
			if(endDate < startDate){
				document.getElementById("applyLeaveDateError").innerHTML = "End date cannot be less than start date";
			}
			else{
				document.getElementById("applyLeaveDateError").innerHTML = "";
			}
			if(leaveId != "" && endDate>startDate){
				document.getElementById("applyLeaveForm").submit();
			}
			var url = window.location.origin+"/PN101/leave/applyLeave";
			$.ajax({
				url : url,
				data : {
					applyLeaveId : leaveId,
					applyLeaveFromDate : startDate,
					applyLeaveToDate : endDate,
					applyLeaveNotes : notes,
					total_leave_hours : hours 
				},
				success:function(){
					window.location.reload();
				}
			})
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('change','.center-list',function(){
			var val = $(this).val();
			if(val == null || val == ""){
				val=1;
			}
		var url = "<?php echo base_url();?>leave?center="+val;
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				$('tbody').html($(response).find('tbody').html());
					}
				});
			});
		})
	</script>
<script type="text/javascript">
	$(document).ready(()=>{
    $('.containers').css('paddingLeft',$('.side-nav').width());
});
</script>
<?php if( isset($error) != null){ ?>
	<script type="text/javascript">
		
   var modal = document.querySelector(".modal-logout");
   
    function toggleModal() {
        modal.classList.toggle("show-modal");
    }

$(document).ready(function(){
  	toggleModal();	
  })
	</script>
<?php }
else{

};
?>
<script type="text/javascript">
	  $(document).ready( function () {
		    $('table').dataTable({
		     pageLength:7,
		     ordering : false,
		     select: false,
		     searching : false
		    });
		} );
</script>
<script type="text/javascript">
	$(document).ready(function(){
			$('.dataTables_length').remove()
			$('.dataTables_info').remove()
			$('#ui-datepicker-div').hide()
			$('.table-div').css('maxWidth','100vw')
		})
</script>

<script type="text/javascript">
$( ".modal_confirm_" ).draggable();


</script>
</html>

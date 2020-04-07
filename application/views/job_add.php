<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header'); ?>
<title>Leaves</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <style>
  

        .card-header {
            padding: 0.2rem 1.25rem;
            /* margin-bottom: 0; */
            background-color: #ffffff;
            border-bottom: 0px;
        }
        
        .card-body {
            padding: 0rem 1.25rem;
        }
        
        p {
            margin-top: 0;
            margin-bottom: 10px;
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
			    box-shadow: 0 3px 10px rgba(0,0,0,.1);

		}
		.modal-header {
			border-bottom:none;
			border-top-left-radius:0;
			border-top-right-radius:0;
			background-color: #307bd3;
			color: #fff;
		}
		.modal-content {
			border-radius:0;	
		}
		
		
		/* tabs */
nav > div a.nav-item.nav-link,
nav > div a.nav-item.nav-link.active
{
  border: none;
    padding: 10px 15px;
    color:#212528;
    background:none;
    border-radius:0;
    font-size:15px;
    font-weight:500;
}
nav > div a.nav-item.nav-link.active:after
 {
  content: "";
  position: relative;
  bottom: -46px;
  left: -10%;
  border: 15px solid transparent;
  border-top-color: #ddd ;
}
.tab-content{
    line-height: 25px;
    padding:30px 25px;
}

nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
  border: none;
    background: none;
    color:#212528;
    border-radius:0;
    transition:background 0.20s linear;
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
		
/*corousol*/	
.carousel-control-next, .carousel-control-prev {
   
    width: 2%;
   
}
.carousel-control-next-icon, .carousel-control-prev-icon {
    height: 40px;
    background-color: #ccc;
}
	
/*corousol end*/		
		
</style>
</head>
<body>

    <div class="container">
    <!-- Large modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-header bg-primary">
      <h4>Add Job</h4>
     </div>
     <form action="<?php echo base_url();?>job/addJob" method="POST">
     <div class="modal-body">
           <div class="row">
           
           <table class="table table-borderless mt-2">
            <tr>
              <td class="text-center">Title</td>
              <td>
               <input type="text" name="jobTitle" class="form-control">
              </td>
            </tr>
            <tr>
              <td class="text-center">Department or Business Unit</td>
              <td>
               <input type="text" name="jobDepartment" class="form-control">
              </td>
            </tr>
            <tr>
              <td class="text-center">Internal Job code </td>
              <td>
               <input type="text" name="jobCode" class="form-control">
              </td>
            </tr>
            <tr>
              <td class="text-center">Employment Type</td>
              <td>
                   <select name="jobType" id="" class="form-control">
                             <option value="">Full-Time</option>
                             <option value="">Part-Time</option>
                             <option value="">Contract</option>
                   </select>
              </td>
            </tr>
            <tr>
              <td class="text-center">Minumm - Experience</td>
              <td>
               <select name="jobExperience" id="" class="form-control">
                   <option value="">Select Experience</option>
                   <option value="">0-2 years</option>
                   <option value="">2-4 year</option>
                   <option value="">4-8 year</option>
                   <option value="">10+ year</option>
                 
               </select>
              </td>
            </tr>
            <tr>
              <td class="text-center">Job Description</td>
              <td>
               <textarea name="jobDescription" id="" cols="1" rows="1" class="form-control"></textarea>
              </td>
            </tr>
            <tr  class="text-center">
              <td>Minimum Salary</td>
              <td>
                 <input type="text" name="jobMinSalary" class="form-control">
              </td>
            </tr>
            <tr class="text-center">
              <td>Maximum  Salary</td>
              <td>
                 <input type="text" name="jobMaxSalary" class="form-control">
              </td>
            </tr>
            <tr>
              <td class="text-center">Select country currency</td>
              <td>
                  <select name="countryCurrency" id="" class="form-control">
                    <option value="">USD</option>
                    <option value="">AUD</option>
                    <option value="">CAD</option>
                  </select>
              </td>
            </tr>
            <tr>
              <td class="text-center">Flatform</td>
              <td>
               <select name="flatform" id="" class="form-control">
                   <option value="">Indeed</option>
                   <option value="">Naukri</option>
                   <option value="">Jobfinder</option>
                   <option value="">Dummy portal</option>
               </select>
              </td>
            </tr>
            <tr>
              <td class="text-center">Expiry Date</td>
              <td>
               <input type="date" name="expiryDate" class="form-control">
              </td>
            </tr>
            
            
           
            <tr>
            <td class="text-center">Requirements</td>
            <td>
            <textarea name="requirements" id="" cols="1" rows="1" class="form-control"></textarea>
            </td>
            </tr>
           </table>
           </div>


     </div>
     <div class="modal-footer">
     <button type="submit" class="btn btn-primary">Add Job</button>
        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
     </div>
     </form>
     
    </div>
  </div>
</div>

<!-- Small modal -->

         <div class="row">
             <div class="col-md-5"></div>
            <div class="col-md-5"></div>
            <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Job</button>

            </div>
         </div>
         <table class="table table-bordered">
          <thead class="text-center">
          <tr>
          <td>Title</td>
          <td>ExpiryDate</td>
          <td>Platforms</td>
          <td>Edit</td>
          <td>Delete</td>
          </tr>
          </thead>
          <tr>
           <td>lorem</td>
           <td>lorem</td>
           <td>lorem</td>
           <td><button class="btn btn-primary">Edit</button></td>
           <td><button class="btn btn-danger">Delete</button></td>
           </tr>
           <tr>
           <td>lorem</td>
           <td>lorem</td>
           <td>lorem</td>
           <td><button class="btn btn-primary">Edit</button></td>
           <td><button class="btn btn-danger">Delete</button></td>
           </tr>
           <tr>
           <td>lorem</td>
           <td>lorem</td>
           <td>lorem</td>
           <td><button class="btn btn-primary">Edit</button></td>
           <td><button class="btn btn-danger">Delete</button></td>
           </tr>
           <tr>
           <td>lorem</td>
           <td>lorem</td>
           <td>lorem</td>
           <td><button class="btn btn-primary">Edit</button></td>
           <td><button class="btn btn-danger">Delete</button></td>
           </tr><tr>
           <td>lorem</td>
           <td>lorem</td>
           <td>lorem</td>
           <td><button class="btn btn-primary">Edit</button></td>
           <td><button class="btn btn-danger">Delete</button></td>
           </tr><tr>
           <td>lorem</td>
           <td>lorem</td>
           <td>lorem</td>
           <td><button class="btn btn-primary">Edit</button></td>
           <td><button class="btn btn-danger">Delete</button></td>
           </tr><tr>
           <td>lorem</td>
           <td>lorem</td>
           <td>lorem</td>
           <td><button class="btn btn-primary">Edit</button></td>
           <td><button class="btn btn-danger">Delete</button></td>
           </tr><tr>
           <td>lorem</td>
           <td>lorem</td>
           <td>lorem</td>
           <td><button class="btn btn-primary">Edit</button></td>
           <td><button class="btn btn-danger">Delete</button></td>
           </tr><tr>
           <td>lorem</td>
           <td>lorem</td>
           <td>lorem</td>
           <td><button class="btn btn-primary">Edit</button></td>
           <td><button class="btn btn-danger">Delete</button></td>
           </tr>
         </table>
    </div>       


</body>

</html>
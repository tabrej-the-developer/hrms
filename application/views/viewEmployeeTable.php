<!DOCTYPE html>
<html>
<head>
	<title>View Employee Table</title>
		<?php $this->load->view('header'); ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
    *{
  font-family: 'Open Sans', sans-serif;
    }
    body{
      background: #f2f2f2;
    }
    .xero_settings_title{
      font-size:1.75rem;
      color: #171D4B;
      font-weight: 700;
    }
      .heading{
      position: relative;
      padding-left: 2rem;
      width: 100%;
      height: 4rem;
    }
    .heading > span{
      display: flex;
      align-items: center;
    }
    #wrappers{
      padding:0;
      height:100vh;
    }
    .modal {
      display: none; 
      position: fixed;
      padding-top: 100px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0,0,0); 
      background-color: rgba(0,0,0,0.4); 
    }
    input[type="text"],input[type=time],select,#casualEmp_date,#filter{
      background: #ebebeb;
      border-radius: 5px;
      padding: 5px;
      border: 1px solid #D2D0D0 !important;
      border-radius: 20px;
    }
    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: auto;
      border: 1px solid #888;
      width: 80%;
    }

    /* The Close Button */
    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }
    .ent-btn{
      background: #ebebeb;
      border-radius: 5px;
      padding: 5px;
      border: 1px solid #D2D0D0 !important;
      border-radius: 20px;
      text-align: center;
    }   
    #wrappers{
      height:100vh;
      overflow-y: hidden;
    }
    #content-wrappers{
        padding: 0  2rem 2rem 3rem;
        height:calc(100vh - 4rem);
    }
    .content-wrappers-child{
        background: white;
        height: 100%;
        overflow-y: auto;
    }
    .row{
      display: block !important;
    }
    .table td, .table th {
        padding: 1rem !important;
        vertical-align: top;
         border-top: 0px !important; 
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 0 !important;
        text-align: left;
        padding-left: 4rem !important;
    }
    .submit-edit,.cancel-edit{

    }
    .submit-edit,
    .cancel-edit,
    .button,
    #create_new_entitlements,
    #cancel_new_entitlements{
      border: none;
      color: rgb(23, 29, 75);
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-weight: 700;
      margin: 2px;
      width:auto;
      border-radius: 20px;
      padding: 8px;
      background: rgb(164, 217, 214);
    }
    .fa-pencil-alt,.fa-trash-alt{
      color: #171D4B !important;
      font-weight: 700;
      font-style: normal;
    }
  .create-ent{
    display: flex;
    margin-right:2rem;
    justify-content: center;
    align-items: center;
  }
  .row{
    margin: 0 !important;
  }
  .table{
    font-size: 1rem;
    background-color: white;
    width: 100%;
    margin: auto;
    text-align: center;
   }
    thead tr{
      background-color: #8D91AA;
      color: #F3F4F7;
    }
    tr{
      border-top:  1px solid #d2d0d0;
      border-bottom: 1px solid #d2d0d0;
    }
    tbody tr{
      background: white !important;
    }
.button{
  /*position: absolute;*/
/*  right: 0;*/
    border: none !important;
    color: rgb(23, 29, 75) !important;
    text-align: center !important;
    text-decoration: none !important;
    display: inline-block;
    font-weight: 700 !important;
    margin: 2px !important;
    min-width:6rem !important;
    border-radius: 20px !important;
    padding: 4px 8px !important;
    background: rgb(164, 217, 214) !important;
    font-size: 1rem !important;
    margin-right:5px !important;
    justify-content: center !important;
    align-items: center;
    }
    .button a{
      text-decoration: none;
      font-size: 1rem;
      color: #171d4b;
    }
    .viewEmployeeTable{
      display: flex;
      justify-content: center;
    }
    .viewEmployeeTable_search {
      margin-left: 1rem;
    }
    #filter{
      padding-left:1rem;
    }
    .changeCenterModal{
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: transparent;
      display: none;
    }
    .changeCenterModal_title{
      display: block;
      width: 100%;
      text-align: center;
      font-size: 1rem;
    }
    .changeCenterModal_name{
      display: block;
      width: 100%;
      text-align: center;
      font-size: 1.5rem;
    }
    .changeCenterModalBody{
      position: absolute;
      left: 40%;
      top: 20%;
      z-index: 10;
      width: 30%;
      background: white;
      height: 60%;
      box-shadow: 0 0 0.1rem 0.1rem rgba(0,0,0,0.1);
    }
    .changeCenterModal_header{
      height: 20%;
      width: 100%;
      background-color: #8D91AA;
      color: #F3F4F7;
    }
    .changeCenterModal_centers{
      padding-left: 3rem;
    }
    .changeCenterModal_buttons{
      height: 20%;
      display: flex;
      justify-content: center;
      align-items: center;
      background: white;
    }
    .syncXeroEmployees{
      margin-right: 2rem !important;
    }
    #centerValue{
      background: rgb(164, 217, 214) !important;
      max-width: 12rem;
    }
    .viewEmployeeTable_row{
      text-align: left;
    }
    .viewEmployeeTable_row td{
      padding-left: 4rem !important;
    }
    .viewEmployeeTable_centerName_parent{
      cursor: pointer;
    }
    </style>
  </head>

  <body id="page-top"> 
<?php $permissions = json_decode($permissions);
      $centers = json_decode($centers);
      // print_r(json_encode($xeroTokens));
?>  
    <div id="wrappers">
      <span class="d-flex heading">
        <span>
          <a href="<?php echo base_url('settings');?>">
            <button class="btn back-button">
              <img src="<?php echo base_url('assets/images/back.svg');?>">
            </button>
          </a>
        <span class="view_employee_title">View Employee Table</span>
        </span>
        <span class="viewEmployeeTable_center ml-auto">
          <span class="select_css">
            <select placehdr="Center" id="centerValue" name="centerValue" >
              <?php 
              foreach($centers->centers as $center){ 
                if($_SESSION['centerr'] == $center->centerid){
                ?> 
                <option value="<?php echo $center->centerid;?>" selected><?php echo $center->name;?></option>
              <?php }else{ ?>
                <option value="<?php echo $center->centerid;?>"><?php echo $center->name;?></option>
            <?php  }
            } 
              $centerId = "";
              foreach($centers->centers as $center){ 
                  $centerId = $centerId . $center->centerid . "|";
               } ?>
               <option value="<?php echo $centerId?>"><?php echo "All Centers";?></option>
            </select>
          </span>
        </span>
        <span class="viewEmployeeTable_roles ml-3">
          <span class="select_css">
            <select placehdr="Center" id="roleValue" name="roleValue" > 
                <option value="">Role Value</option>
            </select>
          </span>
        </span>
        <span class="viewEmployeeTable_search ">
          <input type="" name="" onkeyup="searchBy()" id="filter" placeholder="Search">
        </span>
        <span class="syncXeroEmployees">
          <button class="button d-inline-flex" id="XeroEmployees" >
            <i>
              <img src="<?php echo base_url('assets/images/icons/xero.png'); ?>" style="max-height:2rem;margin-right:10px">
            </i>Sync&nbsp;Xero&nbsp;Employees</button>
        </span>
      </span>
      <div id="content-wrappers" class="containers">
        <div class="row content-wrappers-child">
          <div class="">
            <table class="table ">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Id</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="filterList" > 
                <tr class="viewEmployeeTable_row">
                  <td class="viewEmployeeTable_centerName_parent">
                    <span id="viewEmployeeTable_centerName" class="viewEmployeeTable_centerName">

                    </span>
                   </td> 
                  <td class="viewEmployeeTable_memberId_parent">
                    <span id="viewEmployeeTable_memberId" class="viewEmployeeTable_memberId">
                      
                    </span>
                   </td> 
                    <td class="">
                      <span id="viewEmployeeTable_memberName" class="viewEmployeeTable_memberName">

                      </span>
                    </td>
                    <td class="">
                      <span id="" class="viewEmployeeTable_action">
                        
                      </span>
                    </td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    <div class="changeCenterModal">
      <div class="changeCenterModalBody">
        <div class="changeCenterModal_header">
          <span class="changeCenterModal_name">Name</span>
          <span class="changeCenterModal_title">Title</span>
        </div>
        <div class="changeCenterModal_centers"></div>
        <div class="changeCenterModal_buttons">
          <button class="changeCenterModal_close button">Close</button>
          <button class="changeCenterModal_save button">Save</button>
        </div>
      </div>
    </div>

    </div>
<?php 
    function dateToDayAndYear($date){
      $date = explode("-",$date);
      return date("M d, Y",mktime(0,0,0,intval($date[1]),intval($date[2]),intval($date[0])));
    } 
?>
<script type="text/javascript">
 // left padding
  $(document).ready(()=>{
    $('#wrappers').css('paddingLeft',$('.side-nav').width());
});

  $(document).ready(function(){
    var url = '<?php echo base_url() ?>settings/centersBySuperAdmin';
    var type = 'CENTER';
    var id = "1";
    $.ajax({
      url : url,
      type : 'POST',
      data : {
        type : type,
        id : id
      },
      success : function(response){
        try{
          localStorage.setItem('centers',response);
        }
        catch{}
      }
    })
  })

  // get employees list
  $(document).ready(function(){
    var code = $('.viewEmployeeTable_row')[0].outerHTML
    viewEmployeeTable(code);
    $(document).on('change','#centerValue',function(){
      viewEmployeeTable(code)
    })
    function viewEmployeeTable(){
      var centerid = $('#centerValue').val();
      var counter = 0;
        var url = "<?php echo base_url() ?>settings/getEmployeesByCenter/"+centerid; 
      $.ajax({
        url: url,
        method: 'GET',
        success: function(response){
           $('.viewEmployeeTable_row').empty()
          var employees = JSON.parse(response);
          employees.employees.forEach(function(employee){
            $('#filterList').append(code);
            //  viewEmployeeTable_centerName -- emp name
            //  viewEmployeeTable_memberName -- role name
            $('.viewEmployeeTable_centerName').eq(counter).text(employee.name);
            $('.viewEmployeeTable_centerName').eq(counter).attr('empid',employee.id);
            $('.viewEmployeeTable_memberId').eq(counter).text(employee.id);
            $('.viewEmployeeTable_memberName').eq(counter).text(employee.roleName);
            $('.viewEmployeeTable_action').eq(counter).html(`
                <button class="button"><a href="${'<?php echo base_url() ?>settings/viewEmployee/'+employee.id}">View</a></button>
                <button class="button"><a href="${'<?php echo base_url() ?>settings/editEmployeeProfile/'+employee.id}">Edit</a></button>
              `)
            counter++;
          })
          // <button class="button editEmployeeCenter">Center</button>
          // console.log(employees);
          populateRoles()
        }
      })
    }
  })

  function getEmployeeCenters(empid){
    var url = '<?php echo base_url() ?>settings/getEmployeeDetails/'+empid;
    $.ajax({
      url : url,
      type : 'GET',
      success : function(response){
        try{
          var centers = (JSON.parse(response)).userCenters;
          centers.forEach(center => {
            $('.centerIdCheckbox_parent').each(function(c){
              if(center.centerid == $(this).attr('centerid')){
                $(this).children('.centerIdCheckbox').prop('checked',true)
              }
            })
          })
        }
        catch{}
      }
    })
  }

  // GET CENTERS //

  $(document).on('click','.viewEmployeeTable_centerName',function(){
    var empid = $(this).attr('empid');
    var empName = $(this).html();
    $('.changeCenterModal').css('display','block');
    $('.changeCenterModal_name').html(empName);
    $('.changeCenterModalBody').attr('empId',empid)
    $('.changeCenterModal_title').html($(this).parent().parent().children('td').eq(2).children('.viewEmployeeTable_memberName').text())
    try{
      $('.changeCenterModal_centers').empty();
      var centers = JSON.parse(localStorage.getItem('centers'));
      centers.CenterDetails.forEach(center => {
        var code = `<div class="centerIdCheckbox_parent" centerid="${center.centerid}">
                      <input class="centerIdCheckbox" type="checkbox"> 
                      <span>${center.name}</span>
                    </div>`;
            $('.changeCenterModal_centers').append(code)
      })
      getEmployeeCenters(empid);
    }
    catch{
      console.log(localStorage.getItem('centers'))
     }
  })

  $(document).on('click','.changeCenterModal_close',function(){
    $('.changeCenterModal_centers').empty();
    $('.changeCenterModalBody').removeAttr('empId');
    $('.changeCenterModal').css('display','none');
  })

  $(document).on('click','.changeCenterModal_save',function(){
    var url = '<?php echo base_url() ?>settings/changeEmployeeCenter';
    var empId = $('.changeCenterModalBody').attr('empId');
    var centers = [];
    $('.centerIdCheckbox_parent').each(function(){
      if($(this).children('.centerIdCheckbox').prop('checked') == true){
        centers.push($(this).attr('centerid'));
      }  
    })
    if(centers.length > 0){
      $.ajax({
        url : url,
        type : 'POST',
        data : {
          empId : empId,
          centers : centers
        },
        success :function(response){
            console.log(response)
        }
      })
    }else{
      alert('Total assigned centers cannot be 0');
    }
  })

/* -------------------------------
        GET ALL CENTERS
   ------------------------------- */
   $(document).on('click','.editEmployeeCenter',function(){
    // Display should be block;
    var userid = $(this).parent().parent().parent().children('.viewEmployeeTable_memberId_parent').children().text();
    var url = '<?php echo base_url() ?>settings/getEmployeeDetails/'+userid;
    $.ajax({
      url : url,
      type : 'GET',
      success : function(response){
        // console.log(JSON.parse(response).userCenters)
      }
    })
   })
/* -------------------------------
        GET ALL CENTERS
   ------------------------------- */

/*  ------------------
      Roles Select Box
    ------------------ */
    function populateRoles(){
      $('#roleValue').empty()
      var distinctRoles = $('.viewEmployeeTable_memberName').length;
      var rolesArray = [];
      for(i=0;i<distinctRoles;i++){
        rolesArray.push($('.viewEmployeeTable_memberName').eq(i).text())
      }
      // console.log(rolesArray)
      const unique = (value, index, self) => {
          return self.indexOf(value) === index
        }
      rolesArray = rolesArray.filter(unique)
      // console.log(rolesArray)
      var co = '<option value="Select Role">Select Role</option>'
      $('#roleValue').append(co)
      for(var i=0;i<rolesArray.length;i++){
        if(rolesArray[i] != "" && rolesArray[i] != null && rolesArray[i] != " " ){
          var code = `<option value="${rolesArray[i]}">${rolesArray[i]}</option>`;
          $('#roleValue').append(code)
        }
      }
    }

    $(document).on('change','#roleValue',function(){
      var i = 0;
      var filter = $('#roleValue').val()
      var val = $('.viewEmployeeTable_memberName').length
      var name = $('.viewEmployeeTable_memberName')
         $(".viewEmployeeTable_memberName").each(function(){
            if(filter != 'Select Role'){
               if ((name.eq(i).text().search(new RegExp(filter, "i")) < 0)) {
                  $(this).parent().parent().fadeOut();
               } else {
                  $(this).parent().parent().show();
              }
            }
            if(filter == 'Select Role'){
              // console.log(filter)
              $(this).parent().parent().show();
            }
            i++;
        });
    })

    function searchBy(){
        var filter = $('#filter').val();
        var i = 0;
        var name = $(".viewEmployeeTable_row td #viewEmployeeTable_centerName");
        var role = $(".viewEmployeeTable_row td #viewEmployeeTable_memberName");
        var id = $(".viewEmployeeTable_row td #viewEmployeeTable_memberId");
         $(".viewEmployeeTable_row td #viewEmployeeTable_centerName").each(function(){
             if ((name.eq(i).text().search(new RegExp(filter, "i")) < 0) && (role.eq(i).text().search(new RegExp(filter, "i")) < 0) && (id.eq(i).text().search(new RegExp(filter, "i")) < 0)) {
                $(this).parent().parent().fadeOut();
             } else {
                $(this).parent().parent().show();
            }
            i++;
        });

    }

    $(document).on('click','.syncXeroEmployees',function(){
      var centerid = $('#centerValue').val(); 
      var url = '<?php echo base_url() ?>settings/syncXeroEmployees'
      $.ajax({
        url : url,
        type : 'POST',
        data : {
          centerid : centerid
        },
        success : function(response){
          // console.log(response)
          // window.location.href = window.location.href;
        }
      }) 
    })
</script>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>View Employee Table</title>
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon_io/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon_io/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon_io/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/favicon_io/site.webmanifest') ?>">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
	 
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css');?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css');?>">
  
<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<style>
.navbar-nav .nav-item-header:nth-of-type(9) {
    background: var(--blue2) !important;
    position: relative;
}
.navbar-nav .nav-item-header:nth-of-type(9)::after {
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

  <body id="page-top"> 
<?php $permissions = json_decode($permissions);
      $centers = json_decode($centers);
      // print_r(json_encode($xeroTokens));
?>  
    <div class="wrapperContainer">
        <?php include 'headerNew.php'; ?>
      
		    <div class="containers scrollY">
			    <div class="settingsContainer ">
            <input type="hidden" id="loginId" value="<?php echo $this->session->userdata('LoginId') ?>">
            <span class="d-flex pageHead heading-bar">
              <div class="withBackLink">
                <a href="<?php echo base_url('settings');?>">
                <span class="material-icons-outlined">arrow_back</span>
                </a>				
                <span class="events_title">View Employee Table</span>
              </div>
              <div class="rightHeader">					
                <select placehdr="Center" id="centerValue" name="centerValue" class="w-100" style="margin-top:2px !important;">
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
                <!-- <span class="syncXeroEmployees w-100 btn btn-default btnOrange btn-small pull-right" id="XeroEmployees"> -->
                <span class="syncXeroEmployees w-100 btn btnOrange btn-small pull-right" id="XeroEmployees">
                    <img src="<?php echo base_url('assets/images/icons/xero.png'); ?>" style="max-height:2rem;margin-right:10px">
                    Sync&nbsp;Xero&nbsp;Employees
                </span>
              </div>
            </span>

            <div class="filterSearch">
							<div class="form-floating">
                <input type="" name="" class="form-control" onkeyup="searchBy()" id="filter" placeholder="Search">
                <label for="filter">Search Here(Name/Alias)</label>
              </div>
							<div class="form-floating">
                <select placeholder="Center" id="roleValue" name="roleValue" class="form-control"> 
                    <option value="">Role Value</option>
                </select>
                <label for="roleValue">Role Value</label>
              </div>
            </div>

            
      <div id="content-wrappers">
        <div class="row content-wrappers-child">
          <div class="table-div pageTableDiv">
            <table class="table ">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Alias</th>
                  <th>Id</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="filterList"> 
                <tr class="viewEmployeeTable_row">
                  <td class="viewEmployeeTable_centerName_parent">
                    <span id="viewEmployeeTable_centerName" class="viewEmployeeTable_centerName">

                    </span>
                   </td>
                   <td class="viewEmployeeTable_memberId_alias">
                    <span id="viewEmployeeTable_memberalias" class="viewEmployeeTable_memberalias">
                      
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
                      <span id="" class="viewEmployeeTable_action d-flex justify-content-center">
                        
                      </span>
                    </td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    <div class="changeCenterModal templateModal modalNew">
      <div class="modal-dialog mw-75">
        <div class="changeCenterModalBody modal-content NewFormDesign">
          <div class="changeCenterModal_header modal-header">
            <span class="changeCenterModal_name">Name</span>
            <span class="changeCenterModal_title">Title</span>
          </div>
          <div class="modal-body container">
            <section class="tab-buttons">
              <div class="tab-buttons-div">
                <span class="nav-button centers active"><span>Centers</span></span>
                <span class="nav-button awards"><span>Awards</span></span>
                <span class="hover" style="width: 50% !important;"></span>
              </div>
            </section>
            <section class="tabContent1">
              <div class="changeCenterModal_centers"></div>
            </section>
            <section class="tabContent2" style="display:none;">
              <div class="changeCenterModal_awards"></div>
            </section>            
            <div class="changeCenterModal_buttons modal-footer">
              <button class="changeCenterModal_close button btn btn-default btn-small">Close</button>
              <button class="changeCenterModal_save button btn btn-default btn-small btnOrange">Save</button>
            </div>
          </div>
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
    var centerid = $('#centerValue').val();
    var userid = $('#loginId').val();
    var url = '<?php echo base_url() ?>settings/centersBySuperAdmin';
    var awardsurl = '<?php echo base_url() ?>api/settings/getAwardSettings'+'/'+userid+'/'+centerid;
    // alert(awardsurl);
    var type = 'CENTER';
    // var id = "1";
    var id = centerid;

    // Centers
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

    // Awards
    $.ajax({
      url : awardsurl,
      type : 'GET',
      headers:{
        "x-device-id":'<?= $this->session->userdata('x-device-id') ?>',
        "x-token":'<?= $this->session->userdata('AuthToken') ?>'
      },
      success : function(awardresponse){
        try{
          // alert(awardresponse);
          localStorage.setItem('awards',awardresponse);
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
        // var url = "<php echo base_url() ?>settings/getEmployeesByCenter/6|12|25|28|"; 
        console.log(url);
        // alert(centerid);
      $.ajax({
        url: url,
        method: 'GET',
        success: function(response){
          console.log(response);
          // alert(response);
           $('.viewEmployeeTable_row,#filterList').empty();
          var employees = JSON.parse(response);
          // alert(JSON.stringify(employees));
          employees.employees.forEach(function(employee){
            if(employee.role != 1){
              // console.log(code);
              $('#filterList').append(code);
              //  viewEmployeeTable_centerName -- emp name
              //  viewEmployeeTable_memberName -- role name
              $('.viewEmployeeTable_centerName').eq(counter).text(employee.name);
              $('.viewEmployeeTable_centerName').eq(counter).attr('empid',employee.id);
              $('.viewEmployeeTable_memberId').eq(counter).text(employee.id);
              $('.viewEmployeeTable_memberalias').eq(counter).text(employee.alias);
              $('.viewEmployeeTable_memberName').eq(counter).text(employee.roleName);
              $('.viewEmployeeTable_action').eq(counter).html(`
                  <button class="btn-none"><a href="${'<?php echo base_url() ?>settings/viewEmployee/'+employee.id}"><span class="material-icons-outlined">visibility</span></a></button>
                  <button class="btn-none"><a href="${'<?php echo base_url() ?>settings/editEmployeeProfile/'+employee.id}"><span class="material-icons-outlined">edit</span></a></button>
                `)
              counter++;
            }
          })
          // <button class="button editEmployeeCenter">Center</button>
          // console.log(employees);
          populateRoles()
        }
      })
    }
  })

  function getEmployeeCenters(empid){
    var centerid = $('#centerValue').val();
    var url = '<?php echo base_url() ?>settings/getEmployeeDetails/'+empid+'/'+centerid;
    $.ajax({
      url : url,
      type : 'GET',
      success : function(response){
        try{
          var centers = (JSON.parse(response)).userCenters;
          console.log(centers);
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
  
  function getEmployeeAwards(empid){
    var url = '<?php echo base_url() ?>settings/getEmployeeAwardDetails/'+empid;
    $.ajax({
      url : url,
      type : 'GET',
      success : function(response){
        try{
          // alert(JSON.stringify(response));
          var awarddetails = (JSON.parse(response)).awards;
          // alert(JSON.stringify(awarddetails));
          awarddetails.forEach(award => {
            $('.awardIdCheckbox_parent').each(function(c){
              if(award.earningRateId == $(this).attr('earningRateId')){
                $(this).children('.awardIdCheckbox').prop('checked',true)
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
      $('.changeCenterModal_centers,.changeCenterModal_awards').empty();
      var centers = JSON.parse(localStorage.getItem('centers'));
      var awarddetails = JSON.parse(localStorage.getItem('awards'));
      //Centers Printing
      centers.CenterDetails.forEach(center => {
        var code = `<div class="centerIdCheckbox_parent" centerid="${center.centerid}">
                      <input class="centerIdCheckbox" type="checkbox"> 
                      <span>${center.name}</span>
                    </div>`;
            $('.changeCenterModal_centers').append(code);
      })
      awarddetails.awards.forEach(award => {
        var awardcode = `<div class="awardIdCheckbox_parent" earningRateId="${award.earningRateId}">
                      <input class="awardIdCheckbox" type="checkbox"> 
                      <span>${award.name}</span>
                    </div>`;
            $('.changeCenterModal_awards').append(awardcode);
      })
      getEmployeeCenters(empid);
      getEmployeeAwards(empid);
    }
    catch{
      console.log(localStorage.getItem('centers'));
      console.log(localStorage.getItem('awards'));
     }
  })

  $(document).on('click','.changeCenterModal_close',function(){
    $('.changeCenterModal_centers,.changeCenterModal_awards').empty();
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
            // console.log(response)
            alert("Centers updated successful");
            location.reload();
        }
      })
    }else{
      alert('Total assigned centers cannot be 0');
    }
  })

  $(document).on('click','.changeAwardModal_save',function(){
    var aurl = '<?php echo base_url() ?>settings/changeEmployeeAward';
    var empId = $('.changeCenterModalBody').attr('empId');
    var awards = [];
    $('.awardIdCheckbox_parent').each(function(){
      if($(this).children('.awardIdCheckbox').prop('checked') == true){
        awards.push($(this).attr('earningRateId'));
      }  
    })
    if(awards.length > 0){
      $.ajax({
        url : aurl,
        type : 'POST',
        data : {
          empId : empId,
          awards : awards
        },
        success :function(response){
            // console.log(response)
            alert("Awards updated successful");
            location.reload();
        }
      })
      // alert(JSON.stringify(awards));
    }else{
      alert('Total assigned awards cannot be 0');
    }
  })


/* -------------------------------
        GET ALL CENTERS
   ------------------------------- */
   $(document).on('click','.editEmployeeCenter',function(){
    // Display should be block;
    var centerid = $('#centerValue').val();
    var userid = $(this).parent().parent().parent().children('.viewEmployeeTable_memberId_parent').children().text();
    var url = '<?php echo base_url() ?>settings/getEmployeeDetails/'+userid+'/'+centerid;
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
        var alias = $(".viewEmployeeTable_row td #viewEmployeeTable_memberalias");
        var role = $(".viewEmployeeTable_row td #viewEmployeeTable_memberName");
        var id = $(".viewEmployeeTable_row td #viewEmployeeTable_memberId");
         $(".viewEmployeeTable_row td #viewEmployeeTable_centerName").each(function(){
             if ((name.eq(i).text().search(new RegExp(filter, "i")) < 0) && (role.eq(i).text().search(new RegExp(filter, "i")) < 0) && (id.eq(i).text().search(new RegExp(filter, "i")) < 0) && (alias.eq(i).text().search(new RegExp(filter, "i")) < 0)) {
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
          console.log(response);
          window.location.href = window.location.href;
        }
      }) 
    })

    $(document).on("click", ".centers", function(){
      $(".awards").removeClass("active");
      $(this).addClass("active");      
      $(".tabContent1").show();
      $(".tabContent2").hide();
      $(".changeAwardModal_save").toggleClass('changeAwardModal_save changeCenterModal_save');
    });
    $(document).on("click", ".awards", function(){
      $(".centers").removeClass("active");
      $(this).addClass("active");
      $(".tabContent1").hide();
      $(".tabContent2").show();
      $(".changeCenterModal_save").toggleClass('changeCenterModal_save changeAwardModal_save');
    });
</script>

</body>
</html>

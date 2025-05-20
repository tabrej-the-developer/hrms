<!DOCTYPE html>
<html>
<head>
<title>Notices</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tokenize2.css">

<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.js"  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="  crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/layout.css?version='.VERSION);?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/container.css?version='.VERSION);?>">

<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tokenize2.js"></script>

<script type="text/javascript" src="../assets/ckeditor/ckeditor.js"></script>
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
<script>
$(document).ready(function(){
    $('.form-control').floatlabel({
        labelClass: 'float-label',
        labelEndTop: 5
    });
});

function initializeFileUploads() {
    $('.file-upload').change(function () {
        var file = $(this).val();
        $(this).closest('.input-group').find('.file-upload-text').val(file);
    });
    $('.file-upload-btn').click(function () {
        $(this).find('.file-upload').trigger('click');
    });
    $('.file-upload').click(function (e) {
        e.stopPropagation();
    });
}


// On document load:
$(function() {
    initializeFileUploads();
});



// checkbox js -->
    $(document).ready(function(){
$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
});
// checkbox js end


</script>
</head>
<body>
<div class="wrapperContainer">
	<?php include 'headerNew.php'; ?>
	<div class="containers scrollY ">
    <div class="noticesContainer ">
      <?php $permissions = json_decode($permissions); ?>
      <?php if(isset($permissions->permissions) ? $permissions->permissions->createNoticeYN : "N" == "Y"){ ?>
      <!--   <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#home"><i class="fas fa-plus-square"></i> New</a>
        </li>
      </ul> -->
      
      <div class="d-flex pageHead heading-bar">
          <span class="events_title" id="roster-heading">Create New Notice</span>
          <span class=" sort-by rightHeader">
          </span>
        </div>
  <!-- Tab panes -->
      <div class="tab-content">
        <div id="home" class=" tab-pane active">
          <div class="">
            <div class="content-container clearfix d-md-flex" >
                <div class="col-md-12">
                  <?php if($error = $this->session->flashdata('msg')){ ?>
                      <p style="color: green;"><?php echo  $error; ?><p>
                  <?php } ?>
        
                    <form action="<?php echo base_url().'notice/createNotice';?>" method="post">
                      <div class="search-table">
                        <div class="search-box">
                          <!--                 <div class="row">
                              <div class="col-sm-12">
                                  <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search Employee">
                                  <script>
                                      $(document).ready(function () {
                                          $("#myInput").on("keyup", function () {
                                              var value = $(this).val().toLowerCase();
                                              $("#myTable tr").filter(function () {
                                                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                              });
                                          });
                                      });
                                  </script>
                              </div> 
                          </div> -->
                        </div>
 
                        <div class="col-md-12">
                          <div class="form-floating tokenizeSelect">
                            <select id="to" class="demo form-control" name="members[]" multiple >  
                              <?php
                                  $users = json_decode($users);
                              foreach ($users->users as $chat) {
                              if($chat->imageUrl == null || $chat->imageUrl == ""){
                                  $chat->imageUrl = base_url().'assets/images/defaultUser.png';
                              }
                              ?>       
                              <option value="<?php echo $chat->userid;?>"><?php echo $chat->username;?></option>
                              <?php }?>

                            </select>
                            <label for="to">To</label>
                          </div> 
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-floating ">
                          <input type="text" id="subject" name="subject" class="form-control"  required  placeholder="Enter Subject"/>
                          <label for="subject">Subject</label>
                        </div> 
                      </div>

                      <div class="col-md-12">
                        <div class="form-floating ckedit">
                          <textarea name="message"  class="form-control " id="editor" required>  </textarea>
                          <label for="editor">Message</label>
                        </div> 
                      </div>

                      <div class="formSubmit">
                        <button class="btn btn-default btn-small btnOrange pull-right button notice_submit" type="submit">
                          <span class="material-icons-outlined">send</span> Submit
                        </button>
                      </div>
           
                    </form>
                </div>
                  <!-- This block is for create group and list of groups  -->
                <div class="col-md-4 create_group_parent">
                    <div class="create_group_block">
                        <div class="create_group_heading">
                            <span class="create_group_title">Create Group</span>
                        </div>
                        <div class="create_group">

                            <div class="col-md-12">
                              <div class="form-floating ">
                                <input type="text" id="group_name_span" name="groupName" class="group_name_input form-control">
                                <label for="group_name_span">Group Name</label>
                              </div> 
                            </div>

                            <div class="col-md-12">
                              <div class="form-floating tokenizeSelect">
                                <select id="group_members_input" class="group_select" name="members_select[]" multiple > 
                                  <option></option> 
                                  <?php
                                    foreach ($users->users as $chat) {
                                        if($chat->imageUrl == null || $chat->imageUrl == ""){
                                            $chat->imageUrl = base_url().'assets/images/defaultUser.png';
                                        }
                                    ?>       
                                  <option value="<?php echo $chat->userid;?>"><?php echo $chat->username;?></option>
                                  <?php }?>
                                </select>
                                <label for="group_members_input">Add Members</label>
                              </div> 
                            </div>
                          </div>
                                
                          <div class="formSubmit">
                            <button class="btn btn-default btn-small btnOrange pull-right button notice_submit" id="create_group">
                              <span class="material-icons-outlined">add</span> Create Group
                            </button>
                          </div>

                    <div class="list_of_groups">
                        <div class="groups_titles">List of Groups</div>
                          <div class="groups_list">
                            <?php if(isset($groups)){ 
                              $groups = json_decode($groups); 
                              // var_dump($groups);
                              foreach($groups as $group){
                            ?>
                              <li class="group_name_li_tag">
                                <span>
                                    <span>
                                      <input type="checkbox" name="group" value="<?php echo $group->gid."isGROUP"; ?>" class="group_list">
                                    </span>
                                    <span class="group_name_list"><?php echo $group->groupName; ?></span>
                                </span>
                                <span class="ml-auto noticeGroupView" groupId="<?php echo $group->gid."isGROUP"; ?>">
                                  <span class="material-icons-outlined">edit</span>
                                </span>
                              </li>
                            <?php } } ?>
                          </div>
                        </div>
                    </div>
                          
                        </div>
                    </div>

                  <!-- Create group  and list of groups block ends here -->
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<div class="updateNoticeGroupModal">
  <div class="updateNoticeGroupModal_body">
    <div class="updateNoticeGroupModal_head">Notice Group</div>
    <div class="updateNoticeGroupModal_content">
      <div class="updateNoticeGroupModal_add">
        <select name="addEmployeesToGroup[]" class="addEmployeesToGroup" multiple>
          <?php foreach($users->users as $user){ ?>
            <option value="<?php echo $user->userid ?>"><?php echo $user->username ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="updateNoticeGroupModal_remove"></div>
      <input type="text" name="modalGroupId" class="modalGroupId" style="display:none">
    </div>
    <div class="updateNoticeGroupModal_buttons">
      <span><button class="button closeGroupsModal">Close</button></span>
      <span><button class="button saveGroupsModal">Save</button></span>
    </div>
  </div>
</div>

</body>
<script type="text/javascript">
    $(document).ready(()=>{
    $('.containers').css('paddingLeft',$('.side-nav').width());
});

//tokenize2
    $(document).ready(function(){
        $('.demo').tokenize2();
    });
    $(document).ready(function(){
        $('.group_select').tokenize2();
    })
    $(document).ready(function(){
        $('.addEmployeesToGroup').tokenize2();
    })
//tokenize2

  $(document).ready(function(){
    $(document).on('click','#create_group',function(){
      if(($('.group_name_input').val() != null && $('.group_name_input').val() != "") && $('.group_select').selected != ""){
        let url = "<?php echo base_url('notice/createGroup'); ?>"
        let groupName = $('.group_name_input').val();
        let groupMembers = [];
          groupMembers = $('.group_select').val();
        $.ajax({
          url : url,
          method:'POST',
          data : {
            groupName : groupName,
            groupMembers : groupMembers
          },
          success : function(response){
            window.location.reload()
          }
        })
      }
    })

    $(document).on('click','.closeGroupsModal',function(){
      $('.updateNoticeGroupModal').css('display','none')
      $('.modalGroupId').val('');
    })

    $(document).on('click','.noticeGroupView',function(){
      var groupId = $(this).attr('groupId');
      $('.modalGroupId').val(groupId);
      var groupUrl = '<?php echo base_url("notice/getGroupUsers/"); ?>'+groupId;
      var url = '<?php echo base_url("notice/getUsers"); ?>';
      $.ajax({
        url : groupUrl,
        type : 'GET',
        success : function(response){
          $('.updateNoticeGroupModal_remove').empty()
          $('.updateNoticeGroupModal').css('display','block')
          response = JSON.parse(response)
          var arLength = response.length
            for(var i=0;i<arLength;i++){
              $('.updateNoticeGroupModal_remove').append(`<li class="removeUserFromGroup_username">${response[i].name}<span class="removeUserFromGroup" memberId="${response[i].memberid}" groupId="${response[i].gid}"><i><img src='<?php echo base_url('assets/images/icons/x.png') ?>' height="15px" width="15px"> </i></span></li>`)
            }
        }
      })
    })

    $(document).on('click','.removeUserFromGroup',function(){
      var groupId =  $(this).attr('groupId');
      var memberId = $(this).attr('memberId');
      var url = '<?php echo base_url();?>notice/removeUserFromGroup/'+groupId+'/'+memberId;
      $.ajax({
        url : url,
        type : 'GET',
        success : function(response){
          window.location.reload();
        }
      })
    })
  })

  $(document).on('click','.saveGroupsModal',function(){
    var groupId = $('.modalGroupId').val();
    var members = [];
    for(var i=0;i<$('.addEmployeesToGroup option').length;i++){
      if($('.addEmployeesToGroup option').eq(i).attr('selected') == 'selected'){
        members.push($('.addEmployeesToGroup option').eq(i).val())
      }
    }
    var url = '<?php echo base_url();?>notice/addUsersToGroup';
    $.ajax({
      url : url,
      type : 'POST',
      data : {
        members : members,
        groupId : groupId
      },
      success : function(response){
        window.location.reload();
      }
    })
  })

  $(document).ready(function(){
    var groupsSelected = [];
    $(document).on('change','.group_list',function(){
        var value = $(this).val()
        var code = `<option value="${value}" selected="selected">${$(this).closest('.group_name_li_tag').children('.group_name_list').text()}</option>`;
        var liAppend = `<li class="token" data-value="${value}">
                            <a class="dismiss"></a>
                            <span>${$(this).closest('.group_name_li_tag').children('.group_name_list').text()}</span>
                        </li>`
      if($(this).prop('checked') == true){
            $('.tokens-container.form-control').eq(0).prepend(liAppend)
            $('.demo').append(code)
      }
      if($(this).prop('checked') == false){
            $(`li[data-value="${value}"]`).remove();
            $(`option[value="${value}"]`).attr('selected',false)
      }
    })
  })

</script>
<script>
  CKEDITOR.replace( 'editor' );

  CKEDITOR.on('instanceCreated', function(e) {
      e.editor.addCss( 'body { background-color: red; }' );
  });
</script>
</html>

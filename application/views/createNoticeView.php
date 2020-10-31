<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('header'); ?>
<title>Notices</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" href="https://code.jquery.com/jquery-3.4.1.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tokenize2.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tokenize2.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
    *{
font-family: 'Open Sans', sans-serif;
    }

body{
    background: #F3F4F7
}

/*Forms setup*/
.form-control {
    border-radius:0;
    box-shadow:none;
    height:auto;
}
.float-label{
    font-size:10px;
}
input[type="email"].form-control,
input[type="text"].form-control,
input[type="search"].form-control{
    max-width:100%;
}
textarea {
    border:1px dotted #CFCFCF!important;
    height:130px!important;
}
/*Content Container*/
.content-container {
    background-color:#fff;

    height: calc(100vh - 6rem);
}

/*Compose*/
.btn-send{
    text-align:center;
    margin-top:20px;
}
/*mail list*/

ul.mail-list{
    padding:0;
    margin:0;
    list-style:none;
    margin-top:30px;
}
ul.mail-list li a{
    display:block;
    border-bottom:1px dotted #CFCFCF;
    padding:20px;
    text-decoration:none;
}
ul.mail-list li:last-child a{
    border-bottom:none;
}
ul.mail-list li a:hover{
    background-color:#DBF9FF;
}
ul.mail-list li span{
    display:block;
}
ul.mail-list li span.mail-sender,.mail-sender-date{
    font-weight:600;
    color:#8F8F8F;
}
ul.mail-list li span.mail-subject{
    color:#8C8C8C;
}
ul.mail-list li span.mail-message-preview{
    display:block;
    color:#A8A8A8;
}
.mail-search{
    border-bottom-color:#7FBCC9!important; 
}
.file-upload {
    position: absolute;
    top: 0;
    left: 0;
    width:100%;
    height:100%;
    opacity: 0;
    cursor: pointer;
}
  .create_group_block{
    height:50%;
    overflow-y: auto;
  }
  .list_of_groups{
    height:50%;
    overflow-y: auto;
  }
  .create_group_parent{
    height: 100%;
    padding: 0;
    background: #fff;
    font-size: 1rem !important;
  }
  .create_group_title{
    font-weight: 100;
    font-size: 1rem;
    background: #8D91AA;
    color: #E7E7E7;
    display: flex;
    padding:1rem 0;
    justify-content: center;
  }
  .create_group{
    padding: 0 2rem;
  }
  .group_name_label{
    display: flex;
    justify-content: center;
  }
  .group_name_span{
    display: block;
  }
  .group_name_input{
    width: 100%;
    padding-left:2rem;
  }
  .label-floatlabel.float-label{
    display: none;
    opacity: 0;
    visibility: hidden;
  } 
  .groups_titles{
    display: flex;
    font-size:1rem;
    font-weight: 100;
    justify-content: center;
    background: #8D91AA;
    color: #E7E7E7 !important;
    padding: 1rem 0;
  }
  .group_members_span{
    display: block;
    text-align: center;
  }
/*pagination*/
.pagination {
    display: inline-block;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 12px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #e2e2e2;
    margin: 0 2px 2px 0px;
}

.pagination a.active {
    background-color: #0077dd;
    color: white;
    border: 1px solid #e2e2e2;
}
     #create_group, .button{
      border: none;
      color: rgb(23, 29, 75);
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-weight: 700;
      margin: 2px;
      min-width:5rem;
      border-radius: 20px;
      padding: 4px 8px;
      background: rgb(164, 217, 214);
      font-size: 1rem;
    }
    
input[type="text"],input[type=time],select,.tokens-container,textarea,.text_area{
  background: #ebebeb;
  border-radius: 5px;
    padding: 5px;
    border: 1px solid #D2D0D0 !important;
    border-radius: 20px;
}
.nicEdit-main{
  max-width:100% !important;

}
.text_area > div {
    max-width: 100% !important;
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
}
#editor{
  border-bottom-left-radius: 1rem !important;
  border-bottom-right-radius: 1rem !important;
}
.notice_heading{
  background-color:#F3F4F7;
  border:none;
  color: #171D4B;
  font-size: 1.75rem;
  font-weight:700;
  border-bottom-right-radius: 0rem;
  border-bottom-left-radius: 0rem;
  padding-left:1rem !important;
  padding-top:0.75rem;
  padding-bottom: 0.75rem;
  display: flex;
}
  form{
    padding-top: 1rem;
  }
.container{
    padding-right: 0;
    padding-left: 0;
}
.tab-content{
    padding: 0 1rem 0 1rem;
}
.group_name_label,.group_members_input{
    display: flex;
    justify-content: flex-start;
    font-weight: 700;
    margin-top: 1rem;
}
.group_name_li_tag{
  list-style: none;
  position: relative;
}
.groups_list{
  padding: 1rem;
}
.col-md-8.col-md-offset-2{
  padding-top:1rem;
}
.col-md-8.col-md-offset-2::before{
    content: ' ';
    height: 100%;
    width: 5px;
    border-right: 0.5rem solid #D2D0D0;
    position: absolute;
    right: 0;
    top: 0;
}
.text_area > div:nth-child(2){
  padding: 1rem;
}
.tokens-container.form-control{
  padding-left: 2rem !important;
}
label{
    margin-bottom: 0;
    font-weight: 700;
    color:#171D4B
}
 .tokenize > .tokens-container > .token-search > input{
  border: none !important;
 }
  .tokenize > .tokens-container > .token-search{
    border: none !important;
    width: 100% !important;
  }
  .noticeGroupView{
    position: absolute;
    right: 0;
    cursor: pointer;
  }
  .updateNoticeGroupModal{
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    display: none;
  }
  .updateNoticeGroupModal_body{
    position: absolute;
    left: 35%;
    width: 30%;
    height: 70%;
    background: white;
    top:10%;
  }
  .updateNoticeGroupModal_head{
    height: 15%;
    background: #8D91AA;
    color: #E7E7E7;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .updateNoticeGroupModal_content{
    height: 70%;
  }
  .updateNoticeGroupModal_add{
    height: 30%;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
  }
  .updateNoticeGroupModal_remove{
    height: 70%;
    overflow: auto;
  }
  .updateNoticeGroupModal_buttons{
    height: 15%;
    display: flex;
    justify-content: center;
    align-items: center;
  }  
  .removeUserFromGroup{
    position: absolute;
    right: 1rem;
    cursor: pointer;
  }
  .removeUserFromGroup_username{
    margin-left:1rem;
  }
  .updateNoticeGroupModal_add .tokens-container.form-control{
    max-height: 4rem;
    overflow-y: auto;
    overflow-x: hidden;
  }
.pagination a:hover:not(.active) {background-color: #ddd;}
/*pagination end*/

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
<div class="containers">
  <?php $permissions = json_decode($permissions); ?>
<?php if(isset($permissions->permissions) ? $permissions->permissions->createNoticeYN : "N" == "Y"){ ?>
<!--   <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home"><i class="fas fa-plus-square"></i> New</a>
    </li>
  </ul> -->
    <div>
      <span class="notice_heading">Create New Notice</span>
    </div>
  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class=" tab-pane active">
    <div class="">
    <div class="content-container clearfix d-md-flex" >
        <div class="col-md-8 col-md-offset-2">
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
 
                <label>To:</label>
                    <select class="demo" name="members[]" multiple >  
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
        </div>
            
            <label placeholder="Enter Subject">Subject</label>
            <div class="form-group">
                <input type="text" name="subject" class="form-control"  required  placeholder="Enter Subject"/>
            </div>

            <br>
            <label>Message:</label>
            <div class="text_area"> 
            <textarea name="message"  class="form-control" id="editor" required>  </textarea>
            </div>  
           
            <div class="form-group " style="display: flex;justify-content: flex-end;">
                <button class="btn button" type="submit">SEND</button>
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
                    <span>
                        <label class="group_name_label">Group Name</label>
                        <span class="group_name_span">
                            <input type="text" name="groupName" class="group_name_input">
                        </span>
                    </span>
                    <span class="group_members_span">
                        <label class="group_members_input">Add Members</label>
                      <select class="group_select" name="members_select[]" multiple > 
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
                    <button id="create_group">
                        <i>
                          <img src="<?php echo base_url('assets/images/icons/sent.png'); ?>" style="max-height:1rem;margin-right:10px">
                        </i>Create Group</button>
                    </span>
                </div>
            </div>
            <div class="list_of_groups">
                <div class="groups_titles">List of Groups</div>
                <div class="groups_list">
                  <?php if(isset($groups)){ 
                    $groups = json_decode($groups); 
                    // var_dump($groups);
                    foreach($groups as $group){
                   ?>
                    <span>
                      <li class="group_name_li_tag">
                        <span>
                          <input type="checkbox" name="group" value="<?php echo $group->gid; ?>" class="group_list">
                        </span>
                        <span class="group_name_list"><?php echo $group->groupName; ?></span>
                        <span class="ml-auto noticeGroupView" groupId="<?php echo $group->gid; ?>">
                          <i>
                            <img src="<?php echo base_url('assets/images/icons/pencil.png'); ?>" width="18px" height="18px">
                          </i>
                        </span>
                      </li>
                    </span>
                  <?php } } ?>
                </div>
            </div>
        </div>
        <!-- Create group  and list of groups block ends here -->
        </div>
    </div>
    </div>
   </div>
 <?php } ?>
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
        let url = window.location.origin+"/PN101/notice/createGroup"
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
      var groupUrl = window.location.origin+'/PN101/notice/getGroupUsers/'+groupId;
      var url = window.location.origin+'/PN101/notice/getUsers';
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
      var url = window.location.origin+'/PN101/notice/removeUserFromGroup/'+groupId+'/'+memberId;
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
    var url = window.location.origin+'/PN101/notice/addUsersToGroup';
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
    $(document).on('change','.group_list',function(){
        var value = $(this).val()
        var code = `<option value="${value}" selected="selected">${$(this).closest('.group_name_li_tag').children('.group_name_list').text()}</option>`
        var liAppend = `<li class="token" data-value="${value}">
                            <a class="dismiss"></a>
                            <span>${$(this).closest('.group_name_li_tag').children('.group_name_list').text()}</span>
                        </li>`
            $('.tokens-container.form-control').eq(0).prepend(liAppend)
            $('.demo').append(code)
    })
  })

</script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
  var quill = new Quill('#editor', {
    theme: 'snow'
  });
</script>
</html>

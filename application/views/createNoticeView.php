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
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
    *{
font-family: 'Open Sans', sans-serif;
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
    padding:35px 20px;
    margin-bottom:20px;
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
  }
  .list_of_groups{
    height:50%;
  }
  .create_group_parent{
    height:80vh;
  }
  .create_group_title{
    font-weight: 700;
    font-size: 1.5rem;
    display: flex;
    justify-content: center;
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
  }
  .groups_titles{
    display: flex;
    font-size:1.5rem;
    font-weight: 700;
    justify-content: center;
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
    .button{
    background-color: #9E9E9E;
    border: none;
    color: white;
    padding: 10px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin: 2px;
    border-radius: 0 !important
    }


.pagination a:hover:not(.active) {background-color: #ddd;}
/*pagination end*/

</style>

<!-- text editor-->
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
    //<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    //]]>
    </script>
    <!-- text editor end-->

<script>

!function(a,b){function g(b,c){this.$element=a(b),this.settings=a.extend({},f,c),this.init()}var e="floatlabel",f={slideInput:!0,labelStartTop:"20px",labelEndTop:"10px",paddingOffset:"10px",transitionDuration:.3,transitionEasing:"ease-in-out",labelClass:"",typeMatches:/text|password|email|number|search|url/};g.prototype={init:function(){var a=this,c=this.settings,d=c.transitionDuration,e=c.transitionEasing,f=this.$element,g={"-webkit-transition":"all "+d+"s "+e,"-moz-transition":"all "+d+"s "+e,"-o-transition":"all "+d+"s "+e,"-ms-transition":"all "+d+"s "+e,transition:"all "+d+"s "+e};if("INPUT"===f.prop("tagName").toUpperCase()&&c.typeMatches.test(f.attr("type"))){var h=f.attr("id");h||(h=Math.floor(100*Math.random())+1,f.attr("id",h));var i=f.attr("placeholder"),j=f.data("label"),k=f.data("class");k||(k=""),i&&""!==i||(i="You forgot to add placeholder attribute!"),j&&""!==j||(j=i),this.inputPaddingTop=parseFloat(f.css("padding-top"))+parseFloat(c.paddingOffset),f.wrap('<div class="floatlabel-wrapper" style="position:relative"></div>'),f.before('<label for="'+h+'" class="label-floatlabel '+c.labelClass+" "+k+'">'+j+"</label>"),this.$label=f.prev("label"),this.$label.css({position:"absolute",top:c.labelStartTop,left:f.css("padding-left"),display:"none","-moz-opacity":"0","-khtml-opacity":"0","-webkit-opacity":"0",opacity:"0"}),c.slideInput||f.css({"padding-top":this.inputPaddingTop}),f.on("keyup blur change",function(b){a.checkValue(b)}),b.setTimeout(function(){a.$label.css(g),a.$element.css(g)},100),this.checkValue()}},checkValue:function(a){if(a){var b=a.keyCode||a.which;if(9===b)return}var c=this.$element,d=c.data("flout");""!==c.val()&&c.data("flout","1"),""===c.val()&&c.data("flout","0"),"1"===c.data("flout")&&"1"!==d&&this.showLabel(),"0"===c.data("flout")&&"0"!==d&&this.hideLabel()},showLabel:function(){var a=this;a.$label.css({display:"block"}),b.setTimeout(function(){a.$label.css({top:a.settings.labelEndTop,"-moz-opacity":"1","-khtml-opacity":"1","-webkit-opacity":"1",opacity:"1"}),a.settings.slideInput&&a.$element.css({"padding-top":a.inputPaddingTop}),a.$element.addClass("active-floatlabel")},50)},hideLabel:function(){var a=this;a.$label.css({top:a.settings.labelStartTop,"-moz-opacity":"0","-khtml-opacity":"0","-webkit-opacity":"0",opacity:"0"}),a.settings.slideInput&&a.$element.css({"padding-top":parseFloat(a.inputPaddingTop)-parseFloat(this.settings.paddingOffset)}),a.$element.removeClass("active-floatlabel"),b.setTimeout(function(){a.$label.css({display:"none"})},1e3*a.settings.transitionDuration)}},a.fn[e]=function(b){return this.each(function(){a.data(this,"plugin_"+e)||a.data(this,"plugin_"+e,new g(this,b))})}}(jQuery,window,document);


$(document).ready(function(){
    $('.form-control').floatlabel({
        labelClass: 'float-label',
        labelEndTop: 5
    });
});
<!-- upload js -->
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
<!-- upload js end-->


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
<div><h3 style="padding-left:5%">Create New Notice</h3></div>
  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active">
    <div class="container">
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
            <div class="form-group"> 
            <textarea name="message"  class="form-control"  required>  </textarea>
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
                    <button id="create_group">Create Group</button>
                    </span>
                </div>
            </div>
            <div class="list_of_groups">
                <div class="groups_titles">List of Groups</div>
                <div>
                  <?php if(isset($groups)){ 
                    $groups = json_decode($groups); 
                    // var_dump($groups);
                    foreach($groups as $group){
                   ?>
                    <span>
                      <li>
                        <span>
                          <input type="checkbox" name="group" value="<?php echo $group->gid; ?>" class="group_list">
                        </span>
                        <span class="group_name_list"><?php echo $group->groupName; ?></span>
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


</body>
<script type="text/javascript">
    $(document).ready(()=>{
    $('.containers').css('paddingLeft',$('.side-nav').width());
});
</script>
<script type="text/javascript">
//tokenize2
    $(document).ready(function(){
        $('.demo').tokenize2();
    });
    $(document).ready(function(){
        $('.group_select').tokenize2();
    })
//tokenize2
</script>
<script type="text/javascript">
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
            console.log(response);
          }
        })
      }
    })
  })
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','.group_list',function(){
        var value = $(this).val()
        var code = `<option value="${value}" selected="selected">${$('.group_name_list').eq($(this).index()).text()}</option>`
        var liAppend = `<li class="token" data-value="${value}">
                            <a class="dismiss"></a>
                            <span>${$('.group_name_list').eq($(this).index()).text()}</span>
                        </li>`
            $('.tokens-container.form-control').eq(0).prepend(liAppend)
            $('.demo').append(code)

    })
  })
</script>
</html>
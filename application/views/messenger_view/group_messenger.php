<!DOCTYPE html>
<html lang="en">




<html>
<head>
<?php $this->load->view('header'); ?>
<style>
.container{max-width:1150px; margin:auto;}
img{ max-width:75%;}

.icon-container {
  width: 35px;
  height: 30px;
  position: relative;
}

/* img {
  height: 100%;
  width: 100%;
  border-radius: 50%;
} */

.status-circle {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background-color: grey;
  border: 2px solid white;
  bottom: 0;
  right: 0;
  position: absolute;
}
.status-circle-online {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background-color: #3CE77E;
  border: 2px solid white;
  bottom: 0;
  right: 0;
  position: absolute;
}

.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 25%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: none;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; }
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd;  width:100%; padding:2px 0 4px 6px; background:#fff; border-radius:15px;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
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

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: none;
  margin: 0;
  padding: 10px 16px 5px;
}
.inbox_chat { height: 597px; overflow-y: scroll;  background: #cccccc73;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  
  font-size: 15px;
  font-weight:600;
  margin: 0;
  padding: 5px 5px 3px 5px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 23px 25px;
  width: 75%;
      background-color: #cccccc47;
	  overflow-y: scroll;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; 
  color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: #fff;
  border: 1px solid #ccc;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {

 border: none;
  background-color: inherit;
  padding: 14px 28px;
  
  
  color: #11d1d1;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;

}
button:focus {
    outline: 0px dotted;
    /* outline: 5px auto -webkit-focus-ring-color; */
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
hr {
    margin-top: 0.2rem;
    margin-bottom: 0;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}
.altimg{
	max-width: 70%;
    margin: 0px 0px 0px 10px;
}
.altimg-m{
	max-width: 50%;
    margin: 0px 0px 0px 35px;
}
.altimg-main{
	    max-width: 24%;
    margin: 0px 0px 0px 10px;
    padding: 6px;
}


.search-bar{
	border-radius:15px;
	border:none;
	margin: 3px;
}
.btn.focus, .btn:focus {
    outline: 0;
    box-shadow: none;
}
/* .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 118px;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 8rem;
    padding: 0.5rem 0.5rem;
    cursor:pointer;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: .25rem;
	 margin-top: 10px;
}
.dropdown-menu a{
	color: #2125296e;
    text-decoration: none;
    padding: 0 0 0 9px;
    font-size: 15px;
	
}
.dropdown-menu a:hover{
	
	background-color:#ccc;
	color:#fff;
	
} */
::placeholder {
  color: #ccc;
  padding: 0 0 0 5px;
}

/*sidebar*/
.sidebar{
	position:fixed;
	top:58%;
	right:-100%;
	transform:translateY(-50%);
	width:350px;
	height:100vh;
	min-height:50%;
	padding:40px;
	background:#f9f9f9;
	overflow-y: scroll;
	box-sizing:border-box;
	transition:0.5s;
	z-index: 9999;
}
.sidebar.active{
	right:0;
}
.sidebar input,
.sidebar textarea{
	width:100%;
	height:36px;
	padding:5px;
	margin-bottom:10px;
	box-sizing:border-box;
	border:1px solid rgba(0,0,0,.5);
	outline:none;
}
.sidebar h2{
	margin:0 0 20px;
	padding:0;
}
.sidebar textarea{
	height:60px;
	resize:none;
}
.sidebar input[type="submit"]{
	background:#00bcd4;
	color:#fff;
	cursor:pointer;
	border:none;
	font-size:18px;
}
.toggle {
    position: absolute;
    height: 15px;
    width: 15px;
    text-align: center;
    cursor: pointer;
    background: #111010;
    top: 1%;
    left: 2px;
    line-height: 15px;
}
.toggle:before{
	content:'\f003';
	font-family:fontAwesome;
	font-size:18px;
	color:#fff;
}
.toggle.active:before{
	content:'\f00d';
}


/*profile card*/
.card {
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        width:310px;
        min-height:200px;
        background:#fff;
        transition:0.5s;
    }
    
    .card .box {
        position:absolute;
        top:50%;
        left:0;
        transform:translateY(-50%);
        text-align:center;
        padding:20px;
        box-sizing:border-box;
        width:100%;
    }
    .card .box .imgs {
        width:120px;
        height:120px;
        margin:0 auto;
        border-radius:50%;
        overflow:hidden;
    }
    .card .box .imgs img {
        width:100%;
        height:100%;
    }
    .card .box h2 {
        font-size:20px;
        color:#262626;
        margin:20px auto;
    }
    .card .box h2 span {
        font-size:14px;
        
        color:#212529;
        
    }
    .card .box p {
        color:#262626;
    }
    .card .box span {
        display:inline-flex;
    }
    .card .box ul {
        margin:0;
        padding:0;
    }
    .card .box ul li {
        list-style:none;
        float:left;
    }
    .card .box ul li a {
        display:block;
        color:#aaa;
        margin:0 10px;
        font-size:20px;
        transition:0.5s;
        text-align:center;
    }
    .card .box ul li:hover a {
        color:#e91e63;
        transform:rotateY(360deg);
    }
	.card2 {
        top:50%;
        left:50%;
        transform:translate(-9%,-2%);
        width:310px;
        min-height:60px;
        background:#fff;
        transition:0.5s;
    }
	.card2 {
    margin-bottom: 15px;
    border-radius: 0;
    box-shadow: 0 3px 5px rgba(0,0,0,.1);
}
    
    .card2 .box2 {
        position:absolute;
        top:50%;
        left:0;
        transform:translateY(-50%);
        text-align:center;
        padding:20px;
        box-sizing:border-box;
        width:100%;
    }
    .card2 .box2 .imgs {
        width:120px;
        height:120px;
        margin:0 auto;
        border-radius:50%;
        overflow:hidden;
    }
    .card2 .box2 .imgs img {
        width:100%;
        height:100%;
    }
    .card2 .box2 h2 {
        font-size:20px;
        color:#262626;
        margin:20px auto;
    }
    
    .card2 .box2 p {
        color:#262626;
		text-align: left;
    font-size: 17px;
    font-weight: 500;
    }
    
    .card2 .box2 ul {
        margin:0;
        padding:0;
    }
    .card2 .box2 ul li {
        list-style:none;
        float:left;
    }
    .card2 .box2 ul li a {
        display:block;
        color:#aaa;
        margin:0 10px;
        font-size:20px;
        transition:0.5s;
        text-align:center;
    }
    .card2 .box2 ul li:hover a {
        color:#e91e63;
        transform:rotateY(360deg);
    }
/*sidebar end*/


</style>
</head>
<body>
<div class="container">
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
           
			<div class="input-group">
				<input type="text" class="search-bar input-sm" placeholder="Search">
				<span class="input-group-btn">
				<button class="btn btn-default" type="button"><i class="fas fa-plus-circle" style="font-size:20px"></i></button>
				</span>
			</div>

          </div>
		  <p  style="background: #cccccc94; margin: 0; font-size: 18px; padding: 10px 10px 10px 20px;">General</p>
          <div class="inbox_chat">
            <div class="chat_list active_chat">
              <div class="chat_people">
			  
                <div class="chat_img">
				<div class='icon-container'>
					<!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
					<img class="img" src="https://ptetutorials.com/images/user-profile.png" alt="img_src">
					<div class='status-circle-online'>
					</div>
				</div>
				</div>
                <div class="chat_ib">
                  <h5>John doe </h5>
                </div>
              </div>
            </div>
            <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img">
					<div class='icon-container'>
					<!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
					<img class="img" src="https://ptetutorials.com/images/user-profile.png" alt="img_src">
					<div class='status-circle'>
					</div>
				</div>
				</div>
                <div class="chat_ib">
                  <h5>Sam</h5>
                  
                </div>
              </div>
            </div>
            <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img">
					<div class='icon-container'>
						<!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
						<img class="img" src="https://ptetutorials.com/images/user-profile.png" alt="img_src">
						<div class='status-circle'>
						</div>
					</div>
				</div>
                <div class="chat_ib">
                  <h5>Sunil </h5>
                 
                </div>
              </div>
            </div>
            <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img">
					<div class='icon-container'>
					<!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
					<img class="img" src="https://ptetutorials.com/images/user-profile.png" alt="img_src">
					<div class='status-circle-online'>
					</div>
				</div>
				</div>
                <div class="chat_ib">
                  <h5>Emmanuel </h5>
                  
                </div>
              </div>
            </div>
            <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img">
					<div class='icon-container'>
					<!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
					<img class="img" src="https://ptetutorials.com/images/user-profile.png" alt="img_src">
					<div class='status-circle'>
					</div>
				</div>
				</div>
                <div class="chat_ib">
                  <h5>michel</h5>
                  
                </div>
              </div>
            </div>
			
			<hr>
			
			<a style="text-decoration:none;" href="<?php echo site_url('messenger_api_controller/index')?>"><p style="margin: 0; font-size: 18px; padding: 10px 10px 10px 20px; color:#5a717c;">Individual</p></a>
            <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img">
					<div class='icon-container'>
					<!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
					<img class="img" src="https://ptetutorials.com/images/user-profile.png" alt="img_src">
					<div class='status-circle-online'>
					</div>
				</div>
				</div>
                <div class="chat_ib">
                  <h5>Jorden</h5>
                </div>
              </div>
            </div>
            <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img">
					<div class='icon-container'>
					<!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
					<img class="img" src="https://ptetutorials.com/images/user-profile.png" alt="img_src">
					<div class='status-circle'>
					</div>
				</div>
				</div>
                <div class="chat_ib">
                  <h5>mike</h5>
                </div>
              </div>
            </div>
			<hr>
			<div class="row">
			<div class="col-md-4"><p class="text-muted" style="margin: 0; font-size: 18px; padding: 10px 10px 10px 20px;">Groups</p></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"><button class="btn btn-default" type="button" title="Create group"> <i class="fas fa-plus-circle" style="font-size:20px;     margin: 7px 0 0 0;"></i></button></div>
			</div>
            <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img"> <i class="fas fa-users" style="font-size:25px"></i></div>
                <div class="chat_ib">
                  <h5>Hr</h5>
                </div>
              </div>
            </div>
            <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img"><i class="fas fa-users" style="font-size:25px"></i> </div>
                <div class="chat_ib">
                  <h5>Finance</h5>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
		
		<div class="container header">
		<div class="row">
			
			<div class="col-md-4 header-right">
			<div class="row">
				<a href="javascript:void(0);" id="contact_us">
				<div class="icon"><i class="fas fa-users" style="font-size:30px; color: #212529; margin: 15px -12px 0 17px;"></i></div></a>
				<p style="margin: 0; font-size: 20px; padding: 15px 10px 10px 20px;color: #1c73b8;">Group-HR</p>
			</div>
			</div>
			<div class="col-md-4"></div>
			<!--<div class="col-md-4 header-right">
			<div class="dropdown">
              <a href="#"><i class="fas fa-ellipsis-v" style="float:right; margin-top: 20px; color: #607d8bc4; font-size: 19px;"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#"><i class="fas fa-eraser"></i> Clear Chat</a></li>
                <li><a href="#"><i class="fas fa-file-excel"></i> Export Chat</a></li>
              </ul>
            
			</div>
			</div>-->
			
		</div>		
	</div>
        <div class="mesgs">
          <div class="msg_history">
            <div class="incoming_msg">
              <div class="incoming_msg_img"> <img class="altimg" src="https://ptetutorials.com/images/user-profile.png" alt="emp_img"> </div>
              <div class="received_msg">
				<div class="received_withd_msg">
                  <div class="row">
				  <div class="col-md-4"><p>Ajay kumar</p></div>
                  <div class="col-md-4"><span class="time_date"> 11:01 AM </span></div>
				  </div>
				</div>
				 <p>Hi Team</p>
              </div>
            </div>
            <div class="incoming_msg">
              <div class="incoming_msg_img"> <img class="altimg" src="https://ptetutorials.com/images/user-profile.png" alt="emp_img"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <div class="row">
				  <div class="col-md-4"><p>John doe</p></div>
                  <div class="col-md-4"><span class="time_date"> 11:21 AM </span></div>
				  </div>
				</div>
				<p>Hi how are you all</p>
              </div>
            </div>
			<div class="incoming_msg">
              <div class="incoming_msg_img"> <img class="altimg" src="https://ptetutorials.com/images/user-profile.png" alt="emp_img"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <div class="row">
				  <div class="col-md-4"><p>sunil</p></div>
                  <div class="col-md-4"><span class="time_date"> 11:34 AM </span></div>
				  </div>
				</div>
				<p>all good!! thanks</p>
              </div>
            </div>
				
			<div class="incoming_msg">
              <div class="incoming_msg_img"> <img class="altimg" src="https://ptetutorials.com/images/user-profile.png" alt="emp_img"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <div class="row">
				  <div class="col-md-4"><p>Emmanuel</p></div>
                  <div class="col-md-4"><span class="time_date"> 9:34 AM </span></div>
				  </div>
				</div>
				<p>Hi everyone</p>
              </div>
            </div>
			
			
			
          </div>
		  
		  
		  
		  <div class="incoming_msg">
              <div class="incoming_msg_img muted"> <img class="altimg-m" src="https://ptetutorials.com/images/user-profile.png" alt="emp_img"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <div class="row">
				  <div class="col-md-6"><p class="text-muted" style="font-size:12px;"><i>Emmanuel  joined the chat..</i></p></div>
                  <div class="col-md-6"><span class="time_date"> 9:34 AM </span></div>
				  </div>
				</div>
              </div>
            </div>
          <div class="type_msg">
            <div class="input_msg_write">
              <input type="text" class="write_msg" placeholder=" Type your message..." />
              <button class="msg_send_btn" type="button">SEND</button>
            </div>
          </div>
		  
        </div>
			<div class="sidebar">
			<div class="toggle" id="contact_close"></div>			  
			<div class="row">
				<div class="col-md-12">
					<div class="card">
					
						<div class="box">
							<div class="imgs">
							   <i class="fas fa-users" style="font-size:122px;"></i>
							</div>
							<h2>Group <span>Hr</span></h2>
							
						</div>
					</div>
				</div>
				<!--<ul class="list-group">
				  <li class="list-group-item d-flex justify-content-between align-items-center">
					Cras justo odio
					<span class="badge badge-primary badge-pill">14</span>
				  </li>
				</ul>-->
				
	<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<p style="color:green;">3 Participants</p>
		</div>
			<div class="card-body">
			<ul class="list-group list-group-flush">
			<li class="list-group-item">   <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img">
					<div class='icon-container'>
					<!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
					<img class="img" src="https://ptetutorials.com/images/user-profile.png" alt="img_src">
					<div class='status-circle-online'>
					</div>
				</div>
				</div>
                <div class="chat_ib">
                  <h5>John Doe</h5>
                </div>
              </div>
            </div>
			</li>
			<li class="list-group-item">   <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img">
					<div class='icon-container'>
					<!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
					<img class="img" src="https://ptetutorials.com/images/user-profile.png" alt="img_src">
					<div class='status-circle-online'>
					</div>
				</div>
				</div>
                <div class="chat_ib">
                  <h5>Ajay kumar</h5>
                </div>
              </div>
            </div>
			</li>
			<li class="list-group-item">   <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img">
					<div class='icon-container'>
					<!--<i class="fas fa-user-circle" style="font-size:25px"></i> -->
					<img class="img" src="https://ptetutorials.com/images/user-profile.png" alt="img_src">
					<div class='status-circle-online'>
					</div>
				</div>
				</div>
                <div class="chat_ib">
                  <h5>Rakesh</h5>
                </div>
              </div>
            </div>
			</li>
						
			</ul>
		</div>
	</div>
</div>
				<div class="col-md-12">
					<div class="card2">
					
					<div class="box2">
					<div class="group-name">
					<div class="row">
						<div class="col-md-6"><a href="#" name="exit" style="text-decoration:none;"><i class="fas fa-sign-out-alt"></i> Exit Group</a></div>
						<div class="col-md-6"><a href="#" name="delete_group" style="text-decoration:none;"><i class="fas fa-trash-alt"></i> Delet Group</button></div>
					</div>
					</div>
					</div>
					</div>
				</div>
			</div>
			</div>
      </div>
    </div></div>
    </body>
	 
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
	$(document).ready(function(){
  $('#contact_us').click(function(){
    $('.sidebar').toggleClass('active')
    $('.toggle').toggleClass('active')
  })
  
  
    $('#contact_close').click(function(){
    $('.sidebar').toggleClass('active')
    $('.toggle').toggleClass('active')
  })
})
	</script>
    </html>
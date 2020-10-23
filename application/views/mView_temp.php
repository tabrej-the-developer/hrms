<?php
$colors_array = ['#A4D9D6','#A4D9D6','#A4D9D6','#A4D9D6','#A4D9D6','#A4D9D6'];
$this->load->library('Crypt_RSA');
   $rsa = new Crypt_RSA();
   // echo extract($rsa->createKey());
// $publickey = '-----BEGIN PUBLIC KEY-----
// MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDGCglgIcCG5a8xlZHEDRtQQTc4
// kfxENNBtVN8bE4errA06mJ10WavP2Hg+k11NQip71IQPfIF9jlk1CsqT5ZHXOrOq
// RmufHFLa3fiuPvFiMB1NjK4F28Gk4LwyZrfTWc2V6S0xpL5XkFeWRW6I69xckOXj
// GqkC5dsWv/IlvPeVbwIDAQAB
// -----END PUBLIC KEY-----';
$publickey = $this->config->item('publicKey');
$rsa->loadKey($publickey);


   // echo $ciphertext;



?>
<html>
<head>
<?php $this->load->view('header'); ?>
    <script src="https://www.gstatic.com/firebasejs/7.22.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.22.1/firebase-messaging.js"></script>

<meta charset="UTF-8">	
  <meta name="keywords" content="HTML,CSS,XML,JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style type="text/css">
  *{
font-family: 'Open Sans', sans-serif;
  }
body {

  min-height: 100vh;
}

::-webkit-scrollbar {
  width: 5px;
  border: none;
}

::-webkit-scrollbar-track {
  width: 5px;
  background: #f5f5f5;
}

::-webkit-scrollbar-thumb {
  width: 1em;
  background-color: #ddd;
  
  border-radius: 1rem;
}

.text-small {
  font-size: 0.9rem;
}

.members-box{
  height: 165px;
  overflow-y: scroll;
    background-color:#fff;
}

.individual-box{
  min-height: 25vh;
  max-height: 25vh;
  overflow-y: scroll;
    background-color:#fff;
    padding-left: 1.5rem
}
.messages-box{
  height: 25vh;
  overflow-y: auto;
  background-color:#fff;
  padding-left: 1.5rem 
}
.chat-box {
  height: calc(100vh - 7rem);
  overflow-y: scroll;
  background-color:#fff;
}
.row.rounded-lg.overflow-hidden.shadow{
  max-height: 100vh
}
.rounded-lg {
  border-radius: 0 !important;
  margin-left: 0;
  margin-right: 0;
}

input::placeholder {
  font-size: 0.9rem;
  color: #999;
}
.headind_srchs{ 
  height: 3.5rem;
  overflow:hidden;
  display: flex;
  align-items: center;
  background: var(--header-color)
 }
 .headind_srch{ 
	padding:0.75rem 0.5rem 0.75rem 1rem;
	overflow:hidden;
	background-color:#9e9e9e33; 
	box-shadow: none;
 }
.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 1.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
	margin: 0 0 0 10px;
	
}
.form-control:focus {
    box-shadow: none;
}
.search-bar{
	border-radius:15px;
	border:none;
	box-shadow: none;
}
.form-control-sm {
    height: calc(1.5em + 0.5rem + 2px);
    padding: 1.1rem 2rem;
    font-size: .875rem;
    
}
.list-group-item-light {
    color: #818182;
    background-color: transparent;
    padding: 5px;
	border:none;
}
.list-group-item-light.list-group-item-action.active_chat {
    color: #818182;
    background-color: #f9f9f9;
    border-color: #f9f9f9;
}
.msg_send_btn{
	border: none;
    color: #25C14A;
    font-weight: 500;
    background-color: transparent;
    margin: 10px;
}
.icon-container {
  width: 35px;
  height: 30px;
  position: relative;
}

.status-circle {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: grey;
  border: 2px solid white;
  bottom: 0;
  right: 0;
  position: absolute;
}
.status-circle-online {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background-color: #3CE77E;
  border: 2px solid white;
  bottom: 0;
  right: 0;
  position: absolute;
}
.separator {
    display: flex;
    align-items: center;
    text-align: center;
	margin-bottom:20px;
}
.separator::before, .separator::after {
    content: '';
    flex: 1;
    border-bottom: 1px solid #ccc;
}
.separator::before {
    margin-right: .25em;
}
.separator::after {
    margin-left: .25em;
}
tbody {
    display:block;
    height:205px;
    overflow:auto;
}
thead, tbody tr {
    display:table;
    table-layout:fixed;
}
thead {
    width: calc( 100% - 1em )
}
table {
    width:400px;
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top:0;
}
p.ovrflowtext {
  white-space: nowrap; 
  width: 100%; 
  overflow: hidden;
  text-overflow: ellipsis; 
  border: 1px solid #000000;
  border:none;
}
  .checkbox{background-color:#fff;display:inline-block;height:18px;margin:0.6em 0 0 0;width:18px;border-radius:0;border:1px solid #ccc;float:right}
  .checkbox span{display:block;height:20px;position:relative;width:20px;padding:0}
  .checkbox span:after{-moz-transform:scaleX(-1) rotate(135deg);-ms-transform:scaleX(-1) rotate(135deg);-webkit-transform:scaleX(-1) rotate(135deg);transform:scaleX(-1) rotate(135deg);-moz-transform-origin:left top;-ms-transform-origin:left top;-webkit-transform-origin:left top;transform-origin:left top;border-right:3px solid #fff;border-top:3px solid #fff;content:'';display:block;height:13px;left:0;position:absolute;top:8px;width:8px}
  
  .checkbox input{display:none}
.checkbox input:checked + .default:after{border-color:#242121ad}
.avatar {
    font-size: 1rem;
    display: inline-flex;
    width: 48px;
    height: 48px;
    color: #fff;
    border-radius: 50%;
    background-color: #adb5bd;
    align-items: center;
    justify-content: center;
}

.avatar img {
    width: 100%;
    border-radius: 50%;
}

.avatar-sm {
    font-size: .675rem;
    width: 26px;
    height: 26px;
}

.avatar-group .avatar {
    position: relative;
    z-index: 2;
    border: 2px solid #fff;
}

.avatar-group .avatar:hover {
    z-index: 3;
}

.avatar-group .avatar + .avatar {
    margin-left: -1rem;
}
.list-group-item-light.list-group-item-action:focus, .list-group-item-light.list-group-item-action:hover {
    color: #818182;
    background-color: #f9f9f9;
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
.sidebar input{
	width:100%;
	height:100%;
	padding:5px;
	margin-bottom:10px;
	box-sizing:border-box;
	border:none;
	outline:none;
}
.sidebar h2{
	margin:0 0 20px;
	padding:0;
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

.left-bar-heading{
  font-size:0.9rem;
  color: black;
  font-weight: 500
}
.text-small{
  font-size: 0.75rem
}
.text-small-chat{
  font-size: 0.9rem;
  color: rgba(0,0,0,1);
}
.text-small-chat-message{
  font-size: 0.8rem;
  color: rgba(0,0,0,1);
  padding: 0 0.4rem
}
.left-bar{
  border-right: 1px solid rgba(0,0,0,0.2);
}
.right_box{
  border-left: 1px solid rgba(0,0,0,0.2);
}
.left-bar-title{
  color: #084183 !important;
  font-size: 0.9rem;
  font-weight: 700;
}
.attach_file{
    display: flex;
    justify-content: center;
    align-items: center;
    padding-left: 1rem
}
.attach_file > img{
  height: 1.5rem;
}
.circle_plus{
  display: flex;
    justify-content: center;
    align-items: center;
    padding-left: 0.75rem
}
.circle_plus > img{
  height: 1.5rem
}
.name-chat-box{
  font-weight: 700;
  color: #3D3C40 !important;
}
.chat-message-time{
  color: rgba(0,0,0,0.6);
  font-size: 0.6rem;
  display: flex;
  justify-content: flex-end;
  padding: 0 0.2rem
}
.bg-light{
  background: #f2f2f2 !important;
}
.icon{
  font-size:0.75rem;
  display:flex;
  justify-content:center;
  align-self: center;
  border-radius: 50%;
  padding:0.25rem 0;
  color:#707070;
  font-weight: 700;
  height: 1.5rem;
  width: 1.5rem;
}
.icon-parent{
  display: flex;
  align-content: center;
  justify-content: center
  padding:0;
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
	/*  display:inline-flex;*/    
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

/* inline edit group NAME */
.editbox {
  position: relative;
  margin:0 auto;
  padding:0;
  width:250px;
  min-height: 15px;
  border: 0;
  border-radius: 0;
  background: #fff;
}

.editable {
  border-color: #bd0f18;
  background: #f9f9f9;
}

.text {
  outline: none;
  font-size:18px;
  font-weight: 500;
    padding: 7px;

}

.edit, .save {
  width: 35px;
  display: block;
  position: absolute;
  top: 0px;
  right: 0px;
  padding: 4px 10px;
  /*border-top-right-radius: 2px;
  border-bottom-left-radius: 10px; */
  text-align: center;
  cursor: pointer;
  /* box-shadow: -1px 1px 4px rgba(0,0,0,0.5); */
}

.edit { 
  color: green;
  transition: opacity .2s ease-in-out;
}

.save {
  display: none;
  color: green;
  font-size:18px;
  margin-top: 7px;

}

.editbox:hover .edit {
  opacity: 1;
}

/* inline edit group NAME END */

.chat_ib h5{ font-size:15px; color:#464646; margin:6px 0 0 0;}
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
.pointer {cursor: pointer;}
.container{
  max-width:100%;
}
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
    .chat-box{
      min-height:0;
    }
    #chatForm{
          border-top: 1px solid rgba(0,0,0,.2);
          height: 3.5rem
    }

    /*-------------------*/
    /*Left bar heights and styles*/
    /*-------------------*/

.headind_srch{
  height:9vh;
}
#upload_image{
  display: none;
}
.attach_file:hover #upload_image{
  display: block !important;
  right:50%;
  top:0;
}
.general_heading{
  height:5.33vh;
}
.modal-header{
  background: #8D91AA;
  display: flex;
    justify-content: center;
}
.modal-header h5{
  font-size: 1rem;
  color: #F3F4F7 !important;
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
}

#recipient-name{
        background: #ebebeb !important;
      border-radius: 5px !important;
      padding: 5px !important;
      border: 1px solid #D2D0D0 !important;
      border-radius: 20px !important;
      padding-left: 1rem;
      font-size: 0.85rem !important;
}
.tokens-container.form-control{
  padding-left: 2rem !important;
}


/* New UI code from here */
:root{
  --header-color: #e6e6e6;
}
.left_topbar{
  height: 3.5rem;
  background: var(--header-color);
  display: flex;
  align-items: center;
  width: 100%;
  padding: 0 0.5rem;
}
.left_topbar_wrapper{
  width: 100%;
  display: flex;
  justify-content: space-between;
}
.searchbar{
  height: 3.5rem;
  background: white;
  display: flex;
  justify-content: center;
  align-items: center;
}
.searchinput{
  border-radius: 1rem;
  height: 2rem;
  border: 1px solid white;
  padding-left: 2rem;
  width: 100%;
}
.searchbar_wrapper{
  width: 85%;
}
.searchbar{
  background: var(--header-color);
}
/* Recent Chats List */
.recentchat{
  height: 4rem;
  width: 100%;
  background: white;
  display: block;
  height: calc(100vh - 3.5rem);
  overflow: auto;
}
.recentchat_icon{
  width: 60px;
  height: 100%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}
.recentchat_text_top{
  display: flex;
  justify-content: space-between;
  padding: 0 0.25rem;
}
.recentchat_text_bottom{
  padding: 0 0.25rem;
}
.recentchat_text{
  display: inline-block;
  width: 100%;
  vertical-align: middle;
}
.commonGroups_text{
  display: inline-block;
  width: 100%;
  vertical-align: middle;
}
.commonGroups_text_top{
    display: flex;
  justify-content: space-between;
  padding: 0 0.25rem;
}
.commonGroups_text_bottom{
    padding: 0 0.25rem;
}
.recentchat_tile{
  width: calc(100% - 65px);
  display: inline-block;
}
.commonGroups_tile{
  width: calc(100% - 65px);
  display: inline-block;
}
.recentchat_wrapper{
  width: 100%;
  display: block;
  position: relative;
  height: 4rem;
}
.recentchat_wrapper:hover{
  background: #f7f5f5;
  cursor: pointer;
}
.recentchat_wrapper:after{
      content: ' ';
    /* padding: 1px; */
    border-bottom: 1px solid #f0f0f0;
    width: 75%;
    display: block;
    text-align: right;
    position: absolute;
    right: 0;
    bottom: 0;
}
.recentchat_message{
  font-size: 0.8rem;
}
.recentchat_date_time{
  font-size: 0.8rem;
  color: #cccccc;
}
.left_topbar_righticon{
  cursor: pointer;
}
.left_topbar_righticon_click{
  position: relative;
}
.left_topbar_righticon_click:focus > .left_topbar_righticon_dropdown{
  display: block;
  position: absolute;
  right: 0;
  background: white;
  border-radius: 5px;
  padding: 0.5rem;
}
.left_topbar_righticon_dropdown{
  display: none;
min-width: 10rem;
    padding: .5rem 0;
    padding-left: 2rem !important;
    margin: .125rem 0 0;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: .25rem;
}
.left_topbar_righticon_dropdown > span{
  display: block;
}
/* Recent Chats List */

/* All Users List */
.allUsersList{
  height: 4rem;
  width: 100%;
  background: white;
  display: none;
  height: calc(100vh - 3.5rem);
  overflow: auto;
}
.createGroupUsersList{
  height: 4rem;
  width: 100%;
  background: white;
  display: block;
  height: calc(100vh - 9.5rem);
  overflow: auto;
}
.createGroupUsersList_wrapper{
  width: 100%;
  display: block;
  position: relative;
  height: 4rem;
}
.createGroupUsersList_wrapper:hover{
  background: #f7f5f5;
  cursor: pointer;
}
.createGroupUsersList_wrapper:after{
      content: ' ';
    /* padding: 1px; */
    border-bottom: 1px solid #f0f0f0;
    width: 75%;
    display: block;
    text-align: right;
    position: absolute;
    right: 0;
    bottom: 0;
}
.allUsersList_userIcon{
  width: 60px;
  height: 4rem;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}
.recentchat_text_top{
  display: flex;
  justify-content: space-between;
  padding: 0 0.25rem;
}
.recentchat_text_bottom{
  padding: 0 0.25rem;
}
.recentchat_text{
  display: inline-block;
  width: 100%;
}
.recentchat_tile{
  width: calc(100% - 65px);
}
.recentchat_tile{
  display: inline-block;
  height: 100%;
  vertical-align: center;
}
.allUsersList_wrapper{
  width: 100%;
  display: block;
  position: relative;
  height: 4rem;
}
.allUsersList_wrapper:hover{
  background: #f7f5f5;
  cursor: pointer;
}
.allUsersList_wrapper:after{
      content: ' ';
    /* padding: 1px; */
    border-bottom: 1px solid #f0f0f0;
    width: 75%;
    display: block;
    text-align: right;
    position: absolute;
    right: 0;
    bottom: 0;
}
.groupMembers_wrapper{
  width: 100%;
    display: flex;
    align-items: center;
  position: relative;
  height: 3rem;
}
.groupMembers_wrapper:after{
      content: ' ';
    /* padding: 1px; */
    border-bottom: 1px solid #f0f0f0;
    width: 75%;
    display: block;
    text-align: right;
    position: absolute;
    right: 0;
    bottom: 0;
}
.groupMembers_wrapper:hover{
  background: #f7f5f5;
  cursor: pointer;
}
.groupMembers_userIcon{
  width: 60px;
  height: 4rem;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}
.groupMembers_text{
  display: inline-block;
  width: 100%;
  vertical-align: middle;
}
.commonGroups_wrapper{
  width: 100%;
  display: block;
  position: relative;
  height: 4rem;
}
.commonGroups_wrapper:hover{
  background: #f7f5f5;
  cursor: pointer;
}
.commonGroups_wrapper:after{
      content: ' ';
    /* padding: 1px; */
    border-bottom: 1px solid #f0f0f0;
    width: 75%;
    display: block;
    text-align: right;
    position: absolute;
    right: 0;
    bottom: 0;
}
.commonGroups_userIcon{
  width: 60px;
  height: 4rem;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}
.recentchat_message{
  font-size: 0.8rem;
}
.recentchat_date_time{
  font-size: 0.8rem;
  color: #cccccc;
}
.left_topbar_righticon{
  cursor: pointer;
}
.left_topbar_righticon_click{
  position: relative;
}
.left_topbar_righticon_click:focus > .left_topbar_righticon_dropdown{
  display: block;
  position: absolute;
  right: 0;
  background: white;
  border-radius: 5px;
  padding: 0.5rem;
}
.left_topbar_righticon_dropdown{
  display: none;
min-width: 10rem;
    padding: .5rem 0;
    padding-left: 2rem !important;
    margin: .125rem 0 0;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: .25rem;
    z-index: 2;
}
.left_topbar_righticon_dropdown > span{
  display: block;
}
/* All Users List */

#contact_us{
  padding-left: 1rem;
}
.sender-rightalign{
  display: flex;
  justify-content: flex-end;
  /* display: flex; */
  width: 100%;
  margin: 0.4rem 0;
  position: relative;
}
.sender-leftalign{
  position: relative;
  margin: 0.25rem 0;
}
.sender-right,.sender-left{
  background: white;
  min-width: 10%;
  max-width: 40%;
  border-radius: 5px;
  border-bottom: 1px solid rgba(0,0,0,0.1);
  background: #c7cdff;
  color: white !important;
}
.sender-right::after{
    content: ' ';
    border-top: 10px solid #c7cdff;
    border-right: 10px solid transparent;
    /* padding: 1rem; */
    position: absolute;
    right: -7px;
    top: 0;

}
.sender-left::before{
    content: ' ';
    border-top: 10px solid #c7cdff;
    border-left: 10px solid transparent;
    /* padding: 1rem; */
    position: absolute;
    left: -7px;
}
.right_top_tab{
  height: 3.5rem;
  display: flex;
  align-items: center;
  background: var(--header-color);
}
.right_user_icon{
  height: 40vh;
  width: 100%;
}
.user_icon_wrapper{
    height: 80%;
    width: 100%;
}
.user_icon_view{
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.user_icon_view img{
    height: 10rem;
    width: 10rem;
    /*width: auto;*/
    border-radius: 50%;
}
.user_title_view{
  font-size: 0.8rem;
  /*padding-left: 0.5rem;*/
}
.user_name_wrapper{
  display: flex;
  flex-direction: column;
}
.right_top_tab_close{
    position: relative;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-left: 1rem;
    cursor: pointer;
}
.right_top_tab_close img{
  height: 30%
}
.right_top_tab_info{
width: 100%;
    display: flex;
    align-items: center;
    padding-right: 4rem;
    justify-content: center;
}
.text-capitalize,.contact_us{
    cursor: pointer;
}
.text-capitalize{
  width: 100%;
}
.right_box{
  padding: 0 !important;
  display: none;
  height: 100vh;
}
.input-group{
  display: flex;
  align-items: center;
}
#chatText{
  margin-left: 1rem;
  border-radius: 2rem !important;
}
.currentTextDate_center{
  font-size: 0.85rem;
  display: flex;
  width: 100%;
  justify-content: center;
  margin-top: 0.35rem;
}
.currentTextDate_centerbox{
  background: #dcf8c6;
  padding: 0.25rem;
  border-radius: 0.25rem;
  box-shadow: 0 -1px 3px 1px rgba(0,0,0,0.1);
}
.alphabetIcon{
height: 10rem;
    width: 10rem;
    background: #A4D9D6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color:#707070;
}
.user_name_view{
  display: flex;
  justify-content: center;
}
.user_title_view{
  display: flex;
  justify-content: center;
}
.boxcategory{
  height: 15rem;
  overflow: hidden;
}
.boxcategoryTitle{
    height: 3rem;
    display: flex;
    background: #171d4b;
    justify-content: center;
    align-items: center;
    color: white;
}
.elementOfCategory{
  display: block;
}
.boxcategory_wrapper{
  text-align: center;
  overflow: auto;
  height: 12rem;
}
/*User modal*/
.usersModal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0, 0, 0);
  background-color: rgba(0, 0, 0, 0.4);
  
}
.usersModalContent {
  color: #414242;
  margin: 15% auto;
  padding: 30px 60px;
  width: 500px;
  font-size: 16px;
  line-height: 28px;
  letter-spacing: 0.5px;
  -webkit-font-smoothing: antialiased;
  background: #FFFFFF;
  border: 1px solid #9B9C9D;
  box-shadow: 0px 2px 6px 0px rgba(0,0,0,0.20);
  border-radius: 6px;
}

.usersModalContent a {
  color: #636464;
}

.usersModalContent > h1 {
  display: block;
  width: 100%;
  text-align: center;
}

.user__#accept {
  margin: 30px auto;
  display: block;
  border: 1px solid #fc4c02;
  border-radius: 3px;
  background: #fff;
  color: #fc4c02;
  font-size: 16px;
  height: 48px;
  padding: 0 20px;
  cursor: pointer;
}
/*User modal*/
.groupOptions{
  position: absolute;
  bottom: 0;
  cursor: pointer;
  height: 3.5rem;
  width: 100%;
  background: rgba(226, 90, 83);
  display: flex;
  justify-content: center;
  align-items: center;
}
.searchbar_back{
  cursor: pointer;
  display: none;
}
.createGroupClass_wrapper > img:hover{
  animation:spin 0.25s linear ;
  cursor: pointer;
}
div.createGroupClass{
  border-top:1px solid rgba(0,0,0,0.2);
height: 3.5rem;
    display: flex;
    justify-content: center;
    align-items: center;
}
.groupNameClass{
  width: 100%;
  background: #edeff2;
}
.groupNameClass span{
display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
    height: 2.5rem;
}
.groupNameClass input{
  border: none;
  border-radius: 20px;
  padding-left: 1rem !important;
  background: #fff;
  padding: 0.25rem;
  width: 90%;
}
.searchbar_wrapper::before{
    content: ' ';
    position: absolute;
    background-image: url(http://localhost/PN101/assets/images/icons/search.png);
    height: 25px;
    width: 25px;
    background-repeat: no-repeat;
    background-size: 15px 15px;
    margin-top: 0.5rem;
    margin-left: 0.5rem;
}
@keyframes spin { 
  100% { -webkit-transform: rotate(360deg); transform:rotate(360deg) } }
.angle_downward{
  opacity: 0;
  transition-duration: 0.5s;
}
.angle_downward:hover{
  cursor: pointer;
  opacity: 1;
}
.remove_user_block{
  display: none;
}
.no_messages_wrapper{
height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}
/* New UI code ends here */
    @media only screen and (max-width: 600px){
      .left-bar{
        max-width:auto;
        width: 100vw;
      }
      .message-back{
        padding:0 20px !important;

      }
      .container{
        max-width:100%;
        padding-right: 0 !important;
      }
      .lefbar-sm{
        width: 100vw;
      }
    }
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tokenize2.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tokenize2.js"></script>
<!--   <script type="text/javascript">
      var firebaseConfig = {
    apiKey: "AIzaSyC_JyXX3uMpFiLXbkbGr4WhBsECY3sCFS4",
    authDomain: "personnal-8f7c9.firebaseapp.com",
    databaseURL: "https://personnal-8f7c9.firebaseio.com",
    projectId: "personnal-8f7c9",
    storageBucket: "personnal-8f7c9.appspot.com",
    messagingSenderId: "1060379292734",
    appId: "1:1060379292734:web:d7427124ff401d0d168d6f",
    measurementId: "G-EB151W6QQ8"
  };
  firebase.initializeApp(firebaseConfig);


  const messaging = firebase.messaging();
      messaging.requestPermission().then(()=>{
          console.log("Permission granted");
    })
    .catch((err)=>{

    })

function subscribeTokenToTopic(token, topic) {
  var server_key = "AAAA9uOH9D4:APA91bHlYcXEUwBnzORvoU2tLYKWRjmab4LRLXF57nmPrFuqx3am8OHLf9ynqEg1p4aVnEoi0fhwcmuNS_qDGOC9hMrkmXEzlIJQM4BnR9UHSlDz08cNgbz55xXjrZhCYd2jh8eYmQtw"
  fetch('https://iid.googleapis.com/iid/v1/'+token+'/rel/topics/'+topic, {
    method: 'POST',
    headers: new Headers({
      'Authorization': 'key='+server_key
    })
  }).then(response => {
    if (response.status < 200 || response.status >= 400) {
      throw 'Error subscribing to topic: '+response.status + ' - ' + response.text();
    }
    console.log('Subscribed to "'+topic+'"');
  }).catch(error => {
    console.error(error);
  })
}



messaging.usePublicVapidKey("BGJDAe2YiWVWOyIgcPxHLXAnijA00meTyXrkDiouQV7FkrmMrCyx1eqgzI52hpGnYrTDowe13-rDF1pDycgKTAY");

messaging.getToken().then((currentToken) => {
  console.log(currentToken)
  var idUser = "<?php echo $this->session->userdata('LoginId'); ?>";
  var registrationTokens = [currentToken];
  var topicPrefix = "stage_";
  subscribeTokenToTopic(registrationTokens, idUser)
})


  messaging.onMessage(function(payload) {
    console.log("Message received. ", payload);
  });
  </script> -->
</head>

<body>
<div class="container mr-0 pr-0">
 <?php 
      $recentChats = json_decode($recentChats);
    $allUsers = json_decode($allUsers);
    $currentChat;
    $currentUserInfo;
    $groups;
  
  ?>

  <div class="row rounded-lg overflow-hidden shadow">
    <!-- Users box-->
    <div class="col-md-3 col-sm-12 px-0 left-bar" style="">
<!--       <div class="left_topbar">
        <span class="left_topbar_wrapper">
          <span class="left_topbar_lefticon">
            <img src="<?php echo base_url('assets/images/icons/user.png') ?>" alt="user image" style="border-radius: 50%" height="32px" width="32px">
          </span>
          <span class="left_topbar_righticon_wrapper">
            <span class="left_topbar_righticon">
              <a href="javascript:void(0)" class="left_topbar_righticon_click">
                <img src="<?php echo base_url('assets/images/icons/more.png') ?>" alt="raindrop icon">
                <div class="left_topbar_righticon_dropdown">
                  <span id="myBtn" class="user__"> Users</span>
                  <span class="addgroup" >
                    New&nbsp;Group  
                  </span>
                </div>
              </a>
            </span>
          </span>
        </span>
      </div> -->
      <div class="searchbar">
        <span class="searchbar_back">
          <i>
            <img src="<?php echo base_url('assets/images/icons/back.png'); ?>">
          </i>
        </span>
        <span class="searchbar_wrapper">
          <span class="searchinput_wrapper">
            <input type="" name="" class="searchinput">
          </span>
        </span>
          <span class="left_topbar_righticon_wrapper">
            <span class="left_topbar_righticon">
              <a href="javascript:void(0)" class="left_topbar_righticon_click">
                <img src="<?php echo base_url('assets/images/icons/more.png') ?>" alt="raindrop icon">
                <div class="left_topbar_righticon_dropdown">
                  <span id="myBtn" class="user__"> Users</span>
                  <span class="addgroup" >
                    New&nbsp;Group  
                  </span>
                </div>
              </a>
            </span>
          </span>
      </div>
      <!-- Recent Chat  -->
      <div class="recentchat">
        <?php 
        if(isset($recentChats->chats)){
          if(count($recentChats->chats) > 0){
        foreach($recentChats->chats as $chat){ ?>
        <span class="recentchat_wrapper" group="<?php echo $chat->isGroupYN; ?>" id="<?php echo $chat->id; ?>">
          <span class="recentchat_icon">
            <span class=" icon" style="
              <?php echo "background:".$colors_array[rand(0,5)]?>">
              <?php echo isset($chat->name) ? icon($chat->name) : "";?>
            </span>
          </span>
          <span class="recentchat_tile">
            <span class="recentchat_text">
              <div class="recentchat_text_top">
                <span class="recentchat_title"><?php 
                  if(strlen($chat->name) > 13){
                      echo  substr($chat->name,0,14)."...";
                  }else{
                    echo $chat->name;
                  }
                 ?></span>
                <span class="recentchat_date_time">
                  <?php
                  if(date('d-m-Y',strtotime($chat->time)) == date('d-m-Y',strtotime('today')))
                    echo date('h:i a',strtotime($chat->time));
                  else
                    echo date('d/m/Y',strtotime($chat->time));
                  ?>
                </span>
              </div>
              <div class="recentchat_text_bottom">
                <?php // array_slice(explode(" ",$chat->name),0,1)[0].": ". ?>
                <?php if($chat->isGroupYN == 'N'){ ?>
                <span class="recentchat_message"><?php echo ((strlen($chat->lastText)) <= 25 ? $chat->lastText : substr($chat->lastText,0,25)."..."); ?></span>
              <?php }if($chat->isGroupYN == 'Y'){  ?>
                <span class="recentchat_message"><?php echo array_slice(explode(" ",$chat->senderName),0,1)[0].": ".((strlen($chat->lastText)) <= 15 ? $chat->lastText : substr($chat->lastText,0,15)."..."); ?></span>
              <?php } ?>
              </div>
            </span>
          </span>
        </span>
        <?php } }else{ ?>
          <div class="no_messages_wrapper">
            <span class="no_messages">No Recent Chats</span>
          </div>;
        <?php } } ?>
      </div>
      <!-- Recent Chat -->

      <!-- All Users List -->
      <div class="allUsersList"><!-- class="recentchat" -->
        <?php 
        foreach ($allUsers->users as $user) { ?>
        <span class="allUsersList_wrapper" group="N" onclick="loadNewChat('<?php echo $user->userid ?>','N')">
          <span class="allUsersList_userIcon">
            <span class=" icon" style="
              <?php echo "background:".$colors_array[rand(0,5)]?>">
              <?php echo isset($user->username) ? icon($user->username) : "";?>
            </span>
          </span>
          <span class="recentchat_tile">
            <span class="recentchat_text">
              <div class="recentchat_text_top">
                <span class="recentchat_title allUsersList_title"><?php 
                  if( strlen($user->username) > 16){
                    echo substr($user->username,0,17)."..";
                  }
                  else{
                   echo $user->username;
                  }
                     ?></span>
              </div>
            </span>
          </span>
        </span>
        <?php } ?>
      </div>
      <!-- All Users List -->

      <!-- Create group user list -->
      <div class="groupNameClass">
        <span><input type="text" name="" placeholder="Enter Group Name" class="groupNameInput"></span>
      </div>
      <div class="createGroupUsersList"><!-- class="recentchat" -->
        <?php foreach ($allUsers->users as $user) { ?>
        <span class="createGroupUsersList_wrapper" userId="<?php echo $user->userid; ?>">
          <span class="allUsersList_userIcon">
            <span class=" icon" style="
              <?php echo "background:".$colors_array[rand(0,5)]?>">
              <?php echo isset($user->username) ? icon($user->username) : "";?>
            </span>
          </span>
          <span class="recentchat_tile">
            <span class="recentchat_text">
              <div class="recentchat_text_top">
                <span class="recentchat_title createGroupUsersList_title"><?php echo $user->username; ?></span>
              </div>
            </span>
          </span>
        </span>
        <?php } ?>
      </div>
      <div class="createGroupClass">
        <span class="createGroupClass">
          <i class="createGroupClass_wrapper" style="border-radius: 50%;background:rgba(0,200,0,0.2);padding:0.35rem;">
            <img src="<?php echo base_url('assets/images/icons/right-arrow.png'); ?>" width="32px" height="32px">
          </i>
        </span>
      </div>
      <!-- Create group user list -->

    </div>

<!-- 
  <div class="group-box col-sm-12 col-md-7"></div> -->
    <!-- Chat Box-->	
    <div class="px-0 col-sm-12 col-md-9 messenger_center_box" style="min-height:100vh;word-break: break-word">
<?php   
    $currentUserInfo = json_decode($currentUserInfo);
 ?>
  <div  class="media headind_srchs" 
        user_id="<?php echo isset($currentUserInfo->memberid) ?  $currentUserInfo->memberid : (isset($currentUserInfo->groupid) ?  $currentUserInfo->groupid : "" ); ?>" 
        group="<?php echo isset($currentUserInfo->memberid) ?  'N' : (isset($currentUserInfo->groupid) ?  'Y' : "" ); ?>">
    <i class="message-back"></i>
    <a href="javascript:void(0);" id="contact_us">
  	<?php
      if(isset($currentUserInfo->avatarUrl)){
        if($currentUserInfo->avatarUrl == null || $currentUserInfo->avatarUrl == ""){ ?>
          <span class=" icon" style="
                <?php echo "background:".$colors_array[rand(0,5)]?>">
            <?php echo isset($currentUserInfo->groupName) ? icon($currentUserInfo->groupName) : "";?>
          </span>
          <?php  } 
          if($currentUserInfo->avatarUrl != "" && $currentUserInfo->avatarUrl != null){
              ?>
            <img src="<?php if(isset($currentUserInfo->avatarUrl)){
               echo $currentUserInfo->avatarUrl;}?>" alt="user" width="35" class="rounded-circle">
               <?php } }else{ ?>
              <span class="icon-parent">
                <span class=" icon" style="
                  <?php echo "background:".$colors_array[rand(0,5)]?>">
                  <?php echo isset($currentUserInfo->memberName) ? icon($currentUserInfo->memberName) : "";?>
                </span>
              </span>
        <?php   }
            // if(isset($currentUserInfo->groupName) ? $currentUserInfo->groupName : null != null){
            //   print_r($currentUserInfo->groupName);
            // }
            ?>
    	</a>
  	  <p class="text-capitalize"
         style="margin:0; font-size:18px; font-weight:500; padding:3px 0 0 10px; color: #707070;"
         user_id="<?php echo isset($currentUserInfo->memberid) ?  $currentUserInfo->memberid : (isset($currentUserInfo->groupid) ?  $currentUserInfo->groupid : "" ); ?>" 
         group="<?php echo isset($currentUserInfo->memberid) ?  'N' : (isset($currentUserInfo->groupid) ?  'Y' : "" ); ?>">
  		<?php 
        if($isGroupYN == "N")
          {
          if(isset($currentUserInfo->memberName)){
            echo $currentUserInfo->memberName;
          }}
          else{
            if(isset($currentUserInfo->groupName)){
              echo $currentUserInfo->groupName;
            }
          } 
        ?>
    	</p>
    </div>
          
    <div class="px-4 py-5 chat-box bg-light">
        <!-- Sender Message-->
		<?php
    $currentChat = json_decode($currentChat);
    $currentTextDate = "00-00-0000";
    if(isset($currentChat->chats)){
      foreach ($currentChat->chats as $chats) { 
        $date=date_create($chats->sentDateTime);
        if($currentTextDate == date('Y-m-d',strtotime($chats->sentDateTime))){

          }else{
            $currentTextDate = date('Y-m-d',strtotime($chats->sentDateTime));
            $dateNeedeFormat = date('d M Y',strtotime($currentTextDate));
            echo "<div class='currentTextDate_center'><span class='currentTextDate_centerbox'>$dateNeedeFormat</span></div>";
          }
        if($chats->transactiontype == 'TRANSACTIO'){
          echo "<div class='currentTextDate_center'><span class='currentTextDate_centerbox'>$chats->chatText</span></div>";
        }
        if($chats->transactiontype != 'TRANSACTIO'){
           ?>
        <div class="media 
                    <?php if( $this->session->userdata('LoginId') == $chats->senderId ){
                       echo "sender-rightalign"; 
                     }else{
                      echo "sender-leftalign";
        } ?>">
        <!--     <img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="30" class="rounded-circle"> -->
          <div class="
                <?php if( ($this->session->userdata('LoginId') == $chats->senderId) ){
                       echo "sender-right"; 
                     }
                     else{
                        echo "sender-left";
                     } ?>">
            <p class="text-small-chat mb-0 font-weight-bold">
               <!--  <a class="name-chat-box">
                  <?php 
                  if( $this->session->userdata('LoginId') == $chats->senderId ){
                    echo $this->session->userdata('Name');
                  }else{
                    echo ucfirst($chats->senderId);
                  }
                  ?>
                </a>  -->
               
            </p>
          <div class=" rounded ">
            <?php if($chats->isGroupYN == 'Y'){ ?>
              <span><?php 
                if($chats->senderId != $this->session->userdata('LoginId')){
                  echo $chats->senderName; 
                } ?>
              </span>
            <?php } ?>
            <p class="text-small-chat-message mb-0 ">
              <?php
                   echo $chats->chatText;
//                 try{
//               if(is_string($rsa->decrypt(base64_decode($chats->chatText))) == 1){
// $expression = "/(http|ftp|https):\/\/([\w_-]+(?:(?:\.[\w_-]+)+))([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/i";
// $string = $rsa->decrypt(base64_decode($chats->chatText));
//                 if(preg_match($expression,$string) == 1){
//                   echo '<img src="'.$string.'">';
//                 }elseif(preg_match('/data:image/i',$string) == 1){
//                   echo '<img src="'.$string.'">';
//                 }else{
//                   echo $string;
//                 }
//                 if($chats->mediaContent != null && $chats->mediaContent != ''){
//                   echo '<img src="data:image/png;base64,'.$chats->mediaContent.'">';
//                 }
//               } 
//               else{
//                 throw new Exception('Invalid Type');
//               }
//                 }
//                 catch(Exception $e){
//                     echo 'Not Known';
//                 }


                ?>
            </p>
            <small class=" chat-message-time"><?php echo date_format($date,"H:i");?></small>
          </div>
        </div>
      </div>
      <?php }}}?>	
        <!-- Reciever Message-->
        <!--<div class="media w-50 ml-auto mb-3">
          <div class="media-body">
            <div class="bg-primary rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
            </div>
            <p class="small text-muted">12:00 PM | Jan 17</p>
          </div>
        </div>-->

       

    </div>

      <!-- Typing area -->
    <!-- <form class="d-flex" id="chatForm" onsubmit="stopSubmit()"> -->
      <span class="attach_file">
        <!-- <img src="<?php echo site_url().'assets/images/icons/clip.png'; ?>" id="upload_attachment"> -->
        <input type="file" name="upload_image" id="upload_image" onchange="validate()">
      </span>
      <div class="input-group">
        <input type="text"
               id="chatText" 
               name="chatText" 
               placeholder="Type message here.."  
               class="form-control  bg-white">
        <div class="receiver_details">
          <input type="hidden" name="receiverId" id="receiverId" value="<?php echo $currentUserId;?>">
          <input type="hidden" name="isGroupYN" id="isGroupYN" value="<?php echo $isGroupYN;?>">
        </div>
        <div class="input-group-append">
            <!--<button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>-->
      		<button type="button" class="msg_send_btn" >
            <img src="<?php echo base_url('assets/images/icons/send.png') ?>" width="20px">   
          </button>
        </div>
      </div>
    <!-- </form> -->

    </div>
<!-- side nav start-->

  <div class="col-sm-12 col-md-3 right_box">
    <div class="right_top_tab">
      <span class="right_top_tab_close">
        <img src="<?php echo base_url('assets/images/icons/x.png') ?>" alt="Close Icon">
      </span>
      <span class="right_top_tab_info"></span>
    </div>
    <div class="right_user_icon">
      <div class="user_icon_wrapper">
        <span class="user_icon_view">

          <?php 
          if(isset($currentUserInfo)){
          if($currentUserInfo->avatarUrl != null && $currentUserInfo->avatarUrl != ""){ ?>
          <img src="<?php echo base_url('assets/images/icons/user.png') ?>">
        <?php }if($currentUserInfo->avatarUrl == null || $currentUserInfo->avatarUrl == ""){ ?>
          <span class="alphabetIcon">
            <?php 
            if(isset($currentUserInfo->avatarUrl) && ($currentUserInfo->avatarUrl != "")){}
              else{
                  if($isGroupYN == "N")
                    {
                      if(isset($currentUserInfo->memberName)){
                         echo icon($currentUserInfo->memberName);
                      }
                    }
                  else{
                    if(isset($currentUserInfo->groupName)){
                       echo icon($currentUserInfo->groupName);
                    }
                  } 
                }
             ?>
          </span>
          <?php } }?>
        </span>
      </div>
      <div class="user_name_wrapper">
        <span class="user_name_view">
            <?php if($isGroupYN == "N")
                    {
                      if(isset($currentUserInfo->memberName)){
                         echo ($currentUserInfo->memberName);
                      }
                    }
                  else{
                    if(isset($currentUserInfo->groupName)){
                       echo ($currentUserInfo->groupName);
                    }
                  } ?>
        </span>
        <span class="user_title_view">
            <?php if($isGroupYN == "N")
                    {
                      if(isset($currentUserInfo->designation)){
                         echo ($currentUserInfo->designation);
                      }
                    }
                  else{
                    if(isset($currentUserInfo->designation)){
                       echo ($currentUserInfo->designation);
                    }
                  } ?>
        </span>
      </div>
    </div>
    <?php if((isset($currentUserInfo->groups) && count($currentUserInfo->groups) > 0) || (isset($currentUserInfo->members)) && count($currentUserInfo->members) > 0 ) { ?>
    <div class="boxcategory">
      <span class="boxcategoryTitle">
        <?php if((isset($currentUserInfo->groups) && count($currentUserInfo->groups) > 0)){
              echo "Common Groups";
        }
              if(isset($currentUserInfo->members) && count($currentUserInfo->members) > 0 ){
              echo "Members";
              }?>
      </span>
      <div class="boxcategory_wrapper">
        <?php 
      if((isset($currentUserInfo->groups) && count($currentUserInfo->groups) > 0)){
        foreach($currentUserInfo->groups as $commongroup){ ?>
        <span class="commonGroups_wrapper" >
          <span class="commonGroups_userIcon">
            <span class=" icon" style="
              <?php echo "background:".$colors_array[rand(0,5)]?>">
              <?php echo isset($commongroup->groupName) ? icon($commongroup->groupName) : "";?>
            </span>
          </span>
          <span class="commonGroups_tile">
            <span class="commonGroups_text">
              <div class="commonGroups_text_top">
                <span class="commonGroups_title"><?php 
                  if( strlen($commongroup->groupName) > 16){
                    echo substr($commongroup->groupName,0,17)."..";
                  }
                  else{
                   echo $commongroup->groupName;
                  }
                     ?></span>
              </div>
            </span>
          </span>
        </span>
          <!-- ---------- -->
<!--         <span class="elementOfCategory">
          <span class="elementIcon">
            <span class="elementIconView"><?php echo $commongroup->groupName ?></span>
          </span>
          <span class="elementDescription">
            <span class="elementText"></span>
          </span>
        </span> -->
      <?php } } ?>
        <?php 
      if((isset($currentUserInfo->members) && count($currentUserInfo->members) > 0)){
        foreach($currentUserInfo->members as $members){ ?>
          <span class="groupMembers_wrapper" >
            <span class="groupMembers_userIcon">
              <span class=" icon" style="
                <?php echo "background:".$colors_array[rand(0,5)]?>">
                <?php echo isset($members->memberName) ? icon($members->memberName) : "";?>
              </span>
            </span>
            <span class="groupMembers_tile">
              <span class="groupMembers_text">
                <div class="groupMembers_text_top">
                  <span class="groupMembers_title"><?php 
                    if( strlen($members->memberName) > 16){
                      echo substr($members->memberName,0,17)."..";
                    }
                    else{
                     echo $members->memberName;
                    }
                       ?></span>
                </div>
              </span>
            </span>
          </span>
<!--           <span class="angle_downward">
            <span>
              <i>
                <img src="<?php echo base_url('assets/images/icons/angle_downward.png');?>" width="15px" height="15px">
              </i>
            </span>
            <span style="" class="remove_user_block">
              Remove
            </span>
          </span> -->
      <?php } } ?>
      </div>
    </div>
    <?php } ?>
    <?php if($isGroupYN == "Y"){ ?>
    <div class="groupOptions">
        <?php if(($currentUserInfo->adminId) == ($this->session->userdata('LoginId'))){ ?>
      <div>
        <span class="delete_group" groupId="<?php echo $currentUserInfo->groupid ?>">Delete Group</span>
      </div>
    <?php } ?>
      <?php if(($currentUserInfo->adminId) != ($this->session->userdata('LoginId'))){ ?>
    <div>
      <span class="leave_group" groupId="<?php echo $currentUserInfo->groupid ?>" userId="<?php echo  $members->memberid ?>" onclick="leaveGroup('<?php echo $currentUserInfo->groupid ?>')">Leave Group</span>
    </div>
  <?php } ?>
    </div>
  <?php } ?>
  </div>

<!-- side nav end-->
  </div>
</div>





		<!-- add to group model -->
			<div class="modal fade" id="addtogroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
						  <div class="modal-header" style="border-bottom:none;">
							<h5 class="modal-title" id="exampleModalLongTitle" style="color: #2196f3;">Add New Group</h5>
					  </div>
					<div class="modal-body">
					  <div class="container-fluid">
						<form id="groupForm" method="post" action="<?php echo base_url().'messenger/creategroup';?>">
						  <div class="form-group">
						  <div class="row">
						 
							 <div class="col-md-4"><label for="recipient-name" class="col-form-label"  style="float:right;">Group Name</label></div>
							 <div class="col-md-8" style="float:left;">
                <input type="text" class="form-control" name="recipient-name" id="recipient-name" required style="border-radius:0;background-color:#fff;border:none;">
							  <div class="col-md-12" style="color: red;" id="groupNameErr"></div>
							 </div>
						  </div>
						  </div>
						  <hr>
						  <div class="search-table">

			<div class="search-list">
        <select class="tokenize_class" name="tokenize_class[]" multiple>
					<?php
                     foreach ($allUsers->users as $chat) {
                      if($chat->imageUrl == null || $chat->imageUrl == ""){
                        $chat->imageUrl = base_url().'assets/images/defaultUser.png';
                      }else{}
                    ?>					
                      <option value="<?php echo $chat->userid; ?>"><?php echo $chat->username;?></option>
                  <?php } ?>
        </select>
                </div>
					<?php 	?>

            </div>
						  </div>
						  
					<div class="text-center mt-2 mb-4">
						<button class="btn btn-secondary rounded-0 button" type="button" onclick="saveGroup()">Save</button>
						<button class="btn btn-secondary rounded-0 button" type="button" data-dismiss="modal">Cancel</button> 
					</div> 
						  
						</form>
					  </div>
					  
					</div>
					
						  
						  
						</div>
					  </div>
				</div>
		<!-- add to group model end -->

  <div class="modal-logout">
    <div class="modal-content-logout">
      <h3>You have been logged out!!</h3>
      <h4><a href="<?php echo base_url(); ?>">Click here</a> to login</h4>      
    </div>
  </div>
<!-- User Modal -->
<div id="usersModal" class="usersModal">
  <div class="usersModalContent">
    <h1>Users</h1>
    <div>
      <?php foreach($allUsers->users as $user_){ ?>
        <span class="d-block" onclick="loadNewChat('<?php echo $user_->userid ?>','N')"><?php echo $user_->username; ?></span>
      <?php } ?>
    </div>
    <button id="accept" class="user__">
      Close
    </button>
  </div>
</div>
<!-- User Modal -->

</body>

<script type="text/javascript">
var usersModal = document.getElementsByClassName('recentchat')[0];
var btn = document.getElementById("myBtn");
var accept = $('.searchbar_back')[0];
var newGroup = $('.addgroup')[0]
btn.onclick = function() {
  usersModal.style.display = "none";
  $('.searchbar_back').css('display','inline-block')
  $('.searchbar').css('justify-content','space-around')
  $('.groupNameClass').css('display','none')
  $('.createGroupUsersList').css('display','none')
  $('.createGroupClass').css('display','none')
  $('.allUsersList').css('display','block')
}
accept.onclick = function() {
  usersModal.style.display = "block";
  $('.searchbar_back').css('display','none')
  $('.searchbar').css('justify-content','center');
  $('.groupNameClass').css('display','none')
  $('.createGroupUsersList').css('display','none')
  $('.createGroupClass').css('display','none')
}
newGroup.onclick = function(){
  usersModal.style.display = "none";
  $('.allUsersList').css('display','none')
  $('.groupNameClass').css('display','inline-block')
  $('.createGroupUsersList').css('display','inline-block')
  $('.createGroupClass').css('display','flex')
  $('.searchbar_back').css('display','inline-block')
  $('.searchbar').css('justify-content','space-around');
}
  // height , width of the container
  $(document).ready(()=>{
    $('.container').css('paddingLeft',$('.side-nav').width());
    var containerHeight = "100vh" - $('.header-top').height();
   // document.getElementsByClassName("container").style.maxHeight = "50vh"
  })
</script>
<script>
	
	// dropdowns
		
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

	//side bar open close
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

	//upload image
	$("input[type='image']").click(function() {
		$("input[id='my_file']").click();
	});
	
	//inline edit group name
$('.edit').click(function(){
  $(this).hide();
  $('.editbox').addClass('editable');
  $('.text').attr('contenteditable', 'true');  
  $('.save').show();
});

$('.save').click(function(){
  $(this).hide();
  $('.editbox').removeClass('editable');
  $('.text').removeAttr('contenteditable');
  $('.edit').show();
});
	
	</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.list-group-item',function(){
      $('.leftbar-sm').css('display','none');
    })
  })

  $(document).on('click','.angle_downward',function(){
    $('.remove_user_block').eq($(this).index()).css('display','block');
  })
</script>
  <script type="text/javascript">
    var base_url = "<?php echo base_url();?>";
    function loadNewChat(userid,isGroupYN){
        var url = window.location.origin+'/PN101/messenger/chats/'+userid+'/'+isGroupYN;
        $.ajax({
          url : url,
          type : 'GET',
          success : function(response){
            // $('.messenger_center_box').htm l($(response).find('.messenger_center_box').html())
            // $('.right_box').html($(response).find('.right_box').html())
            // $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight)
            console.log('changed')
            $('.media.headind_srchs').html($(response).find('.media.headind_srchs').html())
            $('.chat-box').html($(response).find('.chat-box').html())
            $('.recentchat').html($(response).find('.recentchat').html())
            $('.receiver_details').html($(response).find('.receiver_details').html())
          }
        })
    }

    $(document).ready(function(){
        var arr =[];
        var uiArr = [];
      $(document).on('click','.createGroupUsersList_wrapper',function(){
        uiArr.push($(this).index());
        console.log($('.createGroupUsersList_wrapper').eq($(this).index()).css('background'))
        if($('.createGroupUsersList_wrapper').eq($(this).index()).css('background') == 'rgb(247, 245, 245) none repeat scroll 0% 0% / auto padding-box border-box' || $('.createGroupUsersList_wrapper').eq($(this).index()).css('background') == 'rgb(255, 255, 255) none repeat scroll 0% 0% / auto padding-box border-box'){
          $('.createGroupUsersList_wrapper').eq($(this).index()).css('background','#e3e4e7');
                  
        }else{
          $('.createGroupUsersList_wrapper').eq($(this).index()).css('background','rgb(255, 255, 255) none repeat scroll 0% 0% / auto padding-box border-box')
        }
        if(arr.includes($(this).attr('userid')) ===  false){
          arr.push($(this).attr('userid'));
          console.log(arr)
          return 0;
        }
        if(arr.includes($(this).attr('userid')) ===  true){
          arr.splice(arr.indexOf($(this).attr('userid')),1);
          console.log(arr)
          return 0;
        }

      })
      $(document).on('click','.createGroupClass_wrapper',function(){
        var url = window.location.origin + '/PN101/messenger/creategroup';
        var groupName = $('.groupNameInput').val();
        $.ajax({
          url : url,
          data : {
            recipient_name : groupName,
            tokenize_class : arr
          },
          type : 'POST',
          success : function(response){
            window.location.reload();
          }
        })
      })
    })

    $(document).on('click','.right_top_tab_close',function(){
      $('.messenger_center_box')[0].classList.remove('col-md-6');
      $('.right_box').css('display','none');
      $('.messenger_center_box')[0].classList.add('col-md-9');
    })

    $(document).on('click','.text-capitalize, .contact_us',function(){
      $('.messenger_center_box')[0].classList.remove('col-md-9');
      $('.right_box').css('display','block');
      $('.messenger_center_box')[0].classList.add('col-md-6');
    })


    $(document).on('click','.recentchat_wrapper',function(){
      var userId = $(this).attr('id');
      var isGroupYN = $(this).attr('group');
      var url = window.location.origin+'/PN101/messenger/chats/'+userId+'/'+isGroupYN;
      $.ajax({
        url : url,
        type : 'GET',
        success : function(response){
          $('.messenger_center_box').html($(response).find('.messenger_center_box').html())
          $('.right_box').html($(response).find('.right_box').html())
          $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight)
        }
      })
    })

    function searchRecentChats(){
      var chats = $('.recentchat_title').length;
      var allUsers = $('.allUsersList_title').length;
      var allGroupUsers = $('.createGroupUsersList_title').length;
      var searchText = $('.searchinput').val();
      for(var i=0;i<chats;i++ ){
          if ( ($('.recentchat_title').eq(i).text().search(new RegExp(searchText, "i")) < 0)) {
              $('.recentchat_wrapper').eq(i).fadeOut();
           } else {
              $('.recentchat_wrapper').eq(i).show();
          }
      }
      for(var j=0;j<allUsers;j++ ){
          if ( ($('.allUsersList_title').eq(j).text().search(new RegExp(searchText, "i")) < 0)) {
              $('.allUsersList_wrapper').eq(j).fadeOut();
           } else {
              $('.allUsersList_wrapper').eq(j).show();
          }
      }
      for(var k=0;k<allGroupUsers;k++ ){
          if ( ($('.createGroupUsersList_title').eq(k).text().search(new RegExp(searchText, "i")) < 0)) {
              $('.createGroupUsersList_wrapper').eq(k).fadeOut();
           } else {
              $('.createGroupUsersList_wrapper').eq(k).show();
          }
      }
    }
    $(document).on('keyup','.searchinput',function(){
      searchRecentChats()
    })

    $(document).on('click','.msg_send_btn',function(e){
      e.preventDefault();
      var url = "<?php echo base_url().'messenger/postNewMessage';?>";
      var receiverId = $('#receiverId').val();
      var isGroupYN = $('#isGroupYN').val();
      var chatText = $('#chatText').val();
      var image = $('#upload_image')[0].files[0];
      var form_data = new FormData();
      form_data.append('upload_image',image);
            var date = new Date();
            var code = `<div class="media sender-rightalign">
                          <div class="sender-right">
                            <div class=" rounded ">
                              <p class="text-small-chat-message mb-0 ">${chatText}</p>
                              <small class=" chat-message-time">${date.getHours()}:${date.getMinutes()}</small>
                            </div>
                          </div>
                        </div>`
                        $('.chat-box').append(code)
                   $('#chatText').val('')  
      // if(image != "" && image != null){
      //   $.ajax({
      //     url : url,
      //     contentType: false,
      //     processData: false,
      //     data : form_data,
      //     type : 'POST',
      //     success : function(response){
      //       console.log(response)
      //       var date = new Date();
      //       var code = `<div class="media sender-rightalign">
      //                     <div class="sender-right">
      //                       <div class=" rounded ">
      //                         <p class="text-small-chat-message mb-0 ">${image}</p>
      //                         <small class=" chat-message-time">${date.getHours()}:${date.getMinutes()}</small>
      //                       </div>
      //                     </div>
      //                   </div>`
      //                   $('.chat-box').append(code)
      //              $('#chatText').val('')   
      //     }
      //   })
      // }
      if(chatText != "" && chatText != null){
        $.ajax({
          method : 'POST',
          url : url,
          data : {
            receiverId : receiverId,
            isGroupYN : isGroupYN,
            chatText : chatText
          },
          success : function(response){
            // console.log(response)
 
          }
        })
      }
    })
      /*
      ----------------LEAVE GROUP-------------------
      */
    function leaveGroup(groupId){
      var bool = confirm('Are you sure you want to leave this group?');
      if(bool == true){
        var groupId = groupId;
        var isGroupYN = 'Y';
        var url = window.location.origin+'/PN101/messenger/exitGroup';
        $.ajax({
          url : url,
          data : {
            groupId:groupId
          },
          type : 'POST',
          success : function(response){
            console.log(response)
            window.location.reload()
          }
        })
      }
    }

    function loadChatElements(){
      var userId = $('.text-capitalize').attr('user_id')
      var isGroupYN = $('.text-capitalize').attr('group')
      var url = window.location.origin+'/PN101/messenger/chats/'+userId+'/'+isGroupYN;
      $.ajax({
        url : url,
        type : 'GET',
        success : function(response){
          // $('.messenger_center_box').html($(response).find('.messenger_center_box').html())
          // $('.right_box').html($(response).find('.right_box').html())
          // $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight)
          console.log('changed')
          $('.media.headind_srchs').html($(response).find('.media.headind_srchs').html())
          $('.chat-box').html($(response).find('.chat-box').html())
          $('.recentchat').html($(response).find('.recentchat').html())
          $('.receiver_details').html($(response).find('.receiver_details').html())
          searchRecentChats()
        }
      })
    }

    $(document).ready(function(){
      setInterval(loadChatElements,5000)
    })

    function saveGroup(){
      var groupName = document.getElementById("recipient-name").value;
      if(groupName == ""){
        document.getElementById("groupNameErr").innerHTML = "Group name required <i class='fas fa-exclamation-triangle' style='font-size:13px;'></i>";
      }
      else{
        document.getElementById("groupForm").submit();
      }
    }

    function exitGroup(){
      document.getElementById("exitGroupForm").submit();
    }

    function deleteGroup(){
      document.getElementById("deleteGroupForm").submit();
    }

    function sendMessage(){
      var text = document.getElementById("chatText").value;
      if(text != "" || $('#upload_image')[0].files[0].name != ""){
        document.getElementById("chatForm").submit();
      }
    }

    $(document).ready(function(){
      $(document).on('click','.delete_group',function(){
        var url = '<?php echo base_url('messenger/deleteGroup') ?>';
        var userid = '<?php echo $this->session->userdata('LoginId'); ?>';
        var groupId = $(this).attr('groupId');
        var bool = confirm(' Are you sure you want to delete this group ?')
        if(bool){
        $.ajax({
            url : url,
            data : {
              groupId : groupId,
              userid : userid
            },
            type : 'POST',
            success : function(response){
              loadChatElements()
            }
          })
        }
      })
    })
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
  function validate(){
    var fileType = $('#upload_image').val();
    var allowedTypes = /(\.jpg)$|(\.jpeg)$|(\.png)$/i;
    if(!allowedTypes.exec(fileType)){
      $('#upload_image').val(''); 
      alert('Please choose from Jpeg | Jpg |PNG')
      return false;
    }
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.tokenize_class').tokenize2();
  })
</script>
    </html>






/* Sorted flag modal*/
	.flag_textarea{
		height: 60%;
    width: 80%;
    border-radius: 1rem;
    background: #F3F4F7;
    border: 1px solid #D2D0D0;
    padding: 0.5rem;
	}
	.flag_textarea::placeholder{
    text-align: center;
    padding-top: 20%;
	}
	#flag_modal{
	  width: 100%;
	  height: 100%;
	  background: transparent;
	  position: absolute;
	  display: flex;
	  justify-content: center;
	  align-items: center;
	  top: 0;
	  left: 0;
	  display: none;
	}
	.flag_modal_heading{
	  height: 15%;
	  background: #8D91AA;
	  display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1rem;
    color: #E7E7E7;
	}
	.flag_modal{
	  width: 30%;
	  height: 70%;
	  box-shadow: 0 0 0.5rem 0.5rem rgba(0,0,0,0.1)
	}
	.flag_buttons{
		display: flex;
		justify-content: center;
		align-items: center;
		height: 15%;
	}
	.flag_body{
	  height: 70%;
	  background: #fff;
	  display: flex;
    justify-content: center;
    align-items: center;
	}
/* Sorted flag modal*/


<div id="flag_modal">
    <span class="flag_modal">
      <div class="flag_modal_heading">Flagged</div>
      <div class="flag_body">
      	<textarea class="flag_textarea" placeholder="Enter reason for flagging"></textarea>
      </div>
      <div class="flag_buttons">
          <button onclick="closes()" id="flag_modal_close" class="button">
            <i>
              <img src="<?php echo base_url('assets/images/icons/x.png'); ?>" style="max-height:1rem;margin-right:10px">
            </i>Close</button>
          <button  id="flag_modal_save" class="button">
            <i>
              <img src="<?php echo base_url('assets/images/icons/flag.png'); ?>" style="max-height:1.3rem;margin-right:10px">
            </i>Flag</button>
      </div>
    </span>
</div>


<script type="text/javascript">
	function flag(timesheetid,userid){
		var docs = document.getElementById('flag_modal');
		var selector = document.getElementById('flag_modal_save');
			selector.setAttribute("timesheetid",timesheetid);
			selector.setAttribute("userid",userid);
	  docs.style.display = "flex"
	}
	function closes(){
		var selector = document.getElementById('flag_modal_save');
			selector.removeAttribute('timesheetid');
			selector.removeAttribute('userid');
		var docss = document.getElementById('flag_modal');
	  docss.style.display = "none"
	}
</script>
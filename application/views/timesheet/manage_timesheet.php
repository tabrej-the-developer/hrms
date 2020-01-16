<!doctype html>
<html>
<head>
<title>Timesheet</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  
  
<?php $this->load->view('header'); ?>

  <style>
  td, th {
    text-align: center;
}

mark{
    background: orange;
    color: black;
    padding: 0;
}
  </style>
  
  <script>
  
	//--> jquery-searchable setup
$(function () {
    $( '#roster-table' ).searchable({
        striped         :   true,
        oddRow          :   { 'background-color': '#ccc' },
        evenRow         :   { 'background-color': '#ccc' }
    });
});

//--> show\hide full names
$(document).ready(function(){
    $('#hideNames').hide();
    
    $('#showNames').click(function(){
        $('#showNames').hide();
        $('#hideNames').show();
        $('.fullName').removeClass('hidden');
        $('.initials').addClass('hidden');
    });
    $('#hideNames').click(function(){
        $('#hideNames').hide();
        $('#showNames').show();
        $('.fullName').addClass('hidden');
        $('.initials').removeClass('hidden');
    });
    
    $('[data-toggle="tooltip"]').tooltip(); 
});

//--> mark.js setup
$(function() {
  var mark = function() {
    var keyword = $("input[name='search']").val();

    var options = {};
    $("input[name='opt[]']").each(function() {
      options[$(this).val()] = $(this).is(":checked");
    });

    $(".context").unmark({
      done: function() {
        $(".context").mark(keyword, options);
      }
    });
  };

  $("input[name='search']").on("input", mark);
  //$("input[type='checkbox']").on("change", mark);

  </script>
  </head>
  <body>
  <div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Location</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php //echo site_url('roster/roster1') ?>">Timesheets</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?php echo site_url('timesheet/open_timesheet') ?>">Open Timesheet</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Timesheet</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
    <br />
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered" id="roster-table">
                <thead>
                    <tr class="bg-primary">
                        <th style="width: 180px; text-align: left;">by
						<select>
							<option value="">choose</option>
							<option value="mr">mr</option>
							<option value="ms">ms</option>
							<option value="dr">dr</option>
						</select>
						</th>
                        <th>Mon 01/01/2020</th>
                        <th>Tues 02/01/2020</th>
                        <th>Wed 03/01/2020</th>
                        <th>Thurs 04/01/2020</th>
                        <th>Fri 05/01/2020</th>
                        <th>sat 06/01/2020</th>
                        <th>sun 07/01/2020</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="context">
                    <tr>
                        <td class="info" style="text-align: left;">Pos:Manager <br>Employment type: full time<br>code: BD558</td>
                        <td>
                           <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
						<td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
						<td>
                            <a href="#"><i class="fas fa-cogs"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="info" style="text-align: left;">POS:tutor <br>Employment type:full time</br>code:HD454 </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
						<td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                             <span class="hidden fullName"></span>
                        </td>
						<td>
                            <a href="#"><i class="fas fa-cogs"></i></a>
                        </td>
                    </tr>
                    <tr>
                       <td class="info" style="text-align: left;">POS: Admin <br>Employment type:full time</br>code:KJ45 </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                           <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
						<td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
						<td>
                            <a href="#"><i class="fas fa-cogs"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
        </div>
    </div>
</div>

</body>
</html>
<!doctype html>
<html>
<head>
<title>Roster</title>
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
                    <li class="breadcrumb-item" aria-current="page"><a href="<?php echo site_url('roster/roster1') ?>">Rosters</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Rosters</li>
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
                        <th>Mon</th>
                        <th>Tues</th>
                        <th>Wed</th>
                        <th>Thurs</th>
                        <th>Fri</th>
                        <th>sat</th>
                        <th>sun</th>
                    </tr>
                </thead>
                <tbody class="context">
                    <tr>
                        <td class="info" style="text-align: left;">Pos:Manager <br>Employment type: full time<br>code: BD558</td>
                        <td>
                            <span data-toggle="tooltip" data-placement="right" title="Robert Clarke" class="initials">RC </span>
                            <span class="hidden fullName">Robert Clarke <i class="fas fa-pencil-alt" style="color:red;"></i></span>
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
                            <span data-toggle="tooltip" data-placement="right" title="Lora Medoro" class="initials">LM </span>
                            <span class="hidden fullName">Lora Medoro <i class="fas fa-pencil-alt" style="color:red;"></i></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="info" style="text-align: left;">POS:tutor <br>Employment type:full time</br>code:HD454 </td>
                        <td>
                            <span data-toggle="tooltip" data-placement="right" title="Sanjay Dhupelia" class="initials">SD </span>
                            <span class="hidden fullName">Sanjay Dhupelia <i class="fas fa-pencil-alt" style="color:red;"></i></span>
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
                            <span data-toggle="tooltip" data-placement="right" title="Todd Staria" class="initials">TXS </span>
                            <span class="hidden fullName">Todd Staria <i class="fas fa-pencil-alt" style="color:red;"></i></span>
                        </td>
                    </tr>
                    <tr>
                       <td class="info" style="text-align: left;">POS: Admin <br>Employment type:full time</br>code:KJ45 </td>
                        <td>
                            <span class="hidden fullName"></span>
                        </td>
                        <td>
                            <span data-toggle="tooltip" data-placement="right" title="Thomas Martin" class="initials">TWM </span>
                            <span class="hidden fullName">Thomas Martin <i class="fas fa-pencil-alt" style="color:red;"></i></span>
                        </td>
                        <td>
                            <span data-toggle="tooltip" data-placement="right" title="Lora Medoro" class="initials">LM </span>
                            <span class="hidden fullName">Lora Medoro <i class="fas fa-pencil-alt" style="color:red;"></i></span>
                        </td>
                        <td>
                            <span data-toggle="tooltip" data-placement="right" title="Sunil Kaniyur" class="initials">SXK </span>
                            <span class="hidden fullName">Sunil Kaniyur <i class="fas fa-pencil-alt" style="color:red;"></i></span>
                        </td>
                        <td>
                            <span data-toggle="tooltip" data-placement="right" title="Piyoosh Kotecha" class="initials">PK </span>
                            <span class="hidden fullName">Piyoosh Kotecha <i class="fas fa-pencil-alt" style="color:red;"></i></span>
                        </td>
						<td>
                            <span data-toggle="tooltip" data-placement="right" title="Sunil Kaniyur" class="initials">SXK </span>
                            <span class="hidden fullName">Sunil Kaniyur <i class="fas fa-pencil-alt" style="color:red;"></i></span>
                        </td>
                        <td>
                            <span data-toggle="tooltip" data-placement="right" title="Piyoosh Kotecha" class="initials">PK </span>
                            <span class="hidden fullName">Piyoosh Kotecha <i class="fas fa-pencil-alt" style="color:red;"></i></span>
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
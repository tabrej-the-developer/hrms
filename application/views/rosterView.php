<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('header'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Roster</title>
	<link href="https//:maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https//:maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https//:cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style type="text/css">
		thead{
			background:rgba(0,0,0,0.2);
		}
		tr:nth-child(even){
			background:rgba(0,0,0,0.3);
		}
		.table-div{
			height:70vh;
			box-shadow:0px 0px 5px 5px rgb(242, 242, 242);
		}	
		.sort-by{

		}
		.center-list{
			display:none;
			box-shadow:0 0 1px 1px rgb(242, 242, 242) ;
		}
		.center-list a{
			display:block;
			position: relative;
			text-decoration: none;
			color:black;			
		}
		.sort-by:hover .center-list{
			display:block;
			background:white;
			position:absolute;
			margin-top:5px;
			margin-left:-15px;
			padding:10px;
		}
		.sort-by:hover::after{
			position:absolute;
						
		}

		.filter-icon{
			border:3px solid rgb(242, 242, 242);
			padding:8px;
			border-radius: 20px
		}
		.create{
			border:3px solid rgb(242, 242, 242);
			border-radius: 20px;
			padding:8px;
		}
		.data-buttons{
			padding:10px;
		}

</style>
</head>
<body>
<div class="container">
	<div class="d-flex">
		<span class="m-3" style="font-size: 30px;font-weight: bold">Rosters</span>
		<span class="btn sort-by m-3 ">
			<div class="filter-icon row">
				<span class="col">Sort&nbsp;by</span>
				<span class="col"><img src="../assets/images/filter-icon.png" height="20px"></span>
			</div>
				<div class="center-list " id="center-list">
						<?php $centers = json_decode($centers);
						
						for($i=0;$i<count($centers->centers);$i++){
					?>
					<a href="javascript:void(0)" class="center-class" id="<?php echo $i;?>">Center <?php echo $i+1?></a>
				<?php } ?>
				</div>
		</span>
		<span class="btn ml-auto d-flex align-self-center create"><span style="margin:0 10px 0 10px"><img src="../assets/images/plus.png" ></span>Create&nbsp;new&nbsp;roster</span>
	</div>
	<div class="table-div">
		<table class="table">
			<thead>
				<th>S.No</th>
				<th>Roster Name</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Status</th>
			</thead>
			<tbody id="tbody">
				
			</tbody>
		</table>
		
	</div>
	<div>
	<div class="d-flex data-buttons">
		<span class="ml-auto ">Viewing <span id="page-start">1</span>-<span id="page-end">8</span> of <span id="data-total">1</span></span>
		<span><b><</b><b>></b></span>
	</div>
</div>
</div>
<?php $userId = json_decode($userId); ?>
<script type="text/javascript">
	<?php $rosters = json_encode($rosters);?>
	
	var rosters = JSON.parse(<?php echo $rosters?>);
	var dataSize = rosters['rosters'].length;
	var dataPerPage = 10;
	var pageNumber = 1;
	$(document).ready(function(){
		changePage(1)
	})

	function nextPage(pageNumber){
		if(pageNumber< totalPages()){
			pageNumber++;
			changePage(pageNumber);
			}
	}

	function previousPage(pageNumber){
		if(pageNumber > 1){
			pageNumber--;
			changePage(pageNumber);
			}
	}

	function changePage(pageNumber){
		var tBody = document.getElementById('tbody')
		var dataSno = document.getElementById('data-sno')
		var dataName = document.getElementById('data-name')
		var dataStartDate = document.getElementById('data-start-date')
		var dataEndDate = document.getElementById('data-end-date')
		var dataStatus = document.getElementById('data-status')
		tBody.innerHTML = "";
		   for (var i = (pageNumber-1) * dataPerPage; i < (pageNumber * dataPerPage) && i < (dataSize); i++) {
        tBody.innerHTML = tBody.innerHTML +"<tr><td>"+(i+1)+"</td>"+"<td>"+rosters['rosters'][i]['id']+"</td><td>"+ rosters['rosters'][i]['startDate'] +"</td>"+"<td>"+ rosters['rosters'][i]['endDate'] +"</td>"+"<td>"+ rosters['rosters'][i]['status'] +"</td>"+"</tr>"+ "<br>";
    }
    	document.getElementById('page-start').innerHTML = i;
    document.getElementById('page-end').innerHTML = pageNumber * dataPerPage;
    document.getElementById('data-total').innerHTML = dataSize;
	}

	function totalPages(){
		var totalPages = Math.ceil(dataSize/dataPerPage);
		return totalPages;
	}
	
	
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.center-class',function(){
			var id = $(this).prop('id');
		var url = "http://localhost/PN101/roster/roster_dashboard/"+id;
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				$('body').html(response);
				
			}
		});
	});
})
</script>
<script type="text/javascript">
	$(document).ready(function(){
			equalElements('sort-by','center-list');
		})
		function equalElements(original,toBeModified){
			var originalHeight = document.getElementsByClassName(original)[0].offsetHeight;
			var originalWidth = document.getElementsByClassName(original)[0].offsetWidth;
			var toBeModifiedWidth =document.getElementById(toBeModified);
			toBeModifiedWidth.style.width = originalWidth+"px";
		}
	
</script>
</body>
</html>
<!--<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.center-class',function(){
			var id = $(this).prop('id');
		var url = "http://localhost/PN101/roster/roster_dashboard/"+id;
		$.ajax({
			url:url,
			type:'GET',
			success:function(response){
				$('body').html(response);
				
			}
		}).fail(function(){
			alert('whyys')
		})
	})
		})
<tr>
<td><?php// $id+1 ?></td>
<td><?php $roster->roster[$i]->id ?></td>
<td><?php $roster->roster[$i]->startDate ?></td>
<td><?php $roster->roster[$i]->EndDate ?></td>
<td><?php $roster->roster[$i]->status ?></td>
</tr>
</script>-->
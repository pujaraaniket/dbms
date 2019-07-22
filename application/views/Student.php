<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>ICE</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155; 
    	background: url("<?php echo base_url().'assets/11.jpeg' ?>") no-repeat center center fixed;
	}

	h1 {
		color: #444; 
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}
 	
 	form{
 		padding: 30px 30px 30px 30px  ;
 	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	h2{
		text-decoration: underline #4b0082;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
		opacity: 0.95;
 		background-color: white;
	}
 

	.dropdown-toggle{
		background-color: white;
		color: black;
	}

	</style>
</head>
<body >

<div id="container" class="container-fluid">
	<h1>Welcome to <?php echo ICE; ?>!</h1>

	<div id="body">
		<!-- The tabs themselves -->
		<ul id="myTab" class="nav nav-tabs">
		  <li class="nav-item " >
		    <a class="nav-link " id="searchCareers-tab" data-toggle="tab" href="#searchCareers">Search Careers</a>
		  </li>
		  <li class="nav-item active">
		    <a class="nav-link" id="searchEvents-tab" data-toggle="tab" href="#searchEvents">Search Events</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="seeCompanyStats-tab" data-toggle="tab" href="#seeCompanyStats">See Company Stats</a>
		  </li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
		  <div class="tab-pane" id="searchCareers">
		  	
		  	<br/>
			<i>Students can search for careers by Company, Location, Time OR all of them </i>
			<br/>
			<form class="form-group row" style="background: #f0f0f0;">
			  <div class="form-group col-xs-2">
			    <label for="">Company</label>
			    
			    <div class="dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="companySelect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Select Company <span class="caret"></span>
				  </button>
				  
				  	<ul class="dropdown-menu">
					  	<?php
					  	foreach($companyList as $c){
					  	?> 
					  		<li> <a href="#" class="dropdown-item" id="<?php echo $c['companyId'] ?>"><?php echo $c['companyName'] ?> </a></li> 
					  	<?php
					  	}
					  	?>
					 </ul> 
				  </div>
			  </div>
			  <div class="form-group col-xs-2">
			    <label for="location">Location</label>
			    <div class="dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="locationSelect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Select Location <span class="caret"></span>
				  </button>
				  
				  	<ul class="dropdown-menu">
					  	<?php
					  	foreach($locationList as $c){
					  	?> 
					  		<li> <a href="#" class="dropdown-item" id="<?php echo $c['city'].', '.$c['state'] ?>"><?php echo $c['city'].', '.$c['state'] ?> </a></li> 
					  	<?php
					  	}
					  	?>
					 </ul> 
				  </div>
			  </div>
			  <div class="form-group col-xs-2">
			    <label for="postedBefore">Posted Before</label>
			    <input type="text" class="form-control" id="postedBefore">
			  </div>
			  <div class="form-group col-xs-2">
			    <label for="postedAfter">Posted After</label>
			    <input type="text" class="form-control" id="postedAfter">
			  </div>
			  <div class="form-group col-xs-2">
			    <label for="submitCareerSearch"></label>
			    <br/>
			    <button id="submitCareerSearch" type="button"  class="btn btn-primary">Submit </button>
			  </div>
			</form>
			
			<h3 id="careerTableDivHeader" style="display: none;"> Results</h3>
			<div id="careerTableDiv" style="padding: 10px 10px 10px 10px;"></div>
		  </div>
		  <div class="tab-pane active" id="searchEvents">
		  	<br/>
			<i>Students can search for events by Event Name , Location, Time OR all of them </i>
			<br/>
			<form class="form-group row" style="background: #f0f0f0;">
			  <div class="form-group col-xs-2">
			    <label for="companySelectEvent">Event Name</label>
			    
			    <input class="form-control" type="text" id="companySelectEvent" aria-haspopup="true" aria-expanded="false"/>
				     
				
			  </div>
			  <div class="form-group col-xs-2">
			    <label for="locationEvent">Location</label>
			    <div class="dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="locationSelectEvent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Select Location <span class="caret"></span>
				  </button>
				  
				  	<ul class="dropdown-menu">
					  	<?php
					  	foreach($eventLocationList as $c){
					  	?> 
					  		<li> <a href="#" class="dropdown-item" id="<?php echo $c['eventLocation'] ;?>"><?php echo $c['eventLocation'] ;?> </a></li> 
					  	<?php
					  	}
					  	?>
					 </ul> 
				  </div>
			  </div>
			  <div class="form-group col-xs-2">
			    <label for="postedBeforeEvent">Posted Before</label>
			    <input type="text" class="form-control" id="postedBeforeEvent">
			  </div>
			  <div class="form-group col-xs-2">
			    <label for="postedAfterEvent">Posted After</label>
			    <input type="text" class="form-control" id="postedAfterEvent">
			  </div>
			  <div class="form-group col-xs-2">
			    <label for="submitEventSearch"></label>
			    <br/>
			    <button id="submitEventSearch" type="button"  class="btn btn-primary">Submit </button>
			  </div>
			</form>
			
			<h3 id="eventTableDivHeader" style="display: none;"> Results</h3>
			<div id="eventTableDiv" style="padding: 10px 10px 10px 10px;"></div>
		  </div>
		  <div class="tab-pane" id="seeCompanyStats">
		  		<br/>
				<i>Students can search companies that fellow students apply to from a university </i>
				<br/>
				<form class="form-group row" style="background: #f0f0f0;">
				  <div class="form-group col-xs-2">
				    <label for="">University</label>
				    
				    <div class="dropdown">
					  <button class="btn btn-secondary dropdown-toggle" type="button" id="universitySelect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Select University <span class="caret"></span>
					  </button>
					  
					  	<ul class="dropdown-menu">
						  	<?php 
						  	foreach($universityList as $c){
						  	?> 
						  		<li> <a href="#" class="dropdown-item" id="<?php echo $c['uniId'] ?>"><?php echo $c['uniName'] ?> </a></li> 
						  	<?php
						  	}
						  	?>
						 </ul> 
					  </div>
				  </div>
				  
				  <div class="form-group col-xs-2">
				    <label for="submitCompanyUniSearch"></label>
				    <br/>
				    <button id="submitCompanyUniSearch" type="button"  class="btn btn-primary">Submit </button>
				  </div>
				</form>
				
				<h3 id="companyUniChartDivHeader" style="display: none;" > Results</h3>
				<div class="col-xs-12">
					<div class="col-xs-3" id="companyUniChartDiv"></div>
					<div class="col-xs-1"></div>
					<div class="col-xs-8 " id="companyUniTableDiv"></div>
				</div>				
		  </div>		   
	</div>
</div>

</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script>
		google.charts.load('current', {'packages':['corechart']});

		var companySelect = "";
		var locationSelect = "";
		
		var companySelectEvent = "";
		var locationSelectEvent = "";
		
		var universitySelect = "";
		var universityName = "";

		$('#myTab a').on('click', function (e) {
		  e.preventDefault();
		  $(this).tab('show')
		});

		$(".dropdown-menu li a").click(function(){
		  var requestingId = $(this).parents(".dropdown").find('.btn').attr('id');
		  
		  $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"></span>');
		  $(this).parents(".dropdown").find('.btn').val($(this).data('value'));

		  if(requestingId=='companySelect'){
		  	companySelect = $(this).text();
		  }else if (requestingId=='locationSelect'){
			locationSelect = $(this).text();
		  }else if(requestingId == 'universitySelect'){

		  	universitySelect= $(this).attr('id');
		  	universityName = $(this).text();

		  }else if(requestingId=='locationSelectEvent'){
		  	locationSelectEvent = $(this).text();
		  }
		});

		$("#postedBefore").datepicker();
		$("#postedAfter").datepicker();
		$("#postedBeforeEvent").datepicker();
		$("#postedAfterEvent").datepicker();

		$('#submitCareerSearch').on('click', function (e) {
			
			$.ajax({

			    url : 'http://localhost/dbms0504_03/index.php/Student/get_search_results',
			    type : 'POST',
			    data : {
			        'companyName' : companySelect,
			        'companyLocation' : locationSelect,
			        'postedBefore' : $("#postedBefore").val(),
			        'postedAfter' : $("#postedAfter").val()
			    },
			    dataType:'json',
			    success : function(data) {              
			        
			        var table = document.createElement('table');
			        var thead = document.createElement('thead');

					var trHead = document.createElement('tr');

			        var th1 = document.createElement('th');
			        var th2 = document.createElement('th');
			        var th3 = document.createElement('th');
			        var th4 = document.createElement('th');
			        var th5 = document.createElement('th');
			        var th6 = document.createElement('th');
			        var th7 = document.createElement('th');
			        var th8 = document.createElement('th');
			        
			        th1.appendChild(document.createTextNode('Company'));
			        th2.appendChild(document.createTextNode('City, '+'State'));
			        th3.appendChild(document.createTextNode('Email'));
			        th4.appendChild(document.createTextNode('Position'));
			        th5.appendChild(document.createTextNode('Desc'));
			        th6.appendChild(document.createTextNode('Posting Date'));
			        th7.appendChild(document.createTextNode('Closing Date'));
			        th8.appendChild(document.createTextNode('Type'));
			        
			        trHead.appendChild(th1);
			        trHead.appendChild(th2);
			        trHead.appendChild(th3);
			        trHead.appendChild(th4);
			        trHead.appendChild(th5);
			        trHead.appendChild(th6);
			        trHead.appendChild(th7);
			        trHead.appendChild(th8);

			        thead.appendChild(trHead);
			        table.appendChild(thead);

			        var tbody = document.createElement('tbody');

					for (var i = 0; i < data.length; i++){
					    var tr = document.createElement('tr');   

					    var td1 = document.createElement('td');
					    var td2 = document.createElement('td');
					    var td3 = document.createElement('td');
					    var td4 = document.createElement('td');
					    var td5 = document.createElement('td');
					    var td6 = document.createElement('td');
					    var td7 = document.createElement('td');
					    var td8 = document.createElement('td');


					    var text1 = document.createTextNode(data[i]['companyName']);
					    var text2 = document.createTextNode(data[i]['city']+", "+data[i]['state']);
					    var text3 = document.createTextNode(data[i]['companyEmail']);
					    var text4 = document.createTextNode(data[i]['careerName']);
					    var text5 = document.createTextNode(data[i]['careerDescription']);
					    var text6 = document.createTextNode(data[i]['postingDate']);
					    var text7 = document.createTextNode(data[i]['closingDate']);
					    var text8 = document.createTextNode(data[i]['jobType']=='I'?'Internship':'Job');

					    td1.appendChild(text1);
					    td2.appendChild(text2);
					    td3.appendChild(text3);
					    td4.appendChild(text4);
					    td5.appendChild(text5);
					    td6.appendChild(text6);
					    td7.appendChild(text7);
					    td8.appendChild(text8);

					    tr.appendChild(td1);
					    tr.appendChild(td2);
					    tr.appendChild(td3);
					    tr.appendChild(td4);
					    tr.appendChild(td5);
					    tr.appendChild(td6);
					    tr.appendChild(td7);
					    tr.appendChild(td8);

					    tbody.appendChild(tr);
					    table.appendChild(tbody);
					}
					table.id="careerTable";
					$("#careerTableDiv").empty();
					$("#careerTableDiv").append(table);
					$('#careerTable').DataTable( );
					$('#careerTableDivHeader').css('display', 'block');

			    },
			    error : function(request,error)
			    {
			        alert("Request: "+JSON.stringify(request));
			    }
			});
		});

		$('#submitCompanyUniSearch').on('click', function (e) {
			
			$.ajax({

			    url : 'http://localhost/dbms0504_03/index.php/Student/get_company_uni_stats',
			    type : 'POST',
			    data : {
			        'uniId' : universitySelect,
			    },
			    dataType:'json',
			    success : function(data) {              
			        
			       drawChart(data);
			       buildCompanyUniTable(data);
			    },
			    error : function(request,error)
			    {
			        alert("Request: "+JSON.stringify(request));
			    }
			});
		});

		function drawChart(apiData) {

	        var data = new google.visualization.DataTable();
	        data.addColumn('string', 'Company Name');
		    data.addColumn('number', 'Num of Apps');
		      
	        for(var i = 0 ; i < apiData.length; i++){

		      data.addRows([
		        [apiData[i]['companyName'], apiData[i]['num']],
		      ]);
	        }

	        var chart = new google.visualization.PieChart(document.getElementById('companyUniChartDiv'));

	        var options = {'title': 'Students of '+universityName+' applied to these companies',
               'width': 350,
               'height': 400,
               'chartArea': {'width': '100%', 'height': '80%'},
               'legend': {'position': 'right'}
    		};

	        chart.draw(data, options);

      		$('#companyUniChartDiv').css('display', 'block');
      	}

      	function buildCompanyUniTable(data){
      		var table = document.createElement('table');
	        var thead = document.createElement('thead');

			var trHead = document.createElement('tr');

	        var th1 = document.createElement('th');
	        var th2 = document.createElement('th');
	        var th3 = document.createElement('th');
	        
	        th1.appendChild(document.createTextNode('Serial No'));
	        th2.appendChild(document.createTextNode('Company Name'));
	        th3.appendChild(document.createTextNode('Number of Apps'));
	        
	        trHead.appendChild(th1);
	        trHead.appendChild(th2);
	        trHead.appendChild(th3);

	        thead.appendChild(trHead);
	        table.appendChild(thead);

	        var tbody = document.createElement('tbody');

			for (var i = 0; i < data.length; i++){
			    var tr = document.createElement('tr');   

			    var td1 = document.createElement('td');
			    var td2 = document.createElement('td');
			    var td3 = document.createElement('td');

			    var text1 = document.createTextNode(i+1);
			    var text2 = document.createTextNode(data[i]['companyName']);
			    var text3 = document.createTextNode(data[i]['num']);

			    td1.appendChild(text1);
			    td2.appendChild(text2);
			    td3.appendChild(text3);

			    tr.appendChild(td1);
			    tr.appendChild(td2);
			    tr.appendChild(td3);

			    tbody.appendChild(tr);
			    table.appendChild(tbody);
			}
			table.id="companyUniTable";
			$("#companyUniTableDiv").empty();
			$("#companyUniTableDiv").append(table);
			$('#companyUniTable').DataTable( );
			$('#companyUniChartDivHeader').css('display', 'block');
      	}

      	$('#submitEventSearch').on('click', function(e){
      		
      		$.ajax({

			    url : 'http://localhost/dbms0504_03/index.php/Student/get_event_search_results',
			    type : 'POST',
			    data : {
			        'eventName' : $("#companySelectEvent").val(),
			        'eventLocation' : locationSelectEvent,
			        'postedBeforeEvent' : $("#postedBeforeEvent").val(),
			        'postedAfterEvent' : $("#postedAfterEvent").val()
			    },
			    dataType:'json',
			    success : function(data) {              
			        
			        var table = document.createElement('table');
			        var thead = document.createElement('thead');

					var trHead = document.createElement('tr');

			        var th1 = document.createElement('th');
			        var th2 = document.createElement('th');
			        var th3 = document.createElement('th');
			        var th4 = document.createElement('th');
			        var th5 = document.createElement('th');
			        var th6 = document.createElement('th');
			        var th7 = document.createElement('th');
			        var th8 = document.createElement('th');
			        
			        th1.appendChild(document.createTextNode('Company'));
			        th2.appendChild(document.createTextNode('Location'));
			        th3.appendChild(document.createTextNode('Email'));
			        th4.appendChild(document.createTextNode('Event Name'));
			        th5.appendChild(document.createTextNode('Desc'));
			        th6.appendChild(document.createTextNode('Event Time'));
			        th7.appendChild(document.createTextNode('Closing Date'));
			        
			        
			        trHead.appendChild(th1);
			        trHead.appendChild(th2);
			        trHead.appendChild(th3);
			        trHead.appendChild(th4);
			        trHead.appendChild(th5);
			        trHead.appendChild(th6);
			        trHead.appendChild(th7);
			        

			        thead.appendChild(trHead);
			        table.appendChild(thead);

			        var tbody = document.createElement('tbody');

					for (var i = 0; i < data.length; i++){
					    var tr = document.createElement('tr');   

					    var td1 = document.createElement('td');
					    var td2 = document.createElement('td');
					    var td3 = document.createElement('td');
					    var td4 = document.createElement('td');
					    var td5 = document.createElement('td');
					    var td6 = document.createElement('td');
					    var td7 = document.createElement('td');
					    

					    var text1 = document.createTextNode(data[i]['companyName']);
					    var text2 = document.createTextNode(data[i]['eventLocation']);
					    var text3 = document.createTextNode(data[i]['companyEmail']);
					    var text4 = document.createTextNode(data[i]['eventName']);
					    var text5 = document.createTextNode(data[i]['eventDescription']);
					    var text6 = document.createTextNode(data[i]['eventTime']);
					    var text7 = document.createTextNode(data[i]['closingDate']);
					    

					    td1.appendChild(text1);
					    td2.appendChild(text2);
					    td3.appendChild(text3);
					    td4.appendChild(text4);
					    td5.appendChild(text5);
					    td6.appendChild(text6);
					    td7.appendChild(text7);


					    tr.appendChild(td1);
					    tr.appendChild(td2);
					    tr.appendChild(td3);
					    tr.appendChild(td4);
					    tr.appendChild(td5);
					    tr.appendChild(td6);
					    tr.appendChild(td7);
					    

					    tbody.appendChild(tr);
					    table.appendChild(tbody);
					}
					table.id="eventTable";
					$("#eventTableDiv").empty();
					$("#eventTableDiv").append(table);
					$('#eventTable').DataTable( );
					$('#eventTableDivHeader').css('display', 'block');

			    },
			    error : function(request,error)
			    {
			        alert("Request: "+JSON.stringify(request));
			    }
			});
      	});
	</script>
</html>
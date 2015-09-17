<html>
  <head>
    <script type="text/javascript" 
src="https://www.google.com/jsapi"></script>
	<script 
src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">
	var temp_data = [['Uhrzeit', 'Temp 1', 'Temp 2'],<?php include("temp-data"); ?>];
	var data;
	var options;
	var chart;
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
	  log(temp_data)
        data = google.visualization.arrayToDataTable(temp_data);
        options = {
          title: 'Temperaturverlauf des BP-Ofens',
		  curveType: 'function',
        };
        chart = new 
google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
		document.getElementById('png').outerHTML = '<a href="' + 
chart.getImageURI() + '">Printable version</a>';
      }
	  
	  $(function(){
		setTimeout(requestNewData, 1000);
	  });
	  
	  function requestNewData() {
	    setTimeout(function(){ addData(["14:30:00",100,50]) }, 
1000);
		$.ajax({
		  url: "temp.php",
		}).done(function(e) {
		  addData(eval(e));
		  setTimeout(requestNewData, 1000);
		});
	  }
	  
	  function addData(new_data) {
		temp_data.push(new_data);
		data = google.visualization.arrayToDataTable(temp_data);
		chart.draw(data, options);
	  }
	  
	  function log(msg){
		console.log(msg);
	  }
	  	  
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
  <div id='png'></div>
  </body> </html>

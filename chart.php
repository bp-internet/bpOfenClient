<html>
  <head>
    <script type="text/javascript" 
src="https://www.google.com/jsapi"></script>
	<script 
src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript">
	var temp_data = [['Uhrzeit', 'Hinten', 'Vorne'],<?php include("temp-data"); ?>];
	var data;
	var options;
	var chart;
	var refreshTimer = 15;
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
		setTimeout(requestNewData, 500);
	  });
	  
	  function requestNewData() {
		$.ajax({
		  url: "temp.php",
		}).done(function(e) {
		  addData(eval(e));
		  setTimeout(requestNewData, refreshTimer*1000);
		});
	  }
	  
	  function addData(new_data) {
		$("#temp_1").html(new_data[1]);
		$("#temp_2").html(new_data[2]);
		temp_data.push(new_data);
		data = google.visualization.arrayToDataTable(temp_data);
		chart.draw(data, options);
	  }
	  
	  function setRefreshTimer() {
		refreshTimer = parseInt(prompt("Zeit in Sekunden ("+refreshTimer+"):"));
	  }
	  
	  function log(msg){
		console.log(msg);
	  }
	  	  
    </script>
  </head>
  <body>
  <h2><font style="color:#3366cc">hinten: <div id="temp_1" style="display:inline"></div>&deg;</font> - <font style="color:#dc3912">vorne: <div id="temp_2" style="display:inline"></div>&deg;</font></h2>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
  <div id='png'></div><br>
  <a href="clear_data.php" onclick="return alert('Sicher?')">Daten l&ouml;schen</a><br>
  <a href="#" onclick="setRefreshTimer()">TimeOut</a>
  </body> </html>

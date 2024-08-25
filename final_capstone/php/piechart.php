<?php
$dataPoints1 = array(
   array("label"=> "January", "y"=> 36.12),
   array("label"=> "February", "y"=> 34.87),
   array("label"=> "March", "y"=> 40.30),
   array("label"=> "April", "y"=> 35.30),
   array("label"=> "May", "y"=> 39.50),
   array("label"=> "June", "y"=> 50.82),
   array("label"=> "July", "y"=> 74.70),
   array("label"=> "August", "y"=> 40.30),
   array("label"=> "September", "y"=> 35.30),
   array("label"=> "October", "y"=> 39.50),
   array("label"=> "November", "y"=> 50.82),
   array("label"=> "December", "y"=> 74.70)
);
$dataPoints2 = array(
   array("label"=> "January", "y"=> 64.61),
   array("label"=> "February", "y"=> 70.55),
   array("label"=> "March", "y"=> 72.50),
   array("label"=> "April", "y"=> 81.30),
   array("label"=> "May", "y"=> 63.60),
   array("label"=> "June", "y"=> 69.38),
   array("label"=> "July", "y"=> 150.70),
   array("label"=> "August", "y"=> 40.30),
   array("label"=> "September", "y"=> 35.30),
   array("label"=> "October", "y"=> 39.50),
   array("label"=> "November", "y"=> 50.82),
   array("label"=> "December", "y"=> 74.70)

);
?>

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
   animationEnabled: true,
   theme: "light1",
   title:{
      text: "Average Amount of Revenue and loss of the store"
   },
   axisY:{
      includeZero: true
   },
   legend:{
      cursor: "pointer",
      verticalAlign: "center",
      horizontalAlign: "right",
      itemclick: toggleDataSeries
   },
   data: [{
      type: "column",
      name: "Revenue",
      indexLabel: "{y}",
      yValueFormatString: "#0.##",
      showInLegend: true,
      dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
   },{
      type: "column",
      name: "Loss",
      indexLabel: "{y}",
      yValueFormatString: "#0.##",
      showInLegend: true,
      dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
   }]
});

chart.render();
 
function toggleDataSeries(e){
   if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
      e.dataSeries.visible = false;
   }
   else{
      e.dataSeries.visible = true;
   }
   chart.render();
}
 
}
</script>


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
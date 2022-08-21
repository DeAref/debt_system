<?php
include '../library/dateTime.php';
$today = date("Y-m-d");
$preToday = preDay($today);
$pre2Today = preDay($preToday);
$pre3Today = preDay($pre2Today);
$pre4Today = preDay($pre3Today);
$pre5Today = preDay($pre4Today);
$pre6Today = preDay($pre5Today);
//$pre7Today = preDay($pre6Today);

$conn=mysqli_connect("localhost","root","","deptsystem");


//all debts 
$query = "SELECT * FROM `dept` WHERE `date`='$today' ";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debt['today'] = mysqli_num_rows($result);
}else{
  $debt['today'] = 0;
}

$query = "SELECT * FROM `dept` WHERE `date`='$preToday' ";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debt['preToday'] = mysqli_num_rows($result);
}else{
  $debt['preToday'] = 0;
}


$query = "SELECT * FROM `dept` WHERE `date`='$pre2Today' ";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debt['pre2Today'] = mysqli_num_rows($result);
}else{
  $debt['pre2Today'] = 0;
}


$query = "SELECT * FROM `dept` WHERE `date`='$pre3Today' ";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debt['pre3Today'] = mysqli_num_rows($result);
}else{
  $debt['pre3Today'] = 0;
}


$query = "SELECT * FROM `dept` WHERE `date`='$pre4Today' ";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debt['pre4Today'] = mysqli_num_rows($result);
}else{
  $debt['pre4Today'] = 0;
}


$query = "SELECT * FROM `dept` WHERE `date`='$pre5Today' ";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debt['pre5Today'] = mysqli_num_rows($result);
}else{
  $debt['pre5Today'] = 0;
}


$query = "SELECT * FROM `dept` WHERE `date`='$pre6Today' ";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debt['pre6Today'] = mysqli_num_rows($result);
}else{
  $debt['pre6Today'] = 0;
}

// acctive debts
/************************** */
$query = "SELECT * FROM `dept` WHERE `date`='$today' AND `status`='1' ";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debtA['today'] = mysqli_num_rows($result);
}else{
  $debtA['today'] = 0;
}

$query = "SELECT * FROM `dept` WHERE `date`='$preToday' AND `status`='1'";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debtA['preToday'] = mysqli_num_rows($result);
}else{
  $debtA['preToday'] = 0;
}


$query = "SELECT * FROM `dept` WHERE `date`='$pre2Today' AND `status`='1'";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debtA['pre2Today'] = mysqli_num_rows($result);
}else{
  $debtA['pre2Today'] = 0;
}


$query = "SELECT * FROM `dept` WHERE `date`='$pre3Today' AND `status`='1' ";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debtA['pre3Today'] = mysqli_num_rows($result);
}else{
  $debtA['pre3Today'] = 0;
}


$query = "SELECT * FROM `dept` WHERE `date`='$pre4Today' AND `status`='1' ";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debtA['pre4Today'] = mysqli_num_rows($result);
}else{
  $debtA['pre4Today'] = 0;
}


$query = "SELECT * FROM `dept` WHERE `date`='$pre5Today' AND `status`='1' ";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debtA['pre5Today'] = mysqli_num_rows($result);
}else{
  $debtA['pre5Today'] = 0;
}


$query = "SELECT * FROM `dept` WHERE `date`='$pre6Today' AND `status`='1' ";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)>0){
  $debtA['pre6Today'] = mysqli_num_rows($result);
}else{
  $debtA['pre6Today'] = 0;
}

?>
<script>

$(function () {

'use strict'

/* ChartJS
 * -------
 * Here we will create a few charts using ChartJS
 */

//-----------------------
//- MONTHLY SALES CHART -
//-----------------------

// Get context with jQuery - using jQuery's .get() method.
var salesChartCanvas = $('#salesChart').get(0).getContext('2d')
// This will get the first returned node in the jQuery collection.
var salesChart       = new Chart(salesChartCanvas)

var salesChartData = {
  labels  : ['<?php echo ($pre6Today); ?>', '<?php echo ($pre5Today); ?>', '<?php echo ($pre4Today); ?>', '<?php echo ($pre3Today); ?>', '<?php echo ($pre2Today); ?>', '<?php echo ($preToday); ?>', '<?php echo ($today); ?>'],
  datasets: [
    {
      label               : 'Debts',
      fillColor           : '#dee2e6',
      strokeColor         : '#ced4da',
      pointColor          : '#ced4da',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgb(220,220,220)',
      data                : [<?php echo ($debt['pre6Today']); ?>, <?php echo ($debt['pre5Today']); ?>, <?php echo ($debt['pre4Today']); ?>, <?php echo ($debt['pre3Today']); ?>, <?php echo ($debt['pre2Today']); ?>, <?php echo ($debt['preToday']); ?>, <?php echo ($debt['today']); ?>]
    },
    {
      label               : 'Acctive debts',
      fillColor           : 'rgba(0, 123, 255, 0.9)',
      strokeColor         : 'rgba(0, 123, 255, 1)',
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(0, 123, 255, 1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(0, 123, 255, 1)',
      data                : [<?php echo ($debtA['pre6Today']); ?>, <?php echo ($debtA['pre5Today']); ?>, <?php echo ($debtA['pre4Today']); ?>, <?php echo ($debtA['pre3Today']); ?>, <?php echo ($debtA['pre2Today']); ?>, <?php echo ($debtA['preToday']); ?>, <?php echo ($debtA['today']); ?>]
    }
  ]
}

var salesChartOptions = {
  //Boolean - If we should show the scale at all
  showScale               : true,
  //Boolean - Whether grid lines are shown across the chart
  scaleShowGridLines      : false,
  //String - Colour of the grid lines
  scaleGridLineColor      : 'rgba(0,0,0,.05)',
  //Number - Width of the grid lines
  scaleGridLineWidth      : 1,
  //Boolean - Whether to show horizontal lines (except X axis)
  scaleShowHorizontalLines: true,
  //Boolean - Whether to show vertical lines (except Y axis)
  scaleShowVerticalLines  : true,
  //Boolean - Whether the line is curved between points
  bezierCurve             : true,
  //Number - Tension of the bezier curve between points
  bezierCurveTension      : 0.3,
  //Boolean - Whether to show a dot for each point
  pointDot                : false,
  //Number - Radius of each point dot in pixels
  pointDotRadius          : 4,
  //Number - Pixel width of point dot stroke
  pointDotStrokeWidth     : 1,
  //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
  pointHitDetectionRadius : 20,
  //Boolean - Whether to show a stroke for datasets
  datasetStroke           : true,
  //Number - Pixel width of dataset stroke
  datasetStrokeWidth      : 2,
  //Boolean - Whether to fill the dataset with a color
  datasetFill             : true,
  //String - A legend template
  legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%=datasets[i].label%></li><%}%></ul>',
  //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
  maintainAspectRatio     : false,
  //Boolean - whether to make the chart responsive to window resizing
  responsive              : true
}

//Create the line chart
salesChart.Line(salesChartData, salesChartOptions)

//---------------------------
//- END MONTHLY SALES CHART -
//---------------------------

//-------------
//- PIE CHART -
//-------------
// Get context with jQuery - using jQuery's .get() method.
var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
var pieChart       = new Chart(pieChartCanvas)
var PieData        = [
  {
    value    : 700,
    color    : '#dc3545',
    highlight: '#dc3545',
    label    : 'Chrome'
  },
  {
    value    : 500,
    color    : '#28a745',
    highlight: '#28a745',
    label    : 'IE'
  },
  {
    value    : 400,
    color    : '#ffc107',
    highlight: '#ffc107',
    label    : 'FireFox'
  },
  {
    value    : 600,
    color    : '#17a2b8',
    highlight: '#17a2b8',
    label    : 'Safari'
  },
  {
    value    : 300,
    color    : '#007bff',
    highlight: '#007bff',
    label    : 'Opera'
  },
  {
    value    : 100,
    color    : '#6c757d',
    highlight: '#6c757d',
    label    : 'Navigator'
  }
]
var pieOptions     = {
  //Boolean - Whether we should show a stroke on each segment
  segmentShowStroke    : true,
  //String - The colour of each segment stroke
  segmentStrokeColor   : '#fff',
  //Number - The width of each segment stroke
  segmentStrokeWidth   : 1,
  //Number - The percentage of the chart that we cut out of the middle
  percentageInnerCutout: 50, // This is 0 for Pie charts
  //Number - Amount of animation steps
  animationSteps       : 100,
  //String - Animation easing effect
  animationEasing      : 'easeOutBounce',
  //Boolean - Whether we animate the rotation of the Doughnut
  animateRotate        : true,
  //Boolean - Whether we animate scaling the Doughnut from the centre
  animateScale         : false,
  //Boolean - whether to make the chart responsive to window resizing
  responsive           : true,
  // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
  maintainAspectRatio  : false,
  //String - A legend template
  legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
  //String - A tooltip template
  tooltipTemplate      : '<%=value %> <%=label%> users'
}
//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
pieChart.Doughnut(PieData, pieOptions)
//-----------------
//- END PIE CHART -
//-----------------

/* jVector Maps
 * ------------
 * Create a world map with markers
 */
$('#world-map-markers').vectorMap({
  map              : 'world_mill_en',
  normalizeFunction: 'polynomial',
  hoverOpacity     : 0.7,
  hoverColor       : false,
  backgroundColor  : 'transparent',
  regionStyle      : {
    initial      : {
      fill            : 'rgba(210, 214, 222, 1)',
      'fill-opacity'  : 1,
      stroke          : 'none',
      'stroke-width'  : 0,
      'stroke-opacity': 1
    },
    hover        : {
      'fill-opacity': 0.7,
      cursor        : 'pointer'
    },
    selected     : {
      fill: 'yellow'
    },
    selectedHover: {}
  },
  markerStyle      : {
    initial: {
      fill  : '#00a65a',
      stroke: '#111'
    }
  },
  markers          : [
    {
      latLng: [41.90, 12.45],
      name  : 'Vatican City'
    },
    {
      latLng: [43.73, 7.41],
      name  : 'Monaco'
    },
    {
      latLng: [-0.52, 166.93],
      name  : 'Nauru'
    },
    {
      latLng: [-8.51, 179.21],
      name  : 'Tuvalu'
    },
    {
      latLng: [43.93, 12.46],
      name  : 'San Marino'
    },
    {
      latLng: [47.14, 9.52],
      name  : 'Liechtenstein'
    },
    {
      latLng: [7.11, 171.06],
      name  : 'Marshall Islands'
    },
    {
      latLng: [17.3, -62.73],
      name  : 'Saint Kitts and Nevis'
    },
    {
      latLng: [3.2, 73.22],
      name  : 'Maldives'
    },
    {
      latLng: [35.88, 14.5],
      name  : 'Malta'
    },
    {
      latLng: [12.05, -61.75],
      name  : 'Grenada'
    },
    {
      latLng: [13.16, -61.23],
      name  : 'Saint Vincent and the Grenadines'
    },
    {
      latLng: [13.16, -59.55],
      name  : 'Barbados'
    },
    {
      latLng: [17.11, -61.85],
      name  : 'Antigua and Barbuda'
    },
    {
      latLng: [-4.61, 55.45],
      name  : 'Seychelles'
    },
    {
      latLng: [7.35, 134.46],
      name  : 'Palau'
    },
    {
      latLng: [42.5, 1.51],
      name  : 'Andorra'
    },
    {
      latLng: [14.01, -60.98],
      name  : 'Saint Lucia'
    },
    {
      latLng: [6.91, 158.18],
      name  : 'Federated States of Micronesia'
    },
    {
      latLng: [1.3, 103.8],
      name  : 'Singapore'
    },
    {
      latLng: [1.46, 173.03],
      name  : 'Kiribati'
    },
    {
      latLng: [-21.13, -175.2],
      name  : 'Tonga'
    },
    {
      latLng: [15.3, -61.38],
      name  : 'Dominica'
    },
    {
      latLng: [-20.2, 57.5],
      name  : 'Mauritius'
    },
    {
      latLng: [26.02, 50.55],
      name  : 'Bahrain'
    },
    {
      latLng: [0.33, 6.73],
      name  : 'SÃ£o TomÃ© and PrÃ­ncipe'
    }
  ]
})

/* SPARKLINE CHARTS
 * ----------------
 * Create a inline charts with spark line
 */

//-----------------
//- SPARKLINE BAR -
//-----------------
$('.sparkbar').each(function () {
  var $this = $(this)
  $this.sparkline('html', {
    type    : 'bar',
    height  : $this.data('height') ? $this.data('height') : '30',
    barColor: $this.data('color')
  })
})

//-----------------
//- SPARKLINE PIE -
//-----------------
$('.sparkpie').each(function () {
  var $this = $(this)
  $this.sparkline('html', {
    type       : 'pie',
    height     : $this.data('height') ? $this.data('height') : '90',
    sliceColors: $this.data('color')
  })
})

//------------------
//- SPARKLINE LINE -
//------------------
$('.sparkline').each(function () {
  var $this = $(this)
  $this.sparkline('html', {
    type     : 'line',
    height   : $this.data('height') ? $this.data('height') : '90',
    width    : '100%',
    lineColor: $this.data('linecolor'),
    fillColor: $this.data('fillcolor'),
    spotColor: $this.data('spotcolor')
  })
})
})

</script>
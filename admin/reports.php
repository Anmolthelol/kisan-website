<?php
include("database.php"); 
?>
<!doctype html>
<html lang="en">

<head>
    <link href="../include/mdbootstrap/css/mdb.min.css" rel="stylesheet">
    <?php include('links.php'); ?>
    <!-- <link rel="stylesheet" href="css/reports.css"> -->
    <style>
      .a.waves-effect, a.waves-light {
          display: block!important;
      }
    </style>
</head>
<title>FOODIFY</title>

<body>
    <?php
    include('navbar.php');
    include('slidebar.php');

?>
    <div class="conten-body">

    <div id="content-wrapper">
      <div class="innercontent">
        <!-- <h1 class="ml-5 mt-2 text-muted"></h1> -->
        <section class="section mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-cascade narrower">
                        <div class="admin-panel">
                            <div class="row mb-0">
                                <div class="col-md-5">
                                    <div class="view left bg-blue" >
                                        <h2 class="mt-1 w3-xxlarge w3-myfont">Reports</h2>
                                    </div>
                                    <div class="row card-body pt-3">
                                        <div class="col-md-12">
                                            <h4><span class="badge big-badge bg-blue text-white">Data range</span></h4>
                                            <select class="mdb-select" id="DropDownPeriod">
                                                <option value="" selected disabled >Choose time period</option>
                                                <option value="Today">Today</option>
                                                <option value="Yesterday">Yesterday</option>
                                                <option value="Last7days">Last 7 days</option>
                                                <option value="Last15days">Last 15 days</option>
                                                <option value="Lastweek">Last week</option>
                                                <option value="Lastmonth">Last month</option>
                                            </select>
                                            <br>
                                            <h4>
                                              <span class="badge big-badge bg-blue text-white" >
                                                Custom date
                                              </span>
                                              
                                             
                                            </h4>
                                            
                                            <br>
                                            <div class="md-form d-inline-block">
                                                <input placeholder="Selected date" type="text" id="from" class="form-control datepicker bg-transparent">
                                                <label for="date-picker-example">From</label>
                                            </div>
                                            <div class="md-form d-inline-block float-md-right">
                                                <input placeholder="Selected date" type="text" id="to" class="form-control datepicker bg-transparent">
                                                <label for="date-picker-example">To</label>
                                            </div>
                                            
                                        </div>
                                        <span style="cursor:pointer;" onclick="demo()"class="badge big-badge primary-color text-white  float-md-right">
                                            Show Report
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                <div id="DivChart"class="view right  mb-r" style="background: white!important;">
                                        <canvas id="myChart"  height="155px"></canvas>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                                    <div class="card mb-r" style="box-shadow: none !important;">
                                        <div class="card-body">
                                        <div class="table-responsive">

                                                <table class="table large-header" id="tblorder">

                                                <thead style="box-shadow: none !important;">
                                                    <tr class="light-blue lighten-1">
                                                        <th>OrderId</th>
                                                        <th>User Name</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Discount</th>
                                                        <th>Date&Time</th>
                                                        <th>Payment</th>
                                                        <th>Item Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Pincode</th>
                                                    </tr>
                                                </thead>   
                                                <tbody id="tableData">      
                                                </tbody>

                                                </table>
                                        </div>
                                            <!-- <button class="btn-flat bg-blue text-white btn-rounded waves-effect " id="btnExport">Export Report</button> -->
                                            <button id="json" class="btn btn-outline-primary waves-effect float-right ml-1" onclick="$('#tblorder').tableHTMLExport({type:'json',filename:'report.json'});">Export TO JSON</button>
                                            <button id="csv" class="btn btn-outline-info waves-effect float-right mx-0 ml-1" onclick="$('#tblorder').tableHTMLExport({type:'csv',filename:'report.csv'});">Export TO EXCEL</button>  
                                            <!-- <button id="png" class="btn btn-info">Export TO PNG</button>  -->
                                            <!-- <button id="word" class="btn btn-info">Export to Word</button> -->
                                            <button id="pdf" class="btn btn-outline-danger waves-effect float-right mx-0 ml-1">Export to PDF</button>                                       
                                            <!-- <button id="excel" class="btn btn-danger">Export to Excel</button>                                        -->
                                            <!-- <button id="ppt" class="btn btn-danger">Export to PPT</button>                                        -->
                                            <button id="txt" class="btn btn-outline-secondary waves-effect float-right mx-0 ml-1" onclick="$('#tblorder').tableHTMLExport({type:'txt',filename:'report.txt'});">Export to TXT</button>                                       
                                        </div>
                                    </div>
                                </div>
                            </div>       
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>
    </div>

    <?php include('include/scripts.php'); ?>
    <script type="text/javascript" src="../include/mdbootstrap/js/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="../include/js/TableExport/tableHTMLExport.js"></script>

    <?php mysqli_close($conn); ?>
    <script>
        $('.datepicker').pickadate({
                // min: new Date(),
                max: new Date()
        });
        $(document).ready(function() {
            disp_chart("Today"); 
            $('.mdb-select').material_select();
            $("#DropDownPeriod").change(function() {
                clearChart();
                disp_chart($(this).val());
                showTable($(this).val());
            });
            $("#pdf").click(function(){
                html2canvas($('#tblorder')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                        pdfMake.createPdf(docDefinition).download("report.pdf");
                    }
                });
            });
            // $("#json").click(function(){
                
            // });
            // $("#csv").click(function(){
            //     $("#tblorder").tableHTMLExport({type:'csv',filename:'report.csv'});
            // });
            
        });
        
        function disp_chart(value){
          $.ajax({
          type: "GET",
          url: "php/reportData.php?charts="+value,
          dataType: "json",
          success: function(response) {
                  myData = response;
                  var ctx = document.getElementById("myChart").getContext('2d');
                  var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {  
                        labels: myData['labels'],
                        datasets: [{
                            label: myData['label'],
                            data: myData['data'],
                            backgroundColor:myData['backgroundColor'],
                            borderColor: myData['borderColor'],
                            borderWidth: 2
                        }]
                    },
                    options: {
                      legend: {
                          labels: {
                              fontColor: "black"
                          }
                      },
                        scales: {
                            yAxes: [{
                                ticks: {
                                beginAtZero: true,
                                fontColor: "black"
                                }
                            }],
                            xAxes: [{
                              ticks:  {
                                  fontColor: "black"
                              }
                          }]
                        }
                    }
                  });

              }         
          });                
        }
        function clearChart(){
              document.getElementById("DivChart").innerHTML = '&nbsp;';
              document.getElementById("DivChart").innerHTML = '<canvas id="myChart" height="155px"></canvas>';
              var ctx = document.getElementById("myChart").getContext("2d");
        }
        function showTable(value){
            $.ajax({
            type: "GET",
            url: "php/reportData.php?tables="+value,
            dataType: "html",
            success: function(response) {
                $("#tableData").html(response);
              }         
          }); 
        }
        function demo(){
            $.ajax({
            type: "GET",
            url: "php/reportData.php?tables=FromTo&from="+$("#from").val()+"&to="+$("#to").val(),
            dataType: "html",
            success: function(response) {
                // console.log(response);
                $("#tableData").html(response);
              }         
          }); 

        }
    </script>
</body>

</html>
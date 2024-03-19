<?php
include('php/database.php');
if(!isset($_SESSION['aid'])){
  header('Location:index.php');
}
?>
<!doctype html>
<html lang="en">

<head>
    <?php include 'include/links.php'; ?>

    <link rel="stylesheet" href="css/manageRestorant.css">


</head>
<title>FOODIFY</title>
<body>
    <?php
    include('include/navbar.php');
    include('include/slidebar.php');
?>
    <div class="conten-body">
        <div id="content-wrapper">
            <div class="tab ml-2">
                <ul class="nav" role="tablist">
                    <li class="nav-item">
                        <a href="#tab1" class="nav-link text-dark font-weight-bold active" id="tab-tab1"
                            aria-selected="true" data-toggle="tab" role="tab">MANAGE STORE</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab2" class="nav-link text-dark font-weight-bold" id="tab-tab2" aria-selected="false"
                            data-toggle="tab" role="tab">MANAGE ITEMS</a>

                    </li>
                    
                    <div class="panel rounded"></div>
                </ul>

            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab1" aria-labelledby="tab-tab1" role="tab-panel">
                    <div class="mt-2 ml-4">
                        <div class="row">
                            <div class="col-lg-4 col-md-8 col-sm-10 col-10">
                            <select name="orderstatus" class="custom-select orderstatus m-0" >
                                <option value="all" selected>All</option>
                                <option value="Pending">Pending</option>
                                <option value="Accpted">Accpted</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                            </div>
                        </div>
                      
                        <div class="row w-100">
                            <div class="col-lg-4  m-0 p-0 loadrestolist">
                                
                            </div>
                            <div class="col-lg-8 m-0  p-0">
                                <div class="loadrestorants">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" aria-labelledby="tab-tab2" role="tab-panel">
                    <div class="mt-4">
                        <div class="card box-shadow mx-4">
                            <div class="card-body p-0 pb-2">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-10 col-10">
                                    <label for="selres" class="text-muted font-weight-bold mr-1 ml-3">Select Store:</label>
                                    <select name="selres" class="custom-select  m-0 my-3 selres" style="width: 50%" id="selres">
                                        <option value="all" selected>All</option>
                                        <?php 
                                        $sql = "SELECT * FROM `restaurants`";
                                        $result = mysqli_query($conn, $sql);
                                
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <option value="<?php echo $row['res_id'] ?>"><?php echo $row['name'] ?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-10 col-10">
                                    <label for="selitemstatus" class="text-muted font-weight-bold mr-1 ml-3">Select Status:</label>
                                    <select name="selitemstatus" class="custom-select  m-0 my-3 selitemstatus" style="width: 25%" id="selitemstatus">
                                        <option value="all" selected>All</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Accpted">Accpted</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>
                               

                                
                            
                                <div class="loaditemtable mx-2">

                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
           
        </div>
    </div>


    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Item Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="restoimg"
                        src=""
                        height="250" width="100%"></img>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php include('include/scripts.php'); ?>

    <script>
    $(document).ready(function() {
        $(".panel").css("width", 275 + "px");
        $("ul.nav li:nth-child(1)").on("click", function() {
            $(".panel").animate({
                    left: "0px"
                },
                "slow"
            );
        });
        $("ul.nav li:nth-child(2)").on("click", function() {
            $(".panel").animate({
                    left: 275 + "px"
                },
                "slow"
            );
        });
        loadrestolist("all");
        loaditemtable("all","all");
        $(".orderstatus").on('change',function(){
            loadrestolist($(this).val());
            $(".loadrestorants").html("");
        });
        $(".selres").on('change',function(){
            loaditemtable($(this).val(),$("#selitemstatus").val());
        });
        $(".selitemstatus").on('change',function(){
            loaditemtable($("#selres").val(),$(this).val());
        });
        
    });
    function loaditemtable(id,status){
        $.ajax({
            type: "GET",
            url: "php/itemTable.php?rid="+id+"&status="+status,
            dataType: "html", 
            success: function(response) {
                $(".loaditemtable").html(response);
            }
        });
    }
    function change(e){
        $(e).hide();
        $(e).siblings("select").show();
        $(e).siblings("a").show();

    }
    function cancel(e){
        $(e).hide();
        $(e).siblings("select").hide();
        $(e).siblings("a").show();

    }
    function changeStatus(e){
        var id=$(e).attr("id")
        var status=$(e).val();
        
        $.ajax({  
            url: "php/crud.php?status="+status+"&statusid="+id,
            type: "GET",  
            dataType:"html",  
            success:function(response){ 
                
            }  
        });
        $(e).hide();
        $(e).siblings("a").show();
        $(e).siblings(".txtcancel").hide();
        $(e).siblings("span").html(status);
    }
    function loadrestolist(status){
        if(status == "all"){
            $.ajax({
            type: "POST",
            url: "php/restolists.php",
            dataType: "html", 
            success: function(response) {
                $(".loadrestolist").html(response);
                }
            });
        }
        else{
            $.ajax({
            type: "POST",
            url: "php/restolists.php?status=" + status,
            dataType: "html", 
            success: function(response) {
                $(".loadrestolist").html(response);
                }
            });
        }
        
    }
    function resacc(id){
        $.ajax({
            type: "POST",
            url: "php/crud.php?orderaccept=" + id,
            dataType: "html", 
            success: function(response) {
                loadrestorants(id);
            }
        });
    }
    function resrej(id){
        $.ajax({
            type: "POST",
            url: "php/crud.php?orderreject=" + id,
            dataType: "html", 
            success: function(response) {
                loadrestorants(id);
            }
        });
    }
    function getimage(img) {
        console.log(img);
        $("#restoimg").attr("src", "../uploads/" + img);
    }
    function loadrestorants(id){
        $.ajax({
            type: "POST",
            url: "php/show_restorants.php?id=" + id,
            dataType: "html", 
            success: function(response) {
                $(".loadrestorants").html(response);
            }
        });

    }
    
   
    </script>
</body>

</html>
<?php
include('php/database.php');
if(!isset($_SESSION['aid'])){
  header('Location:index.php');
}
?>
<!doctype html>
<html lang="en">

<head>

    <link href="../include/mdbootstrap/css/mdb.min.css" rel="stylesheet">
    <?php include('include/links.php'); ?>
    <link rel="stylesheet" href="css/offers.css">
    <style>
        .form-group {
            margin-bottom: 0!important;
        }
        .input-group .form-control {
           
            margin-top: 0px!important;
            padding-top: 8px!important;
            padding-bottom: 4px!important;
            padding-left: 0.2rem!important;
        }
        input[type=number]{
            border: 1px solid #bdbdbd!important;
        }
    </style>
</head>
<title>FOODIFY</title>
<body>

    <?php
    include('include/navbar.php');
    include('include/slidebar.php');
?>
    <div class="conten-body">   
        <div id="content-wrapper">
            <div class="row mt-1 mr-0 pr-0 ml-2 ">
                <div class="card shadow-none w-100">
                    <div class="card-header bg-white">
                        <span class="w3-xxlarge w3-lobster" style="cursor:pointer;" onclick="offerTable()">Offers</span>
                        <button class="btn btn-primary w3-lobster float-right p-0 px-2 py-1" onclick="addoffer()"> <i class="fas fa-plus fa-sm mr-1"></i> Create Offer</button>
                        <br>
                        <i class="fas fa-sync-alt float-right mr-2 fa-lg" style="cursor:pointer;" onclick="offerTable()"></i>
                    </div>
                    <div class="card-body">
                    
                        <div id="offersection"> 
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade right" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="offerModal" aria-hidden="true">
                <div class="modal-dialog modal-full-height modal-right" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title w-100" id="myModalLabel">Offer Detalis</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                        </div>
                        
                    </div>
                </div>
            </div>
           
    </div>

    <?php include('include/scripts.php'); ?>

    <script type="text/javascript" src="../include/mdbootstrap/js/mdb.min.js"></script>
    <script>
  
    $(document).ready(function(){
        offerTable();
    });
    function offerTable(){
        $.ajax({
        type: "GET",
        url: "php/offerTable.php",
        dataType: "html", 
        success: function(response) {
            $("#offersection").html(response);
            }
        });
    }
    function addoffer(){
        $.ajax({
        type: "GET",
        url: "php/addoffer.php?insert=1",
        dataType: "html", 
        success: function(response) {
            $("#offersection").html(response);
            }
        });
    }
    function validForm(){
         var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if(form.checkValidity() === true){
                event.preventDefault();
                insertOfffer();
            }
            else if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }
    function insertOfffer(){
        var formData = $("#offerForm").serialize();
        $.ajax({
            type: "POST",
            url: "php/crud.php",
            dataType: "html",
            data: formData,
            success: function(response){
                if(response == "1"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Offer Created',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    offerTable();
                }
                else if(response == "offercodeErr"){
                    $("#offercodeErr").show();
                    $("#offercode").css({"border": "1px solid red"});
                }else{
                    console.log(response);
                }
            }
        })
    }
    function updateOffer(id){
        $.ajax({
        type: "GET",
        url: "php/addoffer.php?update="+id,
        dataType: "html", 
        success: function(response) {
            $("#offersection").html(response);
            }
        });
    }
    function validUpdateForm(){
         var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if(form.checkValidity() === true){
                event.preventDefault();
                updateOfferDetail();
            }
            else if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }
    function updateOfferDetail(){
        var formData = $("#offerUpdateForm").serialize();
        $.ajax({
            type: "POST",
            url: "php/crud.php",
            dataType: "html",
            data: formData,
            success: function(response){
                if(response == "1"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Offer Updated',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    offerTable();
                }
                else if(response == "offercodeErr"){
                    $("#offercodeErr").show();
                    $("#offercode").css({"border": "1px solid red"});
                }else{
                    console.log(response);
                }
            }
        })
    }
    function deleteOffer(id){
        $.ajax({
        type: "GET",
        url: "php/crud.php?deleteOffer="+id,
        dataType: "html", 
        success: function(response) {
            if (response == "1") {
                Swal.fire({
                        icon: 'success',
                        title: 'Offer Deleted',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    offerTable();
            } else {
                console.log(response);
            }
            }
        });
    }
    function showModal(id){
        $.ajax({
        type: "GET",
        url: "php/modalData.php?id="+id,
        dataType: "html", 
        success: function(response) {
            $(".modal-body").html(response);
            }
        });
    }
    function changeOfferStatus(id,staus){
        $.ajax({
        type: "GET",
        url: "php/crud.php?changeOfferid="+id+"&changeOfferStatus="+staus,
        dataType: "html", 
        success: function(response) {
            if (response == "1") {
                $("#offerModal").modal("hide");
                offerTable();
            } else {
                console.log(response);
            }
            }
        });
    }
    </script>
</body>

</html>
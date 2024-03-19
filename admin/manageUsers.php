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

    <link rel="stylesheet" href="css/manageUsers.css">

    
</head>
<title>FOODIFY</title>
<body>
    <?php
    include('include/navbar.php');
    include('include/slidebar.php');
?>
    <div class="conten-body">   
        <div id="content-wrapper">
        <div class="card mr-4 ml-4">
            
            <div class="card-body">
                <div class="userTable">

                </div>
                       
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade right" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
        <div class="modal-dialog modal-full-height modal-right" role="document">
            <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">UPDATE USER PROFILE</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
                <div class="modal-body">
                    <form id="UpdateUserForm" method="post">
                    <input type="hidden" id="uid" name="uid">
                    <input type="hidden" id="updateUserInfo" name="updateUserInfo">
                    <div class="md-form">
                        <i class="far fa-user prefix"></i>
                        <input type="text" id="update_name" name="update_name"  class="form-control" required>
                        <label data-error="wrong" data-success="right" for="defaultForm-email" class="updatelbl">Name</label>
                    </div>
                    <div class="md-form">
                        <i class="far fa-envelope prefix"></i>
                        <input type="email" id="Update_email" name="Update_email" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="defaultForm-email" class="updatelbl">Email</label>
                    </div>
                    <div class="md-form">
                        <i class="fas fa-mobile-alt prefix"></i>
                        <input type="number" id="Update_moblie" name="Update_moblie" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="defaultForm-email" class="updatelbl">Moblie</label>
                    </div>
                
                    <div class="justify-content-center md-form">
                        <button type="submit" class="btn btn-info text-white font-weight-bold w-100 mt-3" style="background-color: #fc8019;" onclick="updateUser(event);">UPDATE PROFILE</button>
                    </div>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/scripts.php'); ?>

    <script>
        $(document).ready(function () {
            loadUserTable();
        });
        function loadUserTable(){
            $.ajax({  
                url: "php/userTable.php",
                type: "GET",  
                dataType:"html",  
                success:function(response){ 
                     $(".userTable").html(response);
                }  
           });
        }
        function getUserInfo(id){
            $(".updatelbl").addClass("active");
            $.ajax({  
                url: "php/crud.php?getUserInfo="+id,
                type: "GET",  
                dataType:"json",  
                success:function(data){ 
                    $('#uid').val(data.u_id);  
                    $('#update_name').val(data.name);  
                    $('#Update_email').val(data.email);  
                    $('#Update_moblie').val(data.moblie);  
                     
                }  
           });
        }
        function updateUser(e){
            //alert("hi");
            e.preventDefault();
            $.ajax({
                url: "php/crud.php",
                type: "GET",
                data: $("#UpdateUserForm").serialize(),
                success: function(response) {
                    if (response == "1") {
                        $(".modal").modal("hide");
                        loadUserTable();
                    } else {
                        console.log(response);
                    }
                }
            });
        }
        function deleteUser(id){
            $.ajax({
                url: "php/crud.php?deleteuser="+id,
                type: "GET",
                success: function(response) {
                    if (response == "1") {
                        loadUserTable();
                    } else {
                        console.log(response);
                    }
                }
            });
        }
    </script>
</body>

</html>
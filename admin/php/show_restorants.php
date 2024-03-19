<?php
include('database.php');
if(isset($_GET['id'])){
    $rid=$_GET['id'];
    $sql = "SELECT * FROM restaurants where  res_id=$rid";  
    $result = mysqli_query($conn, $sql);   
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {  
            ?>
    <div class="card ml-2 box-shadow m-0 p-0 mt-2" style="width: 100%" id="cardetail">
        <div class="card-header p-0 pl-1 bg-transparent border-bottom-0">
            <span class="badge bg-blue px-4 py-2 text-light rounded-0"><?php echo $row['status']; ?></span>
        </div>
        <div class="card-body pb-2">
            <div class="d-flex flex-row">
                <img id="restoimg" src="../uploads/<?php echo $row['image_name']; ?>" height="150" width="250"></img>
                <h4 class="card-title ml-3 font-weight-bold align-self-center"><?php echo $row['name']; ?></h4>
            </div>
            <hr>
            <strong class="card-text text-muted font-weight-bold">
                Address:<b class="p-2"><?php echo $row['address']?></b>
            </strong><br>
            <strong class="card-text text-muted font-weight-bold">
                City:<b class="p-2 text-uppercase"><?php echo $row['city']?></b>
            </strong><br>

            <strong class="card-text text-muted font-weight-bold">
                Email:<b class="p-2 "><i class="far fa-envelope mr-1 fa-lg"></i><?php echo $row['email']?></b>
            </strong>
            <strong class="card-text text-muted font-weight-bold">
                Moblie:<b class="p-2 text-uppercase"><i
                        class="fas fa-mobile-alt mr-1 fa-lg"></i><?php echo $row['moblie']?></b>
            </strong><br>

            <strong class="card-text text-muted font-weight-bold">
                Owner Name:<b class="p-2 text-uppercase"><?php echo $row['owner_name']?></b>
            </strong><br>
            <strong class="card-text text-muted font-weight-bold">
                Delivery Charge:<b class="p-2"><i
                        class="fas fa-rupee-sign px-1"></i><?php echo $row['delivery_charge']?></b>
            </strong><br>

            <div class="card-footer p-1 bg-transparent ">
            <?php 
               if($row['status'] == "Accpted"){
                   ?>
                    <button class="float-right btndisabled border-0"
                        onclick="resacc(<?php echo $row['res_id']; ?>)" disabled>Accept</button>
                    <button class="float-right mr-2 btnreject border-0"
                        onclick="resrej(<?php echo $row['res_id']; ?>)">Reject</button>
                   <?php
               }
               if($row['status'] == "Rejected"){
                ?>
                    <button class="float-right btnaccept border-0 "
                        onclick="resacc(<?php echo $row['res_id']; ?>)">Accept</button>
                    <button class="float-right mr-2  border-0 btndisabled"
                        onclick="resrej(<?php echo $row['res_id']; ?>)" disabled>Reject</button>
                <?php
                }
                if($row['status'] == "Pending"){
                    ?>
                    <button class="float-right btnaccept border-0 "
                        onclick="resacc(<?php echo $row['res_id']; ?>)">Accept</button>
                    <button class="float-right mr-2 btnreject border-0"
                        onclick="resrej(<?php echo $row['res_id']; ?>)">Reject</button>
                   <?php
                }              
            ?>
            </div>
        </div>
        <?php
        }
    } 
}
$page=1; 
if(isset($_GET['page'])){
    $limit = 6;  
    $page  = $_GET["page"]; 
    $start_from = ($page-1) * $limit;  
    $sql = "SELECT * FROM `restaurants` LIMIT $start_from, $limit";
    $result = $conn->query($sql);
    $j=$start_from;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $j++;
            $id = $row['res_id'];
            $name = $row['name'];
            ?>
            <li>
            <button class="mdc-list-item mdc-list-item__text border-0 libtn d-flex justify-content-between" onclick="loadrestorants(<?php echo $id; ?>)">
                <?php echo "<span class='mr-1'>$j. </span>"." ".$name; ?>
                <i class="material-icons ml-auto">arrow_forward_ios</i>                                                        
            </button>
            </li>
            <?php
        }
    }
                                        
}
?>
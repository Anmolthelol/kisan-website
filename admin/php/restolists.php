<?php 
include('database.php');
?>
<div class="mdc-card mdc-card--outlined ml-1 mt-2 box-shadow " style="width: 100%;">
    <div class="card-body p-0 border-0">
        <h5 class="card-title p-1 mt-1">
            <?php
            if(isset($_GET['status'])){
                $sql = "SELECT * FROM `restaurants` where status='".$_GET['status']."'";
            }else{
                $sql = "SELECT * FROM `restaurants`";
            }
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            echo "<span class='demo-card__title text-dark font-weight-bold m-2' >RESTORANTS | " . $row . "</span>";
            ?>
        </h5>
        <ul class="mdc-list border-top " style="width: 100%;" id="restorantlist">
            <?php
            if(isset($_GET['status'])){
                $sql = "SELECT * FROM `restaurants` where status='".$_GET['status']."' LIMIT 6";
            }
            else{
                $sql = "SELECT * FROM `restaurants`  LIMIT 6";
            }
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $j=0;
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
            ?>
        </ul>
        
    </div>
    </div>
<?php
$limit = 6;
if(isset($_GET['status'])){
    $sql = "SELECT COUNT(res_id) FROM restaurants where status='".$_GET['status']."' ";

}else{
    $sql = "SELECT COUNT(res_id) FROM restaurants ";
}
//echo $sql;
$rs_result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
$total_pages = ceil($total_records / $limit);
echo "<ul class='ml-2 mt-4 pagination ' id='pagination'>";
    if (!empty($total_pages)) {
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == 1) {
                echo  "<li id='$i' class='page-item' ><button class='btnnextresto myactive page-link bg-white  px-4 py-2 font-weight-bold' value='$i'>$i</button></li>";
            } else {
                echo  "<li id='$i' class='page-item' ><button class='btnnextresto page-link bg-white px-4 py-2 font-weight-bold' value='$i'>$i</button></li>";
            }
        }
    }
?>
<script>
    $(".btnnextresto").click(function() {
            $(".btnnextresto").removeClass("myactive");
            $(this).addClass("myactive");
            $.ajax({
                type: "GET",
                url: "php/show_restorants.php?page=" + $(this).val(),
                dataType: "html",
                success: function(response) {
                    $("#restorantlist").html(response);
                }
            });
        });
</script>
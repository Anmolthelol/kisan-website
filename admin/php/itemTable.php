<?php include 'database.php'; ?>
<div class="table-responsive">
<table id="dtBasicExample" class="table" cellspacing="0">
        <?php
        // print_r($_GET);
        if(isset($_GET['rid']) and isset($_GET['status']) ){
            if($_GET['rid'] == "all" and $_GET['status'] == "all"){
                $sql = "SELECT * FROM `item`";
            }else{
                if($_GET['rid'] == "all" and $_GET['status'] != "all"){
                    $sql = "SELECT * FROM `item` where  status='".$_GET['status']."'" ;
                }
                elseif($_GET['rid'] != "all" and $_GET['status'] == "all"){
                    $sql = "SELECT * FROM `item` where  res_id=".$_GET['rid'] ;

                }else{
                    $sql = "SELECT * FROM `item` where res_id=".$_GET['rid']." and status='".$_GET['status']."'" ;
                }

            }
        }
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        ?>
        <thead>
            <tr>
                <th class="">Rec No
                </th>
                <th class="">Menu Name
                </th>
                <th class="">Store Name
                </th>
                <th class="">Name
                </th>
                <th class="">Status
                </th>
                <th class="">Date
                </th>
                <th class="">Image
                </th>
                <th class="">price
                </th>
                <th class="">quantity
                </th>
                <!-- <th class="">Action
                </th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            $i=0;
            while($row = mysqli_fetch_assoc($result)) {
                $i++; 
                $sql2 = "SELECT * FROM `menu` where m_id=".$row['m_id'];
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                $sql3 = "SELECT * FROM `restaurants` where res_id=".$row['res_id'];
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($result3);
                ?>
            <tr class="font-weight-bold">
                <td><?php echo "<b>$i</b>"; ?></td>
                <td><?php echo $row2['m_name']; ?></td>
                <td><?php echo $row3['name']; ?></td>
                <td><?php echo $row['item_name']; ?></td>
                <td>
                    <span class='badge badge-info px-2 py-2 font-weight-bold no-sh'><?php echo $row['status']; ?></span>
                    <a class='text-info txtchange' onclick="change(this);"><u>Change</u></a>
                    <select class="status" style="display:none" id="<?php echo $row['id']; ?>" onchange="changeStatus(this)">
                        <?php 
                        if($row['status'] == "Pending"){
                            echo "<option value='Pending' selected>Pending</option>";
                            echo "<option value='Accpted'>Accpted</option>";
                            echo "<option value='Rejected'>Rejected</option>";
                        }
                        if($row['status'] == "Accpted"){
                            echo "<option value='Pending'>Pending</option>";
                            echo "<option value='Accpted' selected>Accpted</option>";
                            echo "<option value='Rejected'>Rejected</option>";
                        }
                        if($row['status'] == "Rejected"){
                            echo "<option value='Pending'>Pending</option>";
                            echo "<option value='Accpted'>Accpted</option>";
                            echo "<option value='Rejected' selected>Rejected</option>";
                        }
                        ?>
                        
                    </select>
                    <a class='text-danger txtcancel' onclick="cancel(this);" style="display:none"><u>Cancel</u></a>

                </td>
                <td><?php echo $row['date']; ?></td>
                <td><a class='text-info' onclick="getimage('<?php echo $row['image_name']; ?>')" data-toggle='modal'
                        data-target='#exampleModalCenter'><u>View</u></a></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <!-- <td>
                    <i class="far fa-times-circle text-danger ml-2" onclick="deleteUser(1)"></i>
                </td> -->
            </tr>
            <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th class="">Rec No
                </th>
                <th class="">Menu
                </th>
                <th class="">Store Name
                </th>
                <th class="">Name
                </th>
                <th class="">Status
                </th>
                <th class="">Date
                </th>
                <th class="">Image
                </th>
                <th class="">price
                </th>
                <th class="">quantity
                </th>
                <!-- <th class="">Action
                </th> -->
            </tr>
        </tfoot>
        <?php
        }else{
            echo "<h5 class='ml-5 font-weight-bold mt-3 text-muted'>No Items</h5>";
        } 
        ?>
</table>
</div>
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
    });
    
</script>
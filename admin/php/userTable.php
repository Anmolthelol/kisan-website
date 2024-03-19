<?php include 'database.php'; ?>
<div class="table-responsive">
    <table id="dtBasicExample" class="table" cellspacing="0">
        <?php
        $sql = "SELECT * FROM `user`";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            ?>
        <thead class="position-sticky">
            <tr>
                <th class="">Rec No
                </th>
                <th class="">Name
                </th>
                <th class="">Email
                </th>
                <th class="">Moblie
                </th>
                <th class="">Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                            $i=0;
                            while($row = mysqli_fetch_assoc($result)) {
                                $i++;                       
                                ?>
            <tr>
                <td><?php echo "<b>$i</b>"; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['moblie']; ?></td>
                <td><i class="far fa-edit text-info" onclick="getUserInfo(<?php echo $row['u_id']; ?>)"
                        data-toggle="modal" data-target="#editmodal"></i>
                    <i class="far fa-times-circle text-danger ml-2" onclick="deleteUser(<?php echo $row['u_id']; ?>)"></i>
                </td>

            </tr>
            <?php
                            }
                            ?>
        </tbody>
        <tfoot>
            <tr>

                <th class="">Rec No
                </th>
                <th>Name
                </th>
                <th>Email
                </th>
                <th>Moblie
                </th>
                <th class="">Action
                </th>
            </tr>
        </tfoot>
        <?php
        } 
        ?>
    </table>

</div>
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
    });
</script>
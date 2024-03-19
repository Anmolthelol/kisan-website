<?php include('database.php'); ?>

<div class="table-responsive">
  <table id="dtBasicExample" class="table" cellspacing="0">
      <?php
      $sql = "SELECT * FROM `offers`";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          ?>
      <thead class="position-sticky">
          <tr class="text-uppercase">
              <th class="">
              </th>
              <th class="">offer code
              </th>
              <th class="">Status
              </th>
              <th class="">offer text
              </th>
              <th class="">valid user
              </th>
              <th class="">Expire Time
              </th>
              <th class="">max usage
              </th>
              <th class="">discount type
              </th>
              <th class="">min amount
              </th>
          </tr>
      </thead>
      <tbody>
          <?php
          //$i=0;
          while($row = mysqli_fetch_assoc($result)) {
              //$i++;                       
              ?>
          <tr>
              <td>
              <i class="far fa-edit text-info" style="cursor:pointer;" onclick="updateOffer(<?php echo $row['id']; ?>)"></i>
              <i class="far fa-times-circle text-danger ml-2" style="cursor:pointer;" onclick="deleteOffer(<?php echo $row['id']; ?>)"></i>
              </td>
              <td><u class="text-info" onclick="showModal(<?php echo $row['id']; ?>)" data-toggle="modal" data-target="#offerModal" style="cursor:pointer;" ><?php echo $row['offer_code']; ?></u></td>
              <td>
                <?php if($row['status'] == "1"){ 
                    echo "<span class='badge badge-success'>Enabled</span>";
                }else{
                    echo "<span class='badge badge-danger'>Disabled</span>";
                }  ?> 
              </td>
              <td><?php echo $row['offer_text']; ?></td>
              <td><?php echo $row['valid_user']; ?></td>
              <td><?php echo date("d M h:i:a", strtotime($row['expire_time'])); ?></td>
              <td><?php echo $row['max_usage']; ?></td>
              <td><?php echo $row['discount_type']; ?></td>
              <td><?php echo $row['min_amount']; ?></td>
          </tr>
          <?php
          }
          ?>
      </tbody>
      <?php
      } 
      ?>
  </table>
</div>

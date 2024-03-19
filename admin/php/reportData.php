<?php
include 'database.php';
if(isset($_GET['charts']))
{
  
  if($_GET['charts'] == "Today"){
    $data['label']="Today";
    $sql = "SELECT SUM(subtotal),DATE_FORMAT(DATE(order_date),'%M %d') as date FROM `tbl_order` WHERE  DATE(order_date)=CURDATE()";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row['SUM(subtotal)'] != ""){
      for($i=0;$i<5;$i++){
        if($i== 0){
          $data['labels'][$i]=$row['date'];
          $data['data'][$i]=$row['SUM(subtotal)'];
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
        }else{
          $data['labels'][$i]=0;
          $data['data'][$i]=0;
          $data['borderColor'][$i]="rgba(255,99,132,1)";
          $data['backgroundColor'][$i]="rgba(255, 99, 132, 0.2)";
        }
      }
    }else{
        for($i=0;$i<5;$i++){
          $data['labels'][$i]=0;
          $data['data'][$i]=0;
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
      }
    }
    
  }
  if($_GET['charts'] == "Yesterday"){
    $data['label']="Yesterday";
    $sql = "SELECT SUM(subtotal),DATE_FORMAT(DATE(order_date),'%M %d') as date FROM `tbl_order` WHERE  DATE(order_date)=SUBDATE(CURDATE(),INTERVAL 1 DAY)";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row['SUM(subtotal)'] != ""){
      for($i=0;$i<5;$i++){
        if($i== 0){
          $data['labels'][$i]=$row['date'];
          $data['data'][$i]=$row['SUM(subtotal)'];;
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
        }else{
          $data['labels'][$i]=0;
          $data['data'][$i]=0;
          $data['borderColor'][$i]="rgba(255,99,132,1)";
          $data['backgroundColor'][$i]="rgba(255, 99, 132, 0.2)";
        }
      }
    }else{
      for($i=0;$i<5;$i++){
        
          $data['labels'][$i]=0;
          $data['data'][$i]=0;
          $data['borderColor'][$i]="rgba(255,99,132,1)";
          $data['backgroundColor'][$i]="rgba(255, 99, 132, 0.2)";
      }
    }
    
  }
  if($_GET['charts'] == "Last7days"){
    $data['label']="Last 7 Days";
    for ($i=0; $i<7; $i++){
      $date=date("Y-m-d", strtotime($i." days ago"));
      $sql = "SELECT SUM(subtotal) FROM `tbl_order` WHERE  DATE(order_date) = '$date' GROUP BY DATE(order_date)";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $day=$i+1;
          $data['labels'][$i]=date("F d",strtotime($i." days ago"));
          $data['data'][$i]=$row['SUM(subtotal)'];
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
        }
      }else{
          $data['labels'][$i]=date("F d",strtotime($i." days ago"));
          $data['data'][$i]=0;
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
      }
    }
    
    
  }
  if($_GET['charts'] == "Last15days"){
    $data['label']="Last 15 Days";
    for ($i=0; $i<15; $i++){
      $date=date("Y-m-d", strtotime($i." days ago"));
      $sql = "SELECT SUM(subtotal) FROM `tbl_order` WHERE  DATE(order_date) = '$date' GROUP BY DATE(order_date)";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $day=$i+1;
          $data['labels'][$i]=date("M d", strtotime($i." days ago"));
          $data['data'][$i]=$row['SUM(subtotal)'];
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
        }
      }else{
          $data['labels'][$i]=date("M d", strtotime($i." days ago"));
          $data['data'][$i]=0;
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
      }
    }
  }
  if($_GET['charts'] == "Lastweek"){
    $date=date("W")-2;
    $data['labels']=array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday","Sunday");
    $data['label']="Last Week Sales";
    $data['data']=array("0","0","0","0","0","0","0");
    $sql = "SELECT SUM(subtotal),DAYOFWEEK(order_date) FROM `tbl_order` WHERE  WEEK(order_date,7)=$date GROUP BY DAY(order_date) ORDER BY DAY(order_date) ASC";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)> 0){
      while($row = mysqli_fetch_assoc($result)){
        $x=(int)$row['DAYOFWEEK(order_date)'];
        if($x == "1"){
          $x=6;
        }else{
          $x=$x-2;
        }
        $data['data'][$x]=$row['SUM(subtotal)'];
       
      }
  
    }
    for($i=0;$i<7;$i++){
      $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
      $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
    }
  }
  if($_GET['charts'] == "Lastmonth"){
    $month = date("m")-1;
    $year = date("Y");
    $time=mktime(12, 0, 0, $month, 1, $year);
    $data['label']=date("F", $time);
    $d=cal_days_in_month(CAL_GREGORIAN,$month,$year);
    for ($i=0; $i<$d; $i++){
      $time=mktime(12, 0, 0, $month, $i+1, $year); 
      $date=date('Y-m-d', $time);
      $sql = "SELECT SUM(subtotal) FROM `tbl_order` WHERE  DATE(order_date) = '$date' GROUP BY DATE(order_date)";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $data['labels'][$i]=date("d", $time);
          $data['data'][$i]=$row['SUM(subtotal)'];
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
        }
      }else{
          $data['labels'][$i]=date("d", $time);
          $data['data'][$i]=0;
          $data['borderColor'][$i]="rgba(54, 162, 235, 1)";
          $data['backgroundColor'][$i]="rgba(54, 162, 235, 0.2)";
      }
    }
  }
  
  echo json_encode($data);
}
else if(isset($_GET['tables'])){
  if($_GET['tables'] == "Today"){
    $sql = "SELECT * FROM `tbl_order` INNER JOIN `payment` ON tbl_order.o_id=payment.o_id 
                                      INNER JOIN `user` ON user.u_id=tbl_order.u_id
                                      INNER JOIN `orderd_item_details` ON orderd_item_details.o_id=tbl_order.o_id 
                                      INNER JOIN `user_address` ON user_address.a_id=tbl_order.a_id 
                                      WHERE  DATE(order_date)=CURDATE()";
    // echo $sql;
  }
  if($_GET['tables'] == "Yesterday"){
      $sql = "SELECT * FROM `tbl_order` INNER JOIN `payment` ON tbl_order.o_id=payment.o_id 
                                        INNER JOIN `user` ON user.u_id=tbl_order.u_id
                                        INNER JOIN `orderd_item_details` ON orderd_item_details.o_id=tbl_order.o_id 
                                        INNER JOIN `user_address` ON user_address.a_id=tbl_order.a_id 
                                        WHERE  DATE(order_date)=SUBDATE(CURDATE(),INTERVAL 1 DAY)";
  }
  if($_GET['tables'] == "Last7days"){
    $sql = "SELECT * FROM `tbl_order` INNER JOIN `payment` ON tbl_order.o_id=payment.o_id 
                                      INNER JOIN `user` ON user.u_id=tbl_order.u_id
                                      INNER JOIN `orderd_item_details` ON orderd_item_details.o_id=tbl_order.o_id
                                      INNER JOIN `user_address` ON user_address.a_id=tbl_order.a_id 
                                      WHERE  order_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()";
    echo $sql;
  }
  if($_GET['tables'] == "Last15days"){
    $sql = "SELECT * FROM `tbl_order` INNER JOIN `payment` ON tbl_order.o_id=payment.o_id 
                                      INNER JOIN `user` ON user.u_id=tbl_order.u_id
                                      INNER JOIN `orderd_item_details` ON orderd_item_details.o_id=tbl_order.o_id
                                      INNER JOIN `user_address` ON user_address.a_id=tbl_order.a_id 
                                      WHERE  order_date BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()";
  }
  if($_GET['tables'] == "Lastweek"){
    $date=date("W")-2;
    $sql = "SELECT * FROM `tbl_order` INNER JOIN `payment` ON tbl_order.o_id=payment.o_id 
                                      INNER JOIN `user` ON user.u_id=tbl_order.u_id
                                      INNER JOIN `orderd_item_details` ON orderd_item_details.o_id=tbl_order.o_id
                                      INNER JOIN `user_address` ON user_address.a_id=tbl_order.a_id 
                                      WHERE  WEEK(order_date,7)=$date";
  }
  if($_GET['tables'] == "Lastmonth"){
      $month=date("m")-1;
      $month = date("m")-1;
      $year = date("Y");
      $time=mktime(12, 0, 0, $month, 1, $year);
      $sql = "SELECT * FROM `tbl_order` INNER JOIN `payment` ON tbl_order.o_id=payment.o_id 
                                        INNER JOIN `user` ON user.u_id=tbl_order.u_id
                                        INNER JOIN `orderd_item_details` ON orderd_item_details.o_id=tbl_order.o_id
                                        INNER JOIN `user_address` ON user_address.a_id=tbl_order.a_id 
                                        WHERE  MONTH(order_date)=$month";
  }
  if($_GET['tables'] == "FromTo"){
    $from= $_GET['from'];
    $to= $_GET['to'];
    $from=date("Y-m-d",strtotime($from));
    $to=date("Y-m-d",strtotime($to));
    // echo $from;
    // echo $to;
    $sql = "SELECT * FROM `tbl_order` INNER JOIN `payment` ON tbl_order.o_id=payment.o_id 
                                        INNER JOIN `user` ON user.u_id=tbl_order.u_id
                                        INNER JOIN `orderd_item_details` ON orderd_item_details.o_id=tbl_order.o_id
                                        INNER JOIN `user_address` ON user_address.a_id=tbl_order.a_id 
                                      WHERE  DATE(order_date) >= '$from' AND DATE(order_date) <= '$to'";
                                      // echo $sql;
  }
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $sql2="SELECT * FROM `item` where id=".$row['i_id'];
      $result2=mysqli_query($conn, $sql2);
      $row2=mysqli_fetch_assoc($result2);
      echo "<tr>";
      echo "<td><b>".$row['o_id']."</b></td>";
      echo "<td>".$row['name']."</td>";
      echo "<td>".$row['order_status']."</td>";
      echo "<td>".$row['subtotal']."</td>";
      echo "<td>".$row['discount']."</td>";
      echo "<td>".date("d F,Y h:i:a", strtotime($row['order_date']))."</td>";
      echo "<td>".$row['status']."</td>";
      echo "<td>".$row2['item_name']."</td>";
      echo "<td>".$row['quantity']."</td>";
      echo "<td>".$row['price']."</td>";
      echo "<td>".$row['pincode']."</td>";
      echo "</tr>";
    }
  }
  
  
}
else
{
  $date=date("W")-1;
  $sql = "SELECT SUM(subtotal) FROM `tbl_order` WHERE  WEEK(order_date,7)=$date";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $data['totalsales']=array("0","0","0","0","0","0","0");
  $sql = "SELECT SUM(subtotal),DAYOFWEEK(order_date) FROM `tbl_order` WHERE  WEEK(order_date,7)=$date GROUP BY DAY(order_date) ORDER BY DAY(order_date) ASC";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)> 0){
    while($row = mysqli_fetch_assoc($result)){
      $x=(int)$row['DAYOFWEEK(order_date)'];
      if($x == "1"){
        $x=6;
      }else{
        $x=$x-2;
      }
      $data['totalsales'][$x]=$row['SUM(subtotal)'];
    }

  }else{
    unset($data);
    $data=0;
  }
  echo json_encode($data);
}
?>
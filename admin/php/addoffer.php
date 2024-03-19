<?php 
include('database.php');
if(isset($_GET['insert'])){ ?>
<form method="POST" id="offerForm" autocomplete="off" class="form w-50 needs-validation  font-weight-bolder" style="color: #58666e;" novalidate>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Offer Code </label>
        <div class="col-lg-8">
            <div class="input-group">
                <input class="form-control" type="text" name="offercodeinsert" id="offercode" placeholder="Example:WELCOME50" required=""
                    style="text-transform: uppercase;"><span class="ml-1 text-danger font-weight-bold">*</span>
            </div>
            <small class="ml-1 text-danger" style="display: none" id="offercodeErr">offer code is not availbal</small>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Display Text </label>
        <div class="col-lg-9">
            <div class="input-group">
                <input class="form-control" type="text" name="offerText" placeholder="50% off on First Order" required=""><span
                    class="ml-1 text-danger font-weight-bold">*</span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label mt-4">Exprie Date&Time </label>
        <div class="col-lg-9">
            <div class="input-group">
                <div class="md-form d-inline-block">
                    <input type="text" id="date3" class="form-control datepicker" name="edate" required="">
                    <label for="date">Date</label>
                </div>
                <div class="md-form d-inline-block float-md-right">
                    <input type="text" id="input_starttime" class="form-control timepicker" name="etime" required="">
                    <label for="input_starttime" class="w-100 h-100">Time</label>
                </div>
                <span class="ml-1 text-danger font-weight-bold">*</span>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Select Users</label>
        <div class="col-lg-7">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" value="alluser" id="alluser" name="user" checked>
                <label class="custom-control-label" for="alluser">All</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" value="newuser" id="newuser" name="user">
                <label class="custom-control-label" for="newuser">Only For New User</label>
            </div>
        </div>
    </div>
    <div class="form-group row mt-2">
        <label class="col-lg-3 col-form-label form-control-label">Max Usage</label>
        <div class="col-lg-8">
            <div class="input-group">
                <input type="number" class="form-control" id="maxusage" name="maxusage"
                    placeholder="Max Usage of this offer: Example - 5 times" required=""><span
                    class="ml-1 text-danger font-weight-bold">*</span>
            </div>
        </div>
    </div>
    <div class="form-group row mt-2">
        <label class="col-lg-3 col-form-label form-control-label">Discount Type</label>
        <div class="col-lg-7">
            <select class="form-control" id="discount_type" name="discount_type" size="0" required="" style="display: block!important;">
                <option value="flat">Flat</option>
                <option value="percent">Percentage</option>
            </select>
        </div>
    </div>
    <div class="form-group row ">
        <label class="col-lg-3 col-form-label form-control-label">Minimum Order amount</label>
        <div class="col-lg-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text font-weight-bold">₹</div>
                </div>
                <input type="number" class="form-control mt-0" name="min_amount" placeholder="0"
                    required="" min="1"><span class="ml-1 text-danger font-weight-bold">*</span>
            </div>
        </div>
    </div>
    <div class="form-group row hideFlat">
        <label class="col-lg-3 col-form-label form-control-label">Flat Discount Amount</label>
        <div class="col-lg-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text font-weight-bold">₹</div>
                </div>
                <input type="number" class="form-control" id="flat_discount_amount" name="flat_discount_amount" placeholder="0"
                required="" min="1"><span class="ml-1 text-danger font-weight-bold">*</span>
            </div>
        </div>
    </div>
    <div class="form-group row hidePercentage" style="display: none">
        <label class="col-lg-3 col-form-label form-control-label">Discount Worth</label>
        <div class="col-lg-4">
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="discount_percentage" name="discount_percentage" min="1" placeholder="0" required="">
                <div class="input-group-append">
                    <div class="input-group-text">%</div>
                    <span class="ml-1 text-danger font-weight-bold">*</span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row hidePercentage" style="display: none">
        <label class="col-lg-3 col-form-label form-control-label">Maximum Discount </label>
        <div class="col-lg-4">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text font-weight-bold">₹</div>
                </div>
                <input type="text" class="form-control" id="max_discount_amount" name="max_discount_amount" min="1" placeholder="0" required=""><span class="ml-1 text-danger font-weight-bold">*</span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label"></label>
        <div class="col-lg-9">
            <input class="btn btn-danger w3-myfont" type="reset" value="Cancel" onclick="offerTable()">
            <input class="btn btn-primary w3-myfont" type="submit" value="CREATE  OFFER" onclick="validForm()">
        </div>
    </div>
</form>
<script>
    $('.datepicker').pickadate({
            min: new Date(),
            format: 'yyyy-mm-d'
    });
    $('#input_starttime').pickatime({});
    $(document).ready(function() {
        $(".datepicker").removeAttr('readonly');
        $("#discount_percentage").removeAttr('required');
        $("#max_discount_amount").removeAttr('required');
        $('input[type=radio][name=user]').change(function() {
            if (this.value == 'alluser') {
                $("#maxusage").val("");
                $("#maxusage").removeClass("disabled");
            } else if (this.value == 'newuser') {
                $("#maxusage").val("1");
                $("#maxusage").addClass("disabled");
            }
        });
        $("#discount_type").change(function() {
            if ($(this).val() == "percent") {
                $("#flat_discount_amount").removeAttr('required');
                $(".hideFlat").hide();
                $(".hidePercentage").show();
                $("#discount_percentage").attr("required", "true");
                $("#max_discount_amount").attr("required", "true");

            } if ($(this).val() == "flat") {
                $("#discount_percentage").removeAttr('required');
                $("#max_discount_amount").removeAttr('required');
                $(".hidePercentage").hide();
                $(".hideFlat").show();
                $("#flat_discount_amount").attr("required", "true");

               
            }
        });
       
    });
</script>
<?php
}
if(isset($_GET['update'])){
$id=$_GET['update'];
$sql = "SELECT * FROM `offers` where id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);   

?>
<form method="POST" id="offerUpdateForm" autocomplete="off" class="form w-50 needs-validation  font-weight-bolder" style="color: #58666e;" novalidate>
    <input type="hidden" name="updateid" value="<?php echo $row['id']; ?>">
    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Offer Code </label>
        <div class="col-lg-8">
            <div class="input-group">
                <input class="form-control" type="text" name="offercodeupdate" id="offercode" placeholder="Example:WELCOME50" required=""
                    style="text-transform: uppercase;" value="<?php echo $row['offer_code']; ?>"><span class="ml-1 text-danger font-weight-bold">*</span>
            </div>
            <small class="ml-1 text-danger" style="display: none" id="offercodeErr">offer code is not availbal</small>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Display Text </label>
        <div class="col-lg-9">
            <div class="input-group">
                <input class="form-control" type="text" name="offerText" placeholder="50% off on First Order" value="<?php echo $row['offer_text']; ?>" required=""><span
                    class="ml-1 text-danger font-weight-bold">*</span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label mt-4">Exprie Date&Time </label>
        <div class="col-lg-9">
            <div class="input-group">
                <div class="md-form d-inline-block">
                    <input type="text" id="date" class="form-control datepicker" name="edate" value="<?php echo date('Y-m-d', strtotime($row['expire_time'])); ?>" required="">
                    <label for="date" class="active">Date</label>
                </div>
                <div class="md-form d-inline-block float-md-right">
                    <input type="text" id="input_starttime" class="form-control timepicker" value="<?php echo date('h:i', strtotime($row['expire_time'])); ?>" name="etime" required="">
                    <label for="input_starttime" class="active">Time</label>
                </div>
                <span class="ml-1 text-danger font-weight-bold">*</span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Select Users</label>
        <div class="col-lg-7">
        <?php
            if($row['valid_user'] == "alluser"){ ?>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" value="alluser" id="alluser" name="user" checked>
                <label class="custom-control-label" for="alluser">All</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" value="newuser" id="newuser" name="user">
                <label class="custom-control-label" for="newuser">Only For New User</label>
            </div>
            <?php
            }else{ ?>
                <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" value="alluser" id="alluser" name="user">
                <label class="custom-control-label" for="alluser">All</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" value="newuser" id="newuser" name="user" checked>
                <label class="custom-control-label" for="newuser">Only For New User</label>
            </div>
            <?php

            }

        ?>
        </div>
    </div>
    
    <div class="form-group row mt-2">
        <label class="col-lg-3 col-form-label form-control-label">Max Usage</label>
        <div class="col-lg-8">
            <div class="input-group">
                <input type="number" class="form-control" id="maxusage" name="maxusage"
                    placeholder="Max Usage of this offer: Example - 5 times" required="" value="<?php echo $row['max_usage']; ?>"><span
                    class="ml-1 text-danger font-weight-bold">*</span>
            </div>
        </div>
    </div>
    <div class="form-group row mt-2">
        <label class="col-lg-3 col-form-label form-control-label">Discount Type</label>
        <div class="col-lg-7">
            <select class="form-control" id="discount_type" name="discount_type" size="0" required="" style="display: block!important;">
                <?php
                    if($row['discount_type'] == "flat"){ ?>
                        <option value="flat">Flat</option>
                        <option value="percent">Percentage</option>
                        <?php
                    }else{ ?>
                        <option value="flat">Flat</option>
                        <option value="percent" selected>Percentage</option>
                        <?php
                    }
                ?>
                
            </select>
        </div>
    </div>
    <div class="form-group row ">
        <label class="col-lg-3 col-form-label form-control-label">Minimum amount</label>
        <div class="col-lg-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text font-weight-bold">₹</div>
                </div>
                <input type="number" class="form-control" name="min_amount" placeholder="0"
                    required="" min="1" value="<?php echo $row['min_amount']; ?>"><span class="ml-1 text-danger font-weight-bold">*</span>
            </div>
        </div>
    </div>
    <div class="form-group row hideFlat " style="display: none">
        <label class="col-lg-3 pr-0 col-form-label form-control-label">Flat Discount Amount</label>
        <div class="col-lg-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text font-weight-bold">₹</div>
                </div>
                <input type="number" class="form-control" id="flat_discount_amount" name="flat_discount_amount" placeholder="0"
                required="" min="1" value="<?php echo $row['flat_discount_amount']; ?>"><span class="ml-1 text-danger font-weight-bold">*</span>
            </div>
        </div>
    </div>
    <div class="form-group row hidePercentage" style="display: none">
        <label class="col-lg-3 pr-0 col-form-label form-control-label">Discount Worth</label>
        <div class="col-lg-4">
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="discount_percentage" name="discount_percentage" 
                min="1" placeholder="0" required="" value="<?php echo $row['discount_percentage']; ?>">
                <div class="input-group-append">
                    <div class="input-group-text">%</div>
                    <span class="ml-1 text-danger font-weight-bold">*</span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row pr-0 hidePercentage" style="display: none">
        <label class="col-lg-3 col-form-label form-control-label">Maximum Discount </label>
        <div class="col-lg-4">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text font-weight-bold">₹</div>
                </div>
                <input type="text" class="form-control" id="max_discount_amount" name="max_discount_amount" 
                min="1" placeholder="0" required="" value="<?php echo $row['max_discount_amount']; ?>"><span class="ml-1 text-danger font-weight-bold">*</span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label"></label>
        <div class="col-lg-9">
            <input class="btn btn-danger w3-myfont" type="reset" value="Cancel" onclick="offerTable()">
            <input class="btn btn-primary w3-myfont" type="submit" value="UPDATE  OFFER" onclick="validUpdateForm()">
        </div>
    </div>
</form>
<script>
    $('.datepicker').pickadate({
            min: new Date(),
            date: { year: 2020, month: 5, day: 20 },
            format: 'yyyy-mm-d'
    });
    $('#input_starttime').pickatime({});
    $(document).ready(function() {
        if($("#discount_type").val() == "flat"){
                $("#discount_percentage").removeAttr('required');
                $("#max_discount_amount").removeAttr('required');
                $(".hidePercentage").hide();
                $(".hideFlat").show();
                $("#flat_discount_amount").attr("required", "true");
        }
        if($("#discount_type").val() == "percent"){
                $("#flat_discount_amount").removeAttr('required');
                $(".hideFlat").hide();
                $(".hidePercentage").show();
                $("#discount_percentage").attr("required", "true");
                $("#max_discount_amount").attr("required", "true");
        }
        $('input[type=radio][name=user]').change(function() {
            if (this.value == 'alluser') {
                $("#maxusage").val("");
                $("#maxusage").removeClass("disabled");
            } else if (this.value == 'newuser') {
                $("#maxusage").val("1");
                $("#maxusage").addClass("disabled");
            }
        });
        $("#discount_type").change(function() {
            if ($(this).val() == "percent") {
                $("#flat_discount_amount").removeAttr('required');
                $(".hideFlat").hide();
                $(".hidePercentage").show();
                $("#discount_percentage").attr("required", "true");
                $("#max_discount_amount").attr("required", "true");
            } if ($(this).val() == "flat") {
                $("#discount_percentage").removeAttr('required');
                $("#max_discount_amount").removeAttr('required');
                $(".hidePercentage").hide();
                $(".hideFlat").show();
                $("#flat_discount_amount").attr("required", "true");
            }
        });
       
    });
</script>
<?php
}
?>
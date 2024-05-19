<?php
include_once "query.php";
include_once "header.php";
?>

<div class="container p-5 mt-5">
    <form action="" method="post">
<div class="form-group ">
  <label for="">Name</label>
  <input type="text" name="uname" value="<?php echo $uName ?>" id="" class="form-control" placeholder="" aria-describedby="helpId">
  <small id="helpId" class="text-danger"><?php echo $unameerr ?></small>
</div>
<div class="form-group">
  <label for="">Email</label>
  <input type="text" name="uemail" value="<?php echo $uEmail ?>" id="" class="form-control" placeholder="" aria-describedby="helpId">
  <small id="helpId" class="text-danger"><?php echo $uemailerr ?></small>
</div>
<div class="form-group">
  <label for="">Password</label>
  <input type="text" name="upwd" value="<?php echo $uPwd ?>" id="" class="form-control" placeholder="" aria-describedby="helpId">
  <small id="helpId" class="text-danger"><?php echo $upwderr ?></small>
</div>
<div class="form-group">
  <label for="">Confirm Password</label>
  <input type="text" name="ucpwd" value="<?php echo $ucPwd ?>" id="" class="form-control" placeholder="" aria-describedby="helpId">
  <small id="helpId" class="text-danger"><?php echo $ucpwderr ?></small>
</div>
<button type="submit" class="btn btn-primary" name="signUp">Sign Up</button>
</form>
</div>

<?php
include_once "footer.php";
?>
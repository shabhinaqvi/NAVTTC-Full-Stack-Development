<?php
include_once "query.php";
include_once "header.php";
if(isset($_SESSION['useremail'])){
    echo "<script>location.assign('index')</script>";
}
?>

<div class="container p-5 mt-5">
   <div class="row">
    <div class="col">
    <form action="" method="post">
        <div class="form-group">
            <label for="">Enter Email or Username</label>
            <input type="text" name="loginname" value="" id="" class="form-control" placeholder="" aria-describedby="helpId">
            <small id="helpId" class="text-danger"><?php echo $loginnameerr ?></small>
        </div>
        <div class="form-group">
            <label for="">Enter Password</label>
            <input type="password" name="loginpwd" value="" id="" class="form-control" placeholder="" aria-describedby="helpId">
            <small id="helpId" class="text-danger"><?php echo $loginpwderr ?></small>
        </div>

            <button type="submit" class="btn btn-primary" name="login">Login</button>
    </form>
    </div>
    <div class="col"></div>
   </div>
</div>

<?php
include_once "footer.php";
?>
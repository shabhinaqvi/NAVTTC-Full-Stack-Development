<?php
include('query.php');
include('header.php');
?>
<?php
if(isset($_GET['id'])){
    $id= $_GET['id'];

    $query = $pdo->prepare("select * from categories where id = :cid");
    $query->bindParam('cid',$id);
    $query-> execute();
    $singleCat = $query->fetch(PDO::FETCH_ASSOC);
    // print_r($singleCat);    
}
?>

            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded mx-0">
                    <div class="col-md-10">
                        <h3>Add Category</h3>

                <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group" >
                    <label for="">Category Name</label>
                    <input type="text"  value="<?php echo $singleCat['Name']?>" name="cName" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" value="<?php echo $singleCat['Description']?>" name="cDesc" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                   <label for="">Image</label>
                    <input type="file" name="cImage" id="" class="form-control" placeholder="" aria-describedby="helpId">
                <img height="100px" src="img/<?php echo $singleCat['image']?>" />
                </div>
                
                <button class="btn btn-info" name="updatebtn">Update Record</button>
                </form> 
            </div>
            </div>
</div>


<?php
include('footer.php');
?>
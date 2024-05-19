<?php
include('query.php');
include('header.php');
?>

            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded mx-0">
                    <div class="col-md-10">
                        <h3>Add Product</h3>

                <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group" >
                    <label for="">Product Name</label>
                    <input type="text" name="pName" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" name="pDesc" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" name="pPrice" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="text" name="pQty" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                
                <div class="form-group">
                   <label for="">Image</label>
                    <input type="file" name="pImage" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Product Category</label>
                    <select name="pCat" id="" class="form-control" >
                    <option value="">Select Option</option>
                    <?php
                        $query = $pdo->query("select * from categories");
                        
                        $allCat = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($allCat as $CAT) {
                        ?>
                        <option value="<?php echo $CAT['id']?>"><?php echo $CAT['Name']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <button class="btn btn-info" name="addProduct">Add Product</button>
                </form> 
            </div>
            </div>
</div>


<?php
include('footer.php');
?>
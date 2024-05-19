<?php
include('query.php');
include('header.php');
?>
<?php
if(isset($_GET['id'])){
    $id= $_GET['id'];

    $query = $pdo->prepare("select products.* , categories.Name as CatName from products
    join categories on products.catid=categories.id where products.id = :pid");
    $query->bindParam('pid',$id);..

    
    $query-> execute();
    $singlePro = $query->fetch(PDO::FETCH_ASSOC);
    // print_r($singlePro);    
}
?>

            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded mx-0">
                    <div class="col-md-10">
                        <h3>Edit Product</h3>
                        <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group" >
                    <label for="">Product Name</label>
                    <input type="text" value="<?php echo $singlePro['name']?>" name="pName" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" value="<?php echo $singlePro['description']?>" name="pDesc" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" value="<?php echo $singlePro['price']?>" name="pPrice" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Quantity</label>
                    <input type="text" value="<?php echo $singlePro['quantity']?>" name="pQty" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                
                <div class="form-group">
                   <label for="">Image</label>
                    <input type="file"  name="pImage" id="" class="form-control" placeholder="" aria-describedby="helpId">
               <img height="100px" src="img/<?php echo $singlePro['image']?>" alt="">
                </div>
                <div class="form-group">
                    <label for="">Product Category</label>
                    <select name="pCat" id="" class="form-control" >
                    <option value="<?php echo $singlePro['catid']?>"><?php echo $singlePro['CatName']?></option>
                    <?php
                        $query = $pdo->prepare("select * from categories where Name != :catName");
                        $query->bindParam('catName', $singlePro['CatName']);
                        $query->execute();
                        $allCat = $query->fetchAll(PDO::FETCH_ASSOC);
                        print_r($allCat);
                        foreach ($allCat as $CAT) {
                        ?>
                        <option value="<?php echo $CAT['id']?>"><?php echo $CAT['Name']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <button class="btn btn-info" name="updateProduct">Update Product</button>
                </form> 
                </div>
            </div>
</div>


<?php
include('footer.php');
?>
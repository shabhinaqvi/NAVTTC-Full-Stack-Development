<?php
include('query.php');
include('header.php');
?>

            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded mx-0">
                    <div class="col-md-10">
                        <h3>View Product</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $pdo->query("SELECT categories.Name as CatName, products.* from products join categories on categories.id = products.catid");
                                    $allProducts = $query->fetchAll(PDO::FETCH_ASSOC);
                                    // print_r($allCat);
                                    foreach($allProducts as $Product){
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $Product['name'] ?></td>
                                        <td><?php echo $Product['description'] ?></td>
                                        <td><?php echo $Product['price'] ?></td>
                                        <td><?php echo $Product['quantity'] ?></td>
                                        <td> <img height="50px" src="img/<?php echo $Product['image'] ?>" alt=""> </td>
                                        <td><?php echo $Product['CatName'] ?></td>
                                        <td><a href="editProduct.php?id=<?php echo $Product['id']?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="?did=<?php echo $Product['id']?>" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                   <?php
                                   }
                                   ?>
                                </tbody>
                            </table>
            
            </div>
            </div>
</div>


<?php
include('footer.php');
?>
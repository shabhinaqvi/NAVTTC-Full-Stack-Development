<?php
include('query.php');
include('header.php');
?>

            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded mx-0">
                    <div class="col-md-10">
                        <h3>View Category</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $pdo->query("select * from categories");
                                    $allCat = $query->fetchAll(PDO::FETCH_ASSOC);
                                    // print_r($allCat);
                                    foreach($allCat as $category){

                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $category['Name'] ?></td>
                                        <td><?php echo $category['Description'] ?></td>
                                        <td> <img height="50px" src="img/<?php echo $category['image'] ?>" alt=""> </td>
                                        <td><a href="editCat.php?id=<?php echo $category['id']?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="?cid=<?php echo $category['id']?>" class="btn btn-danger">Delete</a></td>
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
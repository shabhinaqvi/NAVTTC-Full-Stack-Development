<?php
include('header.php');
?>

            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded mx-0">
                    <div class="col-md-10">
                        <h3>Add Category</h3>

                <form action="query.php" method="post" enctype="multipart/form-data">
                <div class="form-group" >
                    <label for="">Category Name</label>
                    <input type="text" name="cName" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" name="cDesc" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                   <label for="">Image</label>
                    <input type="file" name="cImage" id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                
                <button class="btn btn-info" name="add">Add</button>
                </form> 
            </div>
            </div>
</div>


<?php
include('footer.php');
?>
<?php
include('dbcon.php');
session_start();
//-- Add Category Start --

if(isset($_POST['add'])){
    $catname = $_POST['cName'];
    $catdesc = $_POST['cDesc'];
    $catimg = $_FILES['cImage']['name'];
    $cattemimg = $_FILES['cImage']['tmp_name'];
    $extension = pathinfo($catimg,PATHINFO_EXTENSION);
    $destination = "img/".$catimg;
    if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension== "jfif"){
        if(move_uploaded_file($cattemimg,$destination)){
            $query = $pdo->prepare("insert into categories (Name, Description, image) values (:categoryName, :categoryDesc, :categoryImage)");
            $query->bindParam('categoryName',$catname);
            $query->bindParam('categoryDesc',$catdesc);
            $query->bindParam('categoryImage',$catimg);
            $query->execute();
            echo "<script>alert('Category Data Added')
            location.assign('index.php')
            </script>";
        }          
        }
        else{
            echo "<script>alert('invalid file formate') </script>";       
        }
    }
//-- Add Category End --

//-- Update Category start --

if(isset($_POST['updatebtn'])){
    $catname = $_POST['cName'];
    $catdesc = $_POST['cDesc'];
    $id = $_GET['id'];
    // echo $id;
    $query = $pdo->prepare("update categories set Name=:cName, Description=:cDesc where id = :cid");
    if(isset($_FILES['cImage'])){
        $catimg = $_FILES['cImage']['name'];
        $cattemimg = $_FILES['cImage']['tmp_name'];
        $extension = pathinfo($catimg, PATHINFO_EXTENSION);
        $destination = "img/" . $catimg;
        if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension== "jfif"){
            if(move_uploaded_file($cattemimg, $destination)){
                $query = $pdo->prepare("UPDATE categories SET Name=:cName, Description=:cDesc, image=:cImage WHERE id=:cid");
                $query->bindParam(':cName', $cName); 
                $query->bindParam(':cDesc', $cDesc);
                $query->bindParam(':cImage', $catimg);
                $query->bindParam(':cid', $cid);
                $query->execute();
            } else {
                echo "Error: File upload failed.";
                }
        } else{
            echo "Error: Unsupported file format.";
        }
    }
            $query->bindParam(':cName',$catname);
            $query->bindParam(':cDesc',$catdesc);
            $query->bindParam(':cid', $id);
            $query->execute();
            echo "<script>alert('Category Data updated successfully')
            location.assign('viewCategory.php')
            </script>";
      
}
//-- Update Category End --

//-- Add Product start --
if(isset($_POST['addProduct'])){
    $proName = $_POST['pName'];
    $proDesc = $_POST['pDesc'];
    $proPrice = $_POST['pPrice'];
    $proQty = $_POST['pQty'];
    $proImage = $_FILES['pImage']['name'];
    $proTmpImage = $_FILES['pImage']['tmp_name'];
    $proCat = $_POST['pCat'];
    $extension = pathinfo($proImage,PATHINFO_EXTENSION);
    $destination = "img/".$proImage;
    if($extension == "jpg" || $extension == "png" || $extension == "jpeg" || $extension== "jfif"){
        if(move_uploaded_file($proTmpImage,$destination)){
            $query = $pdo->prepare("insert into products (name, description, price, quantity, image, catid) values (:proName, :proDesc, :proPrice, :proQty, :proImg, :proCat)");
            $query->bindParam('proName',$proName);
            $query->bindParam('proDesc',$proDesc);
            $query->bindParam('proPrice',$proPrice);
            $query->bindParam('proQty',$proQty);
            $query->bindParam('proImg',$proImage);
            $query->bindParam('proCat',$proCat);
            $query->execute();
            echo "<script>alert('Product Added Successfully')
            location.assign('viewProduct.php')
            </script>";
        }          
    }
        else{
            echo "<script>alert('invalid file formate') </script>";       
        }
}
//-- Add Product End --

//-- Update Product start --

if(isset($_POST['updateProduct'])){
    $pName = $_POST['pName'];
    $pDesc = $_POST['pDesc'];
    $pPrice = $_POST['pPrice'];
    $pQty = $_POST['pQty'];
    $pCat = $_POST['pCat'];
    $id= $_GET['id'];

    $query = $pdo->prepare("update products set name=:pname, description = :pdesc, price = :pprice, quantity = :pqty, catid = :pCat where id=:pid ");
    // check if image needs to be update
    if(isset($_POST['pImage'])){
        $pImage = $_FILES['pImage']['name'];
        $pTmpImage = $_FILES['pImage']['tmp_name'];
        $extension = pathinfo('$pImage', PATHINFO_EXTENSION);
        $destination = "img/" . $pImage;
        if($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension== "jfif"){
            if(move_uploaded_file($pTmpImage,$destination)){
                $query= $pdo->prepare("update products set name=:pname, description = :pdesc, price = :pprice, quantity = :pqty, image=:pimage , catid = :pCat where id=:pid");
                $query->bindParam('pimage', $pImage);
            }
        }
    }
    $query->bindParam(':pname', $pName);
    $query->bindParam(':pdesc', $pDesc);
    $query->bindParam(':pprice', $pPrice);
    $query->bindParam(':pqty', $pQty);
    $query->bindParam(':pCat', $pCat);
    $query->bindParam(':pid', $id);
    $query->execute();
    echo "<script>alert('Product Data updated successfully')
    location.assign('viewProduct.php')</script>";
}
//-- Update Product End --

// -- Delete Category --
if(isset($_GET['cid'])){
    $id= $_GET['cid'];
    $query = $pdo->prepare("delete from categories where id= :cid");
    $query->bindParam(':cid', $id);
    $query->execute();
    echo "<script>alert('Category Deleted');
    location.assign('viewCategory.php')</script>";
}


// -- Delete Product -- 
if(isset($_GET['did'])){
    $id = $_GET['did'];
    $query = $pdo->prepare("delete from products where id = :pid");
    $query->bindParam(':pid', $id);
    $query->execute();
    echo "<script>alert('Product deleted');
    location.assign('viewProduct.php') 
     </script>";
}



?>
<?php
    include 'product.php';
    header("Content-type: text/html; charset=utf-8");
    //1. Get data sent from client via <form method = get>
    //Link test: /postcontroller?action=create
    $action = $_GET["action"];
    // echo $action;
    // die();

    $post = new Post();
    if($action == "create")
    {
        //Link test: postcontroller?action=create&productName=Iphone&salePrice=30000000&categoryName=phone&imageLink=https://cdn.cellphones.com.vn/media/catalog/product/cache/7/image/9df78eab33525d08d6e5fb8d27136e95/i/p/iphone-12-mini-blue-select-2020_4_2.png&productLink=https://cellphones.com.vn/iphone-12-mini-da-kich-hoat.html
        $post->productName = $_GET["productName"];
        $post->regularPrice = $_GET["salePrice"];
        $post->salePrice = $_GET["salePrice"];
        $post->categoryName = $_GET["categoryName"];
        $post->imageLink = $_GET["imageLink"];
        $post->productLink = $_GET["productLink"];
        // var_dump($post);
        // die();
        // Insert input to Database
        createPost($post);

    }
    else if($action == "delete")
    {
        //Delte post from database
        //Link test:http://localhost:8080/dealcongnghe/server/postcontroller?action=delete&id=1
        $post->Id = $_GET["id"];
        deletePost($post->Id);

    }
    else if($action == "search")
    {
        //Search request
        //Link test:http://localhost:8080/dealcongnghe/server/postcontroller?action=search&keyword=iphone
        $keyword = $_GET["keyword"];
        searchPost($keyword);
    }
    else if($action == "update")
    {
        //Update equest
        //Link test:postcontroller?action=update&id=2&productName=Iphone&salePrice=30000000&categoryName=phone&imageLink=https://cdn.cellphones.com.vn/media/catalog/product/cache/7/image/9df78eab33525d08d6e5fb8d27136e95/i/p/iphone-12-mini-blue-select-2020_4_2.png&productLink=https://cellphones.com.vn/iphone-12-mini-da-kich-hoat.html
        $newpost = new Post();
        $newpost->Id = $_GET["id"];
        $newpost->productName = $_GET["productName"];
        $newpost->regularPrice = $_GET["salePrice"];
        $newpost->salePrice = $_GET["salePrice"];
        $newpost->categoryName = $_GET["categoryName"];
        $newpost->imageLink = $_GET["imageLink"];
        $newpost->productLink = $_GET["productLink"];
        updatePost($newpost);
    }
    
    function createPost($post){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dealcongnghe";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO product (ProductName,RegularPrice,SalePrice,CategoryName,ImageLink,ProductLink)
        VALUES ('$post->productName','$post->regularPrice','$post->salePrice','$post->categoryName','$post->imageLink',
        '$post->productLink');";
        // echo $sql;
        // die();

        if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        //Close connection to database
        $conn->close();
    }
    function deletePost($postId){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dealcongnghe";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM product WHERE Id=$postId";
        // echo $sql;
        // die();

        if ($conn->query($sql) === TRUE) {
        echo "Product with id $postId has been deleted from database";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        //Close connection to database
        $conn->close();
    }
    function searchPost($keyword)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dealcongnghe";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_set_charset($conn, 'UTF8');
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM product WHERE ProductName LIKE '%$keyword%' LIMIT 100;";
        // echo $sql;
        // die();
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            echo "<table><tr><th>Id</th><th>ProductName</th><th>ImageLink</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" .$row["Id"] ."</td><td>" .$row["ProductName"] ."</td><td><img src=' " .$row["ImageLink"] ."'/>
                </td></tr>";
            }
            echo "</table>";
        } else {
        echo "0 results";
        }

        //Close connection to database
        $conn->close();
    }
    function updatePost($newpost )
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dealcongnghe";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE product SET ProductName = '$newpost->productName', RegularPrice = '$newpost->salePrice',
        SalePrice = '$newpost->salePrice',CategoryName = '$newpost->categoryName', ImageLink = '$newpost->imageLink', ProductLink = '$newpost->productLink'
        WHERE Id = '$newpost->Id'";  
        // echo $sql;
        // die();

        if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }
        
        //Close connection to database
        $conn->close();
    }
?>
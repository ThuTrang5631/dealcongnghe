<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DealCongNghe.Com</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <!-- FontAwsome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Roboto" >

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
      body {
        font-family: 'Roboto';
      }

      #left-sidebar, #main-content {
        height: 500px;
        border: 1px solid red;
        margin-bottom: 50px;
      }

      #footer {        
        text-align: center;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed"
            data-toggle="collapse" data-target="#navbar-collapse"
            aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">DealCongNghe.Com</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
          <!-- <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Sản Phẩm</a></li>
			<li><a href="#">About Us</a></li>            
          </ul> -->
          <ul class="nav navbar-nav navbar-right">
            <li><a href="createpost.html">Đăng Tin</a></li>
            <!-- <li><a href="#">Đăng Ký</a></li> -->
          </ul>
		  <ul class="nav navbar-nav navbar-right">
            <li><a href="managepost.html">Quản Lý Tin Đăng</a></li>
            <!-- <li><a href="#">Đăng Ký</a></li> -->
          </ul>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>

    <!-- Place your code at here! -->
    <div id="main">		
      <div class="container">
		<h2>Quản lý tin đăng</h2>
    <form action="http://localhost:8080/dealcongnghe/server/postcontroller" method ="GET">
    <div id="main">		
      <div class="container">		
		    <div class="input-group">
        <input type="hidden" name ="action" value="search">
        <input type="text" class="form-control" placeholder="Tìm kiếm theo tên sản phẩm..." name="keyword"id="keyword">
        <div class="input-group-btn">
        <button class="btn btn-default" type="submit" onclick="timkiem()"><i class="glyphicon glyphicon-search">  
        </i></button>
      </div>
		</div>	
    </form>
		<br/>
        <!-- Grid system -->
        <div id="search-result" class="row"> 
        </div>
      </div>
    </div>
      </form>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>ProductName</th>
          <th>Price</th>
          <th>Category</th>
        </tr>
      </thead>
      <tbody>
        <?php
         header("Content-type: text/html; charset=utf-8");
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
         
         $sql = "SELECT Id, ProductName, SalePrice, CategoryName FROM Product";
         $result = $conn->query($sql);
         if ($result->num_rows > 0) {
           // output data of each row
           while($row = $result->fetch_assoc()) {
             echo "<tr>";
             echo "<td>" . $row["Id"] ."</td>";
             echo "<td>" . $row["ProductName"] ."</td>";
             echo "<td>" . $row["SalePrice"] ."</td>";
             echo "<td>" . $row["CategoryName"] ."</td>";
             echo "<td><span class='glyphicon glyphicon-pencil'></span><span class='glyphicon glyphicon-search'>
             </span></td>";
             echo "</tr>";
           }
         } else {
           echo "0 results";
         }
         $conn->close();
        ?>  
      </tbody>   
    </table>
		
		<br/>        
      </div>
    </div>
  
    <!-- Footer -->
    <div id="footer">
      <div class="container">
        <p>All rights reserved by DealCongNghe.Com</p>
      </div>
    </div>

    <!-- DO NOT REMOVE THE 2 LINES -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php 
    require '../connection/connection.php';
    require '../source/source.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../api/datatables.js"></script>
    <link rel="stylesheet" href="../api/datatables.css">
    <title>StockMaster</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }
        .side-nav{ grid-area: side-nav;}
        .main{ grid-area: main;}
        .footer{ grid-area: footer;}
        .stock-container{
            display: grid;
            grid-template-areas: 
            '. . . . . . . . .'
            'side-nav main main main main main main main main'
            'footer footer footer footer footer footer footer footer footer';
        }
        .side-nav{
            height: 100vh;
            width: auto;
            background-color: #87C4FF;
        }.wrapper a{
            display: block;
            padding: 10px;
            background-color: #E0F4FF;
            color: #39A7FF;
            margin: 10px;
            text-align: center;
            text-decoration: none;
            font-weight: lighter;
        }.wrapper a:hover{
            background-color: #FFEED9;
            box-shadow: 1px 1px 1px 1px #E0F4FF;
        }#example_wrapper{
            background-color: #E0F4FF;
            width: 90%;
            margin: 0 auto;
            padding: 15px;
            border: 1px solid #39A7FF;
            /*box-shadow: 5px 5px #E0F4FF;*/
        }.addItem{
            width: 90%;
            height: auto;
            margin: 0 auto;
            padding: 15px 0;
            font-size: 1.1em;
        }.addItem form{
            border: #87C4FF 1px solid;
            background-color: #E0F4FF;
            width: 312px;
            padding: 10px;
        }.addItem form > input, #supplier{
            display: block;
            margin: 10px 0;
            width: 290px;
            height: 30px;
            text-align: center;
            font-size: 1.1em;
        }.div_register_sup button{
            font-size: 1.1em;
            padding: 10px;
            width: 290px;
        }
    </style>
</head>
<body>
    <div class="stock-container">
        <div class="side-nav">
            <h1 style="text-align:center;background-color: #39A7FF;color: #FFEED9;margin: 10px;padding: 20px 0">STOCKMASTER</h1>
            <div class="wrapper">
                <div><a href="item.php">ITEM</a></div>
                <div><a href="supplier.php">SUPPLIER</a></div>
            </div>
        </div>
        <div class="main">
            <h2 style="text-align: center;">List of our Suppliers</h2>
            <table id="example" class="display" style="width:100%;text-align:center">
                <thead>
                    <tr>
                        <th>Supplier name</th>
                        <th>Contact name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($supData as $rowSup){
                    ?>
                    <tr>
                        <td><?php echo $rowSup['supplier_name'] ?></td>
                        <td><?php echo $rowSup['contact_name'] ?></td>
                        <td><?php echo $rowSup['contact_email'] ?></td>
                        <td><?php echo $rowSup['contact_phone'] ?></td>
                        <td><?php echo $rowSup['address'] ?></td>
                        <td><button style="padding: 10px;cursor:pointer; width: 100px">Edit</button></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="addItem">
                <form action="" method="POST">
                <h2>Register New Supplier</h2>
                    <input type="text" name="txtSupname" placeholder="Suppier name">
                    <input type="text" name="txtSupcontactname" placeholder="Contact name">
                    <input type="text" name="txtSupemail" placeholder="Email">
                    <input type="text" name="txtSupphone" placeholder="Phone number">
                    <textarea name="txtSupaddress" placeholder="Supplier Address" style="width: 290px;height: 100px"></textarea>
                    <div class="div_register_sup"><button name="reg_sup">Register Supplier</button></div>
                </form>
            </div>
        </div>
        <div class="footer">footer</div>

    <script>
       $('#example').DataTable();
    </script>
</body>
</html>

<?php
    if(isset($_POST['reg_sup'])){
        $txtSupname = $_POST['txtSupname'];
        $txtSupconname = $_POST['txtSupcontactname'];
        $txtSupemail = $_POST['txtSupemail'];
        $txtSupphone = $_POST['txtSupphone'];
        $txtAddress = $_POST['txtSupaddress'];
        if(!empty($txtSupname) && !empty($txtSupconname) && !empty($txtSupemail) && !empty($txtSupphone) && !empty($txtAddress)){
            $sqlInsertSup = "INSERT INTO supplier (supplier_name, contact_name, contact_email, contact_phone, address) 
            VALUES ('$txtSupname','$txtSupconname','$txtSupemail','$txtSupphone','$txtAddress')";
            $sqlInsertSup = mysqli_query($conn, $sqlInsertSup);
            echo "
                <script>
                    $(document).ready(function(){
                        alert('Successfully Registered');
                    })
                </script>
            ";
        }else{
            echo "
            <script>
                $(document).ready(function(){
                    alert('Supplier Registration Unsuccesfull (Fill-up the form)');
                })
            </script>
        ";
        }
    }
?>
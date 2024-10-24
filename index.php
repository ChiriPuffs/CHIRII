<?php
include('dbConnect.php'); 

if(isset($_POST['submit'])){

    $product_name = isset($_POST['name']) ? $_POST['name'] : '';
    $quantity = isset($_POST['age']) ? $_POST['age'] : 0;
    $price = isset($_POST['birth_year']) ? $_POST['birth_year'] : 0;
    if(!empty($product_name) && !empty($quantity) && !empty($price)) {

        $stmt = $con->prepare("INSERT INTO products (product_name, quantity, price) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $product_name, $quantity, $price); 

        if($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: ". $stmt->error;
        }

        $stmt->close();

    } else {
        echo "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHAMPOO PRODUCTS</title>
</head>
<style>
    body {
        align-items: center;
        display: flex;
        flex-direction: column;
        background-color: #FF4162;
    }
    table {
        border-collapse: collapse;
        width: 78rem;
    }
    table, th, td  {
        border: 1px solid white;
        height: 30px;
        text-align: center;
        color: white;
    }
    .boxbox {
        width: 20rem;
        height: 20rem;
        background-color: #FFC0CB;
        align-items: center;
        display: flex;
        justify-content: center;
        border-radius: 10px;
    }
    #la {
        width: 100%;
    }
    #IP {
        height: 1.3rem;
        text-align: center;
        border-radius: 5px;
        margin-top: 5px;
    }
    #btn {
        display: flex;
        margin-top: 30px;
        margin-left: 53px;
        height: 2rem;
        width: 4rem;
        border-radius: 7px;
        background-color: #FF012D;
        border-color: none;
    }
</style>
<body>
    
    <h1>- TYPE SHAMPOO PRODUCTS -</h1>
    <div class="boxbox">
        <form action="index.php" method="POST">
            <label id="la" for="name" style="margin-left: 38px;">Product Name:</label>
            <br>
            <input id="IP" type="text" id="name" name="name" required><br><br>

            <label id="la" for="age" style="margin-left: 55px;">Quantity:</label>
            <br>
            <input id="IP" type="number" id="age" name="age" required><br><br>

            <label id="la" for="birth_year" style="margin-left: 65px;">Price:</label>
            <br>
            <input id="IP" type="number" id="birth_year" name="birth_year" required><br><br>

            <input id="btn" type="submit" name="submit" value="Submit">
        </form>
    </div>

    <div class="div" style="width: 78.8rem;">
        <br><hr><br>
    </div>

    <h1>- DISPLAY SHAMPOO PRODUCTS -</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $result = mysqli_query($con,"SELECT * FROM products");

                if(mysqli_num_rows($result) != 0){
                    $count = 0;
                    while($product = mysqli_fetch_array($result)){
                        $count++;
                        echo "<tr>
                                <td>".$count."</td>
                                <td>".$product['product_name']."</td>
                                <td>".$product['quantity']."</td>
                                <td>".$product['price']."</td>
                              </tr>";
                    }
                } else {
                    echo "<tr>
                            <td colspan='4'>No Records Found</td>
                          </tr>";
                } 
            ?>
        </tbody>
    </table>
</body>
</html>

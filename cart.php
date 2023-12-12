<?php

session_start();

function updateQuantity($productId, $newQuantity)
{   
    if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        // var_dump($_SESSION['cart']);
        foreach ($_SESSION['cart'] as & $cartItem) {
            if ($cartItem['item_id'] == $productId) {
                $cartItem['quantity'] = $newQuantity;
                return true;
            }
        }
    }    return false;
}

function removeFromCart($productId)
{
    foreach ($_SESSION['cart'] as $index => $cartItem) {
        if ($cartItem['item_id'] == $productId) {
            unset($_SESSION['cart'][$index]);
            return true;
        }
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'quantity') !== false) {
            $productId = str_replace('quantity', '', $key);
            $newQuantity = intval($value);
            updateQuantity($productId, $newQuantity);
        } elseif (strpos($key, 'remove') !== false) {
            $productId = str_replace('remove', '', $key);
            removeFromCart($productId);
        }
    }

    if (isset($_POST['add_to_cart'])) {
        $productId = isset($_POST['item_id']) ? $_POST['item_id'] : 0;
        $productName = isset($_POST['item_name']) ? $_POST['item_name'] : '';
        $productPrice = isset($_POST['price']) ? $_POST['price'] : '';
        $productImage = isset($_POST['image_path']) ? $_POST['image_path'] : '';
        $selectedSizes = isset($_POST['size']) ? $_POST['size'] : array();
    
        $productExists = updateQuantity($productId, 1);
    
        if (!$productExists) {
            $currentDateTime = date("Y-m-d H:i:s");
            $_SESSION['cart'][] = array(
                'image_path' => $productImage,
                'item_id' => $productId,
                'item_name' => $productName,
                'price' => $productPrice,
                'size' => $selectedSizes,
                'quantity' => 1,
                'date_added' => $currentDateTime,
            );
        }
    }
}

function calculateTotalPrice()
{
    $totalPrice = 0;

    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
    }

    return $totalPrice;
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Bulan Bintang</title>


    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);
        

        body {
            
            background-color: #f8f9fa;
            margin: 10px; 
        }

        /* header {
            background-color: #1F2937;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        } */

        .content {
            padding: 20px;           
        }

        .content {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;     
            font-family: "Trirong", serif; 
            margin-top: 10px;
            
        }

        .cart-container{
            width: auto;
        }

        .cart-item {
            flex: 0 0 calc(50% - 50px); 
            border-bottom: 4px solid #ddd;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            gap: 40px;
            
        }

        .cart-item img {
            max-width: 260px; 
            height: 230px;
            border-radius: 8px;
            
        }


        .cart-item-details {
            flex: 1;
            font-size: 17px;
        }

        .quantity-tools {
            display: flex;
            
            
        }

        .quantity-tools label {  
            font-size: 17px;
        }

        .quantity-tools input {
            width: 60px;
            text-align: center;
            font-size: 12px;
            margin-left: 20px;
            
        }

        .quantity-tools button {
            background-color: #202d45;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 12px;
            margin-left: 20px;
        }

        .quantity-tools button:hover {
            background-color: #54E346;
        }

        .cart-totals {
            width: 100%;
            margin-top: 20px;
            border-top: 1px solid #ddd; 
            padding-top: 20px; 
        }

        .cart-total-item {
            display: flex;
            justify-content: space-between;
           
        }

        .cart-total-item p {
       
            margin-bottom: 5px;
        }

        .cart-buttons {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-top: 20px;          
        }

        #checkout-btn{
            transition: transform 0.3s ease-in-out;
            background-color: #202d45;
            
        }

        #checkout-btn:hover{
            background-color: #54E346;
            border: none;
            color: black;
            transform: scale(1.2);
            
        } 

        #cartDate{
            font-family: poppins , sans-serif;
            font-style: oblique;
            font-size: small;
            margin-top: 20px;
            color: grey;
        }

        #cartSize{
            font-family: poppins , sans-serif;
            font-style: oblique;
            font-size: small;
            margin-top: 20px;
            color: grey;
        }

        #removeCartbtn{
            margin-top: 20px;
            border-radius: 20px 20px;
            transition: transform 0.3s ease-in-out;
            border: none;
            background-color: #202d45;
            color: #ffff;
        }

        #removeCartbtn:hover{
            transform: scale(1.3);
        }

        @media (max-width: 768px) {
       
        .cart-item {
            flex: 0 0 100%; 
        }

        .quantity-tools {
            flex-direction: column; 
            align-items: flex-start; 
        }

        
    }

    </style>

</head>


<?php include('header.php')?>

<body>
          
    <div class="content">
        
        <div class="cart-container">
            <?php
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                $reversedCart = array_reverse($_SESSION['cart']);
                foreach ($reversedCart as $index => $item) {
                    echo '<div class="cart-item">';
                    echo '<img src="./images/' . $item['image_path'] . '" alt="Product Image">';
                    echo '<div class="cart-item-details">';
                    echo '<p> ' . $item['item_name'] . '</p>';
                    echo '<p> RM ' . $item['price'] . '</p>';
                    
                    echo '<div class="quantity-tools">';
                    echo '<label for="quantity' . $index . '">Quantity</label>';
                    echo '<button onclick="decrementQuantity(\'quantity' . $index . '\')">-</button>';
                    echo '<input type="number" id="quantity' . $index . '" name="quantity' . $index . '" value="1" min="1">';
                    echo '<button onclick="incrementQuantity(\'quantity' . $index . '\')">+</button> ';                  
                    echo '</div>';
                    echo '<p id="cartSize"> Size: ' . implode(', ', $item['size']) . '</p>';
                    echo '<p id="cartDate" >Date Added: ' . (isset($item['date_added']) ? $item['date_added'] : 'N/A') . '</p>';
                    echo '<form  method="post" action="">';
                    echo '<button class= "btn btn" id="removeCartbtn" type="submit" name="remove' . $item['item_id'] . '">Remove</button>';
                    echo '</form>';
                    // echo '<a href="details.php">Details</a>';
                    
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>

          
        <div class="cart-totals">
            <div class="cart-total-item">
            <p>Total: RM <?php echo number_format(calculateTotalPrice(), 2); ?></p>
            </div>
        </div>

        <!-- <div class="cart-buttons">
            <form action="">
                <button id="cart-btn-update" type="submit" name="update_cart" class="btn btn-dark">Update Cart</button>
            </form> -->
            
            <button id="checkout-btn" type="submit" name="proceed_to_checkout" class="btn btn-dark">Checkout <i class="fas fa-check-double"></i></button>
        </div>
    </div>    

    <?php include('footer.php')?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <script>
        function incrementQuantity(inputId) {
            var input = document.getElementById(inputId);
            input.value = parseInt(input.value) + 1;
        }

        function decrementQuantity(inputId) {
            var input = document.getElementById(inputId);
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>

    <script>

function addToCart(productId, productName, productPrice, selectedSizes) {
    console.log('Adding to cart:', productId, productName, productPrice, selectedSizes);

    $.ajax({
        type: 'POST',
        url: 'cart.php',
        data: {
            add_to_cart: 1,
            item_id: productId,
            item_name: productName,
            price: productPrice,
            size: selectedSizes
        },
        success: function (response) {
            console.log(response);
            
        },
        error: function () {
            alert('Error in the AJAX request.');
        }
    });
}
</script>
</body>
</html>

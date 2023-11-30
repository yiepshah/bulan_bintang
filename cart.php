<?php session_start()?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>hey</title>
    <style>
        body {
            font-family: 'Your Desired Font', sans-serif;
            background-color: #f8f9fa;
            margin: 10px; 
        }

        header {
            background-color: #1F2937;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .content {
            padding: 20px;
            max-width: 800px; 
            margin: 0 auto; 
        }

        .cart-container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
           
            
        }

        .cart-item {
            flex: 0 0 calc(50% - 40px); 
            border-bottom: 4px solid #ddd;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            gap: 20px;
            
        }

        .cart-item img {
            max-width: 150px; 
            height: auto;
            border-radius: 8px;
        }

        .cart-item-details {
            flex: 1;
            font-size: 14px;
        }

        .quantity-tools {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .quantity-tools label {
            margin-right: 5px;
            font-size: 12px;
        }

        .quantity-tools input {
            width: 40px;
            text-align: center;
            font-size: 12px;
            margin-right: 5px;
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
            font-size: 16px;
        }

        .cart-total-item p {
            font-weight: bold;
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
        }


        #checkout-btn:hover{
            background-color: #54E346;
            border: none;
            color: black;
            transform: scale(1.2);
        }

        #cart-btn-update{
            transition: transform 0.3s ease-in-out;

        }

        #cart-btn-update:hover{
            transform: scale(1.2);
            background: #FFC436;
            color: black;
            border: none;
        }

        
/* 
        .action-buttons button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            
            transition: transform 0.3s ease-in-out;
            font-size: 14px;
        }

        .action-buttons button:hover {

            transform: scale(1.5);
        } */
    </style>

</head>

<?php include('header.php')?>

<body>

    <div class="content">
        <h1>Your Cart</h1>
        <div class="cart-container">
            
            <div class="cart-item">
                <img src="http://localhost/bulan_bintang/images/65531614a5112_TBL2-MIDNIGHT-BLUE.webp" alt="Product 1">
                <div class="cart-item-details">
                    <p>Name: Baju Melayu (Midnight Blue)</p>
                    <p>Price: RM 194.00</p>
                    <p>Size: M</p>
                    <div class="quantity-tools">
                        <label for="quantity1">Qty:</label>
                        <button onclick="decrementQuantity('quantity1')">-</button>
                        <input type="number" id="quantity1" name="quantity1" value="1" min="1">
                        <button onclick="incrementQuantity('quantity1')">+</button>
                    </div>
                </div>
            </div>

            
            <div class="cart-item">
                <img src="http://localhost/bulan_bintang/images/655337457a76b_SF31-SHERWOOD-TAN.webp" alt="Product 2">
                <div class="cart-item-details">
                    <p>Name: Slim Fit (Sherwood Tan)</p>
                    <p>Price: RM 194.00</p>
                    <p>Size: XL</p>
                    <div class="quantity-tools">
                        <label for="quantity2">Qty:</label>
                        <button onclick="decrementQuantity('quantity2')">-</button>
                        <input type="number" id="quantity2" name="quantity2" value="1" min="1">
                        <button onclick="incrementQuantity('quantity2')">+</button>
                    </div>
                </div>
            </div>

          
            <div class="cart-item">
                <img src="http://localhost/bulan_bintang/images/655321b334107_LISA-LS13-5.webp" alt="">
                <div class="cart-item-details">
                    <p>Name: Lisa (Off White)</p>
                    <p>Price: RM 249.90</p>
                    <p>Size: XS</p>
                    <div class="quantity-tools">
                        <label for="quantity3">Qty:</label>
                        <button onclick="decrementQuantity('quantity3')">-</button>
                        <input type="number" id="quantity3" name="quantity3" value="1" min="1">
                        <button onclick="incrementQuantity('quantity3')">+</button>
                    </div>
                </div>
            </div>

       
            <div class="cart-item">
                <img src="http://localhost/bulan_bintang/images/6553140f5b530_KURTA-A-CREAM.webp" alt="">
                <div class="cart-item-details">
                    <p>Name: Kurta A (Cream)</p>
                    <p>Price: RM 114.00</p>
                    <p>Size: M</p>
                    <div class="quantity-tools">
                        <label for="quantity4">Qty:</label>
                        <button onclick="decrementQuantity('quantity4')">-</button>
                        <input type="number" id="quantity4" name="quantity4" value="1" min="1">
                        <button onclick="incrementQuantity('quantity4')">+</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="cart-totals">
            <div class="cart-total-item">
                <p>Total: RM 751.90</p>
                <p>Shipping to Kelantan: RM 20</p>
                <p>RM 771.90</p>
            </div>
        </div>

        <div class="cart-buttons">
            <button id="cart-btn-update" type="submit" name="update_cart" class="btn btn-dark">Update Cart</button>
            <button id="checkout-btn" type="submit" name="proceed_to_checkout" class="btn btn-dark">Checkout <i class="fas fa-check-double"></i></button>
        </div>
    </div>

    <?php include('footer.php')?>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw8f+ua/Cb04NJTEZ8vlZaO3RS6O8iST/SmOEM4nDh4lLoPK9bpzytAA7VMDU" crossorigin="anonymous"></script>

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
</body>

</html>

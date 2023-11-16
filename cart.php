<?php
session_start();

// Dummy data for demonstration
$products = [
    1 => ["name" => "Product 1", "price" => 10.00],
    2 => ["name" => "Product 2", "price" => 15.00],
    // Add more products as needed
];

// Adding to Cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    // Check if the product ID is valid
    if (isset($products[$product_id])) {
        // Add item to the cart
        addToCart($product_id, $quantity);
    }
}

// Function to add items to the cart
function addToCart($product_id, $quantity) {
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    // Add or update the item in the cart
    $_SESSION["cart"][$product_id] = [
        "name" => $products[$product_id]["name"],
        "price" => $products[$product_id]["price"],
        "quantity" => $quantity,
    ];
}

// Function to calculate the total price of items in the cart
function calculateCartTotal() {
    $total = 0;
    if (isset($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $item) {
            $total += $item["price"] * $item["quantity"];
        }
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="cart-container">
        <?php if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])): ?>
            <h2>Your Cart</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION["cart"] as $product_id => $item): ?>
                        <tr>
                            <td><?php echo $item["name"]; ?></td>
                            <td><?php echo $item["price"]; ?></td>
                            <td><?php echo $item["quantity"]; ?></td>
                            <td><?php echo $item["price"] * $item["quantity"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-total">
                <p>Total: <?php echo calculateCartTotal(); ?></p>
            </div>

            <div class="shipping-details">
                <!-- Display shipping details here -->
            </div>

            <form method="post" action="">
                <button type="submit" name="proceed_to_checkout">Proceed to Checkout</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>

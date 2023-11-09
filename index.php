<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Bulan Bintang</title>

    <style>
    
   

    body, html{
        background-image: url('https://lh6.googleusercontent.com/proxy/PfqBs77OlpRjgytCHPXHLWBN1avDDXQxk9yJB10Gw2PrHpRd0aQAXNGdbzStMW_ewsSf4aY1aL8XDePZ7NzC1beWctZAYYf2yQelWA3lNQuIuUHJQBtA2IiQcXcJSKFE=w1200-h630-p-k-no-nu');
 
        /* background-attachment: fixed; */
    }
    
    .image-container {
        display: flex; 
        align-items: center;
        margin-top: 20px; 
        width: 25%;
       
    }

    .image-container img {
        max-width: 100%; 
        height: auto; 
        width: 500px;
    }

   
    .collection {
        font-weight: bold; 
        color: #003366;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        margin-left: 30px;
        margin-top: 40px;
    }

    .dropdown-item{
        color: black;
        font-size: small;
        font-style: oblique;
        font-weight: lighter;
    }



    @media (max-width: 767px) {
        .third-image {
            flex-direction: column;
            align-items: center;
        }
        .image-group {
            max-width: 100%;
        }
        .image-group img {
            width: 600px; 
            max-width: 100%;
            height: auto;
            margin: 10px;        
        }
    }

    #third-1{
        margin-left: 0px;
        margin-top: 40px;
        width: 900px;
        border-radius: 20px 30px;
        margin-right:0px;
    }

    #third-2{
        margin-left: 40px;
        margin-top: 40px;
        width: 900px;
        margin-right: 20px;
        border-radius: 20px 30px;
        margin-right: 0px;
    }

    #third-3{
        margin-left: 0px;
        margin-top: 40px;
        width: 900px;
        margin-right: 20px;
        border-radius: 20px 30px;
        margin-right: 0px;
    }

    #third-4{
        margin-left: 40px;
        margin-top: 40px;
        width: 900px;
        margin-right: 20px;
        border-radius: 20px 30px;
        margin-right: 0px;
    }

    .boutique{
        margin-left: 0px;
    }

    .boutique img{
        border-radius: 20px 30px;
    }

    .footer{
        font-family: Arial, Helvetica, sans-serif;
        font-size: medium;
        font-weight: bold;

       
    }

    .image-button {
        position: absolute;
        top: 100%; /* Adjust the top position as needed */
        left: 77%; /* Adjust the left position as needed */
        transform: translate(-50%, -50%);
        background-color: #003366;
        font-family: sans-serif;
        padding: 10px 30px; /* Adjust the padding as needed */
        border: none;
        border-radius: 5px 10px;
        text-decoration: none;
        font-weight: bold;
        font-size: 21px;
        color: lightyellow;
      
    }
    



    


    <?php
        session_start(); // Start the session

        // Include your header and other content
        include('header.php');
        // ...
    ?>

   
</style>
</head>
<body>
    
    <div class="first-image">
        <img src="https://bulanbintanghq.my/wp-content/uploads/2023/02/Raya-2023-Baju-Raya-Family.jpg" alt="Big Picture" style="width: 100%; height: auto;">
        <a href="<?php echo 'collection.php'; ?>">
            <div class="image-button">
                Shop Now !
            </div>
        </a>
    </div>  

    <h3 class="collection">Brothers Collection</h3>
    <div class="image-container">
        <img src="https://www.bulanbintangstore.com/wp-content/uploads/2021/05/Flamingo-Pink_SF_22.jpg" alt="Image 1">
        <img src="https://www.bulanbintangstore.com/wp-content/uploads/2021/03/Viridian-Green_BMTF_34-1536x1536.jpg" alt="Image 2">
        <img src="https://www.bulanbintangstore.com/wp-content/uploads/2021/05/Mint-Green_SF_7.jpg" alt="Image 3">
        <img src="https://bulanbintang.onpay.my/media/uploads/lilac.jpg" alt="Image 4">
    </div>

    <h3 class="collection">2023 Collection</h3>
    <div class="third-image">
        <div class="image-group">
            <img id="third-1" src="https://bulanbintanghq.my/wp-content/uploads/2023/02/Baju-Melayu-Tailored-Fit-Ash-Blue.jpg" alt="">
            <img id="third-2" src="https://bulanbintanghq.my/wp-content/uploads/2023/02/Baju-Melayu-Tailored-Fit-Ash-Brown.jpg" alt="">
            <img id="third-3" src="https://bulanbintanghq.my/wp-content/uploads/2023/02/Baju-Melayu-Tailored-Fit-Beige.jpg" alt="">
            <img id="third-4" src="https://bulanbintanghq.my/wp-content/uploads/2023/02/Baju-Melayu-Tailored-Fit-Air-Force-Blue.jpg" alt="">
        </div>
    </div>

    <h3 class="collection">Visit Our Official Boutique</h3>

    
    <div class="boutique">
   
        <div class="row">
            <div class="col-md-3">
                <figure>
                    <img src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/07/BANGI.jpg?resize=1536%2C1536&ssl=1" alt="Image 1" class="img-fluid">
                    <figcaption style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Bangi</figcaption>
                </figure>
            </div>
            <div class="col-md-3">
                <figure>
                    <img src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/07/UKAY-BOULEVARD.jpg?resize=1536%2C1536&ssl=1" alt="Image 2" class="img-fluid">
                    <figcaption style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Ukay Boulevard</figcaption>
                </figure>
            </div>
            <div class="col-md-3">
                <figure>
                    <img src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/07/KELANTAN.jpg?resize=1536%2C1536&ssl=1" alt="Image 3" class="img-fluid">
                    <figcaption style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Kelantan</figcaption>
                </figure>
            </div>

            <div class ="col-md-3">
                    <figure>
                        <img src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/07/PENANG.jpg?resize=1536%2C1536&ssl=1" alt="Image 6" class="img-fluid">
                        <figcaption style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Penang</figcaption>
                    </figure>
            </div>
        </div>

    
        <div style="margin-top: 10px;"></div>

        
        <div class="row">
            <div class="col-md-3">
                <figure>
                    <img src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/07/JOHOR.jpg?resize=1536%2C1536&ssl=1" alt="Image 4" class="img-fluid">
                    <figcaption style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Johor Bahru</figcaption>
                </figure>
            </div>

            <div class="col-md-3">
                <figure>
                    <img src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/07/SHAH-ALAM.jpg?resize=1536%2C1536&ssl=1" alt="Image 5" class="img-fluid">
                    <figcaption style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Shah Alam</figcaption>
                </figure>
            </div>

            <div class ="col-md-3">
                <figure>
                    <img src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/07/MELAKA.jpg?resize=1536%2C1536&ssl=1" alt="Image 6" class="img-fluid">
                    <figcaption style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Melaka</figcaption>
                </figure>
            </div>

            <div class ="col-md-3">
                <figure>
                    <img src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/07/TERENGGANU.jpg?resize=1536%2C1536&ssl=1" alt="Image 6" class="img-fluid">
                    <figcaption style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">Terengganu</figcaption>
                    
                </figure>
            </div>

        </div>
    </div>


    <div style="background-color: #000033;color: #fff; padding: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4>ABOUT US</h4> <br>
                    <ul>
                        <li>About Us</li><br>
                        <li>Blog</li><br>
                        <li>Careers</li><br>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4>CUSTOMER CARE</h4><br>
                    <ul>
                        <li>FAQ</li><br>
                        <li>Return Policy</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4>FOLLOW US</h4><br>
                    <ul>
                        <i class="fab fa-tiktok"></i>
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-twitter"></i>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4>CUSTOMER SERVICES</h4><br>
                    <ul>
                        <i class="fas fa-clock">: Monday - Saturday (9:00 am - 10:00pm)</i><br><br>
                        <i class="fas fa-mail-bulk">: Operations@bulanbintanghq.com</i><br><br>
                        <i class="fas fa-phone-volume">: Customer Service</i><br><br>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>



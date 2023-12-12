<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Bulan Bintang</title>

    <style>
    
    
    .image-container {
        display: flex; 
        align-items: center;
        margin-top: 20px; 
        width: 25%;    
    }

    .brother-collection img {
        max-width: 100%;
        height: auto;
        width: 500px;
        transition: transform 0.4s ease-in-out;   
        padding: 10px;
    }

    .brother-collection img:hover {
        transform: scale(1.2);     
    }

   
    .image-group img {
        font-weight: bold; 
        border: #12122f;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        transition: transform 0.3s ease-in-out;        
    }

    .image-group img:hover {
        transform: scale(1.1); ;
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
        width: 830px;     
        border-radius: 10px 10px;
        margin-bottom: 20px;
        margin-left: 20px;
        
    }

    #third-2{      
        width: 830px;
        margin-left: 30px;
        border-radius: 10px 10px;
        margin-left: 10px;
        margin-bottom: 20px;
        margin-left: 20px;
        
        

        
    }

    #third-3{       
        width: 830px;    
        border-radius: 10px 10px;
        margin-left: 20px;
        
    }   

    #third-4{     
        width: 830px; 
        margin-left: 30px;
        border-radius: 10px 10px;
        margin-left: 10px;
        margin-left: 20px;
        

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

    #shop {     
        position: absolute;
        top: 80%; 
        left: 69%; 
        padding: 5px 5px; 
        background: transparent; 
        border: 3px solid black; 
        border-radius: 10px 10px;
        text-decoration: none;
        font-weight: 900;
        font-size: 40px;
        color: #000; 
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        transition: transform 0.3s ease-in-out;    
    }

    #shop:hover{
        background-color: #161A30;
        color: #fff;
        transform: scale(1.1);
        border: 4px solid #161A30; 
        
    }

    @media (max-width: 767px) {
        /* Adjust the position and font size for smaller screens */
        #shop {
            top: 80%; /* Adjust the vertical position */
            font-size: 15px;
        }
    }   
      
    

    .custom-image {
        max-width: 100%;
        height:auto; /* Set a fixed height as needed */
        width: 100%;
        border-radius: 10px; /* Add border-radius if you want rounded corners */
    }

    .carousel-indicators button,
    .carousel-control-prev,
    .carousel-control-next {
        background-color: transparent;
        border: none;
        color: #000; /* Set the color as needed */
    }
      
</style>
</head>
<body>
<?php
        
include('config.php');
include('header.php');
        
    ?>
    
<div id="carouselExample" class="carousel slide" data-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"></button>
  </div>

  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="custom-image" src="https://bulanbintanghq.my/wp-content/uploads/2023/02/Raya-2023-Baju-Raya-Family.jpg" class="" alt="">
    </div>
    <div class="carousel-item">
      <img class="custom-image" src="https://bulanbintanghq.my/wp-content/uploads/2023/02/Raya-2023-Baju-Raya-Perempuan-1024x576.jpg">
    </div>
    <div class="carousel-item">
      <img class="custom-image" src="https://cdn.store-assets.com/s/859197/f/9740202.jpg?width=1500" class="" alt="">
    </div>
  </div>
  
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
  <a  id="shop" href="<?php echo isset($_SESSION['user_id']) ? 'collection.php' : 'login.php'; ?>">SHOP NOW !</i>
</a>
</div>

    <h3 class="collection">Brothers Collection</h3>
    <div class="image-container brother-collection">
        <img src="https://www.bulanbintangstore.com/wp-content/uploads/2021/05/Flamingo-Pink_SF_22.jpg" alt="Image 1">
        <img src="https://www.bulanbintangstore.com/wp-content/uploads/2021/03/Viridian-Green_BMTF_34-1536x1536.jpg" alt="Image 2">
        <img src="https://www.bulanbintangstore.com/wp-content/uploads/2021/05/Mint-Green_SF_7.jpg" alt="Image 3">
        <img src="https://bulanbintang.onpay.my/media/uploads/lilac.jpg" alt="Image 4">
        
    </div><br><br><br>

    
    <div class="third-image">
    <h3 class="collection">2023 Collection</h3>
        <div class="image-group">    
            <img id="third-1" src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/03/SF-2.jpg?resize=800%2C800&ssl=1"  alt="">
            <img id="third-2" src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/02/COVER-CATALOGUE.jpg?resize=800%2C800&ssl=1" alt="">
            <img id="third-3" src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/02/COVER-CATALOGUE-BMK-3.jpg?resize=800%2C800&ssl=1" alt="">
            <img id="third-4" src="https://i0.wp.com/bulanbintanghq.com/wp-content/uploads/2023/03/KURTA-A-2.jpg?resize=800%2C800&ssl=1" alt="">
        </div>
    </div><br><br>

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


    <div style="background-color: #12122f;color: #fff; padding: 60px;">
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
</html>



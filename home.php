<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
};

if (isset($_POST['add_to_wishlist'])) {

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if ($check_wishlist_numbers->rowCount() > 0) {
      $message[] = 'already added to wishlist!';
   } elseif ($check_cart_numbers->rowCount() > 0) {
      $message[] = 'already added to cart!';
   } else {
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'added to wishlist!';
   }
}

if (isset($_POST['add_to_cart'])) {

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if ($check_cart_numbers->rowCount() > 0) {
      $message[] = 'already added to cart!';
   } else {

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if ($check_wishlist_numbers->rowCount() > 0) {
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'added to cart!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <?php include 'favicon.php'; ?>

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="home-bg">

      <section class="home">

         <div class="content">
            <span>don't panic, go pick a novel</span>
            <h3>Reach out for our various categories section and pick all we got it all covered</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto natus culpa officia quasi, accusantium explicabo?</p>
            <a href="about.php" class="btn">about us</a>
         </div>

      </section>

   </div>

   <section class="home-category">

      <h1 class="title">shop by category</h1>

      <div class="box-container">

         <div class="box" data-tilt>
            <img src="images/cat-2.png" alt="">
            <h3>periodicals</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
            <a href="category.php?category=periodicals" class="btn">periodicals</a>
         </div>

         <div class="box" data-tilt>
            <img src="images/cat-2.png" alt="">
            <h3>articles</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
            <a href="category.php?category=articles</h3>" class="btn">articles</a>
         </div>

         <div class="box" data-tilt>
            <img src="images/cat-2.png" alt="">
            <h3>recipes</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
            <a href="category.php?category=recipes" class="btn">recipes</a>
         </div>

         <div class="box" data-tilt>
            <img src="images/cat-2.png" alt="">
            <h3>business</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
            <a href="category.php?category=business" class="btn">business</a>
         </div>

         <div class="box" data-tilt>
            <img src="images/cat-2.png" alt="">
            <h3>comics</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
            <a href="category.php?category=comics" class="btn">comics</a>
         </div>

         <div class="box" data-tilt>
            <img src="images/cat-3.png" alt="">
            <h3>biography</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
            <a href="category.php?category=biography" class="btn">biography</a>
         </div>

         <div class="box" data-tilt>
            <img src="images/cat-3.png" alt="">
            <h3>education</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
            <a href="category.php?category=education" class="btn">education</a>
         </div>

         <div class="box" data-tilt>
            <img src="images/cat-3.png" alt="">
            <h3>kids</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
            <a href="category.php?category=kids" class="btn">kids</a>
         </div>

      </div>


   </section>
   <!-- :::::::SERVICES SECTION STARTS::::::: -->

   <div class="services">
      <h3 class="tit" id="services">SERVICES</h3>
      <div class="services-container">

         <div class="bo">
            <span class="number">01</span>
            <i class="fa fa-globe"></i>
            <h3>Global</h3>
            <p>Our services can be aacesed by everyone on diffent parts of the world sectetur adipisicing elit. Corrupti, veritatis. Lorem ipsum dolor sit amet.lorem</p>
         </div>
         <div class="bo">
            <span class="number">02</span>
            <i class="fa fa-credit-card"></i>
            <h3>Cost Effient</h3>
            <p>we value all our customers hence all our book titles are at a cost friendly pricel ad Corrupti, veritatis. Lorem ipsum dolor sit amet.lorem</p>
         </div>
         <div class="bo">
            <span class="number">03</span>
            <i class="fa-solid fa-truck-fast"></i>
            <h3>Fast Delivery</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti, veritatis. Lorem ipsum dolor sit amet.lorem</p>
         </div>
         <div class="bo">
            <span class="number">04</span>
            <i class="fa-solid fa-tty"></i>
            <h3>Customer Service</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti, veritatis. Lorem ipsum dolor sit amet.lorem</p>
         </div>
         <div class="bo">
            <span class="number">05</span>
            <i class="fas fa-clock"></i>
            <h3>Open 24/7</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti, veritatis. Lorem ipsum dolor sit amet.lorem</p>
         </div>
         <div class="bo">
            <span class="number">06</span>
            <i class="fa fa-book" aria-hidden="true"></i>
            <h3>Universal</h3>
            <p>Browse a variety of books from all aithors around the world adipisicing elit. Corrupti, veritatis. Lorem ipsum dolor sit amet.lorem</p>
         </div>
      </div>
   </div>

   <!-- :::::::SERVICES SECTION ENDS:::::::::: -->


   <!-- :::::::PRODUCT PAGE  BEGINS HERE:::::: -->
   <section class="products">

      <h1 class="title">latest products</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 10");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" class="box" method="POST">
                  <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
                  <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <div class="name"><?= $fetch_products['name']; ?></div>
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
                  <input type="number" hidden min="1" value="1" name="p_qty" class="qty">
                  <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
                  <input type="submit" value="add to cart" class="btn" name="add_to_cart">
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>

   </section>
   <!-- ::::::::PRODUCT PAGE ENDS HERE:::::::::-->



   <!-- CONTACT US CARD  ON HOMEPAGE -->
   <section class="home-contact">
      <div class="content">
         <h3>have any questions?</h3>
         <p>please feel free to express yourself in our comment section and leave a review of any improvements that we can implement on BOOKLY</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </section>
   <!-- CONTACT US CARD  ON HOMEPAGE  ENDS HERE-->








   <?php include 'footer.php'; ?>

   <script src="js/script.js"></script>
   <script src="js/vanilla-tilt.js"></script>

</body>

</html>
<?php
   session_start();
   $_SESSION['userType'] = 'seller';
   $_SESSION['userId'] = 2;
   require_once './controllers/seller.controller.php';
   require_once './auth/auth.php';
   require './db/db.connection.php';

   /* logic start */
   Auth::checkSeller();
   $result = Seller::showSellerProducts($con);
   $no_of_products = $result[0];
   $op = $result[1];

   
   /* logic end */

   require_once 'components/header.php'; 
   require_once 'components/nav.php';
?>
<!-- products section -->
<section class="product_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
         <h2>
            Your <span>products</span>
         </h2>
      </div>
      <div class="row">
         <?php
            if($no_of_products == 0){
               echo '<div class = text-center>
                        <p class = text-center > You do not have products yet.</p>
                     </div>';
            } 
            else {
               while($row = mysqli_fetch_assoc($op)){
                  echo "
                  <div class='col-sm-6 col-md-4 col-lg-4'>
                     <div class='box'>
                        <div class='option_container'>
                           <div class='options'>
                              <a href='' class='option1'>
                                 Delete
                              </a>
                              <a href='' class='option2'>
                                 Edit
                              </a>
                           </div>
                        </div>
                        <div class='img-box'>
                           <img src=".$row['productImage']." alt=''>
                        </div>
                        <div class='detail-box d-flex flex-column'>
                           <h5>
                              ".$row['productName']."
                           </h5>
                           <h6>
                              ".$row['price']."
                           </h6>
                        </div>
                     </div>
                  </div> 
                  ";
               }
            }
         ?>
      </div>
   </div>                     
   <div class="btn-box">
      <a href="">
         Add a product
      </a>
   </div>
</section>
<!-- end product section -->
<?php
   require_once './components/footer.php';
?>
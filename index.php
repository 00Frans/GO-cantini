<?php 
include('functions/userfunctions.php'); 
include('includes/header.php'); 
include('includes/slider.php'); 
?>

<head>
  <title>My Page Title</title>
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
</head>
<br><br>
<div class="py-5 bg-f2f2f2">
    <div class="container" id="about">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 class="display-5">GoCantini: Fueling Minds, Nourishing Futures</h3>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="py-5 bg-f2f2f2">
    <div class="container" id="#about">
        <div class="row">
            <div class="col-md-12">
                <h4>Welcome to GoCantini!</h4>
                <div class="underline mb-2"></div>
                <p>

                <br><br>
                Introducing our school's new online website canteen GoCantini, where convenience meets deliciousness! Our innovative platform provides students, 
                teachers, and staff with a seamless and efficient way to order and enjoy a wide range of scrumptious meals and snacks, right from the comfort 
                of their own devices.
                </p>
                <p>
                    Busy students and teachers can place their orders in advance, specifying their desired pickup or delivery time. This feature enables them to plan their meals ahead of time, ensuring they never miss out on a delicious and timely lunch.
                    <br><br>
                    We value the opinions of our school community, and as such, we provide a feedback and rating system. Users can share their thoughts on the meals they've ordered, helping us continuously improve and cater to their preferences.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row" id="#top">
            <div class="col-md-12">
                <h4>Trending Products</h4>
                <div class="underline mb-2"></div>
                <div class="owl-carousel">
                    <?php
                        $trendingProducts = getAllTrending();
                        if(mysqli_num_rows($trendingProducts) > 0)
                        {
                            foreach ($trendingProducts as $item){
                                ?>
                                <div class="item">
                                    <a href="product-view.php?product=<?= rawurlencode($item['slug']); ?>&symbol=<?= rawurlencode('+'); ?>" style="text-decoration:none;">
                                        <div class="card">
                                            <div class="card-body shadow">
                                                <img src="uploads/<?= $item['image']; ?>" alt="Product Image" class="w-90" height="190">
                                                <h6 class="text-left mt-4 fw bold text-dark"><?= $item['name']; ?></h6>
                                                <p class="text-danger"><small class="text-muted" style="text-align:center;"><s>₱ <?= $item['original_price']; ?>.00</s></small> ₱<?= $item['selling_price']; ?>.00</p>
                                                <span class="text-dark text-uppercase float-start"><?= $item['shop_name']; ?></span>
                                            </div>
                                        </div>
                                    </a>
                                    
                                </div>
                            <?php
                            }
                        }
                    ?>
                </div>
                
            </div>
        </div>
    </div>
</div>


<div class="py-5 bg-f2f2f2">
    <div class="container" id="#about">
        <div class="row">
            <div class="col-md-12">
                <h4>Ethos</h4>
                <div class="underline mb-2"></div>
                <p>
                At our online canteen website, we believe in serving more than just food. We strive to create a seamless and 
                delightful dining experience that caters to the diverse needs of our valued customers. With a commitment to quality, 
                convenience, and innovation, we have built a virtual canteen that transcends the limitations of physical spaces,
                bringing the joy of quick transaction of meals right to your fingertips.
                </p>
                <p>
                Our ethos revolves around two key principles:
                    <br><br>
                    1. Accessibility: We believe that everyone should have access to a wide variety of mouthwatering food options, regardless of their location or dietary preferences. Our online canteen provides a diverse menu, accommodating different tastes, dietary restrictions, and cultural preferences, ensuring that there is something for everyone. We are dedicated to creating an inclusive environment where everyone feels welcome and can enjoy a satisfying meal.
                    <br><br>
                    2. Convenience: We understand the fast-paced nature of modern life, where time is a precious commodity. Our online canteen aims to make your dining experience as convenient as possible. With just a few clicks, you can browse our menu, place your order, and have it delivered to your doorstep or ready for pickup. We prioritize efficiency, ensuring that your meals are prepared with care and delivered in a timely manner, so you can focus on what truly matters.
                </p>
            </div>
        </div>
    </div>
</div> 

<div class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4 class="text-white">GOcantini</h4>
                <div class="underline mb-2"></div>
               <a href="#top" target="_self" class="text-white"> <i class="fa fa-angle-right"></i>Home</a><br>
               <a href="#about" target="_self" class="text-white"> <i class="fa fa-angle-right"></i>About Us</a><br>
               <a href="cart.php" class="text-white"> <i class="fa fa-angle-right"></i>My Cart</a><br>
               <a href="categories.php" class="text-white"> <i class="fa fa-angle-right"></i>Products</a><br>
            </div>
            <div class="col-md-3">
                <h4 class="text-white">Address</h4>
                <p class="text-white">
                    #24, 5th Floor,
                    Colon Street, Cebu city
                    Philippines
                </p>
                <a href="tel:09123456789" class="text-white"><i class="fa fa-envelope" aria-hidden="true"></i> +63 923456789</a><br>
                <a href="mailto:jaymarrebanda123@gmail.com" class="text-white"><i class="fa fa-envelope" aria-hidden="true"></i> jaymarrebanda123@gmail.com</a>
            </div>
            <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31406.76438868327!2d123.8505345698991!3d10.274025930463289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a99c66faaaaaab%3A0x30f7b44b85b08091!2sInayawan%20Dump%20site!5e0!3m2!1sen!2sph!4v1683711366543!5m2!1sen!2sph" class="w-100" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="py-2 bg-danger">
    <div class="text-center">
        <div class="mb-0 text-white">All rights reserved. Copyright @<a href="https://www.facebook.com/RebandaJaymar/" target="_blank" class="text-white">GOcantini</a> - <?= date('Y')?></div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
$(document).ready(function(){
        $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })
});    
</script>
 {{-- <footer class="content-footer footer bg-footer-theme">
     <div class="container-xxl">
         <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
             <div class="text-body">
                 © {{ date('Y') }}
                 , {{ \App\Helpers\Helper::getfooterText() }}
             </div>
         </div>
     </div>
 </footer> --}}

 <!-- Start of Footer -->
 <footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
            }">
     <div class="footer-newsletter bg-primary">
         <div class="container">
             <div class="row justify-content-center align-items-center">
                 <div class="col-xl-5 col-lg-6">
                     <div class="icon-box icon-box-side text-white">
                         <div class="icon-box-icon d-inline-flex">
                             <i class="w-icon-envelop3"></i>
                         </div>
                         <div class="icon-box-content">
                             <h4 class="icon-box-title text-white text-uppercase font-weight-bold">Subscribe To
                                 Our Newsletter</h4>
                             <p class="text-white">Get all the latest information on Events, Sales and Offers.
                             </p>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
                     <form action="{{ route('frontend.newsletter.store') }}" method="POST"
                         class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                         @csrf
                         <input type="email" class="form-control mr-2 bg-white" name="email" id="email"
                             placeholder="Your E-mail Address" />
                         <button class="btn btn-dark btn-rounded" type="submit">Subscribe<i
                                 class="w-icon-long-arrow-right"></i></button>
                     </form>
                 </div>
             </div>
         </div>
     </div>
     <div class="container">
         <div class="footer-top">
             <div class="row">
                 <div class="col-lg-4 col-sm-6">
                     <div class="widget widget-about">
                         <a href="demo1.html" class="logo-footer">
                             <img src="{{ asset(\App\Helpers\Helper::getLogoLight()) }}" alt="logo-footer"
                                 width="144" height="45" />
                         </a>
                         <div class="widget-body">
                             <p class="widget-about-title">Got Question? Call us 24/7</p>
                             <a href="https://t.me/BossWolter" class="widget-about-call">+66 9 5491 0493</a>
                             <p class="widget-about-desc">Register now to get updates on pronot get up icons
                                 & coupons ster now toon.
                             </p>

                             <div class="social-icons social-icons-colored">
                                 <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                 <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                 <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                 <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                 <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-3 col-sm-6">
                     <div class="widget">
                         <h3 class="widget-title">Company</h3>
                         <ul class="widget-body">
                             <li><a href="{{ route('frontend.home') }}">Home</a></li>
                             <li><a href="{{ route('frontend.shop') }}">Shop Now</a></li>
                             <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                             <li><a href="{{ route('frontend.become-a-vendor') }}">Become A Vendor</a></li>
                             <li><a href="{{ route('frontend.contact') }}">Contact Us</a></li>
                             <li><a href="{{ route('frontend.faqs') }}">FAQs</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-3 col-sm-6">
                     <div class="widget">
                         <h4 class="widget-title">My Account</h4>
                         <ul class="widget-body">
                             <li><a href="#">Track My Order</a></li>
                             <li><a href="{{ route('frontend.cart.view') }}">View Cart</a></li>
                             <li><a href="{{ route('login') }}">Sign In</a></li>
                             <li><a href="{{ route('frontend.faqs') }}">Help</a></li>
                             <li><a href="#">My Wishlist</a></li>
                             <li><a href="#">Privacy Policy</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-3 col-sm-6">
                     <div class="widget">
                         <h4 class="widget-title">Customer Service</h4>
                         <ul class="widget-body">
                             <li><a href="#">Payment Methods</a></li>
                             <li><a href="#">Money-back guarantee!</a></li>
                             <li><a href="#">Product Returns</a></li>
                             <li><a href="#">Support Center</a></li>
                             <li><a href="#">Shipping</a></li>
                             <li><a href="#">Term and Conditions</a></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
         {{-- <div class="footer-middle">
             <div class="widget widget-category">
                 <div class="category-box">
                     <h6 class="category-name">Consumer Electric:</h6>
                     <a href="#">TV Television</a>
                     <a href="#">Air Condition</a>
                     <a href="#">Refrigerator</a>
                     <a href="#">Washing Machine</a>
                     <a href="#">Audio Speaker</a>
                     <a href="#">Security Camera</a>
                     <a href="#">View All</a>
                 </div>
                 <div class="category-box">
                     <h6 class="category-name">Clothing & Apparel:</h6>
                     <a href="#">Men's T-shirt</a>
                     <a href="#">Dresses</a>
                     <a href="#">Men's Sneacker</a>
                     <a href="#">Leather Backpack</a>
                     <a href="#">Watches</a>
                     <a href="#">Jeans</a>
                     <a href="#">Sunglasses</a>
                     <a href="#">Boots</a>
                     <a href="#">Rayban</a>
                     <a href="#">Acccessories</a>
                 </div>
                 <div class="category-box">
                     <h6 class="category-name">Home, Garden & Kitchen:</h6>
                     <a href="#">Sofa</a>
                     <a href="#">Chair</a>
                     <a href="#">Bed Room</a>
                     <a href="#">Living Room</a>
                     <a href="#">Cookware</a>
                     <a href="#">Utensil</a>
                     <a href="#">Blender</a>
                     <a href="#">Garden Equipments</a>
                     <a href="#">Decor</a>
                     <a href="#">Library</a>
                 </div>
                 <div class="category-box">
                     <h6 class="category-name">Health & Beauty:</h6>
                     <a href="#">Skin Care</a>
                     <a href="#">Body Shower</a>
                     <a href="#">Makeup</a>
                     <a href="#">Hair Care</a>
                     <a href="#">Lipstick</a>
                     <a href="#">Perfume</a>
                     <a href="#">View all</a>
                 </div>
                 <div class="category-box">
                     <h6 class="category-name">Jewelry & Watches:</h6>
                     <a href="#">Necklace</a>
                     <a href="#">Pendant</a>
                     <a href="#">Diamond Ring</a>
                     <a href="#">Silver Earing</a>
                     <a href="#">Leather Watcher</a>
                     <a href="#">Rolex</a>
                     <a href="#">Gucci</a>
                     <a href="#">Australian Opal</a>
                     <a href="#">Ammolite</a>
                     <a href="#">Sun Pyrite</a>
                 </div>
                 <div class="category-box">
                     <h6 class="category-name">Computer & Technologies:</h6>
                     <a href="#">Laptop</a>
                     <a href="#">iMac</a>
                     <a href="#">Smartphone</a>
                     <a href="#">Tablet</a>
                     <a href="#">Apple</a>
                     <a href="#">Asus</a>
                     <a href="#">Drone</a>
                     <a href="#">Wireless Speaker</a>
                     <a href="#">Game Controller</a>
                     <a href="#">View all</a>
                 </div>
             </div>
         </div> --}}
         <div class="footer-bottom">
             <div class="footer-left">
                 <p class="copyright">© {{ date('Y') }}
                     , {{ \App\Helpers\Helper::getfooterText() }}</p>
             </div>
             <div class="footer-right">
                 <span class="payment-label mr-lg-8">We're using safe payment for</span>
                 <figure class="payment">
                     <img src="{{ asset('frontAssets/images/payment.png') }}" alt="payment" width="159"
                         height="25" />
                 </figure>
             </div>
         </div>
     </div>
 </footer>
 <!-- End of Footer -->

 <!-- Start of Sticky Footer -->
 <div class="sticky-footer sticky-content fix-bottom">
     <a href="demo1.html" class="sticky-link active">
         <i class="w-icon-home"></i>
         <p>Home</p>
     </a>
     <a href="shop-banner-sidebar.html" class="sticky-link">
         <i class="w-icon-category"></i>
         <p>Shop</p>
     </a>
     <a href="my-account.html" class="sticky-link">
         <i class="w-icon-account"></i>
         <p>Account</p>
     </a>
     <div class="cart-dropdown dir-up">
         <a href="cart.html" class="sticky-link">
             <i class="w-icon-cart"></i>
             <p>Cart</p>
         </a>
         <div class="dropdown-box">
             <div class="products">
                 <div class="product product-cart">
                     <div class="product-detail">
                         <h3 class="product-name">
                             <a href="product-default.html">Beige knitted elas<br>tic
                                 runner shoes</a>
                         </h3>
                         <div class="price-box">
                             <span class="product-quantity">1</span>
                             <span class="product-price">$25.68</span>
                         </div>
                     </div>
                     <figure class="product-media">
                         <a href="product-default.html">
                             <img src="{{ asset('frontAssets/images/cart/product-1.jpg') }}" alt="product" height="84"
                                 width="94" />
                         </a>
                     </figure>
                     <button class="btn btn-link btn-close" aria-label="button">
                         <i class="fas fa-times"></i>
                     </button>
                 </div>

                 <div class="product product-cart">
                     <div class="product-detail">
                         <h3 class="product-name">
                             <a href="product-default.html">Blue utility pina<br>fore
                                 denim dress</a>
                         </h3>
                         <div class="price-box">
                             <span class="product-quantity">1</span>
                             <span class="product-price">$32.99</span>
                         </div>
                     </div>
                     <figure class="product-media">
                         <a href="product-default.html">
                             <img src="{{ asset('frontAssets/images/cart/product-2.jpg') }}" alt="product" width="84"
                                 height="94" />
                         </a>
                     </figure>
                     <button class="btn btn-link btn-close" aria-label="button">
                         <i class="fas fa-times"></i>
                     </button>
                 </div>
             </div>

             <div class="cart-total">
                 <label>Subtotal:</label>
                 <span class="price">$58.67</span>
             </div>

             <div class="cart-action">
                 <a href="cart.html" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                 <a href="checkout.html" class="btn btn-primary  btn-rounded">Checkout</a>
             </div>
         </div>
         <!-- End of Dropdown Box -->
     </div>

     <div class="header-search hs-toggle dir-up">
         <a href="#" class="search-toggle sticky-link">
             <i class="w-icon-search"></i>
             <p>Search</p>
         </a>
         <form action="#" class="input-wrapper">
             <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                 required />
             <button class="btn btn-search" type="submit">
                 <i class="w-icon-search"></i>
             </button>
         </form>
     </div>
 </div>
 <!-- End of Sticky Footer -->

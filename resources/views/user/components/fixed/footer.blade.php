<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="clearfix visible-xs"></div>

                <div class="col-md-6 col-xs-6 text-center">
                    <div class="footer">
                        <h3 class="footer-title">Information</h3>
                        <ul class="footer-links">
                            <li><a href="{{url('/about')}}">About Us</a></li>
                            <li><a href="{{url('/contact')}}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 col-xs-6 text-center">
                    <div class="footer">
                        <h3 class="footer-title">Service</h3>
                        <ul class="footer-links">
                            @if(session()->has('user'))
                                <li><a href="{{url('/profile')}}">My Account</a></li>
                                <li><a href="{{url('/profile')}}">Logout</a></li>
                            @else
                            <li><a href="{{url('/profile')}}">Login/Register</a></li>
                            @endif
                            <li><a href="{{url('/cart')}}">View Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="footer-payments">
                        <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                        <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                    </ul>
                    <span class="copyright">
								Copyright &copy; Electro<script>document.write(new Date().getFullYear());</script> All rights reserved
                    </span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>

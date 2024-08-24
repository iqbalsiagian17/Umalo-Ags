 <!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <!-- Contact Info Section -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="footer__about">
                    <h3 style="font-weight: bold; font-size: 24px;">{{ __('messages.contact_info') }}</h3><br>
                    <div class="item" style="display: flex; align-items: flex-start; margin-bottom: 10px;">
                        <i class="fas fa-home" style="margin-right: 10px; font-size: 16px; margin-top: 2px;"></i>
                        <span class="address info" style="display: inline-block; max-width: calc(100% - 30px); line-height: 1.5; font-size: 14px;">
                            {{ __('messages.address') }}
                        </span>
                    </div>
                    <div class="item" style="display: flex; align-items: flex-start; margin-bottom: 10px;">
                        <i class="fas fa-phone-alt" style="margin-right: 10px; font-size: 16px; margin-top: 2px;"></i>
                        <span class="phone info" style="display: inline-block; max-width: calc(100% - 30px); line-height: 1.5; font-size: 14px;">
                            (021) 2204 3144
                        </span>
                    </div>
                    <div class="item" style="display: flex; align-items: flex-start;">
                        <i class="fas fa-envelope" style="margin-right: 10px; font-size: 16px; margin-top: 2px;"></i>
                        <span class="email info" style="display: inline-block; max-width: calc(100% - 30px); line-height: 1.5; font-size: 14px;">
                            info@labtek.id
                        </span>
                    </div>
                    <div class="item" style="display: flex; align-items: flex-start;">
                        <i class="fas fa-envelope" style="margin-right: 10px; font-size: 16px; margin-top: 2px;"></i>
                        <span class="email info" style="display: inline-block; max-width: calc(100% - 30px); line-height: 1.5; font-size: 14px;">
                            sales@labtek.id
                        </span>
                    </div>
                </div>
            </div>

            <!-- Menu Links Section -->
            <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
                <div class="footer__widget">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h6>{{ __('messages.help_resources') }}</h6>
                            <ul style="text-decoration: underline;">
                                <li><a href="/product">{{ __('messages.find_product') }}</a></li>
                                <li><a href="/sign-up">{{ __('messages.login_member') }}</a></li>
                                <li><a href="/cart">{{ __('messages.shopping_cart') }}</a></li>
                                <li><a href="/">{{ __('messages.home') }}</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h6>{{ __('messages.about') }}</h6>
                            <ul style="text-decoration: underline;">
                                <li><a href="/company">{{ __('messages.about_us') }}</a></li>
                                <li><a href="/company">{{ __('messages.our_brand') }}</a></li>
                                <li><a href="/company">{{ __('messages.contact_us') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo Images Section -->
            <div class="col-lg-3 col-md-12 col-sm-12 d-flex justify-content-center mb-4">
                <div class="footer__widget">
                    <div class="footer__about__logo d-flex flex-column align-items-center">
                        <a href="./index.html">
                            <img src="{{ asset('assets/images/AGS-logo.png') }}" alt="" style="width: 100%; height: 100px; margin-bottom: 10px;">
                        </a>
                        <a href="./index.html">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="" style="width: 100%; height: 100px;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="footer__copyright text-center" style="padding: 15px 0;">
                    <div class="footer__copyright__text" style="font-size: 12px;">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> {{ __('messages.created_by') }} PT Arkamaya Guna Saharsa
                    </div>
                    <div class="footer__copyright__payment mt-2">
                        <img src="img/payment-item.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->


    <!-- Js Plugins -->
    <script src="{{ asset('ogani/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('ogani/js/bootstrap.bundle.min.js') }}"></script> <!-- Use bootstrap.bundle.min.js for Bootstrap 5 -->
    <script src="{{ asset('ogani/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('ogani/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('ogani/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('ogani/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('ogani/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('ogani/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('ogani/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </body>
    </html>

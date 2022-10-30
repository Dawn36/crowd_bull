<!-- footer -->
<footer class="">
    <div class=" container">
        <div class="row   Newsletter sec-padding --small " data-aos="fade-up">
            <div class="col-md-5 col-sm-12 beforefieldstext">
                <div style="max-width: 390px;">
                    <a href="index.php" class="custom-logo-link">
                        <img src="{{ asset('theme/website-assets/images/Crowdbull-logo.svg')}}" class="custom-logo">
                    </a>
                    <p class="mtpx-20 mbpx-20">
                        Crowdbulls is a real estate crowdfunding platforms tracker. In addition to tracking new projects, funding progress, interest rates, we track overall development of the platforms in scope.
                    </p>
                    <form action="" class="newsletter">
                        <div class="form-wrap newsletter">
                            <input type="email" name="email" placeholder="Email">
                            <input type="submit" value="Subscribe">
                        </div>
                    </form>
                    <div class="clearfix h-20"></div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 col-nopadd" style="display: flex;">
                <div class="col-md-4 col-sm-6 matchheight col-xs-6">
                    <h4>
                        Platforms
                    </h4>
                    <ul class="contactDetails">
                        <li><a href="https://crowdestate.com/">crowdestate.com</a></li>
                        <li><a href="https://estateguru.com/">estateguru.com</a></li>
                        <li><a href="https://www.profitus.com/">profitus.com</a></li>
                        <li><a href="https://nordsteet.com/">nordsteet.com</a></li>
                        <li><a href="https://rendity.com/en">rendity.com</a></li>
                        <li><a href="https://www.housers.com/en">housers.com</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-6 matchheight hidden-sm-down" style="min-width:330px;">
                    <h4>
                        Articles
                    </h4>
                    @php
                    $data=App\Http\Controllers\WebsiteController::footer();
                    @endphp
                    <ul class="contactDetails">
                        @for($i=0; $i < count($data); $i++)
                        <li><a href="{{route('articles')}}">{{ucwords($data[$i]->blog_name)}}</a></li>
                        @endfor
                    </ul>
                </div>
                <div class="col-md-4 col-sm-6 matchheight col-xs-6">
                    <h4>
                        About
                    </h4>
                    <ul class="contactDetails">
                        <li><a href="{{route('about-us')}}">About us</a></li>
                        <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                        <li><a href="{{route('ad-policy')}}">Ad Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-black">

        <div class="container">
            <div class="row sec-padding --xsmall copyright ta-center" data-aos="fade-up">
                <div class="col-md-12">
                    <p class="copyright"> &copy; 2022 Crowdbull. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>


<script type="text/javascript" src="{{ asset('theme/website-assets/js/theme-lib.js')}}"></script>
<script type="text/javascript" src="{{ asset('theme/website-assets/js/theme-fun.js')}}"></script>

</html>
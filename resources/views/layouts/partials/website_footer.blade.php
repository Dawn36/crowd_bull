<!-- footer -->
<footer class="">
    <div class=" container">
        <div class="row   Newsletter sec-padding --small " data-aos="fade-up">
            <div class="col-md-5 col-sm-12 beforefieldstext">
                <div style="max-width: 390px;">
                    <a href="index.php" class="custom-logo-link">
                        <img src="{{ asset('theme/website-assets/images/Crowdbull-logo.svg')}}" alt="Crowdbull-logo" class="custom-logo">
                    </a>
                    <p class="mtpx-20 mbpx-20">
                        Crowdbulls is a real estate crowdfunding platforms tracker. In addition to tracking new projects, funding progress, interest rates, we track overall development of the platforms in scope.
                    </p>
                    <p><a href="#" ><i class="fa fa-facebook-square mr-2" style="font-size: 30px;" aria-hidden="true"></i></a>
                        <a href="#" ><i class="fa fa-twitter" style="font-size: 30px;" aria-hidden="true"></i></a></p>
                    <form action="" class="newsletter">
                        <div class="form-wrap newsletter" id="omnisend-embedded-v2-6372ac85ccad48a8e412b185">
                            <input type="email" name="email" placeholder="Email">
                            <input type="submit" value="Subscribe">
                        </div>
                    </form>
                    <div class="clearfix h-20"></div>
                </div>
            </div>
            @php
            $data=App\Http\Controllers\WebsiteController::footer();
            @endphp
            <div class="col-md-7 col-sm-12 col-nopadd" style="display: flex;">
                <div class="col-md-4 col-sm-6 matchheight col-xs-6">
                    <h4>
                        Platforms
                    </h4>
                    <ul class="contactDetails">
                        {{-- <li><a href="{{$data['platForm'][$i]->url}}" target="_blank">{{$data['platForm'][$i]->plat_form}}</a></li> --}}

                        @for($i=0; $i < count($data['platForm']); $i++)
                        <li><a href="{{route('crowdfunding-platforms',$data['platForm'][$i]->plat_form)}}" target="_blank">{{$data['platForm'][$i]->plat_form}}</a></li>
                        @endfor
                        {{-- <li><a href="https://estateguru.co/" target="_blank">Estateguru.co</a></li>
                        <li><a href="https://www.housers.com/en" target="_blank">Housers.com</a></li>
                        <li><a href="https://crowdestate.eu/" target="_blank">Crowdestate.eu</a></li>
                        <li><a href="https://rendity.com/en" target="_blank">Rendity.com</a></li>
                        <li><a href="https://www.profitus.com/" target="_blank">Profitus.com</a></li>
                        <li><a href="https://nordstreet.com/" target="_blank">Nordstreet.com</a></li> --}}
                    </ul>
                </div>
                <div class="col-md-4 col-sm-6 matchheight hidden-sm-down" style="min-width:330px;">
                    <h4>
                        Articles
                    </h4>
                 
                    <ul class="contactDetails">
                        @for($i=0; $i < count($data['blog']); $i++)
                        <li><a href="{{route('articles')}}">{{ucwords($data['blog'][$i]->blog_name)}}</a></li>
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
<!-- Google Tag Manager -->
<script type="text/javascript">
    window.omnisend = window.omnisend || [];
    omnisend.push(["accountID", "6372ac2900e4d27e263b555f"]);
    omnisend.push(["track", "$pageViewed"]);
    !function(){var e=document.createElement("script");e.type="text/javascript",e.async=!0,e.src="https://o
   mnisnippet1.com/inshop/launcher-v2.js";var t=document.getElementsByTagName("script")[0];t.parentNode.insert
   Before(e,t)}();
   
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-W7WTKKV');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W7WTKKV"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</html>
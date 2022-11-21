<!DOCTYPE html>
<html ng-app="app" lang="en" class="no-js">

<head>
    <title>Crowdbulls – real estate crowdfunding platform tracker.
    </title>
    <meta charset="Crowd Funding Site">
    <meta name="description" content="Crowdbulls tracks new projects, funding progress, interest rates and overall development of the real estate crowdfunding platforms in scope. Crowdbulls provides comparison both on real estate crowdfunding platforms as well as on projects level.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('theme/website-assets/images/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('theme/website-assets/style.css')}}">
    <link rel=“canonical” href=“https://crowdbulls.com/” />
</head>

<style>
   form input[type=text], form input[type=number], form input[type=email], form input[type=date], form input[type=tel], form select, form textarea {
    background-color: #ffffff;
    width: 100%;
    border: 1.5px solid #000;
    box-sizing: border-box;
    border-radius: 5px;
    margin-top: 12px;
    color: #0066f9;
    margin-bottom: 0px;
    max-height: 150px;
}
.soundest-form-embedded-v2-field {
 background-color: #fff !important;
 border-color: #0e0f0f !important;
 color: rgb(14, 12, 12) !important;
}
     </style>
<body class="Homepage " id='sidebar' >

    <!-- Mobile Navigation Start-->
    <div class="mobile-nav" id="nav">
        <div class="mob-nav-logo bg-white ptpx-15 pbpx-15 plpx-15 prpx-15 ">
            <a href="index.php" class="custom-logo-link col-xs-8">
                <img src="{{ asset('theme/website-assets/images/Crowdbull-logo.svg')}}" alt="Crowdbull-logo" class="custom-logo">
            </a>
        </div>
        <nav>
            <div>

                <ul class="mainnav">
                    <li class="menu-item"><a href="{{route('index')}}" class="ss">Home</a></li>
                    <li class="menu-item"><a href="{{route('crowdfunding-platform')}}" class="ss">Platforms</a></li>
                    <li class="menu-item"><a href="{{route('crowdfunding-projects')}}" class="ss">Projects</a></li>
                    <li class="menu-item"><a href="{{route('articles')}}" class="ss">Articles</a></li>
                    <li class="menu-item"><a href="{{route('about-us')}}" class="ss">About</a></li>

                </ul>

            </div>
        </nav>
    </div>
    <!-- Mobile Navigation End-->
    <div class="mobile-nav-btn bg-white">
        <span class="lines"></span>
    </div>
    <!-- Mobile Navigation Button Start-->
    <div class="overlay-menu"></div>


    <header class="ph ">
        <div class="container">
            <div class="row align-center top-header hidden-md-down">
                <div class="col-md-7">
                    @php
                        $data=App\Http\Controllers\WebsiteController::header();
                    @endphp
                    <ul>
                        <li>
                            Tracked Platforms: <span class="fc-primary">{{number_format($data['platFormCount'])}}</span>
                        </li>
                        <li>
                            Tracked Projects: <span class="fc-primary">{{number_format($data['project'])}}</span>
                        </li>
                        <li>
                            Total Capital: <span class="fc-primary">{{number_format($data['capital'])}} EUR</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 ">
                        <div class="form-wrap newsletter" id="omnisend-embedded-v2-6372ac85ccad48a8e412b185">
                           
                        </div>
                </div>
            </div>
            <div class="row align-center">
                <div class="col-md-4 col-xs-8">
                    <a href="{{route('index')}}" class="custom-logo-link">
                        <img src="{{ asset('theme/website-assets/images/Crowdbull-logo.svg')}}" alt="Crowdbull-logo" class="custom-logo">
                    </a>
                </div>
                <div class="col-md-8 hidden-md-down">
                    <nav class="pn">
                        <ul class="mainnav">
                            <li class="menu-item {{ Route::currentRouteName() == 'index'   ? 'active' : '' }}"><a href="{{route('index')}}" class="ss">Home</a></li>
                            <li class="menu-item {{ (Route::currentRouteName() == 'crowdfunding-platform' || Route::currentRouteName() == 'crowdfunding-platforms')   ? 'active' : '' }}"><a href="{{route('crowdfunding-platform')}}" class="ss">Platforms</a></li>
                            <li class="menu-item {{ (Route::currentRouteName() == 'crowdfunding-projects'  )  ? 'active' : '' }}"><a href="{{route('crowdfunding-projects')}}" class="ss">Projects</a></li>
                            <li class="menu-item {{ (Route::currentRouteName() == 'articles' || Route::currentRouteName() == 'article-single')   ? 'active' : '' }}"><a href="{{route('articles')}}" class="ss">Articles</a></li>
                            <li class="menu-item {{ (Route::currentRouteName() == 'about-us' || Route::currentRouteName() == 'privacy-policy' || Route::currentRouteName() == 'ad-policy')   ? 'active' : '' }}"><a href="{{route('about-us')}}" class="ss">About</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

<!DOCTYPE html>
<html ng-app="app" lang="en" class="no-js">

<head>
    <title>Crowd Bull - 
        {{ Route::currentRouteName() == 'index'   ? 'Home Page' : '' }}
        {{ Route::currentRouteName() == 'crowdfunding-platform'   ? 'Crowdfunding Platform' : '' }}
        {{ Route::currentRouteName() == 'crowdfunding-projects'   ? 'Crowdfunding Projects' : '' }}
        {{ Route::currentRouteName() == 'articles'   ? 'Articles' : '' }}
        {{ Route::currentRouteName() == 'about-us'   ? 'About Us' : '' }}
        {{ Route::currentRouteName() == 'privacy-policy'   ? 'Privacy Policy' : '' }}
        {{ Route::currentRouteName() == 'ad-policy'   ? 'Ad Policy' : '' }}
    </title>
    <meta charset="Crowd Funding Site">
    <meta name="description" content="Just a New Crowd Bull Website">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('theme/website-assets/images/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('theme/website-assets/style.css')}}">
</head>

<body class="Homepage ">

    <!-- Mobile Navigation Start-->
    <div class="mobile-nav" id="nav">
        <div class="mob-nav-logo bg-white ptpx-15 pbpx-15 plpx-15 prpx-15 ">
            <a href="index.php" class="custom-logo-link col-xs-8">
                <img src="{{ asset('theme/website-assets/images/Crowdbull-logo.svg')}}" class="custom-logo">
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
                            Tracked Platforms: <span class="fc-primary">{{$data['platFormCount']}}</span>
                        </li>
                        <li>
                            Tracked Projects: <span class="fc-primary">{{$data['project']}}</span>
                        </li>
                        <li>
                            Total Capital: <span class="fc-primary">{{$data['capital']}} EUR</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 ">
                    <form action="" class="newsletter">
                        <div class="form-wrap newsletter">
                            <input type="email" name="email" id="email" placeholder="Email">
                            <input type="submit" value="Subscribe">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row align-center">
                <div class="col-md-4 col-xs-8">
                    <a href="{{route('index')}}" class="custom-logo-link">
                        <img src="{{ asset('theme/website-assets/images/Crowdbull-logo.svg')}}" class="custom-logo">
                    </a>
                </div>
                <div class="col-md-8 hidden-md-down">
                    <nav class="pn">
                        <ul class="mainnav">
                            <li class="menu-item {{ Route::currentRouteName() == 'index'   ? 'active' : '' }}"><a href="{{route('index')}}" class="ss">Home</a></li>
                            <li class="menu-item {{ (Route::currentRouteName() == 'crowdfunding-platform' || Route::currentRouteName() == 'crowdfunding-platform-single')   ? 'active' : '' }}"><a href="{{route('crowdfunding-platform')}}" class="ss">Platforms</a></li>
                            <li class="menu-item {{ (Route::currentRouteName() == 'crowdfunding-projects'  )  ? 'active' : '' }}"><a href="{{route('crowdfunding-projects')}}" class="ss">Projects</a></li>
                            <li class="menu-item {{ (Route::currentRouteName() == 'articles' || Route::currentRouteName() == 'article-single')   ? 'active' : '' }}"><a href="{{route('articles')}}" class="ss">Articles</a></li>
                            <li class="menu-item {{ (Route::currentRouteName() == 'about-us' || Route::currentRouteName() == 'privacy-policy' || Route::currentRouteName() == 'ad-policy')   ? 'active' : '' }}"><a href="{{route('about-us')}}" class="ss">About</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
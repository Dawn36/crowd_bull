@extends('layouts.main_website')

@section('contentWebsite')

<section class="clearfix relative-block hero-banner inside-banner ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title">About Us</h1>
            </div>
        </div>
    </div>
</section>

<section class="content-simple">
    <div class="container">
        <div class="row">
            <div class="col-md-9  matchheight">
                <div class="sec-padding clearfix">
                    <p>
                        Crowdbulls is a real estate crowdfunding platforms tracker. In addition to tracking new projects, funding progress, interest rates, we track overall development of the platforms in scope and calculate various KPIs.
                    </p>
                    <h4>
                        Goals
                    </h4>
                    <p>We aim to monitor real estate crowdfunding platforms in order to make sure data is provided in a correct way and not changed backwards. Thus, creating additional trust for the investors to rely on one or another platform.</p>
                    <p>One of our objectives is also to provide an aggregated project data for investors, who could compare different projects, asses their risks and other KPIs accordingly.</p>
                    <p>At the same time, we are aiming to educated and expand real estate crowdfunding community in order to bring more investors and market this capital raising channel compared to legacy alternatives.</p>
                    <h4>History</h4>
                    <p>This project evolved from the interest in real estate crowdfunding projects. Over recent years a number of crowdfunding platforms appeared in the market, each of them taking different positioning. Being an investor in the crowdfunding platforms, certain tools were developed to monitor and check credibility of the projects as well as the platforms themselves in order to make a more qualified decision. Over time it appeared, that there is a need of such tools in the market as well. Therefore, it was defined as Crowdbulls project and brought to life to the public.</p>
                    <h5>How do we maintain our operations</h5>
                    <p>It costs time and money to run the project. Currently Crowdbulls project is maintained from the revenue received from the platforms for new registered users (referral fees) as well as referrals to projects. These are general schemes, where all the investors can participate (please see referrals section on each of the platforms). Not all of the platforms offer referral programs, nevertheless it is not a criteria to include or not to include the platform in the project.</p>
                    <h5>Contacts</h5>
                    <ul>
                        <li>If you are a platform and want to be listed, please contact.</li>
                        <li>If you want to contribute to this platform, please contact.</li>
                        <li>If you want to advertise in the platform, please contact.</li>
                        <li>If you have a real estate project, which requires funding, please contact.</li>
                    </ul>
                    <p>Any other questions, please contact.</p>
                    <a class="fc-primary fw-bold" href="mailto:info@crowdbulls.com">info@crowdbulls.com</a>
                </div>
            </div>
            <div class="col-md-3 matchheight">
                <div class="inner sec-padding plpx-30 bg-silver h-100">
                    <ul>
                        <li><a href="{{route('about-us')}}">About us</a></li>
                        <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                        <li><a href="{{route('ad-policy')}}">Ad Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection('contentWebsite')
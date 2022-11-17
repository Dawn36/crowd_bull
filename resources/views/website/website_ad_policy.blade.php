@extends('layouts.main_website')

@section('contentWebsite')

<section class="clearfix relative-block hero-banner inside-banner ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title">Ad Policy</h1>
            </div>
        </div>
    </div>
</section>

<section class="content-simple">
    <div class="container">
        <div class="row">
            <div class="col-md-9  matchheight">
                <div class="sec-padding clearfix">
                    <p>Crowdbulls is a private project, where information and advertisement is monetized. Crowdbulls is receiving revenue from platforms, which agree to pay referral fee, for referred user for registration or regular link to investment.</p>
                    <p>Decision to include or not to include the platform in the tracking list is not based on the fact if referral fee is agreed. </p>
                    <p>In case promotional article is posted or additional promotional action is conducted for which additional renumeration is received by Crowdbulls, such articles or additional promotional actions are highlighted as sponsored.</p>
                    <p>For promotional article or additional promotional actions, please contact.</p>
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
@extends('layouts.main_website')

@section('contentWebsite')
    <style>
        .box.cf-logo .logo img {
            aspect-ratio: 1/1;
            height: 115px;
            width: 100%;
            object-fit: contain;
            mix-blend-mode: multiply;
            /* border-radius: 50%; */
        }
    </style>
    <section class="clearfix relative-block hero-banner inside-banner ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {{-- <p class="subtitle fc-black fw-semi-bold fs-medium tt-uppercase">Real Estate</p>
                <h1 class="title">Crowdfunding Platforms</h1> --}}
                    <h1 class="title">Real Estate Crowdfunding Platforms</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- CrowdFunding Platform  -->
    <section class="sec-padding ">
        <div class="container">

            <div class="row">
                <div class="col-md-12 table-row">
                    <table class="platfrom" style="width:  100% !important">
                        <thead>
                            <th>#</th>
                            <th>Platform</th>
                            <th>Capital raised to date, EUR</th>
                            <th>Avg interest rate</th>
                            <th># of projects funded</th>
                            {{-- <th># of projects not funded</th> --}}
                            {{-- <th># of open projects</th> --}}
                            <th># of Investors</th>
                            <th>Avg. ticket size, EUR</th>
                            <th>Raised in the past 30 days, EUR</th>
                            <th style="width: 116px;">Raised This Week, EUR</th>
                            <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count($platForm); $i++)
                                @php
                                    $a = $i;
                                    $a++;
                                @endphp
                                <tr>
                                    <td>{{ $a }}</td>
                                    <td>{{ ucwords($platForm[$i]->plat_form) }}</td>
                                    <td style="text-align: right;">
                                        {{ $platForm[$i]->capital_raised_to_date == 0 ? 'N/A' : number_format($platForm[$i]->capital_raised_to_date) }}
                                    </td>
                                    <td style="text-align: right;">
                                        {{ $platForm[$i]->avg_interest_rate == 0 ? 'N/A' : $platForm[$i]->avg_interest_rate }}%
                                    </td>
                                    <td style="text-align: right;">
                                        {{ $platForm[$i]->no_of_project_funded == 0 ? 'N/A' : number_format($platForm[$i]->no_of_project_funded) }}
                                    </td>
                                    {{-- <td style="text-align: right;">{{number_format($platForm[$i]->no_of_project_not_funded)}}</td> --}}
                                    {{-- <td style="text-align: right;">{{number_format($platForm[$i]->no_of_project_open)}}</td> --}}
                                    <td style="text-align: right;">
                                        {{ $platForm[$i]->no_of_investors == 0 ? 'N/A' : number_format($platForm[$i]->no_of_investors) }}
                                    </td>
                                    <td style="text-align: right;">
                                        {{ $platForm[$i]->avg_ticket_size == 0 ? 'N/A' : number_format($platForm[$i]->avg_ticket_size) }}
                                    </td>
                                    <td style="text-align: right;">
                                        @if (isset($platForm[$i]->raised_in_the_past_30_days_status))
                                            <div style="margin-top: 23px;">
                                                {{ $platForm[$i]->raised_in_past_30_days == 0 ? 'N/A' : number_format($platForm[$i]->raised_in_past_30_days) }}
                                            </div>
                                        @else
                                            <div>
                                                {{ $platForm[$i]->raised_in_past_30_days == 0 ? 'N/A' : number_format($platForm[$i]->raised_in_past_30_days) }}
                                            </div>
                                        @endif
                                        @if ($platForm[$i]->raised_in_the_past_30_days_status == 'increase')
                                            <span
                                                class="badge1 badge--success fc-success fs-1 lh-1 py-1 px-2 flex-center fw-black"
                                                style="height: 22px; background-color:transparent;">
                                                <span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512"
                                                        fill="#2ecc71" viewBox="0 0 512 512">
                                                        <path
                                                            d="M413.1 327.3l-1.8-2.1-136-156.5c-4.6-5.3-11.5-8.6-19.2-8.6-7.7 0-14.6 3.4-19.2 8.6L101 324.9l-2.3 2.6C97 330 96 333 96 336.2c0 8.7 7.4 15.8 16.6 15.8h286.8c9.2 0 16.6-7.1 16.6-15.8 0-3.3-1.1-6.4-2.9-8.9z" />
                                                    </svg>
                                                </span>
                                                {{ $platForm[$i]->raised_in_the_past_30_days_percentage }}%
                                            </span>
                                        @elseif($platForm[$i]->raised_in_the_past_30_days_status == 'decrease')
                                            <span
                                                class="badge1 badge--danger fc-danger fs-1 lh-1 py-1 px-2 flex-center fw-black"
                                                style="height: 22px; background-color:transparent;">
                                                <span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512"
                                                        fill="#e74c3c" viewBox="0 0 512 512">
                                                        <path
                                                            d="M98.9 184.7l1.8 2.1 136 156.5c4.6 5.3 11.5 8.6 19.2 8.6 7.7 0 14.6-3.4 19.2-8.6L411 187.1l2.3-2.6c1.7-2.5 2.7-5.5 2.7-8.7 0-8.7-7.4-15.8-16.6-15.8H112.6c-9.2 0-16.6 7.1-16.6 15.8 0 3.3 1.1 6.4 2.9 8.9z" />
                                                    </svg>
                                                </span>
                                                {{ $platForm[$i]->raised_in_the_past_30_days_percentage }}%
                                            </span>
                                        @endif
                                    </td>
                                    <td style="text-align: right;">
                                        @if (isset($platForm[$i]->raised_this_week_status))
                                            <div style="margin-top: 23px;">
                                                {{ $platForm[$i]->raised_in_past_7_days == 0 ? 'N/A' : number_format($platForm[$i]->raised_in_past_7_days) }}
                                            </div>
                                        @else
                                            <div>
                                                {{ $platForm[$i]->raised_in_past_7_days == 0 ? 'N/A' : number_format($platForm[$i]->raised_in_past_7_days) }}
                                            </div>
                                        @endif
                                        @if ($platForm[$i]->raised_this_week_status == 'increase')
                                            <span
                                                class="badge1 badge--success fc-success fs-1 lh-1 py-1 px-2 flex-center fw-black"
                                                style="height: 22px; background-color:transparent;">
                                                <span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512"
                                                        fill="#2ecc71" viewBox="0 0 512 512">
                                                        <path
                                                            d="M413.1 327.3l-1.8-2.1-136-156.5c-4.6-5.3-11.5-8.6-19.2-8.6-7.7 0-14.6 3.4-19.2 8.6L101 324.9l-2.3 2.6C97 330 96 333 96 336.2c0 8.7 7.4 15.8 16.6 15.8h286.8c9.2 0 16.6-7.1 16.6-15.8 0-3.3-1.1-6.4-2.9-8.9z" />
                                                    </svg>
                                                </span>
                                                {{ $platForm[$i]->raised_this_week_percentage }}%
                                            </span>
                                        @elseif($platForm[$i]->raised_this_week_status == 'decrease')
                                            <span
                                                class="badge1 badge--danger fc-danger fs-1 lh-1 py-1 px-2 flex-center fw-black"
                                                style="height: 22px; background-color:transparent;">
                                                <span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512"
                                                        fill="#e74c3c" viewBox="0 0 512 512">
                                                        <path
                                                            d="M98.9 184.7l1.8 2.1 136 156.5c4.6 5.3 11.5 8.6 19.2 8.6 7.7 0 14.6-3.4 19.2-8.6L411 187.1l2.3-2.6c1.7-2.5 2.7-5.5 2.7-8.7 0-8.7-7.4-15.8-16.6-15.8H112.6c-9.2 0-16.6 7.1-16.6 15.8 0 3.3 1.1 6.4 2.9 8.9z" />
                                                    </svg>
                                                </span>
                                                {{ $platForm[$i]->raised_this_week_percentage }}%
                                            </span>
                                        @endif
                                    </td>
                                    <td><a href="{{ $platForm[$i]->url }}" target="_bank"
                                            class="btn btn-primary --small">Register</a></td>
                                </tr>
                            @endfor
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- 6 Platforms -->
    <section class="sec-padding bg-silver platforms-boxes">
        <div class="container">
            <div class="row">
                @for ($i = 0; $i < count($platformRating); $i++)
                    <div class="col-md-4  mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="inner-first-div mb-5 align-center">
                                    <img class="mr-5" src="{{ asset($platformRating[$i]->path) }}" alt="">
                                    <div class="platform-name d-flex flex-column">
                                        <h6><b>{{ ucwords($platformRating[$i]->platform_name) }}</b></h6>
                                        <span>Estonia</span>
                                    </div>
                                </div>
                                <div class="inner-first-div mb-5 align-center">
                                    <div class="logo-stars">
                                        <img src="{{ asset('theme/website-assets/images/Crowdbull-logo.svg') }}"
                                            class="">
                                        @php $scoreFloor=floor($platformRating[$i]->score); @endphp
                                        <div class="stars">
                                            @for ($j = 0; $j < floor($platformRating[$i]->score); $j++)
                                                <span class="fa fa-star checked"></span>
                                            @endfor
                                            @if (strpos($platformRating[$i]->score, '.'))
                                                <span class="fa fa-star fa-star-half-full checked"></span>
                                                @php $scoreFloor=floor($platformRating[$i]->score)+1; @endphp
                                            @endif
                                            @for ($j = $scoreFloor; $j < 5; $j++)
                                                <span class="fa fa-star-o checked" style="font-size: 25px;"></span>
                                            @endfor
                                            {{-- <span class="fa fa-star fa-star-half-full checked"></span> --}}
                                            {{-- <span class="fa fa-star"></span> --}}
                                            {{-- <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star fa-star-half-full checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span> --}}
                                        </div>
                                    </div>
                                    <div class="platform-name d-flex flex-column text-center">
                                        <h6>Score</h6>
                                        <h1><b>{{ $platformRating[$i]->score }}</b></h1>
                                    </div>
                                </div>
                                <p class="mb-5 fc-secondary">{{ $platformRating[$i]->description }}</p>
                                <p class="mb-5"><b>Minimum ticket: {{ $platformRating[$i]->minimum_ticket }}</b></p>
                                <div class="inner-first-div mb-5 align-center">
                                    <a href="{{ $platformRating[$i]->more_info_url }}"
                                        class="btn btn-secondary --small">MORE INFO</a>
                                    <a href="{{ $platformRating[$i]->register_url }}"
                                        class="btn btn-primary --small">Register</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

        </div>
    </section>
    {{-- <section class="sec-padding bg-silver">
    <div class="container">
        <div class="row">
            @for ($i = 0; $i < count($platForm); $i++)
            <div class="col-md-4">
                    <div class="box cf-logo matchheight">
                        <div class="logo">
                            @if ($platForm[$i]->plat_form_image == '')
                            <a href="{{route('crowdfunding-platforms',$platForm[$i]->plat_form)}}"><img src="{{ asset('theme/website-assets/images/favicon.png')}}" alt=""></a>
                            @else
                            <a href="{{route('crowdfunding-platforms',$platForm[$i]->plat_form)}}"><img src="{{ asset($platForm[$i]->plat_form_image)}}" alt=""></a>
                            @endif
                        </div>
                    </div>
            </div>
            @endfor
        </div>
    </div>
</section> --}}

@endsection('contentWebsite')

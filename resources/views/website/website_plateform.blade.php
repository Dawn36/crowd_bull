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
                        <th># of open projects</th>
                        <th># of Investors</th>
                        <th>Avg. ticket size, EUR</th>
                        <th>Raised in the past 30 days, EUR</th>
                        <th style="width: 116px;">Raised This Week, EUR</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @for ($i = 0; $i < count($platForm); $i++) @php $a=$i; $a++; @endphp 

                    <tr>
                        <td>{{$a}}</td>
                        <td><a href="{{route('crowdfunding-platforms',$platForm[$i]->plat_form)}}" >{{ucwords($platForm[$i]->plat_form)}}</a></td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->capital_raised_to_date)}} </td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->avg_interest_rate)}}%</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->no_of_project_funded)}}</td>
                        {{-- <td style="text-align: right;">{{number_format($platForm[$i]->no_of_project_not_funded)}}</td> --}}
                        <td style="text-align: right;">{{number_format($platForm[$i]->no_of_project_open)}}</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->no_of_investors)}}</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->avg_ticket_size)}} </td>
                        <td style="text-align: right;">
                            <div>{{number_format($platForm[$i]->raised_in_past_30_days)}}</div>
                            @if($platForm[$i]->status == 'increase')
                            <span class="badge1 badge--success fc-success fs-1 lh-1 py-1 px-2 flex-center fw-black" style="height: 22px; background-color:transparent;">
                                <span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.5" d="M13 9.59998V21C13 21.6 12.6 22 12 22C11.4 22 11 21.6 11 21V9.59998H13Z" fill="black" style="fill: #2ecc71;"></path>
                                        <path d="M5.7071 7.89291C5.07714 8.52288 5.52331 9.60002 6.41421 9.60002H17.5858C18.4767 9.60002 18.9229 8.52288 18.2929 7.89291L12.7 2.3C12.3 1.9 11.7 1.9 11.3 2.3L5.7071 7.89291Z" fill="black" style="fill: #2ecc71;"></path>
                                    </svg>
                                </span>
                                {{$platForm[$i]->percentage}}%
                            </span>
                            @elseif($platForm[$i]->status == 'decrease')
                            <span class="badge1 badge--danger fc-danger fs-1 lh-1 py-1 px-2 flex-center fw-black" style="height: 22px; background-color:transparent;">
                                <span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.5" d="M13 14.4V3.00003C13 2.40003 12.6 2.00003 12 2.00003C11.4 2.00003 11 2.40003 11 3.00003V14.4H13Z" fill="black" style="fill: #e74c3c;"></path>
                                        <path d="M5.7071 16.1071C5.07714 15.4771 5.52331 14.4 6.41421 14.4H17.5858C18.4767 14.4 18.9229 15.4771 18.2929 16.1071L12.7 21.7C12.3 22.1 11.7 22.1 11.3 21.7L5.7071 16.1071Z" fill="black" style="fill: #e74c3c;"></path>
                                    </svg>
                                </span>
                                {{$platForm[$i]->percentage}}%
                            </span>
                            @endif
                        </td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->raised_in_past_7_days)}} </td>
                        <td><a href="{{$platForm[$i]->url}}" target="_bank" class="btn btn-primary --small">Register</a></td>
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
                            <img class="mr-5" src="{{asset($platformRating[$i]->path)}}" alt="">
                            <div class="platform-name d-flex flex-column">
                                <h6><b>{{ucwords($platformRating[$i]->platform_name)}}</b></h6>
                                <span>Estonia</span>
                            </div>
                        </div>
                        <div class="inner-first-div mb-5 align-center">
                            <div class="logo-stars">
                                <img src="{{asset('theme/website-assets/images/Crowdbull-logo.svg')}}" class="">
                                @php $scoreFloor=floor($platformRating[$i]->score); @endphp
                                <div class="stars">
                                    @for ($j = 0; $j < floor($platformRating[$i]->score); $j++)
                                    <span class="fa fa-star checked"></span>
                                    @endfor
                                    @if(strpos($platformRating[$i]->score, '.'))
                                    <span class="fa fa-star fa-star-half-full checked"></span> 
                                    @php $scoreFloor=floor($platformRating[$i]->score)+1; @endphp
                                    @endif
                                    @for ($j = $scoreFloor; $j < 5 ; $j++)
                                    <span class="fa fa-star "></span>
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
                                <h1><b>{{$platformRating[$i]->score}}</b></h1>
                            </div>
                        </div>
                        <p class="mb-5 fc-secondary">{{$platformRating[$i]->description}}</p>
                        <p class="mb-5"><b>Minimum ticket: {{$platformRating[$i]->minimum_ticket}}</b></p>
                        <div class="inner-first-div mb-5 align-center">
                            <a href="" class="btn btn-secondary --small">MORE INFO</a>
                            <a href="" class="btn btn-primary --small">Register</a>
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
                            @if($platForm[$i]->plat_form_image == '')
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
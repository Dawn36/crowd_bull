@extends('layouts.main_website')

@section('contentWebsite')
<style>
    .badge {
 
  color: white;
  padding: 4px;
  text-align: center;
  border-radius: 5px;
}
    </style>
<section class="clearfix relative-block herobanner ">
    <div class="hero relative-block">
        <!-- Loop Section Start -->
        <div class="slide">
            <div class="hero-banner main-slider  w-100 ">
                <figure class=" w-100 bg-cover bg-left slider " style="background-image:url(''); ">
                    <div class="container">
                        <div class="row align-center ">
                            <div class=" col-md-6 ">
                                <div class="banner-content   fadeIn fast" data-aos="fade-up" data-aos-duration="1200">
                                    <h2 class=" fc-primary title   slideInLeft">Real estate crowdfunding platforms tracker.</h2>
                                    <div class="content   slideInUp fast">
                                        <p class="">Tracking real estate crowdfunding platforms to deliver transparent view and to make data driven investment decisions. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 offset-md-1 prpx-0 col-xs-nopadd img-div">
                                <img src="{{ asset('theme/website-assets/images/banner-img.svg')}}" alt="banner-img">
                            </div>
                        </div>
                    </div>
                </figure>
            </div>
        </div>
    </div>
</section>
<!-- CrowdFunding Platform  -->
<section class="sec-padding --small">
    <div class="container">
        <div class="row tnstr ta-center">
            <div class="col-md-12 mbpx-40">
                <p class="subtitle">Real Estate</p>
                <h2 class="fc-primary title ">CrowdFunding PlatformS</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{-- <ul class="tableTabs">
                    <form id="all_time" method="GET" action="{{ route('index') }}">
                        <input name="all_time" value="" hidden/>
                    <li class="{{request()->all_time == '' ? "active" : ''}}" onclick=" document.getElementById('all_time').submit()">All Time</li>
                    </form>
                    <form id="ytd" method="GET" action="{{ route('index') }}">
                        <input name="all_time" value="ytd" hidden/>
                    <li class="{{request()->all_time == 'ytd' ? "active" : ''}}" onclick=" document.getElementById('ytd').submit()">YTD</li>
                    </form>
                    <form id="past" method="GET" action="{{ route('index') }}">
                        <input name="all_time" value="past" hidden/>
                    <li class="{{request()->all_time == 'past' ? "active" : ''}}" onclick=" document.getElementById('past').submit()">Past 30 days</li>
                    </form>
                    <form id="this_week" method="GET" action="{{ route('index') }}">
                        <input name="all_time" value="this_week" hidden/>
                    <li class="{{request()->all_time == 'this_week' ? "active" : ''}}" onclick=" document.getElementById('this_week').submit()">This Week</li>
                </form>

                </ul> --}}
            </div>
            <div class="col-md-12 table-row">
                <table class="platfrom" style="width:  100% !important">
                <thead>
                    <tr>
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
                        <th hidden> </th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($platForm); $i++) @php $a=$i; $a++; @endphp 
                    <tr>
                        <td>{{$a}}</td>
                        <td>{{ucwords($platForm[$i]->plat_form)}}</td>
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
            <div class="col-md-12 ta-center mtpx-30">
                <a href="{{route('crowdfunding-platform')}}"  class="btn btn-primary">More</a>
            </div>
        </div>
    </div>
</section>
<!-- CrowdFunding Projects  -->
<section class="sec-padding --small">
    <div class="container">
        <div class="row tnstr ta-center">
            <div class="col-md-12 mbpx-40">
                <p class="subtitle">Real Estate</p>
                <h2 class="fc-primary title ">CrowdFunding Projects</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="tableTabs">
                    <div class="row">
                        <div class="col">
                            <form id="all" method="GET" action="{{ route('crowdfunding-projects') }}">
                                    <input name="current_open" value="" hidden/>
                                <li class="{{request()->current_open == '' ? "active" : ''}}" onclick=" document.getElementById('all').submit();myFunction()">All</li>
                            </form>
                        </div>
                        <div class="col">
                            <form id="added" method="GET" action="{{ route('index') }}">
                                <input name="current_open" value="added" hidden/>
                                <li class="{{request()->current_open == 'added' ? "active" : ''}}" onclick=" document.getElementById('added').submit();myFunction()">Added this week</li>
                            </form>
                        </div>
                        <div class="col">
                            <form id="current_open" method="GET" action="{{ route('index') }}">
                                    <input name="current_open" value="current_open" hidden/>
                                <li class="{{request()->current_open == 'current_open' ? "active" : ''}}" onclick=" document.getElementById('current_open').submit();myFunction()">Currently Open</li>
                            </form>
                        </div>
                        <div class="col">
                            <form id="funded" method="GET" action="{{ route('index') }}">
                                <input name="current_open" value="funded" hidden/>
                                <li class="{{request()->current_open == 'funded' ? "active" : ''}}" onclick=" document.getElementById('funded').submit();myFunction()">Funded</li>
                            </form>
                        </div>
                        <div class="col">
                            <form id="not_funded" method="GET" action="{{ route('index') }}">
                                <input name="current_open" value="not_funded" hidden/>
                                <li class="{{request()->current_open == 'not_funded' ? "active" : ''}}" onclick=" document.getElementById('not_funded').submit();myFunction()">Not funded</li>
                            </form>
                        </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form id="fastest_funding_pace" method="GET" action="{{ route('index') }}">
                            <input name="current_open" value="fastest_funding_pace" hidden/>
                            <li class="{{request()->current_open == 'fastest_funding_pace' ? "active" : ''}}" onclick=" document.getElementById('fastest_funding_pace').submit();myFunction()">Fastest funding pace</li>
                        </form>
                    </div>
                    <div class="col">
                        <form id="large" method="GET" action="{{ route('index') }}">
                            <input name="current_open" value="large" hidden/>
                            <li class="{{request()->current_open == 'large' ? "active" : ''}}" onclick=" document.getElementById('large').submit();myFunction()">Largest Tickets</li>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form id="estateguru" method="GET" action="{{ route('index') }}">
                            <input name="current_open" value="estateguru" hidden />
                            <li class="{{request()->current_open == 'estateguru' ? "active" : ''}}" onclick=" document.getElementById('estateguru').submit();myFunction()">Estateguru</li>
                        </form>
                    </div>
                    <div class="col">
                        <form id="rendity" method="GET" action="{{ route('index') }}">
                            <input name="current_open" value="rendity" hidden />
                            <li class="{{request()->current_open == 'rendity' ? "active" : ''}}" onclick=" document.getElementById('rendity').submit();myFunction()">Rendity</li>
                        </form>
                    </div>
                    <div class="col">
                        <form id="profitus" method="GET" action="{{ route('index') }}">
                            <input name="current_open" value="profitus" hidden />
                            <li class="{{request()->current_open == 'profitus' ? "active" : ''}}" onclick=" document.getElementById('profitus').submit();myFunction()">Profitus</li>
                        </form>
                    </div>
                    <div class="col">
                        <form id="housers" method="GET" action="{{ route('index') }}">
                            <input name="current_open" value="housers" hidden />
                            <li class="{{request()->current_open == 'housers' ? "active" : ''}}" onclick=" document.getElementById('housers').submit();myFunction()">Housers</li>
                        </form>
                    </div>
                    <div class="col">
                        <form id="nordstreet" method="GET" action="{{ route('index') }}">
                            <input name="current_open" value="nordstreet" hidden />
                            <li class="{{request()->current_open == 'nordstreet' ? "active" : ''}}" onclick=" document.getElementById('nordstreet').submit();myFunction()">Nordstreet</li>
                        </form>
                    </div>
                    <div class="col">
                        <form id="crowdestate" method="GET" action="{{ route('index') }}">
                            <input name="current_open" value="crowdestate" hidden />
                            <li class="{{request()->current_open == 'crowdestate' ? "active" : ''}}" onclick=" document.getElementById('crowdestate').submit();myFunction()">Crowdestate</li>
                        </form>
                    </div>
                </div>
                </ul>
            </div>
            <div class="col-md-12 table-row">
                <table id="myTable" class="kt_datatable_example_1">
                    <thead>
                    <tr>
                        <th >#</th>
                        <th>Platform</th>
                        <th>Project Name</th>
                        <th style="width: 116px;">Goal, EUR</th>
                        <th>Duration, months</th>
                        <th>Interest</th>
                        <th>LTV</th>
                        <th style="width: 116px;">Raised to date, EUR</th>
                        <th>Funding progress</th>
                        <th># of Investors </th>
                        <th>Average Ticket, EUR </th>
                        <th>Raised Capital/hour</th>
                        <th>Date Added</th>
                        <th>Funding status</th>
                        <th hidden></th>
                    </tr>
                </thead>
                <tbody >
                    @for ($i = 0; $i < count($project); $i++) @php $a=$i; $a++; @endphp 
                    <tr>
                        <td>{{$a}}</td>
                        <td>{{ucwords($project[$i]->plat_form)}}</td>
                        <td>{{ucwords($project[$i]->project_name)}}</td>
                        <td style="text-align: right;">{{number_format($project[$i]->goal)}} </td>
                        <td>{{$project[$i]->duration_month}} </td>
                        <td>{{$project[$i]->interest}}%</td>
                        
                         @if($project[$i]->plat_form == 'rendity.com' && $project[$i]->ltv == '')
                        <td >N/A</td>
                        @else
                        <td>{{$project[$i]->ltv}}%</td>
                        @endif
                        <td style="text-align: right;">{{number_format($project[$i]->raised_to_date)}} </td>
                        <td>
                            <div class="progress-bar">
                                <span class="progress-bar-fill" style="width: {{$project[$i]->funding_progress}}%;" data-width="{{$project[$i]->funding_progress}}"></span>
                            </div>
                            <p hidden>{{$project[$i]->funding_progress}}</p>
                        </td>
                        
                        @if($project[$i]->plat_form == 'rendity.com' && $project[$i]->investors == 0)
                        <td style="text-align: right;">N/A</td>
                        @else
                        <td style="text-align: right;">{{number_format($project[$i]->investors)}} </td>
                        @endif
                        @if($project[$i]->plat_form == 'rendity.com' && $project[$i]->average_ticket == 0)
                        <td style="text-align: right;">N/A</td>
                        @else
                         <td style="text-align: right;">{{number_format($project[$i]->average_ticket)}} </td>
                        @endif
                       
                        <td style="text-align: right;">{{number_format($project[$i]->funding_pace)}} </td>
                        @if($project[$i]->funding_status == 'funded')
                        @php  $color='#50cd89'@endphp
                        @elseif($project[$i]->funding_status == 'in process')
                        @php  $color='#ffc700'@endphp
                        @elseif($project[$i]->funding_status == 'not funded')
                        @php  $color='#f33e3e'@endphp
                        @elseif($project[$i]->funding_status == 'unknown')
                        @php  $color='#808080'@endphp
                        @endif
                        <td style="    width: 109px;"><span class="badge" style=" background-color: {{$color}};">{{ucwords($project[$i]->funding_status)}}</span></td>
                        <td>{{date("Y-m-d",strtotime($project[$i]->created_at))}} </td>
                        <td><a href="{{$project[$i]->url}}" target="_bank" class="btn btn-primary --small">Invest</a></td>
                    </tr>
                    @endfor
                </tbody>
                </table>
            </div>
            <div class="col-md-12 ta-center mtpx-30">
                <a href="{{route('crowdfunding-projects')}}" class="btn btn-primary">More</a>
            </div>
        </div>
    </div>
</section>
<!-- Recent Articles -->
<section class="sec-padding">
    <div class="container">
        <div class="row tnstr ta-center">
            <div class="col-md-12 mbpx-40">
                <p class="subtitle">Get update with us</p>
                <h2 class="fc-primary title ">Recent Articles</h2>
            </div>
        </div>
        <div class="row">
            @for ($i = 0; $i < count($blog); $i++)
            <div class="col-md-6 col-lg-4 col-sm-12 col-xs-12">
                <div class="box blog" style="height: 590px;">
                    <div class="img_node">
                        <img src="{{ asset($blog[$i]->blog_thumbnail)}}" alt="">
                    </div>
                    <div class="content_node">
                        <p class="subtitle">
                            Guides
                        </p>
                        <h5 class="fc-black title matchheight">
                            <a href="{{route('article-single',$blog[$i]->blog_id)}}"> {{substr(ucwords($blog[$i]->blog_name),0,60)}}</a>
                        </h5>
                        <p>
                            @php echo html_entity_decode(substr($blog[$i]->description, 0, 200)) @endphp
                            <a href="{{route('article-single',$blog[$i]->blog_id)}}" class="subtitle">Read More</a>
                        </p>
                        <div class="profile">
                            <div class="profile-img">
                                <img src="{{ asset('theme/website-assets/images/profile.jpg')}}" alt="">
                            </div>
                            <div class="profile-content">
                                <h6 class="name">{{ucwords($blog[$i]->first_name)}} {{ucwords($blog[$i]->last_name)}}</h6>
                                <p class="date">
                                    {{DATE("F j, Y",strtotime($blog[$i]->blog_created_at))}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
            
        </div>
    </div>
</section>
<!-- SEO Content -->
<section class="sec-padding content-simple ptpx-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>What is crowdfunding?</h1>
                <p>Crowdfunding is a capital raising process, during which capital is raised from the public via open process. Public entails both private individuals or institutional investors. Usually, crowdfunding is used when other types of capital raising is not possible due to various factors, e.g., risk profile. There might be some cases, when crowdfunding campaigns are being used as a marketing tool to market the product, service or project itself.</p>

                <h2>What is a real estate crowdfunding?</h2>
                <p>Real estate crowdfunding is a capital raising process, during which capital for real estate project financing is being raised from the public via open sources. Developers are using real estate crowdfunding process, when bank financing considers this as of a higher risk project and other alternative capital raising sources are not available. A typical element in real estate crowdfunding is real estate pledge as a security for the investors.</p>

                <h2>What is a real estate crowdfunding platform?</h2>
                <p>Real estate crowdfunding platform is a middle man between the borrowers and investors. Real estate crowdfunding platform business is a licensed business in EU and regulated by central banks. Therefore, real estate platforms must comply with the central bank requirements, such as: have integral process and procedures how they operate, approved risk scoring models and etc. Platforms themselves also make the borrowing, investing and management process convenient. They ensure that proper documentation is in place, pledges are properly secured, interest payment process is smooth and etc.</p>

                <h2>What is a real estate crowdfunding project?</h2>
                <p>Real estate crowdfunding project is real estate development project, for which capital is being raised via real estate crowdfunding platform. Typically, developers of such projects cannot get bank financing, therefore is moving towards more expensive way of raising capital. In exchange for capital, project developer is pledging real estate assets (land or construction).</p>

                <h2>How to invest in real estate crowdfunding process?</h2>
                <p>First of all, an investor should select a preferred platform, where he or she wants to invest. A broader description and comparison of various platforms could be found here. Secondly, each regulated platform applies a KYC procedure, which usually contains a self onboarding process with taking a picture of yourself, filling up a questionnaire and supplying additional information. Onboarding process can take from 15min mins to 24 hours depending on the platform and KYC provider platforms are using. After onboarding yourself, you can select the preferred project and invest. Depending from the platform, minimum investments start with as little as 100 EUR.</p>
            </div>
        </div>
    </div>
</section>
<script>

 topaaaa = localStorage.getItem("sidebar-scroll");
if (topaaaa !== null) {
  window.scrollTo(0, topaaaa);
  localStorage.clear();
}

function myFunction() {
    localStorage.setItem("sidebar-scroll",$(document).scrollTop() );
}

    </script>
@endsection('contentWebsite')
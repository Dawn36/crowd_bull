@extends('layouts.main_website')

@section('contentWebsite')
<style>
    .badge {
 
  color: white;
  padding: 4px;
  text-align: center;
  border-radius: 5px;
}
.capitalize{
        text-transform: capitalize;
    }
    .numberright{
        text-align: right
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
                        <th > </th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($platForm); $i++) @php $a=$i; $a++; @endphp 
                    <tr>
                        <td>{{$a}}</td>
                        <td>{{ucwords($platForm[$i]->plat_form)}}</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->capital_raised_to_date)}} </td>
                        <td style="text-align: right;">{{$platForm[$i]->avg_interest_rate}}%</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->no_of_project_funded)}}</td>
                        {{-- <td style="text-align: right;">{{number_format($platForm[$i]->no_of_project_not_funded)}}</td> --}}
                        <td style="text-align: right;">{{number_format($platForm[$i]->no_of_project_open)}}</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->no_of_investors)}}</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->avg_ticket_size)}} </td>
                        <td style="text-align: right;">
                            @if(isset($platForm[$i]->raised_in_the_past_30_days_status))
                            <div style="margin-top: 23px;">{{number_format($platForm[$i]->raised_in_past_30_days)}}</div>
                            @else
                            <div >{{number_format($platForm[$i]->raised_in_past_30_days)}}</div>
                            @endif
                            @if($platForm[$i]->raised_in_the_past_30_days_status == 'increase')
                            <span class="badge1 badge--success fc-success fs-1 lh-1 py-1 px-2 flex-center fw-black" style="height: 22px; background-color:transparent;">
                                <span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" fill="#2ecc71" viewBox="0 0 512 512"><path d="M413.1 327.3l-1.8-2.1-136-156.5c-4.6-5.3-11.5-8.6-19.2-8.6-7.7 0-14.6 3.4-19.2 8.6L101 324.9l-2.3 2.6C97 330 96 333 96 336.2c0 8.7 7.4 15.8 16.6 15.8h286.8c9.2 0 16.6-7.1 16.6-15.8 0-3.3-1.1-6.4-2.9-8.9z"/></svg>
                                </span>
                                {{$platForm[$i]->raised_in_the_past_30_days_percentage}}%
                            </span>
                            @elseif($platForm[$i]->raised_in_the_past_30_days_status == 'decrease')
                            <span class="badge1 badge--danger fc-danger fs-1 lh-1 py-1 px-2 flex-center fw-black" style="height: 22px; background-color:transparent;">
                                <span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" fill="#e74c3c"  viewBox="0 0 512 512"><path d="M98.9 184.7l1.8 2.1 136 156.5c4.6 5.3 11.5 8.6 19.2 8.6 7.7 0 14.6-3.4 19.2-8.6L411 187.1l2.3-2.6c1.7-2.5 2.7-5.5 2.7-8.7 0-8.7-7.4-15.8-16.6-15.8H112.6c-9.2 0-16.6 7.1-16.6 15.8 0 3.3 1.1 6.4 2.9 8.9z"/></svg>
                                </span>
                                {{$platForm[$i]->raised_in_the_past_30_days_percentage}}%
                            </span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            @if(isset($platForm[$i]->raised_this_week_status))
                            <div style="margin-top: 23px;">{{number_format($platForm[$i]->raised_in_past_7_days)}}</div>
                            @else
                            <div >{{number_format($platForm[$i]->raised_in_past_7_days)}}</div>
                            @endif
                            @if($platForm[$i]->raised_this_week_status == 'increase')
                            <span class="badge1 badge--success fc-success fs-1 lh-1 py-1 px-2 flex-center fw-black" style="height: 22px; background-color:transparent;">
                                <span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" fill="#2ecc71" viewBox="0 0 512 512"><path d="M413.1 327.3l-1.8-2.1-136-156.5c-4.6-5.3-11.5-8.6-19.2-8.6-7.7 0-14.6 3.4-19.2 8.6L101 324.9l-2.3 2.6C97 330 96 333 96 336.2c0 8.7 7.4 15.8 16.6 15.8h286.8c9.2 0 16.6-7.1 16.6-15.8 0-3.3-1.1-6.4-2.9-8.9z"/></svg>
                                </span>
                                {{$platForm[$i]->raised_this_week_percentage}}%
                            </span>
                            @elseif($platForm[$i]->raised_this_week_status == 'decrease')
                            <span class="badge1 badge--danger fc-danger fs-1 lh-1 py-1 px-2 flex-center fw-black" style="height: 22px; background-color:transparent;">
                                <span class="svg-icon svg-icon-7 svg-icon-white ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" fill="#e74c3c"  viewBox="0 0 512 512"><path d="M98.9 184.7l1.8 2.1 136 156.5c4.6 5.3 11.5 8.6 19.2 8.6 7.7 0 14.6-3.4 19.2-8.6L411 187.1l2.3-2.6c1.7-2.5 2.7-5.5 2.7-8.7 0-8.7-7.4-15.8-16.6-15.8H112.6c-9.2 0-16.6 7.1-16.6 15.8 0 3.3 1.1 6.4 2.9 8.9z"/></svg>
                                </span>
                                {{$platForm[$i]->raised_this_week_percentage}}%
                            </span>
                            @endif
                        </td>
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
                {{-- <form id="added" method="GET" action="{{ route('index') }}"> --}}
                <ul class="tableTabs" style="display:contents;">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('crowdfunding-projects') }}"> 
                                <li >All</li></a>
                        </div>
                        <div class="col">
                                <input name="added" id="added" value=""  hidden/>
                                <li  onclick="submitFrom('added',this);">Added this week</li>
                            </div>
                        <div class="col">
                                <input name="current_open" id="current_open" value=""   hidden/>
                                <li  onclick="submitFrom('current_open',this);">Currently Open</li>
                        </div>
                        <div class="col">
                                <input name="funded" id="funded" value=""  hidden/>
                                <li  onclick="submitFrom('funded',this);">Funded</li>
                        </div>
                        <div class="col">
                                <input name="not_funded" id="not_funded" value="" disabled hidden/>
                                <li  onclick="submitFrom('not_funded',this);">Not funded</li>
                        </div>
                    </div>
                <div class="row">
                    <div class="col">
                            <input name="fastest_funding_pace" id="fastest_funding_pace" value="" disabled hidden/>
                            <li  onclick="submitFrom('fastest_funding_pace',this);">Fastest funding pace</li>
                    </div>
                    <div class="col">
                            <input name="large" id="large" value="" disabled hidden/>
                            <li  onclick="submitFrom('large',this);">Largest Tickets</li>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                            <input name="estateguru" id="estateguru" value="" disabled hidden />
                            <li  onclick="submitFrom('estateguru',this);">Estateguru</li>
                    </div>
                    <div class="col">
                            <input name="rendity" id="rendity" value="" disabled hidden />
                            <li  onclick="submitFrom('rendity',this);">Rendity</li>
                    </div>
                    <div class="col">
                            <input name="profitus" id="profitus" value="" disabled hidden />
                            <li  onclick="submitFrom('profitus',this);">Profitus</li>
                    </div>
                    <div class="col">
                            <input name="housers" id="housers" value="" disabled hidden />
                            <li  onclick="submitFrom('housers',this);">Housers</li>
                    </div>
                    <div class="col">
                            <input name="nordstreet" id="nordstreet" value="" disabled hidden />
                            <li  onclick="submitFrom('nordstreet',this);">Nordstreet</li>
                    </div>
                    <div class="col">
                            <input name="crowdestate" id="crowdestate" value="" disabled hidden />
                            <li  onclick="submitFrom('crowdestate',this);">Crowdestate</li>
                    </div>
                </div>
                </ul>
            {{-- </form> --}}
            </div>
            <div class="col-md-12 table-row">
                <table id="myTable" style="width:100%">
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
                        <th>Funding status</th>
                        <th>Date Added</th>
                        <th ></th>
                    </tr>
                </thead>
                <tbody >
                    {{-- @for ($i = 0; $i < count($project); $i++) @php $a=$i; $a++; @endphp 
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
                    @endfor --}}
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
                            <a href="{{route('article-single',$blog[$i]->slug)}}"> {{substr(ucwords($blog[$i]->blog_name),0,60)}}</a>
                        </h5>
                        <p>
                            @php echo html_entity_decode(substr($blog[$i]->description, 0, 200)) @endphp
                            <a href="{{route('article-single',$blog[$i]->slug)}}" class="subtitle">Read More</a>
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

<script type="text/javascript">

$(document).ready(function(){
// Initialize
dt =  $('#myTable').DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    scrollX:        true,
    scrollCollapse: true,
    paging:         false,
    fixedHeader: {
            header: true,
            // headerOffset: 65,
            },
    fixedColumns:   {
        left: 2,
        right: 0
    },
    // order: [[0, 'desc']],
    // ajax: "{{ route('get_project_home') }}",
    ajax: {
          url: "{{ route('get_project_home') }}",
          data: function (d) {
                d.added = $('#added').val(),
                d.current_open = $('#current_open').val()
                d.funded = $('#funded').val()
                d.not_funded = $('#not_funded').val()
                d.fastest_funding_pace = $('#fastest_funding_pace').val()
                d.large = $('#large').val()
                d.estateguru = $('#estateguru').val()
                d.rendity = $('#rendity').val()
                d.profitus = $('#profitus').val()
                d.housers = $('#housers').val()
                d.nordstreet = $('#nordstreet').val()
                d.crowdestate = $('#crowdestate').val()
                // d.contact_status = $('#contact_status').val()
                // d.search_new = $('#searchNew').val()
            }
        },
        
    columns: [
        { data: 'id', name: 'id' ,searchable: false,},
        { data: 'plat_form' , name: 'plat_form' },
        { data: 'project_name' , name: 'project_name' },
        { data: 'goal' , name: 'goal' },
        { data: 'duration_month' , name: 'duration_month' },
        { data: 'interest' , name: 'interest' },
        { data: 'ltv' , name: 'ltv' },
        { data: 'raised_to_date' , name: 'raised_to_date' },
        { data: 'funding_progress' , name: 'funding_progress' },
        { data: 'investors' , name: 'investors' },
        { data: 'average_ticket' , name: 'average_ticket' },
        { data: 'funding_pace' , name: 'funding_pace' },
        { data: 'funding_status' , name: 'funding_status' },
        { data: 'created_at' , name: 'created_at' },
        { data: 'url',name: 'url',searchable: false},
    ],
    columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    
                },
                {
                    targets: 1,
                    orderable: false,
                   
                },
                {
                    targets: 2,
                    orderable: false,
                    
                },
                {
                    targets: 3,
                    orderable: true,
                    className: 'numberright',
                    render: function (data, type, row) {
                        return `
                        <td >${row.goal} </td>
                        `;
                    }
                },
                {
                    targets: 4,
                    orderable: true,
                    className: 'numberright',
                    render: function (data, type, row) {
                        return `
                        <td >${row.duration_month} </td>
                        `;
                    }
                },
                {
                    targets: 5,
                    orderable: true,
                    className: 'numberright',
                    render: function (data, type, row) {
                        return `
                        <td >${row.interest} %</td>
                        `;
                    }
                },
                {
                    targets: 6,
                    orderable: true,
                    className: 'numberright',
                    render: function (data, type, row) {
                        if(row.plat_form == 'rendity.com' && row.ltv == '')
                        {
                            return `
                            <td >N/A</td>
                        `;
                        }
                        else
                        {
                            return `
                        <td >${row.ltv} %</td>
                        `;
                        }
                        
                    }
                },
                {
                    targets: 7,
                    orderable: true,
                    className: 'numberright',
                    render: function (data, type, row) {
                        return `
                        <td >${new Intl.NumberFormat().format(parseInt(row.raised_to_date))} </td>
                        `;
                    }
                },
                {
                    targets: 8,
                    orderable: true,
                    render: function (data, type, row) {
                        return `
                        <td>
                            <div class="progress-bar">
                                <span class="progress-bar-fill" style="width: ${row.funding_progress}%;" data-width="${row.funding_progress}"></span>
                            </div>
                            <p hidden>${row.funding_progress}</p>
                        </td>
                        `;
                    }
                },
                {
                    targets: 9,
                    orderable: true,
                    className: 'numberright',
                    render: function (data, type, row) {
                        if(row.plat_form == 'rendity.com' && row.investors == 0)
                        {
                            return `
                            <td >N/A</td>
                        `;  
                        }
                        else
                        {
                            return `
                        <td >${new Intl.NumberFormat().format(parseInt(row.investors))} </td>
                        `;  
                        }
                    }
                },
                {
                    targets: 10,
                    orderable: true,
                    className: 'numberright',
                    render: function (data, type, row) {
                        if(row.plat_form == 'rendity.com' && row.average_ticket == 0)
                        {
                            return `
                            <td >N/A</td>
                        `;  
                        }
                        else
                        {
                            return `
                        <td >${new Intl.NumberFormat().format(parseInt(row.average_ticket))} </td>
                        `;  
                        }
                    }
                },
                {
                    targets: 11,
                    orderable: true,
                    className: 'numberright',
                    render: function (data, type, row) {
                            return `
                        <td >${new Intl.NumberFormat().format(parseInt(row.funding_pace))} </td>
                        `;  
                    }
                },
                {
                    targets: 12,
                    orderable: false,
                    render: function (data, type, row) {
                        if(row.funding_status == 'funded')
                        {
                          color='#50cd89';
                        }
                        else if(row.funding_status == 'in process')
                        {
                            color='#ffc700';
                        }
                        else if(row.funding_status == 'not funded')
                        {
                            color='#f33e3e';
                        }
                        else if(row.funding_status == 'unknown')
                        {
                            color='#808080';
                        }
                        return `
                        <td style="width: 109px;" class="capitalize"><span class="badge" style=" background-color: ${color};">${row.funding_status}</span></td>
                        `; 
                    }
                },
                {
                    targets: 13,
                    orderable: false,
                    render: function (data, type, row) {
                            return `
                            <td>${row.created_ata} </td>
                        `;  
                    }
                },
                {
                    targets: 14,
                    orderable: false,
                    render: function (data, type, row) {
                            return `
                            <td><a href="${row.url}" target="_bank" class="btn btn-primary --small">Invest</a></td>
                        `;  
                    }
                },
            ],
                        
    
});
table = dt.$;  
       
});
//  topaaaa = localStorage.getItem("sidebar-scroll");
// if (topaaaa !== null) {
//   window.scrollTo(0, topaaaa);
//   localStorage.clear();
// }

// function myFunction() {
//     localStorage.setItem("sidebar-scroll",$(document).scrollTop() );
// }

function submitFrom(val,obj)
{
    if(obj.parentElement.children[0].value == '')
    {
        obj.classList.add('active');
        obj.parentElement.children[0].value=val;
    }
    else
    {
        debugger
        obj.classList.remove('active');
        obj.parentElement.children[0].value='';
    }
    dt.draw();
}

    </script>
@endsection('contentWebsite')
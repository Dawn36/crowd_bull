@extends('layouts.main_website')

@section('contentWebsite')
<style>
    .badge {
 
  color: white;
  padding: 4px;
  text-align: center;
  border-radius: 5px;
}
ul.pagination {
    display: flex;
    gap: 10px;
    align-items: center;
    list-style: none;
    justify-content: center; }
    ul.pagination li {
      width: 25px;
      height: 32px;
      background-color: transparent;
      border-radius: 6px;
      text-align: center; }
      ul.pagination li a {
        line-height: 32px; }
      ul.pagination li:hover, ul.pagination li.active {
        color: #ffffff;
        background: #0066f9; }
        ul.pagination li:hover a, ul.pagination li.active a {
          color: #ffffff; }
    @media (max-width: 1300px) {
      ul.pagination {
        gap: 2px; }
        ul.pagination li {
          width: 18px;
          height: 27px;
          font-size: 10px; }
          ul.pagination li a {
            line-height: 27px; } }
    </style>

<section class="clearfix relative-block hero-banner inside-banner ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- <p class="subtitle fc-black fw-semi-bold fs-medium tt-uppercase">Real Estate</p>
                <h1 class="title">Crowdfunding Projects</h1> --}}
                <h1 class="title">Real Estate Crowdfunding Projects</h1>
            </div>
        </div>
    </div>
</section>
<!-- CrowdFunding Platform  -->
<section class="sec-padding ">
    <div class="container">

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
                            <form id="added" method="GET" action="{{ route('crowdfunding-projects') }}">
                                <input name="current_open" value="added" hidden/>
                                <li class="{{request()->current_open == 'added' ? "active" : ''}}" onclick=" document.getElementById('added').submit();myFunction()">Added this week</li>
                            </form>
                        </div>
                        <div class="col">
                            <form id="current_open" method="GET" action="{{ route('crowdfunding-projects') }}">
                                    <input name="current_open" value="current_open" hidden/>
                                <li class="{{request()->current_open == 'current_open' ? "active" : ''}}" onclick=" document.getElementById('current_open').submit();myFunction()">Currently Open</li>
                            </form>
                        </div>
                        <div class="col">
                            <form id="funded" method="GET" action="{{ route('crowdfunding-projects') }}">
                                <input name="current_open" value="funded" hidden/>
                                <li class="{{request()->current_open == 'funded' ? "active" : ''}}" onclick=" document.getElementById('funded').submit();myFunction()">Funded</li>
                            </form>
                        </div>
                        <div class="col">
                            <form id="not_funded" method="GET" action="{{ route('crowdfunding-projects') }}">
                                <input name="current_open" value="not_funded" hidden/>
                                <li class="{{request()->current_open == 'not_funded' ? "active" : ''}}" onclick=" document.getElementById('not_funded').submit();myFunction()">Not funded</li>
                            </form>
                        </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form id="fastest_funding_pace" method="GET" action="{{ route('crowdfunding-projects') }}">
                            <input name="current_open" value="fastest_funding_pace" hidden/>
                            <li class="{{request()->current_open == 'fastest_funding_pace' ? "active" : ''}}" onclick=" document.getElementById('fastest_funding_pace').submit();myFunction()">Fastest funding pace</li>
                        </form>
                    </div>
                    <div class="col">
                        <form id="large" method="GET" action="{{ route('crowdfunding-projects') }}">
                            <input name="current_open" value="large" hidden/>
                            <li class="{{request()->current_open == 'large' ? "active" : ''}}" onclick=" document.getElementById('large').submit();myFunction()">Largest Tickets</li>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form id="estateguru" method="GET" action="{{ route('crowdfunding-projects') }}">
                            <input name="current_open" value="estateguru" hidden />
                            <li class="{{request()->current_open == 'estateguru' ? "active" : ''}}" onclick=" document.getElementById('estateguru').submit();myFunction()">Estateguru</li>
                        </form>
                    </div>
                    <div class="col">
                        <form id="rendity" method="GET" action="{{ route('crowdfunding-projects') }}">
                            <input name="current_open" value="rendity" hidden />
                            <li class="{{request()->current_open == 'rendity' ? "active" : ''}}" onclick=" document.getElementById('rendity').submit();myFunction()">Rendity</li>
                        </form>
                    </div>
                    <div class="col">
                        <form id="profitus" method="GET" action="{{ route('crowdfunding-projects') }}">
                            <input name="current_open" value="profitus" hidden />
                            <li class="{{request()->current_open == 'profitus' ? "active" : ''}}" onclick=" document.getElementById('profitus').submit();myFunction()">Profitus</li>
                        </form>
                    </div>
                    <div class="col">
                        <form id="housers" method="GET" action="{{ route('crowdfunding-projects') }}">
                            <input name="current_open" value="housers" hidden />
                            <li class="{{request()->current_open == 'housers' ? "active" : ''}}" onclick=" document.getElementById('housers').submit();myFunction()">Housers</li>
                        </form>
                    </div>
                    <div class="col">
                        <form id="nordstreet" method="GET" action="{{ route('crowdfunding-projects') }}">
                            <input name="current_open" value="nordstreet" hidden />
                            <li class="{{request()->current_open == 'nordstreet' ? "active" : ''}}" onclick=" document.getElementById('nordstreet').submit();myFunction()">Nordstreet</li>
                        </form>
                    </div>
                    <div class="col">
                        <form id="crowdestate" method="GET" action="{{ route('crowdfunding-projects') }}">
                            <input name="current_open" value="crowdestate" hidden />
                            <li class="{{request()->current_open == 'crowdestate' ? "active" : ''}}" onclick=" document.getElementById('crowdestate').submit();myFunction()">Crowdestate</li>
                        </form>
                    </div>
                </div>
                </ul>
            </div>
            <div class="col-md-12 table-row">
                <table id="project">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Platform</th>
                        <th>Project Name</th>
                        <th style="width: 116px;">Goal, EUR</th>
                        <th>Duration, months</th>
                        <th>Interest</th>
                        <th>LTV</th>
                        <th style="width: 116px;">Raised to date, EUR</th>
                        <th>Funding progress</th>
                        <th># of Investors </th>
                        <th>Average Ticket, EUR</th>
                        <th>Raised Capital/hour</th>
                        <th>Funding Status</th>
                        <th>Date Added</th>
                        <th></th>
                    </tr>
                    </thead>
                    @php 
                        $a=$project->currentPage() == '1' ? '0' : $project->perPage()*($project->currentPage()-1);
                       @endphp
                <tbody>
                    @for ($i = 0; $i < count($project); $i++) @php  $a++; @endphp
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
            <div class="col-md-12 mtpx-30">
                {{ $project->links('website.website_paginating_ui') }}
               
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
       localStorage.setItem("sidebar-scroll",$(document).scrollTop());
   }
   
       </script>
@endsection('contentWebsite')
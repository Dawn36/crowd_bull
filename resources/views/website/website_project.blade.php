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
                    <form id="all" method="GET" action="{{ route('crowdfunding-projects') }}">
                        <input name="current_open" value="" hidden/>
                    <li class="{{request()->current_open == '' ? "active" : ''}}" onclick=" document.getElementById('all').submit();myFunction()">All</li>
                </form>
                    <form id="current_open" method="GET" action="{{ route('crowdfunding-projects') }}">
                        <input name="current_open" value="current_open" hidden/>
                    <li class="{{request()->current_open == 'current_open' ? "active" : ''}}" onclick=" document.getElementById('current_open').submit();myFunction()">Currently Open</li>
                </form>
                <form id="fastest_funding_pace" method="GET" action="{{ route('crowdfunding-projects') }}">
                    <input name="current_open" value="fastest_funding_pace" hidden/>
                    <li class="{{request()->current_open == 'fastest_funding_pace' ? "active" : ''}}" onclick=" document.getElementById('fastest_funding_pace').submit();myFunction()">Fastest funding pace</li>
                </form>
                <form id="added" method="GET" action="{{ route('crowdfunding-projects') }}">
                    <input name="current_open" value="added" hidden/>
                    <li class="{{request()->current_open == 'added' ? "active" : ''}}" onclick=" document.getElementById('added').submit();myFunction()">Added this week</li>
                </form>
                <form id="large" method="GET" action="{{ route('crowdfunding-projects') }}">
                    <input name="current_open" value="large" hidden/>
                    <li class="{{request()->current_open == 'large' ? "active" : ''}}" onclick=" document.getElementById('large').submit();myFunction()">Largest Tickets</li>
                </form>

                </ul>
            </div>
            <div class="col-md-12 table-row">
                <table>
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
                        <th>Funding Pace</th>
                        <th>Funding status</th>
                        <th></th>
                    </tr>
                    @for ($i = 0; $i < count($project); $i++) @php $a=$i; $a++; @endphp 
                    <tr>
                        <td>{{$a}}</td>
                        <td>{{ucwords($project[$i]->plat_form)}}</td>
                        <td>{{ucwords($project[$i]->project_name)}}</td>
                        <td style="text-align: right;">{{number_format($project[$i]->goal)}} </td>
                        <td>{{$project[$i]->duration_month}} </td>
                        <td>{{$project[$i]->interest}}%</td>
                        <td>{{$project[$i]->ltv}}%</td>
                        <td style="text-align: right;">{{number_format($project[$i]->raised_to_date)}} </td>
                        <td>
                            <div class="progress-bar">
                                <span class="progress-bar-fill" style="width: {{$project[$i]->funding_progress}}%;" data-width="{{$project[$i]->funding_progress}}"></span>
                            </div>
                        </td>
                        <td style="text-align: right;">{{number_format($project[$i]->investors)}} </td>
                        <td style="text-align: right;">{{number_format($project[$i]->average_ticket)}} </td>
                        <td style="text-align: right;">{{number_format($project[$i]->funding_pace)}} </td>
                        @if($project[$i]->funding_status == 'funded')
                        @php  $color='#50cd89'@endphp
                        @elseif($project[$i]->funding_status == 'in process')
                        @php  $color='#ffc700'@endphp
                        @elseif($project[$i]->funding_status == 'not funded')
                        @php  $color='#ffc700'@endphp
                        @endif
                        <td style="    width: 109px;"><span class="badge" style=" background-color: {{$color}};">{{ucwords($project[$i]->funding_status)}}</span></td>
                        <td><a href="{{$project[$i]->url}}" target="_bank" class="btn btn-primary --small">Invest</a></td>
                    </tr>
                    @endfor
                </table>
                
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
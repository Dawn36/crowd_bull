@extends('layouts.main_website')

@section('contentWebsite')


<section class="clearfix relative-block hero-banner inside-banner ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="subtitle fc-black fw-semi-bold fs-medium tt-uppercase">Real Estate</p>
                <h1 class="title">Crowdfunding Projects</h1>
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
                    <li class="{{request()->current_open == '' ? "active" : ''}}" onclick=" document.getElementById('all').submit()">All</li>
                </form>
                    <form id="current_open" method="GET" action="{{ route('crowdfunding-projects') }}">
                        <input name="current_open" value="current_open" hidden/>
                    <li class="{{request()->current_open == 'current_open' ? "active" : ''}}" onclick=" document.getElementById('current_open').submit()">Currently Open</li>
                </form>
                <form id="fastest_funding_pace" method="GET" action="{{ route('crowdfunding-projects') }}">
                    <input name="current_open" value="fastest_funding_pace" hidden/>
                    <li class="{{request()->current_open == 'fastest_funding_pace' ? "active" : ''}}" onclick=" document.getElementById('fastest_funding_pace').submit()">Fastest funding pace</li>
                </form>
                <form id="added" method="GET" action="{{ route('crowdfunding-projects') }}">
                    <input name="current_open" value="added" hidden/>
                    <li class="{{request()->current_open == 'added' ? "active" : ''}}" onclick=" document.getElementById('added').submit()">Added this week</li>
                </form>
                <form id="large" method="GET" action="{{ route('crowdfunding-projects') }}">
                    <input name="current_open" value="large" hidden/>
                    <li class="{{request()->current_open == 'large' ? "active" : ''}}" onclick=" document.getElementById('large').submit()">Largest Tickets</li>
                </form>

                </ul>
            </div>
            <div class="col-md-12 table-row">
                <table>
                    <tr>
                        <th>#</th>
                        <th>Platform</th>
                        <th>Project Name</th>
                        <th>Goal</th>
                        <th>Duration, months</th>
                        <th>Interest</th>
                        <th>LTV</th>
                        <th>Raised to date</th>
                        <th>Funding progress</th>
                        <th># of Investors </th>
                        <th>Average Ticket </th>
                        <th></th>
                    </tr>
                    @for ($i = 0; $i < count($project); $i++) @php $a=$i; $a++; @endphp 
                    <tr>
                        <td>{{$a}}</td>
                        <td>{{ucwords($project[$i]->plat_form)}}</td>
                        <td>{{ucwords($project[$i]->project_name)}}</td>
                        <td>{{ucwords($project[$i]->goal)}} </td>
                        <td>{{$project[$i]->duration_month}} </td>
                        <td>{{$project[$i]->interest}} %</td>
                        <td>{{$project[$i]->ltv}} %</td>
                        <td>{{$project[$i]->raised_to_date}} EUR</td>
                        <td>
                            <div class="progress-bar">
                                <span class="progress-bar-fill" style="width: {{$project[$i]->funding_progress}}%;" data-width="{{$project[$i]->funding_progress}}"></span>
                            </div>
                        </td>
                        <td>{{$project[$i]->investors}} </td>
                        <td>{{$project[$i]->average_ticket}} EUR</td>
                        <td><a href="{{$project[$i]->url}}" class="btn btn-primary --small">Invest</a></td>
                    </tr>
                    @endfor
                </table>
            </div>
        </div>
    </div>
</section>

@endsection('contentWebsite')
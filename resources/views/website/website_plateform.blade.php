@extends('layouts.main_website')

@section('contentWebsite')

<section class="clearfix relative-block hero-banner inside-banner ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="subtitle fc-black fw-semi-bold fs-medium tt-uppercase">Real Estate</p>
                <h1 class="title">Crowdfunding Platform</h1>
            </div>
        </div>
    </div>
</section>
<!-- CrowdFunding Platform  -->
<section class="sec-padding ">
    <div class="container">

        <div class="row">
            <div class="col-md-12 table-row">
                <table>
                    <tr>
                        <th>#</th>
                        <th>Platform</th>
                        <th>Capital raised to date</th>
                        <th>Avg interest rate</th>
                        <th># of projects funded</th>
                        <th># of projects not funded</th>
                        <th># of open projects</th>
                        <th># of Investors</th>
                        <th>Avg. ticket size</th>
                        <th>Raised in the past 30 days</th>
                        <th>Raised This Week</th>
                        <th> </th>
                    </tr>
                    @for ($i = 0; $i < count($platForm); $i++) @php $a=$i; $a++; @endphp 

                    <tr>
                        <td>{{$a}}</td>
                        <td>{{ucwords($platForm[$i]->plat_form)}}</td>
                        <td>{{ucwords($platForm[$i]->capital_raised_to_date)}} </td>
                        <td>{{ucwords($platForm[$i]->avg_interest_rate)}}</td>
                        <td>{{$platForm[$i]->no_of_project_funded}}</td>
                        <td>{{$platForm[$i]->no_of_project_not_funded}}</td>
                        <td>{{$platForm[$i]->no_of_project_open}}</td>
                        <td>{{$platForm[$i]->no_of_investors}}</td>
                        <td>{{$platForm[$i]->avg_ticket_size}} EUR</td>
                        <td>{{$platForm[$i]->raised_in_past_30_days}} EUR</td>
                        <td>{{$platForm[$i]->raised_in_past_7_days}} EUR</td>
                        <td><a href="" class="btn btn-primary --small">Register</a></td>
                    </tr>
                    @endfor


                </table>
            </div>
        </div>
    </div>
</section>
<!-- 6 Platforms -->
<section class="sec-padding bg-silver">
    <div class="container">
        <div class="row">
            @for ($i = 0; $i < count($platForm); $i++)
            <div class="col-md-4">
                <a href="crowdfunding-platform-single.php">
                    <div class="box cf-logo matchheight">
                        <div class="logo">
                            @if($platForm[$i]->plat_form_image == '')
                            <a href="{{route('crowdfunding-platform-single',$platForm[$i]->id)}}"><img src="{{ asset('theme/website-assets/images/favicon.png')}}" alt=""></a>
                            @else
                            <a href="{{route('crowdfunding-platform-single',$platForm[$i]->id)}}"><img src="{{ asset($platForm[$i]->plat_form_image)}}" alt=""></a>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endfor

           
        </div>
    </div>
</section>

@endsection('contentWebsite')
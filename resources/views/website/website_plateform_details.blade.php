@extends('layouts.main_website')

@section('contentWebsite')
<style>
    .box.cf-logo .logo img {
        aspect-ratio: 1/1;
        height: 115px;
        width: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
</style>
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
<section class="sec-padding ptpx-40 pbpx-10">
    <div class="container">
        <div class="row align-center justify-center mbpx-40">
            <div class="col-md-4 offset-md-4">
                <div class="box cf-logo matchheight">
                    <div class="logo">
                        @if($platForm[0]->plat_form_image == '')
                        <img src="{{ asset('theme/website-assets/images/favicon.png')}}" alt="">
                        @else
                        <img src="{{ asset($platForm[0]->plat_form_image)}}" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
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
                        <th style="width: 116px;">Raised This Week</th>
                        <th> </th>
                    </tr>
                    @for ($i = 0; $i < count($platForm); $i++) @php $a=$i; $a++; @endphp 

                    <tr>
                        <td>{{$a}}</td>
                        <td>{{ucwords($platForm[$i]->plat_form)}}</td>
                        <td>{{number_format($platForm[$i]->capital_raised_to_date)}} EUR</td>
                        <td>{{number_format($platForm[$i]->avg_interest_rate)}}%</td>
                        <td>{{number_format($platForm[$i]->no_of_project_funded)}}</td>
                        <td>{{number_format($platForm[$i]->no_of_project_not_funded)}}</td>
                        <td>{{number_format($platForm[$i]->no_of_project_open)}}</td>
                        <td>{{number_format($platForm[$i]->no_of_investors)}}</td>
                        <td>{{number_format($platForm[$i]->avg_ticket_size)}} EUR</td>
                        <td>{{number_format($platForm[$i]->raised_in_past_30_days)}} EUR</td>
                        <td>{{number_format($platForm[$i]->raised_in_past_7_days)}} EUR</td>
                        <td><a href="{{$platForm[$i]->url}}" target="_bank" class="btn btn-primary --small">Register</a></td>
                    </tr>
                    @endfor

                </table>
            </div>
        </div>
    </div>
</section>

<section class="sec-padding content-simple ptpx-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @php echo html_entity_decode($platForm[0]->description) @endphp
            </div>
        </div>
    </div>
</section>


@endsection('contentWebsite')
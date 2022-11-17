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
                <table>
                    <tr>
                        <th>#</th>
                        <th>Platform</th>
                        <th>Capital raised to date, EUR</th>
                        <th>Avg interest rate</th>
                        <th># of projects funded</th>
                        <th># of projects not funded</th>
                        <th># of open projects</th>
                        <th># of Investors</th>
                        <th>Avg. ticket size, EUR</th>
                        <th>Raised in the past 30 days, EUR</th>
                        <th style="width: 116px;">Raised This Week, EUR</th>
                        <th> </th>
                    </tr>
                    @for ($i = 0; $i < count($platForm); $i++) @php $a=$i; $a++; @endphp 

                    <tr>
                        <td>{{$a}}</td>
                        <td>{{ucwords($platForm[$i]->plat_form)}}</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->capital_raised_to_date)}} </td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->avg_interest_rate)}}%</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->no_of_project_funded)}}</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->no_of_project_not_funded)}}</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->no_of_project_open)}}</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->no_of_investors)}}</td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->avg_ticket_size)}} </td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->raised_in_past_30_days)}} </td>
                        <td style="text-align: right;">{{number_format($platForm[$i]->raised_in_past_7_days)}} </td>
                        <td><a href="{{$platForm[$i]->url}}" target="_bank" class="btn btn-primary --small">Register</a></td>
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
</section>

@endsection('contentWebsite')
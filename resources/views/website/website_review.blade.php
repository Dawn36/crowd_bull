@extends('layouts.main_website')

@section('contentWebsite')

<section class="clearfix relative-block hero-banner inside-banner ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="subtitle fc-black fw-semi-bold fs-medium tt-uppercase">GET UPDATE WITH US</p>
                <h1 class="title">RECENT REVIEWS</h1>
            </div>
        </div>
    </div>
</section>

<section class="sec-padding ptpx-10">
    <div class="container">
        <div class="row">
            @for ($i = 0; $i < count($review); $i++)
            <div class="col-md-6 col-lg-4 col-sm-12 col-xs-12">
                <div class="box blog" style="height: 590px;">
                    <div class="img_node">
                        <img src="{{ asset($review[$i]->review_thumbnail)}}" alt="">
                    </div>
                    <div class="content_node">
                        <p class="subtitle">
                            Review
                        </p>
                        <h5 class="fc-black title matchheight">
                            <a href="{{route('review',$review[$i]->slug)}}" > {{substr(ucwords($review[$i]->review_name),0,60)}}</a>
                        </h5>
                        <p>
                            @php echo html_entity_decode(substr($review[$i]->description, 0, 200)) @endphp
                            <a href="{{route('review',$review[$i]->slug)}}" class="subtitle">Read More</a>
                        </p>
                        <div class="profile">
                            <div class="profile-img">
                                <img src="{{ asset('theme/website-assets/images/profile.jpg')}}" alt="">
                            </div>
                            <div class="profile-content">
                                <h6 class="name">{{ucwords($review[$i]->first_name)}} {{ucwords($review[$i]->last_name)}}</h6>
                                <p class="date">
                                    {{DATE("F j, Y",strtotime($review[$i]->review_created_at))}}
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


@endsection('contentWebsite')
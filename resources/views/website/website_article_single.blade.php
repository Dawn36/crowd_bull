@extends('layouts.main_website')

@section('contentWebsite')

<section class="sec-padding content-simple ptpx-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="fc-primary">{{ucwords($blogDetails[0]->blog_name)}}</h3>
                <p class="fw-semi-bold">Crowestate Platform, Posted On : {{DATE("F j, Y",strtotime($blogDetails[0]->blog_created_at))}}</p>

                <div class="img-node mbpx-10 pbpx-20">
                    <img src="{{ asset($blogDetails[0]->blog_thumbnail)}}" alt="">
                </div>
                @php echo html_entity_decode($blogDetails[0]->description) @endphp
                <div class="profile">
                    <div class="profile-img">
                        <img src="{{ asset('theme/website-assets/images/profile.jpg')}}" alt="">
                    </div>
                    <div class="profile-content">
                        <h6 class="name">{{ucwords($blogDetails[0]->first_name)}} {{ucwords($blogDetails[0]->last_name)}}</h6>
                        <p class="date">
                            {{DATE("F j, Y",strtotime($blogDetails[0]->blog_created_at))}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="sec-padding ptpx-10">
    <div class="container">
        <div class="row tnstr">
            <div class="col-md-12 mbpx-10">
                <h3 class="fc-black fw-bold ">Related Posts</h3>
            </div>
        </div>
        <div class="row">
            @for ($i = 0; $i < count($blog); $i++)
            <div class="col-md-6 col-lg-4 col-sm-12 col-xs-12">
                <div class="box blog" style="height: 541px;">
                    <div class="img_node">
                        <img src="{{ asset($blog[$i]->blog_thumbnail)}}" alt="">
                    </div>
                    <div class="content_node">
                        <p class="subtitle">
                            Guides
                        </p>
                        <h5 class="fc-black title matchheight">
                            <a href="{{route('article-single',$blog[$i]->blog_id)}}" > {{ucwords($blog[$i]->blog_name)}}</a>
                        </h5>
                        <p>
                            {{substr(ucfirst(strip_tags($blog[$i]->description)), 0, 200).'...'}}
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

<!-- leave a reply  -->

<section class="sec-padding ptpx-10">
    <div class="container">
        <div class="row tnstr">
            <div class="col-md-12 mbpx-10">

                <h3 class="fc-black fw-bold ">Leave a Reply</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10  col-lg-8 col-sm-12 col-xs-12">
                <div class="box commenttbox">
                    <p class="mbpx-10">
                        your email address will be published. required fields are marked.
                    </p>
                    <form action="" class="row">

                        <div class="form-control col-md-12">
                            <label for="">Comment<sup>*</sup></label>
                            <textarea name="" id="" cols="30" rows="10" placeholder=""></textarea>
                        </div>
                        <div class="form-control col-md-4">
                            <label for="">Name<sup>*</sup></label>
                            <input type="text">
                        </div>
                        <div class="form-control col-md-4">
                            <label for="">Email<sup>*</sup></label>
                            <input type="email" name="" id="">
                        </div>
                        <div class="form-control col-md-4">
                            <label for="">Website</label>
                            <input type="text">
                        </div>
                        <div class="form-control col-md-12">
                            <label for="">Save my Name Email Website in this browser for the next time i comment.
                                <input type="checkbox" name="" id="">
                            </label>
                        </div>
                        <div class="form-control col-md-12">

                            <input type="submit" value="Post Comment">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection('contentWebsite')
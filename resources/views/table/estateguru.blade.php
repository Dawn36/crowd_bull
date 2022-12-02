@extends('layouts.main')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <div class="col-xl-12 mb-5 mb-xl-10">
                    <!--begin::Card-->
                    <div class="card card-docs mb-2">
                        <div class="p-10">
                            <!--begin::Heading-->
                            <h1 class="anchor fw-bolder mb-5" id="zero-configuration">
                                <a href="javascript:;"></a>Estateguru Listing
                            </h1>
                            <!--begin::Notice-->
                            <div class="d-flex align-items-center rounded py-5 px-4 bg-light-primary">
                                <!--begin::Icon-->
                                <div class="d-flex h-80px w-80px flex-shrink-0 flex-center position-relative ms-3 me-6">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs051.svg-->
                                    <span class="svg-icon svg-icon-primary position-absolute opacity-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="70px" height="70px" viewBox="0 0 70 70" fill="none" class="w-80px h-80px">
                                            <path d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z" fill="#000000" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/art/art006.svg-->
                                    <span class="svg-icon svg-icon-3x svg-icon-primary position-absolute">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z" fill="currentColor"/>
                                            <path d="M7 16H6C5.4 16 5 15.6 5 15V13H8V15C8 15.6 7.6 16 7 16Z" fill="currentColor"/>
                                            <path opacity="0.3" d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z" fill="currentColor"/>
                                            <path d="M18 16H17C16.4 16 16 15.6 16 15V13H19V15C19 15.6 18.6 16 18 16Z" fill="currentColor"/>
                                            <path opacity="0.3" d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z" fill="currentColor"/>
                                            <path d="M7 5H6C5.4 5 5 4.6 5 4V2H8V4C8 4.6 7.6 5 7 5Z" fill="currentColor"/>
                                            <path opacity="0.3" d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z" fill="currentColor"/>
                                            <path d="M18 5H17C16.4 5 16 4.6 16 4V2H19V4C19 4.6 18.6 5 18 5Z" fill="currentColor"/>
                                            </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Icon-->
                                <!--begin::Description-->
                                <div class="text-gray-700 fw-bold fs-6 lh-lg">Here we have a list of all of the Projects that we have.</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Notice-->
                            <!--end::Heading-->
                        </div>
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input type="text" id="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--begin::Card title-->
                            <!--begin::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card Body-->
                        <div class="card-body fs-6 py-lg-5 text-gray-700">

                            <!--begin::Block-->
                            <div class="py-5">
                                <table class="kt_datatable_example_1 table table-row-bordered gy-5">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-muted">
                                            <th class="min-w-30px">ID</th>
                                            <th>Project_Name</th>
                                            <th>Goal</th>
                                            <th>Loan_Duration</th>
                                            <th>Interest</th>
                                            <th>LTV</th>
                                            <th>Link_To_Project</th>
                                            <th>Raised_To_Date</th>
                                            <th>Funding_Progress</th>
                                            <th>Number_Of_Investors</th>
                                            <th>Remaining_To_Raise</th>
                                            <th>Loan_Type</th>
                                            <th>Comment</th>
                                            <th>Date_Time_Rounded</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">
                                        @for ($i = 0; $i < count($project); $i++) @php $a=$i; $a++; @endphp 
                                        <tr>
                                           <td>{{$project[$i]->id}}</td> 
                                           <td>{{$project[$i]->Project_Name}}</td> 
                                           <td>{{$project[$i]->Goal}}</td> 
                                           <td>{{$project[$i]->Loan_Duration}}</td> 
                                           <td>{{$project[$i]->Interest}}</td> 
                                           <td>{{$project[$i]->LTV}}</td> 
                                           <td>{{$project[$i]->Link_To_Project}}</td> 
                                           <td>{{$project[$i]->Raised_To_Date}}</td> 
                                           <td>{{$project[$i]->Funding_Progress}}</td> 
                                           <td>{{$project[$i]->Number_Of_Investors}}</td> 
                                           <td>{{$project[$i]->Remaining_To_Raise}}</td> 
                                           <td>{{$project[$i]->Loan_Type}}</td> 
                                           <td>{{$project[$i]->Comment}}</td> 
                                           <td>{{Date('Y-m-d h:i:s',strtotime($project[$i]->Date_Time_Rounded))}}</td> 
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end::Card Body-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

@endsection('content')
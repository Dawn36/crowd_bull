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
                            <a href="{{ route('crowdfunding-projects') }}"> 
                                <li class="">All</li></a>
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
                    {{-- @php 
                        $a=$project->currentPage() == '1' ? '0' : $project->perPage()*($project->currentPage()-1);
                       @endphp --}}
                <tbody>
                    {{-- @for ($i = 0; $i < count($project); $i++) @php  $a++; @endphp
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
                    @endfor --}}
                </tbody>

                </table>
                
            </div>
            <div class="col-md-12 mtpx-30">
                {{-- {{ $project->links('website.website_paginating_ui') }} --}}
              </div>
        </div>
    </div>
</section>
{{-- <script>
    topaaaa = localStorage.getItem("sidebar-scroll");
   if (topaaaa !== null) {
     window.scrollTo(0, topaaaa);
     localStorage.clear();
   }
   
   function myFunction() {
       localStorage.setItem("sidebar-scroll",$(document).scrollTop());
   }
   
       </script> --}}
       <script type="text/javascript">

        $(document).ready(function(){
        // Initialize
        dt =  $('#project').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            info: false,
            fixedHeader : {
            header : false,
        },
            // order: [[0, 'desc']],
            // ajax: "{{ route('get_project_home') }}",
            ajax: {
                  url: "{{ route('get_project_page') }}",
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
                { data: '',name: '',searchable: false},
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
                                <td >${new Intl.NumberFormat().format(row.raised_to_date)} %</td>
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
                                <td >${new Intl.NumberFormat().format(row.investors)} </td>
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
                                <td >${new Intl.NumberFormat().format(row.average_ticket)} </td>
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
                                <td >${new Intl.NumberFormat().format(row.funding_pace)} </td>
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
                obj.classList.remove('active');
                obj.parentElement.children[0].value='';
            }
            dt.draw();
        }
        
            </script>
@endsection('contentWebsite')
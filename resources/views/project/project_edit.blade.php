<form id="" class="form" method="POST" action="{{ route('projects.update',$project->id) }}" enctype="multipart/form-data">
    @method("PUT")
    @csrf
    <!--begin::Scroll-->
    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Platform</label>
            <input type="text" name="platform_name" value="{{$project->plat_form}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Platform here." required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Project Name</label>
            <input type="text" name="project_name" value="{{$project->project_name}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Project Name here." required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Goal</label>
            <input type="number" name="goal" value="{{$project->goal}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Goal here." required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Duration, months</label>
            <input type="text" name="duration_months" value="{{$project->duration_month}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Duration, months here." required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Interest</label>
            <input type="number" name="interest" value="{{$project->interest}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Interest here." required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">LTV</label>
            <input type="number" name="ltv" value="{{$project->ltv}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your LTV here." required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Raised to date</label>
            <input type="number" name="raised_to_date" value="{{$project->raised_to_date}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Raised to date here." required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Funding progress</label>
            <input type="number" name="funding_progress" value="{{$project->funding_progress}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Funding progress here." required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2"># of Investors</label>
            <input type="number" name="investors" value="{{$project->investors}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your # of Investors here." required/>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Average Ticket</label>
            <input type="number" name="avg_ticket" value="{{$project->average_ticket}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Average Ticket here."required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Funding Pace</label>
            <input type="text" name="funding_pace" value="{{$project->funding_pace}}"  class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Funding Pace here."required />
        </div>
       
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">URL</label>
            <input type="text" name="url" value="{{$project->url}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter url here."required />
        </div>
      
        
        <div class="fv-row mb-7">
            <label class="form-label">Status</label>
            <select class="form-select mb-2" name="status" class="form-control form-control-solid mb-3 mb-lg-0" required>
                <option value="in process"  {{$project->funding_status== 'in process' ? 'Selected' : ''}}>In Process</option>
                <option value="funded" {{$project->funding_status== 'funded' ? 'Selected' : ''}}>Funded</option>
                <option value="not funded" {{$project->funding_status== 'not funded' ? 'Selected' : ''}}>Not Funded</option>
            </select>
        </div>
    </div>
    <!--end::Scroll-->
    <!--begin::Actions-->
    <div class="text-center pt-15">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
    <!--end::Actions-->
</form>
<script>
    // $("#kt_datatable_example_1").DataTable();
    $(document).ready(function() {
       
        var quill = new Quill('.kt_docs_quill_basic', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                ]
            },
            placeholder: 'Type your text here...',
            theme: 'snow' // or 'bubble'
        });
       
        quill.on('text-change', function() {
        document.getElementById("body").value = quill.root.innerHTML;

        
    });

       
    var value1 = document.getElementById("body").value;
    var delta1 = quill.clipboard.convert(value1);

    quill.setContents(delta1, 'silent');
    });
</script>
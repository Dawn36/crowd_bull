</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Root-->

<!--end::Drawers-->
<!--end::Main-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">

    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
            <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
        </svg>
    </span>
    <!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->
<!--begin::Javascript-->

<script>
    var hostUrl = "assets/";
</script>

<script src="{{ asset('theme/assets/js/scripts.bundle.js')}}"></script>
<script src="{{ asset('theme/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('theme/assets/js/widgets.bundle.js')}}"></script>
<script src="{{ asset('theme/assets/js/custom/widgets.js')}}"></script>
<script src="{{ asset('theme/assets/js/custom/signin-methods.js')}}"></script> 

<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('theme/assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{ asset('theme/assets/js/custom/documentation/documentation.js')}}"></script>
<script src="{{ asset('theme/assets/js/custom/documentation/search.js')}}"></script>
<script src="{{ asset('theme/assets/js/custom/select2.js')}}"></script>
<script src="{{ asset('theme/assets/js/custom/documentation/editors/quill/basic.js')}}"></script>
<!--end::Page Custom Javascript-->
<script src="{{ asset('theme/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
<script src="{{ asset('theme/assets/plugins/custom/ckeditor/ckeditor-inline.bundle.js')}}"></script>
<script src="{{ asset('theme/assets/plugins/custom/ckeditor/ckeditor-balloon.bundle.js')}}"></script>
<script src="{{ asset('theme/assets/plugins/custom/ckeditor/ckeditor-balloon-block.bundle.js')}}"></script>
<script src="{{ asset('theme/assets/plugins/custom/ckeditor/ckeditor-document.bundle.js')}}"></script>
<script>
    // $("#kt_datatable_example_1").DataTable();
    $(document).ready(function() {
        // Datatables
        var table = $('.kt_datatable_example_1').DataTable({
            "scrollY": "500px",
        });
        $('#search').on('keyup', function() {
            table.search(this.value).draw();
        });

        
        var quill = new Quill('.kt_docs_quill_basic1', {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            placeholder: 'Type your text here...',
            theme: 'snow' // or 'bubble'
        });

        // Date and Time Picker
        // -- Date Picker
        $(".kt_datepicker_2").flatpickr();

        // -- Date & Time Picker
        $(".kt_datepicker_3").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        // -- Time Picker
        $(".kt_datepicker_8").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });

        // Select2
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        ClassicEditor
    .create(document.querySelector('#kt_docs_ckeditor_classic'))
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });
       
    });
    function addBlog() {

$.ajax({
    type: 'GET',
    url: "{{ route('blogs.create') }}",
    success: function(result) {
        $('#myModalXlHeading').html('Add Blog');
        $('#modalBodyXl').html(result);
        $('#myModalXl').modal('show');
    }
});
}
function addReview() {

$.ajax({
    type: 'GET',
    url: "{{ route('re-view.create') }}",
    success: function(result) {
        $('#myModalXlHeading').html('Add Review');
        $('#modalBodyXl').html(result);
        $('#myModalXl').modal('show');
    }
});
}
</script>
<!--end::Javascript-->
</body>
<!--end::Body-->

</html>
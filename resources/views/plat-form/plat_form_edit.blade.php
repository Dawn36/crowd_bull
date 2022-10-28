<form id="" class="form" method="POST" action="{{ route('plat_form.update',$platForm->id) }}" enctype="multipart/form-data">
    @method("PUT")
    @csrf
    <!--begin::Scroll-->
    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
        <div class="fv-row mb-7">
            <label class="d-block fw-bold fs-6 mb-5">Platform Image</label>
            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{ asset($platForm->plat_form_image)}}')">
                <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset($platForm->plat_form_image)}}');">
                </div>
                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                </label>
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                    <i class="bi bi-x fs-2"></i>
                </span>
                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                    <i class="bi bi-x fs-2"></i>
                </span>
            </div>
            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Platform</label>
            <input type="text" name="plat_form" value="{{$platForm->plat_form}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Platform here." required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Capital raised to date</label>
            <input type="text" name="capital_raised_to_date" value="{{$platForm->capital_raised_to_date}}"  class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Capital raised to date here." required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Avg Interest Rate</label>
            <input type="text" name="avg_interest_rate" value="{{$platForm->avg_interest_rate}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Avg Interest Rate here." required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2"># of projects funded</label>
            <input type="text" name="no_of_project_funded" value="{{$platForm->no_of_project_funded}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your # of projects funded here." required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2"># of projects not funded</label>
            <input type="text" name="no_of_project_not_funded" value="{{$platForm->no_of_project_not_funded}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your # of projects not funded here." required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2"># of open projects</label>
            <input type="text" name="no_of_project_open" value="{{$platForm->no_of_project_open}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your # of projects here." required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2"># of Investors</label>
            <input type="text" name="no_of_investors" value="{{$platForm->plat_form}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your # of Investors here." required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Avg. ticket size</label>
            <input type="text" name="avg_ticket_size" value="{{$platForm->avg_ticket_size}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Avg. ticket size here." required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Raised in the past 30 days</label>
            <input type="text" name="raised_in_past_30_days" value="{{$platForm->raised_in_past_30_days}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Raised in the past 30 days here." required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">Raised This Week</label>
            <input type="text" name="raised_in_past_7_days" value="{{$platForm->raised_in_past_7_days}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter your Raised This Week here." required />
        </div>
        <div class="fv-row mb-7">
            <label class="required fw-bold fs-6 mb-2">URL</label>
            <input type="text" name="url" value="{{$platForm->url}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Please Enter url here."required />
        </div>
        <div>
            <label class="form-label">Description</label>
            <textarea hidden  name="description" id='description'>{{$platForm->description}}</textarea>
            <div name="kt_ecommerce_add_product_description" id="kt_docs_quill_basic1" class="min-h-200px mb-2 kt_docs_quill_basic1"></div>
            <div class="text-muted fs-7">Set a description to the Blog for better visibility.</div>
        </div>
    </div>
    <!--end::Scroll-->
    <!--begin::Actions-->
    <div class="text-center pt-15">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Discard</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <!--end::Actions-->
</form>
<script>
    var toolbarOptions = [
       ['bold', 'italic', 'underline', 'strike'],
               ['image', 'code-block'],
               [ 'link', 'image' ],  
               ['blockquote', 'code-block'],

               [{ 'list': 'ordered'}, { 'list': 'bullet' }],
               [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
               [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
               [{ 'direction': 'rtl' }],                         // text direction

               [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
               [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

               [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
               [{ 'font': [] }],
               [{ 'align': [] }],

               ['clean']                                         // remove formatting button        // add's image support

           ];

     var quill = new Quill('.kt_docs_quill_basic1', {
           modules: {
               toolbar: toolbarOptions
           },
           placeholder: 'Type your text here...',
           theme: 'snow' // or 'bubble'
       });

   quill.on('text-change', function() {
       document.getElementById("description").value = quill.root.innerHTML;
   });
   var value1 = document.getElementById("description").value;
   var delta1 = quill.clipboard.convert(value1);

   quill.setContents(delta1, 'silent');

   $(document).ready(function() {
         
  
   
       var KTImageInput = function(e, t) {
       var n = this;
       if (null != e) {
           var i = {},
               r = function() {
                   (n.options = KTUtil.deepExtend({}, i, t)),
                   (n.uid = KTUtil.getUniqueId("image-input")),
                   (n.element = e),
                   (n.inputElement = KTUtil.find(e, 'input[type="file"]')),
                   (n.wrapperElement = KTUtil.find(e, ".image-input-wrapper")),
                   (n.cancelElement = KTUtil.find(
                       e,
                       '[data-kt-image-input-action="cancel"]'
                   )),
                   (n.removeElement = KTUtil.find(
                       e,
                       '[data-kt-image-input-action="remove"]'
                   )),
                   (n.hiddenElement = KTUtil.find(e, 'input[type="hidden"]')),
                   (n.src = KTUtil.css(n.wrapperElement, "backgroundImage")),
                   n.element.setAttribute("data-kt-image-input", "true"),
                       o(),
                       KTUtil.data(n.element).set("image-input", n);
               },
               o = function() {
                   KTUtil.addEvent(n.inputElement, "change", a),
                       KTUtil.addEvent(n.cancelElement, "click", l),
                       KTUtil.addEvent(n.removeElement, "click", s);
               },
               a = function(e) {
                   if (
                       (e.preventDefault(),
                           null !== n.inputElement &&
                           n.inputElement.files &&
                           n.inputElement.files[0])
                   ) {
                       if (
                           !1 ===
                           KTEventHandler.trigger(
                               n.element,
                               "kt.imageinput.change",
                               n
                           )
                       )
                           return;
                       var t = new FileReader();
                       (t.onload = function(e) {
                           KTUtil.css(
                               n.wrapperElement,
                               "background-image",
                               "url(" + e.target.result + ")"
                           );
                       }),
                       t.readAsDataURL(n.inputElement.files[0]),
                           n.element.classList.add("image-input-changed"),
                           n.element.classList.remove("image-input-empty"),
                           KTEventHandler.trigger(
                               n.element,
                               "kt.imageinput.changed",
                               n
                           );
                   }
               },
               l = function(e) {
                   e.preventDefault(),
                       !1 !==
                       KTEventHandler.trigger(
                           n.element,
                           "kt.imageinput.cancel",
                           n
                       ) &&
                       (n.element.classList.remove("image-input-changed"),
                           n.element.classList.remove("image-input-empty"),
                           "none" === n.src ?
                           (KTUtil.css(
                                   n.wrapperElement,
                                   "background-image",
                                   ""
                               ),
                               n.element.classList.add("image-input-empty")) :
                           KTUtil.css(
                               n.wrapperElement,
                               "background-image",
                               n.src
                           ),
                           (n.inputElement.value = ""),
                           null !== n.hiddenElement &&
                           (n.hiddenElement.value = "0"),
                           KTEventHandler.trigger(
                               n.element,
                               "kt.imageinput.canceled",
                               n
                           ));
               },
               s = function(e) {
                   e.preventDefault(),
                       !1 !==
                       KTEventHandler.trigger(
                           n.element,
                           "kt.imageinput.remove",
                           n
                       ) &&
                       (n.element.classList.remove("image-input-changed"),
                           n.element.classList.add("image-input-empty"),
                           KTUtil.css(
                               n.wrapperElement,
                               "background-image",
                               "none"
                           ),
                           (n.inputElement.value = ""),
                           null !== n.hiddenElement &&
                           (n.hiddenElement.value = "1"),
                           KTEventHandler.trigger(
                               n.element,
                               "kt.imageinput.removed",
                               n
                           ));
               };
           !0 === KTUtil.data(e).has("image-input") ?
               (n = KTUtil.data(e).get("image-input")) :
               r(),
               (n.getInputElement = function() {
                   return n.inputElement;
               }),
               (n.goElement = function() {
                   return n.element;
               }),
               (n.destroy = function() {
                   KTUtil.data(n.element).remove("image-input");
               }),
               (n.on = function(e, t) {
                   return KTEventHandler.on(n.element, e, t);
               }),
               (n.one = function(e, t) {
                   return KTEventHandler.one(n.element, e, t);
               }),
               (n.off = function(e) {
                   return KTEventHandler.off(n.element, e);
               }),
               (n.trigger = function(e, t) {
                   return KTEventHandler.trigger(n.element, e, t, n, t);
               });
       }
   };
   (KTImageInput.getInstance = function(e) {
       return null !== e && KTUtil.data(e).has("image-input") ?
           KTUtil.data(e).get("image-input") :
           null;
   }),
   (KTImageInput.createInstances = function(e = "[data-kt-image-input]") {
       var t = document.querySelectorAll(e);
       if (t && t.length > 0)
           for (var n = 0, i = t.length; n < i; n++) new KTImageInput(t[n]);
   }),
   (KTImageInput.init = function() {
       KTImageInput.createInstances();
   }),
   "loading" === document.readyState ?
       document.addEventListener("DOMContentLoaded", KTImageInput.init) :
       KTImageInput.init(),
       "undefined" != typeof module &&
       void 0 !== module.exports &&
       (module.exports = KTImageInput);
   document.getElementsByClassName('ql-image')[0].parentElement.remove();

   });



 
</script>
 {{-- jquery --}}
 {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

{{-- MomentJS --}}
<script src="{{ asset('js/moment-with-locales.js') }}"></script>
<script src="{{ asset('js/moment-timezone-with-data.min.js') }}"></script>

{{-- Popper --}}
<script src="{{ asset('vendor/popper.js-1.15.0/dist/umd/popper.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> --}}

{{-- Bootstrap 4.3.1 --}}
<script src="{{ asset('vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js') }}"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}

{{-- FontAwesome 5.9 --}}
<script src="{{ asset('vendor/fontawesome-free-5.9.0-web/js/all.min.js') }}"></script>

{{-- CKEditor --}}
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
{{-- <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script> --}}

{{-- DateRangePicker --}}
<script src="{{ asset('vendor/daterangepicker-master/daterangepicker.js') }}"></script>
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}

{{-- select2 --}}
<script src="{{ asset('vendor/select2-4.0.9/dist/js/select2.full.min.js') }}"></script>

{{-- datatables --}}
{{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script> --}}

{{-- WebcamJS --}}
<script src="{{ asset('vendor/webcamjs-master/webcam.min.js') }}"></script>

{{-- app.js --}}
<script src="{{ asset('js/app.js') }}"></script>

{{-- <script>
	$(document).ready(function() {
		CKEDITOR.replaceClass  = 'ckeditor';
		CKEDITOR.config.height = '9rem';
	}); 
</script> --}}

{{-- CKEDITOR.replace('description'); --}}

{{-- $(".select2-classification").select2({
	placeholder: "Classification",
	allowClear: true,
	sortResults: data => data.sort((a, b) => a.text.localeCompare(b.text)),
}); --}}

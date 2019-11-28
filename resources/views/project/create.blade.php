@extends('layouts.app')

@section('styles')
<style>
	.project-image__btn-container{
		position: absolute;
		z-index: 2;
		bottom: 0;
		left: 0;
		right: 0;
		height: 50px;
		display: none;
		justify-content: center;
		flex-direction: column;
		align-items: center;
		background-color: rgba(119, 119, 119, 0.7);
	}

	.fa-plus-circle{
		font-size: 2.5rem;
		color: #fff;
	}

	.project-image{
		position: relative;
		height: 200px;
		border: 4px solid rgba(0, 0, 0, 0.07);
	}

	.project-image-container{
		position: relative;
		height: 100%;
		transition: all 0.15s ease 0s;
	}

	.v-datepicker{
		width: 100%;
		height: calc(1.6em + 0.75rem + 2px);
		padding: 0.375rem 0.75rem;
	}
</style>
@endsection

@section('content')
<create-project></create-project>
@endsection

@section('scripts')
<script>
	$(function() {
		$('input[name="date_start"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 1901,
			maxYear: parseInt(moment().format('YYYY'),10)
		});
	});

	$(function() {
		$('input[name="date_end"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 1901,
			maxYear: parseInt(moment().format('YYYY'),10)
		});
	});
</script>
{{-- <script>
	function imgContainerHover() {
		document.getElementById('project-image__btn-container').style.display = 'flex';
	},
	function imgContainerRemoveHover() {
		document.getElementById('project-image__btn-container').style.display = 'none';
	},
	function selectFile() {
		event.preventDefault();
		document.getElementById("fileUpload").click()
	},
	function inputImage(e) {
		const file = e.target.files[0];
		this.imageUrl = URL.createObjectURL(file);
	},
	// function customFormatter(date) {
	// 	return moment(date).format('YYYY/MM/DD');
	// }
</script> --}}

<script>
	CKEDITOR.replace('description');
</script>
@endsection
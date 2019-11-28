@extends('layouts.guest_app')
@section('content')
<landing
    :professionals = "{{ json_encode($professionals) }}"
    :contractors = "{{ json_encode($contractors) }}"
    :suppliers = "{{ json_encode($suppliers) }}"
    :featured_projects = "{{ json_encode($featured_projects) }}"
></landing>
@endsection
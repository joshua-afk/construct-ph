@component('mail::message')
# Introduction

Full Name: {{ $data['full_name'] }} <br>
Email: {{ $data['email'] }} <br>
Message: {{ $data['message'] }} <br>

Message: <br>
{{ $data['validation_url'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
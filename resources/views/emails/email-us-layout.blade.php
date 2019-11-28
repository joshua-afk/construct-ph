@component('mail::message')
# Introduction

The body of your message.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Full Name: {{ $data->full_name }} <br>
Email: {{ $data->email }} <br>
Contact Number: {{ $data->contact_number }} <br>
Message: {{ $data->message }} <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
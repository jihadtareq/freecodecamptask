@component('mail::message')
# Welcome To FreeCodeCamp
 
 hey

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

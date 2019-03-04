@component('mail::message')
Quotation request approval.

<div style="text-align:center; margin-bottom:20px;"><a href="{{ $url }}" target="blank" style="background:blue;color:white;text-decoration:none;padding:10px;font-weight:bold;">Quotation Link</a></div>

After review the above quotation has beed approved.You can procceed to the next step.

Regards,<br>
{{ ucwords($name) }},<br/>
{{ config('app.name') }}
@endcomponent

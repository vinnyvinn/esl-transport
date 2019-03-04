@component('mail::message')
Dear Sir/Madam

Quotation Decline notice,

Kindly note that the below quotation has been declined by the client.

<div style="text-align:center; margin-bottom:20px;"><a href="{{ $url }}" target="blank" style="background:blue;color:white;text-decoration:none;padding:10px;font-weight:bold;">Declined Quotation</a></div>

Regards,<br>
{{ ucwords($name) }}, <br/>
{{ config('app.name') }}
@endcomponent

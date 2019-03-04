@component('mail::message')
Dear Sir/Madam

Quotation Approval Request,

Kindly review the client quotation below and approve it for processing.

<div style="text-align:center; margin-bottom:20px;"><a href="{{ $url }}" target="blank" style="background:blue;color:white;text-decoration:none;padding:10px;font-weight:bold;">Accepted Quotation</a></div>

Regards,<br>
{{ ucwords($name) }}, <br/>
{{ config('app.name') }}
@endcomponent

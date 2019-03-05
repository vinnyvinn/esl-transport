@component('mail::message')
Dear {{ ucwords($owner) }}

Quotation Processing Approval,

Kindly note that the below Quotation has been approved for processing. You can therefore initiate the process.

<div style="text-align:center; margin-bottom:20px;"><a href="{{ $url }}" target="blank" style="background:blue;color:white;text-decoration:none;padding:10px;font-weight:bold;">Approved Quotation</a></div>

Regards,<br>
{{ ucwords($name) }}, <br/>
{{ config('app.name') }}
@endcomponent

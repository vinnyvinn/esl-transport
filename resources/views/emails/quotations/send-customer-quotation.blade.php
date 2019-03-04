@component('mail::message')
ESL Transport client quotation 

Dear {{ ucwords($lead) }},

{{ $message }}

Please download and review your quotation from the file attachment.
Accept it in-order for us to start processing your request. If there are any issue you can decline it and we will get in touch with you soon.

<div style="text-align:center; margin:30px 0;">
    <a href="{{ route('client-accept-quotation',['identifier'=>$identifier]) }}" target="blank" style="background:blue;color:white;text-decoration:none;padding:10px;font-weight:bold;">Accept Quotation</a>
    <a href="{{ route('client-decline-quotation',['identifier'=>$identifier]) }}" target="blank" style="background:orange;color:white;text-decoration:none;padding:10px;font-weight:bold;">Decline Quotation</a>
</div>

Regards,<br>
{{ ucwords($name) }},<br/>
{{ config('app.name') }}
@endcomponent 

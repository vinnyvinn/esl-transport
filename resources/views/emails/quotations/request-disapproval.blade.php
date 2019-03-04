@component('mail::message')
Quotation request disaproval.

<div style="text-align:center; margin-bottom:20px;"><a href="{{ $url }}" target="blank" style="background:blue;color:white;text-decoration:none;padding:10px;font-weight:bold;">Quotation Link</a></div>

The quotation above has been disaproved because, {{ $reason }}

Kindly Review it and request for approval again.

Regards,<br>
{{ $name }}
@endcomponent
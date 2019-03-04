@component('mail::message')
Lead quotation approval request

Please review and approve the following lead quotation.

<div style="text-align:center"><a href="{{ $url }}" target="blank" style="background:blue;color:white;text-decoration:none;padding:10px;font-weight:bold;">Quotation Link</a></div>

Thanks,<br>
{{ $name }}
@endcomponent

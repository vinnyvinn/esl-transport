@component('mail::message') 

Dear {{ ucwords($user) }} 

{{ $subject }} 

{{ $message }}

<div style="text-align:center; margin:30px 0;">
    <a href="{{ route('show-quotation',['id'=>$id]) }}" target="blank" style="background:blue;color:white;text-decoration:none;padding:10px;font-weight:bold;">
        @if($accepted == true)
        {{ 'Accepted Quotation' }}
        @else
        {{ 'Declined Quotation' }}
        @endif
        </a>
</div>

Reagrds,<br> {{ ucwords($lead) }} @endcomponent
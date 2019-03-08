@component('mail::message')

Dear {{ ucwords($sendee) }}

Purchase Order Dissaproval.

<div style="text-align:center; margin-bottom:20px;"><a href="{{ $url }}" target="blank" style="background:blue;color:white;text-decoration:none;padding:10px;font-weight:bold;">Purchase Order</a></div>

After review the above purchase order has beed disapproved.

Regards,<br>
{{ ucwords($sender) }},<br/>
{{ config('app.name') }}
@endcomponent


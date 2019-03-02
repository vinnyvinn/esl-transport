@component('mail::message')
Lead quotation approval request

Please review and approve the following lead quotation.

@component('mail::button', ['url' => $url, 'color' => 'primary'])
quotation link
@endcomponent

Thanks,<br>
{{ $name }}
@endcomponent

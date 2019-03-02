<div class="row">
    {{-- logo --}}
    <div class="col-sm-3">
            <img src="{{ asset('images/logo.png') }}" alt="">
    </div>

    {{-- company details --}}
    <div class="col-sm-6">
        <div>Express Shipping & Logistics (EA) Limited</div>
        <div>Cannon Towers </div>
        <div>6th Floor, Moi Avenue Mombasa</div>
        <div>Kenya</div>
        <div>Phone: +254 41 2229784</div>
        <div>Email: agency@esl-eastafrica.com/ops@esl-eastafrica.com</div>
    </div>

    {{-- drafts --}}
    <div class="col-sm-3">
            <div>Tax Registration: 0121303W</div>
            <div>Currency Code: {{ $quotation->lead->currency or \Esl\helpers\Constants::DEFAULT_CURRENCY}}</div>
            <div>Date: {{ \Carbon\Carbon::parse($quotation->created_at)->format('d-M-y') }}</div>
    </div>
    <div>
    </div>
</div>
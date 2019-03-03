@extends('layouts.main')
@section('content')
{{-- heading --}}
<div>@include('includes.dashboard.heading')</div>
{{ $quotations }}
@endsection
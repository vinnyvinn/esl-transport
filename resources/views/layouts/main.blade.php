<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    {{--<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">--}}
    <title>ESL</title>
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/chartist-js/dist/chartist-init.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/colors/blue.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('assets/plugins/wizard/steps.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <style>
        .slect2{
            width: 100% !important;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<body class="fix-header card-no-border logo-center">
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<div id="main-wrapper">
    @include('partials.header')
    @include('partials.nav-bar')
    <div class="page-wrapper">

        @yield('content')

        <footer class="footer"> © {{ Date('Y') }} ESL</footer>
    </div>
</div>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('js/waves.js') }}"></script>
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('assets/plugins/skycons/skycons.js') }}"></script>
<script src="{{ asset('assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/wizard/jquery.steps.min.js') }}"></script>
<script src="{{ asset('assets/plugins/wizard/steps.js') }}"></script>
<script src="{{ asset('assets/plugins/wizard/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script src="{{ asset('js/sweetalert.js') }}"></script>
{{--<script src="{{ asset('js/datepicker.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
@include('sweet::alert')
<script>

    $(document).ready(function(){
        $('.dataTable').dataTable();
        var date_input=$('.datepicker'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
        $('.select2').select2();

    })


    function submitForm(form, formUrl, redirectUrl = 'current'){
        return alert(form);
        var formId = form.id;
        var vessel = $('#'+formId);

        var data = vessel.serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});

        axios.post('{{ url('/') }}' + formUrl, data)
            .then(function (response) {
                var details = response.data.success;

                console.log(details);
                if (redirectUrl === 'current'){
                    window.location.reload();
                }
                else {
                    window.location.href = details.redirect;
                }

            })
            .catch(function (response) {
                console.log(response.data);
            });

    }

    function deleteItem(id, deleteUrl) {
        axios.post('{{ url('/') }}' + deleteUrl, {
            'item_id' : id,
            '_token' : '{{ csrf_token() }}'
        })
            .then(function (response) {
                window.location.reload();
            })
            .catch(function (response) {
                console.log(response);
            });
    }
</script>
@yield('scripts')
</body>

</html>

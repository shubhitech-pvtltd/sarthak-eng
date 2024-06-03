<!DOCTYPE html>
<html>
<head>

<!-- Basic Page Info -->
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Sarthak Engineering</title>

<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<!-- Add Bootstrap v5.3.1 CSS -->
<link rel="stylesheet" href="{{url('css/bootstrap.css')}}">

<!-- CSS -->
<link rel="stylesheet" href="{{url('css/style.css')}}">

<!-- Add Font Awesome -->   
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- Toaster Css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

{{-- Datatable CSS --}}
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables/css/responsive.dataTables.css') }}">

<!-- js -->
<script src="{{ asset('js/jquery.js')}}"></script>
<script src="{{ asset('js/script.js')}}"></script>

<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/responsive.bootstrap4.js') }}"></script>

{{-- Toaster Js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>
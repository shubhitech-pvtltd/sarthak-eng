@include('layout.head')

@include('layout.header')

@include('layout.sidebar')


@yield('main-section')

<script>
    @if ($errors->any())
        toastr.error('{!! implode('<br>', $errors->all()) !!}', 'Wrong Format', {timeOut: 5000});
    @endif

    @if (session('success'))
        toastr.success('{{ session('success') }}', 'Success', {timeOut: 5000});
    @endif

    @if (session('error'))
        toastr.error('{{ session('error') }}', 'Error', {timeOut: 5000});
    @endif

    @if (session('info'))
        toastr.info('{{ session('info') }}', 'Info', {timeOut: 5000});
    @endif

    @if (session('warning'))
        toastr.warning('{{ session('warning') }}', 'Warning', {timeOut: 5000});
    @endif
</script>

</body>
</html>


{{-- @include('layout.footer') --}}
     <!-- <div class="footer-wrap bg-white pd-20 mb-20 border-radius-5 box-shadow">
     COPYRIGHT © <a class="text-dark" href="https://sarthakengineering.com/" target="_blank">Sarthak Engineering</a> 
    All Rights Reserved | Powered by 
    <a class="text-dark" href="https://www.shubhitech.com/" target="_blank">ShubhiTech</a>®
	</div>  -->
    
	
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
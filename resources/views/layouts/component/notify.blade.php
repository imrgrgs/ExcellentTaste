@if(session()->has('success'))
    <script>
        $(document).ready(function () {
            new PNotify({
                title: 'Success',
                text: `{{session()->get('success')}}`,
                type: 'success',
                hide: true,

            });
        });
    </script>
@endif

@if(session()->has('success'))
    <script>
        $(document).ready(function () {
            new PNotify({
                title: 'Success',
                text: `{{session()->get('success')}}`,
                type: 'success',
                animate: {
                    animate: true,
                    in_class: 'bounceInLeft',
                    out_class: 'bounceOutRight'
                }
            });
        });
    </script>
@endif

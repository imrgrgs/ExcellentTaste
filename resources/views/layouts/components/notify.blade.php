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

@if(session()->has('errors'))
    <script>
        $(document).ready(function () {
            var errors =  @if ($errors->any())
                '<div class="alert alert-danger"><ul>' +
                    @foreach ($errors->all() as $error)
                        '<li>{{ $error }}</li>' +
                    @endforeach
                '</ul></div>'
            @endif
            new PNotify({
                title: 'Oops',
                text: errors,
                type: 'error',
                animate: {
                    animate: true,
                    in_class: 'bounceInLeft',
                    out_class: 'bounceOutRight'
                }
            });
        });
    </script>
@endif

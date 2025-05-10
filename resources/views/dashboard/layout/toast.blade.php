@if (session('toast'))
<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "progressBar": {{ session('toast.bar') ? 'true' : 'false' }},
            "timeOut": {{ session('toast.timer') ?? 3000 }},
            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "300",
            "onShown": function() {
                $('.toast').addClass('showing');
            },
            "onHidden": function() {
                $('.toast').removeClass('showing').addClass('hiding');
            }
        };

        toastr["{{ session('toast.type') }}"]("{{ session('toast.message') }}");
    });
</script>
@endif
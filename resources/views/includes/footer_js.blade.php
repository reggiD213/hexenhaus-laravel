<script src="/libs/jquery-3.1.0.min.js"></script>
<script src="/libs/jquery.vticker.min.js"></script>

@yield('js')

<script>
    //newsticker
    $(function () {
        $('#newsticker').vTicker('init', {
            height: 73,
            padding: 5
        });
    });
</script>

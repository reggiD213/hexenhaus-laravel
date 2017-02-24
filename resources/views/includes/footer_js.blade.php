<script src="/libs/jquery-3.1.0.min.js"></script>
<script src="/libs/jquery.vticker.min.js"></script>

@yield('js')

@if(config('app.env') == 'production')
    <!-- Piwik -->
    <script type="text/javascript">
        var _paq = _paq || [];
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//piwik.reggid213.net/";
            _paq.push(['setTrackerUrl', u+'piwik.php']);
            _paq.push(['setSiteId', 1]);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <noscript><p><img src="//piwik.reggid213.net/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
    <!-- End Piwik Code -->
@endif

<script>
    //newsticker
    $(function () {
        $('#newsticker').vTicker('init', {
            height: 73,
            padding: 5
        });
    });
</script>

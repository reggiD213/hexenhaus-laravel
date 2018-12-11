<!doctype html>
<html lang="de">

@include('includes.head')

<body>
<div class="container">
    @include('includes.header')

    <section class="content">
        <div class="row">
            <div class="col-6">
                @yield('content')
            </div>
        </div>
    </section>

    @include('includes.footer')
</div>

@include('includes.footer_js')
@include('cookieConsent::index')
</body>
</html>
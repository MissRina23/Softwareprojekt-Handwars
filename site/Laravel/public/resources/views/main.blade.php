<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A implementation of rock-paper-scissors ">
    <meta name="author" content="Handwars-Team">
    <meta property="og:image" content="../public/img/logoKlein.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Handwars</title>
    <link rel="shortcut icon" href="../public/img/faviconCPT.ico"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{!! asset('public/css/main.css') !!}" media="all" rel="stylesheet" type="text/css"/>
    @yield('css')
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-586e3620fbd7a530"></script>
    <!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
    <script type="text/javascript">
        window.cookieconsent_options = {"message":"This website uses cookies to ensure you get the best experience on our website","dismiss":"Got it!","learnMore":"More info","link":"handwars.de/impressum","theme":"dark-bottom"};
    </script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
    <!-- End Cookie Consent plugin -->

    <!-- Piwik -->
    <script type="text/javascript">
      var _paq = _paq || [];
      // tracker methods like "setCustomDimension" should be called before "trackPageView"
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//handwars.de/piwik/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <!-- End Piwik Code -->

</head>
<body>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div id="starBackground">
    <header class="center-block">
        <a href="/"><img id="logo" src="../public/img/shiny.png" alt="Handwars Logo" class="img-responsive"></a>
        <a href="/"><img id="logoKlein" src="../public/img/logoKlein.png" alt="Handwars Logo"
                         class="img-responsive"></a>

    </header>

    <div class="container">

        @if(Session::has('message'))
            <div class="alert alert-info">
                {{Session::get('message')}}
            </div>
        @endif

        <div id="midground"></div>

        @yield('content')

    </div>
    <footer>
        <a href="/">Home</a>
        &nbsp;
        <a href="/contact">Contact</a>
        &nbsp;
        <a href="/impressum">Legal notice</a>
        &nbsp;
        <div class="fb-like" data-href="https://www.facebook.com/Handwars-685345248310374/" data-layout="button_count"
             data-action="like" data-show-faces="true" data-share="true"></div>
    </footer>
{{--lol--}}
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{!! asset('public/js/ajax-crud.js') !!}"></script>
    @yield('javascript')
</div>
</body>
</html>

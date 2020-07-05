<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- TITLE -->
    <title>TRIPINT Aviation</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">


    @include('includes._css')

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
</head>

<div id="page-wrap">

    <!-- HEADER PAGE -->
    <header id="header-page">
        <div class="header-page__inner">
            <div class="container">
                <!-- LOGO -->
                <div class="logo">
                    <a href="index.html"><img src="{{asset('tourhub-logo.png')}}" alt=""></a>
                </div>
                <!-- END / LOGO -->

                <!-- NAVIGATION -->
                @include('includes._nav')
                <!-- END / NAVIGATION -->

                <!--                     SEARCH BOX-->
                <div class="search-box">
                    <span class="searchtoggle"><i class="awe-icon awe-icon-search"></i></span>
                    <form class="form-search">
                        <div class="form-item">
                            <input type="text" value="Search &amp; hit enter">
                        </div>
                    </form>
                </div>
                <!--                     END / SEARCH BOX-->

                <!-- TOGGLE MENU RESPONSIVE -->
                <a class="toggle-menu-responsive" href="#">
                    <div class="hamburger">
                        <span class="item item-1"></span>
                        <span class="item item-2"></span>
                        <span class="item item-3"></span>
                    </div>
                </a>
                <!-- END / TOGGLE MENU RESPONSIVE -->

            </div>
        </div>
    </header>
    <!-- END / HEADER PAGE -->

    <section class="hero-section">
        @yield('content')
    </section>

    <!-- FOOTER PAGE -->
    @include('includes._footer')
    <!-- END / FOOTER PAGE -->

</div>
<!-- END / PAGE WRAP -->

<!-- LOAD JQUERY -->
    @include('includes._js')
</body>
</html>

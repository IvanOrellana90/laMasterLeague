<!-- Core  -->
<script src="{{ URL::to('global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
<script src="{{ URL::to('global/vendor/jquery/jquery.js') }}"></script>
<script src="{{ URL::to('global/vendor/popper-js/umd/popper.min.js') }}"></script>
<script src="{{ URL::to('global/vendor/bootstrap/bootstrap.js') }}"></script>
<script src="{{ URL::to('global/vendor/animsition/animsition.js') }}"></script>
<script src="{{ URL::to('global/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ URL::to('global/vendor/asscrollbar/jquery-asScrollbar.js') }}"></script>
<script src="{{ URL::to('global/vendor/asscrollable/jquery-asScrollable.js') }}"></script>
<script src="{{ URL::to('global/vendor/ashoverscroll/jquery-asHoverScroll.js') }}"></script>

<!-- Plugins -->
<script src="{{ URL::to('global/vendor/switchery/switchery.js') }}"></script>
<script src="{{ URL::to('global/vendor/intro-js/intro.js') }}"></script>
<script src="{{ URL::to('global/vendor/screenfull/screenfull.js') }}"></script>
<script src="{{ URL::to('global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>
<script src="{{ URL::to('global/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
<!-- Toastr -->
<script src="{{ URL::to('/global/vendor/toastr/build/toastr.min.js') }}"></script>
@yield('js-plugin')

<!-- Scripts -->
<script src="{{ URL::to('global/js/Component.js') }}"></script>
<script src="{{ URL::to('global/js/Plugin.js') }}"></script>
<script src="{{ URL::to('global/js/Base.js') }}"></script>
<script src="{{ URL::to('global/js/Config.js') }}"></script>

<script src="{{ URL::to('assets/js/Section/Menubar.js') }}"></script>
<script src="{{ URL::to('assets/js/Section/GridMenu.js') }}"></script>
<script src="{{ URL::to('assets/js/Section/Sidebar.js') }}"></script>
<script src="{{ URL::to('assets/js/Section/PageAside.js') }}"></script>
<script src="{{ URL::to('assets/js/Plugin/menu.js') }}"></script>

<script src="{{ URL::to('global/js/config/colors.js') }}"></script>
<script src="{{ URL::to('assets/js/config/tour.js') }}"></script>

<script>Config.set('assets', '../../assets');</script>

<!-- Page -->
<script src="{{ URL::to('assets/js/Site.js') }}"></script>
<script src="{{ URL::to('global/js/Plugin/asscrollable.js') }}"></script>
<script src="{{ URL::to('global/js/Plugin/slidepanel.js') }}"></script>
<script src="{{ URL::to('global/js/Plugin/switchery.js') }}"></script>
<script src="{{ URL::to('global/js/Plugin/jquery-placeholder.js') }}"></script>
@yield('js-page')

<script>
    (function(document, window, $){
        'use strict';

        var Site = window.Site;
        $(document).ready(function(){
            Site.run();
        });
    })(document, window, jQuery);
</script>
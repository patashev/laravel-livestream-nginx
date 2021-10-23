<!-- Control Sidebar -->

<aside class="control-sidebar control-sidebar-dark">
<!-- Create the tabs -->
<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
<!-- Home tab content -->
<div class="tab-pane" id="control-sidebar-home-tab">
<h3 class="control-sidebar-heading">Recent Activity</h3>
<ul class="control-sidebar-menu">
<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

      <p>Will be 23 on April 24th</p>
    </div>
  </a>
</li>
<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-user bg-yellow"></i>

    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

      <p>New phone +1(800)555-1234</p>
    </div>
  </a>
</li>
<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

      <p>nora@example.com</p>
    </div>
  </a>
</li>
<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-file-code-o bg-green"></i>

    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

      <p>Execution time 5 seconds</p>
    </div>
  </a>
</li>
</ul>
<!-- /.control-sidebar-menu -->

<h3 class="control-sidebar-heading">Tasks Progress</h3>
<ul class="control-sidebar-menu">
<li>
  <a href="javascript:void(0)">
    <h4 class="control-sidebar-subheading">
      Custom Template Design
      <span class="label label-danger pull-right">70%</span>
    </h4>

    <div class="progress progress-xxs">
      <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
    </div>
  </a>
</li>
<li>
  <a href="javascript:void(0)">
    <h4 class="control-sidebar-subheading">
      Update Resume
      <span class="label label-success pull-right">95%</span>
    </h4>

    <div class="progress progress-xxs">
      <div class="progress-bar progress-bar-success" style="width: 95%"></div>
    </div>
  </a>
</li>
<li>
  <a href="javascript:void(0)">
    <h4 class="control-sidebar-subheading">
      Laravel Integration
      <span class="label label-warning pull-right">50%</span>
    </h4>

    <div class="progress progress-xxs">
      <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
    </div>
  </a>
</li>
<li>
  <a href="javascript:void(0)">
    <h4 class="control-sidebar-subheading">
      Back End Framework
      <span class="label label-primary pull-right">68%</span>
    </h4>

    <div class="progress progress-xxs">
      <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
    </div>
  </a>
</li>
</ul>
<!-- /.control-sidebar-menu -->

</div>



<!-- /.tab-pane -->
<!-- Stats tab content -->
<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
<!-- /.tab-pane -->
<!-- Settings tab content -->
<div class="tab-pane" id="control-sidebar-settings-tab">
<form method="post">
<h3 class="control-sidebar-heading">General Settings</h3>

<div class="form-group">
  <label class="control-sidebar-subheading">
    Report panel usage
    <input type="checkbox" class="pull-right" checked="">
  </label>

  <p>
    Some information about this general settings option
  </p>
</div>
<!-- /.form-group -->

<div class="form-group">
  <label class="control-sidebar-subheading">
    Allow mail redirect
    <input type="checkbox" class="pull-right" checked="">
  </label>

  <p>
    Other sets of options are available
  </p>
</div>
<!-- /.form-group -->

<div class="form-group">
  <label class="control-sidebar-subheading">
    Expose author name in posts
    <input type="checkbox" class="pull-right" checked="">
  </label>

  <p>
    Allow the user to show his name in blog posts
  </p>
</div>
<!-- /.form-group -->

<h3 class="control-sidebar-heading">Chat Settings</h3>

<div class="form-group">
  <label class="control-sidebar-subheading">
    Show me as online
    <input type="checkbox" class="pull-right" checked="">
  </label>
</div>
<!-- /.form-group -->

<div class="form-group">
  <label class="control-sidebar-subheading">
    Turn off notifications
    <input type="checkbox" class="pull-right">
  </label>
</div>
<!-- /.form-group -->

<div class="form-group">
  <label class="control-sidebar-subheading">
    Delete chat history
    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
  </label>
</div>
<!-- /.form-group -->
</form>
</div>
<!-- /.tab-pane -->
</div>
</aside>


@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">

    $(function () {
        'use strict'

        $('[data-toggle="control-sidebar"]').controlSidebar()
        $('[data-toggle="push-menu"]').pushMenu()
        var $pushMenu = $('[data-toggle="push-menu"]').data('lte.pushmenu')
        var $controlSidebar = $('[data-toggle="control-sidebar"]').data('lte.controlsidebar')
        var $layout = $('body').data('lte.layout')
        $(window).on('load', function() {
            // Reinitialize variables on load
            $pushMenu = $('[data-toggle="push-menu"]').data('lte.pushmenu')
            $controlSidebar = $('[data-toggle="control-sidebar"]').data('lte.controlsidebar')
            $layout = $('body').data('lte.layout')
        })

        /**
         * List of all the available skins
         *
         * @type Array
         */
        var mySkins = [
            'skin-blue',
            'skin-black',
            'skin-red',
            'skin-yellow',
            'skin-purple',
            'skin-green',
            'skin-blue-light',
            'skin-black-light',
            'skin-red-light',
            'skin-yellow-light',
            'skin-purple-light',
            'skin-green-light'
        ]

        /**
         * Get a prestored setting
         *
         * @param String name Name of of the setting
         * @returns String The value of the setting | null
         */
        function get(name) {
            if (typeof (Storage) !== 'undefined') {
                return localStorage.getItem(name)
            } else {
                window.alert('Please use a modern browser to properly view this template!')
            }
        }

        /**
         * Store a new settings in the browser
         *
         * @param String name Name of the setting
         * @param String val Value of the setting
         * @returns void
         */
        function store(name, val) {
            if (typeof (Storage) !== 'undefined') {
                localStorage.setItem(name, val)
            } else {
                window.alert('Please use a modern browser to properly view this template!')
            }
        }

        /**
         * Toggles layout classes
         *
         * @param String cls the layout class to toggle
         * @returns void
         */
        function changeLayout(cls) {
            $('body').toggleClass(cls)
            $layout.fixSidebar()
            if ($('body').hasClass('fixed') && cls == 'fixed') {
                $pushMenu.expandOnHover()
                $layout.activate()
            }
            $controlSidebar.fix()
        }

        /**
         * Replaces the old skin with the new skin
         * @param String cls the new skin class
         * @returns Boolean false to prevent link's default action
         */
        function changeSkin(cls) {
            $.each(mySkins, function (i) {
                $('body').removeClass(mySkins[i])
            })

            $('body').addClass(cls)
            store('skin', cls)
            return false
        }

        /**
         * Retrieve default settings and apply them to the template
         *
         * @returns void
         */
        function setup() {
            var tmp = get('skin')
            if (tmp && $.inArray(tmp, mySkins))
                changeSkin(tmp)

            // Add the change skin listener
            $('[data-skin]').on('click', function (e) {
                if ($(this).hasClass('knob'))
                    return
                e.preventDefault()
                changeSkin($(this).data('skin'))
            })

            // Add the layout manager
            $('[data-layout]').on('click', function () {
                changeLayout($(this).data('layout'))
            })

            $('[data-controlsidebar]').on('click', function () {
                changeLayout($(this).data('controlsidebar'))
                var slide = !$controlSidebar.options.slide

                $controlSidebar.options.slide = slide
                if (!slide)
                    $('.control-sidebar').removeClass('control-sidebar-open')
            })

            $('[data-sidebarskin="toggle"]').on('click', function () {
                var $sidebar = $('.control-sidebar')
                if ($sidebar.hasClass('control-sidebar-dark')) {
                    $sidebar.removeClass('control-sidebar-dark')
                    $sidebar.addClass('control-sidebar-light')
                } else {
                    $sidebar.removeClass('control-sidebar-light')
                    $sidebar.addClass('control-sidebar-dark')
                }
            })

            $('[data-enable="expandOnHover"]').on('click', function () {
                $(this).attr('disabled', true)
                $pushMenu.expandOnHover()
                if (!$('body').hasClass('sidebar-collapse'))
                    $('[data-layout="sidebar-collapse"]').click()
            })

            //  Reset options
            if ($('body').hasClass('fixed')) {
                $('[data-layout="fixed"]').attr('checked', 'checked')
            }
            if ($('body').hasClass('layout-boxed')) {
                $('[data-layout="layout-boxed"]').attr('checked', 'checked')
            }
            if ($('body').hasClass('sidebar-collapse')) {
                $('[data-layout="sidebar-collapse"]').attr('checked', 'checked')
            }

        }

        // Create the new tab
        var $tabPane = $('<div />', {
            'id': 'control-sidebar-theme-demo-options-tab',
            'class': 'tab-pane active'
        })

        // Create the tab button
        var $tabButton = $('<li />', {'class': 'active'})
            .html('<a href=\'#control-sidebar-theme-demo-options-tab\' data-toggle=\'tab\'>'
                + '<i class="fa fa-wrench"></i>'
                + '</a>')

        // Add the tab button to the right sidebar tabs
        $('[href="#control-sidebar-home-tab"]')
            .parent()
            .before($tabButton)

        // Create the menu
        var $demoSettings = $('<div />')

        // Layout options
        $demoSettings.append(
            '<h4 class="control-sidebar-heading">'
            + 'Layout Options'
            + '</h4>'
            // Fixed layout
            + '<div class="form-group">'
            + '<label class="control-sidebar-subheading">'
            + '<input type="checkbox"data-layout="fixed"class="pull-right"/> '
            + 'Fixed layout'
            + '</label>'
            + '<p>Activate the fixed layout. You can\'t use fixed and boxed layouts together</p>'
            + '</div>'
            // Boxed layout
            + '<div class="form-group">'
            + '<label class="control-sidebar-subheading">'
            + '<input type="checkbox"data-layout="layout-boxed" class="pull-right"/> '
            + 'Boxed Layout'
            + '</label>'
            + '<p>Activate the boxed layout</p>'
            + '</div>'
            // Sidebar Toggle
            + '<div class="form-group">'
            + '<label class="control-sidebar-subheading">'
            + '<input type="checkbox"data-layout="sidebar-collapse"class="pull-right"/> '
            + 'Toggle Sidebar'
            + '</label>'
            + '<p>Toggle the left sidebar\'s state (open or collapse)</p>'
            + '</div>'
            // Sidebar mini expand on hover toggle
            + '<div class="form-group">'
            + '<label class="control-sidebar-subheading">'
            + '<input type="checkbox"data-enable="expandOnHover"class="pull-right"/> '
            + 'Sidebar Expand on Hover'
            + '</label>'
            + '<p>Let the sidebar mini expand on hover</p>'
            + '</div>'
            // Control Sidebar Toggle
            + '<div class="form-group">'
            + '<label class="control-sidebar-subheading">'
            + '<input type="checkbox"data-controlsidebar="control-sidebar-open"class="pull-right"/> '
            + 'Toggle Right Sidebar Slide'
            + '</label>'
            + '<p>Toggle between slide over content and push content effects</p>'
            + '</div>'
            // Control Sidebar Skin Toggle
            + '<div class="form-group">'
            + '<label class="control-sidebar-subheading">'
            + '<input type="checkbox"data-sidebarskin="toggle"class="pull-right"/> '
            + 'Toggle Right Sidebar Skin'
            + '</label>'
            + '<p>Toggle between dark and light skins for the right sidebar</p>'
            + '</div>'
        )
        var $skinsList = $('<ul />', {'class': 'list-unstyled clearfix'})

        // Dark sidebar skins
        var $skinBlue =
            $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
                .append('<a href="javascript:void(0)" data-skin="skin-blue" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                    + '<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                    + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                    + '</a>'
                    + '<p class="text-center no-margin">Blue</p>')
        $skinsList.append($skinBlue)
        var $skinBlack =
            $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
                .append('<a href="javascript:void(0)" data-skin="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                    + '<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div>'
                    + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                    + '</a>'
                    + '<p class="text-center no-margin">Black</p>')
        $skinsList.append($skinBlack)
        var $skinPurple =
            $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
                .append('<a href="javascript:void(0)" data-skin="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                    + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                    + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                    + '</a>'
                    + '<p class="text-center no-margin">Purple</p>')
        $skinsList.append($skinPurple)
        var $skinGreen =
            $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
                .append('<a href="javascript:void(0)" data-skin="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                    + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                    + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                    + '</a>'
                    + '<p class="text-center no-margin">Green</p>')
        $skinsList.append($skinGreen)
        var $skinRed =
            $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
                .append('<a href="javascript:void(0)" data-skin="skin-red" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                    + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                    + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                    + '</a>'
                    + '<p class="text-center no-margin">Red</p>')
        $skinsList.append($skinRed)
        var $skinYellow =
            $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
                .append('<a href="javascript:void(0)" data-skin="skin-yellow" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                    + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                    + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                    + '</a>'
                    + '<p class="text-center no-margin">Yellow</p>')
        $skinsList.append($skinYellow)

        // Light sidebar skins
        var $skinBlueLight =
            $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
                .append('<a href="javascript:void(0)" data-skin="skin-blue-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                    + '<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                    + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                    + '</a>'
                    + '<p class="text-center no-margin" style="font-size: 12px">Blue Light</p>')
        $skinsList.append($skinBlueLight)
        var $skinBlackLight =
            $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
                .append('<a href="javascript:void(0)" data-skin="skin-black-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                    + '<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div>'
                    + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                    + '</a>'
                    + '<p class="text-center no-margin" style="font-size: 12px">Black Light</p>')
        $skinsList.append($skinBlackLight)
        var $skinPurpleLight =
            $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
                .append('<a href="javascript:void(0)" data-skin="skin-purple-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                    + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                    + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                    + '</a>'
                    + '<p class="text-center no-margin" style="font-size: 12px">Purple Light</p>')
        $skinsList.append($skinPurpleLight)
        var $skinGreenLight =
            $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
                .append('<a href="javascript:void(0)" data-skin="skin-green-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                    + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                    + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                    + '</a>'
                    + '<p class="text-center no-margin" style="font-size: 12px">Green Light</p>')
        $skinsList.append($skinGreenLight)
        var $skinRedLight =
            $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
                .append('<a href="javascript:void(0)" data-skin="skin-red-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                    + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                    + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                    + '</a>'
                    + '<p class="text-center no-margin" style="font-size: 12px">Red Light</p>')
        $skinsList.append($skinRedLight)
        var $skinYellowLight =
            $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
                .append('<a href="javascript:void(0)" data-skin="skin-yellow-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                    + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                    + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                    + '</a>'
                    + '<p class="text-center no-margin" style="font-size: 12px">Yellow Light</p>')
        $skinsList.append($skinYellowLight)

        $demoSettings.append('<h4 class="control-sidebar-heading">Skins</h4>')
        $demoSettings.append($skinsList)

        $tabPane.append($demoSettings)
        $('#control-sidebar-home-tab').after($tabPane)

        setup()

        $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endsection

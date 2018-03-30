<header id="header" class="clearfix" data-ma-theme="pink">
    <ul class="h-inner">
        {{-- <li class="hi-trigger ma-trigger" data-ma-action="sidebar-open" data-ma-target="#sidebar">
            <div class="line-wrap">
                <div class="line top"></div>
                <div class="line center"></div>
                <div class="line bottom"></div>
            </div>
        </li> --}}

        @stack('backbutton')

        <li class="hi-logo">
          <a class="hi-logo-text">{{ $pageTitle or '-' }}</a>
        </li>
        {{-- <li class="hi-logo">
            <a href="/" class="p-0" style="margin: -4px 0 0 15px;font-size: 34px">
                <i class="zmdi zmdi-cloud-circle"></i>
            </a>
        </li> --}}

        <li class="pull-right">
            <ul class="hi-menu">
                @stack('actionbutton')

                {{-- <li>
                    <a href="{{ route('dye.create') }}"><i class="him-icon zmdi zmdi-brush"></i></a>
                </li> --}}

                {{-- <li>
                    <a href="{{ route('catalog.index') }}"><span class="him-label">ΚΑΤΑΛΟΓΟΣ</span></a>
                </li> --}}

                {{-- <li>
                    <a href="{{ route('client.index') }}"><i class="him-icon zmdi zmdi-account"></i></a>
                </li> --}}

                {{-- <li data-ma-action="search-open">
                    <a href=""><i class="him-icon zmdi zmdi-search"></i></a>
                </li> --}}

                <li class="dropdown">
                    <a data-toggle="dropdown" href=""><i class="him-icon zmdi zmdi-more-vert"></i></a>
                    <ul class="dropdown-menu dm-icon pull-right">
                        <li>
                            <a href="{{ route('client.index') }}"><i class="him-icon zmdi zmdi-account"></i> Πελάτες</a>
                        </li>
                        <li>
                            <a href="{{ route('catalog.index') }}"><i class="him-icon zmdi zmdi-view-headline"></i> Κατάλογος</a>
                        </li>
                        <li>
                            <a href="{{ route('expense.index') }}"><i class="him-icon zmdi zmdi-money"></i> Έξοδα</a>
                        </li>

                        @if(Auth::user()->role === 'admin')
                        <li>
                            <a href="{{ route('stat.index') }}"><i class="him-icon zmdi zmdi-equalizer"></i> Σύνοψη</a>
                        </li>
                        @endif

                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('auth.logout') }}"><i class="him-icon zmdi zmdi-arrow-right"></i> Αποσύνδεση</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        @stack('centertext')

    </ul>

    <!-- Top Search Content -->
    {{-- <div class="h-search-wrap">
        <div class="hsw-inner">
            <i class="hsw-close zmdi zmdi-arrow-left" data-ma-action="search-close"></i>
            <input type="text">
        </div>
    </div> --}}
</header>
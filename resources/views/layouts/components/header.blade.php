<header id="header" class="clearfix bgm-crm">
    <ul class="h-inner">
        {{-- <li class="hi-trigger ma-trigger" data-ma-action="sidebar-open" data-ma-target="#sidebar">
            <div class="line-wrap">
                <div class="line top"></div>
                <div class="line center"></div>
                <div class="line bottom"></div>
            </div>
        </li> --}}

        <li class="pull-left" style="display:flex">
            @stack('backbutton')

            <a class="hi-logo-text">{{ $pageTitle or '-' }}</a>
        </li>

        @stack('headercenter')

        <li class="pull-right">
            <ul class="hi-menu">
                @stack('actionbutton')

                <li class="dropdown">
                    <a data-toggle="dropdown" href=""><i class="him-icon zmdi zmdi-more-vert"></i></a>
                    <ul class="dropdown-menu dm-icon pull-right">
                        <li>
                            <h6 class="dropdown-header">ΛΕΙΤΟΥΡΓΙΑ</h6>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('client.index') }}"><i class="him-icon zmdi zmdi-account"></i> ΠΕΛΑΤΕΣ</a>
                        </li>
                        <li>
                            <a href="{{ route('appointment.index') }}"><i class="him-icon zmdi zmdi-view-week"></i> ΡΑΝΤΕΒΟΥ</a>
                        </li>
                        <li>
                            <a href="{{ route('expense.index') }}"><i class="him-icon zmdi zmdi-money"></i> ΕΞΟΔΟΛΟΓΙΟ</a>
                        </li>
                        <li>
                            <a href="{{ route('catalog.index') }}"><i class="him-icon zmdi zmdi-view-headline"></i> ΚΑΤΑΛΟΓΟΣ / ΠΡΟΙΟΝΤΑ</a>
                        </li>

                        @if (Auth::user()->role === 'admin')
                            <li>
                                <a href="{{ route('vat.index') }}"><i class="him-icon zmdi zmdi-receipt"></i> ΦΠΑ</a>
                            </li>
                        @endif

                        @if (Auth::user()->role === 'admin')
                            <li>
                                <h6 class="dropdown-header">ΔΙΑΧΕΙΡΙΣΗ</h6>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('user.index') }}"><i class="him-icon zmdi zmdi-accounts-list-alt"></i> ΧΡΗΣΤΕΣ ΣΥΣΤΗΜΑΤΟΣ</a>
                            </li>
                            <li>
                                <a href="{{ route('schedule.index') }}"><i class="him-icon zmdi zmdi-calendar-alt"></i> ΠΡΟΓΡΑΜΜΑ ΕΡΓΑΣΙΑΣ</a>
                            </li>
                            <li>
                                <a href="{{ route('stat.index') }}"><i class="him-icon zmdi zmdi-equalizer"></i> ΣΥΝΟΨΗ</a>
                            </li>
                        @endif

                        <li>
                            <h6 class="dropdown-header">ΣΥΝΔΕΔΕΜΕΝΟΣ ΧΡΗΣΤΗΣ</h6>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('auth.logout') }}"><i class="him-icon zmdi zmdi-arrow-right"></i> ΑΠΟΣΥΝΔΕΣΗ</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        @stack('centertext')

    </ul>
</header>
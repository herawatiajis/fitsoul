@php
    $currentRoute = Route::currentRouteName();
    $routePrefix = explode('.', $currentRoute)[0];
@endphp
<header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        @foreach ($configurations as $index => $configuration )
                        <a href={{ route('home') }} class="logo">{{ $configuration->name }}<em> Gym</em></a>
                        @endforeach
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{ route('home') }}" class="{{ $currentRoute == 'home' ? 'active' : '' }}">Home</a></li>
                            @if ($currentRoute == 'member-profile' || $routePrefix == 'registration-member' || $routePrefix == 'check-status-member')
                                <li class="scroll-to-section"><a href="{{ route('member-profile') }}" class="{{ $currentRoute == 'member-profile' ? 'active' : '' }}">Your Profile</a></li>
                                <li class="main-button"><a href="{{ route('logout') }}">Logout</a></li>
                            @else
                            <li class="scroll-to-section"><a href="#features">Program</a></li>
                            <li class="scroll-to-section"><a href="#our-classes">Supplement</a></li>
                            <li class="scroll-to-section"><a href="#schedule">Membership</a></li>
                            <li class="scroll-to-section"><a href="#contact-us">Contact</a></li>
                            @if(auth()->check())
                            <li class="scroll-to-section"><a href="{{ route('member-profile') }}">Your Profile</a></li>
                            <li class="main-button"><a href="{{ route('logout') }}">Logout</a></li>
                            @else
                            <li class="main-button"><a href="{{ route('login') }}">Login</a></li>
                            @endif
                            @endif
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <script>
        $(document).ready(function () {
            $('.dropdown-toggle').click(function (e) {
                var $el = $(this).next('.dropdown-menu');
                var isVisible = $el.is(':visible');
                $('.dropdown-menu').not($el).hide(); // Hide other dropdowns
                if (isVisible) {
                    $el.hide(); // If clicked again, hide it
                } else {
                    $el.show(); // Show the clicked dropdown
                }
                return false; // Prevent default action and stop propagation
            });
            $(document).click(function (e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').hide(); // Hide dropdown if clicked outside
                }
            });
        });
    </script>
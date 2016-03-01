<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <a href="/">Hunter & Miller</a>
        </li>
        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
    </ul>

    <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
            <li>
                <a href="{{ URL::route('portfolio') }}">
                    portfolio
                </a>
            </li>
            <li>
                <a href="{{ URL::route('process') }}">
                    ons process
                </a>
            </li>
            <li>
                <a href="{{ URL::route('overons') }}">
                    over ons
                </a>
            </li>
            <li>
                <a href="{{ URL::route('contact') }}">
                    contact
                </a>
            </li>
        </ul>
    </section>
</nav>

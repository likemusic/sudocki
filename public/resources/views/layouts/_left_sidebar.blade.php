<div class="sidebar" data-color="custom">
    <div class="logo">
        <a href="/" class="simple-text logo-mini">
            <img src="/images/logo.png" alt="logo" class="hidden" hidden>
        </a>
        <a href="/" class="simple-text logo-normal">
            {{ setting('site.title') }}
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li>
                <a href="{{ route('home') }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>Товары</p>
                </a>
            </li>
            <li>
                <a href="{{route('customers.store')}}">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>Клиенты</p>
                </a>
            </li>

            @if(0)
                <li>
                    <a href="./map.html">
                        <i class="now-ui-icons location_map-big"></i>
                        <p>Maps</p>
                    </a>
                </li>
                <li>
                    <a href="./notifications.html">
                        <i class="now-ui-icons ui-1_bell-53"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                <li>
                    <a href="./user.html">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li class="active ">
                    <a href="./tables.html">
                        <i class="now-ui-icons design_bullet-list-67"></i>
                        <p>Table List</p>
                    </a>
                </li>
                <li>
                    <a href="./typography.html">
                        <i class="now-ui-icons text_caps-small"></i>
                        <p>Typography</p>
                    </a>
                </li>
                <li class="active-pro">
                    <a href="./upgrade.html">
                        <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                        <p>Upgrade to PRO</p>
                    </a>
                </li>
                @endif

        </ul>
    </div>
</div>

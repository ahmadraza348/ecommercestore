<div class="header">

    <div class="header-left active">
        <a href="index.html" class="logo">
            <img src="{{ asset('backend/assets/img/logo.png') }}" alt="">
        </a>
        <a href="index.html" class="logo-small">
            <img src="{{ asset('backend/assets/img/logo-small.png') }}" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">

        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="#">
                    <div class="searchinputs">
                        <input type="text" placeholder="Search Here ...">
                        <div class="search-addon">
                            <span><img src="{{ asset('backend/assets/img/icons/closes.svg') }}" alt="img"></span>
                        </div>
                    </div>
                    <a class="btn" id="searchdiv"><img src="{{ asset('backend/assets/img/icons/search.svg') }}"
                            alt="img"></a>
                </form>
            </div>
        </li>


        <li class="nav-item dropdown has-arrow flag-nav">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
                <img src="{{ asset('backend/assets/img/flags/us1.png') }}" alt="" height="20">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ asset('backend/assets/img/flags/us.png') }}" alt="" height="16">
                    English
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ asset('backend/assets/img/flags/fr.png') }}" alt="" height="16">
                    French
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ asset('backend/assets/img/flags/es.png') }}" alt="" height="16">
                    Spanish
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ asset('backend/assets/img/flags/de.png') }}" alt="" height="16">
                    German
                </a>
            </div>
        </li>


        <li class="nav-item dropdown">
            <audio id="notificationSound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>
            <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <img src="{{ asset('backend/assets/img/icons/notification-bing.svg') }}" alt="img"><span
                    id="notification-count" class="badge rounded-pill">0</span>

            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti" id="clearNotifications">Clear All</a>
                </div>
                <div class="noti-content">
                    <ul id="notification-list" class="notification-list">

                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="activities.html">View all Notifications</a>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ asset('backend/assets/img/profiles/avator1.jpg') }}"
                        alt="">
                    <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="{{ asset('backend/assets/img/profiles/avator1.jpg') }}"
                                alt="">
                            <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>John Doe</h6>
                            <h5>Admin</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="{{ route('admin.user.profile') }}"> <i class="me-2"
                            data-feather="user"></i>
                        My Profile</a>
                    <a class="dropdown-item" href="generalsettings.html"><i class="me-2"
                            data-feather="settings"></i>Settings</a>
                    <hr class="m-0">
                    {{-- <a class="dropdown-item logout pb-0" href="signin.html"><img
                            src="{{ asset('backend/assets/img/icons/log-out.svg') }}" class="me-2"
                            alt="img">Logout</a> --}}

                    <a class="dropdown-item logout pb-0" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img src="{{ asset('backend/assets/img/icons/log-out.svg') }}" class="me-2"
                            alt="img">
                        Logout
                    </a>

                    <form method="POST" action="{{ route('admin.logout') }}" id="logout-form"
                        style="display: none;">
                        @csrf
                    </form>


                </div>
            </div>
        </li>
    </ul>


    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('admin.user.profile') }}">My Profile</a>
            <a class="dropdown-item" href="generalsettings.html">Settings</a>

            <form method="POST" action="{{ route('admin.logout') }}" id="logout-form">
                @csrf
                <a class="dropdown-item">
                    Logout
                </a>
            </form>


        </div>
    </div>

</div>


<script type="module">
    // console.log("Echo is initialized:", window.Echo);
    let notifications = [];

    window.Echo.channel('user-contact')
        .listen('.App\\Events\\UserContact', (e) => {

            // console.log("Realtime Event:", e);

            // 1. Store notification
            notifications.unshift(e);

            // 2. Update UI
            addNotificationToUI(e);

            // 3. Update count
            updateNotificationCount();

            // 4. Play sound
            playNotificationSound();
        });


    function addNotificationToUI(data) {
        let html = `
        <li class="notification-message">
            <a href="javascript:void(0);">
                <div class="media d-flex">
                    <span class="avatar flex-shrink-0">
                        <img src="/backend/assets/img/profiles/avatar-02.jpg">
                    </span>
                    <div class="media-body flex-grow-1">
                        <p class="noti-details">
                            <span class="noti-title">${data.name}</span> sent a message 
                            <span class="noti-title">${data.subject}</span>
                        </p>
                        <p class="noti-time">
                            <span class="notification-time">Just now</span>
                        </p>
                    </div>
                </div>
            </a>
        </li>
     `;

        $('#notification-list').prepend(html);
    }


    function updateNotificationCount() {
        $('#notification-count').text(notifications.length);
    }


    function playNotificationSound() {
        let sound = document.getElementById("notificationSound");
        if (sound) {
            sound.play().catch(() => {});
        }
    }


    // Clear notifications
    $('#clearNotifications').on('click', function() {
        notifications = [];
        $('#notification-list').html('');
        updateNotificationCount();
    });
</script>

<script type="module">
    let notifications = [];

    window.Echo.channel('admin-notifications')
        .listen('.App\\Events\\AdminNotificationEvent', (e) => {

            handleIncomingNotification(e);
        });


    function handleIncomingNotification(data) {

        notifications.unshift(data);

        addNotificationToUI(data);

        updateNotificationCount();

        playNotificationSound();
    }


    function addNotificationToUI(data) {

        let label = '';

        if (data.type === 'contact') {
            label = 'sent a message';
        } 
        else if (data.type === 'newsletter') {
            label = 'joined newsletter';
        }

        let html = `
        <li class="notification-message">
            <a href="javascript:void(0);">
                <div class="media d-flex">
                    <span class="avatar flex-shrink-0">
                        <img src="/backend/assets/img/profiles/avatar-02.jpg">
                    </span>
                    <div class="media-body flex-grow-1">
                        <p class="noti-details">
                            <span class="noti-title">${data.title}</span> ${label}
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


    $('#clearNotifications').on('click', function () {
        notifications = [];
        $('#notification-list').html('');
        updateNotificationCount();
    });

</script>
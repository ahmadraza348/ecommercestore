
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

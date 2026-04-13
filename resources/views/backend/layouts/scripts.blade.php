<script type="module">
    let notifications = [];

    /*
    |--------------------------------------------------------------------------
    | 1. CONTACT FORM LISTENER
    |--------------------------------------------------------------------------
    */
    window.Echo.channel('user-contact')
        .listen('.App\\Events\\UserContact', (e) => {
            handleIncomingNotification({
                type: 'contact',
                title: e.name,
                message: e.subject || 'sent a message'
            });
        });


    /*
    |--------------------------------------------------------------------------
    | 2. NEWSLETTER LISTENER
    |--------------------------------------------------------------------------
    */
    window.Echo.channel('newsletter')
        .listen('.App\\Events\\NewsletterSubscribed', (e) => {
            handleIncomingNotification({
                type: 'newsletter',
                title: e.email,
                message: 'subscribed to newsletter'
            });
        });


    /*
    |--------------------------------------------------------------------------
    | 🔁 COMMON HANDLER (REUSABLE)
    |--------------------------------------------------------------------------
    */
    function handleIncomingNotification(data) {

        // Store
        notifications.unshift(data);

        // UI update
        addNotificationToUI(data);

        // Count update
        updateNotificationCount();

        // Sound
        playNotificationSound();
    }


    /*
    |--------------------------------------------------------------------------
    | 🎨 UI BUILDER (DYNAMIC BASED ON TYPE)
    |--------------------------------------------------------------------------
    */
    function addNotificationToUI(data) {

        let icon = '/backend/assets/img/profiles/avatar-02.jpg';
        let label = '';

        // Customize per type
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
                        <img src="${icon}">
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


    /*
    |--------------------------------------------------------------------------
    | 🔢 COUNT UPDATE
    |--------------------------------------------------------------------------
    */
    function updateNotificationCount() {
        $('#notification-count').text(notifications.length);
    }


    /*
    |--------------------------------------------------------------------------
    | 🔊 SOUND
    |--------------------------------------------------------------------------
    */
    function playNotificationSound() {
        let sound = document.getElementById("notificationSound");
        if (sound) {
            sound.play().catch(() => {});
        }
    }


    /*
    |--------------------------------------------------------------------------
    | 🧹 CLEAR BUTTON
    |--------------------------------------------------------------------------
    */
    $('#clearNotifications').on('click', function () {
        notifications = [];
        $('#notification-list').html('');
        updateNotificationCount();
    });

</script>
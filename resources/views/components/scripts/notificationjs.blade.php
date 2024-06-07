<script>
    var firebaseconfig = {
        apiKey: "AIzaSyDibHo8RvkmsApRejtP4YuuiFmYJurg7xQ",
        authDomain: "manomedianetwork.firebaseapp.com",
        projectId: "manomedianetwork",
        storageBucket: "manomedianetwork.appspot.com",
        messagingSenderId: "161970617695",
        appId: "1:161970617695:web:9a09bedf2c4615aefe8aea",
        measurementId: "G-8MKGXW5X64"
    };
    firebase.initializeApp(firebaseconfig);
    const messaging = firebase.messaging();

    function IntitalizeFireBaseMessaging() {
        messaging.requestPermission().then(function() {
            return messaging.getToken();
        }).then(function(token) {
            console.log("Permission granted");
            var downloadfilebutton = document.getElementById('downloadfilebutton');
            $.ajax({
                url: "{{ route('firebase.store_key') }}",
                type: 'post',
                data: {
                    '_token': "{{ csrf_token() }}",
                    token: token
                },
                success: function(response) {
                    if (response.message === 'new-stored') {
                        navigator.serviceWorker.register("{{ asset('sw.js?v=1.0') }}");
                        var redirectlink = "{{ asset('SMART-MONEY-TRADING-GUIDE.pdf') }}";
                        window.location.href = redirectlink;
                    } else {
                        console.log(response.message);
                        var downloadlink = "{{ asset('SMART-MONEY-TRADING-GUIDE.pdf') }}";
                        var downloadfilebutton = document.getElementById('downloadfilebutton');
                        downloadfilebutton.setAttribute('href', downloadlink);


                    }
                }
            });
        }).catch(function(reason) {
            console.log('No token available. Request permission to generate one.');

            $.ajax({
                url: "{{ route('firebase.decline_key') }}",
                type: 'post',
                data: {
                    '_token': "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log("Store Decline");
                }
            });


        });
    }
    messaging.onMessage(function(payload) {
        console.log(payload);
        const notificationOption = {
            body: payload.notification.body,
            icon: payload.notification.icon
        };
        if (Notification.permission === "granted") {
            var notification = new Notification(payload.notification.title, notificationOption);
            notification.onclick = function(ev) {
                ev.preventDefault();
                window.open(payload.notification.click_action, '_blank');
                notification.close();
            }
        }
    });
    messaging.onTokenRefresh(function() {
        messaging.getToken().then(function(newtoken) {
            console.log("New Token : " + newtoken);
            $.ajax({
                url: "{{ route('firebase.store_key') }}",
                type: 'post',
                data: {
                    '_token': "{{ csrf_token() }}",
                    token: newtoken
                },
                success: function(response) {
                    console.log('Token Refresh');
                }
            });
        }).catch(function(reason) {
            console.log(reason);
        })
    });
    IntitalizeFireBaseMessaging();
</script>

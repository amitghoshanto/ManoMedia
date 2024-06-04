importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js');

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
messaging.setBackgroundMessageHandler(function (payload) {
    console.log(payload);
    const notification = JSON.parse(payload);
    const notificationOption = {
        body: notification.body,
        icon: notification.icon
    };
    return self.registration.showNotification(payload.notification.title, notificationOption);
});
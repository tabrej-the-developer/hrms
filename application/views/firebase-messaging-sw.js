importScripts("https://www.gstatic.com/firebasejs/7.22.1/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.22.1/firebase-messaging.js");

// Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyC_JyXX3uMpFiLXbkbGr4WhBsECY3sCFS4",
    authDomain: "personnal-8f7c9.firebaseapp.com",
    databaseURL: "https://personnal-8f7c9.firebaseio.com",
    projectId: "personnal-8f7c9",
    storageBucket: "personnal-8f7c9.appspot.com",
    messagingSenderId: "1060379292734",
    appId: "1:1060379292734:web:d7427124ff401d0d168d6f",
    measurementId: "G-EB151W6QQ8"
  };
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);

  //fetch the converstation API will come here

  
  // Customize notification here
  const notificationTitle = payload.notification.title;
  const notificationOptions = payload.notification.body;
 // _notificationId = payload.notification.title;
 // getRecentConversations(idUser)
  return self.registration.showNotification(notificationTitle,
    notificationOptions);
});

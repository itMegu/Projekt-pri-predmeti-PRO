
<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.7.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.7.0/firebase-analytics.js";
  import { getDatabase } from "https://www.gstatic.com/firebasejs/9.7.0/firebase-database.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries
  //include database(Current in testing phase)

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyDOl7u-Oh6pj9mX1pubmnWqRB21LiqzGcs",
    authDomain: "ircpopupchat.firebaseapp.com",
    projectId: "ircpopupchat",
    storageBucket: "ircpopupchat.appspot.com",
    messagingSenderId: "222977747198",
    appId: "1:222977747198:web:d330d5566276fac4aa1daf",
    measurementId: "G-MKFMJNFQEC"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);

  var Ime = prompt("Vnesi Svoje Ime / Enter your name");
  function sendMessage() {
    var message = document.getElementById("message").value;

    firebase.database().ref("message").push().set({
        "sender": Ime,
        "message": message
    })

      return false;
  }

</script>

<form onsubimt ="return sendMessage();">
    <input id="message" placeholder="Enter message" autocomplete="off">
    <input type="submit">
</form>



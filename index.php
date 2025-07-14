<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>demObywatel</title>
    <link rel="stylesheet" href="styles.css">
<style>
  .loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #121212;
  transition: opacity 0.75s, visibility 0.75s;
}

.loader--hidden {
  opacity: 0;
  visibility: hidden;
}

.loader::after {
  content: "";
  width: 75px;
  height: 75px;
  border: 15px solid #dddddd;
  border-top-color: #1e1e1e;
  border-radius: 50%;
  animation: loading 0.75s ease infinite;
}

@keyframes loading {
  from {
    transform: rotate(0turn);
  }
  to {
    transform: rotate(1turn);
  }
}
</style>
  <script>
    window.addEventListener("load", () => {
  const loader = document.querySelector(".loader");

  loader.classList.add("loader--hidden");

  loader.addEventListener("transitionend", () => {
    document.body.removeChild(loader);
  });
});
</script>
  </head>
<body>
    <div class="loader"></div>
  <div class="login-container">
        <h1>demObywatel</h1>
        <form action="login.php" method="POST">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Auth Key" required>
            <button type="submit">Login</button>
        </form>
    </div>
 <!-- 🟢 Przycisk do instalacji PWA -->
<button id="install-button" style="display:none;">📲 Zainstaluj aplikację</button>

<!-- 🔧 Skrypt PWA -->
<script>
let deferredPrompt;

window.addEventListener("beforeinstallprompt", (e) => {
  e.preventDefault();
  deferredPrompt = e;

  const btn = document.getElementById("install-button");
  btn.style.display = "block";

  btn.addEventListener("click", () => {
    btn.style.display = "none";
    deferredPrompt.prompt();
    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === "accepted") {
        console.log("✅ Dodano do ekranu głównego");
      } else {
        console.log("❌ Odrzucono dodanie");
      }
      deferredPrompt = null;
    });
  });
});

if ("serviceWorker" in navigator) {
  window.addEventListener("load", function () {
    navigator.serviceWorker
      .register("/sw.js")
      .then(() => console.log("✅ Service Worker działa"))
      .catch((e) => console.error("❌ Błąd Service Workera:", e));
  });
}
</script>   
</body>
<!-- demObywatel 2024 -->
<!-- Paulina Bernaszuk -->
<!-- Strona jest przeznaczona jedynie do generowania demonstracyjnych stron aplikacji mObywatel. -->
</html>

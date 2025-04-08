<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Health Tracker Bot</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root {
      --bg-light: #fdfdfd;
      --bg-dark: #1f2937;
      --text-light: #1a1a1a;
      --text-dark: #f1f1f1;
      --card-light: #ffffff;
      --card-dark: #2d3748;
      --highlight: #10b981;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--bg-light);
      color: var(--text-light);
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 20px;
      transition: background-color 0.4s, color 0.4s;
    }

    .dark {
      background-color: var(--bg-dark);
      color: var(--text-dark);
    }

    .header {
      width: 100%;
      max-width: 400px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.06);
      border-radius: 16px;
      margin-bottom: 25px;
      background-color: var(--card-light);
      transition: background-color 0.4s;
    }

    .dark .header {
      background-color: var(--card-dark);
    }

    .header h1 {
      color: var(--highlight);
      font-size: 26px;
      margin: 0;
      font-weight: 600;
    }

    .speech {
      background: linear-gradient(to right, #c1f2d9, #a8f0ce);
      color: #146c43;
      padding: 12px 24px;
      border-radius: 30px;
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      animation: float 2s ease-in-out infinite;
    }

    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-5px); }
      100% { transform: translateY(0px); }
    }

    .bot-image {
      width: 150px;
      margin-bottom: 30px;
    }

    form {
      width: 100%;
      max-width: 450px;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    textarea {
      padding: 16px;
      border: 2px solid #ccc;
      border-radius: 12px;
      font-size: 16px;
      resize: vertical;
      min-height: 120px;
      transition: border-color 0.3s;
    }

    textarea:focus {
      border-color: #2e8b57;
      outline: none;
    }

    .button {
      background: #f9caca;
      color: #b02a37;
      font-weight: bold;
      padding: 15px 30px;
      border: none;
      border-radius: 20px;
      font-size: 18px;
      display: flex;
      align-items: center;
      gap: 10px;
      justify-content: center;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }

    .button:hover {
      background-color: #f39fa7;
      transform: translateY(-2px);
    }

    .button-icon {
      font-size: 20px;
      animation: fly 2s infinite;
    }

    @keyframes fly {
      0%, 100% { transform: translateX(0); }
      50% { transform: translateX(3px); }
    }

    .toggle {
      position: absolute;
      top: 20px;
      right: 20px;
      background: none;
      border: 2px solid #ccc;
      padding: 6px 12px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .toggle:hover {
      background: #e0e0e0;
    }
  </style>
</head>
<body>

  <button class="toggle" onclick="toggleDarkMode()">🌗</button>

  <div class="header">
    <h1>Health tracker</h1>
    <img src="https://cdn-icons-png.flaticon.com/512/3112/3112921.png" alt="Icon" width="28">
  </div>

  <div class="speech">Hello!</div>

  <img src="https://cdn-icons-png.flaticon.com/512/4712/4712035.png" alt="Bot" class="bot-image">

  <form method="POST" action="analyze.php">
    <textarea name="symptoms" placeholder="Describe your symptoms here..." required></textarea>
    <button type="submit" class="button">
      <span class="button-icon">✈️</span>
      Get in touch
    </button>
  </form>

  <script>
    if (localStorage.getItem("theme") === "dark") {
      document.body.classList.add("dark");
    }

    function toggleDarkMode() {
      document.body.classList.toggle("dark");
      const theme = document.body.classList.contains("dark") ? "dark" : "light";
      localStorage.setItem("theme", theme);
    }
  </script>
</body>
</html>

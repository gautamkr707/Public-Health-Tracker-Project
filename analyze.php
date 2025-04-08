<?php
require_once 'config.php';

$symptoms = trim($_POST['symptoms'] ?? '');

if (!$symptoms) {
    echo "No symptoms provided.";
    exit;
}

$prompt = "A user reports the following symptoms: $symptoms. 
Please act as a health assistant and give a possible explanation, suggestions, and health advice in a friendly, simple way. Don't give a diagnosis.";

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $gemini_api_key;

$data = [
    "contents" => [
        [
            "parts" => [
                ["text" => $prompt]
            ]
        ]
    ]
];

$payload = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
curl_close($ch);

$responseText = "Sorry, we couldn’t process your symptoms right now. Please try again later.";

if ($response) {
    $result = json_decode($response, true);
    $responseText = $result['candidates'][0]['content']['parts'][0]['text'] ?? $responseText;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Health Bot Result</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root {
      --bg-light: #f4f4f4;
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
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      transition: background-color 0.4s, color 0.4s;
    }

    .dark {
      background-color: var(--bg-dark);
      color: var(--text-dark);
    }

    .card {
      background-color: var(--card-light);
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
      max-width: 700px;
      width: 100%;
      transition: background-color 0.4s, color 0.4s;
    }

    .dark .card {
      background-color: var(--card-dark);
    }

    h2 {
      color: var(--highlight);
      margin-bottom: 20px;
      font-size: 22px;
      text-align: center;
    }

    .bot-img-animated {
      display: block;
      margin: 0 auto 20px;
      width: 120px;
      animation: botFloat 3s ease-in-out infinite;
    }

    @keyframes botFloat {
      0% { transform: translateY(0) scale(1); }
      50% { transform: translateY(-5px) scale(1.03); }
      100% { transform: translateY(0) scale(1); }
    }

    .response-text {
      white-space: pre-line;
      font-size: 16px;
      line-height: 1.6;
      margin-bottom: 30px;
    }

    a {
      text-decoration: none;
      color: #3b82f6;
      text-align: center;
      display: block;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
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

  <!-- Dark mode toggle -->
  <button class="toggle" onclick="toggleDarkMode()">🌗</button>

  <!-- Content Card -->
  <div class="card">
    <h2>Health Bot:</h2>
    <img src="https://cdn-icons-png.flaticon.com/512/4712/4712035.png" alt="Bot" class="bot-img-animated">
    <p class="response-text"><?php echo nl2br(htmlspecialchars($responseText)); ?></p>
    <a href="index.php">← Go back</a>
  </div>

  <script>
    // Apply dark mode from localStorage on load
    if (localStorage.getItem("theme") === "dark") {
      document.body.classList.add("dark");
    }

    // Toggle dark mode + store in localStorage
    function toggleDarkMode() {
      document.body.classList.toggle("dark");
      const mode = document.body.classList.contains("dark") ? "dark" : "light";
      localStorage.setItem("theme", mode);
    }
  </script>

</body>
</html>

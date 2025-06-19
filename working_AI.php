<?php
session_start();

if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arjun</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .chat-container {
            width: 100%;
            max-width: 700px;
            height: 80vh;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-header {
            background: linear-gradient(135deg, #00b4db, #0083b0);
            color: white;
            padding: 15px;
            text-align: center;
        }

        .chat-header h1 {
            font-size: 24px;
            font-weight: 600;
        }

        .chat-header p {
            font-size: 14px;
            opacity: 0.8;
        }

        .chat-body {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #fafafa;
        }

        .message {
            margin: 15px 0;
            padding: 12px 18px;
            border-radius: 10px;
            max-width: 75%;
            word-wrap: break-word;
            line-height: 1.4;
        }

        .ai-message {
            background-color: #e8f0fe;
            color: #333;
            border-bottom-left-radius: 0;
        }

        .user-message {
            background-color: #0083b0;
            color: white;
            margin-left: auto;
            border-bottom-right-radius: 0;
        }

        .chat-footer {
            padding: 15px;
            background-color: #fff;
            border-top: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #userInput {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            resize: none;
            height: 50px;
            transition: border-color 0.2s;
            overflow: auto;
        }

        #userInput:focus {
            border-color: #0083b0;
        }

        button {
            padding: 12px 20px;
            background-color: #00b4db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s;
            height: 50px;
        }

        button:hover {
            background-color: #0083b0;
        }

        .chat-body::-webkit-scrollbar {
            width: 8px;
        }

        .chat-body::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <h1>Arjun's AI</h1>
            <p>Your cosmic companion for answers and banter</p>
        </div>
        <div class="chat-body" id="chatBody">
            <?php
            if (empty($_SESSION['chat_history'])) {
                echo "<div class='message ai-message'><p>Hello! I'm Arjun's AI, built by Arjun. How can I assist you today?</p></div>";
            }

            foreach ($_SESSION['chat_history'] as $message) {
                $class = $message['type'] == 'user' ? 'user-message' : 'ai-message';
                echo "<div class='message $class'><p>" . htmlspecialchars($message['text']) . "</p></div>";
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $prompt = $_POST["userInput"];
                $api_key = "AIzaSyAJVOMKylQBRKeY6b479kJTuTJdV4Y0nkE";
                $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=$api_key";
                
                $_SESSION['chat_history'][] = [
                    'type' => 'user',
                    'text' => $prompt
                ];
                
                $data = [
                    "contents" => [
                        [
                            "parts" => [
                                ["text" => $prompt]
                            ]
                        ]
                    ]
                ];

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

                $response = curl_exec($ch);
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($http_code == 200) {
                    $result = json_decode($response, true);
                    $ai_response = $result['candidates'][0]['content']['parts'][0]['text'];
                    
                    $_SESSION['chat_history'][] = [
                        'type' => 'ai',
                        'text' => $ai_response
                    ];
                    
                    echo "<div class='message user-message'><p>" . htmlspecialchars($prompt) . "</p></div>";
                    echo "<div class='message ai-message'><p>" . htmlspecialchars($ai_response) . "</p></div>";
                } else {
                    $error_message = "Error: Failed to get response from AI.";
                    $_SESSION['chat_history'][] = [
                        'type' => 'ai',
                        'text' => $error_message
                    ];
                    echo "<div class='message ai-message'><p>$error_message</p></div>";
                }

                curl_close($ch);
            }
            ?>
        </div>
        <div class="chat-footer">
            <form id="chatForm" method="POST" style="display: flex; width: 100%; gap: 10px;">
                <textarea id="userInput" name="userInput" placeholder="Type your message..." style="flex: 1;"></textarea>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>

    <script>
        window.onload = function() {
            var chatBody = document.getElementById('chatBody');
            chatBody.scrollTop = chatBody.scrollHeight;
        };

        document.getElementById('chatForm').addEventListener('submit', function(e) {
            e.preventDefault();
            this.submit();
        });

        document.getElementById('userInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                document.getElementById('chatForm').submit();
            }
        });
    </script>
</body>
</html>
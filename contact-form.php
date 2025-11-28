<?php

require_once __DIR__ . '/config/database.php'; // ← conectare la DB



// 1. TOKEN + CHAT_ID – pune valorile tale reale
$telegramBotToken = "8477278946:AAEltqDkqTMm2TuN-44Sjk5kfndowvySvfI"; // ← token de la BotFather
$telegramChatId   = "-5009419859";                                     // ← chat.id din getUpdates

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 2. Citim câmpurile din formular
    $firstName   = trim($_POST["firstName"] ?? '');
    $lastName    = trim($_POST["lastName"] ?? '');
    $email       = trim($_POST["email"] ?? '');
    $phone       = trim($_POST["phone"] ?? '');
    $messageText = trim($_POST["message"] ?? '');

    $name = trim($firstName . " " . $lastName);

    // 3. Validare simplă
    if ($name === "" || $email === "" || $phone === "" || $messageText === "") {
        echo "error_validation";
        exit;
    }

    $stmt = $mysqli->prepare("
        INSERT INTO contact_form_requests (first_name, last_name, email, phone, message)
        VALUES (?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        error_log('Prepare failed: ' . $mysqli->error);
        echo 'db_error';
        exit;
    }

    $stmt->bind_param("sssss", $firstName, $lastName, $email, $phone, $messageText);

    if (!$stmt->execute()) {
        error_log('Execute failed: ' . $stmt->error);
        echo 'db_error';
        $stmt->close();
        exit;
    }

    $stmt->close();

    // 4. Textul care ajunge în Telegram
    $text  = "📩 <b>Mesaj nou de pe site</b>\n\n";
    $text .= "👤 <b>Nume:</b> {$name}\n";
    $text .= "📧 <b>Email:</b> {$email}\n";
    $text .= "📞 <b>Telefon:</b> {$phone}\n";
    $text .= "💬 <b>Mesaj:</b>\n{$messageText}\n";

    // 5. Trimitem cererea către Telegram cu file_get_contents (merge pe toate host-urile)
    $url = "https://api.telegram.org/bot{$telegramBotToken}/sendMessage";

    $postData = http_build_query([
        "chat_id"    => $telegramChatId,
        "text"       => $text,
        "parse_mode" => "HTML"
    ]);

    $options = [
        "http" => [
            "header"  => "Content-type: application/x-www-form-urlencoded\r\n",
            "method"  => "POST",
            "content" => $postData,
            "timeout" => 10
        ]
    ];

    $context  = stream_context_create($options);
    $result   = @file_get_contents($url, false, $context);

    if ($result === false) {
        // serverul nu a reușit să se conecteze la Telegram
        echo "error_request";
        exit;
    }

    $data = json_decode($result, true);

    if (isset($data["ok"]) && $data["ok"] === true) {
        // 6. Totul e ok – JS va vedea "success" și afișează mesajul verde
        echo "success";
    } else {
        // 7. Pentru debug, trimitem eroarea brută înapoi (o vezi în consola din browser)
        echo "error_api: " . $result;
    }

    exit;
}

// Dacă nu e POST:
echo "invalid_method";
exit;
?>
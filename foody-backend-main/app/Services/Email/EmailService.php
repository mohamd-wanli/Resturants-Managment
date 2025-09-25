<?php

namespace App\Services\Email;

use Illuminate\Support\Facades\Http;

class EmailService
{
    public static function sendHtmlEmail($recipientEmail, $companyName, $userCode, $userEmail, $userPassword)
    {
        $subject = 'Welcome to '.htmlspecialchars($companyName);
        $body = '
                <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f2f2f2;
                            margin: 0;
                            padding: 20px;
                        }
                        .container {
                            background-color: #ffffff;
                            padding: 20px;
                            border-radius: 5px;
                            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1>Welcome to Our Company</h1>
                        <p>Thank you for joining us ! Here are your credentials:</p>
                        <ul>
                            <li><strong>Code:</strong> '.htmlspecialchars($userCode).'</li>
                            <li><strong>Email:</strong> '.htmlspecialchars($userEmail).'</li>
                            <li><strong>Password:</strong> '.htmlspecialchars($userPassword).'</li>
                        </ul>
                    </div>
                </body>
                </html>
         ';
        $apiUrl = 'https://emailnotification.time.gomaplus.tech:7217/api/sender/';
        $apiKey = 'rm1GEVrZlW3HEgjR/CJjQRUYp3m7xoocfHlgW5SuNf2kyb1+1wPYQZUlycrkfZTMq0fuO5T1o+Tl0G0aWdhGp+f1Yd/JPmgGSi7UPCnzbMfqHOpt7H1WggMzq7lAP9Z9VAfQpdwkDD2HBY1F38n5qkex4V3jGCHq/YnNJC5mxt0=';

        $endpoint = 'htmlsend';
        $url = $apiUrl.$endpoint;

        $data = [
            'RecipientEmail' => $recipientEmail,
            'Subject' => $subject,
            'Body' => $body,
        ];

        $response = Http::withHeaders([
            'Api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->withOptions([
            'verify' => false,
        ])->post($url, $data);

        return $response->json();
    }
}

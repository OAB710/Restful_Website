<?php
function base64UrlEncode($data) {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
}

function createJWT($header, $payload, $secret) {
    // Encode Header to Base64Url String
    $base64UrlHeader = base64UrlEncode(json_encode($header));

    // Encode Payload to Base64Url String
    $base64UrlPayload = base64UrlEncode(json_encode($payload));

    // Create Signature Hash
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);

    // Encode Signature to Base64Url String
    $base64UrlSignature = base64UrlEncode($signature);

    // Create JWT
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

    return $jwt;
}

// Define the header
$header = [
    'alg' => 'HS256',
    'typ' => 'JWT'
];

// Define the payload
$payload = [
    'iss' => 'yourdomain.com',
    'aud' => 'yourdomain.com',
    'iat' => time(),
    'exp' => time() + (60 * 60),  // Token expires in 1 hour
    'userId' => 123,  // Example user ID
    'email' => 'user@example.com'  // Example user email
];

// Define your secret key
$secret = 'your-256-bit-secret';

// Create the JWT
$jwt = createJWT($header, $payload, $secret);

echo "Your JWT: " . $jwt;
?>

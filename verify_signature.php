<?php

$data = "billtanthowijauhari";

// fetch private key from file and ready it
$pkeyid = openssl_get_privatekey("file://private.pem");
$pubkey = openssl_get_publickey("file://public.pub");

// compute signature
openssl_sign($data, $signature, $pkeyid, OPENSSL_ALGO_SHA256);

echo "Signature : " . base64_encode($signature) . "\n";

$isValid = openssl_verify($data, $signature, $pubkey, OPENSSL_ALGO_SHA256) . "\n";

echo "\n Is Signature Valid ? " . (($isValid) ? "YES" : "NO")  . "\n";
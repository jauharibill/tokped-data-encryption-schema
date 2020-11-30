<?php

$data = "billtanthowijauhari";

// fetch private key from file and ready it
$pkeyid = openssl_get_privatekey("file://private.pem");
$pubkey = openssl_get_publickey("file://public.pub");

// create signature
openssl_sign($data, $signature, $pkeyid, OPENSSL_ALGO_SHA256);

// print signature in base64 mode
echo "Signature : " . base64_encode($signature) . "\n";

// verify signature
$isValid = openssl_verify($data, $signature, $pubkey, OPENSSL_ALGO_SHA256) . "\n";

echo "\n Is Signature Valid ? " . (($isValid) ? "YES" : "NO")  . "\n";
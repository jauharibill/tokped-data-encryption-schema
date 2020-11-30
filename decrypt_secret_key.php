<?php

$data = "billtanthowijauhari";

$pkeyid = openssl_get_privatekey("file://private.pem");
$pubkey = openssl_get_publickey("file://public.pub");

openssl_private_encrypt($data, $encrypted, $pkeyid, OPENSSL_PKCS1_PADDING);

echo "\nencrypted : " . base64_encode($encrypted) . "\n";

openssl_public_decrypt($encrypted, $decrypted, $pubkey, OPENSSL_PKCS1_PADDING);

echo "\ndecrypted : " . $decrypted . "\n";
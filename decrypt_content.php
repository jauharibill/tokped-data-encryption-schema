<?php

$plaintext = "message to be encrypted";
$cipher = "aes-128-gcm";
$key  = "secretkey";

if (in_array($cipher, openssl_get_cipher_methods()))
{
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
    echo "encrypted : " . $ciphertext."\n";
    //store $cipher, $iv, and $tag for decryption later
    $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv, $tag);
    echo "\ndecrypted : " . $original_plaintext."\n";
}
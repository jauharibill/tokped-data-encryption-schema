<?php 

// The version number (9_5_0) should match version of the Chilkat extension used, omitting the micro-version number.
// For example, if using Chilkat v9.5.0.48, then include as shown here:
    include("lib/chilkat_9_5_0.php");

    // This example requires the Chilkat API to have been previously unlocked.
    // See Global Unlock Sample for sample code.
    
    $pubkey = new CkPublicKey();

    // Load the public key object from the PEM. 
    $success = $pubkey->LoadFromFile("./public.pub");
    if ($success != true) {
        print $pubkey->lastErrorText() . "\n";
        exit;
    }

    // put your plain text here
    // $plainText = "bill tanthowi jauhari";

    // Build a small string to encrypt using json payload
    $json = new CkJsonObject();
    $json->UpdateString('example','123');
    $json->UpdateString('hello','world');
    $plainText = $json->emit();

    print "Original Text : " . $plainText . "\n";
    
    // This is the JSON to be RSA encrypted:  {"example":"123","hello":"world"}
    
    // IMPORTANT: RSA encryption is only used to encrypt small amounts of data.
    // RSA is only able to encrypt data to a maximum amount of your key size (2048 bits = 256 bytes) 
    // minus padding / header data (11 bytes for PKCS#1 v1.5 padding, 42 bytes for OAEP).
    // As a result it is often not possible to encrypt files with RSA directly. 
    // RSA is also not meant for this purpose. 
    // 
    // If you want to encrypt more data, you can use something like:
    // 1) Generate a 256-bit random keystring K
    // 2) Encrypt your data with AES-CBC with K
    // 3) Encrypt K with RSA
    // 4) Send both to the other side 
    
    $rsa = new CkRsa();
    $rsa->put_OaepPadding(true);
    $rsa->put_OaepHash('SHA-256');
    $rsa->ImportPublicKeyObj($pubkey);
    $rsa->put_EncodingMode('base64');
    
    // Note: The OAEP padding uses random bytes in the padding, and therefore each time encryption happens,
    // even using the same data and key, the result will be different --  but still valid.  One should not expect
    // to get the same output.
    $bUsePrivateKey = false;
    $encryptedStr = $rsa->encryptStringENC($plainText,$bUsePrivateKey);
    if ($rsa->get_LastMethodSuccess() != true) {
        print $rsa->lastErrorText() . "\n";
        exit;
    }
    
    print "\nEncrypted : " . $encryptedStr . "\n";


    // This step is used to decrypt rsa base64 string into plain text payload
    // The process should be
    // 1. load private key
    // 2. import private  key into rsa object
    // 3. decrypt base64 string using private key  
    // 4. print plain text

    $privatekey = new CkPrivateKey();
    $privatekey->LoadPemFile("./private.pem");

    $rsa = New CkRsa();
    $rsa->put_OaepPadding(true);
    $rsa->put_OaepHash('SHA-256');
    $rsa->ImportPrivateKeyObj($privatekey);

    $decryptedStr = $rsa->decryptStringENC($encryptedStr, true);

    print "\nDecrypted : " . $decryptedStr . "\n";
    
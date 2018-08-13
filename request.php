<?php
function calculate_signature($string, $private_key) {
    $hash = hash_hmac("sha1", $string, $private_key, true);
    $sig = rawurlencode(base64_encode($hash));
    return $sig;
}
?>
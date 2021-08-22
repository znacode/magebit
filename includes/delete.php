<?php

require 'init.php';

$conn = require 'db.php';

$address = new SubEmail();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address->id = $_POST['id'] ?? null;

    if (!$address->id) {
        Url::redirect("/magebit/email_addresses.php");
        exit;
    }

    if ($address->delete($conn)) {

        Url::redirect("/magebit/email_addresses.php");
    }
}

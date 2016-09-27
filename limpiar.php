<?php

if(empty(session_id()) && !isset($_SESSION)) {
    session_start();
}

print_r($_SESSION);
print_r($_POST);

unset($_SESSION['clases']);
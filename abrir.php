<?php

if(empty(session_id()) && !isset($_SESSION)) {
    session_start();
}

print_r($_POST);
print_r($_FILES);
print_r($_SESSION);
<?php

function authorized() {
    return isset($_SESSION['isAdmin']);
}

function deauthorize() {
    unset($_SESSION);
    session_destroy();
}

function authorize() {
    session_destroy();
    session_start();
    $_SESSION['isAdmin'] = true;
}
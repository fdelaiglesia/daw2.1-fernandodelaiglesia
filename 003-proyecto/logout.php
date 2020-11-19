<?php
require_once "_varios.php";
session_start();

session_unset();
session_destroy();
redireccionar("login.php");
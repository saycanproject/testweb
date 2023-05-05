<?php
session_start();

// Unset user session data and destroy the session
session_unset();
session_destroy();

// Redirect to index.php
header('Location: index.php');
exit;

<?php

session_start();
session_unset();
session_destroy();

header("Location: ../login.php");
exit();

//pure php does not need closing <?php tag.
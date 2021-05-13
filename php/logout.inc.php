<?php

session_start();
session_unset();
session_destroy();
header("location: ../cook.php?logoutSuccess");
exit();
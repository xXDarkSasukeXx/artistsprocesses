<?php
session_start();
require "init.php";
disconnected();
header("Location: ../public/index.php");

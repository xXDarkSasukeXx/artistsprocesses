<?php
session_start();
require "init.php";
disconnected();
header("Location: ../index.php");

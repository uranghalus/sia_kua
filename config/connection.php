<?php
defined("BASEPATH") or exit("No direct script access allowed");
include 'setting.php';
$connectdb = new mysqli($host, $user, $password, $dbname);

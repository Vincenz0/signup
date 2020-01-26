<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "loginsystemtut";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
  die("A kapcsolat nem jott letre: ".mysqli_connect_error());
}
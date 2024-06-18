<?php

$conn = mysqli_connect('127.0.0.1', 'root', 'root', 'webspp_212279');
if (!$conn) {
    throw new Exception("Database Gagal Terkoneksi", 1);
}

<?php

$conn = mysqli_connect('localhost','root','','crimedata');

if(!$conn)
{
    die('Connection Error');
}
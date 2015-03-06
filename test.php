<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'vars.php';

echo 'running';

$connection = mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) 
        or die(mysqli_connect_error());

if ($connection) {
    echo 'connected';
} else {
    echo 'never connected';
}

//$query = "INSERT INTO notes(content)VALUES('This is a test!')";

$query = 'SELECT * FROM notes';

$result = mysql_query($connection, $query)or die(mysqli_error($connection));

while ($row = mysqli_fetch_array($result)) {
    echo $row['content'];
}

if (mysqli_close($connection)) {
    echo 'database closed';
}


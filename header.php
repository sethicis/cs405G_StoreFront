<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function head($title){
    echo "
    <!DOCTYPE html>
    <html lang=\"en\">
    <head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    "
    //This line needs to be altered since the file paths won't be the same
    . "<link rel=\"shortcut icon\" href=\"ico/favicon.ico\">
    
    <title>" . $title . "</title>

    <!-- Bootstrap core CSS -->
    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">
    <style> 
        body { 
            padding-top: 60px; 
            } 
    </style>
    "
    . "</head>";
    error_reporting(E_ALL);

}

?>

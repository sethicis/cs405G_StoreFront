<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function head($title){
    /*echo '
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <title>' . $title . '</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <!-- Le styles -->
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>';*/
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

    <!-- Custom styles for this template -->
    <link href=\"starter-template.css\" rel=\"stylesheet\">

  </head>";
    error_reporting(E_ALL);

    /*<div class="container">

      <div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div>

    </div><!-- /.container -->*/

}

?>

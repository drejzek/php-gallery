<?php

    include '../config.php';

    if(empty($conn)){
        header('location: .');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!------ Include the above in your HEAD tag ---------->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
      Open source PHP Gallery
      </a>
    </div>
  </div>
</nav>

<div class="container">
    
    <div class="row">
        <div class="panel panel-primary col-sm-8 p-0" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Úvod</h3>
            </div>
            <div class="panel-body">
                <h3>Open source PHP Gallery</h3>
                <p>
                    Vítejte v instalačním průvodci pro Open source PHP Gallery. Pro instalaci a správný běh systému je zapotřebí mít připavenou MySQL nebo MariaDB databázi. V instalačním průvodci nastavíte připojení do databáze a další nastavení systému. Mimo jiné si zde také nastavíte uživatelský účet.
                </p>
                <hr>
                <h4>Instalací tohoto softwaru souhlasíte s následující licencí:</h4>
                <textarea name="" id="" readonly rows="21" cols="100">
                MIT License

                Copyright (c) 2024 David Rejzek

                Permission is hereby granted, free of charge, to any person obtaining a copy
                of this software and associated documentation files (the "Software"), to deal
                in the Software without restriction, including without limitation the rights
                to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
                copies of the Software, and to permit persons to whom the Software is
                furnished to do so, subject to the following conditions:

                The above copyright notice and this permission notice shall be included in all
                copies or substantial portions of the Software.

                THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
                SOFTWARE.</textarea>
                <br>
                <button class="btn btn-primary nextBtn pull-right" type="button">Další</button>
            </div>
        </div>
        <div class="panel panel-primary col-sm-4 p-0" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Úvod</h3>
            </div>
            <div class="panel-body">
                <h3>Open source PHP Gallery</h3>
                
            </div>
        </div>
    </div>
</div>
</body>
</html>

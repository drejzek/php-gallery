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
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Úvod</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Databáze</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Uživatel</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Další nastavení</small></p>
            </div>
        </div>
    </div>
    
    <form role="form" method="post" action="install.php">
        <div class="panel panel-primary setup-content" id="step-1">
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
        
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">Databáze</h3>
            </div>
            <div class="panel-body">
            <div class="form-group">
                    <label class="control-label">Adresa serveru:</label>
                    <input maxlength="200" type="text" required="required" class="form-control" name="databaseHost">
                </div>
                <div class="form-group">
                    <label class="control-label">Uživatelské jméno:</label>
                    <input maxlength="200" type="text" required="required" class="form-control" name="databaseUser">
                </div>
                <div class="form-group">
                    <label class="control-label">Heslo:</label>
                    <input maxlength="200" type="text" required="required" class="form-control" name="databasePassword">
                </div>
                <div class="form-group">
                    <label class="control-label">Název databáze:</label>
                    <input maxlength="200" type="text" required="required" class="form-control" name="databaseName">
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Další</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title">Uživatel</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Jméno:</label>
                    <input maxlength="200" type="text" required="required" class="form-control" name="userName">
                </div>
                <div class="form-group">
                    <label class="control-label">Uživatelské jméno:</label>
                    <input maxlength="200" type="text" required="required" class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label class="control-label">E-mail:</label>
                    <input maxlength="200" type="email" required="required" class="form-control" name="userEmail">
                </div>
                <div class="form-group">
                    <label class="control-label">Heslo:</label>
                    <input maxlength="200" type="password" required="required" class="form-control" name="userPassword">
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-4">
            <div class="panel-heading">
                 <h3 class="panel-title">Další nastavení</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Název galerie</label>
                    <input maxlength="200" type="text" required="required" class="form-control" name="galleryName">
                </div>
                <div class="form-group">
                    <label class="control-label">URL adresa galerie</label>
                    <input maxlength="200" type="text" required="required" class="form-control" name="galleryURL">
                </div>
                <div class="form-group">
                    <label class="control-label">Popis</label>
                    <textarea maxlength="200" type="text" required="required" class="form-control" name="galleryDescr"></textarea>
                </div>
                <button class="btn btn-success pull-right" type="submit" name="submit">Finish!</button>
            </div>
        </div>
    </form>
</div>
<script src="script.js"></script>
</body>
</html>

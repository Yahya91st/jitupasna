<?php require 'vendor/autoload.php'; require 'bootstrap/app.php'; \ = app(); \ = \->make('db')->select('SHOW TABLES'); print_r(\);

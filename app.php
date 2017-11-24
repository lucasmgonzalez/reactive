<?php

// Kickstart my heart
require 'kickstarter.php';

// Booting server
$server = Reactive\Server\Server::getInstance();
$server->run();

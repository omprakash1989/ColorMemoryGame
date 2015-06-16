<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'helpers/function.php';
include_once 'lib/QueryHandler.php';
include_once 'ScoreHandler.php';
include_once 'getConfig.php';
$query_handler = new QueryHandler();
$query_handler->createConnection(DBHOST, DBUSER, DBPASSWORD, 'memory_game');
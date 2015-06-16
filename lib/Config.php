<?php

/**
 * Config.php
 *
 * Config file for this application.
 * Also Create the connetion with the database for further handling.
 * @author Om Prakash <oppradhan2011@gmail.com>
 * @copyright (c) 2015, Om Prakash
 */

include_once 'helpers/function.php';
include_once 'lib/QueryHandler.php';
include_once 'ScoreHandler.php';
include_once 'getConfig.php';
$query_handler = new QueryHandler();
$query_handler->createConnection(DBHOST, DBUSER, DBPASSWORD, 'memory_game');
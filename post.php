<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    die('Du musst dich zuerst <a href="login.php">einloggen</a>!');
}






/**
 * Created by PhpStorm.
 * User: cpnik
 * Date: 16.05.2017
 * Time: 10:48
 */

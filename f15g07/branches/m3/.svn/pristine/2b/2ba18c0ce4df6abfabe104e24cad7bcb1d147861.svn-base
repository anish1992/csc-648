<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'includes/config.php';
$input = filter_input(INPUT_POST, 'input');


switch ($input) {
    case 1 : $location = "SF Bay Area";
        break;
    case 2 : $location = "New York City";
        break;
    case 3 : $location = "Chicago";
        break;
    case 4 : $location = "Houston";
        break;
    case 5 : $location = "toronto";
        break;
}

$location = $_SESSION['location'];


header("Location: restaurant.php?v={$location}");
?>
<?php
require_once './vendor/autoload.php';
use App\BoardingCardManager;

$boardingCardManager = new BoardingCardManager('entry.php');
$boardingCardManager->sortBoardingCard();
<?php

namespace App;

use Exception;

class BoardingCardManager
{
    private $boardingCards;
    
    public function __construct(string $file)
    {
        $fileExploded = explode('.', $file);
        $extension = end($fileExploded);
        switch ($extension) {
            case 'json':
                $this->setBoardingCards(json_decode(file_get_contents($file), true));
                break;
            case 'php':
                $this->setBoardingCards(require_once $file);
                break;
            default:
                throw new Exception('File format not supported');
                break;
        }
    }

    public function sortBoardingCard()
    {
        $sortedBoardingCards = [];
        $cardMap = [];

        // Construire une carte de correspondance pour les destinations
        foreach ($this->getBoardingCards() as $card) {
            $cardMap[$card['from']] = $card;
            $cardMap['from'][] = $card['from'];
            $cardMap['to'][] = $card['to'];
        }

        // Trouver le point de départ
        $start = null;
        foreach ($cardMap['from'] as $from) {
            if (in_array($from, $cardMap['to']) === false) {
                $start = $cardMap[$from];
                break;
            }
        }

        // Tri des cartes d'embarquement
        $sortedBoardingCards[] = $start;
        while (isset($cardMap[end($sortedBoardingCards)['to']])) {
            $sortedBoardingCards[] = $cardMap[end($sortedBoardingCards)['to']];
        }

        // Afficher la liste triée
        foreach ($sortedBoardingCards as $key => $boardingCard) {
            switch ($boardingCard['type']) {
                case 'plane':
                    echo 'From ' . $boardingCard['from'] . ', take flight ' . $boardingCard['reference'] . ' to ' . $boardingCard['to'] . '. Gate ' . $boardingCard['gate'] . ', seat ' . $boardingCard['seat'] . '.';
                    if ($boardingCard['transfer']) {
                        echo ' Baggage will we automatically transferred from your last leg.';
                    }else{
                        echo ' You\'ll need to register your baggage at the ticket counter';
                    }
                    break;
                case 'train':
                    echo 'Take train ' . $boardingCard['reference'] . ' from ' . $boardingCard['from'] . ' to ' . $boardingCard['to'] . '. Sit in seat ' . $boardingCard['seat'] . '.';
                    break;
                case 'bus':
                    echo 'Take the bus ' . $boardingCard['reference'] . ' from ' . $boardingCard['from'] . ' to ' . $boardingCard['to'] . '. ' . ($boardingCard['seat'] !== '' ? 'Sit in seat ' . $boardingCard['seat'] . '.' : 'No seat assignment.');
                    break;
            }
            echo '<br>';
        }
    }

    /**
     * Get the value of boardingCards
     */ 
    public function getBoardingCards()
    {
        return $this->boardingCards;
    }

    /**
     * Set the value of boardingCards
     *
     * @return  self
     */ 
    public function setBoardingCards($boardingCards)
    {
        $this->boardingCards = $boardingCards;

        return $this;
    }
}
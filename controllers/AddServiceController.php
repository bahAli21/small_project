<?php

class AddServiceController
{
    private $Services;
    public array $Data;
    public $method;

    public function __construct(Services $Services, $method)
    {
        $this->method = $method;
        $this->Services = $Services;
        $this->initializeData();
    }

    private function initializeData()
    {
          $this->Data = [
                            "IS" => $this->Services->insertService(
                                $this->method['libelle'],
                                $this->method['description'],
                                $this->method['tarif'],
                                $this->method['dateDebut'],
                                $this->method['dateFin']
                            ),
                            "IIPT" => $this->Services->insertionInProposeTab(
                                $this->method['option']
                            ),
                          ];

    }
}

$Servi = new Services();
$AddServiceController = new AddServiceController($Servi, $_POST);
$ServicesData = $AddServiceController->Data;
$bool = $ServicesData['IS'];
$bool2 = $ServicesData['IIPT'];

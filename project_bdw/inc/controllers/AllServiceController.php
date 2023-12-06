<?php

class AllServiceController
{
    private $Services;
    public array $Data;

    public function __construct(Services $Services)
    {
        $this->Services = $Services;
        $this->initializeData();
    }

    private function initializeData()
    {

        $this->Data = [
            "GAS" => $this->Services->getAllServices(),
        ];
    }
}

$Servi = new Services();
$AllServicesController = new AllServiceController($Servi);
$allServicesData = $AllServicesController->Data;

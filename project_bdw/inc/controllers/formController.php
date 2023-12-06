<?php

class Form
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
            "GAC" => $this->Services->getAllCommunes(),
        ];
    }
}

$Servi = new Services();
$Form = new Form($Servi);
$Form = $Form->Data;

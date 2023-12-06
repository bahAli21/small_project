<?php

class StatsController
{
    private $stats;
    public array $Data;

    public function __construct(Stats $stats)
    {
        $this->stats = $stats;
        $this->initializeData();
    }

    private function initializeData()
    {
        $tables = ['enfant', 'ecole', 'cantine'];

        $this->Data = [
            "instance" => $this->stats->getInstances($tables),
            "child" => [
                "CWCS" => $this->stats->getChildrenWithCurrentSchool(),
                "CWCFD" => $this->stats->getChildrenWithCantineForDate(),
                "CWSNIDS" => $this->stats->getChildrenWithSameNameInDifferentSchools(),
            ],

            "top3" => [
                "T3DWMC" => $this->stats->getTop3DepartementsWithMostCommunes(),
                "T3MRS" => $this->stats->getTop3MostRequestedServices(),
                "T3CWMU" => $this->stats->getTop3CommunesWithMostUnions(),
                "T3MOS" =>$this->stats->getTop3MostOfferedServices(),
            ],
        ];
    }
}

$stats = new Stats();
$statsController = new StatsController($stats);
$statsData = $statsController->Data;

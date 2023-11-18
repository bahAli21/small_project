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
        $tables = ['Enfant', 'Ecole', 'Cantine'];

        $this->Data = [
            "instances" => $this->stats->getInstances($tables),
            "child" => [
                "CWCS" => $this->stats->getChildrenWithCurrentSchool(),
                "CWCFD" => $this->stats->getChildrenWithCantineForDate('2024-01-01'),
                "CWSNIDS" => $this->stats->getChildrenWithSameNameInDifferentSchools(),
            ],

            "top3" => [
                "T3DWMC" => $this->stats->getTop3DepartementsWithMostCommunes(),
                "T3MRS" => $this->stats->getTop3MostRequestedServices(),
                "T3CWMU" => $this->stats->getTop3CommunesWithMostUnions(),
            ],
        ];
    }
}

// Assuming $statsData is still used later in your application
$stats = new Stats();
$statsController = new StatsController($stats);
$statsData = $statsController->Data;

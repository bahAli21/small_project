<!-- <?php

class Essaie_Controller
{
    private $Essaie;
    public array $Data;

    public function __construct(Essaie $Essaie)
    {
        $this->Essaie = $Essaie;
        $this->initializeData();
    }

    private function initializeData()
    {

        $this->Data = [
            "GAD" => $this->Essaie->getAllDepartement(),
        ];
    }
}

$essaie = new Essaie();
$AllDepartController = new Essaie_Controller($essaie);
$AllDepartController = $AllDepartController->Data;

<?php

class P_Essaie
{
    private $Essaie;
    public array $periodeEssai = [];

    public function __construct(Essaie $Essaie)
    {
        $this->Essaie = $Essaie;
         $i = 0;
        if($i == 0) {
          $this->initializeData();
          $i+=1;
        }

    }

    private function initializeData()
    {
        if($this->Essaie->generatePeriods($_POST['option'], $_POST['nbMois'], $_POST['kilometre'])) {
            $this->periodeEssai = $this->Essaie->getPeriodeEssaie();
        } else {
            echo "Échec de la génération des périodes.";
        }
    }
}


$essaie = new Essaie();
$P_Essaie = new P_Essaie($essaie);
$periode = $P_Essaie->periodeEssai;

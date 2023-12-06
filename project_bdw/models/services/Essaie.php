<?php

class Essaie {
    private $conn;

    public function __construct() {
        $this->conn = (new Database)->getConnexion();
    }

    public function getService(int $nb): array {
      $listeService = ['signalement', 'scolaire', 'election', 'Restauration', 'Unions'];
      $serviceChoosed = [];

      for ($i = 0; $i < $nb; $i++) {
          $randomKey = array_rand($listeService);
          $serviceChoosed[] = $listeService[$randomKey];
          // Supprimons l'élément sélectionné pour ne pas le répéter.
          unset($listeService[$randomKey]);
      }

      return $serviceChoosed;
  }


    public function generatePeriods($departement, $maxMonths, $maxDistance) {
        try {
            $nbCommunes = $this->getRandomNBCommunes();
            $communesListes = $this->getCommuneByDepartement($departement);
            $communeChoosed = [];

            $communeBASE = $communesListes[0];
            $generatedPeriod = [];
            $servicesChoosed = [];

            for ($i = 1; $i < $nbCommunes; ++$i) {
                $duration = $this->getRandomDuration($maxMonths);
                $servicesChoosed = $this->getService($this->getRandomService());
                $currentCommune = $communesListes[$i];

                $distanceQuery = "SELECT ST_Distance(POINT(?, ?), POINT(?, ?)) AS distance";
                $stmt = $this->conn->prepare($distanceQuery);
                $stmt->execute([
                    $communeBASE['Latitude'],
                    $communeBASE['Longitude'],
                    $currentCommune['Latitude'],
                    $currentCommune['Longitude']
                ]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $distance = $result['distance'];

                if ($distance <= $maxDistance) {
                    $communeChoosed[] = $currentCommune;
                    $listDuree[] = $duration;
                }
            }

            if (empty($servicesChoosed) || empty($communeChoosed)) {
                echo "Aucun service ou commune choisi. Veuillez vérifier vos données ou paramètres.";
                return false;
            }

            $generatedPeriod = [
                "S" => $servicesChoosed,
                "C" => $communeChoosed,
                "D" => $listDuree
            ];

            $serializedServiceList = serialize($generatedPeriod['S']);
            $serializedCommuneList = serialize($generatedPeriod['C']);
            $Duration = serialize($generatedPeriod['D']);

            $sql = "INSERT INTO periodeessai (departement, serviceList, communeList, duree)
                VALUES (?, ?, ?, ?)";
            $statement = $this->conn->prepare($sql);
            $statement->execute([$departement, $serializedServiceList, $serializedCommuneList, $Duration]);

            return true;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }


  public function getPeriodeEssaie(): array {
      // Récupération des données depuis la base de données
      $sql = "SELECT departement, serviceList, communeList, duree FROM periodeessai";
      $statement = $this->conn->prepare($sql);
      $statement->execute();

      // Désérialisation des données
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);

      $periodeEssaie = [];

      foreach ($results as $result) {
          $periodeEssaie[] = [
              "S" => unserialize($result['serviceList']),
              "C" => unserialize($result['communeList']),
              "D" => unserialize($result['duree'])
          ];
      }

      return $periodeEssaie;
  }





// La durée de chaque période d’essai est sélectionnée aléatoirement parmi 3, 4 ou 6 mois ;

  private function getRandomDuration($maxMonths): int {
    do {
         $var = rand(1, 3);
         if ($var === 1) {
             $var = 3;
         } elseif ($var === 2) {
             $var = 4;
         } elseif ($var === 3) {
             $var = 6;
         }
    } while ($var > $maxMonths);

    return $var;
  }


  private function getRandomService(): int {
    $var = rand(3, 5);
    return $var;
}


   // Le nombre de communes est sélectionné aléatoirement entre 5 et 20 ;

     private function getRandomNBCommunes(): int {
         return rand(5, 20);
     }

    //liste de tous les departements

    public function getAllDepartement(): array {
      $sql = "SELECT nomD
              FROM departement
              ORDER BY nomD ASC" ;
      $statement = $this->conn->prepare($sql);
      $statement->execute();

      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommuneByDepartement($departement): array {
      $sql = "SELECT c.idC, c.Latitude, c.Longitude, c.nomC
              FROM commune c
              JOIN departement d ON d.CodeINSEED = c.CodeINSEED
              WHERE d.nomD = ?
              ORDER BY nomC ASC" ;
      $statement = $this->conn->prepare($sql);
      $statement->execute([$departement]);

      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}

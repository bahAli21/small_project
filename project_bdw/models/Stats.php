<?php

class Stats
{
    private $conn;
    public function __construct() {
        $this->conn = (new Database)->getConnexion();
    }

    /**
     * @param array $tables
     * @return int
     */
    public function getInstances(array $tables): int {
        $data = array();
        $sql = "SELECT COUNT(*) FROM %s";

        foreach ($tables as $table) {
            $cleanTable = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // Nettoyons le nom de la table pour éviter l'injection SQL
            $query = sprintf($sql, $cleanTable);

            $statement = $this->conn->prepare($query);
            $statement->execute();
            $data[] = $statement->fetchColumn();
        }

        return array_sum($data);
    }

    public function getChildrenWithCurrentSchool(): array {
        $sql = "SELECT nomE,ecole.idEcole as Ecole
                  FROM ecole
                  INNER JOIN enfant
                  ON ecole.idEcole=enfant.idEcole";

        $statement = $this->conn->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChildrenWithCantineForDate(): array {
        $sql = "SELECT nomE,nomCantine
                FROM mange
                JOIN enfant
                ON mange.idEnfant=enfant.idEnfant
                JOIN cantine
                ON cantine.idCantine=mange.idCantine";

        $statement = $this->conn->prepare($sql);
        //$statement->bindParam(':date', $date, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChildrenWithSameNameInDifferentSchools(): array {
    $sql = "SELECT DISTINCT p1.nomE, p1.prenom
            FROM enfant p1, enfant p2
            WHERE p1.nomE = p2.nomE AND p1.prenom = p2.prenom AND p1.idEcole != p2.idEcole";

    $statement = $this->conn->prepare($sql);
    // Pas de paramètres dans cette requête, donc pas besoin de bindParam
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

    public function getTop3DepartementsWithMostCommunes(): array {
    $sql = "SELECT departement.nomD, COUNT(commune.CodeINSEED) as nb
            FROM departement
            LEFT OUTER JOIN commune ON commune.CodeINSEED = departement.CodeINSEED
            GROUP BY departement.CodeINSEED
            ORDER BY nb DESC LIMIT 3";

    $statement = $this->conn->prepare($sql);
    // Pas de paramètres dans cette requête, donc pas besoin de bindParam
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }


      public function getTop3MostRequestedServices(): array {
      $sql = "SELECT service.libelle, COUNT(demande.idService) as nb
              FROM demande
              LEFT OUTER JOIN service ON demande.idService = service.idService
              GROUP BY demande.idService
              ORDER BY nb DESC
              LIMIT 3";

      $statement = $this->conn->prepare($sql);
      $statement->execute();
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getTop3MostOfferedServices() {
    $sql = "SELECT service.libelle, COUNT(propose.idService) as nb
            FROM propose
            LEFT OUTER JOIN demande ON demande.idService = propose.idService
            LEFT OUTER JOIN service ON demande.idService = service.idService
            GROUP BY propose.idService
            ORDER BY nb DESC
            LIMIT 3";

    $statement = $this->conn->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
   }


    public function getTop3CommunesWithMostUnions() {
        $sql = "SELECT c.idC, c.nomC, COUNT(u.idUnion) AS NombreUnions
                FROM `commune` c
                JOIN `union` u ON c.idC = u.id_Comm
                GROUP BY c.idC, c.nomC
                ORDER BY NombreUnions DESC
                LIMIT 3
                ";

        $statement = $this->conn->query($sql);
           $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}

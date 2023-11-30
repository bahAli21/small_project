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
                FROM enfant p1 ,enfant p2
                WHERE p1.nomE =p2.nomE AND p1.prenom =p2.prenom AND p1.idEcole !=p2.idEcole";

        $statement = $this->conn->prepare($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop3DepartementsWithMostCommunes(): array {
        $sql = "SELECT Departement.nomD, COUNT(Commune.CodeINSEED) as nb
                FROM Departement
                LEFT OUTER JOIN Commune
                ON Commune.CodeINSEED=Departement.CodeINSEED
                GROUP BY Departement.CodeINSEED
                ORDER BY nb DESC LIMIT 3";

        $statement = $this->conn->prepare($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop3MostRequestedServices(): array {
        $sql = "SELECT service.libéllé, COUNT(demande.idService) as nb
                FROM demande
                LEFT OUTER JOIN propose ON demande.idService = propose.idService
                LEFT OUTER JOIN service ON demande.idService = service.idService
                GROUP BY demande.idService, service.libéllé
                ORDER BY nb DESC
                LIMIT 3";

        $statement = $this->conn->prepare($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop3MostOfferedServices() {
        // $sql = "SELECT service.Libelle, COUNT(propose.idService) AS nombre_propositions
        //         FROM service
        //         LEFT JOIN propose ON service.idService = propose.idService
        //         GROUP BY service.idService
        //         ORDER BY nombre_propositions DESC
        //         LIMIT 3";
        //
        // $statement = $this->conn->query($sql);
        //
        // return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop3CommunesWithMostUnions() {
        // $sql = "SELECT commune.nom, COUNT(unionCivile.idLieu) AS nombre_unions
        //         FROM commune
        //         LEFT JOIN unionCivile ON commune.idComm = unionCivile.idLieu
        //         GROUP BY commune.idComm
        //         ORDER BY nombre_unions DESC
        //         LIMIT 3";
        //
        // $statement = $this->conn->query($sql);
        //
        // return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}

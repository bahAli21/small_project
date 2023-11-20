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
        $sql = "SELECT enfant.nom, enfant.prenom, ecole.adresse AS ecole_actuelle
                FROM Enfant
                JOIN Ecole ON Enfant.idEcole = Ecole.idEcole";

        $statement = $this->conn->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChildrenWithCantineForDate(): array {
        $sql = "SELECT
                    enfant.nom AS NomEnfant,
                    enfant.prenom AS PrenomEnfant,
                    cantine.nom AS NomCantine
                FROM
                    enfant
                JOIN
                    fréquente ON enfant.idEnfant = fréquente.idEnfant
                JOIN
                    cantine ON fréquente.idCant = cantine.idCant
                JOIN
                    mange ON enfant.idEnfant = mange.idEnfant
                JOIN
                    repas ON mange.idRepas = repas.idRepas
                WHERE
                    repas.dateR = '2023-01-01'";

        $statement = $this->conn->prepare($sql);
        //$statement->bindParam(':date', $date, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChildrenWithSameNameInDifferentSchools(): array {
        $sql = "SELECT DISTINCT A.nom, A.prenom, A.idEcole AS ecole_A, B.idEcole AS ecole_B
                FROM enfant A, enfant B
                WHERE A.nom = B.nom AND A.prenom = B.prenom AND A.idEcole != B.idEcole";

        $statement = $this->conn->query($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop3DepartementsWithMostCommunes(): array {
        $sql = "SELECT departement.nom, COUNT(commune.idComm) AS nombre_communes
                FROM departement
                LEFT JOIN commune ON departement.codeINSEED = commune.codeINSEED
                GROUP BY departement.codeINSEED
                ORDER BY nombre_communes DESC
                LIMIT 3";

        $statement = $this->conn->query($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop3MostRequestedServices(): array {
        $sql = "SELECT service.Libelle, COUNT(demand.idDemande) AS nombre_demandes
                FROM service
                LEFT JOIN demand ON Service.idDemande = demand.idDemande
                GROUP BY service.idDemande
                ORDER BY nombre_demandes DESC
                LIMIT 3";

        $statement = $this->conn->query($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop3MostOfferedServices(): array {
        $sql = "SELECT service.Libelle, COUNT(propose.idService) AS nombre_propositions
                FROM service
                LEFT JOIN propose ON service.idService = propose.idService
                GROUP BY service.idService
                ORDER BY nombre_propositions DESC
                LIMIT 3";

        $statement = $this->conn->query($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTop3CommunesWithMostUnions(): array {
        $sql = "SELECT commune.nom, COUNT(unionCivile.idLieu) AS nombre_unions
                FROM commune
                LEFT JOIN unionCivile ON commune.idComm = unionCivile.idLieu
                GROUP BY commune.idComm
                ORDER BY nombre_unions DESC
                LIMIT 3";

        $statement = $this->conn->query($sql);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}

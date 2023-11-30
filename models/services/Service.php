<?php

class Service
{
    private $conn;
    public function __construct() {
        $this->conn = (new Database)->getConnexion();
    }

    public function getAllCommunes(): array {
      $sql = "SELECT nomC, idC
              FROM commune
              ORDER BY nomC ASC" ;
      $statement = $this->conn->prepare($sql);
      $statement->execute();

      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertService($libelle, $descriptions, $decisionTarif, $Periode_ouverture, $Periode_fermeture): bool {
      try {
          $sql = "INSERT INTO service (libelle, descriptions, decisionTarif, Periode_ouverture, periode_fermeture)
                  VALUES (:libelle, :descriptions, :decisionTarif, :periodeOuverture, :periodeFermeture)";
          $statement = $this->conn->prepare($sql);

          $statement->bindParam(':libelle', $libelle);
          $statement->bindParam(':descriptions', $descriptions);
          $statement->bindParam(':decisionTarif', $decisionTarif);
          $statement->bindParam(':periodeOuverture', $Periode_ouverture);
          $statement->bindParam(':periodeFermeture', $Periode_fermeture);

          $statement->execute();

          // Vérifie le nombre de lignes affectées pour déterminer le succès de l'opération
          $rowCount = $statement->rowCount();

          return $rowCount > 0; // Retourne true si au moins une ligne a été insérée
      } catch (PDOException $e) {

          echo "Erreur d'insertion : " . $e->getMessage();
          return false; // Retourne false en cas d'échec de l'insertion
      }
  }

  public function insertionInProposeTab($idC, $idService): bool {
    try {
        $sql = "INSERT INTO propose (idC, idService) VALUES (?, ?)";
        $statement = $this->conn->prepare($sql);

        $result = $statement->execute([$idC, $idService]);

        return $result;
    } catch (PDOException $e) {
        error_log("Erreur d'insertion : " . $e->getMessage());

        return false;
    }
 }

 public function getServiceID($service) {
    try {
        $sql = "SELECT idService FROM Service WHERE libelle = ?";
        $statement = $this->conn->prepare($sql);
        $statement->execute([$service]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result["idService"];
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération de l'ID du service : " . $e->getMessage());

        return false;
    }
 }

 public function getAllServices(): array {
   $sql = "SELECT *
           FROM service
           ORDER BY idService ASC" ;
   $statement = $this->conn->prepare($sql);
   $statement->execute();

   return $statement->fetchAll(PDO::FETCH_ASSOC);
 }

}

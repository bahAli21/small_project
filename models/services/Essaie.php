<?php

class PeriodGenerator {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function generatePeriods($departement, $maxMonths, $maxDistance) {
        try {
            $communes = $this->getRandomCommunes($departement, $maxDistance);

            $generatedPeriods = [];

            foreach ($communes as $commune) {
                $duration = $this->getRandomDuration();
                $numServices = $this->getRandomNumberOfServices();

                if ($maxMonths !== null && array_sum(array_column($generatedPeriods, 'duration')) + $duration > $maxMonths) {
                    continue;
                }

                $this->storeInDatabase($commune['commune'], $duration, $numServices);

                $generatedPeriods[] = [
                    'commune' => $commune['commune'],
                    'duration' => $duration,
                    'numServices' => $numServices,
                ];
            }

            return $generatedPeriods;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    private function getRandomCommunes($departement, $maxDistance) {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM communes
            WHERE departement = :departement
              AND (
                :maxDistance IS NULL OR
                earth_distance_km(latitude, longitude, :targetLatitude, :targetLongitude) <= :maxDistance
              )
        ");

        $stmt->bindParam(':departement', $departement);

        if ($maxDistance !== null) {
            $targetLatitude = $this->getRandomLatitude();
            $targetLongitude = $this->getRandomLongitude();

            $stmt->bindParam(':maxDistance', $maxDistance);
            $stmt->bindParam(':targetLatitude', $targetLatitude);
            $stmt->bindParam(':targetLongitude', $targetLongitude);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getRandomLatitude() {

    }

    private function getRandomLongitude() {

    }

// La durée de chaque période d’essai est sélectionnée aléatoirement parmi 3, 4 ou 6 mois ;

    private function getRandomDuration(): int {
        int $var = rand(1, 3);

        if($var === 1) return 3;
        if($var === 2) return 4;
        return 6;
    }

   // Le nombre de communes est sélectionné aléatoirement entre 5 et 20 ;

    private function getRandomNBCommunes() {
        return rand(5, 20);
    }

// Le nombre de services de chaque période d’essai est sélectionné aléatoirement entre 3 et 5 (inclus).

    private function getRandomNumberOfServices() {
        return rand(3, 5);
    }

    private function storeInDatabase($commune, $duration, $numServices) {
        $stmt = $this->conn->prepare("INSERT INTO periods (commune, duration, numServices) VALUES (:commune, :duration, :numServices)");
        $stmt->bindParam(':commune', $commune);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':numServices', $numServices);
        $stmt->execute();
    }
}

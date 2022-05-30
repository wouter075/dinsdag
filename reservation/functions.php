<?php
    // de tabel voor de reserveringen ziet er zo uit:

    // table name: reservation
    // id: int, primary key + auto increment
    // customer_id: int
    // persons: int
    // date: datetime


    // dit is een voorbeeld van een join
    function reservationList($pdo) {
        try {
            $stmt = $pdo->prepare("SELECT reservation.id, reservation.persons, reservation.date, customer.name, customer.email, customer.phone FROM customer INNER JOIN reservation ON reservation.customer_id=customer.id ORDER BY reservation.date ASC ");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        } catch (PDOException $e) {
            return $e;
        }
    }

    function createReservation($pdo, $name, $date, $time, $persons) {
        $time_stamp = $date . " " . $time;
        try {
            $stmt = $pdo->prepare("INSERT INTO reservation (customer_id, persons, date) VALUES (?, ?, ?)");
            $stmt->execute([$name, $persons, $time_stamp]);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            return $e;
        }
    }

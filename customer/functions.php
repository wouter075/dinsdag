<?php
    // CRUD
    // Create
    // Read
    // Update
    // Delete
    // customer / functions.php

    function customerList($pdo) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM customer");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        } catch (PDOException $e) {
            return $e;
        }
    }

    function createCustomer($pdo, $name, $email, $phone) {
        try {
            $stmt = $pdo->prepare("INSERT INTO customer (name, email, phone) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $phone]);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            return $e;
        }
    }

    function deleteCustomer($pdo, $id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM customer WHERE id = ?");
            $stmt->execute([$id]);
            return $id;
        } catch (PDOException $e) {
            return $e;
        }
    }

    function readCustomer($pdo, $id) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM customer WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e;
        }
    }

    function updateCustomer($pdo, $id, $name, $email, $phone) {
        try {
            $stmt = $pdo->prepare("UPDATE customer SET name = ?, email = ?, phone = ? WHERE id = ?");
            $stmt->execute([$name, $email, $phone, $id]);
            return $id;
        } catch (PDOException $e) {
            return $e;
        }
    }

<?php

class Reminder {

    // get all reminders for user
    public function getUserReminders($username) {
        try {
            $db = db_connect();
            $statement = $db->prepare("SELECT * FROM reminders WHERE username = :username ORDER BY created_at DESC");
            $statement->bindValue(':username', strtolower($username));
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Failed to get reminders: " . $e->getMessage());
            return [];
        }
    }

}
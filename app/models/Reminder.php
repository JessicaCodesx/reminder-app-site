<?php

class Reminder {
    /*
    DATABASE TABLE CREATED WITH:

    CREATE TABLE IF NOT EXISTS reminders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    due_date DATE NULL,
    completed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- Foreign key constraint
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,

    -- Indexes for performance
    INDEX idx_user_id (user_id),
    INDEX idx_user_id_completed (user_id, completed),
    INDEX idx_due_date (due_date)
);
    */

    // get all reminders for user (read)
    public function getUserReminders($user_id) {
        try {
            $db = db_connect();
            $statement = $db->prepare("SELECT * FROM reminders WHERE user_id = :user_id ORDER BY created_at DESC");
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Failed to get reminders: " . $e->getMessage());
            return [];
        }
    }

    // add a new reminder (create)
    public function createReminder($user_id, $title, $description, $due_date = null) {
        try {
            $db = db_connect();
            $statement = $db->prepare("INSERT INTO reminders (user_id, title, description, due_date, created_at) VALUES (:user_id, :title, :description, :due_date, NOW())");
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':due_date', $due_date);

            return $statement->execute();
        } catch (PDOException $e) {
            error_log("Failed to create reminder: " . $e->getMessage());
            return false;
        }
    }

    // get a specific reminder by id
    public function getReminder($id, $user_id) {
        try {
            $db = db_connect();
            $statement = $db->prepare("SELECT * FROM reminders WHERE id = :id AND user_id = :user_id");
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Failed to get reminder: " . $e->getMessage());
            return false;
        }
    }

    // delete a reminder (delete)
    public function deleteReminder($id, $user_id) {
        try {
            $db = db_connect();
            $statement = $db->prepare("DELETE FROM reminders WHERE id = :id AND user_id = :user_id");
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

            return $statement->execute();
        } catch (PDOException $e) {
            error_log("Failed to delete reminder: " . $e->getMessage());
            return false;
        }
    }

    // update a reminder (update)
    public function updateReminder($id, $user_id, $title, $description, $due_date = null) {
        try {
            $db = db_connect();
            $statement = $db->prepare("UPDATE reminders SET title = :title, description = :description, due_date = :due_date WHERE id = :id AND user_id = :user_id");
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':due_date', $due_date);

            return $statement->execute();
        } catch (PDOException $e) {
            error_log("Failed to update reminder: " . $e->getMessage());
            return false;
        }
    }

    // toggle completion status
    public function toggleComplete($id, $user_id) {
        try {
            $db = db_connect();
            $statement = $db->prepare("UPDATE reminders SET completed = NOT completed WHERE id = :id AND user_id = :user_id");
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

            return $statement->execute();
        } catch (PDOException $e) {
            error_log("Failed to toggle reminder: " . $e->getMessage());
            return false;
        }
    }
}
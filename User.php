<?php
require_once 'Database.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function emailExists($email, $excludeId = null) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        if ($excludeId) {
            $sql .= " AND id != :excludeId";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        if ($excludeId) {
            $stmt->bindParam(':excludeId', $excludeId);
        }
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function create($fullName, $email, $password) {
        if ($this->emailExists($email)) {
            return "Este email já está cadastrado!";
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (full_name, email, password) VALUES (:full_name, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':full_name', $fullName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            return "Usuário cadastrado com sucesso!";
        } else {
            return "Erro ao cadastrar usuário.";
        }
    }

    public function getAll() {
        $sql = "SELECT id, full_name, email FROM users";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT id, full_name, email FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $fullName, $email, $password) {
        if ($this->emailExists($email, $id)) {
            return "Erro: O email já está cadastrado.";
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET full_name = :full_name, email = :email, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':full_name', $fullName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return "Usuário atualizado com sucesso!";
        } else {
            return "Erro ao atualizar usuário.";
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
?>

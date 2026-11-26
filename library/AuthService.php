<?php
require_once 'db.php';

class AuthService {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    public function authenticateUser($nationalCode, $password) {
        try {
            $stmt = $this->conn->prepare("SELECT id, nCode, password FROM user WHERE nCode = ? AND status = 1");
            $stmt->bind_param("s", $nationalCode);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                if (password_verify($password, $row['password'])) {
                    // Update last login time
                    $updateStmt = $this->conn->prepare("UPDATE user SET lastLogin = NOW() WHERE id = ?");
                    $updateStmt->bind_param("i", $row['id']);
                    $updateStmt->execute();
                    
                    return [
                        'success' => true,
                        'user_id' => $row['id'],
                        'national_code' => $row['nCode']
                    ];
                }
            }
            
            return ['success' => false, 'message' => 'Invalid credentials'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Authentication error: ' . $e->getMessage()];
        }
    }

    public function authenticateAdmin($username, $password) {
        try {
            $stmt = $this->conn->prepare("SELECT id, username, password FROM admin WHERE username = ? AND status = 1");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                if (password_verify($password, $row['password'])) {
                    // Update last login time
                    $updateStmt = $this->conn->prepare("UPDATE admin SET lastLogin = NOW() WHERE id = ?");
                    $updateStmt->bind_param("i", $row['id']);
                    $updateStmt->execute();
                    
                    return [
                        'success' => true,
                        'admin_id' => $row['id'],
                        'username' => $row['username']
                    ];
                }
            }
            
            return ['success' => false, 'message' => 'Invalid credentials'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Authentication error: ' . $e->getMessage()];
        }
    }

    public function registerUser($userData) {
        try {
            // Check if national code already exists
            $checkStmt = $this->conn->prepare("SELECT id FROM user WHERE nCode = ?");
            $checkStmt->bind_param("s", $userData['nCode']);
            $checkStmt->execute();
            $result = $checkStmt->get_result();

            if ($result->num_rows > 0) {
                return ['success' => false, 'message' => 'National code already exists'];
            }

            // Hash password
            $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $this->conn->prepare("INSERT INTO user (name, lName, nCode, fatherName, bDate, profilePicture, password, email, regDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("ssssssss", 
                $userData['name'], 
                $userData['lName'], 
                $userData['nCode'], 
                $userData['fatherName'], 
                $userData['bDate'], 
                $userData['profilePicture'], 
                $hashedPassword, 
                $userData['email']
            );

            if ($stmt->execute()) {
                return ['success' => true, 'user_id' => $stmt->insert_id];
            } else {
                return ['success' => false, 'message' => 'Registration failed: ' . $stmt->error];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Registration error: ' . $e->getMessage()];
        }
    }
}
?>
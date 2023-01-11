<?php

class RoleController
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function Create(array $roles) : int //creates a new user roles
    {
        
        $sql = "INSERT INTO roles(userID, staff, admin)
        VALUES (:userID, :staff, :admin);";
        $this->db->runSQL($sql, $roles);
        return $this->db->lastInsertId();
       
    }

    public function get(int $id) // gets specific users data with the use of the roleID
    {
        $sql = "SELECT * FROM roles WHERE roleID = :ID";
        $args = ['roleID' => $id];
        return $this->db->runSQL($sql, $args) -> fetch();
    }

    public function getAll() : array //gets all data from the roles table
    {
        $sql = "SELECT * FROM roles";
        return $this->db->runSQL($sql) -> fetchAll();
    }

    public function getAdmin(string $userName)  // gets all rows where admin is set to 1 finding all admins
    {
        $sql = "SELECT * FROM roles WHERE admin = '1'";
        $args = ['userID' => $userName];
        return $this->db->runSQL($sql, $args) -> fetch();
    }

    public function getstaff(string $userName) // gets all rows where staff is set to 1 finding all staff members
    {
        $sql = "SELECT * FROM roles WHERE staff = '1'";
        $args = ['userID' => $userName];
        return $this->db->runSQL($sql, $args) -> fetch();
    }

    public function update(array $roles) : bool //updates a row of data where
    {
        $sql = "UPDATE roles 
                SET userID = :userID, 
                    admin = :admin,
                    staff = :staff, 
                WHERE id = :id;";
        
        return $this->db->runSQL($sql, $roles)->execute();
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM roles WHERE id = :id";
        return $this->db->runSQL($sql, ['id' => $id])->execute();
    }

}

?>
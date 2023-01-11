<?php

class RoleController
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function Create(array $roles) : int
    {
        
        $sql = "INSERT INTO roles(roleID, staff, admin)
        VALUES (:roleID, :staff, :admin);";
        $this->db->runSQL($sql, $roles);
        return $this->db->lastInsertId();
       
    }

    public function get(int $id)
    {
        $sql = "SELECT * FROM roles WHERE roleID = :ID";
        $args = ['roleID' => $id];
        return $this->db->runSQL($sql, $args) -> fetch();
    }

    public function getAll() : array
    {
        $sql = "SELECT * FROM roles";
        return $this->db->runSQL($sql) -> fetchAll();
    }

    public function getAdmin(string $userName) 
    {
        $sql = "SELECT * FROM roles WHERE admin = '1'";
        $args = ['userID' => $userName];
        return $this->db->runSQL($sql, $args) -> fetch();
    }

    public function getstaff(string $userName) 
    {
        $sql = "SELECT * FROM roles WHERE staff = '1'";
        $args = ['userID' => $userName];
        return $this->db->runSQL($sql, $args) -> fetch();
    }

    public function update(array $roles) : bool
    {
        $sql = "UPDATE roles 
                SET roleName = :roleName, 
                    description = :description, 
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
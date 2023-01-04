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
        
        $sql = "INSERT INTO roles(roleName, description,)
        VALUES (:roleName, :description);";
        $this->db->runSQL($sql, $roles);
        return $this->db->lastInsertId();
       
    }

    public function get(int $id)
    {
        $sql = "SELECT * FROM roles WHERE id = :id";
        $args = ['id' => $id];
        return $this->db->runSQL($sql, $args) -> fetch();
    }

    public function getAll() : array
    {
        $sql = "SELECT * FROM roles";
        return $this->db->runSQL($sql) -> fetchAll();
    }

    public function getByRole(string $roleName) 
    {
        $sql = "SELECT * FROM roles WHERE roleName = :roleName";
        $args = ['roleName' => $roleName];
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
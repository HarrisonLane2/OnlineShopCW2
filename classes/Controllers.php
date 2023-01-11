<?php

class Controllers
{
    protected $db = null;
    protected $members = null;
    protected $products = null;

    public function __construct(string $dsn = null, string $username = null, string $password = null)
    {
        //----TEMP----
        
        $host = '127.0.0.1';
        $dbname = 'shop';
        $port ='3306';
        $charset = 'latin1';
        $driver = 'mysql';
        $username = 'root';
        $password = '';

        //----TEMP----

        $dsn = "$driver:host=$host;dbname=$dbname;port=$port;charset=$charset"; 
        $this->db = new Database($dsn, $username, $password);
    }

    public function members()
    {
        if ($this->members === null) {
            $this->members= new MemberController($this->db);
        }
        return $this->members;
    }

    public function products()
    {
        if ($this->products === null) {
            $this->products= new ProductController($this->db);
        }
        return $this->products;
    }

    public function roles() //added controllers for the new tables roles and categories
    {
        if ($this->roles === null) {
            $this->roles= new rolesController($this->db);
        }
        return $this->roles;
    }

    public function categories()
    {
        if ($this->categories === null) {
            $this->categories= new categorieController($this->db);
        }
        return $this->categories;
    }
}

?>
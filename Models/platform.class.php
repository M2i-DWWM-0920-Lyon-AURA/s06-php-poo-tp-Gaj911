<?php 

final class platform 
{
    protected $id;
    protected $name;
    protected $link;

    public function __construct(

        int $id = null,
        string $name = '',
        string $link= ''
    )

    {

        $this->id = $id;
        $this->name = $name;
        $this->link = $link;

    }    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }
}    

function createPlatform($id, $name, $link) {
    return new platform($id, $name, $link);
}


function fetchAllPlatform() {
    global $databaseHandler; 

    $statement = $databaseHandler->query('SELECT * FROM `platform`');
    return $statement->fetchAll(PDO::FETCH_FUNC, 'createPlatform');

}
<?php 

require_once './Models/developer.class.php';
require_once './Models/game.class.php';
require_once './Models/platform.class.php';


final class Games 
{
    protected $id;
    protected $title;
    protected $release_date;
    protected $link;
    protected $developer_id;
    protected $platform_id;

    public function __construct(

        int $id = null,
        string $title = '',
        string $release_date = '',
        string $link = '',
        int $developer_id = null,
        int $platform_id = null
    )

    {

        $this->id = $id;
        $this->title= $title;
        $this->release_date= $release_date;
        $this->link = $link;
        $this->developer_id= $developer_id;
        $this->platform_id= $platform_id;

    }


    public function save()
    {
        if (is_null($this->id)) {
            $this->create();
        } else {
            $this->update();
        }
    }


    protected function create()
    {
        global $databaseHandler;

        $statement = $databaseHandler->prepare('
            INSERT INTO `game` (
                `title`,
                `release_date`,
                `link`,
                `developer_id`,
                `platform_id`
            )
            VALUES (
                :title,
                :release_date,
                :link,
                :developer_id,
                :platform_id
            )
        ');
        $statement->execute([
            ':title' => $this->title,
            ':release_date' => $this->release_date,
            ':link' => $this->link,
            ':developer_id' => $this->developer_id,
            ':platform_id' => $this->platform_id,
        ]);

        $this->id = $databaseHandler->lastInsertId();
    }

    protected function update()
    {
        global $databaseHandler;

        $statement = $databaseHandler->prepare('
            UPDATE `game`
            SET
                `title` = :title,
                `release_date` = :release_date,
                `link` = :link,
                `developer_id` = :developer_id,
                `platform_id` = :platform_id
                 WHERE `id` = :id;
        ');
        $statement->execute([
            ':id' => $this->id,
            ':title' => $this->title,
            ':release_date' => $this->release_date,
            ':link' => $this->link,
            ':developer_id' => $this->developer_id,
            ':platform_id' => $this->platform_id,
        ]);
    }





    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of release_date
     */ 
    public function getRelease_date()
    {
        return $this->release_date;
    }

    /**
     * Set the value of release_date
     *
     * @return  self
     */ 
    public function setRelease_date($release_date)
    {
        $this->release_date = $release_date;

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

    /**
     * Get the value of developer_id
     */ 
    public function getDeveloper() : ?Developer
    {
        return fetchDeveloperById($this->developer_id);
    }

    /**
     * Set the value of developer_id
     *
     * @return  self
     */ 
    public function setDeveloper(Developer $developer)
    {
        $this->developer_id = $developer->getId();

        return $this;
    }

    /**
     * Get the value of platform_id
     */ 
    public function getPlatform() : ?Platform
    {
        return  fetchPlatformById($this->platform_id);
    }

    /**
     * Set the value of platform_id
     *
     * @return  self
     */ 
    public function setPlatform(Platform $platform)
    {
        $this->platform_id = $platform->getId();

        return $this;
    }
}   

function createGames($id, $title, $release_date, $link, $developer_id, $platform_id) {
    return new games($id, $title, $release_date, $link, $developer_id, $platform_id);
}


function fetchAllGames() {
    global $databaseHandler; 

    $statement = $databaseHandler->query('SELECT * FROM `game`');
    return $statement->fetchAll(PDO::FETCH_FUNC, 'createGames');

}

function fetchGameById(int $id): ?Games {
    global $databaseHandler;

    $statement = $databaseHandler->prepare('SELECT * FROM `game` WHERE `id` = :id');
    $statement->execute([ ':id' => $id ]);
    $result = $statement->fetchAll(PDO::FETCH_FUNC, 'createGames');
    
    if (empty($result)) {
        return null;
    }

    return $result[0];
}




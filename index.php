<?php

require_once './Models/developer.class.php';
require_once './Models/game.class.php';
require_once './Models/platform.class.php';




$databaseHandler = new PDO('mysql:host=localhost;dbname=videogames', 'root', 'root');
$databaseHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$databaseHandler->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


$statement = $databaseHandler->query('SELECT * FROM `game` LIMIT 50');

// $games = $statement->fetchAll();

$devs = fetchAllDeveloper();
$games = fetchAllGames();
$platForm = fetchAllPlatform();

$test = $databaseHandler->query('SELECT * FROM `developer` 
JOIN `game`
ON `game`.`developer_id` = `developer`.`id`
WHERE `developer`.`id` = 1;
')

// var_dump($test); die;

// var_dump($games); die;
// var_dump($devs); die;
// var_dump($games); die;
// var_dump($platForm); die;




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video games php</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet" />
<body>
    <div class="container">
        <div class="card text-center">
            <img src="images/data-original.jpg" class="card-img-top" alt="Retro gaming banner">
            <div class="card-header">
                <h1 class="mt-4 mb-4">My beautiful video games</h1>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"># <i class="fas fa-sort-down"></i></th>
                        <th scope="col">Title <i class="fas fa-sort-down"></i></th>
                        <th scope="col">Release date <i class="fas fa-sort-down"></i></th>
                        <th scope="col">Developer <i class="fas fa-sort-down"></i></th>
                        <th scope="col">Platform <i class="fas fa-sort-down"></i></th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($games as $game): ?>

                    <tr>
                        <th scope="row"><?= $game->getId() ?></th>
                        <td>
                            <a href="<?= $game->getLink() ?>"><?= $game->getTitle() ?></a>
                        </td>
                        <td><?= $game->getRelease_date() ?></td>
                        
                            <td>
                                <a href="<?= $game->getDeveloper()->getLink() ?>"><?= $game->getDeveloper()->getName() ?></a>
                            </td>
                            <td>
                                <a href="<?= $game->getPlatform()->getLink() ?>"><?= $game->getPlatform()->getName() ?></a>
                            </td>
                            <td>

                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        <td>

                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                <?php endforeach; ?>

                    <form>
                        <tr>
                            <th scope="row"></th>
                            <td>
                                <input type="text" name="title" placeholder="Title" />
                                <br />
                                <input type="text" name="link" placeholder="External link" />
                            </td>
                            <td>
                                <input type="date" name="release_date" />
                            </td>
                            <td>
                                <select name="developer">
                                    <option value="1">Bullfrog Productions</option>
                                    <option value="2">id Software</option>
                                </select>
                            </td>
                            <td>
                                <select name="platform">
                                    <option value="1">SNES</option>
                                    <option value="2">MS-DOS</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                            <td></td>
                        </tr>
                    </form>



                </tbody>
            </table>
            <div class="card-body">
                <p class="card-text">This interface lets you sort and organize your video games!</p>
                <p class="card-text">Let us know what you think and give us some love! 🥰</p>
            </div>
            <div class="card-footer text-muted">
                Created by <a href="https://github.com/M2i-DWWM-0920-Lyon-AURA">DWWM Lyon</a> &copy; 2020
            </div>
        </div>
    </div>
</body>
</html>
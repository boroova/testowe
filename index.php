<?php
require_once __DIR__.'/vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

include __DIR__.DIRECTORY_SEPARATOR.'db.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM posts';

    $results = $conn->query($sql);
    $rows = $results->fetchAll();
    
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;

echo $twig->render('index.html.twig', array(
	'posts' => $rows)
);
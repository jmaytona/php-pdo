<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'php_pdo';

#Set DSN (Data Source Name)
$dsn = 'mysql:host='. $host .';dbname='. $dbname;

#Create a PDO instance
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


#PDO Normal Query
//$stmt = $pdo->query('SELECT * FROM posts');

// while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//     echo $row['title'] . '<br>';
// }

#PDO Object
// while($row = $stmt->fetch(PDO::FETCH_OBJ)){
//     echo $row->title . '<br>';
// }

#PDO Default PDO FETCH (Object)
// while($row = $stmt->fetch()){
//     echo $row->title . '<br>';
// }

#--------------------------------------------------------------------------------------------------#
#PREPARED STATEMENTS (prepare & execute)

#UNSAFE WAY
//$sql = "SELECT * FROM posts WHERE author = '$author'";

#SAFE WAY
#FETCH MULTIPLE POSTS

#Sample User Input
$author = 'Dante';
$is_published = true;
$limit = 1;
$id = 1;

# ? is a Positional Parameters Note: Order is sensitive
$sql = 'SELECT * FROM posts WHERE author = ? && is_published = ? LIMIT ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$author, $is_published, $limit]);
$posts = $stmt->fetchAll();

# :name is a named Paramter

// $sql = 'SELECT * FROM posts WHERE author = :author && is_published = :is_published';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['author' => $author, 'is_published' => $is_published]);
// $posts = $stmt->fetchAll();

#var_dump check the object
//var_dump($posts);

foreach($posts as $post){
    echo $post->title. '<br>';
}

#--------------------------------------------------------------------------------------------------#
#FETCH SINGLE POST
// $sql = 'SELECT * FROM posts WHERE id = :id';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['id' => $id]);
// $posts = $stmt->fetch();
// echo $posts->body. '<br>';

#--------------------------------------------------------------------------------------------------#
#GET ROW COUNT
// $stmt = $pdo->prepare('SELECT * FROM posts WHERE author = ?');
// $stmt->execute([$author]);
// $postCount = $stmt->rowCount();
// echo $postCount;

#--------------------------------------------------------------------------------------------------#
#INSERT DATA

#Sample User Input
// $title = 'Post 5';
// $body = 'This is Post 5';
// $author = 'Nero';

// $sql = 'INSERT INTO posts(title, body, author) VALUES (:title, :body, :author)';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['title' => $title, 'body' => $body, 'author' => $author]);
// echo 'Post Added';

#--------------------------------------------------------------------------------------------------#
#UPDATE DATA

#Sample User Input
// $id = 1;
// $body = 'Updated Version';

// $sql = 'UPDATE posts SET body = :body WHERE id = :id';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['body' => $body, 'id' => $id]);
// echo 'Post Updated';

#--------------------------------------------------------------------------------------------------#
#DELETE DATA

#Sample User Input
// $id = 4;

// $sql = 'DELETE FROM posts WHERE id = :id';
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['id' => $id]);
// echo 'Post Deleted';

#--------------------------------------------------------------------------------------------------#
#SEARCH DATA

#Sample User Input
// $search = '%Pos%';
// $sql = 'SELECT * FROM posts WHERE title LIKE ?';
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$search]);
// $posts = $stmt->fetchAll();

// foreach($posts as $post){
//     echo $post->title .'<br>';
// }
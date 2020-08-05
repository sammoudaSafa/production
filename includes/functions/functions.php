<?php
function form_values($courriel)
{
    echo (isset($_POST[$courriel])) ? $_POST[$courriel] : "";
}
function set_user_session($user){
    $_SESSION['auth']=$user;
    return $user;
}

function get_user_session(){
    return $_SESSION['auth'];
}
function only_user_logged()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['auth'])) {
        header('Location:index.php');
        exit();
    }
}

function add_article(){
    $user = get_user_session();
    
        try {
            $pdo = connect();  
            $req = $pdo->prepare("INSERT INTO articles SET titre=?, date_pub=?,texte=?,auteur=?");
            $req->execute([$_POST['titre'], $_POST['date_pub'], $_POST['texte'],$user->nom]);
            header('Location: account.php');
        } catch (PDOException $e) {
            echo "message" . $e->getMessage();
            exit();
        }
    }
    
    function get_article()
    {
        try {
            $pdo = connect();
            $req = $pdo->query('SELECT * FROM articles');
            return $req;
        } catch (PDOException $e) {
            echo "message" . $e->getMessage();
            exit();
        }
    }
    
    function get_article_by_id($id)
    {
        $pdo = connect();
        try {
            $req = $pdo->prepare('SELECT * FROM articles WHERE id=:id');
            $req->execute([":id" => $id]);
            return $req->fetch();
        } catch (PDOException $e) {
            echo "message" . $e->getMessage();
            exit();
        }
    }
    
    function update_article($data){
        $pdo = connect();
        $user = get_user_session();
        $article = get_article_by_id($data);
    
        $auteur=$user->nom;
         try{
             $req = $pdo->prepare('UPDATE articles SET titre=?, date_pub=?, texte=? WHERE id=?');
            $req->execute([$_POST['titre'],$_POST['date_pub'],$_POST['texte'],$article->id]);
            header('Location: profil.php');
            exit();
        } catch(PDOException $e){
            echo $e->getMessage();
            die;
       }
        $pdo=null;
    }
    function delete_article($data){
        $pdo = connect();
        $article = get_article_by_id($data);
         try{
            $req = $pdo->prepare('DELETE FROM articles WHERE id=?');
            $req->execute([$article->id]);
            header('Location: profil.php');
        } catch(PDOException $e){
            echo $e->getMessage();
            die;
       }
        $pdo=null;
    }
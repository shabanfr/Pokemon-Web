<?php
require_once '../includes/mysql.php';

if(isset($_GET["connect"])){
	$connect = explode(",",$_GET["connect"]);
	$user = $connect[0];
	$password = $connect[1];

if (isset($user) && isset($password)) {
    if (empty($user) && empty($password)) {
        echo "Veuillez remplir les champs vides !";
    } else if (empty($user)) {
        echo "Veuillez saisir un nom d'utilisateur !";
    } else if (empty($password)) {
        echo "Veuillez saisir un mot de passe !";
    } else {
        $sql  = "SELECT name,password FROM users WHERE name = '$user'";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row[0] == $user) {
            if ($row[1] == $password) {
                $_SESSION['user'] = $user;                
                echo "Connexion reussite";
            } else {
                echo "Erreur du mot de passe!";
                $password = "";
            }
        } else {
            echo "Votre utilisateur n'est pas existant !";
            $user     = "";
            $password = "";
        }
        
    }
}

	
}
else if(isset($_GET["listusers"])){
	$sql = "SELECT name, availability,id FROM users WHERE online=1";
	$stmt = $bdd->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetchAll();
	foreach ($row as $value) {
		$dispo = $value[1]== 1 ? "green" : "red";
		echo "<li class='{$dispo}'>{$value[0]} ";
		echo "<button onclick='this.disabled=true;teste(\"{$value[0]}\");'>Demande une partie</button>";
		echo "</li>";
	}
}
?>
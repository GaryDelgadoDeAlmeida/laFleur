
<?php

/* Mettre à jour les produits
 * dans la base de donnée, ajouter de nouveau
 * produit, supprimer un produit, modifier un produit
 * Elle peut aussi modifier le prix, ajouter des catégoris 
 * de fleurs.
 *
 * UNIQUEMENT S'IL EST CONNECTE
 */

if (isset($_REQUEST['action'])) {
	# code...
	$action = $_REQUEST['action'];
}
else
{
	$action = 'form';
}
switch ($action) {
	case 'form':
		{ include("vues/v_formulaire.php"); break; }
	
	case 'login':
		{
		if (isset($_REQUEST['login']) && isset($_REQUEST['pwd'])) {
			# code...
			if (empty($_REQUEST['login']) && empty($_REQUEST['pwd'])) {
				# code...
				echo "Please, do not forget the forgotten input ! <br>
				<a href='index.php?uc=administrer'>Retour</a>";
			}
			else {
				try
				{
					$login = $_REQUEST['login'];
					$pwd = $_REQUEST['pwd'];
					$req = $pdo->prepare("SELECT nom, mdp FROM administrateur WHERE nom = (:login) AND mdp = (:motdepasse)");
					$req = $req->bindParam(':login', $login);
					$req = $req->bindParam(':motdepasse', $pwd);
					$req->execute();


					if (!is_null($req)) {
						# code...
						include("vues/v_accueilAdmin.php");
					}
					else
					{
						header("Location: index.php?uc=administrer");
						exit();
					}
				}
				catch (Exception $e)
				{
					echo $e->message();
				}
			}
		}
	}
}

?>
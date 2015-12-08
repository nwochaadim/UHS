<?php
	$errors = false;
	if(isset($_POST["name"])){
		$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);

	}

	else{

		$errors = true;
	}

	if(isset($_POST["message"])){
		$message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

	}

	else{

		$errors = true;
	}



	if(isset($_POST["email"])){
		$email = filter_var($_POST["name"], FILTER_VALIDATE_EMAIL)?$_POST["email"]:"";
			if($errors==false){
				require_once("./post.php");
				$post = new Post();
				$post->insertComments($_POST["id"], $name, $email, $message);
				header("Location: blog-single.php?id=".$_POST["id"]);
				exit;
			}
			else{

				header("Location: blog-single.php?id=".$_POST["id"]);
				exit;
			}
			
		
	}

	else{

		if($errors==false){
				require_once("./post.php");
				$post = new Post();
				$post->insertComments($_POST["id"], $name, "", $message);
				header("Location: blog-single.php?id=".$_POST["id"]);
				exit;
			}
		else{

				header("Location: blog-single.php?id=".$_POST["id"]);
				exit;

		}

	}



	

?>
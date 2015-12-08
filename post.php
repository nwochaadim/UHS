<?php
	
	class Post{
		
		public $totalPosts =1;
		

		
		public function __construct(){
			
			try {
				global $conn;
				$dsn = "mysql:dbname=blog";
				$username = "root";
				$password = "";
				$conn = new PDO( $dsn, $username, $password );
				$conn-> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				} catch ( PDOException $e ) {
					echo "Connection failed: " . $e-> getMessage();
					}
					
		}
		
		public function insert($title, $post, $image, $views){
			global $conn;
			
			$query = $conn->prepare("insert into posts (title, post, image, views) values (:title, :post, :image, :views)");
			
			try{
				$query->execute(array(":title"=>$title, ":post"=>$post, ":image"=>$image, ":views"=>$views));
				
				}
			catch(PDOException $e){
					header("Location: formerror.php");
					exit;
				}
			
			
			}

		public function reArrange(){
			global $conn;
			$contents = $conn->query("select * from posts where id >= 1 asc");
			$num = 1;
			foreach($contents as $content){
				$query = $conn->prepare("update posts set id = ?, where id = ?");
				try{
					$query->execute(array($num, $num));
				}
				catch(PDOException $e){
					echo $e->getMessage();

				}
				$num++;
			}
		}


		public function incrementViews($postId){
			global $conn;
			$view = $conn->query("select views from posts where id=".$postId);
			$view = $view["view"];
			$view++;
			$query = $conn->prepare("update posts set views=? where id=?");
			try{
					$query->execute(array($view, $postId));
				}
				catch(PDOException $e){
					echo $e->getMessage();

				}

		}

		public function getBlogEntries($rangeId){
			global $conn;
			$stm = $conn->prepare("select max(id) as maxId from posts");
			$stm->execute();
			$pdo = $stm->fetch(PDO::FETCH_ASSOC);
			$lastId = $pdo['maxId'];
			$this->totalPosts = $lastId;

			$start =1;
			$end = 1;
			$result = $lastId- (5 * ($rangeId-1));
			if($result<1){
				return "Error";
				
			}
			if($result>=5){
				$start = $result-4;
				$end = $result;
			}

			else{

				$start = 1;
				$end = $result;
			}

			$blogEntries = $conn->query("select * from posts where id between ".$start. " and ".$end. " order by id desc");
			return $blogEntries;

		}

		public function getPostDetails($postId){
			global $conn;

			$query = $conn->query("select * from posts where id= ". $postId);
			return $query;
		}

		public function getCommentsDetail($postId){
			global $conn;

			$query = $conn->query("select * from comments where postId= ". $postId. " order by id asc");
			return $query;

		}

		public function getPostPages(){
			$pageNumber = $this->totalPosts/5;
			$pageNumber = ceil($pageNumber);
			return $pageNumber;

		}

		public function getLastEntry(){
			global $conn;
			$stm = $conn->prepare("select max(id) as maxId from posts");
			$stm->execute();
			$pdo = $stm->fetch(PDO::FETCH_ASSOC);
			$lastId = $pdo['maxId'];
			$this->totalPosts = $lastId;

			return $this->totalPosts;
		}

		public function insertComments($postId, $name, $email, $message){
			global $conn;
			$query = $conn->prepare("insert into comments (postId, name, email, message) values(:postId, :name, :email, :message)");
			try{
				$query->execute(array(":postId"=>$postId, ":name"=>$name, ":email"=>$email, ":message"=>$message));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}

		}

		public function getCommentsTotal($postId){
			global $conn;
			$stm = $conn->prepare("select count(name) as commentsTotal from comments where postId=".$postId);
			$stm->execute();
			$pdo = $stm->fetch(PDO::FETCH_ASSOC);
			$totalComments = $pdo["commentsTotal"];
			return $totalComments;
		}

		
		
		
	}
	

?>
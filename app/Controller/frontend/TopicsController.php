<?php
namespace App\Controller\Frontend;
use Core\Controller\Controller;
/**
* TopicsController classe qui gère l'affichage des topics en 
* faisant le lien entre "model" et "view"
*/
class TopicsController extends Controller
{
	/**
	* @var $viewPath retourne le nom du dossier frontend
	* @var $_instance qui stocke l'instance de la classe
	*/
	protected $viewPath = 'frontend';
	private static $_instance;

	/**
	* Méthode topics gère l'affichage de tous les topics dans la vue 
	* topics
	*/
	public function Alltopics(){
		$allTopics = $this->topicsModel->select();
		$number_of_topics = count($allTopics);
		$number_per_page = 5;
		$number_of_page = ceil($number_of_topics / $number_per_page);
		
		$pagination = '';
		for ($page=1; $page <= $number_of_page ; $page++){
			$pagination .='| <a href="topics/'.$page.'">'.$page.'</a> ';
		}

		if(intval($_GET['page']) && isset($_GET['page']) && $_GET['page'] <= $number_of_page && $_GET['page'] > 0){
			$from = $number_per_page * ($_GET['page'] - 1);  
		} else {
			$_GET['page'] = 1;
			$from = $number_per_page * ($_GET['page'] - 1); 
		}

		$topics = $this->topicsModel->selectBylimit($from, $number_per_page);

		$pagination = substr($pagination, 2, strlen($pagination));

		$user = function($user_id){
			$username = $this->usersModel->select([$user_id], 'id');
			if($username){
				$username = $username->pseudo;
			} else {
				$username = "Anonyme";
			}
			return $username;
		};

		$this->render('topics', compact('topics', 'pagination', 'user'), true);
	}

	/**
	* Méthode topicsByCat qui gère l'affichage des topics par catégorie
	*/
	public function topicsByCat(){
		if(isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id'])){
			$allTopics = $topics = $this->topicsModel->selectByCategory([$_GET['id']], 'category_id');

			$number_of_topics = count($allTopics);
			$number_per_page = 5;
			$number_of_page = ceil($number_of_topics / $number_per_page);
		
			$pagination = '';
			for ($page=1; $page <= $number_of_page ; $page++){
				$pagination .='| <a href="topics-by-category/'. $_GET['category'] .'/'. $_GET['id'] .'-'.$page.'">'.$page.'</a> ';
			};

			if(intval($_GET['page']) && isset($_GET['page']) && $_GET['page'] <= $number_of_page && $_GET['page'] > 0){
				$from = $number_per_page * ($_GET['page'] - 1);  
			} else {
				$_GET['page'] = 1;
				$from = $number_per_page * ($_GET['page'] - 1); 
			}

			$topics = $this->topicsModel->selectByCategory([$_GET['id']], 'category_id', $from, $number_per_page);

			$pagination = substr($pagination, 2, strlen($pagination));
				
			$user = function($user_id){
				$username = $this->usersModel->select([$user_id], 'id');
				if($username){
					$username = $username->pseudo;
				} else {
					$username = "Anonyme";
				}
				return $username;
			};

			$verifytopic = count($topics);
			if($verifytopic <= 0) {
				header('location: /Forum/webmaster-forum');
			}
		} else {
			header('location: /Forum/webmaster-forum');
		}

		$this->render('category-topics', compact('topics', 'user', 'pagination'), true);
	}

	/**
	* Méthode topicsBySubcat qui gère l'affichage des topics par 
	* sous-catégorie
	*/
	public function topicsBySubcat(){
		if(isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id'])){
			$allTopics = $topics = $this->topicsModel->selectByCategory([$_GET['id']], 'subcategory_id');

			$number_of_topics = count($allTopics);
			$number_per_page = 5;
			$number_of_page = ceil($number_of_topics / $number_per_page);
		
			$pagination = '';
			for ($page=1; $page <= $number_of_page ; $page++){
				$pagination .='| <a href="topics-by-category/'. $_GET['category'] .'/'. $_GET['subcategory'] .'/';
				$pagination .= $_GET['id'] .'-'.$page.'">'.$page.'</a> ';
			};

			if(intval($_GET['page']) && isset($_GET['page']) && $_GET['page'] <= $number_of_page && $_GET['page'] > 0){
				$from = $number_per_page * ($_GET['page'] - 1);  
			} else {
				$_GET['page'] = 1;
				$from = $number_per_page * ($_GET['page'] - 1); 
			}

			$topics = $this->topicsModel->selectByCategory([$_GET['id']], 'subcategory_id', $from, $number_per_page);

			$pagination = substr($pagination, 2, strlen($pagination));
			$verifytopic = count($topics);
			if($verifytopic <= 0) {
				header('location: /Forum/webmaster-forum');
			}

			$user = function($user_id){
				$username = $this->usersModel->select([$user_id], 'id');
				if($username){
					$username = $username->pseudo;
				} else {
					$username = "Anonyme";
				}
				return $username;
			};

		} else {
			header('location: /Forum/webmaster-forum');
		}

		$this->render('category-topics', compact('topics', 'user', 'pagination'), true);
	}

	/**
	* Méthode showTopic qui gère l'affichage d'un topic et des commentaires associés en liant la vue show-topic et le model 
	*/
	public function topic(){
		if(isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id']) && $_GET['id'] > 0){

			$topic_id = $_GET['id'];
			$topic = $this->topicsModel->select([$topic_id], 'id');
			$user = $this->usersModel->select([$topic->user_id], 'id');
			$url = function($pseudo){
				$urlcustom = 'public-profile/'. $this->urlCustom($pseudo);
				return $urlcustom;
			};

			if(!is_object($user)){
				$user = (object) [
					'pseudo' => 'Anonyme',
					'avatar' => 'default.png'
				];
				$url = function($pseudo){
					$urlcustom = 'topic/'.$topic_id;
					return $urlcustom;
				};
			}

			$comment_per_page = 3;
			$all_comment = $this->messagesModel->select([$topic->id], 'topic_id');
			$all_comment = count($all_comment);
			$number_of_page = ceil($all_comment / $comment_per_page);

			$pagination = '';
			for ($page=1; $page <= $number_of_page ; $page++){
				$pagination .='| <a href="topic/webmastertopic-'. $topic->id.'-'.$page.'">'.$page.'</a> ';
			}
			$pagination = substr($pagination, 2, strlen($pagination));

			if(isset($_GET['page']) && intval($_GET['page']) && $_GET['page'] <= $number_of_page && $_GET['page'] > 0){

				$from = $comment_per_page * ($_GET['page'] - 1);
				$comment = $this->messagesModel->select([$topic->id], 'topic_id', $from, $comment_per_page);
			} else {

				$_GET['page'] = 1;
				$from = $comment_per_page * ($_GET['page'] - 1);
				$comment = $this->messagesModel->select([$topic->id], 'topic_id', $from, $comment_per_page);
			}
			if(count($comment) > 0){
				$urlComment = function($pseudo){
					$urlCustom_Comment = 'public-profile/'. $pseudo;
					return $urlCustom_Comment;
				};
			} else {
				$urlComment = function($pseudo){
					$urlCustom_Comment = 'topic/'.$topic_id;
					return $urlCustom_Comment;
				};
			}
			$userComment = function($user_id) {
				$userMessages = $this->usersModel->select([$user_id], 'id');
				return $userMessages;
			};

			if(!is_object($topic)){
				header('location: /Forum/webmaster-forum');
			} else {
				if($this->logged()){
					if(isset($_POST['submit-comment'], $_POST['comment-topic'])){
						$messages = $_POST['comment-topic'];
						if(!empty($messages)){
							$addMessage = $this->messagesModel->add([
								':topic_id' => $topic->id,
								':user_id' => $_SESSION['user']['id'],
								':content' => $messages
							]);

							$sender = $userComment($_SESSION['user']['id']);
							$content = '<p>Vous avez reçu une réponse de : '. $sender->pseudo .' </p>'.
							$content .= '<p>'. substr($messages, 0, 200) . '</p>';

							if($topic->user_notif == 1){
								\App::sendmail($content, $user->mail);
							}

							header('location: webmastertopic-'. $topic->id.'-1');
						} else {
							$error_comment = 'Veuillez remplir tous les champs';
						}
					}
				}
			}

		} else {
			header('location: /Forum/webmaster-forum');
		}

		$this->render('show-topic', compact('topic', 'user', 'url', 'comment', 'userComment', 'urlComment', 'pagination'), true);
	}

	/**
	* @return une instance de la classe
	*/
	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new TopicsController();
		}
		return self::$_instance;
	}	
}
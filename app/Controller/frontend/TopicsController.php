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
	* topics ou bine des topics par catégorie ou sous-catégorie
	*/
	public function topics(){
		if(isset($_GET['id'], $_GET['category']) && !empty($_GET['id']) && !empty($_GET['category']) && intval($_GET['id'])){
			if(isset($_GET['subcategory']) && !empty('subcategory')){
				
				$allTopics = $topics = $this->topicsModel->selectByCategory([$_GET['id']], 'subcategory_id');
				
				$href = 'topics/'. $_GET['category'] .'/'. $_GET['subcategory'] .'/'.$_GET['id'] .'-';

				$number_of_topics = count($allTopics);
				$number_per_page = 5;
				$number_of_page = ceil($number_of_topics / $number_per_page);
				
				$pagination = $this->pagination($number_of_page, $href);

				if(intval($_GET['page']) && isset($_GET['page']) && $_GET['page'] <= $number_of_page && $_GET['page'] > 0){
					$from = $number_per_page * ($_GET['page'] - 1);  
				} else {
					$_GET['page'] = 1;
					$from = $number_per_page * ($_GET['page'] - 1); 
				}

				$topics = $this->topicsModel->selectByCategory([$_GET['id']], 'subcategory_id', $from, $number_per_page);
			} else {
				
				$allTopics = $topics = $this->topicsModel->selectByCategory([$_GET['id']], 'category_id');
				$href = 'topics/'. $_GET['category'] .'/'. $_GET['id'] .'-';

				$number_of_topics = count($allTopics);
				$number_per_page = 5;
				$number_of_page = ceil($number_of_topics / $number_per_page);
				
				$pagination = $this->pagination($number_of_page, $href);

				if(intval($_GET['page']) && isset($_GET['page']) && $_GET['page'] <= $number_of_page && $_GET['page'] > 0){
					$from = $number_per_page * ($_GET['page'] - 1);  
				} else {
					$_GET['page'] = 1;
					$from = $number_per_page * ($_GET['page'] - 1); 
				}
				
				$topics = $this->topicsModel->selectByCategory([$_GET['id']], 'category_id', $from, $number_per_page);
			}

			$verifytopic = count($topics);
			
			if($verifytopic <= 0) {
				header('location: /Forum/topics/1');
			}

		} else {
			$allTopics = $this->topicsModel->select();
			$href = 'topics/';
			
			$number_of_topics = count($allTopics);
			$number_per_page = 5;
			$number_of_page = ceil($number_of_topics / $number_per_page);
			
			$pagination = $this->pagination($number_of_page, $href);

			if(intval($_GET['page']) && isset($_GET['page']) && $_GET['page'] <= $number_of_page && $_GET['page'] > 0){
				$from = $number_per_page * ($_GET['page'] - 1);  
			} else {
				$_GET['page'] = 1;
				$from = $number_per_page * ($_GET['page'] - 1); 
			}
			
			$topics = $this->topicsModel->selectBylimit($from, $number_per_page);
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

		if($this->logged()){
			if(isset($_POST['sub-follow'], $_POST['follow'])){
				$followTopic = $_POST['follow'];
				if(!empty($followTopic) && intval($followTopic)){
					$verifyTopic = $this->topicsModel->countTopic([$followTopic], 'id');
					if($verifyTopic == 1){
						$this->followModel->add([$_SESSION['user']['id'], $followTopic]);
					}
				}
			} 
			if(isset($_POST['sub-unfollow'], $_POST['unfollow'])){
				$unfollowTopic = $_POST['unfollow'];
				if(!empty($unfollowTopic) && intval($unfollowTopic)){
					$verifyUnfollow = $this->followModel->count([$unfollowTopic, $_SESSION['user']['id']], 'topic_id', 'user_id');
					if($verifyUnfollow == 1){
						$this->followModel->delete([$unfollowTopic]);
					}
				}
			}

			$followed = function($topic_id){
				$exist = $this->followModel->count([$topic_id, $_SESSION['user']['id']], 'topic_id', 'user_id');
				return $exist;
			};
		}

		$this->render('topics', compact('topics', 'pagination', 'user', 'followed'), true);
	}

	/** 
	* Méthode showTopic qui gère l'affichage d'un topic et des commentaires associés en liant la vue show-topic et le model 
	*/
	public function topic(){
		if(isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id']) && $_GET['id'] > 0){

			$topic_id = $_GET['id'];
			$topic = $this->topicsModel->select([$topic_id], 'id');
			$user = $this->usersModel->select([$topic->user_id], 'id');
			
			if($user){
				$url = function($pseudo){
					$urlcustom = 'public-profile/'. $this->urlCustom($pseudo);
					return $urlcustom;
				};
			} else {
				$user = (object) [
					'pseudo' => 'Anonyme',
					'avatar' => 'default.png',
					'id' => false
				];
				$url = function(){
					$urlcustom = 'topic/webmastertopic-'. $_GET['id'] . '-1';
					return $urlcustom;
				};
			}

			$comment_per_page = 3;
			$all_comment = $this->messagesModel->select([$topic->id], 'topic_id');
			$all_comment = count($all_comment);
			$number_of_page = ceil($all_comment / $comment_per_page);

			$href = 'topic/webmastertopic-'. $topic->id.'-';
			$pagination = $this->pagination($number_of_page, $href);

			if(isset($_GET['page']) && intval($_GET['page']) && $_GET['page'] <= $number_of_page && $_GET['page'] > 0){
				$from = $comment_per_page * ($_GET['page'] - 1);
			} else {
				$_GET['page'] = 1;
				$from = $comment_per_page * ($_GET['page'] - 1);
			}

			$comment = $this->messagesModel->select([$topic->id], 'topic_id', $from, $comment_per_page);

			if(count($comment) > 0){
				$urlComment = function($pseudo){
					$urlCustom_Comment = 'public-profile/'. $pseudo;
					return $urlCustom_Comment;
				};
			} else {
				$urlComment = function($pseudo){
					$urlCustom_Comment = 'topic/webmastertopic-'. $_GET['id'] . '-1';
					return $urlCustom_Comment;
				};
			}

			$userComment = function($user_id) {
				$c_user = $this->usersModel->select([$user_id], 'id');
				if($c_user == false){
					$c_user = (object) [
						'pseudo' => 'Anonyme',
						'avatar' => 'default.png',
						'id' => false
					];
				} 
				return $c_user;
			};

			$admin = function($user_id){
				$user_admin = $this->adminModel->count([$user_id], 'user_id');
				if($user_admin == 1){
					return true;
				}
			};

			if($topic){
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
							$content = '<p>Vous avez reçu une réponse de : '. $sender->pseudo .'  de votre topic : '. $topic->title .'</p>'.
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
				if(isset($_POST['sub_bestAnswer'], $_POST['best_answer'])){
					if(!empty($_POST['best_answer']) && intval($_POST['best_answer'])){
						$verifyMessage = $this->messagesModel->count([$_POST['best_answer'], $topic->id], 'id', 'topic_id');
						if($verifyMessage == 1){
							$this->messagesModel->updateBestAnswer([$_POST['best_answer']]);
						} else {
							header('location: forum');
						}
					}else {
						header('location: forum');
					}
				}
			} else {
				header('location: /Forum/webmaster-forum');
			}

		} else {
			header('location: /Forum/webmaster-forum');
		}

		$this->render('show-topic', compact('topic', 'user', 'url', 'comment', 'userComment', 'urlComment', 'pagination', 'admin'), true);
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
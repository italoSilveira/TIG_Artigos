<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array(
	'Paginator',
	);


public function beforeFilter(){
	parent::beforeFilter();
	$this->Auth->allow('add', 'logout', 'response');
}

/**
 * index method
 *
 * @return void
 */
public function index() {
	$this->User->recursive = 0;
	$this->set('users', $this->Paginator->paginate());
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function view($id = null) {
	$this->User->recursive = 2;
	if (!$this->User->exists($id)) {
		throw new NotFoundException(__('Invalid user'));
	}
	$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
	$this->set('user', $this->User->find('first', $options));
}

/**
 * add method
 *
 * @return void
 */
public function add() {
	$this->layout = 'login';
	if ($this->request->is('post')) {
		$this->User->create();
		if ($this->User->save($this->request->data)) {
			$this->Flash->success(__('The user has been saved.'));
			return $this->redirect(array('action' => 'index'));
		} else {
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
	}
}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function edit() {
	$id = $this->Auth->user('id');
	if (!$this->User->exists($id)) {
		throw new NotFoundException(__('Invalid user'));
	}
	if ($this->request->is(array('post', 'put'))) {
		$this->request->data['User']['id'] = $this->Auth->user('id');
		if ($this->User->saveAll($this->request->data)) {
			$this->Flash->success(__('The user has been saved.'));
			return $this->redirect(array('action' => 'edit'));
		} else {
			$this->Flash->error(__('The user could not be saved. Please, try again.'));
		}
	} else {
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->request->data = $this->User->find('first', $options);
		unset($this->request->data['User']['password']);
	}
	$categories = $this->User->Category->find('list');
	$keyWords = $this->User->KeyWord->find('list');
	$this->set(compact('categories', 'keyWords'));
}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function delete($id = null) {
	$this->User->id = $id;
	if (!$this->User->exists()) {
		throw new NotFoundException(__('Invalid user'));
	}
	$this->request->allowMethod('post', 'delete');
	if ($this->User->delete()) {
		$this->Flash->success(__('The user has been deleted.'));
	} else {
		$this->Flash->error(__('The user could not be deleted. Please, try again.'));
	}
	return $this->redirect(array('action' => 'index'));
}

public function login() {
	$this->layout = 'login';
	if ($this->Auth->login()) {
		$this->GoogleAPI->googleClient->addScope("https://www.googleapis.com/auth/youtube");
		$url = $this->GoogleAPI->googleClient->createAuthUrl();
		$this->redirect($url);
	} else {
		$this->Flash->error(__('Invalid username or password, try again'));
	}
}

public function response() {
	if(isset($this->request->query['code'])){
		$this->GoogleAPI->googleClient->authenticate($this->request->query['code']);
		$user = $this->Session->read('Auth.User');
		$user['youtube_token'] = $this->GoogleAPI->googleClient->getAccessToken();
		$this->User->save($user);
	}
	$this->redirect($this->Auth->redirect());
}

public function analysis(){
	if($this->Session->check('Auth.User.youtube_token')){
		$token = $this->Session->read('Auth.User.youtube_token');
		$this->GoogleAPI->googleClient->setAccessToken($token);

		$yt_service = new Google_Service_YouTube($this->GoogleAPI->googleClient);
		$yt_channels = $yt_service->channels->listChannels('contentDetails', array("mine" => true));
		$likePlaylist = $yt_channels[0]->contentDetails->relatedPlaylists->likes;
		$yt_results = $yt_service->playlistItems->listPlaylistItems(
			"snippet",
			array("playlistId" => $likePlaylist,"maxResults" => "17")
			);
			//Pegar os dados dos vídeos pelo ID recuperado da lista de Likes
		$ct = 0;
		foreach ($yt_results as $resultado):
			$yt_videos[$ct] = $yt_service->videos->listVideos("snippet",array("id" => $resultado['snippet']['resourceId']['videoId']));
		$ct++;
		endforeach;

    //Pegar dados dos videos
		$categorias["Inicializacao"] = 0;
		$todasTags["Inicializacao"] = 0;
		foreach ($yt_videos as $videos):
			foreach ($videos as $video):
        		//Listamos os dados das categorias pesquisadas pelo seu ID
				$yt_category = $yt_service->videoCategories->listVideoCategories("snippet",array("id" => $video['snippet']['categoryId']));
     			//Analisamos os dados da categoria
				foreach ($yt_category as $category):
      				//Verifica se já existe um índice para essa categoria
					if (array_key_exists($category['snippet']['title'], $categorias)) {
						$categorias[$category['snippet']['title']] += 1;
					}else{
						$categorias[$category['snippet']['title']] = 1;
					}
	      			//Verifica se realmente há tags, pois se não houver ele irá emitir um Warning
					if(!empty($video['snippet']['tags'])){
						$tags[] = $video['snippet']['tags'];
					}
				endforeach;
			endforeach;
		endforeach;

      	//Analisa as tags de todos os vídeos
		foreach ($tags as $tag) {
			foreach ($tag as $item) {
				if (array_key_exists($item, $todasTags)) {
					$todasTags[$item] += 1;
				}else{
					$todasTags[$item] = 1;
				}
			}
		}

		arsort($todasTags);
		arsort($categorias);

	//Define quantos índices serão usados
		array_splice($todasTags, 15);
		array_splice($categorias, 5);

		print_r($todasTags);
		print_r($categorias);
		die;
			// $categories = $this->User->UserCategory->find('all');
			// debug($categories);die;
			}
		}

		public function logout() {
			$this->redirect($this->Auth->logout());
		}
	}

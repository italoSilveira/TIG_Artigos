<?php
App::uses('AppController', 'Controller');
/**
 * Articles Controller
 *
 * @property Article $Article
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class ArticlesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function discover() {
		$this->Article->recursive = 2;
		$user = $this->Article->User->findById($this->Auth->user('id'));
		$keyWords = array();
		$categories = array();

		foreach ($user['KeyWord'] as $key => $value) {
			$keyWords[] = $value['id'];
		}
		foreach ($user['Category'] as $key => $value) {
			$categories[] = $value['id'];
		}

		$articles = $this->Article->find(
			'all',
			array(
				'contain'=>array(
					'Category'=>array(
						'conditions'=>array('Category.id'=>$categories)
					),
					'KeyWord'=>array(
						'conditions'=>array('KeyWord.id'=>$categories)
					),
					'Viewed'=>array(
						'conditions'=>array(
							'user_id'=>$this->Auth->user('id')
						)
					),
					'User','Comment'
				),
				'order'=>'Article.id DESC'
			)
		);

		usort($articles, function($a, $b) {
		    return (count($b['KeyWord']) + count($b['Category'])) < (count($a['KeyWord']) + count($a['Category']));
		});
		usort($articles, function($a, $b) {
		    return empty($b['Viewed']) < empty($a['Viewed']);
		});

		$this->set('articles', $articles);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Article->recursive = 2;
		$articles = $this->Article->find('all', array(
			'contain'=>array(
				'Category', 'KeyWord', 'Comment', 'User',
				'Viewed'=>array(
					'conditions'=>array(
						'user_id'=>$this->Auth->user('id')
					)
				)
			),
			'order'=>'Article.id DESC'
		));
		$this->set('articles', $articles);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Article->recursive = 2;
		if (!$this->Article->exists($id)) {
			throw new NotFoundException(__('Invalid article'));
		}

		$data_view = array(
			'Viewed'=>array(
				'user_id' => $this->Auth->user('id'),
				'article_id' => $id
			)
		);
		$this->loadModel('Viewed');
		$view = $this->Viewed->find('first', array(
			'conditions'=>array(
				'Viewed.user_id' => $this->Auth->user('id'),
				'Viewed.article_id' => $id
			)
		));
		$viewed = !empty($view);
		if(!$viewed){
			$this->Viewed->save($data_view);
		}
		$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
		$this->set('article', $this->Article->find('first', $options));
		$this->set('viewed', $viewed);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Article']['user_id'] = $this->Auth->user('id');
			if ($this->Article->saveAll($this->request->data)) {
				$this->Flash->success(__('The article has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The article could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Article->Category->find('list');
		$keyWords = $this->Article->KeyWord->find('list');
		$users = $this->Article->User->find('list');
		$this->set(compact('users', 'categories', 'keyWords'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$article = $this->Article->findById($id);
		if (!$this->Article->exists($id) || ($article['Article']['user_id'] != $this->Auth->user('id'))) {
			throw new NotFoundException(__('Invalid article'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Article->saveAll($this->request->data)) {
				$this->Flash->success(__('The article has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The article could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Article.' . $this->Article->primaryKey => $id));
			$this->request->data = $this->Article->find('first', $options);
		}
		$categories = $this->Article->Category->find('list');
		$keyWords = $this->Article->KeyWord->find('list');
		$users = $this->Article->User->find('list');
		$this->set(compact('users', 'categories', 'keyWords'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Article->id = $id;
		if (!$this->Article->exists()) {
			throw new NotFoundException(__('Invalid article'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Article->delete()) {
			$this->Flash->success(__('The article has been deleted.'));
		} else {
			$this->Flash->error(__('The article could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * comment method
 *
 * @return void
 */
	public function comment() {
		if ($this->request->is('post')) {
			debug($this->request->data);die;
			$this->Article->Comment->create();
			$this->request->data['Comment']['user_id'] = $this->Auth->user('id');
			if ($this->Article->Comment->save($this->request->data)) {
				$this->Flash->success(__('The comment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The comment could not be saved. Please, try again.'));
			}
		}
	}
}

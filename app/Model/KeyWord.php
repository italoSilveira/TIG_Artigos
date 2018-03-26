<?php
App::uses('AppModel', 'Model');
/**
 * KeyWord Model
 *
 */
class KeyWord extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	/**
	 * hasAndBelongsToMany associations
	 *
	 * @var array
	 */
		public $hasAndBelongsToMany = array(
			'Article' => array(
				'className' => 'Article',
				'joinTable' => 'article_key_words',
				'foreignKey' => 'key_word_id',
				'associationForeignKey' => 'article_id',
				'unique' => 'keepExisting',
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'finderQuery' => '',
			),
			'User' => array(
				'className' => 'User',
				'joinTable' => 'user_key_words',
				'foreignKey' => 'key_word_id',
				'associationForeignKey' => 'user_id',
				'unique' => 'keepExisting',
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'finderQuery' => '',
			)
		);

}

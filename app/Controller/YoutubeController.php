<?php
App::uses('AppController', 'Controller');
class YoutubeController extends AppController {
	public $components = array(
		'GoogleAPI.GoogleAPI' => array(
			'Service' => array(
				'YouTube'
			)
		)
	);

	public function index() {
		$yt = $this->GoogleAPI->Service['YouTube'];
		$results = $yt->channels->listChannels('contentDetails', array(
			'id' => 'UChOqAOSVRNY19Cw1eHhtaVA'
		));
		// $likePlaylist = $results
		debug($results);die;
		foreach ($results['items'] as $item) {
			echo $item['snippet']['title'] . "<br /> \n";
		}
		die;
	}
}

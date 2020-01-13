<?php

namespace Drupal\pets_owners3\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

class ControllerPetsOwners extends ControllerBase{
	
	public function delete($node){
		 
	  
	$db_connection = \Drupal::database();
	$db_connection->delete('pets_owners3')->condition('id', $node)->execute();
	
	return [
		[
      '#type' => 'markup',
	  '#markup' => $this->t('Record witd ID = '. $node . ' delete '),
		],
		[
		'#type' => 'link',
		'#title' => $this->t('Back to table'),
		'#url' =>  Url::fromRoute('pets_owners3.admin_table'),
		]
	  ];
}
}
<?php

namespace Drupal\pets_owners3\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\pets_owners3\Form\FormPetsOwners;
use Drupal\Core\Url;

class EditPetsOwners extends FormPetsOwners{

	public $node;
	
	
	public function getFormId() {
    return 'pets_owners_edit';
    }
	
	
	public function buildForm(array $form, FormStateInterface $form_state, $node = NULL) {
		
		$this->node = $node;
		$db_connection = \Drupal::database();
		
	    $results = $db_connection->select('pets_owners3', 't')->fields('t')->condition('id', $node)
		->execute()
		->fetchAll();
		
		$form = parent::buildForm($form, $form_state);

		

		
		
		foreach ($results as $row){
		$form['name']['#default_value'] = $row->name;
		$form['gender']['#default_value'] = $row->gender;
		$form['prefix']['#default_value'] = $row->prefix;
		$form['age']['#default_value'] = $row->age;
		$form['parents']['father']['#default_value'] = $row->father_name;
		$form['parents']['mother']['#default_value'] = $row->mother_name;
		$form['pets_name']['#default_value'] = $row->pets_name;
		$form['email']['#default_value'] = $row->email;
		}
		
		
		return $form;
	}

	public function validateForm(array &$form, FormStateInterface $form_state) {
		parent::validateForm($form, $form_state);
	}
	
	public function submitForm(array &$form, FormStateInterface $form_state) {
		
		$row = [
			'name' => $form_state->getValue('name'),
			'gender' => $form_state->getValue('gender'),
			'prefix' => $form_state->getValue('prefix'),
			'age' => $form_state->getValue('age'),
			'father_name' => $form_state->getValue(['parents', 'father']),
			'mother_name' => $form_state->getValue(['parents', 'mother']),
			'pets_name' => $form_state->getValue('pets_name'),
			'email' => $form_state->getValue('email')
			];

		$db_connection = \Drupal::database();
		$db_connection->update('pets_owners3')
		->fields([
			'name' => $row['name'],
			'gender' => $row['gender'],
			'prefix' => $row['prefix'],
			'age' => $row['age'],
			'father_name' => $row['father_name'],
			'mother_name' => $row['mother_name'],
			'pets_name' => $row['pets_name'],
			'email' => $row['email'],
		])
		->condition('id', $this->node, '=')
		->execute();
		
		\Drupal::messenger()->addMessage('Record with ID '. $this->node . ' update sucsess');
		

		
	}
}
<?php

namespace Drupal\pets_owners3\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
/**
 * Class FormPetsOwners.
 *
 * @package Drupal\pets_owners\Form
 */
class TablePetsOwners extends FormBase {
  /**
   * @inheritDoc
   */
  public function getFormId() {
    return 'table_pets_owners';
  }
  
  public function buildForm(array $form, FormStateInterface $form_state) {
	 $form['table-row'] = [
      '#type' => 'table',
      '#header' => [
	    $this->t('Id'),
        $this->t('Name'),
        $this->t('Gender'),
        $this->t('Prefix'),
		$this->t('Age'),
		$this->t('Father name'),
		$this->t('Mother name'),
		$this->t('Pets name'),
		$this->t('Email'),
		$this->t('Edit'),
		$this->t('Delete')
      ],
      $form['form'] = [
        '#type' => 'link',
		'#title' => $this->t('Create new pets owners'),
        '#url' =>  Url::fromRoute('pets_owners3.form2'),
        '#weight' => 100,
      ]
    ];
	
	$db_connection = \Drupal::database();
	$results = $db_connection->select('pets_owners3', 't')->fields('t')->orderBy('id')->execute()->fetchAll();
	
	foreach ($results as $row) {
		$form['table-row'][$row->id]['id'] = [
        '#markup' => $row->id,
        ];
		
		$form['table-row'][$row->id]['name'] = [
        '#markup' => $row->name,
        ];
		
		$form['table-row'][$row->id]['gender'] = [
        '#markup' => $row->gender,
        ];
		
		$form['table-row'][$row->id]['prefix'] = [
        '#markup' => $row->prefix,
        ];
		
		$form['table-row'][$row->id]['age'] = [
        '#markup' => $row->age,
        ];
		
		$form['table-row'][$row->id]['father_name'] = [
        '#markup' => $row->father_name,
        ];
		
		$form['table-row'][$row->id]['mother_name'] = [
        '#markup' => $row->mother_name,
        ];
		
		$form['table-row'][$row->id]['pets_name'] = [
        '#markup' => $row->pets_name,
        ];
		
		$form['table-row'][$row->id]['email'] = [
        '#markup' => $row->email,
        ];
		
		$form['table-row'][$row->id]['edit'] = [
        '#type' => 'link',
		'#title' => $this->t('Edit'),
		'#url' =>  Url::fromRoute('pets_owners3.admin_table_edit', ['node' => $row->id]),
        ];
		
		$form['table-row'][$row->id]['delete'] = [
        '#type' => 'link',
		'#title' => $this->t('Delete'),
		'#url' =>  Url::fromRoute('pets_owners3.admin_table_delete', ['node' => $row->id]),
        ];
	}
	  
	return $form;
  }
  
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }
}
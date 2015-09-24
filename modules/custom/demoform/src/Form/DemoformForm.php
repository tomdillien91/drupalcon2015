<?php
/**
 * @file
 * Contains \Drupal\demoform\Form\DemoForm.
 */
namespace Drupal\demoform\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class DemoformForm extends ConfigFormBase
{
    /**
     * {@inheritdoc}.
     */
    public function getFormId() {
        return 'demo_form';
    }

    /**
     * {@inheritdoc}.
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $form = parent::buildForm($form, $form_state);

        $config = $this->config('demoform.settings');

        $form['firstname'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
            '#required' => true,
            '#attributes' => array(
                'class' => array('demo_form formfield firstname'),
            ),
        );
        $form['lastname'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Last Name'),
            '#required' => true,
            '#attributes' => array(
                'class' => array('demo_form formfield lastname'),
            ),
        );
        $form['email'] = array(
            '#type' => 'email',
            '#title' => $this->t('E-mail : '),
            '#required' => true,
            '#default_value' => $config->get('demoform.email_address'),
            '#attributes' => array(
                'class' => array('demo_form formfield email'),
            ),
        );
        $form['phone_number'] = array(
            '#type' => 'tel',
            '#title' => $this->t('Your phone number'),
            '#required' => true,
            '#attributes' => array(
                'class' => array('demo_form formfield phone_number'),
            ),
        );
        $form['description'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('Description'),
            '#required' => true,
            '#attributes' => array(
                'class' => array('demo_form formfield phone_number'),
            ),
        );

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {

        $createdFieldNames = $this->getCustomFieldsArray($form);

        if (array_intersect_key ($createdFieldNames, $form_state->getValues())) {
            foreach ($createdFieldNames as $fieldName) {
                $formValue =  $form_state->getValue($fieldName);
                switch (trim($fieldName)) {
                    case 'firstname' :
                    case 'lastname' :
                    case 'description' :
                        if (!filter_var($formValue, FILTER_VALIDATE_REGEXP,array( "options"=> array("regexp"=>'/[a-zA-Z\s]+/')))) {
                            $form_state->setErrorByName($fieldName, $this->t('This is not a valid last name.'));
                        }
                        break;
                    case 'tel' :
                        if (!filter_var($formValue, FILTER_VALIDATE_INT)) {
                            $form_state->setErrorByName($fieldName, $this->t('This is not a valid tel.'));
                        }
                        break;
                    case 'email' :
                        if (!filter_var($formValue, FILTER_VALIDATE_EMAIL)) {
                            $form_state->setErrorByName($fieldName, $this->t('This is not a valid email address.'));
                        }
                        break;
                }
            };
        }

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        //$this->store->set('email', $form_state->getValue('email'));
       // $this->store->set('name', $form_state->getValue('name'));
        // Save the data
        //parent::saveData();

        //$form_state->setRedirect('demo.multistep_two');

        return parent::submitForm($form, $form_state);
    }
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
//        return [
//            'demoform.settings',
//        ];
    }

    /**
     * @param array $form
     * @return array $createdFieldNames
     */
    protected function getCustomFieldsArray($form) {

        $createdFieldNames = array();
        $createdFieldNames = array_map (
            function($form) {
                if (array_key_exists('#title', $form) && !empty($form['#name'])) {
                    return $form['#name'];
                }
            }
            ,$form
        );

        return  array_filter($createdFieldNames);
    }
}

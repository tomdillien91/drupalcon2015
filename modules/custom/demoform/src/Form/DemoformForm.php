<?php
/**
 * @file
 * Contains \Drupal\demoform\Form\DemoForm.
 */
namespace Drupal\demoform\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

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
            '#attributes' => array(
                'class' => array('demo_form formfield firstname'),
            ),
        );
        $form['lastname'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Last Name'),
            '#attributes' => array(
                'class' => array('demo_form formfield lastname'),
            ),
        );
        $form['email'] = array(
            '#type' => 'email',
            '#title' => $this->t('E-mail : '),
            '#default_value' => $config->get('demoform.email_address'),
            '#attributes' => array(
                'class' => array('demo_form formfield email'),
            ),
        );
        $form['phone_number'] = array(
            '#type' => 'tel',
            '#title' => $this->t('Your phone number'),
            '#attributes' => array(
                'class' => array('demo_form formfield phone_number'),
            ),
        );
        $form['description'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('Description'),
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

        //TODO make a function of this
        $createdFieldNames = array();
        $createdFieldNames = array_map (
            function($form) {
                if (array_key_exists('#title', $form) && !empty($form['#name'])) {
                    return $form['#name'];
               }
            }
            ,$form
        );
        $createdFieldNames = array_filter($createdFieldNames);

        //TODO validate fields here
        if (array_intersect_key ($createdFieldNames, $form_state->getValues())) {
            foreach ($createdFieldNames as $fieldName) {
                switch ($fieldName) {
                    case 'firstname' :
                        break;
                    case 'lastname' :
                        break;
                }
            }
        }
//die();
//        if (strpos($form_state->getValue('email'), '.com') === FALSE ) {
//            $form_state->setErrorByName('email', $this->t('This is not a valid email address.'));
//        }

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        $config = $this->config('demoform.settings');

        $config->set('demoform.email_address', $form_state->getValue('email'));
        $config->save();

        return parent::submitForm($form, $form_state);
    }
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'demoform.settings',
        ];
    }
}
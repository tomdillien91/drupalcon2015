<?php

/**
 * @file
 * Contains \Drupal\reusableform\Controller\ReusableForm.
 */

namespace Drupal\reusableform\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * ReusableFormController.
 */
class ReusableFormController extends ControllerBase
{
    /**
     * Generates an example page with a form.
     */
    public function ff() {
        $config = \Drupal::config('reusableform.settings');
        //var_dump($config,$config->get('mytext'));

        return array(
            '#markup' => 'Hello DrupalCon World!',
        );
    }
}

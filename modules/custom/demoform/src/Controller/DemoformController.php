<?php

/**
 * @file
 * Contains \Drupal\demo\Controller\DemoController.
 */

namespace Drupal\demoform\Controller;

/**
 * DemoController.
 */
class DemoformController
{
    /**
     * Generates an example page.
     */
    public function demo() {
        return array(
            '#markup' => 'Hello DrupalConForm World!',
        );
    }
}

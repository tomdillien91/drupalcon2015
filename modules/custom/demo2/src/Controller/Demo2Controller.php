<?php

/**
 * @file
 * Contains \Drupal\demo2\Controller\Demo2Controller.
 */

namespace Drupal\demo2\Controller;

/**
 * DemoController.
 */
class Demo2Controller
{
    /**
     * Generates an example page.
     */
    public function demo() {
        return array(
            '#markup' => 'Hello DrupalCon World!',
        );
    }
}

<?php

/**
 * Implements hook_drush_command().
 */
function drush_steroids_drush_command() {

    $items['drush-steroids-command'] = array(
        'description' => 'My first native Drush command.',
        'aliases' => array('ddc'),
    );

    return $items;
}

/**
 * Callback for the drush-steroids-command command
 */
function drush_steroids_command() {
    demo_drush_print_statement();
}
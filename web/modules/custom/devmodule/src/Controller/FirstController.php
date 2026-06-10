<?php

namespace Drupal\devmodule\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for devmodule routes.
 */
class FirstController extends ControllerBase {

  /**
   * Returns a renderable array for the simple content route.
   *
   * @return array
   *   A renderable array containing markup.
   */
  public function simpleContent() {
    return [
      '#type' => 'markup',
      '#markup' => t('Hello Drupal world. Time flies like a banana.'),
    ];
  }

  /**
   * Returns a renderable array for the variable content route.
   *
   * @param string $name_1
   *   The first name parameter.
   * @param string $name_2
   *   The second name parameter.
   *
   * @return array
   *   A renderable array containing markup with both names.
   */
  public function variableContent($name_1, $name_2) {
    return [
      '#type' => 'markup',
      '#markup' => t('@name1 and @name2 say hello to you!',
        ['@name1' => $name_1, '@name2' => $name_2]),
    ];
  }

}

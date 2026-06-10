<?php

namespace Drupal\campus_resources\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block displaying a featured campus resource.
 *
 * @Block(
 *   id = "campus_resources_featured",
 *   admin_label = @Translation("Featured Campus Resource"),
 *   category = @Translation("Campus Resources")
 * )
 */
class FeaturedResourceBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t('Featured resource goes here'),
    ];
  }

}

<?php

namespace Drupal\campus_resources\Service;

use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Provides resource lookup functionality for campus resources.
 */
class ResourceLookupService {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a ResourceLookupService object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * Returns campus resource nodes, optionally filtered by type.
   *
   * @param string|null $type
   *   The resource type to filter by, or NULL to return all resources.
   *
   * @return \Drupal\node\NodeInterface[]
   *   An array of loaded node objects.
   */
  public function getResources(?string $type = NULL): array {
    $storage = $this->entityTypeManager->getStorage('node');
    $query = $storage->getQuery()
      ->condition('type', 'campus_resource')
      ->condition('status', 1)
      ->accessCheck(TRUE);

    if ($type) {
      $query->condition('field_field_resource_type', $type);
    }

    $nids = $query->execute();
    return $storage->loadMultiple($nids);
  }

}

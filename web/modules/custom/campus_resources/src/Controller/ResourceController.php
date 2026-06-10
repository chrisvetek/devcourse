<?php

namespace Drupal\campus_resources\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\campus_resources\Service\ResourceLookupService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for campus resource pages.
 */
class ResourceController extends ControllerBase {

  /**
   * The resource lookup service.
   *
   * @var \Drupal\campus_resources\Service\ResourceLookupService
   */
  protected $resourceLookup;

  /**
   * Constructs a ResourceController object.
   *
   * @param \Drupal\campus_resources\Service\ResourceLookupService $resource_lookup
   *   The resource lookup service.
   */
  public function __construct(ResourceLookupService $resource_lookup) {
    $this->resourceLookup = $resource_lookup;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('campus_resources.resource_lookup'));
  }

  /**
   * Renders the campus resources listing page.
   *
   * @return array
   *   A render array for the campus resources page.
   */
  public function index() {
    $type = \Drupal::requestStack()->getCurrentRequest()->query->get('type');
    $resources = $this->resourceLookup->getResources($type);

    $items = [];
    foreach ($resources as $node) {
      $items[] = [
        'title' => $node->getTitle(),
        'type' => $node->get('field_field_resource_type')->value,
      ];
    }

    $form = \Drupal::formBuilder()->getForm(
      'Drupal\campus_resources\Form\ResourceFilterForm'
    );

    return [
      'form' => $form,
      'results' => [
        '#theme' => 'campus_resources_page',
        '#resources' => $items,
        '#cache' => [
          'tags' => ['node_list:campus_resource'],
          'contexts' => ['url.query_args'],
          'max-age' => 3600,
        ],
      ],
    ];
  }

}

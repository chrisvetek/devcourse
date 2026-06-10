<?php

namespace Drupal\campus_resources\Form;

use Drupal\Core\Url;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a filter form for campus resources.
 */
class ResourceFilterForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'campus_resources_filter_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['resource_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Resource Type'),
      '#options' => ['' => '- Any -', 'room' => 'Room', 'service' => 'Service'],
    ];
    $form['submit'] = ['#type' => 'submit', '#value' => $this->t('Filter')];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Add validation logic here.
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Store filter value, redirect, or set session.
    $resource_type = $form_state->getValue('resource_type');

    $url = Url::fromRoute('campus_resources.list', [], [
      'query' => ['type' => $resource_type],
    ]);
    $form_state->setRedirectUrl($url);
  }

}

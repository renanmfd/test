<?php

namespace Drupal\rca_slider\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\WidgetInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * A widget for slider field.
 *
 * @FieldWidget(
 *   id = "rca_slider_widget",
 *   label = @Translation("RCA Slider"),
 *   field_types = {
 *     "rca_slider"
 *   }
 * )
 */

class SliderWidget extends WidgetBase implements WidgetInterface {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = [];
    $item = $items->get($delta);

    $required = FALSE;
    if ($delta == 0) {
      $required = TRUE;
    }
    $base = $element;

    $element['#type'] = 'fieldset';

    $element['title'] = $base + [
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#maxlength' => 255,
      '#default_value' => isset($item->title) ? $item->title : NULL,
      '#required' => $required,
    ];
    $element['image_fid'] = $base + [
      '#type' => 'managed_file',
      '#title' => t('Image'),
      '#upload_location' => 'public://',
      '#multiple' => FALSE,
      '#upload_validators'    => [
        'file_validate_is_image' => [],
        'file_validate_extensions' => ['gif png jpg jpeg'],
        'file_validate_size' => [25600000],
      ],
      '#default_value' => isset($item->image_fid) ? [$item->image_fid] : NULL,
      '#required' => $required,
    ];
    $element['text'] = $base + [
      '#type' => 'textarea',
      '#title' => t('Text'),
      '#maxlength' => 2048,
      '#default_value' => isset($item->text) ? $item->text : NULL,
    ];
    $element['link'] = $base + [
      '#type' => 'textfield',
      '#title' => t('Link'),
      '#maxlength' => 255,
      '#default_value' => isset($item->link) ? $item->link : NULL,
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    foreach ($values as $delta => $value) {
      $values[$delta]['image_fid'] = $value['image_fid'][0];
    }
    return $values;
  }

}

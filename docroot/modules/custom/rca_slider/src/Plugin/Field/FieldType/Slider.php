<?php

namespace Drupal\rca_slider\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Provides a field type for sliders.
 * 
 * @FieldType(
 *   id = "rca_slider",
 *   label = @Translation("RCA Slider"),
 *   default_formatter = "rca_slider_formatter",
 *   default_widget = "rca_slider_widget",
 * )
 */

class Slider extends FieldItemBase implements FieldItemInterface {
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'title' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
        ),
        'image_fid' => array(
          'type' => 'int',
          'not null' => TRUE,
          'default' => 0,
        ),
        'text' => array(
          'type' => 'varchar',
          'length' => 2048,
          'not null' => FALSE,
        ),
        'link' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => FALSE,
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = [];
    $properties['title'] = DataDefinition::create('string');
    $properties['image_fid'] = DataDefinition::create('integer');
    $properties['text'] = DataDefinition::create('string');
    $properties['link'] = DataDefinition::create('string');

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $title = $this->get('title')->getValue();
    $image_fid = $this->get('image_fid')->getValue();
    return $title === NULL || $image_fid === NULL || $title === '' || $image_fid === 0;
  }

}

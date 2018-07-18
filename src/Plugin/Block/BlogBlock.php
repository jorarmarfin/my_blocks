<?php

namespace Drupal\my_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'BlogBlock' block.
 *
 * @Block(
 *  id = "blog_block",
 *  admin_label = @Translation("Blog block"),
 * )
 */
class BlogBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $data = $this->getData();
    $build['#theme'] = 'my_blocks_blog';
    $build['#data'] = $data;

    dump($data);
    return $build;
  }
  public function getData()
  {
    $entity = \Drupal::entityQuery('node');
    $entity->condition('type', 'predicadores');
    $entity->range(0,5);
    $nids = $entity->execute();

    $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

    $i = 0;
    $data = [];
    foreach ($nodes as $key => $node) {
      $data[$i]['title'] = $node->title->value;
      $data[$i]['imagen'] = file_create_url($node->field_image->entity->getFileUri())
      $i++;
    }


    return $data;
  }


}

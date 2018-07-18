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

    return $build;
  }
  public function getData()
  {
    $entity = \Drupal::entityQuery('node');
    $entity->condition('type', 'personal');
    $entity->range(0,5);
    $nids = $entity->execute();

    $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

    return $nodes;
  }


}

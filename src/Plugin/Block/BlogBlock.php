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
    $data = [];
    $build['#theme'] = 'my_blocks_blog';
    $build['#data'] = $data;

    $this->getData();

    //return $build;
  }
  public function getData()
  {
    $entity = \Drupal::entityQuery('node');
    $entity->condition('type', 'predicadores');
    $nids = $entity->execute();

    dump(count($nids));
    dump('111');
    /*
    $entity->condition('field_aprobado_pero_no_iniciado', '0', '=');
    $entity->sort('title', 'ASC');
    $nids = $entity->execute();
    $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);*/
  }


}

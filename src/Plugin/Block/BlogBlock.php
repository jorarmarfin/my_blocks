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
    $build['#theme'] = 'my_blocks_blog';
    $build['#data'] = $this->getData();


    return $build;
  }
  public function getData()
  {
    $entity = \Drupal::entityQuery('node');
    $entity->condition('type', 'article');
    $entity->range(0,3);
    $nids = $entity->execute();

    $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);

    $i = 0;
    $data = [];
    foreach ($nodes as $key => $node) {
      $data[$i]['title'] = $node->title->value;
      $data[$i]['summary'] = $node->body->summary;
      $data[$i]['fecha'] = $node->created;
      //$data[$i]['imagen'] = file_create_url($node->field_image->entity->getFileUri());
      $i++;
    }
    //dump($data);

    return $nodes;
  }


}
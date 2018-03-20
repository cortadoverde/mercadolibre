<?php

namespace Cortadoverde\Mercadolibre\Resource;


class Picture extends Client
{
  public function create( $file_path )
  {

    $query = array_merge(
      [ 'multipart' => [
          [
            'name' => 'file',
            'contents' => fopen( $file_path, 'r')
          ]
        ]
      ],
      $this->setQuery()
    );
    //return $query;
    return $this->post('/pictures', $query );
  }

  public function get_picture( $picture_id )
  {
    return $this->get("/pictures/{$picture_id}", $this->setQuery());
  }

  public function delete_picture( $picture_id )
  {
    return $this->delete( "/pictures/{$picture_id}", $this->setQuery() );
  }

  public function add_item_picture( $item_id, $picture_id )
  {
    return $this->post( "/items/{$item_id}/pictures", array_merge( $this->setQuery(), $this->setBody(['picture_id' => $picture_id] ) ) );
  }

  public function replace_item_pictures( $item_id, array $pictures )
  {
    return $this->put("/items/{$item_id}" , array_merge( $this->setQuery(), $this->setBody( $pictures ) ) );
  }
  



}

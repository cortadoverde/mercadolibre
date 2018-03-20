<?php

namespace Cortadoverde\Mercadolibre\Resource;


class Category extends Client
{
  public function get_categories($site_id)
  {
    return $this->get("/sites/{$site_id}/categories", []);
  }

  public function get_category( $category_id )
  {
    return $this->get("/categories/{$category_id}",[]);
  }

  public function get_category_attributes( $category_id )
  {
    return $this->get("/categories/{$category_id}/attributes");
  }

  public function get_category_prediction( $site_id, $args )
  {
    return $this->get("/sites/{$site_id}/category_predictor/predict", $this->setQuery($args) );
  }

  public function get_multiple_category_prediction( $site_id, $category_data )
  {
    return $this->post("/sites/{$site_id}/category_predictor/predict", $this->setBody( $category_data ) );
  }

}

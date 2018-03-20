<?php

namespace Cortadoverde\Mercadolibre\Resource;


class User extends Client
{
  public function get_users( $users_ids )
  {
    return $this->get('/users', $this->setQuery($users_ids) );
  }

  public function get_user( $user_id )
  {
    return $this->get("/users/{$user_id}", $this->setQuery());
  }

  public function get_me()
  {
    return $this->get("/users/me", $this->setQuery());
  }

  public function update_user( $user_id, $attrs )
  {
    return $this->put("/users/{$user_id}", array_merge( $this->setQuery(), $this->setBody($attrs) ) );
  }

}

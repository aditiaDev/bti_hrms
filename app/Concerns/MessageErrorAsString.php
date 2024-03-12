<?php
// app/Concerns/MessageErrorAsString.php

namespace App\Concerns;

use Illuminate\Support\MessageBag;

trait MessageErrorAsString
{
  /**
   * Convert null values to 0.
   *
   * @param  mixed  $value
   * @return mixed
   */
  public function getMessageAsString(MessageBag $messages)
  {
    $messagesString = '';
    foreach ($messages->all() as $message) {
      $messagesString .= $message . '</br>';
    }
    return trim($messagesString);
  }
}

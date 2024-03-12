<?php
// app/Concerns/ConvertNullToZero.php

namespace App\Concerns;

use Maatwebsite\Excel\Concerns\ToModel;

trait ConvertNullToZero
{
  /**
   * Convert null values to 0.
   *
   * @param  mixed  $value
   * @return mixed
   */
  public function convertNullToZero($value)
  {
    return $value ?? 0;
  }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Config extends Model
{
    
    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
      $attributes = parent::toArray();
      
      foreach ($this->getTranslatableAttributes() as $name) {
          $attributes[$name] = $this->getTranslation($name, app()->getLocale());
      }
      
      return $attributes;
    }  
    protected $fillable = [
      'MAIL_FROM_NAME',
      'MAIL_FROM_ADDRESS',
      'MAIL_DRIVER',
      'MAIL_HOST',
      'MAIL_PORT',
      'MAIL_USERNAME',
      'MAIL_PASSWORD',
      'MAIL_ENCRYPTION',
    ];

    
}

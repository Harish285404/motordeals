<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Session;

class Category extends Model
{
    use HasFactory;
    
    protected $appends = ['image_url'];
    
    // public function getTranslatedNameAttribute()
    // { 
    //     $langId = Session::get('language');

    //     // Check if the language session key exists
    //      if ($langId=='ar') {
    //         // Translate the name if the session key is present
    //         return GoogleTranslate::trans($this->name, $langId);
    //     }

    //     // Return the original name if the session key is not present
    //     return $this->name;
    // }
    
    public function getImageUrlAttribute()
    {   
        $images = $this->image;
        $image_url = 'https://f.motordeals.net/User-images/'.$images;
        return $image_url;
    }
    
    public function toArray()
    {
        $array = parent::toArray();
        foreach ($this->getMutatedAttributes() as $key)
        {
            if (!array_key_exists($key, $array)) {
                $array[$key] = $this->{$key};   
            }
        }
        return $array;
    } 
}

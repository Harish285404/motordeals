<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
use Illuminate\Support\Facades\App;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Wishlist;

class Product extends Model
{
    use HasFactory;
    
    protected $appends = ['image_url', 'formatted_date', 'wishlist'];

    // public function getTranslatedNameAttribute()
    // { 
    //     $langId = Session::get('language');
        
    //     if ($langId=='ar') {
    //         // Translate the name if the session key is present
    //         return GoogleTranslate::trans($this->name, $langId);
    //     }

    //     // Return the original name if the session key is not present
    //     return $this->name;
    // }

    public function getImageUrlAttribute()
    {   
        $images = $this->image;
        $imageArray = explode(',', $images);
        $firstImage = trim($imageArray[0]);
        $image_url = 'https://f.motordeals.net/User-images/'.$firstImage;
        return $image_url;
    }
    
    public function getFormattedDateAttribute()
    {
        $langCode = Session::get('language');

       if ($langCode=='ar') {
            App::setLocale($langCode);
            return $this->created_at->translatedFormat('d F Y');
        }

        // Return default formatted date if session key is not present
        return $this->created_at->format('d F Y');
    }

    public function getWishlistAttribute()
    {
        $user_id = Auth::id();

        // Find the wishlist entry for this user and product
        $wishlistEntry = Wishlist::where('user_id', $user_id)
                                 ->where('product_id', $this->id)
                                 ->first(['status']);

        // If the entry exists and has a status, return 1; otherwise, return 0
        $status = $wishlistEntry && $wishlistEntry->status ? 1 : 0;

        return $status;
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


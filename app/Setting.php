<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable =['name','logo','firebase_api_key','favion','firebase_server_key','google_api_key','google_store_link','apple_store_link','facebook_link','twitter_link','youtube_link','instagram_link','order_prefix','top_nav_color','side_nav_color','active_tab_color'];
}

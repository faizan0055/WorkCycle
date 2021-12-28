<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cuisine;
use App\ChargesRestaurant;
use App\Product;
use App\Extra;
use App\Rating;
use App\AddOnTitle;
use App\MinimumCredit;
use App\History;
use App\Deal;
use App\Banner;
use App\Optional;
use App\Required;
use App\Chapter;
use App\WorkingHour;
use App\SearchFilter;
use App\DealRestaurant;
use App\DealProduct;
use App\Voucher;
use App\Charge;
use Illuminate\Support\Facades\URL;
use DB;
use Illuminate\Support\Facades\Validator;


if (!defined('BASE_URL_PRODUCT')) define('BASE_URL_PRODUCT',URL::to('/').'/images/product_images/');
if (!defined('BASE_URL_RESTAURANT')) define('BASE_URL_RESTAURANT',URL::to('/').'/images/restaurant_images/');
if (!defined('BASE_URL_CUISINE')) define('BASE_URL_CUISINE',URL::to('/').'/images/cuisine/');
if (!defined('BASE_URL_BANNER')) define('BASE_URL_BANNER',URL::to('/').'/images/offers/');
date_default_timezone_set("Asia/Karachi");

class IndexController extends Controller
{
    function inside($point, $fenceArea) {
      $x = $point['latitude']; $y = $point['longitude'];

      $inside = false;
      for ($i = 0, $j = count($fenceArea) - 1; $i <  count($fenceArea); $j = $i++) {
          $xi = $fenceArea[$i][1]; $yi = $fenceArea[$i][0];
          $xj = $fenceArea[$j][1]; $yj = $fenceArea[$j][0];

          $intersect = (($yi > $y) != ($yj > $y))
              && ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);
          if ($intersect) $inside = !$inside;
      }

      return $inside;
    }
   public function index(Request $request)
   {
        $latitude=$request->lat;
        $longitude=$request->lng;
        $radius = env('RADIUS');
        $nearbyRestaurants = MinimumCredit::with('cuisines')
        ->selectRaw("id, name, address, latitude, longitude, slogan, logo, city,cover_image, avg_delivery_time, delivery,min_order,payment_type,
                     ( 6371 * acos( cos( radians(?) ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians(?)
                       ) + sin( radians(?) ) *
                       sin( radians( latitude ) ) )
                     ) AS distance", [$latitude, $longitude, $latitude])
        // ->selectRaw("id, name, address, latitude, longitude, slogan, logo, city,cover_image, avg_delivery_time, delivery,min_order,payment_type")
        ->having('distance','<',$radius)
        ->where('services','!=','pickup')
        ->where('is_open',1)
        ->where('approved',1)
        ->orderBy("distance",'asc')
        ->get();

    $trendingCuisine=Cuisine::get();
    $deals=Deal::where('status',1)->get();

    // $trendingProducts=DB::table('products')
    //         ->join('restaurants', 'restaurants.id', '=', 'products.restaurant_id')
    //         ->selectRaw("products.id,products.name as product_name,products.category_id,products.price,products.featured,products.image,restaurants.id as restaurant_id,restaurants.name as resturant_name,
    //         ( 6371 * acos( cos( radians(?) ) *
    //       cos( radians( restaurants.latitude ) )
    //       * cos( radians( restaurants.longitude ) - radians(?)
    //       ) + sin( radians(?) ) *
    //       sin( radians( restaurants.latitude ) ) )
    //     ) AS distance",[$latitude, $longitude, $latitude])
    //         ->having('distance','<',$radius)
    //         ->get();

    $featuredRestaurant=MinimumCredit::with('cuisines')
    ->selectRaw("id, name, address, latitude, longitude, slogan, logo, city,cover_image, avg_delivery_time, delivery,min_order,payment_type,
        ( 6371 * acos( cos( radians(?) ) *
          cos( radians( latitude ) )
          * cos( radians( longitude ) - radians(?)
          ) + sin( radians(?) ) *
          sin( radians( latitude ) ) )
        ) AS distance", [$latitude, $longitude, $latitude])
    ->where('featured', '=', 1)
    ->where('services','!=','pickup')
    ->where('is_open',1)
    ->where('approved',1)
    ->having('distance','<',$radius)
    ->orderBy("distance",'asc')
    ->limit(20)
    ->get();

// $trendingProduct = [];
//     foreach ($trendingProducts as $key => $product) {
//       $hours = WorkingHour::where('restaurant_id',$product->restaurant_id)->where('status',1)->get();
//       $hours = $hours->groupBy('Day');
//       $product->is_open = 0;
//       foreach ($hours as $key => $hour) {
//         if($key == date('l')){
//           foreach ($hour as $key1 => $value) {
//             if($value->opening_time < date('H:i:s') && $value->closing_time > date('H:i:s')){
//               $product->is_open = 1;
//             }
//           }
//         }
//       }
//       if(count($trendingProduct) < 8){
//           if($product->is_open == 1){
//             $trendingProduct[] = $product;
//           }
//       }else{
//           break;
//       }
//     }
    $charges = Charge::first();
    foreach ($nearbyRestaurants as $restaurant) {
        $restaurant['distance'] = number_format($restaurant->distance,2);
        $restaurant['ratings'] = number_format($restaurant->ratings()->avg('rating'),2);
        $restaurant['rating_by'] = $restaurant->ratings()->count();
        $hours = WorkingHour::where('restaurant_id',$restaurant->id)->where('status',1)->where('Day',date('l'))->where('opening_time','<',date('H:i:s'))->where('closing_time','>',date('H:i:s'))->count();
        $restaurant['is_open'] = $hours == 0 ? 0 : 1 ;
        if($charges->distance < $restaurant->distance){
            $chars=$restaurant->distance/$charges->distance - 1;
            $restaurant['delivery']=number_format($charges->delivery_fee + $chars * $charges->increment,2);
        }
        else{
            $restaurant['delivery']= number_format($charges->delivery_fee,2);
        }
    }
    // return response()->json(['nearby'=>$nearbyRestaurants,'inside'=>$nearbyRestaurant]);
  // pagination
    $nearbyRestaurants = Controller::pagination($nearbyRestaurants,10,$request,'home_data');

    foreach ($featuredRestaurant as $restaurant) {
        $restaurant['distance'] = number_format($restaurant->distance,2);
        $restaurant['ratings'] = number_format($restaurant->ratings()->avg('rating'),2);
        $restaurant['rating_by'] = $restaurant->ratings()->count();
        $hours = WorkingHour::where('restaurant_id',$restaurant->id)->where('status',1)->where('Day',date('l'))->where('opening_time','<',date('H:i:s'))->where('closing_time','>',date('H:i:s'))->count();
        $restaurant['is_open'] = $hours == 0 ? 0 : 1 ;
        if($charges->distance < $restaurant->distance){
            $chars=$restaurant->distance/$charges->distance - 1;
            $restaurant['delivery']=number_format($charges->delivery_fee + $chars * $charges->increment,2);
        }
        else{
            $restaurant['delivery']= number_format($charges->delivery_fee,2);
        }
    }

    $banners=Banner::get();
   return response()->json([
    'status' =>true,
     'nearbyRestaurants' =>$nearbyRestaurants,
    'featuredRestaurants' =>$featuredRestaurant,
    'trendingCuisine' =>$trendingCuisine,
    // 'trendingProduct' =>$trendingProduct,
     'banners' => $banners,
     'deals' => $deals,
     'BASE_URL_PRODUCT'=>BASE_URL_PRODUCT,
     'BASE_URL_RESTAURANT'=>BASE_URL_RESTAURANT,
     'BASE_URL_CUISINE'=>BASE_URL_CUISINE,
     'BASE_URL_BANNER'=>BASE_URL_BANNER,
   ]);
   }

   //
   public function get_restaurant_by_deal(Request $request, $deal){
      $latitude = $request->lat;
      $longitude = $request->lng;
      $res_id = DealRestaurant::where('deal_id',$deal)->where('day',date('l'))->where('status',1)->get();
      $res_id = $res_id->pluck('restaurant_id')->toArray();
      $restaurants = MinimumCredit::with('cuisines')->selectRaw("id, name, address, latitude, longitude, slogan, logo, city,cover_image, avg_delivery_time,min_order ,delivery,payment_type,
                     ( 6371 * acos( cos( radians(?) ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians(?)
                       ) + sin( radians(?) ) *
                       sin( radians( latitude ) ) )
                     ) AS distance", [$latitude, $longitude, $latitude])
        ->having('distance','<',env('RADIUS'))
        ->orderBy("distance",'asc')
        ->whereIn('id',$res_id)
        ->where('is_open',1)
        ->where('approved',1)
        ->get();
      $charges = Charge::first();
      foreach ($restaurants as $restaurant) {
          $restaurant['ratings'] = number_format($restaurant->ratings()->avg('rating'),2);
          $restaurant['rating_by'] = $restaurant->ratings()->count();
          $hours = WorkingHour::where('restaurant_id',$restaurant->id)->where('status',1)->where('Day',date('l'))->where('opening_time','<',date('H:i:s'))->where('closing_time','>',date('H:i:s'))->count();
          $restaurant['is_open'] = $hours == 0 ? 0 : 1 ;
          if($charges->distance < $restaurant->distance){
            $chars=$restaurant->distance/$charges->distance - 1;
            $restaurant['delivery']=number_format($charges->delivery_fee + $chars * $charges->increment,2);
          }
          else{
            $restaurant['delivery']= number_format($charges->delivery_fee,2);
          }
      }
      return response()->json([
          'status'=>true,
          'data'=>$restaurants,
          'BASE_URL_RESTAURANT'=>BASE_URL_RESTAURANT,
          'BASE_URL_CUISINE'=>BASE_URL_CUISINE,
      ]);
   }

   public function get_pickup_restaurant(Request $request){
        $latitude=$request->lat;
        $longitude=$request->lng;
        $nearbyRestaurants = MinimumCredit::with('cuisines')->selectRaw("id, name, address, latitude, longitude, slogan, logo, city,cover_image, avg_delivery_time, min_order, delivery,payment_type,
                     ( 6371 * acos( cos( radians(?) ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians(?)
                       ) + sin( radians(?) ) *
                       sin( radians( latitude ) ) )
                     ) AS distance", [$latitude, $longitude, $latitude])
        ->having('distance','<',env('RADIUS'))
        ->orderBy("distance",'asc')
        ->orWhere('services','pickup')->orWhere('services','both')
        ->where('is_open',1)
        ->where('approved',1)
        ->get();

        foreach ($nearbyRestaurants as $restaurant) {
            $restaurant['distance'] = number_format($restaurant->distance,2);
            $restaurant['ratings'] = number_format($restaurant->ratings()->avg('rating'),2);
            $restaurant['rating_by'] = $restaurant->ratings()->count();
            $hours = WorkingHour::where('restaurant_id',$restaurant->id)->where('status',1)->where('Day',date('l'))->where('opening_time','<',date('H:i:s'))->where('closing_time','>',date('H:i:s'))->count();
            $restaurant['is_open'] = $hours == 0 ? 0 : 1 ;
            $restaurant['delivery'] = 'false';
        }
        return response()->json([
            'status'=>true,
            'data'=>$nearbyRestaurants,
            'BASE_URL_RESTAURANT'=>BASE_URL_RESTAURANT,
            'BASE_URL_CUISINE'=>BASE_URL_CUISINE,
        ]);
   }

   public function filter(Request $request){
      $validator = Validator::make(
        $request->all(),
        array(
          'lat'=>'required',
          'lng'=>'required',
          'review'=>'nullable|integer',
          'delivery_cost'=>'nullable',
          'delivery_time'=>'nullable|integer',
          'order_size'=>'nullable'
        ));
      if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
      }
      else
      {
          $latitude = $request->lat;
          $longitude = $request->lng;
          $Review = $request->review ? $request->review:0 ;
          $Distance = env('RADIUS');
          $Delivery_Cost = $request->delivery_cost ? $request->delivery_cost:'10000';
          $Delivery_Time = $request->delivery_time ? $request->delivery_time:10000;
          $Order_size = $request->order_size ?? false;

          $Restaurants = MinimumCredit::with('cuisines')->selectRaw("id, name, address, latitude, longitude, slogan, logo, city,cover_image, avg_delivery_time, delivery,min_order,payment_type,avg_order_size,
                       ( 6371 * acos( cos( radians(?) ) *
                         cos( radians( latitude ) )
                         * cos( radians( longitude ) - radians(?)
                         ) + sin( radians(?) ) *
                         sin( radians( latitude ) ) )
                       ) AS distance", [$latitude, $longitude, $latitude])
          ->having('distance','<',$Distance)
          ->where('is_open',1)
          ->where('approved',1)
          ->where('avg_delivery_time','<=',$Delivery_Time)->orderBy("distance",'asc')->get();
          if($Order_size && $Order_size != ''){
            $Restaurants = $Restaurants->where('avg_order_size',$Order_size);
          }

          $nearbyRestaurants = [];
          $charges = Charge::first();

          foreach ($Restaurants as $restaurant) {
            $restaurant['ratings'] = $restaurant->ratings()->avg('rating');
            $voucher = Voucher::where('restaurant_id',$restaurant->id)->where('no_of_use','>',0)->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->where('type','free delivery')->count();
            if($charges->distance < $restaurant->distance){
                $chars=$restaurant->distance/$charges->distance - 1;
                $restaurant['delivery']=number_format($charges->delivery_fee + $chars * $charges->increment,2);
            }
            else{
                $restaurant['delivery']= number_format($charges->delivery_fee,2);
            }

            if($restaurant->ratings >= $Review){
              $restaurant['distance'] = number_format($restaurant->distance,2);
              $restaurant['ratings'] = number_format($restaurant['ratings'],2);
              $restaurant['rating_by'] = $restaurant->ratings()->count();
              $hours = WorkingHour::where('restaurant_id',$restaurant->id)->where('status',1)->where('Day',date('l'))->where('opening_time','<',date('H:i:s'))->where('closing_time','>',date('H:i:s'))->count();
              $restaurant['is_open'] = $hours == 0 ? 0 : 1 ;
              if($Delivery_Cost == 'free' && $voucher > 0){
                $restaurant['delivery'] = 0;
                $nearbyRestaurants[] = $restaurant;
              }elseif($Delivery_Cost == '10000'){
                $nearbyRestaurants[] = $restaurant;
              }
            }

          }

          $response_array = array('status'=>true, 'error_code'=>200, 'Restaurants'=>$nearbyRestaurants);
      }
      return response()->json($response_array);
   }

   public function searchQurey(Request $request)
   {
    $validator = Validator::make(
            $request->all(),
            array(
                'qurey'=>'required',
            ));
         $searchTerm=$request->qurey;
        if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }
        else {
          $resultData=MinimumCredit::
        where('name', 'like', '%'.$searchTerm.'%')->
        orWhere('keywords','%'.$searchTerm.'%')->get();

   return response()->json([
    'status' =>true,
    'search' =>$resultData,
   ]);
        }
   }

    public function productSearchQurey(Request $request)
   {
    $validator = Validator::make(
            $request->all(),
            array(
                'qurey'=>'required',
                'restaurant_id'=>'required',
            ));
         $searchTerm=$request->qurey;
        if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }
        else {
          $resultData=Product::where('name', 'like', '%'.$searchTerm.'%')->where('restaurant_id',$request->restaurant_id)->get();

           return response()->json([
          'status' =>true,
          'search_products' =>$resultData,
            ]);
        }
   }

   public function restaurantDetail($restaurant)
   {
        $restaurantDetail=MinimumCredit::with('cuisines')->find($restaurant);
        $restaurantDetail['rating']=number_format($restaurantDetail->ratings()->avg('rating'),2);
        $restaurantDetail['rate_by']=$restaurantDetail->ratings()->count();
        $hours = WorkingHour::where('restaurant_id',$restaurantDetail->id)->where('status',1)->where('Day',date('l'))->where('opening_time','<',date('H:i:s'))->where('closing_time','>',date('H:i:s'))->count();
        $restaurantDetail['is_open'] = $hours == 0 ? 0 : 1 ;

        $deal_restaurant_ids = DealRestaurant::where('restaurant_id',$restaurant)->where('day',date('l'))
        ->with(['deal'=>function($q){$q->select('id','name','type');}])
        ->with('product')
        ->select('id','deal_id')->get();

        $RestaurantCate=Chapter::with(['products'=>function($q) use ($restaurant){$q->where('restaurant_id',$restaurant);}])->where('restaurant_id',$restaurant)->get();
        return response()->json([
        'status'=> true,
        'data' =>$restaurantDetail,
        'categoryWithPro' =>$RestaurantCate,
        'dealWithPro' =>$deal_restaurant_ids,
        ]);
   }

   public function restaurantReviews($restaurant)
   {
        $restaurantReview=DB::table('ratings')
        ->join('users', 'users.id', '=', 'ratings.user_id')
        ->select('users.name', 'users.id', 'ratings.rating','ratings.reviews','ratings.created_at')->where('ratings.restaurant_id',$restaurant)
        ->get();
        return response()->json([
        'status'=> true,
        'reviews' =>$restaurantReview,
        ]);
   }

   public function proDetail($id)
   {
        $proDetail=Product::findOrFail($id);
         $addonTitle = AddOnTitle::where('restaurant_id',$proDetail->restaurant_id)->get();
         $data['Title'] = [];$i=0;$j=0;
         foreach($addonTitle as $key => $addontitle){
            if($addontitle->addon->where('product_id',$id)->count() > 0){
              $data['Title'][$i]['name'] = $addontitle->title;
              foreach($addontitle->addon->where('product_id',$id) as $key1 => $addon){
                $data['Title'][$i]['is_required'] = $addon->is_required;
                $data['Title'][$i]['addon'][$j] = $addon;
                $j++;
              }
              $j=0;
              $i++;
            }
         }
         $proDetail['Title'] = $data['Title'];

        return response()->json([
          'status'=> true,
          'data' => $proDetail,
          ]);
   }

    public function banner($id)
   {
        $banner=Banner::with('client')->find($id);

        $restaurant['ratings'] = number_format($banner->restaurant->ratings()->avg('rating'),2);
       // $client['rating_by'] = $banner->client->ratings()->count();


        return response()->json([
        'status'=> true,
        'data' =>$banner,
        ]);
   }
}

<?php

namespace App\Http\Services;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Traits\ApiTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RatingResources;
use App\Models\Movie;

class RatingService {
    
    use ApiTrait;
    public function createRating($data,$id_movie){
        try {
            $movie = Movie::find($id_movie);
            // في حال عدم العثور على الفيلم المراد تقيمه يرد رسالة خطأ
            if(!$movie){
                return $this->customeResponse('not found', 404);
            }
            $id_user = Auth::id();
            $rating = Rating::create([
                'user_id' => $id_user,
                'movie_id' => $id_movie,
                'rating' => $data['rating'],
                'review' => $data['review'],
            ]);
            return $this->Response(new RatingResources($rating), "rating created successfully", 201);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with creating rating', 400);
        }
    }

    //========================================================================================================================

    public function showRating($id){
        try {
            $rating = Rating::find($id);
            // في حال عدم العثور على التقييم يرد رسالة خطأ
            if(!$rating){
                return $this->customeResponse('not found', 404);
            }
            return $this->Response(new RatingResources($rating), "view rating successfully", 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with view rating', 400);
        }
    }

    //========================================================================================================================

    public function updateRating($data,$id_rating){
        try {
            $updatrating = Rating::find($id_rating);
            // في حال عدم العثور على التقييم يرد رسالة خطأ
            if(!$updatrating){
                return $this->customeResponse('not found', 404);
            }

            //التحقق في ما إذا كان التعليق يعود لنفس اليوزر
            $chack_rating_user = Rating::where('user_id' , Auth::id())->where('id' , $id_rating)->first();

            if($chack_rating_user){ 

                $updatrating->update($data);
                return $this->Response(new RatingResources($updatrating), "update rating successfully", 200);

            }else{
                return $this->Response(null, "you can not update this rating , do not referance to you", 400);
            }

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with update rating', 400);
        }
    }

    //========================================================================================================================

       public function deleteRating($id_rating){
        try {
            $rating = Rating::find($id_rating);
            // في حال عدم العثور على التقييم يرد رسالة خطأ
            if(!$rating){
                return $this->customeResponse('not found', 404);
            }

            //التحقق في ما إذا كان التعليق يعود لنفس اليوزر
            $chack_rating_user = Rating::where('user_id' , Auth::id())->where('id' , $id_rating)->first();

            if($chack_rating_user){ 

                $rating->delete();
                return $this->Response(null, "delete rating successfully", 200);

            }else{
                return $this->Response(null, "you can not delete this rating , do not referance to you", 400);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with delete rating', 400);
        }
    }
}

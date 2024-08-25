<?php

namespace App\Http\Services;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Traits\ApiTrait;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\MovieResources;

class MovieService {
    
    use ApiTrait;
    public function getAllMovies(Request $request){
        try {
            //في حال وصول قيمة لعرض عدد أفلام محددة ضمن الصفحة الواحدة يتم تخزين القيمة ضمن المتحول itemperpage
            $itemPerPage = $request->input('per_page',10);
            
            //إن شاء كويري من الموديل لتتم معالحتها تاليا من خلال الغرض movie
            $query = Movie::query();

            //في حال وصول قيمة لعرض أفلام ذات تصنيف محدد ضمن الصفحة يتم تخزين القيمة ضمن المتحول query
            if(!empty($request->genre)){
                $query = Movie::where('category_id', '=' , $request->genre);
            }

            //في حال وصول قيمة لعرض أفلام ذات مخرج محدد ضمن الصفحة يتم تخزين القيمة ضمن المتحول query
            if(!empty($request->director)){
                $query->where('director', '=', $request->director);
            }

            //في حال وصول قيمة لعرض أفلام بالترتيب التصاعدي أو التنازلي على حسب عمود السنة ضمن الصفحة يتم تخزين القيمة ضمن المتحول query
            if (!empty($request->release_year)) {
                $release_year = $request->input('release_year', 'asc'); 
                $query->orderBy('release_year', $release_year);
            }

            // أخيرا يتم تنفيذ الpagination على الكويري النهائية
            $movies = $query->paginate($itemPerPage);
            
            $allMovie = MovieResources::collection($movies);

            return $this->Response($allMovie, "all movies fetched successfully", 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse($th->getMessage(), 400);
        }
    }

    //========================================================================================================================

    public function createMovie($data){
        try {
            if(!$data){
                return $this->customeResponse('not found', 404);
            }
            $movie = Movie::create($data);
            return $this->Response(new MovieResources($movie), "movie created successfully", 201);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with creating movie', 400);
        }
    }

    //========================================================================================================================

    public function showMovie(Movie $movie){
        try {
            //في حال عدم العثور على الفيلم يرد رسالة خطأ
            if(!$movie){
                return $this->customeResponse('not found', 404);
            }
            return $this->Response(new MovieResources($movie), "view Movie successfully", 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with view Movie', 400);
        }
    }

    //========================================================================================================================

    public function updateMovie($data,Movie $movie){
        try {
            //في حال عدم العثور على الفيلم يرد رسالة خطأ
            if(!$movie){
                return $this->customeResponse('not found', 404);
            }
            $updatemovie = $movie;
            $updatemovie->update($data);
            return $this->Response(new MovieResources($updatemovie), "update movie successfully", 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with update movie', 400);
        }
    }

    //========================================================================================================================

       public function deleteMovie(Movie $movie){
        try {
            //في حال عدم العثور على الفيلم يرد رسالة خطأ
            if(!$movie){
                return $this->customeResponse('not found', 404);
            }
            $deletemovie = $movie;
            $deletemovie->delete();
            return $this->Response(null, "delete movie successfully", 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with delete movie', 400);
        }
    }
}

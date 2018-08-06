<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/8/2018
 * Time: 9:44 AM
 */

namespace App\Http\Controllers\Api;

use JWTAuth;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\BaseController;
use App\Repositories\GalleryRepository;
use Illuminate\Http\Request;
use App\Notifications\ValidateMessage;
use Illuminate\Support\Facades\Log;


class GalleryController extends  BaseController {

    use ValidateMessage;

    /**
     * Category repository
     * @var GalleryRepository
     */
    private $galleryRepository;

    /**
     * GalleryController constructor.
     * @param GalleryRepository $galleryRepository
     */
    public function __construct(GalleryRepository $galleryRepository)
    {
        parent::__construct($galleryRepository);
        $this->galleryRepository = $galleryRepository;
    }

    /**
     * Create user
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request){
        try {
            $response = $this->validateRequest($request, $this->ruleCreate(), $this->validationErrorMessages());
            if(!is_null($response)){
                return $response;
            }
            $credentials = $request->all();
            $attribute = $this->createdDetault($credentials);
            $entity = $this->galleryRepository->create($attribute);
            return $this->responseJsonSuccess(['gallery' => $entity]);

        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
    }

    /**
     * Create user
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request){
        try {
            $response = $this->validateRequest($request, $this->ruleUpdate(), $this->validationErrorMessages());
            if(!is_null($response)){
                return $response;
            }
            $credentials = $request->all();
            $id = $credentials['id'];
            $gallery = $this->galleryRepository->findWithoutFail($id);
            if($gallery == null){
                return $this->responseJsonError('id_incorrect', null);
            }
            $gallery->image = $credentials['image'];
            $gallery->title = $credentials['title'];
            $gallery->description = $credentials['description'];
            $attribute = $this->updatedDetault($gallery);
            $attribute->save();
            return $this->responseJsonSuccess(['gallery' => $attribute]);

        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadFile(Request $request){
        try {
            $response = $this->validateRequest($request, $this->ruleUpload(), $this->validationErrorMessages());
            if(!is_null($response)){
                return $response;
            }
            $data = [];
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time().'.'.$file->getClientOriginalExtension();
                $file->move(base_path() . '/' . config('common.image'), $imageName);
                $data["name"] = $imageName;
                $data["url"] = home_url() . '/' . config('common.image').$imageName;
                return $this->responseJsonSuccess($data);
            }

            return $this->responseJsonError('image_file_empty');

        } catch (Exception $e) {
            Log::error($e);
            return $this->responseJsonError('exception', null);
        }
    }

    /**
     * Rule create
     * @return array
     */
    protected function ruleCreate(){
        return [
            'title' => 'required'
        ];
    }

    /**
     * Rule update
     * @return array
     */
    protected function ruleUpdate(){
        return [
            'title' => 'required',
            'id' => 'required'
        ];
    }

    /**
     * Rule validate upload
     * @return array
     */
    protected function ruleUpload(){
        return [
          'image' => 'required'
        ];
    }

    /**
     * Validate error message
     * @return array
     */
    protected function validationErrorMessages(){
        return [
          'title.required' => 'title_empty',
          'image.required' => 'image_empty',
            'id.required' => 'id_empty'
        ];
    }
}
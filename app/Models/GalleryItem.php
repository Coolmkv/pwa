<?php

namespace App\Models;

use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryItem extends Model
{
    use HasFactory;
    use CommonFunctions;
    protected $table = "gallery_items";

    const TABLE_NAME = "gallery_items";

    const ID = 'id';
    const LOCAL_IMAGE = 'local_image';
    const IMAGE_LINK = 'image_link';
    const ALTERNATE_TEXT = 'alternate_text';
    const LOCAL_VIDEO = 'local_video';
    const VIDEO_LINK = 'video_link';
    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const POSITION = 'position';
    const VIEW_STATUS = 'view_status';
    const STATUS = 'status';
    const CREATED_BY = 'created_by';
    const CREATED_AT = 'created_at';
    const UPDATED_BY = 'updated_by';
    const UPDATED_AT = 'updated_at';

    const IMAGE_UPLOAD_PATH = "/upload/gallery/images/";
    const VIDEO_UPLOAD_PATH = "/upload/gallery/videos/";
    public function addGalleryItem(Request $request)
    {
        try{
            $insert = [
                self::IMAGE_LINK=>$request->input(self::IMAGE_LINK),
                self::VIDEO_LINK=>$request->input(self::VIDEO_LINK),
                self::ALTERNATE_TEXT=>$request->input(self::ALTERNATE_TEXT),
                self::TITLE=>$request->input(self::TITLE),
                self::DESCRIPTION=>$request->input(self::DESCRIPTION),
                self::POSITION=>$request->input(self::POSITION),
                self::VIEW_STATUS=>$request->input(self::VIEW_STATUS),
                self::STATUS=>1,
                self::CREATED_BY=>Auth::user()->id,
            ];
            $maxId = GalleryItem::max(self::ID);
            if(empty($maxId)){
                $maxId = 1;
            }else{
                $maxId++;
            }
            if($request->file(self::LOCAL_IMAGE)){
                foreach($request->file(self::LOCAL_IMAGE) as $galleryItem){
                    
                    $fileName = $galleryItem->getClientOriginalName();
                    $fileName = "Img_$maxId".preg_replace('/[^A-Za-z0-9.\-]/', '', $fileName);
                    $galleryItem->move(public_path().self::IMAGE_UPLOAD_PATH, $fileName);
                    $insert[self::LOCAL_IMAGE] = self::IMAGE_UPLOAD_PATH.$fileName;
                    GalleryItem::insert($insert);
                    $maxId++;
                }
            }
            if($request->file(self::LOCAL_VIDEO)){
                $insert[self::LOCAL_IMAGE] = null;
                $video = $request->file(self::LOCAL_VIDEO);
                $fileName = $video->getClientOriginalName();
                $fileName = "Video_$maxId".preg_replace('/[^A-Za-z0-9.\-]/', '', $fileName);
                $video->move(public_path().self::VIDEO_UPLOAD_PATH, $fileName);
                $insert[self::LOCAL_VIDEO] = self::VIDEO_UPLOAD_PATH.$fileName;
                GalleryItem::insert($insert);
            }
            return ["status"=>true,"message"=>"Gallery Item saved.","data"=>"null"];

        }catch(Exception $exception){
            $this->reportException($exception);
            return ["status"=>false,"message"=>"Something went wrong.","data"=>"null"];
        }
    }
}

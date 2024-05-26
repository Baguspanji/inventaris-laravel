<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{

    public function uploadFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'file' => 'max:10000|mimes:doc,docx,xlsx,xls,pdf,jpg,jpeg,png,gif'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->getMessages()], 400);
        }

        $base_url = URL::to('/');
        $file_dir = 'public/' . $request->type;

        if ($request->header("-method") == "DELETE") {
            try {
                $url = URL::to('/');
                $filename = $request->post('image');
                $path = $file_dir . '/' . $filename;

                return response()->json([
                    'success' => true,
                    'message' => 'File deleted successfully',
                    'data' => Storage::delete($path)
                ], 200);
            } catch (\Throwable $th) {
                Log::error($th);
                return response()->json([
                    'success' => false,
                    'message' => 'File not deleted',
                    'data' => null
                ], 400);
            }
        } else {
            try {
                $image = $request->file('file');
                // $filename = $image->getClientOriginalName();
                $image_uploaded = $image->store($file_dir);

                $url = Storage::url($image_uploaded);

                // return $base_url . $url;
                return response()->json([
                    'success' => true,
                    'message' => 'File uploaded successfully',
                    'data' => $base_url . $url
                ], 200);
            } catch (\Throwable $th) {
                Log::error($th);
                return response()->json([
                    'success' => false,
                    'message' => 'File not uploaded',
                    'data' => null
                ], 400);
            }
        }
    }
}

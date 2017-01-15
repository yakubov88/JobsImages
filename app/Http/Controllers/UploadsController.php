<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use Redirect;
use Session;
use App\Upload;
use App\Job;

class UploadsController extends Controller
{
    public function index() {
        return view('upload.index');
    }
    public function multiple_upload(Request $request) {
        // getting all of the post data

        $files = $request->file('images');

        $job = new Job();
        $job->title = $request->title;
        $job->description = $request->description;
        $job->save();

        //$files = Input::file('images');
        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;

        foreach ($files as $file) {
            $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file'=> $file), $rules);
            if($validator->passes()){
                $destinationPath = 'uploads'; // upload folder in public directory
                $filename = $file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $uploadcount ++;

                // save into database
                $extension = $file->getClientOriginalExtension();
                $entry = new Upload();
                $entry->mime = $file->getClientMimeType();
                $entry->original_filename = $filename;
                $entry->filename = $file->getFilename().$extension;
                $entry->job_id = $job->id;
                $entry->save();
            }
        }
        if($uploadcount == $file_count){
            Session::flash('success', 'Upload successfully controller');
            return Redirect::to('upload');
        } else {
            return Redirect::to('upload')->withInput()->withErrors($validator);
        }
    }

    public function getJobs()
    {
           $jobs = Job::all();

        return view('upload.upload',['jobs' => $jobs]);
    }
}

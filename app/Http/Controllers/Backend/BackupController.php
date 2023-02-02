<?php

namespace App\Http\Controllers\Backend;

use Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('index-backup');

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]); // local disk
        $files = $disk->files(config('backup.backup.name')); //env('APP_NAME')

        $backups = []; // .zip
        foreach ($files as $key => $file) {
            if (substr($file, -4) == '.zip' && $disk->exists($file)) {
                $file_name = str_replace(config('backup.backup.name').'/','',$file);

                $backups[] = [
                    'file_path' => $file,
                    'file_name' => $file_name,
                    'file_size' => $this->byteToHuman($disk->size($file)),
                    'created_at' => Carbon::parse($disk->lastModified($file))->diffForHumans(),
                    'download_link' => '#'
                ];
            }
        }
        //reverse the backups, so that latest one would come first
        $backups = array_reverse($backups);

        return view('admin.pages.backups.index', compact('backups'));
    }

    public function byteToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i=0; $bytes > 1024 ; $i++) {
            $bytes/=1024;
        }
        return round($bytes, 2).' '.$units[$i];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('create-backup');
        // start the process of backup create
        Artisan::call('backup:run');
        // dd(Artisan::output());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($file_name)
    {
        // dd($file_name);
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-backup');

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]); // local disk
        $files = $disk->files(config('backup.backup.name')); //env('APP_NAME')

        if($disk->exists(config('backup.backup.name').'/'.$file_name)){
            $disk->delete(config('backup.backup.name').'/'.$file_name);

            Toastr::success('Backup Deleted Successfully!!');
            return back();
        }
    }

    public function download($file_name)
    {
        // dd($file_name);
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('download-backup');
        $file = config('backup.backup.name').'/'.$file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]); // local

        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => '.zip',
                "Content-Length" => $disk->size($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        }

    }
}

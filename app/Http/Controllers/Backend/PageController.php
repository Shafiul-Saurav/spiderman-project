<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('index-page');

        $pages = Page::latest('id')
        ->select(['id', 'page_title', 'page_slug', 'meta_title', 'meta_keywords', 'is_active', 'updated_at'])
        ->paginate(30);

        return view('admin.pages.page-builder.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('create-page');

        return view('admin.pages.page-builder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageStoreRequest $request)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('create-page');

        $page = Page::updateOrCreate([
            'page_title' => $request->page_title,
            'page_slug' => $request->page_slug ?? Str::slug($request->page_title),
            'page_short' => $request->page_short,
            'page_long' => $request->page_long,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);

        $this->image_upload($request, $page->id);

        Toastr::success('Page Created Successfully');
        return redirect()->route('page.index');
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
    public function edit($page_slug)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('edit-page');

        $page = Page::where('page_slug', $page_slug)->first();
        return view('admin.pages.page-builder.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageUpdateRequest $request, $page_slug)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('edit-page');

        $page = Page::where('page_slug', $page_slug)->first();
        $page->update([
            'page_title' => $request->page_title,
            'page_slug' => $request->page_slug ?? Str::slug($request->page_title),
            'page_short' => $request->page_short,
            'page_long' => $request->page_long,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);

        $this->image_upload($request, $page->id);

        Toastr::success('Page Updated Successfully');
        return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($page_slug)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-page');

        $page = Page::where('page_slug', $page_slug)->first();
        $page->delete();

        Toastr::success('Page Deleted Successfully');
        return redirect()->route('page.index');
    }

    /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $page_id)
    {
        $page = Page::findOrFail($page_id);
        // dd($request->all(), $page, $request->hasFile('page_image'));
        if ($request->hasFile('page_image')) {
            if ($page->page_image != 'default_page.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/page_images/';
                $old_photo_location = $photo_location . $page->page_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/page_images/';
            $uploaded_photo = $request->file('page_image');
            $new_photo_name = $page->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(800,450)->save(base_path($new_photo_location), 40);
            //$user = User::find($page->id);
            $check = $page->update([
                'page_image' => $new_photo_name,
            ]);
        }
    }

    public function checkActive($page_id)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('edit-page');

        $page = Page::find($page_id);
        //toggle the is-active
        if($page->is_active == 1){
            $page->is_active = 0;
        }else{
            $page->is_active = 1;
        }

        $page->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Update'
        ]);
    }
}

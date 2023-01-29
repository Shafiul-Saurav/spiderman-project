<?php

namespace App\Http\Controllers\Backend\Trash;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class PageTrashController extends Controller
{
    public function trash()
    {
        $pages = Page::onlyTrashed()->latest('id')
        ->select(['id', 'page_title', 'page_slug', 'meta_title', 'meta_keywords', 'is_active', 'updated_at'])
        ->paginate(30);

        return view('admin.pages.page-builder.trash', compact('pages'));
    }

    public function restore($page_slug)
    {
        // dd($page_slug);
        $page = Page::onlyTrashed()->where('page_slug', $page_slug)->first();
        $page->restore();

        Toastr::success('Page Restored Successfully');
        return redirect()->route('page.index');
    }

    public function forceDelete($page_slug)
    {
        // dd($page_slug);
        $page = Page::onlyTrashed()->where('page_slug', $page_slug)->first();
        if($page->page_image != 'default_page.jpg'){
            $photo_location = 'uploads/page_images/'.$page->page_image;
            unlink($photo_location);
        }
        $page->forceDelete();

        Toastr::info('Page Delete Permanently!');
        return redirect()->back();
    }
}

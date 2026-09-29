<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{
    public function blogIndex()
    {
        $blogs = DB::select("
            SELECT *
            FROM (
                SELECT
                    cat.id as cat_id,
                    cat.cat_name,
                    cat.cat_url,
                    bc.id as bc_id,
                    bc.published_date,
                    bc.created_at,
                    bc.sub_title,
                    bc.blog_title,
                    bc.read_minutes,
                    bc.meta_description,
                    bc.description,
                    bc.slug,
                    bc.thumbnail,
                    ROW_NUMBER() OVER (
                        PARTITION BY bc.category_id
                        ORDER BY bc.created_at DESC
                    ) as row_num,
                    DENSE_RANK() OVER (
                        ORDER BY (
                            SELECT MAX(created_at) 
                            FROM blogs_content sub_bc 
                            WHERE sub_bc.category_id = cat.id 
                            AND sub_bc.status = 1 
                            AND sub_bc.deleted_at = 0
                        ) DESC, cat.id DESC
                    ) as cat_num
                FROM categories as cat
                JOIN blogs_content as bc
                    ON cat.id = bc.category_id
                WHERE
                    cat.status = 1
                    AND bc.status = 1
                    AND cat.deleted_at = 0
                    AND bc.deleted_at = 0
            ) ranked
            WHERE row_num <= 2
            AND cat_num <= 3
            ORDER BY cat_num ASC, created_at DESC
        ");
    
        $groupedBlogs = collect($blogs)->groupBy('cat_id');
    
        $sidebarCategories = DB::select("
            SELECT cat.cat_name, cat.cat_url, COUNT(bc.id) as total
            FROM categories as cat
            JOIN blogs_content as bc ON cat.id = bc.category_id
            WHERE cat.status = 1 
                AND bc.status = 1 
                AND cat.deleted_at = 0 
                AND bc.deleted_at = 0
            GROUP BY cat.id, cat.cat_name, cat.cat_url
        ");
    
        return view('pages.blog', compact('groupedBlogs', 'sidebarCategories'));
    }
    
    public function categoryIndex(Request $request, $category)
    { 
        $categoryData = DB::table('categories')
            ->where('cat_url', '/blog/'.$category)
            ->where('status', 1)
            ->where('deleted_at', 0)
            ->first();
    
        if (!$categoryData) {
            abort(404);
        }
    
        $blogs = DB::table('blogs_content as bc')
            ->join('categories as cat', 'cat.id', '=', 'bc.category_id')
            ->select(
                'bc.id',
                'bc.blog_title',
                'bc.sub_title',
                'bc.meta_description',
                'bc.description',
                'bc.thumbnail',
                'bc.slug',
                'bc.read_minutes',
                'bc.published_date',
                'cat.cat_name',
                'cat.cat_url as category_slug'
            )
            ->where('bc.category_id', $categoryData->id)
            ->where('bc.status', 1)
            ->where('cat.status', 1)
            ->where('bc.deleted_at', 0)
            ->where('cat.deleted_at', 0)
            ->orderBy('bc.published_date', 'desc')
            ->paginate(4);
    
        $sidebarCategories = DB::table('categories as cat')
            ->leftJoin('blogs_content as bc', 'cat.id', '=', 'bc.category_id')
            ->select('cat.cat_name', 'cat.cat_url', DB::raw('COUNT(bc.id) as total'))
            ->where('cat.status', 1)
            ->where('cat.deleted_at', 0)
            ->where('bc.status', 1)
            ->where('bc.deleted_at', 0)
            ->where('cat.id', '!=', $categoryData->id)
            ->groupBy('cat.id', 'cat.cat_name', 'cat.cat_url')
            ->get();
    
        return view('pages.driver-blog', compact('blogs', 'categoryData', 'sidebarCategories'));
    }
    
    public function blogDetails($category, $blog)
    {
        $post = DB::table('blogs_content as bc')
            ->join('categories as cat', 'cat.id', '=', 'bc.category_id')
            ->select(
                'bc.*',
                'cat.cat_name',
                'cat.cat_url'
            )
            ->where('cat.cat_url', '/blog/'.$category)
            ->where('bc.slug', $blog)
            ->where('cat.status', 1)
            ->where('bc.status', 1)
            ->where('cat.deleted_at', 0)
            ->where('bc.deleted_at', 0)
            ->first();
    
        if (!$post) {
            abort(404);
        }
    
        $relatedBlogs = DB::table('blogs_content as bc')
            ->join('categories as cat', 'cat.id', '=', 'bc.category_id')
            ->select(
                'bc.id',
                'bc.blog_title',
                'bc.sub_title',
                'bc.meta_description',
                'bc.description',
                'bc.thumbnail',
                'bc.slug',
                'bc.read_minutes',
                'bc.published_date',
                'cat.cat_name',
                'cat.cat_url'
            )
            ->where('bc.category_id', $post->category_id)
            ->where('bc.id', '!=', $post->id)
            ->where('bc.status', 1)
            ->where('cat.status', 1)
            ->where('bc.deleted_at', 0)
            ->where('cat.deleted_at', 0)
            ->orderBy('bc.published_date', 'desc')
            ->limit(3)
            ->get();
    
        return view('pages.blog-details', compact('post', 'relatedBlogs'));
    }
    
    public function getLatestBlogsApi()
    {
        $blogs = DB::select("
            SELECT *
            FROM (
                SELECT
                    cat.id as cat_id,
                    cat.cat_name,
                    cat.cat_url,
                    bc.id as bc_id,
                    bc.published_date,
                    bc.created_at,
                    bc.sub_title,
                    bc.blog_title,
                    bc.read_minutes,
                    bc.meta_description,
                    bc.description,
                    bc.slug,
                    bc.thumbnail,
                    ROW_NUMBER() OVER (
                        PARTITION BY bc.category_id
                        ORDER BY bc.created_at DESC
                    ) as row_num,
                    DENSE_RANK() OVER (
                        ORDER BY (
                            SELECT MAX(created_at) 
                            FROM blogs_content sub_bc 
                            WHERE sub_bc.category_id = cat.id 
                            AND sub_bc.status = 1 
                            AND sub_bc.deleted_at = 0
                        ) DESC, cat.id DESC
                    ) as cat_num
                FROM categories as cat
                JOIN blogs_content as bc
                    ON cat.id = bc.category_id
                WHERE
                    cat.status = 1
                    AND bc.status = 1
                    AND cat.deleted_at = 0
                    AND bc.deleted_at = 0
            ) ranked
            WHERE row_num = 1
            AND cat_num <= 3
            ORDER BY cat_num ASC
        ");
    
        return response()->json([
            'status' => true,
            'data' => $blogs
        ]);
    }
    
    // public function getLatestBlogsApi()
    // {
        
    //     $blogs = [];
    
    //     return response()->json([
    //         'status' => true,
    //         'data' => $blogs
    //     ]);
    // }
    
    public function searchBlogs(Request $request)
    {
        $search = $request->get('q');
        
        if (empty($search)) {
            return response()->json([]);
        }
    
        $blogs = DB::table('blogs_content')
            ->join('categories', 'categories.id', '=', 'blogs_content.category_id')
            ->where('blogs_content.status', 1)
            ->where('blogs_content.deleted_at', 0)
            ->where('categories.status', 1)
            ->where('categories.deleted_at', 0)
            ->where(function($query) use ($search) {
                $query->where('blogs_content.blog_title', 'LIKE', '%' . $search . '%')
                      ->orWhere('blogs_content.description', 'LIKE', '%' . $search . '%')
                      ->orWhere('blogs_content.content', 'LIKE', '%' . $search . '%');
            })
            ->select('blogs_content.blog_title', 'blogs_content.description', 'blogs_content.slug', 'categories.cat_url')
            ->limit(10)
            ->get();
    
        return response()->json($blogs);
    }
}
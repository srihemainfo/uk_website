<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DynamicPageController extends Controller
{
    /**
     * Display the standard car-rental page (Heathrow to Sutton or customized)
     */
    public function showCarRental(Request $request)
    {
        return $this->renderDynamicPage('car-rental');
    }

    /**
     * Display a dynamic transfer route landing page by slug
     * e.g. /transfers/heathrow-to-sutton or /transfers/gatwick-to-london
     */
    public function showTransferRoute(Request $request, $slug)
    {
        return $this->renderDynamicPage($slug);
    }

    /**
     * Query and render a dynamic landing page
     */
    protected function renderDynamicPage($slug)
    {
        $page = null;
        $sections = [];

        try {
            $page = DB::table('dynamic_pages')
                ->where('slug', $slug)
                ->where('is_published', 1)
                ->first();

            if ($page && !empty($page->sections)) {
                $decoded = json_decode($page->sections, true);
                if (is_array($decoded)) {
                    $sections = $decoded;
                }
            }
        } catch (\Exception $e) {
            // In case of DB disconnect or missing table, fallback gracefully
            $page = null;
            $sections = [];
        }

        // If not found and not the default 'car-rental' slug, return 404
        if (!$page && $slug !== 'car-rental') {
            abort(404);
        }

        // Prepare SEO metadata
        $seoTitle = $page->seo_title ?? ($page->page_title ?? 'Heathrow Airport to Sutton Car Rental | GoRide UK');
        $seoDescription = $page->meta_description ?? 'Pre-book your private transfer or car rental from London Heathrow Airport to Sutton. Fixed fares, flight tracking, and 24/7 service.';
        $seoKeywords = $page->meta_keywords ?? 'heathrow car rental, taxi sutton, london airport transfer, car hire';

        return view('car-rental', compact('page', 'sections', 'seoTitle', 'seoDescription', 'seoKeywords'));
    }
}

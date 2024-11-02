<?php

namespace App\Http\Livewire\Public;

use Livewire\Component;
use App\Models\Admin\Page as PublicPost;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

use App\Models\Admin\General;
use App\Models\Admin\Social;
use App\Models\Admin\User;
use App\Models\Admin\Menu;
use App\Models\Admin\Header;
use App\Models\Admin\Footer;
use App\Models\Admin\Gdpr;
use App\Models\Admin\Advanced;
use App\Models\Admin\Advertisement;
use App\Models\Admin\FooterTranslation;
use App\Models\Admin\Redirect;
use App\Models\Admin\Sidebar;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Posts extends Component
{
    public $slug;
    public $type;

    public function mount($slug)
    {
        try {

            $this->slug = $slug;
  
            $redirectUrl = Redirect::where('old_slug', $this->slug)->first();

            if ($redirectUrl && $redirectUrl->new_slug) {
                return redirect()->to($redirectUrl->new_slug);
            }

            abort(404);

        } catch (\Exception $e) {}

    }
    
    public function render()
    {

        try {

            $page          = PublicPost::where('slug', $this->slug)->where('type', 'post')->firstOrFail();
            $general       = General::first();

            $pageTrans = PublicPost::withTranslation()->translatedIn( app()->getLocale() )->whereTranslation('page_id', $page->id)->where('post_status', true)->firstOrFail();
        
            $url = route('home') . '/blog/' . $this->slug;
            $image = $pageTrans->featured_image;
            $name = config('app.name');

            switch ($general->maintenance_mode) {
                case true:
                        $title       = __('This site is undergoing maintenance!');
                        $description = __('Site is currently under maintenance. We are working hard to give you the best experience and will be back shortly.');
                    break;
                
                default:
                        $title       = $pageTrans->page_title;
                        $description = $pageTrans->short_description;
                    break;
            }
    
            //Meta
            $siteName = $pageTrans->sitename_status ? ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME') : '';
            SEOMeta::setTitle($title . $siteName);
            SEOMeta::setDescription($description);
            SEOMeta::setCanonical($url);

            if ( $pageTrans->robots_meta ) {
                SEOMeta::addMeta('robots', 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large', 'name');
            }
            else SEOMeta::addMeta('robots', 'noindex, follow', 'name');

            //Facebook
            OpenGraph::addProperty('type', 'article')
                                    ->addProperty('locale', localization()->getCurrentLocaleRegional() )
                                    ->addImage($image)
                                    ->setTitle($title)
                                    ->setDescription($description)
                                    ->setUrl($url)
                                    ->setSiteName($name);

            //Twitter
            TwitterCard::setType('summary_large_image')
                                ->setImage($image)
                                ->setTitle($title)
                                ->setDescription($description)
                                ->setUrl($url);

            $advanced = Advanced::first();

            $recent_posts = PublicPost::where('type', 'post')
                                ->where('post_status', true)
                                ->orderBy('id', 'DESC')
                                ->get()
                                ->map(function ($page) {
                                    $translatedPage = $page->translate( app()->getLocale() );
                                    if ($translatedPage) {
                                        $translatedPage->slug           = $page->slug;
                                        $translatedPage->target         = $page->target;
                                        $translatedPage->featured_image = $page->featured_image;
                                    }
                                    return $translatedPage;
                                })->take( Sidebar::first()->post_count )->filter()->toArray();

            $popular_tools = PublicPost::where('type', 'tool')
                                ->where('popular', true)
                                ->where('tool_status', true)
                                ->orderBy('id', 'DESC')
                                ->get()
                                ->map(function ($page) {
                                    $translatedPage = $page->translate( app()->getLocale() );
                                    if ($translatedPage) {
                                        $translatedPage->slug             = $page->slug;
                                        $translatedPage->target           = $page->target;
                                        $translatedPage->custom_tool_link = $page->custom_tool_link;
                                    }
                                    return $translatedPage;
                                })->take( Sidebar::first()->tool_count )->filter()->toArray();

        return view('livewire.public.posts', [
            'page'          => $page,
            'general'       => $general,
            'related_tools' => PublicPost::where('category_id', $page->category_id)->where('id', '!=', $page->id)->where('tool_status', true)->inRandomOrder()->take( General::first()->related_tools_count )->get()->toArray()
        ])->layout('layouts.public', [
            'page'          => $page,
            'pageTrans'     => $pageTrans,
            'general'       => $general,
            'profile'       => User::with('user_socials')->where('is_admin', true)->first(),
            'advertisement' => Advertisement::first(),
            'sidebar'       => Sidebar::first(),
            'recent_posts'  => $recent_posts,
            'popular_tools' => $popular_tools,
            'siteTitle'     => env('APP_NAME'),
            'menus'         => Menu::with('children')->where(['parent_id' => 'id'])->orderBy('sort','ASC')->get()->toArray(),
            'header'        => Header::first(),
            'advanced'      => $advanced,
            'footer'        => FooterTranslation::where('locale', app()->getLocale())->first(),
            'socials'       => Social::orderBy('id', 'ASC')->get()->toArray(),
            'notice'        => Gdpr::first()
        ]);

        } catch (ModelNotFoundException $e) {

            abort(404);

        } catch (\Exception $e) {
            
            if ( $e->getMessage() == null) {
                abort(404);
            }
            return view('livewire.public.install.welcome')->layout('layouts.install');
        }

    }


}

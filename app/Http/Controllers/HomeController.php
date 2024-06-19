<?php

namespace App\Http\Controllers;
use App\Models\Setting;
use App\Models\Menu;
use App\Models\Slider;
use App\Models\Project;
use App\Models\Service;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\Member;
use App\Models\Language;
use App\Models\Pricing;
use App\Models\PricingSetting;
use App\Models\ContactSetting;
use App\Models\Client;
use App\Models\HomeSetting; 
use App\Models\AboutSetting;
use App\Models\PortfolioSetting;
use App\Models\ProjectCategory; 
use App\Models\HeaderFooterSetting; 
use App\Models\BlogSetting;
use View;
use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest; 
use Mail;
use Validator;
use DB;

class HomeController extends Controller
{

    public function changeLanguage($lang)
    {
        session()->put('lang', $lang);
        app()->setLocale($lang);


        return redirect()->back();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $data['currentLang'] = $currentLang;

        $lang_id = $currentLang->id;

        
        
        $langs = Language::all();
        
        

        $data['sliders'] = Slider::where('language_id', $lang_id)->get();
        $data['menus'] = Menu::where('language_id', $lang_id)->get();
        $data['setting'] = Setting::find($lang_id);
        $data['headerfooter'] = HeaderFooterSetting::find($lang_id);
        $data['homesetting'] = HomeSetting::find($lang_id);
        $data['services'] = Service::where('language_id', $lang_id)->get();
        $data['projects'] = Project::where('language_id', $lang_id)->get();
        $data['testimonials'] = Testimonial::where('language_id', $lang_id)->get();
        $data['posts'] = Post::where('language_id', $lang_id)->get();

        return view('home', compact('langs'), $data);
    }
    public function about()
    {   

        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $data['currentLang'] = $currentLang;
        $lang_id = $currentLang->id;
        $langs = Language::all();


        $members = Member::all();
        $clients = Client::all();


        $data['testimonials'] = Testimonial::where('language_id', $lang_id)->get();
        $data['headerfooter'] = HeaderFooterSetting::find($lang_id);
        $data['setting'] = Setting::find($lang_id);
        $data['aboutsetting'] = AboutSetting::find($lang_id);
        $data['menus'] = Menu::where('language_id', $lang_id)->get();

        return view('about', $data, compact('members','clients', 'langs'));
    }

    public function show_slug_about($slug = 'home')
    {
        $page = AboutSetting::whereSlug($slug)->first();
        if(!empty($page)) {
            return View::make('page')->with('page', $page);
        } else {
            abort(404);
        }
        
    }

    public function portfolio()
    {

        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $data['currentLang'] = $currentLang;
        $lang_id = $currentLang->id;
        $langs = Language::all();


        $data['headerfooter'] = HeaderFooterSetting::find($lang_id);
        $data['setting'] = Setting::find($lang_id);
        $data['menus'] = Menu::where('language_id', $lang_id)->get();
        $data['projects'] = Project::where('language_id', $lang_id)->get();
        $data['portfoliosettings'] = PortfolioSetting::find($lang_id);
        $data['project_categories'] = ProjectCategory::where('language_id', $lang_id)->get();
        
        return view('portfolio', $data, compact('langs'));
    }
    public function blog()
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $data['currentLang'] = $currentLang;
        $lang_id = $currentLang->id;
        $langs = Language::all();

        $data['headerfooter'] = HeaderFooterSetting::find($lang_id);
        $data['setting'] = Setting::find($lang_id);
        $data['menus'] = Menu::where('language_id', $lang_id)->get();
        $data['posts'] = Post::where('language_id', $lang_id)->get();
        $data['blogsettings'] = BlogSetting::find($lang_id);

        return view('blog', $data, compact('langs'));
    }
    
    public function pricing()
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $data['currentLang'] = $currentLang;
        $lang_id = $currentLang->id;
        $langs = Language::all();

        $data['headerfooter'] = HeaderFooterSetting::find($lang_id);
        $data['setting'] = Setting::find($lang_id);
        $data['menus'] = Menu::where('language_id', $lang_id)->get();
        $data['pricingsetting'] = PricingSetting::find($lang_id);
        $data['menus'] = Menu::where('language_id', $lang_id)->get();
        $data['pricings'] = Pricing::where('language_id', $lang_id)->get();

        return view('pricing', $data, compact('langs'));
    }

    public function contactPost(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'budget' => 'required',
            'comment' => 'required'
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $mailUsername = env('MAIL_USERNAME');
        \Log::info("MAIL_USERNAME: $mailUsername");

        Mail::send('email', [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'budget' => $request->get('budget'),
                'comment' => $request->get('comment') ],
                
                function ($message) use ($request){
                        $message->from(env('MAIL_USERNAME'),ucfirst($request->get('name')));
                        $message->to(env('MAIL_TO'), 'Administrator')
                        ->subject('Project request')
                        ->replyTo($request->get('email'), ucfirst($request->get('name')));
        });
        return back()->with('success', 'Thanks for contacting me, I will get back to you soon!');
    }

    public function contact()
    {
        $clients = Client::all();

        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $data['currentLang'] = $currentLang;
        $lang_id = $currentLang->id;
        $langs = Language::all();

        $data['headerfooter'] = HeaderFooterSetting::find($lang_id);
        $data['setting'] = Setting::find($lang_id);
        $data['menus'] = Menu::where('language_id', $lang_id)->get();
        $data['contactsetting'] = ContactSetting::find($lang_id);

        return view('contact', $data, compact('clients', 'langs'));
    }







}

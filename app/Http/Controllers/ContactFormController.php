<?php

namespace App\Http\Controllers;

use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIDAction;
use App\Actions\Page\GetPageParentsAction;
use App\Actions\SEO\GetSeoAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function show()
    {
        $id = (new GetPageIDAction)->run('contact');
        $page = (new GetPageAction)->run($id);
        $seo = (new GetSeoAction)->run($page['seo_id']);
        $parents = (new GetPageParentsAction)->run($id);

        return view('site.pages.contactForm', compact('page', 'parents', 'seo'));
    }

    public function send()
    {
        Mail::send(['text' => 'mail.mail'], ['name' => 'site zhd'], function ($message) {
            $message->to('shema-pogruzki@yandex.ru', 'to site zhd')->subject('test');
            $message->from('shema-pogruzki@yandex.ru', 'site zhd');
        });

        return 'contact form send';
    }
}

<?php

namespace App\Http\Controllers;

use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIDAction;
use App\Actions\Page\GetPageParentsAction;
use App\Actions\SEO\GetSeoAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Mail\SendMail;
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

    public function send(ContactFormRequest $request)
    {
        $validated = $request->validated();

        $message_text = "";
        $message_text .= "Контактное лицо: " . $validated['name'] . "<br>";
        $message_text .= "Адрес электронной почты: " . $validated['email'] . "<br>";
        $message_text .= "Текст сообщения: " . $validated['message'] . "<br>";

        $secret = "6LfKbeYpAAAAABsu2Bp27JHzgfi2FAn20-_DfA2W";

        if (!empty($validated['g-recaptcha-response'])) {
            $out = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $out = json_decode($out);

            if ($out->success == true) {

                $title = 'Заявка с сайта';
                $body = $message_text;

                Mail::to('shema-pogruzki@yandex.ru')->send(new SendMail($title, $body));

                // Mail::send(['text' => 'mail.mail'], ['name' => 'site zhd'], function ($message) {
                //     $message->to('shema-pogruzki@yandex.ru', 'to site zhd')->subject('test');
                //     $message->setBody('<h1>Hi, welcome user!</h1><br> hello world', 'text/html');
                // });

                // return 'contact form send';

                return "Email sent successfully!";

            } else {
                return "error!";
            }
        }
    }
}

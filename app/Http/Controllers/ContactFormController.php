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
use Illuminate\Support\Facades\Session;

class ContactFormController extends Controller
{
    public function show()
    {
        $id = (new GetPageIDAction)->run('contact-form');
        $page = (new GetPageAction)->run($id);
        $seo = (new GetSeoAction)->run($page['seo_id']);
        $parents = (new GetPageParentsAction)->run($id);

        return view('site.pages.contactForm', compact('page', 'parents', 'seo'));
    }

    public function send(ContactFormRequest $request)
    {
        $validated = $request->validated();

        $message_text = "";
        $message_text .= "Наименование организации: " . $validated['company'] . "<br>";
        $message_text .= "Контактное лицо: " . $validated['name'] . "<br>";
        $message_text .= "Телефон: " . $validated['phone'] . "<br>";
        $message_text .= "Электронная почта: " . $validated['email'] . "<br>";
        $message_text .= "Пункт отправления: " . $validated['from'] . "<br>";
        $message_text .= "Пункт назначения: " . $validated['to'] . "<br>";
        $message_text .= "Характеристика груза: " . $validated['message'] . "<br>";

        $secret = "6LfKbeYpAAAAABsu2Bp27JHzgfi2FAn20-_DfA2W";

        if (!empty($validated['g-recaptcha-response'])) {
            $out = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $out = json_decode($out);

            if ($out->success == true) {

                $title = 'Заявка с сайта';
                $body = $message_text;

                Mail::to('shema-pogruzki@yandex.ru')->send(new SendMail($title, $body));

                Session::flash('success', 'Заявка успешно отправлена');
                return redirect()->back();

            } else {
                return redirect()->back()->withErrors([
                    'form' => 'Ошибка отправки формы. Попробуйте еще раз.'
                ]);
                ;
            }
        }
    }
}

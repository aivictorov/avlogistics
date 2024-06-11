<?php

namespace App\Http\Controllers;

use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIDAction;
use App\Actions\Page\GetPageParentsAction;
use App\Actions\Seo\GetSeoAction;
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

        $title = 'Запрос стоимости перевозки';

        $data = [];
        $data['company'] = $validated['company'];
        $data['name'] = $validated['name'];
        $data['phone'] = $validated['phone'];
        $data['email'] = $validated['email'];
        $data['from'] = $validated['from'];
        $data['to'] = $validated['to'];
        $data['message'] = $validated['message'];
        $data['files'] = "";

        $files = [];

        if ($request->has('files') && isset($validated['files'])) {
            $files = $validated['files'];

            foreach ($files as $key => $file) {
                if ($key === 0) {
                    $data['files'] .= $file->getClientOriginalName() . "(" . $file->getMimeType() . ")";
                } else {
                    $data['files'] .= ", " . $file->getClientOriginalName() . "(" . $file->getMimeType() . ")";
                }
            }
        }

        $secret = "6LfKbeYpAAAAABsu2Bp27JHzgfi2FAn20-_DfA2W";

        if (!empty($validated['g-recaptcha-response'])) {
            $out = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $out = json_decode($out);

            if ($out->success == true) {

                Mail::to('info@zhd.su')->send(new SendMail($title, $data, $files));

                Session::flash('success', 'Заявка успешно отправлена');
                return redirect()->back();

            } else {
                return redirect()->back()->withErrors([
                    'form' => 'Ошибка отправки запроса. Попробуйте еще раз.'
                ]);
                ;
            }
        }
    }
}

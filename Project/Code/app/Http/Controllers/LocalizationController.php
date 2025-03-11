<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use App\Models\ResearchGroup;
use App\Models\ResearchProject;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;

class LocalizationController extends Controller
{
    public function index()
    {
        $resp = ResearchGroup::all();
        $translatedTexts = Session::get('translatedTexts', []);

        return view('welcome', compact('resp', 'translatedTexts'));
        // return view('welcome');
    }

    public function switchLang($lang)
    {
        // Check if the selected language is supported
        $availableLocales = ['en', 'th', 'zh']; // Supported languages
        if (!in_array($lang, $availableLocales)) {
            $lang = 'en'; // Default to 'en' if the language is not supported
        }

        // Set the application's language
        App::setLocale($lang);

        // Store the selected language in session
        Session::put('applocale', $lang);

        // Translate specific texts
        $translatedTexts = $this->translateTexts(
            ['Research Information Management System',
            'Logout', 'Dashboard', 'Profile' ],
            $lang
        );

        // Store the translated texts in the session
        Session::put('translatedTexts', $translatedTexts);

        // Redirect back to the previous page
        return redirect()->back();
    }

    public function translateTexts(array $texts, $lang)
    {
        $translator = new GoogleTranslate();

        // ตั้งค่าภาษาเป้าหมาย
        $translator->setTarget($lang);

        $translatedTexts = [];
        foreach ($texts as $text) {
            $translatedTexts[] = $translator->translate($text);
        }

        return $translatedTexts;
    }
}

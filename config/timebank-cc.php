<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Account Properties
    |--------------------------------------------------------------------------
    |
    | The default account properties that will be set into the database when new accounts are created.
    | The balance limits are in minutes.
    */

    'accounts' => [
        'personal' => [
            'name' =>  'Personal Account',
            'limit_min' => 0,
            'limit_max' => 6000,
        ],
        'organization' => [
            'name' => 'Organization Account',
            'limit_min' => 0,
            'limit_max' => 18000,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Public / Private settings
    |--------------------------------------------------------------------------
    |
    | The default account properties that will be set into the database when new accounts are created.
    | The balance limits are in minutes.
    */

    'account_info' => [
        'personal' => [
            'balance_public' =>  true,
        ],
        'organization' => [
            'balance_public' =>  true,
        ],
        'account_totals' => [
            'sumBalances_public' => false,
            'countTransfersSince' => 365,   // days ago
            'countTransfersSince_humanReadable' => 'past year',   // Short description of countTransfersSince in base language: must have translation key!
            'countTransfers_public' => true,
            'countTransfersReceived_public' => true,
            'countTransfersGiven_public' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Verification rules and file size limits
    |--------------------------------------------------------------------------
    | Here you can set the verification rules that will be used to verify data
    | that will be submitted in forms.
    |
    | Also you can set here the uploaded file properties and limits as well as
    | the defaut files that will be used when no file is uploaded by the user.
    */

    'rules' => [
        'profile_user' => [
            'name' =>  ['required','string','unique:users,name','unique:organizations,name','min:3','max:40','alpha_num',
                function ($attribute, $value, $fail) {
                    // Disallow the following words to be used inside the name:
                    $disallowedWords = [
                        'admin',
                        'superuser',
                        'super-user',
                        'supervisor',
                        'bank',
                        'timebank',
                        'time-bank',
                        'moderator',
                        'regulator',
                    ];
                    foreach ($disallowedWords as $word) {
                        if (str_contains(strtolower($value), $word)) {
                            $fail(trans('validation.custom.profile_user.name.disallowed', ['word' => $word]));
                        }
                    }
                },
            ],
            'email' => 'required|email|unique:users,email|max:40',
            'password' => 'required|min:6|same:passwordConfirmation',
            'profile_photo' => 'nullable|mimes:gif,jpg,jpeg,png,svg|max:1024',
            'about' => 'nullable|string|max:400',   //TODO: check max with legacy cyclos data
            'motivation' => 'nullable|string|max:200',  //TODO: check max with legacy cyclos data
            'date_of_birth' => 'nullable|date',
            'website' => 'nullable|string|max:150',
        ],
        // TODO: move validation rules in Livewire Posts to this config
        // 'posts' => [
        //     'title' =>  'required|string|unique:users,name|min:3|max:40',
        //     'intro' => 'required|string|max:300',
        //     'content' => 'required|string',
        //     'locale' => 'string|unique:post_translations,locale'
        // ],
    ],

    'files' => [
        'profile_user' => [
            'photo_new' => 'app-images/profile-user-new.svg',
            'photo_default' => 'app-images/profile-user-default.svg',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Base Language
    |--------------------------------------------------------------------------
    | Translations are linked by their context to one base language.
    |
    */
    'base_language' => 'en',
    'base_language_name' => 'English',


    /*
    |--------------------------------------------------------------------------
    | Search settings
    |--------------------------------------------------------------------------
    | Configuration of search ranking and fuzziness.
    | Weight: multiplier for the score of the search result. 0 is no match, 2.0 doubles the score.
    | Fuzziness: 0 (off), 1 or 2.
    | Stopwords: words that are ignored in the search query.
    |
    */
    'main_search_bar' => [
        'weight' => [
            'users' =>  1.0,
            'organizations' => 1.0,
            'posts' => 0,
            'tags' => 1.0,
        ],
        'fuzziness' => 'AUTO',
    ],

    'elasticsearch' => [
        'stopwords' => [
            'en' => ["a", "an", "and", "at", "but", "by", "for", "if", "in", "is",
                "it", "of", "on", "or", "the", "to", "with", "about", "above", "after",
                "all", "also", "am", "an", "any", "are", "aren't", "as", "at", "be",
                "because", "been", "before", "being", "below", "between", "both", "but",
                "by", "can't", "cannot", "could", "couldn't", "did", "didn't", "do",
                "does", "doesn't", "doing", "don't", "down", "during", "each", "few",
                "for", "from", "further", "had", "hadn't", "has", "hasn't", "have",
                "haven't", "having", "he", "he'd", "he'll", "he's", "her", "here", "here's",
                "hers", "herself", "him", "himself", "his", "how", "how's", "i", "i'd",
                "i'll", "i'm", "i've", "if", "in", "into", "is", "isn't", "it", "it's",
                "its", "itself", "let's", "me", "more", "most", "mustn't", "my", "myself",
                "no", "nor", "not", "of", "off", "on", "once", "only", "or", "other", "ought",
                "our", "ours", "ourselves", "out", "over", "own", "same", "shan't", "she",
                "she'd", "she'll", "she's", "should", "shouldn't", "so", "some", "such",
                "than", "that", "that's", "the", "their", "theirs", "them", "themselves",
                "then", "there", "there's", "these", "they", "they'd", "they'll", "they're",
                "they've", "this", "those", "through", "to", "too", "under", "until", "up",
                "very", "was", "wasn't", "we", "we'd", "we'll", "we're", "we've", "were",
                "weren't", "what", "what's", "when", "when's", "where", "where's", "which",
                "while", "who", "who's", "whom", "why", "why's", "with", "won't", "would",
                "wouldn't", "you", "you'd", "you'll", "you're", "you've", "your", "yours",
                "yourself", "yourselves",
                ],
            'nl' => ["aan", "al", "alle", "als", "altijd", "andere", "bij", "dan", "dat", "de",
                "deze", "die", "dit", "doch", "doen", "door", "een", "en", "er", "geen",
                "hem", "het", "hij", "hoe", "hun", "ik", "in", "is", "ja", "je", "kan", "maar",
                "me", "meer", "met", "mij", "mijn", "moet", "naar", "niet", "nog", "nu", "of",
                "om", "onder", "ons", "ook", "over", "te", "tot", "uit", "van", "veel", "voor",
                "was", "wat", "we", "wel", "werd", "wij", "wil", "worden", "zal", "ze", "zelf",
                "zich", "zie", "zijn", "zo", "zonder","alles", "als", "bijna", "dan", "dat", "deze", "die", "dit", "door", "een",
                "eerst", "en", "er", "gaan", "geen", "geven", "haar", "heb", "hebben", "heeft",
                "hem", "het", "hier", "hoe", "hun", "ik", "in", "is", "ja", "je", "kan", "kom",
                "maar", "me", "meer", "men", "met", "mij", "mijn", "moet", "na", "naar", "niet",
                "niets", "nog", "nu", "of", "om", "omdat", "ons", "ook", "op", "over", "te",
                "tot", "u", "uit", "van", "veel", "voor", "waar", "was", "wat", "we", "wel",
                "werd", "wij", "wil", "worden", "wordt", "zal", "ze", "zei", "zelf", "zich",
                "zie", "zijn", "zo", "zonder"
            ],
            'fr' => ["au", "aux", "avec", "ce", "ces", "dans", "de", "des", "du", "elle",
                "en", "et", "eux", "il", "je", "la", "le", "leur", "lui", "ma", "mais",
                "me", "même", "mes", "moi", "mon", "ne", "nos", "notre", "nous", "on",
                "ou", "par", "pas", "pour", "qu", "que", "qui", "sa", "se", "ses", "son",
                "sur", "ta", "te", "tes", "toi", "ton", "tu", "un", "une", "vos", "votre",
                "vous", "c", "d", "j", "l", "à", "m", "n", "s", "t", "y", "été", "étée",
                "étées", "étés", "étant", "étante", "étants", "étantes", "suis", "es",
                "est", "sommes", "êtes", "sont", "serai", "seras", "sera", "serons",
                "serez", "seront", "serais", "serait", "serions", "seriez", "seraient",
                "étais", "était", "étions", "étiez", "étaient", "fus", "fut", "fûmes",
                "fûtes", "furent", "sois", "soit", "soyons", "soyez", "soient", "fusse",
                "fusses", "fût", "fussions", "fussiez", "fussent", "ai", "as", "avons", "avez", "ont", "aurai", "auras", "aura", "aurons",
                "aurez", "auront", "aurais", "aurait", "aurions", "auriez", "auraient",
                "avais", "avait", "avions", "aviez", "avaient", "eut", "eûmes", "eûtes",
                "eurent", "aie", "aies", "ait", "ayons", "ayez", "aient", "eusse", "eusses",
                "eût", "eussions", "eussiez", "eussent", "ici", "mais", "ou", "car", "donc",
                "or", "ni", "cependant", "pendant", "parce", "que", "quand", "comment",
                "où", "pourquoi", "quoi", "si", "tel", "telle", "tels", "telles", "un",
                "une", "duquel", "dequel", "lequel", "laquelle", "lesquels", "lesquelles",
                "dont", "desquels", "desquelles", "auquel", "à laquelle", "auxquels",
                "auxquelles", "de", "à", "pour", "avec", "en", "par", "sur", "sous", "vers",
                "entre", "jusque", "devant", "derrière", "chez", "hors", "dans", "depuis",
                "pendant", "à travers", "au-dessus", "au-dessous", "afin", "dans", "de",
                "lorsque", "comme", "si", "quoi", "quand", "où", "pourquoi", "comment"
            ],
            'de' => ["aber", "alle", "allem", "allen", "aller", "alles", "als", "also", "am", "an",
                "ander", "andere", "anderem", "anderen", "anderer", "anderes", "anderm", "andern",
                "anderr", "anders", "auch", "auf", "aus", "bei", "bin", "bis", "bist", "da", "damit",
                "dann", "der", "den", "des", "dem", "die", "das", "dass", "daß", "derselbe", "derselben",
                "denselben", "desselben", "demselben", "dieselbe", "dieselben", "dasselbe", "dazu", "dein",
                "deine", "deinem", "deinen", "deiner", "deines", "denn", "derer", "dessen", "dich", "dir",
                "du", "dies", "diese", "diesem", "diesen", "dieser", "dieses", "doch", "dort", "durch",
                "ein", "eine", "einem", "einen", "einer", "eines", "einig", "einige", "einigem", "einigen",
                "einiger", "einiges", "einmal", "er", "ihn", "ihm", "es", "etwas", "euer", "eure", "eurem",
                "euren", "eurer", "eures", "für", "gegen", "gewesen", "hab", "habe", "haben", "hat", "hatte",
                "hatten", "hier", "hin", "hinter", "ich", "mich", "mir", "ihr", "ihre", "ihrem", "ihren",
                "ihrer", "ihres", "euch", "im", "in", "indem", "ins", "ist", "jede", "jedem", "jeden",
                "jeder", "jedes", "jene", "jenem", "jenen", "jener", "jenes", "jetzt", "kann", "kein",
                "keine", "keinem", "keinen", "keiner", "keines", "können", "könnte", "machen", "man",
                "manche", "manchem", "manchen", "mancher", "manches", "mein", "meine", "meinem", "meinen",
                "meiner", "meines", "mit", "muss", "musste", "nach", "nicht", "nichts", "noch", "nun",
                "nur", "ob", "oder", "ohne", "sehr", "sein", "seine", "seinem", "seinen", "seiner", "seines",
                "selbst", "sich", "sie", "ihnen", "sind", "so", "solche", "solchem", "solchen", "solcher",
                "solches", "soll", "sollte", "sondern", "sonst", "über", "um", "und", "uns", "unsere",
                "unserem", "unseren", "unser", "unseres", "unter", "viel", "vom", "von", "vor", "während",
                "war", "waren", "warst", "was", "weg", "weil", "weiter", "welche", "welchem", "welchen",
                "welcher", "welches", "wenn", "werde", "werden", "wie", "wieder", "will", "wir", "wird",
                "wirst", "wo", "wollen", "wollte", "würde", "würden", "zu", "zum", "zur", "zwar", "zwischen"
            ],
            'es' => ["a", "al", "algo", "algunas", "algunos", "ante", "antes", "como", "con", "contra",
                "cual", "cuando", "de", "del", "desde", "donde", "durante", "e", "el", "ella",
                "ellas", "ellos", "en", "entre", "era", "erais", "eran", "eras", "eres", "es",
                "esa", "esas", "ese", "eso", "esos", "esta", "estaba", "estabais", "estaban",
                "estabas", "estad", "estada", "estadas", "estado", "estados", "estamos", "estando",
                "estar", "estaremos", "estará", "estarán", "estarás", "estaré", "estaréis",
                "estaría", "estaríais", "estaríamos", "estarían", "estarías", "estas", "este",
                "estemos", "esto", "estos", "estoy", "estuve", "estuviera", "estuvierais",
                "estuvieran", "estuvieras", "estuvieron", "estuviese", "estuvieseis", "estuviesen",
                "estuvieses", "estuvimos", "estuviste", "estuvisteis", "estuvo", "fue", "fuera",
                "fuerais", "fueran", "fueras", "fueron", "fuese", "fueseis", "fuesen", "fueses",
                "fuimos", "fuiste", "fuisteis", "fui", "fuimos", "para", "por", "que", "si",
                "sois", "somos", "son", "soy", "su", "sus", "suya", "suyas", "suyo", "suyos",
                "también", "tanto", "te", "tendremos", "tendrá", "tendrán", "tendrás", "tendré",
                "tendréis", "tendría", "tendríais", "tendríamos", "tendrían", "tendrías", "tened",
                "tenemos", "tenga", "tengamos", "tengan", "tengas", "tengo", "tengáis", "tenida",
                "tenidas", "tenido", "tenidos", "teniendo", "tenéis", "tenía", "teníais", "teníamos",
                "tenían", "tenías", "ti", "tiene", "tienen", "tienes", "todo", "todos", "tu",
                "tus", "tuve", "tuviera", "tuvierais", "tuvieran", "tuvieras", "tuvieron", "tuviese",
                "tuvieseis", "tuviesen", "tuvieses", "tuvimos", "tuviste", "tuvisteis", "tuvo"
            ],
        ],
    ],
];

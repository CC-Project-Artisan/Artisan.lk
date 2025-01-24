<!-- Navigation Bar -->
<header class="main-nav" id="main-nav">
    <a href="{{ route('welcome') }}" class="main-logo">{{config('app.name')}}</a>

   
    <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
    </div>

    <nav class="main-menu" id="main-menu">
        <ul>
            <li><a href="{{ route('welcome') }}">Home</a></li>
            <li><a href="{{ route('pages.shop') }}">Shop</a></li>
            <li><a href="{{ route('pages.map') }}">Map</a></li>
            <li><a href="{{ route('pages.exhibition') }}">Exhibitions</a></li>
            <!-- <li><a href="{{ route(name: 'pages.about') }}">About</a></li> -->
        </ul>
    </nav>

    <div class="main-icons">
        <a href="javascript:void(0)" onclick="toggleSearchModal()"><i class="fas fa-search"></i></a>

        <a href="{{route('pages.cart')}}"><i class="fas fa-shopping-cart"></i></a>
        <a href="{{ route('login') }}"><i class="fas fa-user"></i></a>
    </div>
    <!-- language button -->
<style>
    .custom-translate {
        position: relative;
        display: inline-block;
    }

    .custom-translate select {
        appearance: none;
        background-color: transparent;
        border: 1px solid #ddd;
        padding: 8px 32px 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .custom-translate select:focus {
        outline: none;
        border-color: #4a8;
    }

    #google_translate_element {
        display: none;
    }
    .goog-te-banner-frame {
        display: none !important;
    }
    .goog-logo-link {
        display: none !important;
    }
    .goog-te-gadget span {
        display: none !important;
    }
</style>

 <div class="custom-translate">
    <select id="language-select" onchange="changeLanguage(this.value)">
        <option value="en">English</option>
        <option value="si">Sinhala</option>
        <option value="ta">Tamil</option>
        <option value="es">Spanish</option>
        <option value="fr">French</option>
        <option value="it">Italian</option>
        <option value="de">German</option>
        <option value="ja">Japanese</option>
        <option value="ko">Korean</option>
        <option value="pt">Portuguese</option>
        <option value="ru">Russian</option>
        <option value="zh-CN">Chinese</option>
    </select>
</div>

<div id="google_translate_element"></div> 

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,si,ta,es,fr,it,de,ja,ko,pt,ru,zh-CN',
            layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL,
            autoDisplay: false,
            multilanguagePage: true,
        }, 'google_translate_element');
    }

    function changeLanguage(langCode) {
        var select = document.querySelector('select.goog-te-combo');
        if (select) {
            select.value = langCode;
            select.dispatchEvent(new Event('change'));
        }
    }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</header>
{{ html()->form()->route('language.set')->open() }}
{{ html()->select('locale', languageList()->pluck('title', 'code'), app()->getLocale())->attributes(['onchange' => 'this.form.submit()'])->class('form-control languageSelect') }}
{{ html()->form()->close() }}

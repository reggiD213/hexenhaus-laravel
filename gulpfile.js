const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')

        .copy('resources/assets/fonts/', 'public/fonts')
        .scripts('edit_form.js')
        .scripts('pswp_settings.js')
        .scripts('fineuploader_settings.js')
        .version(['css/app.css', 'js/edit_form.js', 'js/pswp_settings.js', 'js/fineuploader_settings.js'], 'public');
});


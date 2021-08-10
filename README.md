# QS Starter Theme v.1.1

<h3>Requirements</h3>

<p>1. Node JS - <a href="https://nodejs.org/en/" target="_blank">Get NodeJS</a></p>
<p>2. Gulp JS - <a href="http://gulpjs.com/" target="_blank">Get GulpJS</a></p>
<p>3. Gulp must be installed globally on your system:</p>
<p><code>npm install gulp -g</code></p>
<p><code>npm install gulpjs/gulp-cli -g</code></p>
<p>4. Upload <a href="https://gist.github.com/vol4ikman/92e381e5adee0b1e36606d82d5f45613" target="_blank">this gulpfile.js</a> to your ftp server into public_html directory (and DO NOT forget change default settings)</p>
<p>5. From public_html run this command:</p>
<p><code>npm install gulp@3.9.1 gulp-decompress gulp-download vinyl-ftp del gulp-open gulp-run</code></p>
<p>6. After install gulp plugins run this command:</p>
<p><code>gulp deploy</code></p>

<p>7. Run this command from the root of your WordPress theme (/public_html/wp-content/themes/$theme_name$/): </p>
<p><code>npm install gulp-uglify gulp-rename gulp-clean-css gulp-autoprefixer gulp-concat gulp-rtlcss gulp-notify</code></p>
<p><code>npm install gulp</code></p>
<p><code>gulp dev</code></p>

<hr>
<h3>Explanation</h3>

Gulp deploy install all those plugins inside your theme folder
`npm install gulp-uglify gulp-rename gulp-clean-css gulp-postcss gulp-concat gulp-rtlcss gulp-notify`

1. `gulp-uglify`: JS minify - <a href="https://www.npmjs.com/package/gulp-uglify" >link</a>
2. `gulp-rename`: Rename files - <a href="https://www.npmjs.com/package/gulp-rename" >link</a>
3. `gulp-clean-css`: CSS minify - <a href="https://www.npmjs.com/package/gulp-clean-css" >link</a>
4. `gulp-autoprefixer`: Auto prefixes - <a href="https://www.npmjs.com/package/gulp-autoprefixer" >link</a>
5. `gulp-concat`: Concatenates files - <a href="https://www.npmjs.com/package/gulp-concat" >link</a>
6. `gulp-notify`: Notifications - <a href="https://www.npmjs.com/package/gulp-notify">link</a>

<p>** <strong>Atom text editor</strong> <a href="https://atom.io/" target="_blank">(download here)</a> is <strong>very</strong> recommended =)</p>
<p>If using atom, DO NOT forget setup "watcher" (see "Default Watchers" section)</p>

<hr>
<h3>Default Watchers</h3>

```html
        "/wp-content/themes/qs-starter/build/css/assets.css",
        "/wp-content/themes/qs-starter/build/css/assets.min.css",
        "/wp-content/themes/qs-starter/build/css/main-style.css",
        "/wp-content/themes/qs-starter/build/css/responsive.css",
        "/wp-content/themes/qs-starter/build/css/assets.cs.maps",
        "/wp-content/themes/qs-starter/build/css/assets.min.css.map",
        "/wp-content/themes/qs-starter/build/css/main-style.css.map",
        "/wp-content/themes/qs-starter/build/css/responsive.css.map",
        "/wp-content/themes/qs-starter/build/js/assets.min.js"
```

<h3>Default gitignore</h3>

```html
# Wordpress
.ftpconfig
node_modules
wp-admin
wp-includes
wp-content/plugins
wp-content/upgrade
wp-content/languages
wp-config.php
```

<hr>
<h3>Change Log</h3>
<ol>
    <li>Child theme has been added to QS Starter Theme</li>
    <li>Theme has been moved to SWIPER Slider - http://idangero.us/swiper/get-started/</li>
    <li>Slick slider has been droped from the theme</li>
    <li>Add support to Polylang plugin (https://wordpress.org/plugins/polylang/) to save ACF options correctly</li>
</ol>

<hr>
<h3>Important notice</h3>
<ol>
    <li><strong>Please, remove .ftpconfig file from the server - very important</strong></li>
    <li>When you create .ftpconfig file, your "remote" parameter should looks like this <code>"remote": "/public_html",</code></li>
    <li>Do NOT upload to git wp-admin & wp-includes folders</li>
</ol>

<hr>
<h3>Manifest JSON</h3>

```html
<link rel="manifest" href="/manifest.json">
```

- Used for PWA (Progressive Web Applications). Docs & Examples are here <a href="https://developer.mozilla.org/en-US/docs/Web/Manifest" target="_blank">Deploying a manifest</a>
- To generate manifest.json icons & favicon icons, please go to <a href="http://digitalagencyrankings.com/iconogen/" target="_blank"><strong>ICONOGEN</strong></a>

## Good Luck!

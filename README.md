# Dooble Starter WordPress Theme v.2.0

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

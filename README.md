# QS Starter Theme v.1.0

### Requirements
1. Node JS - <a href="https://nodejs.org/en/" target="_blank">Get NodeJS</a>
2. Gulp JS - <a href="http://gulpjs.com/" target="_blank">Get GulpJS</a>
3. Gulp must be installed globally on your system:<br>
`npm install gulp -g`
4. Upload <a href="https://gist.github.com/vol4ikman/92e381e5adee0b1e36606d82d5f45613" target="_blank">this gulpfile.js</a> to your ftp server (DO NOT forget change default settings)
5. From public_html run this command:
`npm install gulp gulp-decompress gulp-download gulp-util vinyl-ftp del gulp-open gulp-run`
6. After install gulp plugins run this command:
`gulp deploy`
7. Run this command from the root of your WordPress theme (/public_html/wp-content/themes/$theme_name$/): <br>
`gulp dev`

### Explanation
Gulp deploy install all those plugins inside your theme folder
`npm install gulp gulp-uglify gulp-rename gulp-clean-css gulp-autoprefixer gulp-concat gulp-notify`
<hr>
1. `gulp-uglify`: JS minify - <a href="https://www.npmjs.com/package/gulp-uglify" >link</a>
2. `gulp-rename`: Rename files - <a href="https://www.npmjs.com/package/gulp-rename" >link</a>
3. `gulp-clean-css`: CSS minify - <a href="https://www.npmjs.com/package/gulp-clean-css" >link</a>
4. `gulp-autoprefixer`: Auto prefixes - <a href="https://www.npmjs.com/package/gulp-autoprefixer" >link</a>
5. `gulp-concat`: Concatenates files - <a href="https://www.npmjs.com/package/gulp-concat" >link</a>
6. `gulp-notify`: Notifications - <a href="https://www.npmjs.com/package/gulp-notify">link</a>

** Atom text editor <a href="https://atom.io/" target="_blank">(download here)</a> is very recommended =)
If using atom, DO NOT forget setup "watcher" =)

### Default Watchers
```html
"/public_html/wp-content/themes/gulp-starter/build/css/*.css",
"/public_html/wp-content/themes/gulp-starter/build/js/*.js"
```

### Default gitignore
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

## Good Luck!

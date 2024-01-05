import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.$ = window.jQuery = require('jquery');
require('jquery-ui-dist/jquery-ui');

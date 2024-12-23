require('./bootstrap');
require('izitoast/dist/css/iziToast.min.css');

window.iziToast = require('izitoast');
window.jsonToPivotjson = require('json-to-pivot-json');

import cryptoRandomString from 'crypto-random-string';
window.cryptoRandomString = cryptoRandomString;

window.Clusterize = require('clusterize.js');

window.Clipboard = require('clipboard');

import {
    camelCase,
    capitalCase,
    constantCase,
    dotCase,
    headerCase,
    noCase,
    paramCase,
    pascalCase,
    pathCase,
    sentenceCase,
    snakeCase,
} from "change-case";

window.camelCase = camelCase;
window.capitalCase = capitalCase;
window.constantCase = constantCase;
window.snakeCase = snakeCase;
window.dotCase = dotCase;
window.paramCase = paramCase;

iziToast.settings({
    titleSize: '22',
    messageSize: '17',
    transitionIn: 'flipInX',
    transitionOut: 'flipOutX',
    timeout: 5000,

    onOpen: function () {
        // console.log('callback abriu!');
    },
    onClose: function () {
        // console.log("callback fechou!");
    }
});

window.pagination = require("vuejs-uib-pagination");
window.masonry = require("vue-masonry-css");

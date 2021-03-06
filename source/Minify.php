<?php

/**
 * CSS
 */
$minCss = new \MatthiasMullie\Minify\CSS();
$minCss->add(ROOT . DS . "theme" . DS . "assets" . DS . "css" . DS . "style.css");
$minCss->minify(ROOT . DS . "theme" . DS . "assets" . DS . "css" . DS . "style.min.css");

/**
 * JS
 */
$minJs = new \MatthiasMullie\Minify\JS();
$minJs->add(ROOT . DS . "theme" . DS . "assets" . DS . "js" . DS . "jquery.js");
$minCss->minify(ROOT . DS . "theme" . DS . "assets" . DS . "js" . DS . "style.min.js");

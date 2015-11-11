<?php

error_reporting(E_ALL);

    define('TEMPLATE_PATH', realpath(__DIR__) . '/../templates/');

    function getBlock($location) {
        $path = TEMPLATE_PATH . trim($location, '/') . '.php';

        if (!file_exists($path)) {
            return '';
        }

        ob_start();
        include $path;
        $contents = ob_get_contents();
        ob_end_clean();

        $contents = preg_replace_callback('|{% highlight (.*?) %}(.+?(?={%)){% end highlight (.*?) %}|s', function($matches) {
            return '<pre class="primer-code"><code class="' .$matches[1]. '">' . htmlspecialchars(trim($matches[2])) . '</code></pre>';
        }, $contents);

        return $contents;
    }

    function getBaseUrl() {
        return 'http://' . $_SERVER['HTTP_HOST'] . '/';
    }

    function getUrl($url = false) {
        return getBaseUrl().($url ?: '');
    }

    function getRequestPath() {
        $base = substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], 'index.php'));
        return substr($_SERVER['REQUEST_URI'], strlen($base) - 1);
    }

    function isIndex() {
        return getRequestPath() === '/';
    }

    function imageUrl($src, array $args) {
        if (strlen($src) >= 4 && substr($src, 0, 4) !== 'http') {
            $src = getUrl($src);
        }

        $qs = http_build_query($args);

        return 'http://iweb:developer@isabelaweb1.cms.iwebcloud.co.uk/image/'.base64_encode($src).($qs ? '?'.$qs : '');
    }

    $toplevels = array('branding', 'atoms', 'molecules');
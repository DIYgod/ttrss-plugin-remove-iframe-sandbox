<?php
class Remove_Iframe_Sandbox extends Plugin {
    private $host;

    function about() {
        return array(1.0,
            "Remove sandbox attribute on some iframes in feeds (bilibili)",
            "https://github.com/DIYgod/ttrss-plugin-remove-iframe-sandbox");
    }

    function init($host) {
        $this->host = $host;

        $host->add_hook($host::HOOK_IFRAME_WHITELISTED, $this);
    }

    function hook_iframe_whitelisted($src) {
        return true;
    }

    function api_version() {
        return 2;
    }

}
?>
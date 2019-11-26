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

        $host->add_hook($host::HOOK_SANITIZE, $this);
    }

    function hook_sanitize($doc, $site_url, $allowed_elements, $disallowed_attributes) {

        $xpath = new DOMXpath($doc);
        $entries = $xpath->query('//iframe');

        foreach ($entries as $entry) {
            $whitelist = array("player.bilibili.com", "bilibili.com");
            @$src = parse_url($entry->getAttribute("src"), PHP_URL_HOST);
            if ($src) {
                foreach ($whitelist as $w) {
                    if ($src == $w || $src == "www.$w")
                        $entry->removeAttribute("sandbox");
                }
            }
        }

        return array($doc, $allowed_elements, $disallowed_attributes);
    }

    function api_version() {
        return 2;
    }

}
?>
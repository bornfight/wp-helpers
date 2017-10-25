<?php
/**
 * Created by PhpStorm.
 * Date: 24/07/2017
 * Time: 15:34
 */

namespace degordian\wpHelpers;


class AssetBundle
{
    protected static $includeBasePath = '/static/';

    public $js = [];
    public $css = [];

    public $asyncCss = false;

    public function getBasePath()
    {
        return INCLUDE_URL . self::$includeBasePath;
    }

    public static function register()
    {
        $bundle = new static();
        $bundle->enqueueScripts();
        $bundle->enqueueStyles();
    }

    protected function enqueueScripts()
    {
        foreach($this->js as $handle => $data) {
            if(isset($data['path']) === false) {
                throw new \Exception('Missing path definition for ' . $handle);
            }

            $path = $data['path'];
            $version = isset($data['version']) ? $data['version'] : 1.0;
            $inFooter = isset($data['inFooter']) ? $data['inFooter'] : true;

            wp_enqueue_script($handle, $this->getBasePath() . $path, [], $version, $inFooter);
        }
    }

    protected function enqueueStyles()
    {
        if($this->asyncCss) {
            add_action('wp_head', function() {
                ?>
                <script>
                    function loadCSS(e, n, o, t) {
                        "use strict";
                        var d = window.document.createElement("link"), i = n || window.document.getElementsByTagName("script")[0], r = window.document.styleSheets;
                        return d.rel = "stylesheet", d.href = e, d.media = "only x", t && (d.onload = t), i.parentNode.insertBefore(d, i), d.onloadcssdefined = function (e) {
                            for (var n, o = 0; o < r.length; o++)r[o].href && r[o].href === d.href && (n = !0);
                            n ? e() : setTimeout(function () {
                                d.onloadcssdefined(e)
                            })
                        }, d.onloadcssdefined(function () {
                            d.media = o || "all"
                        }), d
                    }
                    // CSS DEV
                    <?php foreach ($this->css as $handle => $data) { ?>
                        loadCSS("<?= $this->getBasePath() . $data['path']; ?>");
                    <?php } ?>
                </script>
                <noscript>
                    <!-- CSS DEV -->
                    <?php foreach ($this->css as $handle => $data) { ?>
                        <link rel="stylesheet" href="<?= $this->getBasePath() . $data['path']; ?>">
                    <?php } ?>
                </noscript>
                <?php
            });
        } else {
            foreach($this->css as $handle => $data) {
                if(isset($data['path']) === false) {
                    throw new \Exception('Missing path definition for ' . $handle);
                }

                $path = $data['path'];
                $version = isset($data['version']) ? $data['version'] : 1.0;
                $inFooter = isset($data['inFooter']) ? $data['inFooter'] : true;

                wp_enqueue_style($handle, $this->getBasePath() . $path, [], $version, $inFooter);
            }

        }
    }

}
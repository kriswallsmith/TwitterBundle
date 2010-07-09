<?php

namespace Bundle\Kris\TwitterBundle\Templating\Helper;

use Symfony\Components\Templating\Helper\Helper;

class TwitterAnywhereHelper extends Helper
{
    protected $apiKey;
    protected $version;
    protected $callbackUrl;

    protected $scripts = array();

    public function __construct($apiKey, $version = 1, $callbackUrl = null)
    {
        $this->apiKey = $apiKey;
        $this->version = $version;
        $this->callbackUrl = $callbackUrl;
    }

    public function setup()
    {
        $query = http_build_query(array(
            'id' => $this->apiKey,
            'v'  => $this->version,
        ));

        $html = <<<HTML
<script src="http://platform.twitter.com/anywhere.js?$query"></script>

HTML;

        if (null !== $this->callbackUrl) {
            $format = <<<HTML
<script type="text/javascript">
/* <![CDATA[ */
twttr.anywhere.config(%s);
/* ]]> */
</script>

HTML;

            $html .= sprintf($format, json_encode(array('callbackURL' => $this->callbackUrl)));
        }

        return $html;
    }

    public function queue($script)
    {
        $this->scripts[] = $script;
    }

    public function initialize()
    {
        $lines = '';
        foreach ($this->scripts as $script) {
            $lines .= rtrim($script, ';').";\n";
        }

        return <<<HTML
<script type="text/javascript">
/* <![CDATA[ */
twttr.anywhere(function(T) {
$lines})
/* ]]> */
</script>
HTML;
    }

    public function getName()
    {
        return 'twitter_anywhere';
    }
}

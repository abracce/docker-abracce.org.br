<?php

class Abracce_Videos {

    private $_media;

    public function __construct() {}

    private function loadXML($url) {
        if (ini_get('allow_url_fopen') == true) {
            return $this->load_fopen($url);
        }
        else if (function_exists('curl_init')) {
            return $this->load_curl($url);
        }
        else {
            throw new Exception("Can't load data.");
        }
    }

    private function load_fopen($url) {
        return simplexml_load_file($url);
    }

    private function get_youtubev($youtube_url) {
        parse_str( parse_url( $youtube_url, PHP_URL_QUERY ), $y_array );
        return $y_array['v'];
    }

    private function get_media($entry) {
        $this->_media = $entry->children('http://search.yahoo.com/mrss/');
        return $this->_media;
    }

    private function load_curl($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        return simplexml_load_string($result);
    }

    public function get_last_video( $user = YOUTUBE_CANAL, $h = '315' ) {
        $sxml = $this->loadXML('https://gdata.youtube.com/feeds/api/users/'.$user.'/uploads');
        $i = 0;
        foreach ($sxml->entry as $entry) {
            $media = $this->get_media($entry);
            $attrs = $media->group->player->attributes();
            ?>

            <iframe width="100%" height="<?php echo $h ?>" src="//www.youtube.com/embed/<?php echo $this->get_youtubev($attrs['url']) ?>" frameborder="0" allowfullscreen></iframe>

            <?php

            if($i == 0)
                break;

            $i++;
        }
    }

    public function get_videos( $user = YOUTUBE_CANAL ) {

        $sxml = $this->loadXML('https://gdata.youtube.com/feeds/api/users/'.$user.'/uploads');

        $i = 0;
        foreach ($sxml->entry as $entry) {
            $media = $this->get_media($entry);
            $attrs = $media->group->player->attributes();
            ?>

            <div class="col-md-3 col-xs-12 col-sm-6 video">
                <a href="#!" data-video="<?php echo $this->get_youtubev($attrs['url']) ?>">
                    <img src="http://img.youtube.com/vi/<?php echo $this->get_youtubev($attrs['url']) ?>/hqdefault.jpg" class="img-responsive" alt="">
                </a>
            </div>

            <?php

            // if($i == 29)
            //     break;

            $i++;
        }

    }

}

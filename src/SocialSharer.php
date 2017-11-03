<?php

namespace degordian\wpHelpers;

class SocialSharer
{

    public function getFBShareLink($url)
    {
        return sprintf('https://www.facebook.com/sharer/sharer.php?u=%s', $url);
    }

    public function getTwitterShareLink($url)
    {
        return sprintf('https://twitter.com/home?status=%s', $url);
    }

    public function getLinkedInShareLink($url)
    {
        return sprintf('https://www.linkedin.com/shareArticle?mini=true&url=%s&title=%s&summary=&source=', $url, 'Mercury Processing');
    }

    public function getGooglePlusShareLink($url)
    {
        return sprintf('https://plus.google.com/share?url=%s', $url);
    }

    public function getEmailShareLink($url)
    {
        return sprintf('mailto:?to=&body=%s&subject=%s', $url, 'Mercury Processing');
    }

    public function getFBShareCount($url)
    {
        $link = sprintf('https://graph.facebook.com/?id=%s', $url);

        try {
            $data = json_decode(@file_get_contents($link));

            if (isset($data->share) && isset($data->share->share_count)) {
                return $data->share->share_count;
            }

            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function getTwitterShareCount($url)
    {
        $link = sprintf('http://opensharecount.com/count.json?url=%s', $url);


        try {
            $data = json_decode(@file_get_contents($link));

            return $data->count;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function getLinkedInShareCount($url)
    {
        $link = sprintf('http://www.linkedin.com/countserv/count/share?url=%s&format=json', $url);

        try {
            $data = json_decode(@file_get_contents($link));

            return $data->count;
        } catch (\Exception $e) {
            return 0;
        }
    }
}

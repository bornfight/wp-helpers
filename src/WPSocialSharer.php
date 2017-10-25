<?php
namespace degordian\wpHelpers;

class WPSocialSharer extends SocialSharer
{
    public function getFBShareLink($url = null)
    {
        if($url === null) {
            $url = get_permalink();
        }
        return parent::getFBShareLink($url);
    }

    public function getTwitterShareLink($url = null)
    {
        if($url === null) {
            $url = get_permalink();
        }
        return parent::getTwitterShareLink($url);
    }

    public function getLinkedInShareLink($url = null)
    {
        if($url === null) {
            $url = get_permalink();
        }
        return parent::getLinkedInShareLink($url);
    }

    public function getGooglePlusShareLink($url = null)
    {
        if($url === null) {
            $url = get_permalink();
        }
        return parent::getGooglePlusShareLink($url);
    }

    public function getEmailShareLink($url = null)
    {
        if($url === null) {
            $url = get_permalink();
        }
        return parent::getEmailShareLink($url);
    }

    public function getFBShareCount($url = null)
    {
        if($url === null) {
            $url = get_permalink();
        }
        return parent::getFBShareCount($url);
    }

    public function getTwitterShareCount($url = null)
    {
        if($url === null) {
            $url = get_permalink();
        }
        return parent::getTwitterShareCount($url);
    }

    public function getLinkedInShareCount($url = null)
    {
        if($url === null) {
            $url = get_permalink();
        }
        return parent::getLinkedInShareCount($url);
    }


}
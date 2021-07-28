<?php
declare(strict_types=1);

namespace degordian\wpHelpers;

class WPSocialSharer extends SocialSharer
{
    public function getFBShareLink($url = null): string
    {
        if ($url === null) {
            $url = get_permalink();
        }
        return parent::getFBShareLink($url);
    }

    public function getTwitterShareLink($url = null): string
    {
        if ($url === null) {
            $url = get_permalink();
        }
        return parent::getTwitterShareLink($url);
    }

    public function getLinkedInShareLink($url = null): string
    {
        if ($url === null) {
            $url = get_permalink();
        }
        return parent::getLinkedInShareLink($url);
    }

    public function getGooglePlusShareLink($url = null): string
    {
        if ($url === null) {
            $url = get_permalink();
        }
        return parent::getGooglePlusShareLink($url);
    }

    public function getEmailShareLink($url = null): string
    {
        if ($url === null) {
            $url = get_permalink();
        }
        return parent::getEmailShareLink($url);
    }

    public function getFBShareCount($url = null): int
    {
        if ($url === null) {
            $url = get_permalink();
        }
        return parent::getFBShareCount($url);
    }

    public function getTwitterShareCount($url = null): int
    {
        if ($url === null) {
            $url = get_permalink();
        }
        return parent::getTwitterShareCount($url);
    }

    public function getLinkedInShareCount($url = null): int
    {
        if ($url === null) {
            $url = get_permalink();
        }
        return parent::getLinkedInShareCount($url);
    }
}

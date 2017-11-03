<?php

namespace degordian\wpHelpers;

/**
 * Class ACFDataProvider
 * @package app\helpers
 */
class ACFDataProvider
{
    /**
     *
     */
    const OPTION = 'option';
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * @var string
     */
    private $prefix = '';

    /**
     * @var array
     */
    private $fields = [];

    /**
     * DataProvider constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return ACFDataProvider|null
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ACFDataProvider();
        }

        return self::$instance;
    }


    /**
     * @param $name
     * @param bool $prefixed
     * @return bool|mixed|null
     */
    public function getOptionField($name, $prefixed = true)
    {
        return $this->getField($name, self::OPTION, $prefixed);
    }

    /**
     * @param $name
     * @param bool $postID
     * @param bool $prefixed
     * @return bool|mixed|null
     */
    public function getField($name, $postID = false, $prefixed = true)
    {
        $postID = $postID !== false ? $postID : get_the_ID();
        $key = ($prefixed ? $this->prefix : '' ) . $name;

        $cacheKey = 'field_' . $key . '_' . $postID;
        $fieldsCacheKey = 'fields_' . $postID;

        if (isset($this->fields[$cacheKey])) {
            return $this->fields[$cacheKey];
        } elseif (isset($this->fields[$fieldsCacheKey]) && isset($this->fields[$fieldsCacheKey][$key])) {
            return $this->fields[$fieldsCacheKey][$key];
        }

        $this->fields[$cacheKey] = get_field($key, $postID);
        return $this->fields[$cacheKey];
    }

    /**
     * @param string $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @return $this
     */
    public function clearPrefix()
    {
        $this->prefix = '';
        return $this;
    }

    /**
     * @param bool $postID
     * @return array|bool
     */
    public function getFields($postID = false)
    {
        $postID = $postID !== false ? $postID : get_the_ID();
        $key = 'fields_' . $postID;
        if (isset($this->fields[$key])) {
            return $this->fields[$key];
        }
        $this->fields[$key] = get_fields($postID);

        return $this->fields[$key];
    }

    public function getUserField($name, $userID = null, $prefixed = true)
    {
        if ($userID === null && is_single()) {
            $userID = get_the_author_meta('ID');
        }

        if ($userID) {
            return $this->getField($name, 'user_' . $userID, $prefixed);
        }

        return '';
    }
}

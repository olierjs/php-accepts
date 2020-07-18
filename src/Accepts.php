<?php
declare(strict_types=1);

namespace Press\Utils;


class Accepts
{
    private $req;
    private $negotiator;

    public function __construct($req)
    {
        $this->req = $req;
        $this->negotiator = new Negotiator($req);
    }

    private function type_($types = null)
    {
        // support flattened arguments
        if ($types && !is_array($types)) {
            $types = func_get_args();
        }

        // no types, return all requested types
        if (!$types || count($types) === 0) {
            return $this->negotiator->mediaTypes();
        }

        if (array_key_exists('accept', $this->req->headers) === false) {
            return $types[0];
        }

        $mime = array_map(Tool::ext_to_mime(), $types);
        $mime = array_filter($mime, Tool::valid_mime());
        $accepts = $this->negotiator->mediaTypes($mime);

        if (count($accepts) === 0 || !$accepts[0]) {
            return false;
        }

        $index = array_search($accepts[0], $mime);
        return $types[$index];
    }

    public function type()
    {
        $args = func_get_args();
        return self::type_(...$args);
    }

    public function types()
    {
        $args = func_get_args();
        return self::type_(...$args);
    }

    private function encoding_($encodings_ = null)
    {
        // support flattened arguments
        if ($encodings_ && !is_array($encodings_)) {
            $encodings_ = func_get_args();
        }

        // no encodings, return all requested encodings
        if (!$encodings_ || count($encodings_) === 0) {
            return $this->negotiator->encodings();
        }

        $encoding = $this->negotiator->encodings($encodings_);
        return empty($encoding) ? false : $encoding[0];
    }


    public function encoding()
    {
        $args = func_get_args();
        return $this->encoding_(...$args);
    }


    public function encodings()
    {
        $args = func_get_args();
        return $this->encoding_(...$args);
    }


    private function charset_($charsets_ = null)
    {
        // support flattened arguments
        if ($charsets_ && !is_array($charsets_)) {
            $charsets_ = func_get_args();
        }

        // no charsets, returned all requested charsets
        if (!$charsets_ || count($charsets_) === 0) {
            return $this->negotiator->charsets();
        }

        $charset = $this->negotiator->charsets($charsets_);
        return empty($charset) ? false : $charset[0];
    }


    public function charset()
    {
        $args = func_get_args();
        return $this->charset_(...$args);
    }


    public function charsets()
    {
        $args = func_get_args();
        return $this->charset_(...$args);
    }


    private function language_($languages_ = null)
    {
        // support flattened arguments
        if ($languages_ && !is_array($languages_)) {
            $languages_ = func_get_args();
        }

        // no languages, return all requested languages
        if (!$languages_ || count($languages_) === 0) {
            return $this->negotiator->languages();
        }

        $language = $this->negotiator->languages($languages_);
        return empty($language) ? false : $language[0];
    }


    public function lang()
    {
        $args = func_get_args();
        return $this->language_(...$args);
    }


    public function langs()
    {
        $args = func_get_args();
        return $this->language_(...$args);
    }


    public function language()
    {
        $args = func_get_args();
        return $this->language_(...$args);
    }


    public function languages()
    {
        $args = func_get_args();
        return $this->language_(...$args);
    }
}

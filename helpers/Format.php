<?php
class Format
{
    // Sanitize data
    public function sanitize($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // Text Shorten
    public function textShorten($text, $limit)
    {
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = $text . "...";
        return $text;
    }
}
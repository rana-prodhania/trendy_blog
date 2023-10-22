<?php
class Helper
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
    public static function textShorten($text, $limit)
    {
        // $text = $text . " ";
        // $text = substr($text, 0, $limit);
        // $text = $text . "...";
        // return $text;
        return mb_substr($text, 0, $limit, 'UTF-8') . "...";
    }

    //  Generate slug
    public function generateSlug($name)
    {
        $slug = trim(preg_replace('/[^a-zA-Z0-9\p{Bengali}-]+/u', '-', strtolower($name)), '-');
        return $slug;
    }
    // Name validation
    function validateName($name) {
        if (!preg_match('/^[- \p{Bengali}]+$/u', $name)) {
            throw new Exception("Category name should only contain hyphens, spaces, or Bengali characters.");
        }
        
    }

    // Name length
    function nameLength($name) {
        $minLength = ['english' => 3, 'bengali' => 3];
        $maxLength = ['english' => 25, 'bengali' => 70];
    
        $nameLength = mb_strlen($name, 'UTF-8');
        $isEnglish = preg_match('/[a-zA-Z]/', $name);
    
        $language = $isEnglish ? 'english' : 'bengali';
        $minLengthLanguage = $minLength[$language];
        $maxLengthLanguage = $maxLength[$language];
    
        if ($nameLength < $minLengthLanguage || $nameLength > $maxLengthLanguage) {
            throw new Exception("Category name does not meet the length requirements.");
        }
    }

    // Redirect to another page
    public function redirect($location){
        echo "<script>location.href = '$location';</script>";
        exit;
    }


    
}
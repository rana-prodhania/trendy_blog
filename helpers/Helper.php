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
        if (mb_strlen($text, 'UTF-8') > $limit) {
            $text = mb_substr($text, 0, $limit, 'UTF-8');
            $text = mb_substr($text, 0, mb_strrpos($text, ' ', 0, 'UTF-8'), 'UTF-8');
            $text .= '...';
        }
        return $text;
    }

    //  Generate slug
    public function generateSlug($name)
    {
        $slug = trim(preg_replace('/[^a-zA-Z0-9\p{Bengali}-]+/u', '-', strtolower($name)), '-');
        return $slug;
    }
    // Name validation
    function validateName($name)
    {
        if (!preg_match('/^[- \p{Bengali}a-zA-Z\s]+$/u', $name)) {
            throw new Exception("Category name should only contain hyphens, spaces, Bengali, or English characters.");
        }
    }



    // Name length
    function nameLength($name)
    {
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
    public function redirect($location)
    {
        echo "<script>location.href = '$location';</script>";
        exit;
    }

    // Upload Image
    public function uploadImage($image, $previousImage = null, $fileLocation = null)
    {
        $image_name = $image['name'];
        $image_temp = $image['tmp_name'];

        $image_ex_lc = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $image_new_name = uniqid('IMG-', true) . '.' . $image_ex_lc;
        $image_upload_path = $fileLocation . $image_new_name;

        if (!move_uploaded_file($image_temp, $image_upload_path)) {
            return 'Error: Failed to move the uploaded file';
        }

        if ($previousImage && file_exists($previousImage)) {
            unlink($previousImage);
        }

        return $image_new_name;
    }

    // Reading time word per minute count
    public static function readingTime($title,$text) {
        $wordsPerMinute = 100;
        $totalWord = $title." ". $text;
        $words = preg_split('/\s+/u', $totalWord);
        $wordCount = count($words);
        $readingTime = ceil($wordCount / $wordsPerMinute);
        return $readingTime;
    }

}
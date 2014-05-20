<?php
namespace Kendru\Util;

class Strings
{
    /**
     * Underscore a string
     *
     * Convert a string to under_score format. Converts words separated
     * by spaces or hyphens and camel-cased words.
     *
     * @param string $str
     * @return string
     */
    public static function underscore($str)
    {
        $str = preg_replace('/[^-_\w\s]/', '', $str);
        $str = preg_replace('/([a-z])([A-Z])/', '$1 $2', $str);
        $str = preg_replace('/[-\s]/', '_', $str);
        return strtolower($str);
    }

    /**
     * Camel-case a string
     *
     * Convert a string to camelCase. Converts words separated by spaces,
     * underscores, or hyphens.
     *
     * @param string $str
     * @return string
     */
    public static function camelCase($str)
    {
        $str = preg_replace('/[^-_\w\s]/', '', $str);
        $parts = preg_split('/[-_\s]/', $str);
        $out = strtolower(array_shift($parts));
        foreach($parts as $word) {
            $out .= ucfirst(strtolower($word));
        }
        return $out;
    }

    /**
     * Convert a string to title case
     *
     * Capitalize a string in headline style, using the Chicago Manual of
     * Style guidelines:
     * - The first and last words of a sentence are always capitalized
     * - All words within the sentence except articles, coordinating
     *   conjunctions, and prepositions.
     *
     * @param string $str
     * @return string
     */
    public static function titleCase($str)
    {
        $downcased = [
            'a' => 1, 'an' => 1, 'the' => 1, // articles
            'and' => 1, 'but' => 1, 'for' => 1, 'nor' => 1, 'or' => 1, 'so' => 1, 'yet' => 1, // coordinating conjunctions
            'aboard' => 1, 'about' => 1, 'above' => 1, 'across' => 1, 'after' => 1, 'against' => 1, 'along' => 1, 'amid' => 1, 'among' => 1, 'around' => 1, 'as' => 1, 'at' => 1, 'atop' => 1, 'before' => 1, 'behind' => 1, 'below' => 1, 'beneath' => 1, 'beside' => 1, 'between' => 1, 'beyond' => 1, 'by' => 1, 'despite' => 1, 'down' => 1, 'during' => 1, 'for' => 1, 'from' => 1, 'in' => 1, 'inside' => 1, 'into' => 1, 'like' => 1, 'near' => 1, 'of' => 1, 'off' => 1, 'on' => 1, 'onto' => 1, 'out' => 1, 'outside' => 1, 'over' => 1, 'past' => 1, 'regarding' => 1, 'round' => 1, 'since' => 1, 'than' => 1, 'through' => 1, 'throughout' => 1, 'till' => 1, 'to' => 1, 'toward' => 1, 'under' => 1, 'unlike' => 1, 'until' => 1, 'up' => 1, 'upon' => 1, 'with' => 1, 'within' => 1, 'without' => 1 // prepositions

        ];

        $words = preg_split('/\s+/', strtolower($str));
        if (count($words) < 3) {
            return ucwords(implode(' ', $words));
        }

        $first = array_shift($words);
        array_unshift($words, ucfirst($first));

        $last = array_pop($words);
        array_push($words, ucfirst($last));

        foreach ($words as &$word) {
            if (!isset($downcased[strtolower($word)])) {
                $word = ucfirst($word);
            }
        }

        return implode(' ', $words);
    }

    /**
     * Increment a string, assuming a standard alphabetical collation
     *
     * @param string $str
     * @return string
     */
    public static function increment($str)
    {
        return self::incrementRecursive($str, $str);
    }

    /**
     * We need to keep track of the original string in the case that
     * the input string is empty or made up entirely of "z" and/or " "
     *
     * @param string $str      String to increment
     * @param string $original Original input string
     */
    private static function incrementRecursive($str, $original)
    {
        if (empty($str)) {
            return $original . 'a';
        }

        $lastChar = $str[strlen($str) - 1];


        if ($lastChar === 'z' || $lastChar === ' ') {
            return self::incrementRecursive(substr($str, 0, strlen($str) - 1), $original);
        }

        return substr($str, 0, strlen($str) - 1) . ++$lastChar;
    }

    /**
     * Truncate a string to a given character length.
     *
     * Truncate a string to a given length in characters, optionally specifying 
     * an ellipsis string to use as an indicator that characters were removed 
     * and whether to cut off the string at a word boundary.
     *
     * @param string  $str      String to truncate
     * @param int     $length   (Optional) Number of characters to keep. 
     * Default: 140.
     * @param string  $ellipsis (Optional) String to append to truncated output. 
     * By default, nothing is appended. Furthermore, if the input string is 
     * shorter than the specified length, no $ellipsis will be appended.
     * @param boolean $breakOnWord (Optional) If true, the output will be 
     * truncated on the last word boundary before the specified length.
     * @return string Truncated output
     * */
    public static function truncate(
        $str,
        $length = 140,
        $ellipsis = '',
        $breakOnWord = false
    ) {
        if ($length > strlen($str)) {
            return $str;
        }

        $out = $breakOnWord
            ? preg_replace('/\s*\S*$/', '', substr($str, 0, $length))
            : substr($str, 0, $length);

        return $out . $ellipsis;
    }
}

<?php

namespace PH7\Framework\Security\Validate;

defined('PH7') or exit('Restricted access');

/**
 * NOTE: This script has been modified by Pierre-Henry Soria
 *
 * - We accept the HTML tag "style" for the functioning of "CKEditor" and "TinyMCE".
 *
 *
 *
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package        CodeIgniter
 * @author        ExpressionEngine Dev Team
 * @copyright    Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license        http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since        Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Security Class
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @category    Security
 * @author        ExpressionEngine Dev Team
 * @link        http://codeigniter.com/user_guide/libraries/security.html
 */
class Filter
{

    /**
     * Random Hash for protecting URLs
     *
     * @var string
     * @access protected
     */
    protected $_xss_hash = '';
    /**
     * Random Hash for Cross Site Request Forgery Protection Cookie
     *
     * @var string
     * @access protected
     */
    protected $_csrf_hash = '';
    /**
     * Expiration time for Cross Site Request Forgery Protection Cookie
     * Defaults to two hours (in seconds)
     *
     * @var int
     * @access protected
     */
    protected $_csrf_expire = 7200;
    /**
     * Token name for Cross Site Request Forgery Protection Cookie
     *
     * @var string
     * @access protected
     */
    protected $_csrf_token_name = 'ci_csrf_token';
    /**
     * Cookie name for Cross Site Request Forgery Protection Cookie
     *
     * @var string
     * @access protected
     */
    protected $_csrf_cookie_name = 'ci_csrf_token';
    /**
     * List of never allowed strings
     *
     * @var array
     * @access protected
     */
    protected $_never_allowed_str = array(
        'document.cookie' => '', // '' OR [removed]
        'document.write' => '', // '' OR [removed]
        '.parentNode' => '', // '' OR [removed]
        '.innerHTML' => '', // '' OR [removed]
        'window.location' => '', // '' OR [removed]
        '-moz-binding' => '', // '' OR [removed]
        '<!--' => '&lt;!--',
        '-->' => '--&gt;',
        '<![CDATA[' => '&lt;![CDATA[',
        '<comment>' => '&lt;comment&gt;'
    );

    /* never allowed, regex replacement */
    /**
     * List of never allowed regex replacement
     *
     * @var array
     * @access protected
     */
    protected $_never_allowed_regex = array(
        "javascript\s*:" => '', // '' OR [removed]
        "expression\s*(\(|&\#40;)" => '[removed]', // CSS and IE
        "vbscript\s*:" => '[removed]', // IE, surprise!
        "Redirect\s+302" => '[removed]'
    );

    /**
     * Constructor
     */
    public function __construct()
    {
        // CSRF config
        foreach (array('csrf_expire', 'csrf_token_name', 'csrf_cookie_name') as $key) {
            if (false !== ($val = config_item($key))) {
                $this->{'_' . $key} = $val;
            }
        }

        // Append application specific cookie prefix
        if (config_item('cookie_prefix')) {
            $this->_csrf_cookie_name = config_item('cookie_prefix') . $this->_csrf_cookie_name;
        }

        // Set the CSRF hash
        $this->_csrf_set_hash();

        //log_message('debug', "Security Class Initialized");
    }

    // --------------------------------------------------------------------

    /**
     * Verify Cross Site Request Forgery Protection
     *
     * @return    object
     */
    public function csrf_verify()
    {
        // If no POST data exists we will set the CSRF cookie
        if (count($_POST) == 0) {
            return $this->csrf_set_cookie();
        }

        // Do the tokens exist in both the _POST and _COOKIE arrays?
        if (!isset($_POST[$this->_csrf_token_name]) OR
            !isset($_COOKIE[$this->_csrf_cookie_name])) {
            $this->csrf_show_error();
        }

        // Do the tokens match?
        if ($_POST[$this->_csrf_token_name] != $_COOKIE[$this->_csrf_cookie_name]) {
            $this->csrf_show_error();
        }

        // We kill this since we're done and we don't want to
        // polute the _POST array
        unset($_POST[$this->_csrf_token_name]);

        // Nothing should last forever
        unset($_COOKIE[$this->_csrf_cookie_name]);
        $this->_csrf_set_hash();
        $this->csrf_set_cookie();

        //log_message('debug', "CSRF token verified ");

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Set Cross Site Request Forgery Protection Cookie
     *
     * @return    object
     */
    public function csrf_set_cookie()
    {
        $expire = time() + $this->_csrf_expire;
        $secure_cookie = (config_item('cookie_secure') === true) ? 1 : 0;

        if ($secure_cookie) {
            $req = isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : false;

            if (!$req OR $req == 'off') {
                return false;
            }
        }

        setcookie($this->_csrf_cookie_name, $this->_csrf_hash, $expire, config_item('cookie_path'), config_item('cookie_domain'), $secure_cookie);

        //log_message('debug', "CRSF cookie Set");

        return $this;
    }

    // --------------------------------------------------------------------

    /**
     * Show CSRF Error
     *
     * @return    void
     */
    public function csrf_show_error()
    {
        show_error('The action you have requested is not allowed.');
    }

    // --------------------------------------------------------------------

    /**
     * Get CSRF Hash
     *
     * Getter Method
     *
     * @return     string     self::_csrf_hash
     */
    public function get_csrf_hash()
    {
        return $this->_csrf_hash;
    }

    // --------------------------------------------------------------------

    /**
     * Get CSRF Token Name
     *
     * Getter Method
     *
     * @return     string     self::csrf_token_name
     */
    public function get_csrf_token_name()
    {
        return $this->_csrf_token_name;
    }

    // --------------------------------------------------------------------

    /**
     * XSS Clean
     *
     * Sanitizes data so that Cross Site Scripting Hacks can be
     * prevented.  This function does a fair amount of work but
     * it is extremely thorough, designed to prevent even the
     * most obscure XSS attempts.  Nothing is ever 100% foolproof,
     * of course, but I haven't been able to get anything passed
     * the filter.
     *
     * Note: This function should only be used to deal with data
     * upon submission.  It's not something that should
     * be used for general runtime processing.
     *
     * This function was based in part on some code and ideas I
     * got from Bitflux: http://channel.bitflux.ch/wiki/XSS_Prevention
     *
     * To help develop this script I used this great list of
     * vulnerabilities along with a few other hacks I've
     * harvested from examining vulnerabilities in other programs:
     * http://ha.ckers.org/xss.html
     *
     * @param    mixed    string or array
     * @param     bool
     *
     * @return    string
     */
    public function xssClean($str, $is_image = false)
    {
        /*
         * Is the string an array?
         *
         */
        if (is_array($str)) {
            foreach ($str as $key => $val) {
                $str[$key] = $this->xssClean($str[$key]);
            }

            return $str;
        }

        /*
         * Remove Invisible Characters
         */
        $str = remove_invisible_characters($str);

        // Validate Entities in URLs
        $str = $this->_validate_entities($str);

        /*
         * URL Decode
         *
         * Just in case stuff like this is submitted:
         *
         * <a href="http://%77%77%77%2E%67%6F%6F%67%6C%65%2E%63%6F%6D">Google</a>
         *
         * Note: Use rawurldecode() so it does not remove plus signs
         *
         */
        $str = rawurldecode($str);

        /*
         * Convert character entities to ASCII
         *
         * This permits our tests below to work reliably.
         * We only convert entities that are within tags since
         * these are the ones that will pose security problems.
         *
         */

        $str = preg_replace_callback("/[a-z]+=([\'\"]).*?\\1/si", array($this, '_convert_attribute'), $str);

        $str = preg_replace_callback("/<\w+.*?(?=>|<|$)/si", array($this, '_decode_entity'), $str);

        /*
         * Remove Invisible Characters Again!
         */
        $str = remove_invisible_characters($str);

        /*
         * Convert all tabs to spaces
         *
         * This prevents strings like this: ja    vascript
         * NOTE: we deal with spaces between characters later.
         * NOTE: preg_replace was found to be amazingly slow here on
         * large blocks of data, so we use str_replace.
         */

        if (strpos($str, "\t") !== false) {
            $str = str_replace("\t", ' ', $str);
        }

        /*
         * Capture converted string for later comparison
         */
        $converted_string = $str;

        // Remove Strings that are never allowed
        $str = $this->_do_never_allowed($str);

        /*
         * Makes PHP tags safe
         *
         * Note: XML tags are inadvertently replaced too:
         *
         * <?xml
         *
         * But it doesn't seem to pose a problem.
         */
        if ($is_image === true) {
            // Images have a tendency to have the PHP short opening and
            // closing tags every so often so we skip those and only
            // do the long opening tags.
            $str = preg_replace('/<\?(php)/i', "&lt;?\\1", $str);
        } else {
            $str = str_replace(array('<?', '?' . '>'), array('&lt;?', '?&gt;'), $str);
        }

        /*
         * Compact any exploded words
         *
         * This corrects words like:  j a v a s c r i p t
         * These words are compacted back to their correct state.
         */
        $words = array(
            'javascript', 'expression', 'vbscript', 'script',
            'applet', 'alert', 'document', 'write', 'cookie', 'window'
        );

        foreach ($words as $word) {
            $temp = '';

            for ($i = 0, $wordlen = strlen($word); $i < $wordlen; $i++) {
                $temp .= substr($word, $i, 1) . "\s*";
            }

            // We only want to do this when it is followed by a non-word character
            // That way valid stuff like "dealer to" does not become "dealerto"
            $str = preg_replace_callback('#(' . substr($temp, 0, -3) . ')(\W)#is', array($this, '_compact_exploded_words'), $str);
        }

        /*
         * Remove disallowed Javascript in links or img tags
         * We used to do some version comparisons and use of stripos for PHP5,
         * but it is dog slow compared to these simplified non-capturing
         * preg_match(), especially if the pattern exists in the string
         */
        do {
            $original = $str;

            if (preg_match("/<a/i", $str)) {
                $str = preg_replace_callback("#<a\s+([^>]*?)(>|$)#si", array($this, '_js_link_removal'), $str);
            }

            if (preg_match("/<img/i", $str)) {
                $str = preg_replace_callback("#<img\s+([^>]*?)(\s?/?>|$)#si", array($this, '_js_img_removal'), $str);
            }

            if (preg_match("/script/i", $str) OR preg_match("/xss/i", $str)) {
                $str = preg_replace("#<(/*)(script|xss)(.*?)\>#si", '', $str); // '' OR [removed]
            }
        } while ($original != $str);

        unset($original);

        // Remove evil attributes such as style, onclick and xmlns
        $str = $this->_remove_evil_attributes($str, $is_image);

        /*
         * Sanitize naughty HTML elements
         *
         * If a tag containing any of the words in the list
         * below is found, the tag gets converted to entities.
         *
         * So this: <blink>
         * Becomes: &lt;blink&gt;
         */
        $naughty = 'alert|applet|audio|basefont|base|behavior|bgsound|blink|body|embed|expression|form|frameset|frame|head|html|ilayer|iframe|input|isindex|layer|link|meta|object|plaintext|style|script|textarea|title|video|xml|xss';
        $str = preg_replace_callback('#<(/*\s*)(' . $naughty . ')([^><]*)([><]*)#is', array($this, '_sanitize_naughty_html'), $str);

        /*
         * Sanitize naughty scripting elements
         *
         * Similar to above, only instead of looking for
         * tags it looks for PHP and JavaScript commands
         * that are disallowed.  Rather than removing the
         * code, it simply converts the parenthesis to entities
         * rendering the code un-executable.
         *
         * For example:    eval('some code')
         * Becomes:        eval&#40;'some code'&#41;
         */
        $str = preg_replace('#(alert|cmd|passthru|eval|exec|expression|system|fopen|fsockopen|file|file_get_contents|readfile|unlink)(\s*)\((.*?)\)#si', "\\1\\2&#40;\\3&#41;", $str);


        // Final clean up
        // This adds a bit of extra precaution in case
        // something got through the above filters
        $str = $this->_do_never_allowed($str);

        /*
         * Images are Handled in a Special Way
         * - Essentially, we want to know that after all of the character
         * conversion is done whether any unwanted, likely XSS, code was found.
         * If not, we return TRUE, as the image is clean.
         * However, if the string post-conversion does not matched the
         * string post-removal of XSS, then it fails, as there was unwanted XSS
         * code found and removed/changed during processing.
         */

        if ($is_image === true) {
            return $str === $converted_string;
        }

        //log_message('debug', "XSS Filtering completed");
        return $str;
    }

    // --------------------------------------------------------------------

    /**
     * Random Hash for protecting URLs
     *
     * @return    string
     */
    public function xss_hash()
    {
        if ($this->_xss_hash == '') {
            mt_srand();
            $this->_xss_hash = md5(time() + mt_rand(0, 1999999999));
        }

        return $this->_xss_hash;
    }

    // --------------------------------------------------------------------

    /**
     * HTML Entities Decode
     *
     * This function is a replacement for html_entity_decode()
     *
     * The reason we are not using html_entity_decode() by itself is because
     * while it is not technically correct to leave out the semicolon
     * at the end of an entity most browsers will still interpret the entity
     * correctly.  html_entity_decode() does not convert entities without
     * semicolons, so we are left with our own little solution here. Bummer.
     *
     * @param    string
     * @param    string
     *
     * @return    string
     */
    public function entity_decode($str, $charset = 'UTF-8')
    {
        if (stristr($str, '&') === false) {
            return $str;
        }

        $str = html_entity_decode($str, ENT_COMPAT, $charset);
        $str = preg_replace('~&#x(0*[0-9a-f]{2,5})~ei', 'chr(hexdec("\\1"))', $str);
        return preg_replace('~&#([0-9]{2,4})~e', 'chr(\\1)', $str);
    }

    // --------------------------------------------------------------------

    /**
     * Filename Security
     *
     * @param    string
     * @param     bool
     *
     * @return    string
     */
    public function sanitize_filename($str, $relative_path = false)
    {
        $bad = array(
            "../",
            "<!--",
            "-->",
            "<",
            ">",
            "'",
            '"',
            '&',
            '$',
            '#',
            '{',
            '}',
            '[',
            ']',
            '=',
            ';',
            '?',
            "%20",
            "%22",
            "%3c",        // <
            "%253c",    // <
            "%3e",        // >
            "%0e",        // >
            "%28",        // (
            "%29",        // )
            "%2528",    // (
            "%26",        // &
            "%24",        // $
            "%3f",        // ?
            "%3b",        // ;
            "%3d"        // =
        );

        if (!$relative_path) {
            $bad[] = './';
            $bad[] = '/';
        }

        $str = remove_invisible_characters($str, false);
        return stripslashes(str_replace($bad, '', $str));
    }

    // ----------------------------------------------------------------

    /**
     * Compact Exploded Words
     *
     * Callback function for xssClean() to remove whitespace from
     * things like j a v a s c r i p t
     *
     * @param    type
     *
     * @return    type
     */
    protected function _compact_exploded_words($matches)
    {
        return preg_replace('/\s+/s', '', $matches[1]) . $matches[2];
    }

    // --------------------------------------------------------------------

    /*
     * Remove Evil HTML Attributes (like evenhandlers and style)
     *
     * It removes the evil attribute and either:
     *     - Everything up until a space
     *        For example, everything between the pipes:
     *        <a |style=document.write('hello');alert('world');| class=link>
     *     - Everything inside the quotes
     *        For example, everything between the pipes:
     *        <a |style="document.write('hello'); alert('world');"| class="link">
     *
     * @param string $str The string to check
     * @param boolean $is_image TRUE if this is an image
     * @return string The string with the evil attributes removed
     */
    protected function _remove_evil_attributes($str, $is_image)
    {
        // All javascript event handlers (e.g. onload, onclick, onmouseover), style, and xmlns
        // $evil_attributes = array('on\w*', 'style', 'xmlns', 'formaction');

        /**
         * We accept the HTML tag "style" for the functioning of "CKEditor" and "TinyMCE".
         * WARNING: Allowing the "style" and/or "img" tags promotes the CSRF attack!
         * If you do not want to use color in these editors, it is strongly recommended not to accept the tag style!!
         */
        $evil_attributes = array('on\w*', 'xmlns', 'formaction');

        if ($is_image === true) {
            /*
             * Adobe Photoshop puts XML metadata into JFIF images,
             * including namespacing, so we have to allow this for images.
             */
            unset($evil_attributes[array_search('xmlns', $evil_attributes)]);
        }

        do {
            $count = 0;
            $attribs = array();

            // find occurrences of illegal attribute strings without quotes
            preg_match_all("/(" . implode('|', $evil_attributes) . ")\s*=\s*([^\s]*)/is", $str, $matches, PREG_SET_ORDER);

            foreach ($matches as $attr) {
                $attribs[] = preg_quote($attr[0], '/');
            }

            // find occurrences of illegal attribute strings with quotes (042 and 047 are octal quotes)
            preg_match_all("/(" . implode('|', $evil_attributes) . ")\s*=\s*(\042|\047)([^\\2]*?)(\\2)/is", $str, $matches, PREG_SET_ORDER);

            foreach ($matches as $attr) {
                $attribs[] = preg_quote($attr[0], '/');
            }

            // replace illegal attribute strings that are inside an html tag
            if (count($attribs) > 0) {
                $str = preg_replace("/<(\/?[^><]+?)([^A-Za-z\-])(" . implode('|', $attribs) . ")([\s><])([><]*)/i", '<$1$2$4$5', $str, -1, $count);
            }

        } while ($count);

        return $str;
    }

    // --------------------------------------------------------------------

    /**
     * Sanitize Naughty HTML
     *
     * Callback function for xssClean() to remove naughty HTML elements
     *
     * @param    array
     *
     * @return    string
     */
    protected function _sanitize_naughty_html($matches)
    {
        // encode opening brace
        $str = '&lt;' . $matches[1] . $matches[2] . $matches[3];

        // encode captured opening or closing brace to prevent recursive vectors
        $str .= str_replace(array('>', '<'), array('&gt;', '&lt;'),
            $matches[4]);

        return $str;
    }

    // --------------------------------------------------------------------

    /**
     * JS Link Removal
     *
     * Callback function for xssClean() to sanitize links
     * This limits the PCRE backtracks, making it more performance friendly
     * and prevents PREG_BACKTRACK_LIMIT_ERROR from being triggered in
     * PHP 5.2+ on link-heavy strings
     *
     * @param    array
     *
     * @return    string
     */
    protected function _js_link_removal($match)
    {
        $attributes = $this->_filter_attributes(str_replace(array('<', '>'), '', $match[1]));

        return str_replace($match[1], preg_replace("#href=.*?(alert\(|alert&\#40;|javascript\:|livescript\:|mocha\:|charset\=|window\.|document\.|\.cookie|<script|<xss|base64\s*,)#si", "", $attributes), $match[0]);
    }

    // --------------------------------------------------------------------

    /**
     * JS Image Removal
     *
     * Callback function for xssClean() to sanitize image tags
     * This limits the PCRE backtracks, making it more performance friendly
     * and prevents PREG_BACKTRACK_LIMIT_ERROR from being triggered in
     * PHP 5.2+ on image tag heavy strings
     *
     * @param    array
     *
     * @return    string
     */
    protected function _js_img_removal($match)
    {
        $attributes = $this->_filter_attributes(str_replace(array('<', '>'), '', $match[1]));

        return str_replace($match[1], preg_replace("#src=.*?(alert\(|alert&\#40;|javascript\:|livescript\:|mocha\:|charset\=|window\.|document\.|\.cookie|<script|<xss|base64\s*,)#si", "", $attributes), $match[0]);
    }

    // --------------------------------------------------------------------

    /**
     * Attribute Conversion
     *
     * Used as a callback for XSS Clean
     *
     * @param    array
     *
     * @return    string
     */
    protected function _convert_attribute($match)
    {
        return str_replace(array('>', '<', '\\'), array('&gt;', '&lt;', '\\\\'), $match[0]);
    }

    // --------------------------------------------------------------------

    /**
     * Filter Attributes
     *
     * Filters tag attributes for consistency and safety
     *
     * @param    string
     *
     * @return    string
     */
    protected function _filter_attributes($str)
    {
        $out = '';

        if (preg_match_all('#\s*[a-z\-]+\s*=\s*(\042|\047)([^\\1]*?)\\1#is', $str, $matches)) {
            foreach ($matches[0] as $match) {
                $out .= preg_replace("#/\*.*?\*/#s", '', $match);
            }
        }

        return $out;
    }

    // --------------------------------------------------------------------

    /**
     * HTML Entity Decode Callback
     *
     * Used as a callback for XSS Clean
     *
     * @param    array
     *
     * @return    string
     */
    protected function _decode_entity($match)
    {
        return $this->entity_decode($match[0], strtoupper(config_item('charset')));
    }

    // --------------------------------------------------------------------

    /**
     * Validate URL entities
     *
     * Called by xssClean()
     *
     * @param     string
     *
     * @return     string
     */
    protected function _validate_entities($str)
    {
        /*
         * Protect GET variables in URLs
         */

        // 901119URL5918AMP18930PROTECT8198

        $str = preg_replace('|\&([a-z\_0-9\-]+)\=([a-z\_0-9\-]+)|i', $this->xss_hash() . "\\1=\\2", $str);

        /*
         * Validate standard character entities
         *
         * Add a semicolon if missing.  We do this to enable
         * the conversion of entities to ASCII later.
         *
         */
        $str = preg_replace('#(&\#?[0-9a-z]{2,})([\x00-\x20])*;?#i', "\\1;\\2", $str);

        /*
         * Validate UTF16 two byte encoding (x00)
         *
         * Just as above, adds a semicolon if missing.
         *
         */
        $str = preg_replace('#(&\#x?)([0-9A-F]+);?#i', "\\1\\2;", $str);

        /*
         * Un-Protect GET variables in URLs
         */
        $str = str_replace($this->xss_hash(), '&', $str);

        return $str;
    }

    // ----------------------------------------------------------------------

    /**
     * Do Never Allowed
     *
     * A utility function for xssClean()
     *
     * @param     string
     *
     * @return     string
     */
    protected function _do_never_allowed($str)
    {
        foreach ($this->_never_allowed_str as $key => $val) {
            $str = str_replace($key, $val, $str);
        }

        foreach ($this->_never_allowed_regex as $key => $val) {
            $str = preg_replace("#" . $key . "#i", $val, $str);
        }

        return $str;
    }

    // --------------------------------------------------------------------

    /**
     * Set Cross Site Request Forgery Protection Cookie
     *
     * @return    string
     */
    protected function _csrf_set_hash()
    {
        if ($this->_csrf_hash == '') {
            // If the cookie exists we will use it's value.
            // We don't necessarily want to regenerate it with
            // each page load since a page could contain embedded
            // sub-pages causing this feature to fail
            if (isset($_COOKIE[$this->_csrf_cookie_name]) &&
                $_COOKIE[$this->_csrf_cookie_name] != '') {
                return $this->_csrf_hash = $_COOKIE[$this->_csrf_cookie_name];
            }

            $sPrefix = (string)mt_rand();
            return $this->_csrf_hash = md5(uniqid($sPrefix, true));
        }

        return $this->_csrf_hash;
    }

}

// END Security Class

/**
 * Loads the main config.php file
 *
 * This function lets us grab the config file even if the Config class
 * hasn't been instantiated yet
 *
 * @access    private
 * @return    array
 */
function &get_config($replace = array())
{
    static $_config;

    if (isset($_config)) {
        return $_config[0];
    }

    require(__DIR__ . '/config_filter.inc.php');

    // Does the $config array exist in the file?
    if (!isset($config) OR !is_array($config)) {
        exit('Your config file does not appear to be formatted correctly.');
    }

    // Are any values being dynamically replaced?
    if (count($replace) > 0) {
        foreach ($replace as $key => $val) {
            if (isset($config[$key])) {
                $config[$key] = $val;
            }
        }
    }

    $_config[0] =& $config;
    return $_config[0];
}

/**
 * Returns the specified config item
 *
 * @access    public
 * @return    mixed
 */
function config_item($item)
{
    static $_config_item = array();

    if (!isset($_config_item[$item])) {
        $config =& get_config();

        if (!isset($config[$item])) {
            return false;
        }
        $_config_item[$item] = $config[$item];
    }

    return $_config_item[$item];
}

// --------------------------------------------------------------------

/**
 * Remove Invisible Characters
 *
 * This prevents sandwiching null characters
 * between ascii characters, like Java\0script.
 *
 * @access    public
 *
 * @param    string
 *
 * @return    string
 */
function remove_invisible_characters($str, $url_encoded = true)
{
    $non_displayables = array();

    // every control character except newline (dec 10)
    // carriage return (dec 13), and horizontal tab (dec 09)

    if ($url_encoded) {
        $non_displayables[] = '/%0[0-8bcef]/';    // url encoded 00-08, 11, 12, 14, 15
        $non_displayables[] = '/%1[0-9a-f]/';    // url encoded 16-31
    }

    $non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';    // 00-08, 11, 12, 14-31, 127

    do {
        $str = preg_replace($non_displayables, '', $str, -1, $count);
    } while ($count);

    return $str;
}

/* End of file Security.php */
/* Location: ./system/libraries/Security.php */
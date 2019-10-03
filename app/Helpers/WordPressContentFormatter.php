<?php

/**
 * App\Helpers\WordPressContentFormatter
 *
 * WordPress-ify the post output to improve oob formatting.
 * Main WordPress Formatting API.
 * Handles many functions for formatting output.
 *
 */

namespace App\Helpers;

class WordPressContentFormatter
{
    /**
     * Replaces common plain text characters into formatted entities
     *
     * As an example,
     *
     *     'cause today's effort makes it worth tomorrow's "holiday" ...
     *
     * Becomes:
     *
     *     &#8217;cause today&#8217;s effort makes it worth tomorrow&#8217;s &#8220;holiday&#8221; &#8230;
     *
     * @global array $wp_cockneyreplace Array of formatted entities for certain common phrases
     * @global array $shortcode_tags
     * @staticvar array  $static_characters
     * @staticvar array  $static_replacements
     * @staticvar array  $dynamic_characters
     * @staticvar array  $dynamic_replacements
     * @staticvar array  $default_no_texturize_tags
     * @staticvar array  $default_no_texturize_shortcodes
     * @staticvar bool   $run_texturize
     * @staticvar string $apos
     * @staticvar string $prime
     * @staticvar string $double_prime
     * @staticvar string $opening_quote
     * @staticvar string $closing_quote
     * @staticvar string $opening_single_quote
     * @staticvar string $closing_single_quote
     * @staticvar string $open_q_flag
     * @staticvar string $open_sq_flag
     * @staticvar string $apos_flag
     *
     * @param string $text The text to be formatted
     * @param bool   $reset Set to true for unit testing. Translated patterns will reset.
     * @return string The string replaced with html entities
     */
    public function wptexturize( $text, $reset = false ) {
        global $wp_cockneyreplace, $shortcode_tags;
        static $static_characters            = null,
            $static_replacements             = null,
            $dynamic_characters              = null,
            $dynamic_replacements            = null,
            $default_no_texturize_tags       = null,
            $default_no_texturize_shortcodes = null,
            $run_texturize                   = true,
            $apos                            = null,
            $prime                           = null,
            $double_prime                    = null,
            $opening_quote                   = '&#8220;',
            $closing_quote                   = '&#8221;',
            $opening_single_quote            = null,
            $closing_single_quote            = null,
            $open_q_flag                     = '<!--oq-->',
            $open_sq_flag                    = '<!--osq-->',
            $apos_flag                       = '<!--apos-->';

        // If there's nothing to do, just stop.
        if ( empty( $text ) || false === $run_texturize ) {
            return $text;
        }

        // Set up static variables. Run once only.
        if ( $reset || ! isset( $static_characters ) ) {
            /* translators: opening curly double quote */
            $opening_quote = '&#8220;';

            /* translators: closing curly double quote */
            $closing_quote = '&#8221;';

            /* translators: apostrophe, for example in 'cause or can't */
            $apos = '&#8217;';

            /* translators: prime, for example in 9' (nine feet) */
            $prime = '&#8242;';

            /* translators: double prime, for example in 9" (nine inches) */
            $double_prime = '&#8243;';

            /* translators: opening curly single quote */
            $opening_single_quote = '&#8216;';

            /* translators: closing curly single quote */
            $closing_single_quote = '&#8217;';

            /* translators: en dash */
            $en_dash = '&#8211;';

            /* translators: em dash */
            $em_dash = '&#8212;';

            $default_no_texturize_tags       = array( 'pre', 'code', 'kbd', 'style', 'script', 'tt' );
            $default_no_texturize_shortcodes = array( 'code' );

            // if a plugin has provided an autocorrect array, use it
            if ( isset( $wp_cockneyreplace ) ) {
                $cockney        = array_keys( $wp_cockneyreplace );
                $cockneyreplace = array_values( $wp_cockneyreplace );
            } else {
                /* translators: This is a comma-separated list of words that defy the syntax of quotations in normal use,
                 * for example...  'We do not have enough words yet' ... is a typical quoted phrase.  But when we write
                 * lines of code 'til we have enough of 'em, then we need to insert apostrophes instead of quotes.
                 */
                $cockney = explode(
                    ',',
                    "'tain't,'twere,'twas,'tis,'twill,'til,'bout,'nuff,'round,'cause,'em"
                );

                $cockneyreplace = explode(
                    ',', '&#8217;tain&#8217;t,&#8217;twere,&#8217;twas,&#8217;tis,&#8217;twill,&#8217;til,&#8217;bout,&#8217;nuff,&#8217;round,&#8217;cause,&#8217;em'
                );
            }

            $static_characters   = array_merge( array( '...', '``', '\'\'', ' (tm)' ), $cockney );
            $static_replacements = array_merge( array( '&#8230;', $opening_quote, $closing_quote, ' &#8482;' ), $cockneyreplace );

            // Pattern-based replacements of characters.
            // Sort the remaining patterns into several arrays for performance tuning.
            $dynamic_characters   = array(
                'apos'  => array(),
                'quote' => array(),
                'dash'  => array(),
            );
            $dynamic_replacements = array(
                'apos'  => array(),
                'quote' => array(),
                'dash'  => array(),
            );
            $dynamic              = array();
            $spaces               = self::wp_spaces_regexp();

            // '99' and '99" are ambiguous among other patterns; assume it's an abbreviated year at the end of a quotation.
            if ( "'" !== $apos || "'" !== $closing_single_quote ) {
                $dynamic[ '/\'(\d\d)\'(?=\Z|[.,:;!?)}\-\]]|&gt;|' . $spaces . ')/' ] = $apos_flag . '$1' . $closing_single_quote;
            }
            if ( "'" !== $apos || '"' !== $closing_quote ) {
                $dynamic[ '/\'(\d\d)"(?=\Z|[.,:;!?)}\-\]]|&gt;|' . $spaces . ')/' ] = $apos_flag . '$1' . $closing_quote;
            }

            // '99 '99s '99's (apostrophe)  But never '9 or '99% or '999 or '99.0.
            if ( "'" !== $apos ) {
                $dynamic['/\'(?=\d\d(?:\Z|(?![%\d]|[.,]\d)))/'] = $apos_flag;
            }

            // Quoted Numbers like '0.42'
            if ( "'" !== $opening_single_quote && "'" !== $closing_single_quote ) {
                $dynamic[ '/(?<=\A|' . $spaces . ')\'(\d[.,\d]*)\'/' ] = $open_sq_flag . '$1' . $closing_single_quote;
            }

            // Single quote at start, or preceded by (, {, <, [, ", -, or spaces.
            if ( "'" !== $opening_single_quote ) {
                $dynamic[ '/(?<=\A|[([{"\-]|&lt;|' . $spaces . ')\'/' ] = $open_sq_flag;
            }

            // Apostrophe in a word.  No spaces, double apostrophes, or other punctuation.
            if ( "'" !== $apos ) {
                $dynamic[ '/(?<!' . $spaces . ')\'(?!\Z|[.,:;!?"\'(){}[\]\-]|&[lg]t;|' . $spaces . ')/' ] = $apos_flag;
            }

            $dynamic_characters['apos']   = array_keys( $dynamic );
            $dynamic_replacements['apos'] = array_values( $dynamic );
            $dynamic                      = array();

            // Quoted Numbers like "42"
            if ( '"' !== $opening_quote && '"' !== $closing_quote ) {
                $dynamic[ '/(?<=\A|' . $spaces . ')"(\d[.,\d]*)"/' ] = $open_q_flag . '$1' . $closing_quote;
            }

            // Double quote at start, or preceded by (, {, <, [, -, or spaces, and not followed by spaces.
            if ( '"' !== $opening_quote ) {
                $dynamic[ '/(?<=\A|[([{\-]|&lt;|' . $spaces . ')"(?!' . $spaces . ')/' ] = $open_q_flag;
            }

            $dynamic_characters['quote']   = array_keys( $dynamic );
            $dynamic_replacements['quote'] = array_values( $dynamic );
            $dynamic                       = array();

            // Dashes and spaces
            $dynamic['/---/'] = $em_dash;
            $dynamic[ '/(?<=^|' . $spaces . ')--(?=$|' . $spaces . ')/' ] = $em_dash;
            $dynamic['/(?<!xn)--/']                                       = $en_dash;
            $dynamic[ '/(?<=^|' . $spaces . ')-(?=$|' . $spaces . ')/' ]  = $en_dash;

            $dynamic_characters['dash']   = array_keys( $dynamic );
            $dynamic_replacements['dash'] = array_values( $dynamic );
        }

        // Must do this every time in case plugins use these filters in a context sensitive manner
        /**
         * Filters the list of HTML elements not to texturize.
         *
         * @since 2.8.0
         *
         * @param array $default_no_texturize_tags An array of HTML element names.
         */
        $no_texturize_tags = $default_no_texturize_tags;
        /**
         * Filters the list of shortcodes not to texturize.
         *
         * @since 2.8.0
         *
         * @param array $default_no_texturize_shortcodes An array of shortcode names.
         */
        $no_texturize_shortcodes = $default_no_texturize_shortcodes;

        $no_texturize_tags_stack       = array();
        $no_texturize_shortcodes_stack = array();

        // Look for shortcodes and HTML elements.

        preg_match_all( '@\[/?([^<>&/\[\]\x00-\x20=]++)@', $text, $matches );
        $found_shortcodes = false;
        $shortcode_regex  = '[]';
        $regex = self::_get_wptexturize_split_regex();

        $textarr = preg_split( $regex, $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY );

        foreach ( $textarr as &$curl ) {
            // Only call _wptexturize_pushpop_element if $curl is a delimiter.
            $first = $curl[0];
            if ( '<' === $first ) {
                if ( '<!--' === substr( $curl, 0, 4 ) ) {
                    // This is an HTML comment delimiter.
                    continue;
                } else {
                    // This is an HTML element delimiter.

                    // Replace each & with &#038; unless it already looks like an entity.
                    $curl = preg_replace( '/&(?!#(?:\d+|x[a-f0-9]+);|[a-z1-4]{1,8};)/i', '&#038;', $curl );

                    self::_wptexturize_pushpop_element( $curl, $no_texturize_tags_stack, $no_texturize_tags );
                }
            } elseif ( '' === trim( $curl ) ) {
                // This is a newline between delimiters.  Performance improves when we check this.
                continue;

            } elseif ( empty( $no_texturize_shortcodes_stack ) && empty( $no_texturize_tags_stack ) ) {
                // This is neither a delimiter, nor is this content inside of no_texturize pairs.  Do texturize.

                $curl = str_replace( $static_characters, $static_replacements, $curl );

                if ( false !== strpos( $curl, "'" ) ) {
                    $curl = preg_replace( $dynamic_characters['apos'], $dynamic_replacements['apos'], $curl );
                    $curl = wptexturize_primes( $curl, "'", $prime, $open_sq_flag, $closing_single_quote );
                    $curl = str_replace( $apos_flag, $apos, $curl );
                    $curl = str_replace( $open_sq_flag, $opening_single_quote, $curl );
                }
                if ( false !== strpos( $curl, '"' ) ) {
                    $curl = preg_replace( $dynamic_characters['quote'], $dynamic_replacements['quote'], $curl );
                    $curl = wptexturize_primes( $curl, '"', $double_prime, $open_q_flag, $closing_quote );
                    $curl = str_replace( $open_q_flag, $opening_quote, $curl );
                }
                if ( false !== strpos( $curl, '-' ) ) {
                    $curl = preg_replace( $dynamic_characters['dash'], $dynamic_replacements['dash'], $curl );
                }

                // 9x9 (times), but never 0x9999
                if ( 1 === preg_match( '/(?<=\d)x\d/', $curl ) ) {
                    // Searching for a digit is 10 times more expensive than for the x, so we avoid doing this one!
                    $curl = preg_replace( '/\b(\d(?(?<=0)[\d\.,]+|[\d\.,]*))x(\d[\d\.,]*)\b/', '$1&#215;$2', $curl );
                }

                // Replace each & with &#038; unless it already looks like an entity.
                $curl = preg_replace( '/&(?!#(?:\d+|x[a-f0-9]+);|[a-z1-4]{1,8};)/i', '&#038;', $curl );
            }
        }

        return implode( '', $textarr );
    }

    /**
     * Implements a logic tree to determine whether or not "7'." represents seven feet,
     * then converts the special char into either a prime char or a closing quote char.
     *
     * @since 4.3.0
     *
     * @param string $haystack    The plain text to be searched.
     * @param string $needle      The character to search for such as ' or ".
     * @param string $prime       The prime char to use for replacement.
     * @param string $open_quote  The opening quote char. Opening quote replacement must be
     *                            accomplished already.
     * @param string $close_quote The closing quote char to use for replacement.
     * @return string The $haystack value after primes and quotes replacements.
     */
    private function wptexturize_primes( $haystack, $needle, $prime, $open_quote, $close_quote ) {
        $spaces           = wp_spaces_regexp();
        $flag             = '<!--wp-prime-or-quote-->';
        $quote_pattern    = "/$needle(?=\\Z|[.,:;!?)}\\-\\]]|&gt;|" . $spaces . ')/';
        $prime_pattern    = "/(?<=\\d)$needle/";
        $flag_after_digit = "/(?<=\\d)$flag/";
        $flag_no_digit    = "/(?<!\\d)$flag/";

        $sentences = explode( $open_quote, $haystack );

        foreach ( $sentences as $key => &$sentence ) {
            if ( false === strpos( $sentence, $needle ) ) {
                continue;
            } elseif ( 0 !== $key && 0 === substr_count( $sentence, $close_quote ) ) {
                $sentence = preg_replace( $quote_pattern, $flag, $sentence, -1, $count );
                if ( $count > 1 ) {
                    // This sentence appears to have multiple closing quotes.  Attempt Vulcan logic.
                    $sentence = preg_replace( $flag_no_digit, $close_quote, $sentence, -1, $count2 );
                    if ( 0 === $count2 ) {
                        // Try looking for a quote followed by a period.
                        $count2 = substr_count( $sentence, "$flag." );
                        if ( $count2 > 0 ) {
                            // Assume the rightmost quote-period match is the end of quotation.
                            $pos = strrpos( $sentence, "$flag." );
                        } else {
                            // When all else fails, make the rightmost candidate a closing quote.
                            // This is most likely to be problematic in the context of bug #18549.
                            $pos = strrpos( $sentence, $flag );
                        }
                        $sentence = substr_replace( $sentence, $close_quote, $pos, strlen( $flag ) );
                    }
                    // Use conventional replacement on any remaining primes and quotes.
                    $sentence = preg_replace( $prime_pattern, $prime, $sentence );
                    $sentence = preg_replace( $flag_after_digit, $prime, $sentence );
                    $sentence = str_replace( $flag, $close_quote, $sentence );
                } elseif ( 1 == $count ) {
                    // Found only one closing quote candidate, so give it priority over primes.
                    $sentence = str_replace( $flag, $close_quote, $sentence );
                    $sentence = preg_replace( $prime_pattern, $prime, $sentence );
                } else {
                    // No closing quotes found.  Just run primes pattern.
                    $sentence = preg_replace( $prime_pattern, $prime, $sentence );
                }
            } else {
                $sentence = preg_replace( $prime_pattern, $prime, $sentence );
                $sentence = preg_replace( $quote_pattern, $close_quote, $sentence );
            }
            if ( '"' == $needle && false !== strpos( $sentence, '"' ) ) {
                $sentence = str_replace( '"', $close_quote, $sentence );
            }
        }

        return implode( $open_quote, $sentences );
    }

    /**
     * Search for disabled element tags. Push element to stack on tag open and pop
     * on tag close.
     *
     * Assumes first char of $text is tag opening and last char is tag closing.
     * Assumes second char of $text is optionally '/' to indicate closing as in </html>.
     *
     * @since 2.9.0
     * @access private
     *
     * @param string $text Text to check. Must be a tag like `<html>` or `[shortcode]`.
     * @param array  $stack List of open tag elements.
     * @param array  $disabled_elements The tag names to match against. Spaces are not allowed in tag names.
     */
    private function _wptexturize_pushpop_element( $text, &$stack, $disabled_elements ) {
        // Is it an opening tag or closing tag?
        if ( isset( $text[1] ) && '/' !== $text[1] ) {
            $opening_tag = true;
            $name_offset = 1;
        } elseif ( 0 == count( $stack ) ) {
            // Stack is empty. Just stop.
            return;
        } else {
            $opening_tag = false;
            $name_offset = 2;
        }

        // Parse out the tag name.
        $space = strpos( $text, ' ' );
        if ( false === $space ) {
            $space = -1;
        } else {
            $space -= $name_offset;
        }
        $tag = substr( $text, $name_offset, $space );

        // Handle disabled tags.
        if ( in_array( $tag, $disabled_elements ) ) {
            if ( $opening_tag ) {
                /*
                 * This disables texturize until we find a closing tag of our type
                 * (e.g. <pre>) even if there was invalid nesting before that
                 *
                 * Example: in the case <pre>sadsadasd</code>"baba"</pre>
                 *          "baba" won't be texturize
                 */

                array_push( $stack, $tag );
            } elseif ( end( $stack ) == $tag ) {
                array_pop( $stack );
            }
        }
    }

    /**
     * Replaces double line-breaks with paragraph elements.
     *
     * A group of regex replaces used to identify text formatted with newlines and
     * replace double line-breaks with HTML paragraph tags. The remaining line-breaks
     * after conversion become <<br />> tags, unless $br is set to '0' or 'false'.
     *
     * @param string $pee The text which has to be formatted.
     * @param bool   $br  Optional. If set, this will convert all remaining line-breaks after paragraphing.
     * @return string Text which has been converted into correct paragraph tags.
     */
    public function wpautop($pee, $br = true)
    {
        $pre_tags = array();

        if (trim($pee) === '') {
            return '';
        }
            

        // Just to make things a little easier, pad the end.
        $pee = $pee . "\n";

        /*
         * Pre tags shouldn't be touched by autop.
         * Replace pre tags with placeholders and bring them back after autop.
         */
        if (strpos($pee, '<pre') !== false) {
            $pee_parts = explode('</pre>', $pee);
            $last_pee = array_pop($pee_parts);
            $pee = '';
            $i = 0;

            foreach ($pee_parts as $pee_part) {
                $start = strpos($pee_part, '<pre');

                // Malformed html?
                if ($start === false) {
                    $pee .= $pee_part;
                    continue;
                }

                $name = "<pre wp-pre-tag-$i></pre>";
                $pre_tags[$name] = substr($pee_part, $start) . '</pre>';
                $pee .= substr($pee_part, 0, $start) . $name;
                $i++;
            }

            $pee .= $last_pee;
        }

        // Change multiple <br>s into two line breaks, which will turn into paragraphs.
        $pee = preg_replace('|<br\s*/?>\s*<br\s*/?>|', "\n\n", $pee);
        $allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|form|map|area|blockquote|address|math|style|p|h[1-6]|hr|fieldset|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';

        // Add a double line break above block-level opening tags.
        $pee = preg_replace('!(<' . $allblocks . '[\s/>])!', "\n\n$1", $pee);

        // Add a double line break below block-level closing tags.
        $pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);

        // Standardize newline characters to "\n".
        $pee = str_replace(array("\r\n", "\r"), "\n", $pee);

        // Find newlines in all elements and add placeholders.
        $pee = $this->wp_replace_in_html_tags($pee, array( "\n" => " <!-- wpnl --> " ));

        // Collapse line breaks before and after <option> elements so they don't get autop'd.
        if (strpos($pee, '<option') !== false) {
            $pee = preg_replace('|\s*<option|', '<option', $pee);
            $pee = preg_replace('|</option>\s*|', '</option>', $pee);
        }

        /*
         * Collapse line breaks inside <object> elements, before <param> and <embed> elements
         * so they don't get autop'd.
         */
        if (strpos($pee, '</object>') !== false) {
            $pee = preg_replace('|(<object[^>]*>)\s*|', '$1', $pee);
            $pee = preg_replace('|\s*</object>|', '</object>', $pee);
            $pee = preg_replace('%\s*(</?(?:param|embed)[^>]*>)\s*%', '$1', $pee);
        }

        /*
         *
         * Collapse line breaks inside <audio> and <video> elements,
         * before and after <source> and <track> elements.
         */
        if (strpos($pee, '<source') !== false || strpos($pee, '<track') !== false) {
            $pee = preg_replace('%([<\[](?:audio|video)[^>\]]*[>\]])\s*%', '$1', $pee);
            $pee = preg_replace('%\s*([<\[]/(?:audio|video)[>\]])%', '$1', $pee);
            $pee = preg_replace('%\s*(<(?:source|track)[^>]*>)\s*%', '$1', $pee);
        }

        // Remove more than two contiguous line breaks.
        $pee = preg_replace("/\n\n+/", "\n\n", $pee);

        // Split up the contents into an array of strings, separated by double line breaks.
        $pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);

        // Reset $pee prior to rebuilding.
        $pee = '';

        // Rebuild the content as a string, wrapping every bit with a <p>.
        foreach ($pees as $tinkle) {
            $pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
        }

        // Under certain strange conditions it could create a P of entirely whitespace.
        $pee = preg_replace('|<p>\s*</p>|', '', $pee);

        // Add a closing <p> inside <div>, <address>, or <form> tag if missing.
        $pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $pee);

        // If an opening or closing block element tag is wrapped in a <p>, unwrap it.
        $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);

        // In some cases <li> may get wrapped in <p>, fix them.
        $pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee);

        // If a <blockquote> is wrapped with a <p>, move it inside the <blockquote>.
        $pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
        $pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);

        // If an opening or closing block element tag is preceded by an opening <p> tag, remove it.
        $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);

        // If an opening or closing block element tag is followed by a closing <p> tag, remove it.
        $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);

        // Optionally insert line breaks.
        if ($br) {
            // Replace newlines that shouldn't be touched with a placeholder.
            $s = str_replace("\n", "<WPPreserveNewline />", $pee);
            $pee = preg_replace('/<(script|style).*?<\/\\1>/s', $s, $pee);

            // Normalize <br>
            $pee = str_replace(array('<br>', '<br/>'), '<br />', $pee);

            // Replace any new line characters that aren't preceded by a <br /> with a <br />.
            $pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee);

            // Replace newline placeholders with newlines.
            $pee = str_replace('<WPPreserveNewline />', "\n", $pee);
        }

        // If a <br /> tag is after an opening or closing block tag, remove it.
        $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);

        // If a <br /> tag is before a subset of opening or closing block tags, remove it.
        $pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);

        $pee = preg_replace("|\n</p>$|", '</p>', $pee);

        // Replace placeholder <pre> tags with their original content.
        if (!empty($pre_tags)) {
            $pee = str_replace(array_keys($pre_tags), array_values($pre_tags), $pee);
        }
            

        // Restore newlines in all elements.
        if (false !== strpos($pee, '<!-- wpnl -->')) {
            $pee = str_replace(array(' <!-- wpnl --> ', '<!-- wpnl -->'), "\n", $pee);
        }

        return $pee;
    }

    /**
     * Separate HTML elements and comments from the text.
     *
     * @param string $input The text which has to be formatted.
     * @return array The formatted text.
     */
    private function wp_html_split($input)
    {
        return preg_split($this->get_html_split_regex(), $input, -1, PREG_SPLIT_DELIM_CAPTURE);
    }

    /**
     * Retrieve the regular expression for an HTML element.
     *
     * @return string The regular expression
     */
    private function get_html_split_regex()
    {
        static $regex;

        if (!isset($regex)) {
            $comments =
                '!'           // Start of comment, after the <.
                . '(?:'         // Unroll the loop: Consume everything until --> is found.
                .     '-(?!->)' // Dash not followed by end of comment.
                .     '[^\-]*+' // Consume non-dashes.
                . ')*+'         // Loop possessively.
                . '(?:-->)?';   // End of comment. If not found, match all input.
            $cdata =
                '!\[CDATA\['  // Start of comment, after the <.
                . '[^\]]*+'     // Consume non-].
                . '(?:'         // Unroll the loop: Consume everything until ]]> is found.
                .     '](?!]>)' // One ] not followed by end of comment.
                .     '[^\]]*+' // Consume non-].
                . ')*+'         // Loop possessively.
                . '(?:]]>)?';   // End of comment. If not found, match all input.
            $escaped =
                '(?='           // Is the element escaped?
                .    '!--'
                . '|'
                .    '!\[CDATA\['
                . ')'
                . '(?(?=!-)'      // If yes, which type?
                .     $comments
                . '|'
                .     $cdata
                . ')';
            $regex =
                '/('              // Capture the entire match.
                .     '<'           // Find start of element.
                .     '(?'          // Conditional expression follows.
                .         $escaped  // Find end of escaped element.
                .     '|'           // ... else ...
                .         '[^>]*>?' // Find end of normal element.
                .     ')'
                . ')/';
        }

        return $regex;
    }

    /**
     * Retrieve the combined regular expression for HTML and shortcodes.
     *
     * @access private
     * @ignore
     * @internal This function will be removed in 4.5.0 per Shortcode API Roadmap.
     * @since 4.4.0
     *
     * @staticvar string $html_regex
     *
     * @param string $shortcode_regex The result from _get_wptexturize_shortcode_regex().  Optional.
     * @return string The regular expression
     */
    private function _get_wptexturize_split_regex( $shortcode_regex = '' ) {
        static $html_regex;

        if ( ! isset( $html_regex ) ) {
            // phpcs:disable Squiz.Strings.ConcatenationSpacing.PaddingFound -- don't remove regex indentation
            $comment_regex =
                '!'             // Start of comment, after the <.
                . '(?:'         // Unroll the loop: Consume everything until --> is found.
                .     '-(?!->)' // Dash not followed by end of comment.
                .     '[^\-]*+' // Consume non-dashes.
                . ')*+'         // Loop possessively.
                . '(?:-->)?';   // End of comment. If not found, match all input.

            $html_regex = // Needs replaced with wp_html_split() per Shortcode API Roadmap.
                '<'                  // Find start of element.
                . '(?(?=!--)'        // Is this a comment?
                .     $comment_regex // Find end of comment.
                . '|'
                .     '[^>]*>?'      // Find end of element. If not found, match all input.
                . ')';
            // phpcs:enable
        }

        if ( empty( $shortcode_regex ) ) {
            $regex = '/(' . $html_regex . ')/';
        } else {
            $regex = '/(' . $html_regex . '|' . $shortcode_regex . ')/';
        }

        return $regex;
    }

    /**
     * Retrieve the regular expression for shortcodes.
     *
     * @access private
     * @ignore
     * @internal This function will be removed in 4.5.0 per Shortcode API Roadmap.
     * @since 4.4.0
     *
     * @param array $tagnames List of shortcodes to find.
     * @return string The regular expression
     */
    function _get_wptexturize_shortcode_regex( $tagnames ) {
        $tagregexp = join( '|', array_map( 'preg_quote', $tagnames ) );
        $tagregexp = "(?:$tagregexp)(?=[\\s\\]\\/])"; // Excerpt of get_shortcode_regex().
        // phpcs:disable Squiz.Strings.ConcatenationSpacing.PaddingFound -- don't remove regex indentation
        $regex =
            '\['              // Find start of shortcode.
            . '[\/\[]?'         // Shortcodes may begin with [/ or [[
            . $tagregexp        // Only match registered shortcodes, because performance.
            . '(?:'
            .     '[^\[\]<>]+'  // Shortcodes do not contain other shortcodes. Quantifier critical.
            . '|'
            .     '<[^\[\]>]*>' // HTML elements permitted. Prevents matching ] before >.
            . ')*+'             // Possessive critical.
            . '\]'              // Find end of shortcode.
            . '\]?';            // Shortcodes may end with ]]
        // phpcs:enable

        return $regex;
    }

    /**
     * Replace characters or phrases within HTML elements only.
     *
     * @param string $haystack The text which has to be formatted.
     * @param array $replace_pairs In the form array('from' => 'to', ...).
     * @return string The formatted text.
     */
    private function wp_replace_in_html_tags($haystack, $replace_pairs)
    {
        // Find all elements.
        $textarr = $this->wp_html_split($haystack);
        $changed = false;

        // Optimize when searching for one item.
        if (1 === count($replace_pairs)) {
            // Extract $needle and $replace.
            foreach ($replace_pairs as $needle => $replace);
            // Loop through delimiters (elements) only.
            for ($i = 1, $c = count($textarr); $i < $c; $i += 2) {
                if (false !== strpos($textarr[$i], $needle)) {
                    $textarr[$i] = str_replace($needle, $replace, $textarr[$i]);
                    $changed = true;
                }
            }
        } else {
            // Extract all $needles.
            $needles = array_keys($replace_pairs);
            // Loop through delimiters (elements) only.
            for ($i = 1, $c = count($textarr); $i < $c; $i += 2) {
                foreach ($needles as $needle) {
                    if (false !== strpos($textarr[$i], $needle)) {
                        $textarr[$i] = strtr($textarr[$i], $replace_pairs);
                        $changed = true;
                        // After one strtr() break out of the foreach loop and look at next element.
                        break;
                    }
                }
            }
        }

        if ($changed) {
            $haystack = implode($textarr);
        }

        return $haystack;
    }

    /**
     * Newline preservation help function for wpautop
     *
     * @since 3.1.0
     * @access private
     *
     * @param array $matches preg_replace_callback matches array
     * @return string
     */
    function _autop_newline_preservation_helper( $matches ) {
        return str_replace( "\n", '<WPPreserveNewline />', $matches[0] );
    }

    /**
     * Checks to see if a string is utf8 encoded.
     *
     * NOTE: This function checks for 5-Byte sequences, UTF8
     *       has Bytes Sequences with a maximum length of 4.
     *
     * @author bmorel at ssi dot fr (modified)
     * @since 1.2.1
     *
     * @param string $str The string to be checked
     * @return bool True if $str fits a UTF-8 model, false otherwise.
     */
    function seems_utf8( $str ) {
        mbstring_binary_safe_encoding();
        $length = strlen( $str );
        reset_mbstring_encoding();
        for ( $i = 0; $i < $length; $i++ ) {
            $c = ord( $str[ $i ] );
            if ( $c < 0x80 ) {
                $n = 0; // 0bbbbbbb
            } elseif ( ( $c & 0xE0 ) == 0xC0 ) {
                $n = 1; // 110bbbbb
            } elseif ( ( $c & 0xF0 ) == 0xE0 ) {
                $n = 2; // 1110bbbb
            } elseif ( ( $c & 0xF8 ) == 0xF0 ) {
                $n = 3; // 11110bbb
            } elseif ( ( $c & 0xFC ) == 0xF8 ) {
                $n = 4; // 111110bb
            } elseif ( ( $c & 0xFE ) == 0xFC ) {
                $n = 5; // 1111110b
            } else {
                return false; // Does not match any model
            }
            for ( $j = 0; $j < $n; $j++ ) { // n bytes matching 10bbbbbb follow ?
                if ( ( ++$i == $length ) || ( ( ord( $str[ $i ] ) & 0xC0 ) != 0x80 ) ) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Converts a number of special characters into their HTML entities.
     *
     * Specifically deals with: &, <, >, ", and '.
     *
     * $quote_style can be set to ENT_COMPAT to encode " to
     * &quot;, or ENT_QUOTES to do both. Default is ENT_NOQUOTES where no quotes are encoded.
     *
     * @since 1.2.2
     * @access private
     *
     * @staticvar string $_charset
     *
     * @param string     $string         The text which is to be encoded.
     * @param int|string $quote_style    Optional. Converts double quotes if set to ENT_COMPAT,
     *                                   both single and double if set to ENT_QUOTES or none if set to ENT_NOQUOTES.
     *                                   Also compatible with old values; converting single quotes if set to 'single',
     *                                   double if set to 'double' or both if otherwise set.
     *                                   Default is ENT_NOQUOTES.
     * @param string     $charset        Optional. The character encoding of the string. Default is false.
     * @param bool       $double_encode  Optional. Whether to encode existing html entities. Default is false.
     * @return string The encoded text with HTML entities.
     */
    function _wp_specialchars( $string, $quote_style = ENT_NOQUOTES, $charset = false, $double_encode = false ) {
        $string = (string) $string;

        if ( 0 === strlen( $string ) ) {
            return '';
        }

        // Don't bother if there are no specialchars - saves some processing
        if ( ! preg_match( '/[&<>"\']/', $string ) ) {
            return $string;
        }

        // Account for the previous behaviour of the function when the $quote_style is not an accepted value
        if ( empty( $quote_style ) ) {
            $quote_style = ENT_NOQUOTES;
        } elseif ( ! in_array( $quote_style, array( 0, 2, 3, 'single', 'double' ), true ) ) {
            $quote_style = ENT_QUOTES;
        }

        // Store the site charset as a static to avoid multiple calls to wp_load_alloptions()
        if ( ! $charset ) {
            static $_charset = null;
            $charset = $_charset;
        }

        if ( in_array( $charset, array( 'utf8', 'utf-8', 'UTF8' ) ) ) {
            $charset = 'UTF-8';
        }

        $_quote_style = $quote_style;

        if ( $quote_style === 'double' ) {
            $quote_style  = ENT_COMPAT;
            $_quote_style = ENT_COMPAT;
        } elseif ( $quote_style === 'single' ) {
            $quote_style = ENT_NOQUOTES;
        }

        if ( ! $double_encode ) {
            // Guarantee every &entity; is valid, convert &garbage; into &amp;garbage;
            // This is required for PHP < 5.4.0 because ENT_HTML401 flag is unavailable.
            $string = wp_kses_normalize_entities( $string );
        }

        $string = @htmlspecialchars( $string, $quote_style, $charset, $double_encode );

        // Back-compat.
        if ( 'single' === $_quote_style ) {
            $string = str_replace( "'", '&#039;', $string );
        }

        return $string;
    }

    /**
     * Converts and fixes HTML entities.
     *
     * This function normalizes HTML entities. It will convert `AT&T` to the correct
     * `AT&amp;T`, `&#00058;` to `&#58;`, `&#XYZZY;` to `&amp;#XYZZY;` and so on.
     *
     * @since 1.0.0
     *
     * @param string $string Content to normalize entities.
     * @return string Content with normalized entities.
     */
    function wp_kses_normalize_entities( $string ) {
        // Disarm all entities by converting & to &amp;
        $string = str_replace( '&', '&amp;', $string );

        // Change back the allowed entities in our entity whitelist
        $string = preg_replace_callback( '/&amp;([A-Za-z]{2,8}[0-9]{0,2});/', 'wp_kses_named_entities', $string );
        $string = preg_replace_callback( '/&amp;#(0*[0-9]{1,7});/', 'wp_kses_normalize_entities2', $string );
        $string = preg_replace_callback( '/&amp;#[Xx](0*[0-9A-Fa-f]{1,6});/', 'wp_kses_normalize_entities3', $string );

        return $string;
    }

    /**
     * Add leading zeros when necessary.
     *
     * If you set the threshold to '4' and the number is '10', then you will get
     * back '0010'. If you set the threshold to '4' and the number is '5000', then you
     * will get back '5000'.
     *
     * Uses sprintf to append the amount of zeros based on the $threshold parameter
     * and the size of the number. If the number is large enough, then no zeros will
     * be appended.
     *
     * @since 0.71
     *
     * @param int $number     Number to append zeros to if not greater than threshold.
     * @param int $threshold  Digit places number needs to be to not have zeros added.
     * @return string Adds leading zeros to number if needed.
     */
    function zeroise( $number, $threshold ) {
        return sprintf( '%0' . $threshold . 's', $number );
    }

    /**
     * Removes trailing forward slashes and backslashes if they exist.
     *
     * The primary use of this is for paths and thus should be used for paths. It is
     * not restricted to paths and offers no specific path support.
     *
     * @since 2.2.0
     *
     * @param string $string What to remove the trailing slashes from.
     * @return string String without the trailing slashes.
     */
    function untrailingslashit( $string ) {
        return rtrim( $string, '/\\' );
    }

    /**
     * Navigates through an array, object, or scalar, and removes slashes from the values.
     *
     * @since 2.0.0
     *
     * @param mixed $value The value to be stripped.
     * @return mixed Stripped value.
     */
    function stripslashes_deep( $value ) {
        return map_deep( $value, 'stripslashes_from_strings_only' );
    }

    /**
     * Converts email addresses characters to HTML entities to block spam bots.
     *
     * @since 0.71
     *
     * @param string $email_address Email address.
     * @param int    $hex_encoding  Optional. Set to 1 to enable hex encoding.
     * @return string Converted email address.
     */
    function antispambot( $email_address, $hex_encoding = 0 ) {
        $email_no_spam_address = '';
        for ( $i = 0, $len = strlen( $email_address ); $i < $len; $i++ ) {
            $j = rand( 0, 1 + $hex_encoding );
            if ( $j == 0 ) {
                $email_no_spam_address .= '&#' . ord( $email_address[ $i ] ) . ';';
            } elseif ( $j == 1 ) {
                $email_no_spam_address .= $email_address[ $i ];
            } elseif ( $j == 2 ) {
                $email_no_spam_address .= '%' . zeroise( dechex( ord( $email_address[ $i ] ) ), 2 );
            }
        }

        return str_replace( '@', '&#64;', $email_no_spam_address );
    }

    /**
     * Maps a function to all non-iterable elements of an array or an object.
     *
     * This is similar to `array_walk_recursive()` but acts upon objects too.
     *
     * @since 4.4.0
     *
     * @param mixed    $value    The array, object, or scalar.
     * @param callable $callback The function to map onto $value.
     * @return mixed The value with the callback applied to all non-arrays and non-objects inside it.
     */
    function map_deep( $value, $callback ) {
        if ( is_array( $value ) ) {
            foreach ( $value as $index => $item ) {
                $value[ $index ] = map_deep( $item, $callback );
            }
        } elseif ( is_object( $value ) ) {
            $object_vars = get_object_vars( $value );
            foreach ( $object_vars as $property_name => $property_value ) {
                $value->$property_name = map_deep( $property_value, $callback );
            }
        } else {
            $value = call_user_func( $callback, $value );
        }

        return $value;
    }

    /**
     * Add slashes to a string or array of strings.
     *
     * This should be used when preparing data for core API that expects slashed data.
     * This should not be used to escape data going directly into an SQL query.
     *
     * @since 3.6.0
     *
     * @param string|array $value String or array of strings to slash.
     * @return string|array Slashed $value
     */
    function wp_slash( $value ) {
        if ( is_array( $value ) ) {
            foreach ( $value as $k => $v ) {
                if ( is_array( $v ) ) {
                    $value[ $k ] = wp_slash( $v );
                } else {
                    $value[ $k ] = addslashes( $v );
                }
            }
        } else {
            $value = addslashes( $value );
        }

        return $value;
    }

    /**
     * Returns the regexp for common whitespace characters.
     *
     * By default, spaces include new lines, tabs, nbsp entities, and the UTF-8 nbsp.
     * This is designed to replace the PCRE \s sequence.  In ticket #22692, that
     * sequence was found to be unreliable due to random inclusion of the A0 byte.
     *
     * @since 4.0.0
     *
     * @staticvar string $spaces
     *
     * @return string The spaces regexp.
     */
    public static function wp_spaces_regexp() {
        static $spaces = '';

        return $spaces;
    }

    /**
     * Shorten a URL, to be used as link text.
     *
     * @since 1.2.0
     * @since 4.4.0 Moved to wp-includes/formatting.php from wp-admin/includes/misc.php and added $length param.
     *
     * @param string $url    URL to shorten.
     * @param int    $length Optional. Maximum length of the shortened URL. Default 35 characters.
     * @return string Shortened URL.
     */
    function url_shorten( $url, $length = 35 ) {
        $stripped  = str_replace( array( 'https://', 'http://', 'www.' ), '', $url );
        $short_url = untrailingslashit( $stripped );

        if ( strlen( $short_url ) > $length ) {
            $short_url = substr( $short_url, 0, $length - 3 ) . '&hellip;';
        }
        return $short_url;
    }

}
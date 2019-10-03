<?php

namespace App\Traits;

trait Bannerable {

    /**-----------------------------------------------------------------------------
     *
     *  @author       Pieter Goosen <http://stackoverflow.com/users/1908141/pieter-goosen>
     *  @return       Ads in between $content
     *  @link         http://stackoverflow.com/q/25888630/1908141
     * 
     *  Special thanks to the following answers on my questions that helped me to
     *  to achieve this
     *     - http://stackoverflow.com/a/26032282/1908141
     *     - http://stackoverflow.com/a/25988355/1908141
     *     - http://stackoverflow.com/a/26010955/1908141
     *     - http://wordpress.stackexchange.com/a/162787/31545
     *
    *------------------------------------------------------------------------------*/ 
    public function insertAdCode($content, $ad1 = null, $ad2 = null)
    {
        /**-----------------------------------------------------------------------------
         *
         *  wptexturize is applied to the $content. This inserts p tags that will help to  
         *  split the text into paragraphs. The text is split into paragraphs after each
         *  closing p tag. Remember, each double break constitutes a paragraph.
         *  
         *  @todo If you really need to delete the attachments in paragraph one, you want
         *        to do it here before you start your foreach loop
         *
        *------------------------------------------------------------------------------*/ 
        $closing_p = '</p>';
        $paragraphs = explode( $closing_p, $this->content );
        if ($ad1 == null) {
            $ad1 = $defaultAd1;
        }
        if ($ad2 == null) {
            $ad2 = $defaultAd2;
        }
        

        /**-----------------------------------------------------------------------------
         *
         *  The amount of paragraphs is counted to determine ad frequency. If there are
         *  less than four paragraphs, only one ad will be placed. If the paragraph count
         *  is more than 4, the text is split into two sections, $first and $second according
         *  to the midpoint of the text. $totals will either contain the full text (if 
         *  paragraph count is less than 4) or an array of the two separate sections of
         *  text
         *
         *  @todo Set paragraph count to suite your needs
         *
        *------------------------------------------------------------------------------*/ 
        $count = count( $paragraphs );
        if( 4 >= $count ) {
            $totals = array( $paragraphs ); 
        }else{
            $midpoint = floor($count / 2);
            $first = array_slice($paragraphs, 0, $midpoint );
            if( $count%2 == 1 ) {
                $second = array_slice( $paragraphs, $midpoint, $midpoint, true );
            }else{
                $second = array_slice( $paragraphs, $midpoint, $midpoint-1, true );
            }
            $totals = array( $first, $second );
        }

        $new_paras = array();   
        foreach ( $totals as $key_total=>$total ) { 
            /**-----------------------------------------------------------------------------
             *
             *  This is where all the important stuff happens
             *  The first thing that is done is a word count on every paragraph
             *  Each paragraph is is also checked if the following tags, a, li and ul exists
             *  If any of the above tags are found or the text count is less than 10, 0 is 
             *  returned for this paragraph. ($p will hold these values for later checking)
             *  If none of the above conditions are true, 1 will be returned. 1 will represent
             *  paragraphs that qualify for add insertion, and these will determine where an ad 
             *  will go
             *  returned for this paragraph. ($p will hold these values for later checking)
             *
             *  @todo You can delete or add rules here to your liking
             *
            *------------------------------------------------------------------------------*/ 
            $p = array();
            foreach ( $total as $key_paras=>$paragraph ) {
                $word_count = count(explode(' ', $paragraph));
                if( preg_match( '~<(?:img|ul|li)[ >]~', $paragraph ) || $word_count < 10 ) {  
                    $p[$key_paras] = 0; 
                }else{
                    $p[$key_paras] = 1; 
                }   
            } 

            /**-----------------------------------------------------------------------------
             *
             *  Return a position where an ad will be inserted
             *  This code checks if there are two adjacent 1's, and then return the second key
             *  The ad will be inserted between these keys
             *  If there are no two adjacent 1's, "no_ad" is returned into array $m
             *  This means that no ad will be inserted in that section
             *
            *------------------------------------------------------------------------------*/ 
            $m = array();
            foreach ( $p as $key=>$value ) {
                if( 1 === $value && array_key_exists( $key-1, $p ) && $p[$key] === $p[$key-1] && !$m){
                    $m[] = $key;
                }elseif( !array_key_exists( $key+1, $p ) && !$m ) {
                    $m[] = 'no-ad';
                }
            } 

            /**-----------------------------------------------------------------------------
             *
             *  Use two different ads, one for each section
             *  Only ad1 is displayed if there is less than 4 paragraphs
             *
             *  @todo Replace "PLACE YOUR ADD NO 1 HERE" with your ad or code. Leave p tags
             *  @todo I will try to insert widgets here to make it dynamic
             *
            *------------------------------------------------------------------------------*/ 
            if( $key_total == 0 ){
                $ad = array( 'ad1' => $ad1 );
            }else{
                $ad = array( 'ad2' => $ad2 );
            }

            /**-----------------------------------------------------------------------------
             *
             *  This code loops through all the paragraphs and checks each key against $mail
             *  and $key_para
             *  Each paragraph is returned to an array called $new_paras. $new_paras will
             *  hold the new content that will be passed to $content.
             *  If a key matches the value of $m (which holds the array key of the position
             *  where an ad should be inserted) an add is inserted. If $m holds a value of
             *  'no_ad', no ad will be inserted
             *
            *------------------------------------------------------------------------------*/ 
            foreach ( $total as $key_para=>$para ) {
                if( !in_array( 'no_ad', $m ) && $key_para === $m[0] ){
                    $new_paras[key($ad)] = $ad[key($ad)];
                    $new_paras[$key_para] = $para;
                }else{
                    $new_paras[$key_para] = $para;
                }
            }
        }

        /**-----------------------------------------------------------------------------
         *
         *  $content should be a string, not an array. $new_paras is an array, which will
         *  not work. $new_paras are converted to a string with implode, and then passed
         *  to $content which will be our new content
         *
        *------------------------------------------------------------------------------*/ 
        $content =  implode( ' ', $new_paras );

        return $content;
    }

    
}
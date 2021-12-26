<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Main filter class
 *
 * @package   filter_fetchcode
 * @author    Camba Coop <info@camba.coop>
 * @copyright 2020 Camba Coop {@link https://www.camba.coop}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Filter class for highlighting code syntax.
 *
 * @package   filter_fetchcode
 * @author    Camba Coop <info@camba.coop>
 * @copyright 2020 Camba Coop {@link https://www.camba.coop}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class filter_fetchcode extends moodle_text_filter {

    /**
     * The filter function is required, but the text just passes through.
     *
     * @param string $text HTML to be processed.
     * @param array $options Options for filter.
     * @return string String containing processed HTML.
     */
    public function filter($text, array $options = array()) {
        // Define necessary regexs.
        $trustedsourcespattern = '/(https:\/\/gitlab.com|https:\/\/raw.githubusercontent.com)/';
        $externalsourcespattern = '/(https?|ftp):\/\/(-\.)?([^\s\/?\.#-]+\.?)+(\/[^\s]*)?/';
        $allowallsources = get_config('filter_fetchcode', 'allowexternalsource');

        if (!is_string($text) || empty($text)) {
            return $text;
        }

        $re = '~```(.*?)```~isu';
        $urlpattern = (($allowallsources > 0) ? $externalsourcespattern : $trustedsourcespattern);

        $result = preg_match_all($re, $text, $matches);
        if ($result > 0) {
            foreach ($matches[1] as $idx => $code) {
                // Check if the code has url format.
                if (preg_match($urlpattern , $code, $matchedurlspattern)) {
                    // Check using strncmp to validate $code doesn´t have nothing else than the url.
                    if (strncmp($matchedurlspattern[0], $code, strlen($matchedurlspattern[0])) !== 0 ) {
                        $code = $this->fetchcodefromurl($code);
                    } else {
                        return $text;
                    }
                }
                $newcode = '<pre><code>' .
                    str_replace(['<p>', '</p>'], ['', "\n"], $code) .
                    '</code></pre>';
                $text = str_replace($matches[0][$idx], $newcode, $text);
            }
        }

        return $text;
    }

    /**
     * Fetch code  from repository
     *
     * @param url url to fetch code from.
     * @return coderesult  String contains fetched code.
     */

    protected function fetchcodefromurl($url) {
        $cleanurl = (string) trim(strip_tags($url));
        $ch = curl_init($cleanurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $coderesult = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpcode != 200) {
            $coderesult = $url;
        }
        curl_close ($ch);
        $coderesult = htmlentities($coderesult);
        return $coderesult;
    }

}

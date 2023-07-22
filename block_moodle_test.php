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
 * Moodle test block
 *
 * @package    block_moodle_test
 * @copyright  2023, Sumit Negi <sumitnegi.933@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('DEFAULT_NUMBER_OF_VIDEOS', 5);

/**
 * Moodle test block class
 *
 * @package    block_moodle_test
 * @copyright  2023, Sumit Negi <sumitnegi.933@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_moodle_test extends block_base {
    /**
     * Initialize test block
     *
     * @return void
     */
    public function init(): void {
        $this->title = get_string('pluginname', 'block_moodle_test');
        $this->config = new stdClass();
    }

    /**
     * Gets the test block contents.
     *
     * @return object.
     */
    public function get_content(): object {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->footer = '';
        $course = $this->page->course;
        $data = new block_moodle_test\output\main($course->id);
        $output = $this->page->get_renderer('block_moodle_test');
        $this->content->text = $output->render($data);
        return $this->content;
    }

    /**
     * Locations/context where block can be displayed.
     *
     * @return array
     */
    public function applicable_formats(): array {
        return ['course' => true];
    }
}

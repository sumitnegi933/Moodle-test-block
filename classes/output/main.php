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
 *  block_moodle_test main output
 *
 * @package   block_moodle_test
 * @copyright 2023, Sumit Negi <sumitnegi.933@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_moodle_test\output;

use block_moodle_test\api;
use renderer_base;

/**
 *  block_moodle_test main output
 *
 * @package   block_moodle_test
 * @copyright 2023, Sumit Negi <sumitnegi.933@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class main implements \renderable, \templatable {
    /**
     * @var courseid
     */
    protected $courseid;

    /**
     * main constructor.
     * @param int $courseid
     */
    public function __construct($courseid) {
        $this->courseid = $courseid;
    }

    /**
     * Return final data to render
     * @param renderer_base $output
     * @return array|\stdClass
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public function export_for_template(renderer_base $output) {
        global $USER;
        $data = [];
        $course = get_course($this->courseid);
        $modinfo = get_fast_modinfo($course);
        foreach ($modinfo->cms as $cm) {
            if (!$cm->uservisible) {
                continue;
            }
            $describe = get_string('completion-y', 'completion');
            $status = api::is_activity_completed($USER->id, $cm->id) ? " | $describe" : '';
            $link = $cm->id . ' | ' . $cm->name . ' | ' . userdate($cm->added) . $status;
            $data['activities'][] = \html_writer::link(new \moodle_url("/mod/$cm->modname/view.php", ['id' => $cm->id]), $link);
        }
        return $data;
    }
}

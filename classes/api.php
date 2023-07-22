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

namespace block_moodle_test;
/**
 * Moodle test block api
 *
 * @package    block_moodle_test
 * @copyright  2023, Sumit Negi <sumitnegi.933@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class api {

    /**
     * Function to check if an activity is completed by a user or not.
     *
     * @param int $userid The user ID for which completion needs to be checked.
     * @param int $cmid The course module ID of the activity.
     * @return bool True if the activity is completed by the user, false otherwise.
     */
    public static function is_activity_completed($userid, $cmid): bool {
        global $DB;
        $completiontype = '';
        // Check if the activity completion tracking is enabled for the specific activity.
        $completion = $DB->get_record('course_modules_completion',
         ['coursemoduleid' => $cmid, 'userid' => $userid], '*', IGNORE_MISSING);
        // If completion record exists and the activity is marked as completed, return true.
        if ($completion) {
            switch ($completion->completionstate) {
                case COMPLETION_COMPLETE:
                    $completiontype = 'y';
                    break;
                case COMPLETION_COMPLETE_PASS:
                    $completiontype = 'pass';
                    break;
                case COMPLETION_COMPLETE_FAIL:
                    $completiontype = 'fail';
                    break;
            }
            if ($completiontype) {
                return true;
            }
        }
        // If none of the above conditions are met, return false.
        return false;
    }
}

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

namespace qbank_viewcreator;

use core_question\local\bank\plugin_features_base;
use core_question\local\bank\view;

/**
 * Class plugin_feature is the entrypoint for the columns.
 *
 * @package    qbank_viewcreator
 * @copyright  2021 Catalyst IT Australia Pty Ltd
 * @author     Ghaly Marc-Alexandre <marc-alexandreghaly@catalyst-ca.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plugin_feature extends plugin_features_base {
    #[\Override]
    public function get_question_columns($qbank): array {
        return [
            new creator_name_column($qbank),
            new modifier_name_column($qbank),
        ];
    }

    #[\Override]
    public function get_question_filters(?view $qbank = null): array {
        return [
            new timemodified_condition($qbank),
            new createdby_condition($qbank),
            new modifiedby_condition($qbank),
        ];
    }
}

/*
 *  Copyright (C) 2008 Nicolas Vion <nico@picapo.net>
 *
 *   This file is part of Topy.
 *
 *   Topy is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *   Topy is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with Topy; if not, write to the Free Software
 *   Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

//This script was generated by php/mk_macros.php
//Don't change manually!

#ifndef _HELP_HH
#define _HELP_HH

<?
function mk_define($name, $lines) {
	echo "#define $name \\\n";
	$sep = "";
	foreach($lines as $line) {
		echo $sep."\t".'"'.str_replace('"', '\\"', $line).'" ';
		$sep = "\\\n";
	}
	echo "\n\n";
}

function extract_help($path, $pattern = "//!(.*)", $header = true) {
	$f = file($path);

	$tbl = array();
	if ($header) {
		$tbl[] = "list of commands:\\n";
		$tbl[] = "=================\\n";
	}

	foreach ($f as $line) {
		$line = ltrim($line);
		if (ereg($pattern, $line, $args))
			$tbl[] =  rtrim($args[1]).'\\n';
	}
	//array_push($tbl, substr(array_pop($tbl), 0, -2));
	return $tbl;
}

mk_define("HELP_SERVER", extract_help(dirname(__FILE__)."/../server.cc"));
mk_define("HELP_GROUPS", extract_help(dirname(__FILE__)."/../groups_interface.cc"));
mk_define("HELP_USER", extract_help(dirname(__FILE__)."/../user.cc"));
mk_define("HELP_USERS_SETS", extract_help(dirname(__FILE__)."/../users_sets.cc"));
mk_define("HELP_CONTESTS", extract_help(dirname(__FILE__)."/../contests.cc"));
mk_define("HELP_CONTEST", extract_help(dirname(__FILE__)."/../contest.cc"));
mk_define("HELP_FIELD", extract_help(dirname(__FILE__)."/../field.cc"));
mk_define("HELP_FIELD_ULOG", extract_help(dirname(__FILE__)."/../field.cc", "//ulog!(.*)", false));
mk_define("HELP_FIELD_LOG", extract_help(dirname(__FILE__)."/../field.cc", "//log!(.*)", false));
mk_define("HELP_FIELD_EVENTS", extract_help(dirname(__FILE__)."/../field.cc", "//events!(.*)", false));
mk_define("HELP_AUTODUMP", extract_help(dirname(__FILE__)."/../autodump.cc"));
mk_define("HELP_FIELDS", extract_help(dirname(__FILE__)."/../fields.cc"));

?>

#endif

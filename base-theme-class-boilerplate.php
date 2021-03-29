<?php
/*
+----------------------------------------------------------------------
| Copyright (c) 2018,2019,2020 Genome Research Ltd.
| This is part of the Wellcome Sanger Institute extensions to
| wordpress.
+----------------------------------------------------------------------
| This extension to Worpdress is free software: you can redistribute
| it and/or modify it under the terms of the GNU Lesser General Public
| License as published by the Free Software Foundation; either version
| 3 of the License, or (at your option) any later version.
|
| This program is distributed in the hope that it will be useful, but
| WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
| Lesser General Public License for more details.
|
| You should have received a copy of the GNU Lesser General Public
| License along with this program. If not, see:
|     <http://www.gnu.org/licenses/>.
+----------------------------------------------------------------------

# Support functions to make ACF managed pages easier to render..
# This is a very simple class which defines templates {and an
# associated template language which can then be used to render
# page content... more easily...}
#
# See foot of file for documentation on use...
#
# Author         : js5
# Maintainer     : js5
# Created        : 2018-02-09
# Last modified  : 2018-02-12

 * @package   BaseThemeClass/BoilerPlate
 * @author    JamesSmith james@jamessmith.me.uk
 * @license   GLPL-3.0+
 * @link      https://jamessmith.me.uk/base-theme-class-boilerplate/
 * @copyright 2018 James Smith
 *
 * @wordpress-plugin
 * Plugin Name: Website Base Theme Class - BoilerPlate
 * Plugin URI:  https://jamessmith.me.uk/base-theme-class-bopilerplate/
 * Description: Support functions to: add BoilerPlate text to BaseThemeClass based website
 * Version:     0.1.0
 * Author:      James Smith
 * Author URI:  https://jamessmith.me.uk
 * Text Domain: base-theme-class-locale
 * License:     GNU Lesser General Public v3
 * License URI: https://www.gnu.org/licenses/lgpl.txt
 * Domain Path: /lang
*/

namespace BaseThemeClass;

define( 'BOILERPLATE_FIELDS', [
  'Name'      => [ 'type' => 'text' ],
  'Content'   => [ 'type' => 'wysiwyg' ],
]);


class BoilerPlate {
  var $self;

  function __construct( $self ) {
    $this->self = $self;

    // Define the object fields - the boilerplate has a
    // name & WYSIWYG field to contain the text.

    $this->self->define_type( 'Boilerplate text', BOILERPLATE_FIELDS,
      [ 'title_template' => '[[name]]', 'icon' => 'clipboard',
        'prefix' => 'bp', 'add' => 'administrator',
        'position' => 'settings' ] );

    // a shortcode so you can embed the boilerplate wherever
    // you need to in any WYSIWYG fields.
    //
    // Short code is [ boilerplate {boilerplate-name} ]

    add_shortcode( 'boilerplate', function( $atts ) {
      return $this->get_text( implode( ' ', $atts ));
    } );

    // Define a template scalar method so that you can use
    //
    //  [[boilerplate:-:{boilerplate-name}]]
    //
    // in templates
    $this->self->add_scalar_method( 'boilerplate', function( $s, $e ) {
      return $this->get_text( $s );
    });

  }

  function get_text( $code ) {
    $t = $this->self->get_entries( 'boilerplate_text',
      [ 'meta_key' => 'name', 'meta_value' => $code ]
    );
    return sizeof($t)
         ? $t[0]['content']
         : "*** Undefined boilerplate '$code' ***";
  }
}


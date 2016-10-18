<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

/**
 * getEnumValues method
 *
 * @throws NotFoundException
 * @param string $text
 * @return array
 */

public function getEnumValues($columnName=null)
  {
      if ($columnName==null) { return array(); } //no field specified


      //Get the name of the table
      $db =& ConnectionManager::getDataSource($this->useDbConfig);
      $tableName = $db->fullTableName($this, false);


      //Get the values for the specified column
      $result = $this->query("SHOW COLUMNS FROM {$tableName} LIKE '{$columnName}'");

      //figure out where in the result our Types are
      //(this varies between mysql versions)
      $types = null;
      if ( isset( $result[0]['COLUMNS']['Type'] ) )
      {
        $types = $result[0]['COLUMNS']['Type'];
      } //MySQL 5
      elseif ( isset( $result[0][0]['Type'] ) )       
      {
        $types = $result[0][0]['Type'];       
      } //MySQL 4
      else {
        return array();
      } //types return not accounted for

      //Get the values
      $values = explode("','", preg_replace("/(enum)\('(.+?)'\)/","\\2", $types) );

      //explode doesn't do assoc arrays, but cake needs an assoc to assign values
      $assoc_values = array();
      foreach ( $values as $value ) {
          //leave the call to humanize if you want it to look pretty
          $assoc_values[$value] = Inflector::humanize($value);
      }

      return $assoc_values;

  } //end getEnumValues


}

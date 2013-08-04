<?php

namespace Rdy4Racing\Services\Objects;

abstract class ObjectMapper {
	
	/**
	 * Returns a Propel BaseObject with the data of the Object
	 * 
	 * Properties marked as @readonly WILL NOT BE MAPPED
	 * 
	 * @return \BaseObject
	 */
	public function export () {
		$baseModelClass='\\Rdy4Racing\\Models\\'.substr(get_class($this),strrpos(get_class($this),'\\')+1);
		if (!empty($this->id)) {
			$queryModelClass=$baseModelClass.'Query';
			$model=$queryModelClass::create()->findPK($this->id);
		} else {
			$model=new $baseModelClass;
		}
		
		//reflect properties to set data
		$reflect=new \ReflectionClass($this);
		$properties=$reflect->getProperties(\ReflectionProperty::IS_PUBLIC);
		foreach ($properties as $property) {
			$propertyName=$property->getName();
			$method='set'.ucfirst($propertyName);
			if (strpos($property->getDocComment(),'@readonly')===false) {
				$model->$method($this->$propertyName);
			}
		}
		
		return $model;
	}
	
	
	/**
	 * Returns a new ServiceObject with the data of the propel Object
	 * 
	 * @param \BaseObject $object
	 * @return ObjectMapper
	 */
	public function import (\BaseObject $object) {
		//reflect properties to set data
		$reflect=new \ReflectionClass($this);
		$properties=$reflect->getProperties(\ReflectionProperty::IS_PUBLIC);
		foreach ($properties as $property) {
			$propertyName=$property->getName();
			$method='get'.ucfirst($propertyName);
			$this->$propertyName=$object->$method();
		}
		
		return $this;
	}
	
}


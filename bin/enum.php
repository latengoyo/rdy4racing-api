<?php

ini_set('display_errors',1);

require_once '../modules/Configuration.php';

use Rdy4Racing\Modules\Configuration;

$config = new Configuration();
$enumConfig = parse_ini_file('enum.ini');

$fileHeader = <<< END
<?php

/**
 * #CLASSDESC#
 *
 * Enum class automatically created by /bin/enum.php
 */

namespace #NAMESPACE#;

class #CLASSNAME# {

END;

$fileFooter = "}\n\n";

// read sections
$sections = explode(',',$enumConfig['sections']);
foreach ($sections as $section) {
	
	echo "Found section ".$section;
	
	// read section values
	$namespace = $enumConfig['section.' . $section . '.namespace'];
	$className = $enumConfig['section.' . $section . '.class'];
	$classDesc = $enumConfig['section.' . $section . '.description'];
	$fileName = $enumConfig['section.' . $section . '.class'] . '.php';
	$tableName = $enumConfig['section.' . $section . '.table'];
	$location = $config->get('app.path') . '/' . $enumConfig['section.' . $section . '.location'];
	$queryClass = '\\Rdy4Racing\\Models\\' . $tableName . 'Query';
	$constantField = $enumConfig['section.' . $section . '.table.constant'];
	$descriptionField = $enumConfig['section.' . $section . '.table.description'];
	$valueField = $enumConfig['section.' . $section . '.table.value'];
	
	$fileContents = $fileHeader;
	$fileContents = str_replace('#CLASSDESC#',$classDesc,$fileContents);
	$fileContents = str_replace('#NAMESPACE#',$namespace,$fileContents);
	$fileContents = str_replace('#CLASSNAME#',$className,$fileContents);
	
	$constants = $queryClass::create()->orderBy($valueField,'asc')->find();
	
	foreach ($constants as $constant) {
		$funcConstantField = 'get' . $constantField;
		$funcDescriptionField = 'get' . $descriptionField;
		$funcValueField = 'get' . $valueField;
		
		$fileContents .= "    const ";
		$fileContents .= $constant->$funcConstantField();
		$fileContents .= " = ";
		$value = $constant->$funcValueField();
		if ($enumConfig['section.' . $section . '.table.type'] == 'string') {
			$value = "'" . $value . "'";
		}
		$fileContents .= $value;
		$fileContents .= "; // " . $constant->$funcDescriptionField() . "\n";
	}
	
	$fileContents .= $fileFooter;
	
	if (! file_exists($location)) {
		mkdir($location,0755,true);
	}
	$filePath=$location . '/' . $fileName;
	file_put_contents($filePath,$fileContents);
	
	echo " -> ".$filePath."\n";
}

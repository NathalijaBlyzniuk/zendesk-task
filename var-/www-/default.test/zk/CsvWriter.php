<?php
class CsvWriter extends AbstractHandler
{
	
public function writeToCsv ($array) {  
if ($array['queue']) {
$this->getFunctionFor ('writeToCsvFile', ['data_array' => $array['queue'], 'schema_captures' => $array['captures']]);  	
} 	
}	

public function writeToCsvFile ($variables) {	
$addDelimiterTo = function($value) {
    return $value.';';
};
$filename = 'csv/file1'.$variables['iterator'].'.csv';	
$fp = fopen($filename, 'w', ';');
foreach ($variables['schema_captures'] as $captures) {
$captures = $captures.';';	
}
fputcsv($fp, $variables['schema_captures'], ';');
foreach ($variables['data_array'] as $fields) {
$fields = array_map($addDelimiterTo, $fields);	
  fputcsv($fp, $fields, ';');
}
fclose($fp);	  
}

}  
  
  
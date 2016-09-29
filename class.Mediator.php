<?php
/**
 * The Mediator class is used to act as a tool to generate reports from our daily Google Forms report 
 * 
 * @version 1.0.0
 * @author Nikhil Chaughule<nikhilchaughule@gmail.com>
 */ 
class Mediator{
	public $title = 'Mediator';
	public $version='1.5.0';
	public $desc = 'Mediator - I do what you do, -_- only faster -_-';
	/**
	 * Method to parse the copied row content from Google sheet.
	 * 
	 * @param $content string Entire string from Google Sheets that needs to be parsed
	 * @param $columncount int Number of columns to be used in the excel sheet
	 */
	public function parseContent($content=null,$columncount=8){
		if(!$content)
			return;
		/**
		 * The empty space is not empty space below but a special character used after copy is made from drive
		 */
		$moddedcontent = str_getcsv($content,'	');
		$counter = 0;$temp = array();
		foreach ($moddedcontent as $ky=>$eachentry){
			if(!trim($eachentry)){
				$counter=0;
				continue;
			}
			if($counter===0){
				$subtemp = array();
				for($i=0;$i<$columncount;$i++){
					$subtemp[] = trim($moddedcontent[((int)$ky+$i)]);
				}
				$temp[] = $subtemp;
			}
			$counter++;
			
		}
		return $temp;
	}
}

?>
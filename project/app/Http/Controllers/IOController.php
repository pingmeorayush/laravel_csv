<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;	
use DateTime;	

use App\CSV_READ_FILE;

class IOController extends Controller
{
    //
    public function index(){

    	$path = public_path("unread");

    	$files = File::allFiles($path);
    	
    	$rows = [];

    	foreach($files as $f){
    		$rows = array_merge($rows,self::fetchCSVDATA($f));
    		
    		$filename = $f->getFilename();

    		CSV_READ_FILE::insert(['file_name'=>$filename]);

    		File::move($path."/".$filename, public_path("read")."/".$filename);
    	}
    	
    	if(empty($rows)){
    		dd("No File. Please try again.");
    	}

    	$calculated_data = [];

    	foreach ($rows as $row) {
    		if(empty($calculated_data[$row['Month/Year']])){
    			$calculated_data[$row['Month/Year']] = 
    				[
						'Buy'=>[
							'Qty'=>0,
							'Rate'=>0,
							'Total'=>0
						],
    					'Sell'=>[
    						'Qty'=>0,
    						'Rate'=>0,
    						'Total'=>0
    					],
    					'Remain_Stock'=>0,
    					'P_L'=>0
    				];
    		}

    		$data  = $calculated_data[$row['Month/Year']];
    		$rate = $row['Rate'];
    		$type = 'Buy';

    		if($row['Type'] == 2){
    			$type = 'Sell';
    		}

			$data[$type]['Rate'] = $rate;
			$data[$type]['Qty'] = $data[$type]['Qty']+$row['Qty'];
			$data[$type]['Total'] = $data[$type]['Total']+($row['Qty']*$rate);

			if($type == 'Buy'){
				$data['Remain_Stock'] = $data['Remain_Stock'] + $row['Qty'];

			}else{
				$data['Remain_Stock'] = $data['Remain_Stock'] - $row['Qty'];
				$estimated_profit = $data['Buy']['Rate']*$row['Qty'];
				$actual_profit = $row['Rate']*$row['Qty'];
				$p_l = $actual_profit - $estimated_profit;
				$data['P_L'] = $data['P_L'] + $p_l;
			}	
    		$calculated_data[$row['Month/Year']] = $data;

    	}

    	return view("sheet",compact('calculated_data'));
    	
    }
    
    /**
     * Validate Datetime from CSV.
     *
     * @return Boolean
     */
    public static function validateDate($datestr){
    	
    	$date = DateTime::createFromFormat("M-y", $datestr);
    	
    	return $date;
    } 

    /**
     * Fetch Data from CSV file and return as Array.
     *
     * @return Array
     */
	public static function fetchCSVDATA($filename = '', $delimiter = ',')
	{
	    if (!file_exists($filename) || !is_readable($filename))
	        return false;

	    $header = null;

	    $data = array();
	    
	    if (($handle = fopen($filename, 'r')) !== false)
	    {
	        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
	        {
	            if (!$header){
	                $header = $row;
	            }
	            else{
		        	if(!self::validateDate($row[0])){
		        		dump("There is an issue with the date format. Date: ".$row[0]);
		        		continue;
		        	}
		            $data[] = array_combine($header, $row);
	            }

	        }
	        fclose($handle);
	    }

	    return $data;
	}
}

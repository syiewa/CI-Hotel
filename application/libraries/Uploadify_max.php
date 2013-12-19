<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2010, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Uploadify Max
 *
 * This uploader uses uploadify, a rather awesome uploading script with a progress bar and lots of awesome features. http://www.uploadify.com/
 * It combos up with fancybox, which is a nice modal display window, amongst many. http://fancybox.net/
 * It also uses jCrop, which is a jQuery plugin that makes cropping images nice and easy. http://deepliquid.com/content/Jcrop.html
 * I've bashed all these together so that you can easily create upload forms that can create images and thumbnails to spec in your codeigniter projects.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Uploading
 * @author		Michael Watson www.reallywebdesign.com
 * @link		http://www.reallywebdesign.com
 */
class Uploadify_max  {
	
	//General settings
	
	var $ids					= ''; 						// It's the ID for the file inputs to be turned into uploadify max fields. 
															// It can be passed as a string, of a single ID.
															// It can also be passed as an array of multiple IDs.
															// It can ALSO be passed as an array of arrays, if you want different dimension settings 
															// for each ID. For example: 	 array(
															//										array(	'id'				=>	'myField',
															//												'cropMaxWidth'		=>	400,
															//												'cropMaxHeight'		=>	300,
															//												'imageWidth'		=>  700,
															//												'imageHeight'		=>	400,
															//												'thumbWidth'		=>	100,
															//												'thumbHeight'		=>	100,
															//												'fixedScale'		=>  TRUE,
															//												'thumbMaintainScale'=>  TRUE
															//											),
															// 										array(	'id'				=>	'anotherField',
															//												'imageWidth'		=>  800,
															//												'imageHeight'		=>	533
															//											)
															//									)
															// Here, the id "myField" has all the available settings for the uploadify max dimensions. 
															// The ID "anotherField" only has a couple of dimensions passed. The dimensions not mentioned
															// Will be the default dimensions, as outlined below.
															
															
	var $documentReady			= TRUE; 					// Should this be wrapped in a jQuery document ready function?
	var $additionalSizes		= array(); 					// An array of additional sizes to be created on complete of the crop. Might be useful!
															// You can pass an array like this: array(	'suffix'=>'your_suffix', 
															//											'width' => int,
															//											'height' => int)
															// Or if you have multiple additional sizes you can pass through an array of arrays ,
															// in the same format as the above example.
	var $thumbMaintainScale		= FALSE;					// If it's false, it will resize and crop to the exact thumbnail dimensions specified. If it's true it will
															// use the thumbnail dimensions as max sizes, and keep the dimensions of the original cropped image
	var $thumbnailSuffix		= 'thumb';					// Suffix for the thumbnail. You might want to change this. Maybe you don't like the word "thumb".
	

	//Uploadify settings
	
	var $uploader				= ''; 							// link to uploadify.swf file
	var $script					= ''; 							// link to uploadify.php file
	var $cancelImg				= ''; 							//link to cancel image
	var $folder					= ''; 							//link to upload folder
	var $scriptAccess 			= 'sameDomain'; 				//script access permissions. sameDomain / always
	var $sizeLimit				= ''; 							//size limit for files in bytes.
	var $auto					= true; 						//automatic uploading once the file has been picked.
	var $fileExt				= '*.png;*.gif;*.jpg;*.jpeg'; 	//files that are allowed (only greys out the files in the upload window)
	var $fileDesc				= '*.png;*.gif;*.jpg;*.jpeg'; 	//files that appear in the dropdown for the upload window
	
	
	//Fancybox settings. They are just as they are at: http://fancybox.net/api with a few different defaults and some restrictions. So head there to work out what they mean.
	
	var $fbPadding				= 10;					
	var $fbMargin				= 20;						
	var $fbModal				= true;
	var $fbCenterOnScroll		= false;
	var $fbTitle				= '';
	var $fbBottomHeight			= 60;
	var $fbHideOnOverlayClick	= false;
	var $fbHideOnContentClick	= false;
	var $fbOverlayShow			= true;
	var $fbOverlayOpacity		= 0.3;
	var $fbOverlayColor			= '#666';
	var $fbTitleShow			= true;
	var $fbTitlePosition		= 'outside';
	var $fbTransitionIn			= 'none';
	var $fbTransitionOut		= 'none';
	var $fbSpeedIn				= '300';
	var $fbSpeedOut				= '300';
	var $fbShowCloseButton		= false;
	var $fbEnableEscapeButton	= false;
	
	
	//Functions needed for Ajax. These need to be set up in your controller too.
	var $returnFunction			= ''; 				// return function for json data from uploadify.
	var $saveFunction 			= ''; 				// function for the main crop n save.
	var $cancelFunction			= '';				// function for when the fancybox window is closed, without cropping.
	
	
	//dimension settings
	var $cropMaxWidth			= '800';
	var $cropMaxHeight			= '600';
	var $imageWidth				= '800';
	var $imageHeight			= '600';
	var $thumbWidth				= '150';
	var $thumbHeight			= '100';
	var $fixedScale				= TRUE;
	

	private $_currentID						= ''; //Which ID is currently being operated on (in case multiple uploadifys are being used).
	private $_currentCropMaxWidth			= '';
	private $_currentCropMaxHeight			= '';
	private $_currentImageWidth				= '';
	private $_currentImageHeight			= '';
	private $_currentThumbWidth				= '';
	private $_currentThumbHeight			= '';
	private $_currentFixedScale				= TRUE;
	private $_currentThumbMaintainScale		= FALSE;
	private $_filenames		= array();
	
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 */
	public function __construct($params = array())
	{
		
		if (count($params) > 0)
		{
			$this->initialize($params);
		}

		log_message('debug', "Ajax Image Upload Class Initialized");
	}
	
	// --------------------------------------------------------------------

	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
		
	}
	
	
	/**
	* get_head command. Get the javascript to put in the <head>.
	*
	* @access	public
	* @return	string
	*/
	function get_head() 
	{
		
		$result = '';
		
		//If this is to be wrapped in a jQuery doc ready function, we'll run the wrap_doc_ready function.
		if($this->documentReady) $result = $this->_wrap_doc_ready();
		
		//If not, let's just _get_javascripscript
		else $result = $this->_get_javascript();
		
		return $result;
		
	}
	
	/**
	 * 
	 * wrap the whole jQuery result in a document ready function.
	 * @access	private
	 * @return	string
	 */	
	function _wrap_doc_ready() {
		
			$result = 	"jQuery(document).ready(function() {\n";
			$result .= $this->_get_javascript();
			$result .= '});';
			
			return $result;
			
	}
	
	/**
	 * 
	 * get all the javascript for the uploadify function in the head.
	 * @access	private
	 * @return	string
	 */	
	function _get_javascript() {
		
		
		//First up, we'll make an array of all the #ids that have been sent.
		$result = "idArray = new Array(";
		
		//If an array of IDs has been passed, let's list them up.
		if(is_array($this->ids)) {
			
			foreach($this->ids as $num => $i)
			{
				
				//Let's see if an array of arrays has been passed, for more advanced setups.
				if(is_array($i))
				{
					$result .= "'" . $i['id'] . "'";
					
				}
				
				//Just a normal array of ids has been passed. Let's list them for the js.
				else
				{
					$result .= "'" . $i . "'";
				
				}
			
				//put a comma in, unless it's the final list in the array.
				if(($num+1) != sizeof($this->ids)) $result .= ", ";
			}
			
		}
		
		//ID was just passed as a string.
		else
		{
			$result .= "'" . $this->ids . "'";
		}
		
		$result .= ");\n";
		
		//And now we'll loop through everything.
		$result .= "jQuery.each(idArray, function() {\n";
		
		//let's make a new div that can hold the returned thumbnail, or any error messages.
		$result .= "jQuery('#' + this).after('<div class=\"uploadifyThumb\" id=\"' + this + 'Thumbnail\"></div>');\n";
		
		//And let's also make a hidden field that will hold the uploaded file once we've finished.
		$result .= "jQuery('#' + this).after('<input id=\"' + this + '_filename\" type=\"hidden\" name=\"' + this + '_filename\" value=\"\" />');\n";
		
		//We'll use this if the fancybox cropping has been cancelled.
		$result .= "var cancelled = false;\n";
		
		//initiate uploadify
		$result .= "jQuery('#' + this).uploadify({\n";
		
		//whip through uploadify's settings
		$result .= "uploader: '" . base_url() . $this->uploader . "',\n";
		$result .= "script: '" . base_url() . $this->script . "',\n";
		$result .= "cancelImg: '" . base_url() . $this->cancelImg . "',\n";
		$result .= "folder: '" . parse_url(base_url() . $this->_check_slash($this->folder), PHP_URL_PATH) . "',\n";
		$result .= "scriptAccess: '" . $this->scriptAccess . "',\n";
		if($this->sizeLimit) $result .= "sizeLimit: '" . $this->sizeLimit .  "',\n";
		if($this->auto) $result .= "auto: true,\n";
		$result .= "fileExt: '" . $this->fileExt . "',\n";
		$result .= "fileDesc: '" . $this->fileDesc . "',\n";
		
		//What happens when the upload is  complete?
		$result .= "'onComplete'   : function (event, ID, fileObj, response, data) {\n";
		
		//We've got to get the css ID again now we're in the onComplete function. It's an uploadify ting
		$result .="var id = event.currentTarget.id;";
		
		//Send to the return function, the array "response" from uploadify.php.
		$result .= "jQuery.post('" . site_url($this->returnFunction) . "',{filearray: response, currentID: id},function(info){\n";
		
		$result .= "var json = jQuery.parseJSON(info);\n"; //Parse the json array, ready to work with.
		
		//The image is the too small. Let the user know
		$result .= "if (json.message == 'tooSmall' ) {\n";
		$result .= "jQuery('#' + id + 'Thumbnail').html(json.htmlReturn);\n";
		$result .= "}\n";
		
		//The image is the exact size needed, so we'll send data to the saveFunction.
		$result .= "if (json.message == 'exactSize' ) {\n";
		
		//Send the info straight to the saveFunction
		$result .= "jQuery.ajax({\n";
        $result .= "type: 'POST',\n";
        $result .= "url: '" . site_url($this->saveFunction) . "',\n"; 
        $result .= "data: 'currentID=' + id + '&filename=" . $this->_check_slash($this->folder) . "' + json.filename,\n";
		
		//On success of this info being posted, lets close the fancybox
		$result .= "success: function(data){\n";
		
		//Let's now decode the jSon from the saveFunction.
		$result .= "var jsonarr = jQuery.parseJSON(data);\n";
		
		//And then put the thumbnail by the original upload button.
		$result .= "jQuery('#' + id + 'Thumbnail').html(jsonarr.htmlReturn);\n";
        $result .= "} });\n";
		
		$result .= "}\n";
		
		//The image is too big, so let's display the jCrop board.
		$result .= "if (json.message == 'tooBig' ) {\n";
		$result .= "cancelled = true;";
		
		// First up, make a fancybox pop up window.
		$result .= "jQuery.fancybox('<div class=\"jcropBox\"></div>',{\n";
		$result .= "'autoDimensions' : false,\n";
		$result .= "'width' : json.width,\n";
		$result .= "'height' : json.height + " . $this->fbBottomHeight . ",\n";
		$result .= "'padding' : " . $this->fbPadding . ",\n";
		$result .= "'margin' : " . $this->fbMargin . ",\n";
		if($this->fbModal) $result .= "'modal' : true,\n";
		if($this->fbCenterOnScroll) $result .= "'centerOnScroll' : true,\n";
		if($this->fbHideOnOverlayClick) $result .= "'hideOnOverlayClick' : true,\n";
		if($this->fbHideOnContentClick) $result .= "'hideOnContentClick' : true,\n";
		if($this->fbOverlayShow) $result .= "'overlayShow' : true,\n";
		$result .= "'overlayOpacity' : " . $this->fbOverlayOpacity . ",\n";
		$result .= "'overlayColor' : '" . $this->fbOverlayColor . "',\n";
		if($this->fbTitleShow) $result .= "'titleShow' : true,\n";
		$result .= "'title' : '" . $this->fbTitle . "',\n";
		$result .= "'titlePosition' : '" . $this->fbTitlePosition . "',\n";
		$result .= "'transitionIn' : 'none',\n";
		$result .= "'transitionOut': 'none',\n";
		$result .= "'speedIn' : " . $this->fbSpeedIn . ",\n";
		$result .= "'speedOut' : " . $this->fbSpeedOut . ",\n";
		if($this->fbShowCloseButton) $result .= "'showCloseButton' : true,\n";
		if($this->fbEnableEscapeButton) $result .= "'enableEscapeButton' : true,\n";
		$result .= "'autoScale' : false,\n";
		$result .= "'scrolling'	: 'no',\n";
		
		//When the jCrop window is shut, let's delete both the cropboard file and the original file.
		$result .= "'onClosed' : function(){ \n";
		$result .= "if(cancelled == true) {";
		
		//Send the info to the cancelFunction
		$result .= "jQuery.ajax({\n";
        $result .= "type: 'POST',\n";
        $result .= "url: '" . site_url($this->cancelFunction) . "',\n"; 
        $result .= "data: 'filename=' + json.filename + '&cropfilename=' + json.cropfilename\n";
   		$result .= "});\n";
		$result .= "}";  
		
		$result .= "}";
		$result .= "});\n";
		
		//Now we add the form needed for jcrop.
		$result .= "jQuery('.jcropBox').append('<img id=\"' + id + 'Crop\" src=\"' + '" . base_url() . "' + json.cropfilename + '\"/>";
		$result .= "<input type=\"hidden\" id=\"cropfilename\" name=\"cropfilename\" value=\"' + json.cropfilename + '\" />";
		$result .= "<input type=\"hidden\" id=\"filename\" name=\"filename\" value=\"' + json.filename + '\" />";
		$result .= "<input type=\"hidden\" id=\"ratio\" name=\"ratio\" value=\"' + json.ratio + '\" />";
		$result .= "<input type=\"hidden\" id=\"x\" name=\"x\" value=\"\" />";
		$result .= "<input type=\"hidden\" id=\"y\" name=\"y\" value=\"\" />";
		$result .= "<input type=\"hidden\" id=\"width\" name=\"width\" value=\"\" />";
		$result .= "<input type=\"hidden\" id=\"height\" name=\"height\" value=\"\" />";
		$result .= "<input type=\"submit\" id=\"crop\" value=\"crop\" />";
		$result .= "<input type=\"submit\" id=\"cancel\" value=\"cancel\" />";
		$result .= "</form>');";
		
		$result .= "jQuery('#cancel').click(function () {\n";
        $result .= "jQuery.fancybox.close();\n";
		$result .= "return false;\n";
		$result .= "});\n";
		
		//stop our newly created form from sending in the normal way. Instead, let's do it with ajax, sending the data to our saveFunction.
		$result .= "jQuery('#crop').click(function () {\n";
		
		//put all the form values into vars.
		$result .= "var x = jQuery('#x').attr('value');\n";
		$result .= "var y = jQuery('#y').attr('value');\n";
		$result .= "var width = jQuery('#width').attr('value');\n";
		$result .= "var height = jQuery('#height').attr('value');\n";
		$result .= "var ratio = jQuery('#ratio').attr('value');\n";
		$result .= "var filename = jQuery('#filename').attr('value');\n";
		$result .= "var cropfilename = jQuery('#cropfilename').attr('value');\n";
		
		//Send the info to the saveFunction
		$result .= "jQuery.ajax({\n";
        $result .= "type: 'POST',\n";
        $result .= "url: '" . site_url($this->saveFunction) . "',\n"; 
        $result .= "data: 'currentID=' + id + '&x='+x+'&y='+y+'&width='+width+'&height='+height+'&ratio='+ratio+'&filename='+filename+'&cropfilename='+cropfilename,\n";
		
		//On success of this info being posted, lets close the fancybox
		$result .= "success: function(data){\n";
		
		//Flag that this fancybox close isn't a cancellation.
		$result .= "cancelled = false;";
        $result .= "jQuery.fancybox.close();\n";
		
		//Let's now decode the jSon from the saveFunction.
		$result .= "var jsonarr = jQuery.parseJSON(data);\n";
		
		//And then put the htmlReturn by the original upload button. Errors or the thumb.
		$result .= "jQuery('#' + id + 'Thumbnail').html(jsonarr.htmlReturn);\n";
		
		//We need to make some hidden input fields containing all the extra files created.
		$result .= "var filenameArr = jsonarr.extraFiles;";
		$result .= "jQuery.each(filenameArr,function(key,value) {\n";
		
		//If a hidden field for this already exists, we'll just change the val (the upload has already been run)
		$result .="if (jQuery('#' + id + '_' + key).length) {\n";
		
		$result .= "jQuery('#' + id + '_' + key).val(value);\n";
		$result .= "} else {\n";
		//
		$result .= "jQuery('#' + id + '_filename').after('<input id=\"' + id + '_' + key + '\" type=\"hidden\" name=\"' + id + '_' + key + '\" value=\"' + value + '\" />');\n";
		
		$result.= " }\n";
		
		$result .= "});";
		
		
		//Put the filename into the value of the upload form input.
		$result .= "jQuery('#' + id + '_filename').val(json.filename);\n";
   		$result .= "}  });\n";  
		
		$result .= "return false; });\n";
		
		//Create a function doCoords that sets the hidden fields in our form to the coord values in the jCrop.
		$result .= "function doCoords(c) {\n";
		$result .= "jQuery('#x').val(c.x);\n";
		$result .= "jQuery('#y').val(c.y);\n";
		$result .= "jQuery('#width').val(c.w);\n";
		$result .= "jQuery('#height').val(c.h);\n";
		$result .= "};";
		
		//Now we action the jCrop, using the width & height settings entered by the user.
		$result .= "if (json.fixedScale) {var theAspectRatio = json.imageWidth / json.imageHeight }else {var theAspectRatio = 0}; \n";
		$result .= "jQuery(function() {\n";
		$result .= "jQuery('#' + id + 'Crop').Jcrop({\n";
		$result .= "setSelect:   [ 0, 0, (json.imageWidth * json.ratio),(json.imageHeight * json.ratio) ],\n"; //set the default position as from 0x and 0y
		$result .= "aspectRatio: theAspectRatio,\n"; //make sure the aspect ratio is fixed to that of the final image.
		$result .= "minSize: [(json.imageWidth * json.ratio),(json.imageHeight * json.ratio) ],\n"; //don't crop too small!
		$result .= "allowSelect: false,\n";
		$result .= "onSelect: doCoords,\n";
		$result .= "onChange: doCoords});\n";
    	$result .= "});\n";
		
		
		//We've got a heap of brackets to close off. The if statement first.
		$result .= "}";
		
		//Now the return function from the get_image_return
		$result .= "});";
		
		//Now the onComplete function from the uploadify.
		$result .= "}";

		//Now the main uploadify function
		$result .= "});";
		
		//And finally!!! The main jQuery loop for all the IDs
		$result .= "});";
		
		return $result;
		
	}
	
	/**
	 * Function for the return of an uploaded image from uploadify. Echos out a json encoded array. 
	 *
	 * @access	public
	 * @param	array (filearray is the jsonified array coming from uploadify. theID is a string of the current ID in play.
	 * @return	NULL
	 */
	function get_image_return($returnArr) {
		
		//Let's make sure we're getting the right postdata.
		if(!isset($returnArr['filearray']) && !isset($returnArr['currentID'])) 
		{
			// And make sure we're getting a json array as a param.
			if(!json_decode($returnArr['filearray']) )
			{
				
				$json_arr = array('message' => 'error', 'htmlReturn' => 'Post data sent is invalid. Please try again.');
				echo json_encode($json_arr);
				return false;
				
			}
		}
		//put the jsonified data from uploadify.php into a php variable
		$file_arr = json_decode($returnArr['filearray']);
		$this->_currentID = $returnArr['currentID'];
		
		//Let's work out what dimensions we are working to.
		$this->_retrieve_dimensions();
		
		
		//get the file name from said array
		$filename = $file_arr->{'file_name'};
		
		//get a filepath variable, ready for use in some functions.
		$filepath = $this->_check_slash($this->folder) . $filename;
		
		//check the uploaded file's width & height. 0 = too small. 1 = exact size. 2 = too big.
		if($this->_upload_check_size( base_url() . $this->_remove_spaces($filepath)) == 2) {
			
			//if it's too big, reduce it, ready for cropping.
			$cropboard_arr = $this->_create_crop_board($this->_remove_spaces($filepath));
			
			echo json_encode($cropboard_arr);
		
		}
		
		if($this->_upload_check_size( base_url() . $this->_remove_spaces($filepath)) == 1) {
			
			//Exact size.
			
			$json_arr = array('message' => 'exactSize','filename' => $filename);
			echo json_encode($json_arr);
		
		}
		
		if($this->_upload_check_size( base_url() . $this->_remove_spaces($filepath)) == 0) {
		
			//delete the file uploaded, as it was too small. Return a jsonified array, with details as to what went wrong.
			$this->_delete_image($this->_check_slash($this->folder) . $filename);
			
			$json_arr = array('message' => 'tooSmall', 'htmlReturn' => 'Image too small. Must be at least '.  $this->_currentImageWidth .' x '.  $this->_currentImageHeight .' pixels');
			echo json_encode($json_arr);
			
			
		}
		
		
	}
	
	/**
	 * Compare the uploaded image file size with the required file size.
	 *
	 * @access	private
	 * @param	string , file path of the uploaded file
	 * @return	int
	 */
	function _upload_check_size($filepath) {
		
		$imagesize = (getimagesize($filepath));
			
		if($imagesize[0] < $this->_currentImageWidth || $imagesize[1] < $this->_currentImageHeight) return 0;
		if($imagesize[0] == $this->_currentImageWidth && $imagesize[1] == $this->_currentImageHeight) return 1;
			
		return 2;
		
	}
	
	
	/**
	* See if a trailing slash has been put in the folder name. If it hasn't put on in.
	*
	* @access	private
	* @param	string , folder for uploads
	* @return	string
	*/
	function _check_slash($string) 
	{
	
		if(substr($string,-1) != '/') $string = $string . '/';
		
		return $string;
	
		
	}
	
	/**
	* Get rid of any space characters in uploaded files. getimagesize doesn't like spaces you see.
	*
	* @access	private
	* @param	string , filename of uploaded file
	* @return	string
	*/
	function _remove_spaces($filename)
	{
	
		$url = str_replace(' ', '%20', $filename);
		
		return $url;
		
	}
	
	/**
	* Delete a file.
	*
	* @access	private
	* @param	string , filename of uploaded file
	* @return	NULL
	*/
	function _delete_image($filename) {
		
		if(is_file($filename)) unlink($filename);
			
	}
	
	/**
	* Create the smaller version of the original image, ready for cropping.
	*
	* @access	private
	* @param	string , filename of uploaded file
	* @return	array
	*/
	function _create_crop_board($filename)
	{
		
		//compare the uploaded filesize to the cropping thumbnail
		$imagesize = (getimagesize(base_url() . $filename));
		$ratio = $this->_currentCropMaxWidth / $imagesize[0];
		
		//If the scaled down height is still over the max crop height pixels, we'll scale down further.
		if($imagesize[1]*$ratio > $this->_currentCropMaxHeight) $ratio = $this->_currentCropMaxHeight/$imagesize[1];
		
		$cropfilename = $this->_insert_suffix($filename, '_crop_thumb');
		
		
		//get the image library on board, and config it up
		$CI =& get_instance();

		$CI->load->library('image_lib');
		$CI->image_lib->clear();
		
		$config['image_library'] = 'GD2';
		$config['library_path'] = null;
		$config['source_image'] = $filename;
		
		//using our ratio to scale down evenly.
		$config['height'] = floor($imagesize[1] * $ratio);
		$config['width']	= floor($imagesize[0] * $ratio);
		
		
		$config['new_image'] = $cropfilename;
		$config['maintain_ratio'] = true;
		$CI->image_lib->initialize($config);
				
		
		//create the jCrop board and return the details in a jsonified array.
		if ( ! $CI->image_lib->resize() )
		{
			//This was an error in the cropping. We'll flag an error, and return the image_lib error report.
			$json_arr = array('message' => 'error', 'htmlReturn' => $CI->image_lib->display_errors());
			return $json_arr;
			
		}
		
		else 
		{
			//This hasn't errored. The crop has been achieved. We can return the bits and bobs we need to echo the jCrop board.
			$json_arr = array(
								'message' => 'tooBig', 
								'filename' => $filename, 
								'cropfilename' => $cropfilename, 
								'width' => $config['width'], 
								'height' => $config['height'], 
								'ratio' => $ratio,
								'fixedScale' => $this->_currentFixedScale,
								'imageWidth' => $this->_currentImageWidth,
								'imageHeight' => $this->_currentImageHeight);
			
			return $json_arr;
			
		}	
		
	}
	
	/**
	* Add a suffix into file names, for the thumb and the cropboard.
	*
	* @access	private
	* @param	string , filename of uploaded file
	* @return	array
	*/
	function _insert_suffix($filename, $suffix) {
		
		//split the file name ready to put in _crop_thumb
		$explode_filename = explode('.',$filename);
		if(sizeof($explode_filename > 2))
		{
			//get the file extention from the image
			$fileExt = array_pop($explode_filename);
			
			//Everything but the file extention goes back to $filename
			$filename = implode('.',$explode_filename) . $suffix . '.' . $fileExt;
			
		}
		
		//On the off chance there isn't a file extension, let's just add the suffix anyway.
		else { 
		
			$filename = implode('.',$explode_filename) . $suffix;
		
		}
	
	return $filename;
	
	}
	
	/**
	* Process the image. If it's needed cropping, we'll action the crop. If it doesn't, we'll just create the thumb.
	*
	* @access	public
	* @param	string , filename of uploaded file
	* @return	array
	*/
	function process_image($postData)
	{
		//Get the current ID
		$this->_currentID = $postData['currentID'];
		
		//Let's work out what dimensions we are working to.
		$this->_retrieve_dimensions();
		
		//get the image library on board, and config it up
		$CI =& get_instance();

		$CI->load->library('image_lib');
			
		//If it's being returned from the jCrop board, we'll do that cropping neccessary.
		if(isset($postData['cropfilename']) )
		{
			//settings for image cropping.
			$config['image_library'] = 'GD2';
			$config['source_image'] = $postData['filename'];
			$config['x_axis'] = floor($postData['x'] / $postData['ratio']);
			$config['y_axis'] = floor($postData['y'] / $postData['ratio']);
			$config['width'] =  ceil($postData['width'] / $postData['ratio']);
			$config['height'] = ceil($postData['height'] / $postData['ratio']);
			$config['maintain_ratio'] = false;
			
			$CI->image_lib->clear();
	
			$CI->image_lib->initialize($config); 
			
			//let's delete the cropboard file now.
			$this->_delete_image($postData['cropfilename']);
			
			//If the crop didn't work for any reason, return an error flag, and the errors.
			if ( ! $CI->image_lib->crop())
			{
				//This was an error in the cropping. We'll flag an error, and return the image_lib error report.
				$json_arr = array('message' => 'error', 'htmlReturn' => $CI->image_lib->display_errors());
				echo json_encode($json_arr);
			}
			
			//Now it's cropped, we need to scale it to the selected width and height.
			$CI->image_lib->clear();
			
			//if fixed scale is on, we do it simply like this:
			if($this->_currentFixedScale)
			{
				$config['width'] = $this->_currentImageWidth;
				$config['height'] = $this->_currentImageHeight;
			}
			//if fixed scale is false, we need to scale it to the max width & height settings.
			else 
			{
				
				$tempWidth = ceil($postData['width'] / $postData['ratio']);
				$tempHeight = ceil($postData['height'] / $postData['ratio']);
				$ratio =  $this->_currentImageWidth / $this->_currentImageHeight;
				$newRatio = $tempWidth / $tempHeight;
				
				//If the cropped image is longer than the set dimensions, we'll scale to make the height the max height possible
				if($newRatio < $ratio)
				{
				
					$config['height'] = $this->_currentImageHeight;
					
					//Change the currentImageWidth var to the newly discovered width.
					$this->_currentImageWidth = $tempWidth / ($tempHeight / $this->_currentImageHeight);
					$config['width'] = $this->_currentImageWidth;
					
				}
				
				//If the cropped image is WIDER than the set dimensions, we'll scale to make the width the max width possible
				if($newRatio > $ratio)
				{
				
					$config['width'] = $this->_currentImageWidth;
					
					//Change the currentImageHeight var to the newly discovered height.
					$this->_currentImageHeight = $tempHeight / ($tempWidth / $this->_currentImageWidth);
					$config['height'] = $this->_currentImageHeight;
					
				}
				
				//If the cropped image is the same, proportionally, to the set dimensions, we can run a simple one:
				if($newRatio == $ratio)
				{
					$config['width'] = $this->_currentImageWidth;
					$config['height'] = $this->_currentImageHeight;
				}
				
			}
			
			
			$config['image_library'] = 'GD2';
			$config['source_image'] = $postData['filename'];
			$CI->image_lib->initialize($config); 
			
			//If the resize didn't work for any reason, return an error flag, and the errors.
			if ( ! $CI->image_lib->resize())
			{
				//This was an error in the resize. We'll flag an error, and echo the image_lib error report.
				$json_arr = array('message' => 'error', 'htmlReturn' => $CI->image_lib->display_errors());
				echo json_encode($json_arr);
			}
		}
		
		$CI->image_lib->clear();
		
		//if additional sizes have been picked, lets generate them
		if($this->additionalSizes)
		{
			
			//if there are multiple additional sizes, let's iterate through them all.
			if(isset($this->additionalSizes[0])) 
			{
				
				foreach($this->additionalSizes as $sizeArray)
				{
					
					if(isset($sizeArray['suffix']) && isset($sizeArray['width']) && isset($sizeArray['height']))
					{
						
						$thumbfilename = $this->_create_thumb($postData['filename'],$sizeArray['suffix'],$sizeArray['width'],$sizeArray['height']);
						
						if(!$thumbfilename)
						log_message('error', 'Error creating the additional size for "' . $sizeArray['suffix'] . '"');
						//Image resize was successful. Let's add it to the array of filenames.
						else $this->_filenames[$sizeArray['suffix']] = $thumbfilename;
					}
				
				}
				
			}
			
			//The additional size array is only one level deep. Let's do it.
			if(isset($this->additionalSizes['suffix']) && isset($this->additionalSizes['width']) && isset($this->additionalSizes['height']))
			{
				
				$thumbfilename = $this->_create_thumb($postData['filename'],$this->additionalSizes['suffix'],$this->additionalSizes['width'],$this->additionalSizes['height']);
				if(!$thumbfilename)
				log_message('error', 'Error creating the additional size for "' . $this->additionalSizes['suffix'] . '"');
				//Image resize was successful. Let's add it to the array of filenames.
				else $this->_filenames[$this->additionalSizes['suffix']] = $thumbfilename;
			}
		
		}
		
		
		// Now lets make the mandatory thumbnail.
		$thumbfilename = $this->_create_thumb($postData['filename'],$this->thumbnailSuffix,$this->_currentThumbWidth,$this->_currentThumbHeight);
		
		if ($thumbfilename)
		{
			$this->_filenames[$this->thumbnailSuffix] = $thumbfilename;
			
			// create an array to echo the thumb file, and send back all the generated filenames to put in hidden fields.
			$returnArray['htmlReturn'] = '<img src="' . base_url() . $thumbfilename . '" />';
			$returnArray['filename'] = $postData['filename'];
			$returnArray['extraFiles'] = $this->_filenames;
			echo json_encode($returnArray);
			
		}
		
		else  
		{
		
		//This was an error in the thumbnail creation. We'll flag an error, and return the image_lib error report.
		$json_arr = array('message' => 'error', 'htmlReturn' => 'Error creating thumbnails.');
		echo json_encode($json_arr);
		}
		
	
		
	}
	
	/**
	* Create a thumb. So, I'm not using image_lib's native crop thumb, it's a bit rubbish.
	*
	* @access	public
	* @param	string , filename of thumb created.
	* @return	array
	*/
	function _create_thumb($filename , $suffix, $width, $height)
	{
		$equalAspect = FALSE;
		$thumbRatio = $width / $height;
		$imageRatio = $this->_currentImageWidth / $this->_currentImageHeight;
			
		//create the filename for the thumb
		$thumbfilename = $this->_insert_suffix($filename, '_' . $suffix);
		
		
		//get the image library on board, and config it up
		$CI =& get_instance();

		$CI->load->library('image_lib');
		$CI->image_lib->clear();
		
		$config['image_library'] = 'GD2';
		$config['source_image'] = $filename;
		
		//if maintain scale is false, we'll first scale down to as close to the dimensions as possible.
		if (!$this->thumbMaintainScale) 
		{
			//First, compare the two image ratios. If the height is proportionally larger on the thumbnail, we can scale the width to the thumbnail width, then crop the height.
			if ($thumbRatio > $imageRatio)
			{
				$config['width'] = $width;
				$config['height'] = $this->_currentImageHeight * $thumbRatio;
				
				//echo('sadfgsdfg' . $imageRatio . 'sdfgsdfg' . $thumbRatio);
				
			}
			
			//If the width is proportionally larger on the thumbnail, we can scale the height to the thumbnail height, then crop the remaining width off.
			if ($thumbRatio < $imageRatio)
			{
				$config['height'] = $height;
				$config['width'] = $this->_currentImageWidth * $thumbRatio;
				
			}
			//And finally, if the aspect ratios are the same, we'll perform the scale, and flag that we don't need to crop anything later...
			if($thumbRatio == $imageRatio)
			{
			
				$config['width'] = $width;
				$config['height'] = $height;
				$equalAspect = TRUE;	
					
			}
			
			$config['new_image'] = $thumbfilename;
			$config['maintain_ratio'] = true;
			$CI->image_lib->initialize($config);
				
		
			//resize that thumbnail
			if ( ! $CI->image_lib->resize() )
			{
				//There was an error in the resize. Return false and put it in the log.
				log_message('error', $CI->image_lib->display_errors());
				return false;
			
			}
			
			//If it doesn't have an equal aspect ratio, let's crop that bad boy.
			if ( $equalAspect == FALSE )
			{
				
				$CI->image_lib->clear();
				$config['image_library'] = 'GD2';
				$config['source_image'] = $thumbfilename;
				$config['maintain_ratio'] = false;
				$config['x_axis'] = 0;
				$config['y_axis'] = 0;
				$config['width'] = $width;
				$config['height'] = $height;
				$CI->image_lib->initialize($config);
						
				
				//create the jCrop board and return the details in a jsonified array.
				if ( ! $CI->image_lib->crop() )
				{
					//There was an error in the cropping. Return false and put it in the log.
					log_message('error', $CI->image_lib->display_errors());
					return false;
					
				}
				
			}
			
		} else
		
		//maintain scale is TRUE.
		{
			
			//First, compare the two image ratios. If the height is proportionally larger on the thumbnail, we can scale to the height, making the width smaller than the max width.
			if ($thumbRatio > $imageRatio)
			{
				$config['height'] = $height;
				
			}
			
			//If the width is proportionally larger on the thumbnail, we can scale the width to the thumbnail width.
			if ($thumbRatio < $imageRatio)
			{
				$config['width'] = $width;
				
			}
			//And finally, if the aspect ratios are the same, we'll perform a perfect scale. Nothing to worry about.
			if($thumbRatio == $imageRatio)
			{
			
				$config['width'] = $width;
				$config['height'] = $height;
					
			}
			
			$config['new_image'] = $thumbfilename;
			$config['maintain_ratio'] = true;
			$CI->image_lib->initialize($config);
				
		
			//resize that thumbnail
			if ( ! $CI->image_lib->resize() )
			{
				//There was an error in the resize. Return false and put it in the log.
				log_message('error', $CI->image_lib->display_errors());
				return false;
			
			}	
			
		}
		
		return $thumbfilename;
		
	}
	
	/**
	* Sets the current dimensions var with the dimensions sent. This has to be done when the library is initialized, in case there are different values for multiple upload forms.
	*
	* @access	private
	* @param	none.
	* @return	bool
	*/
	function _retrieve_dimensions()
	{
		//Let's see if this is an array of arrays. If it is it will have seperate dimensions that need processing.
		if(is_array($this->ids[0]))
		{
			
			//Let's search for dimensions specific to the id we're working with.
			foreach($this->ids as $ids)
			{
				
			
				//If we find a match between the current ID and the arrays of IDs, let's take the dimensions and make them the current dimensions. 
				//If they're there! If not, we'll be using the default values.
				
				if($ids['id'] == $this->_currentID)	
				{
				
					$this->_currentCropMaxWidth = (isset($ids['cropMaxWidth']) ? $ids['cropMaxWidth'] : $this->cropMaxWidth);
					$this->_currentCropMaxHeight = (isset($ids['cropMaxHeight']) ? $ids['cropMaxHeight'] : $this->cropMaxHeight);
					$this->_currentImageWidth = (isset($ids['imageWidth']) ? $ids['imageWidth'] : $this->imageWidth);
					$this->_currentImageHeight = (isset($ids['imageHeight']) ? $ids['imageHeight'] : $this->imageHeight);
					$this->_currentThumbWidth = (isset($ids['thumbWidth']) ? $ids['thumbWidth'] : $this->thumbWidth);
					$this->_currentThumbHeight = (isset($ids['thumbHeight']) ? $ids['thumbHeight'] : $this->thumbHeight);
					$this->_currentFixedScale = (isset($ids['fixedScale']) ? $ids['fixedScale'] : $this->fixedScale);
					$this->_currentThumbMaintainScale = (isset($ids['thumbMaintainScale']) ? $ids['thumbMaintainScale'] : $this->thumbMaintainScale);
					
				}
				
		
			//end foreach		
			}
				
			return true;
		
		//it wasn't an array of arrays. Let's set default values for everything.
		}
			
		$this->_currentCropMaxWidth = $this->cropMaxWidth;
		$this->_currentCropMaxHeight = $this->cropMaxHeight;
		$this->_currentImageWidth = $this->imageWidth;
		$this->_currentImageHeight = $this->imageHeight;
		$this->_currentThumbWidth = $this->thumbWidth;
		$this->_currentThumbHeight = $this->thumbHeight;
		$this->_currentFixedScale = $this->fixedScale;
		$this->_currentThumbMaintainScale = $this->thumbMaintainScale;
		
		return true;
		
	}
	
	/**
	* Cancel the cropping. Is called when the fancybox is closed or cancelled. It deletes both the file and the cropboard file.
	*
	* @access	private
	* @param	array of post data.
	* @return	null
	*/
	function cancel_crop($postData)
	{
		if(isset($postData['filename'])) $this->_delete_image($postData['filename']);
		if(isset($postData['cropfilename'])) $this->_delete_image($postData['cropfilename']);
		
	}

}
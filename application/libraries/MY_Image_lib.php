<?php
/**
*
* Fix for thumbnail and adding the th_
*
* @author shankaranand RFQMS Dev Team
* @package RFQMS
* @subpackage Libraries
* @category Libraries
*/
class MY_Image_lib extends CI_Image_lib
{
	/**
	 * Constructor method
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
	  parent::__construct();
	}
	
	var $image_library		= 'gd2';  	// Can be:  imagemagick, netpbm, gd, gd2
	var $library_path		= '';
	var $dynamic_output		= FALSE;	// Whether to send to browser or write to disk
	var $source_image		= '';
	var $new_image		= '';
	var $width		= '';
	var $height		= '';
	var $quality		= '90';
	var $create_thumb		= FALSE;
	var $thumb_marker		= 'th_';
	var $maintain_ratio		= TRUE;  	// Whether to maintain aspect ratio when resizing or use hard values
	var $master_dim		= 'auto';	// auto, height, or width.  Determines what to use as the master dimension
	var $rotation_angle		= '';
	var $x_axis		= '';
	var	$y_axis		= '';

	// Watermark Vars
	var $wm_text		= '';			// Watermark text if graphic is not used
	var $wm_type		= 'text';		// Type of watermarking.  Options:  text/overlay
	var $wm_x_transp		= 4;
	var $wm_y_transp		= 4;
	var $wm_overlay_path	= '';			// Watermark image path
	var $wm_font_path		= '';			// TT font
	var $wm_font_size		= 17;			// Font size (different versions of GD will either use points or pixels)
	var $wm_vrt_alignment	= 'B';			// Vertical alignment:   T M B
	var $wm_hor_alignment	= 'C';			// Horizontal alignment: L R C
	var $wm_padding		= 0;			// Padding around text
	var $wm_hor_offset		= 0;			// Lets you push text to the right
	var $wm_vrt_offset		= 0;			 // Lets you push  text down
	var $wm_font_color		= '#ffffff';	// Text color
	var $wm_shadow_color	= '';			// Dropshadow color
	var $wm_shadow_distance	= 2;			// Dropshadow distance
	var $wm_opacity		= 50; 			// Image opacity: 1 - 100  Only works with image

	// Private Vars
	var $source_folder		= '';
	var $dest_folder		= '';
	var $mime_type		= '';
	var $orig_width		= '';
	var $orig_height		= '';
	var $image_type		= '';
	var $size_str		= '';
	var $full_src_path		= '';
	var $full_dst_path		= '';
	var $create_fnc		= 'imagecreatetruecolor';
	var $copy_fnc		= 'imagecopyresampled';
	var $error_msg		= array();
	var $wm_use_drop_shadow	= TRUE;
	var $wm_use_truetype	= TRUE;

	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	function CI_Image_lib($props = array())
	{
		if (count($props) > 0)
		{
			$this->initialize($props);
		}

		log_message('debug', "Image Lib Class Initialized");
	}

	

	// --------------------------------------------------------------------

	/**
	 * initialize image preferences
	 *
	 * @access	public
	 * @param	array
	 * @return	bool
	 */
	function initialize($props = array())
	{
		/*
		 * Convert array elements into class variables
		 */
		if (count($props) > 0)
		{
			foreach ($props as $key => $val)
			{
				$this->$key = $val;
			}
		}

		/*
		 * Is there a source image?
		 *
		 * If not, there's no reason to continue
		 *
		 */
		if ($this->source_image == '')
		{
			$this->set_error('imglib_source_image_required');
			return FALSE;	   
		}

		/*
		 * Is getimagesize() Available?
		 *
		 * We use it to determine the image properties (width/height).
		 * Note:  We need to figure out how to determine image
		 * properties using ImageMagick and NetPBM
		 *
		 */
		if ( ! function_exists('getimagesize'))
		{
			$this->set_error('imglib_gd_required_for_props');
			return FALSE;
		}

		$this->image_library = strtolower($this->image_library);

		/*
		 * Set the full server path
		 *
		 * The source image may or may not contain a path.
		 * Either way, we'll try use realpath to generate the
		 * full server path in order to more reliably read it.
		 *
		 */
		if (function_exists('realpath') AND @realpath($this->source_image) !== FALSE)
		{
			$full_source_path = str_replace("\\", "/", realpath($this->source_image));
		}
		else
		{
			$full_source_path = $this->source_image;
		}

		$x = explode('/', $full_source_path);
		$this->source_image = end($x);
		$this->source_folder = str_replace($this->source_image, '', $full_source_path);

		// Set the Image Properties
		if ( ! $this->get_image_properties($this->source_folder.$this->source_image))
		{
			return FALSE;	   
		}

		/*
		 * Assign the "new" image name/path
		 *
		 * If the user has set a "new_image" name it means
		 * we are making a copy of the source image. If not
		 * it means we are altering the original.  We'll
		 * set the destination filename and path accordingly.
		 *
		 */
		if ($this->new_image == '')
		{
			$this->dest_image = $this->source_image;
			$this->dest_folder = $this->source_folder;
		}
		else
		{
			if (strpos($this->new_image, '/') === FALSE)
			{
				$this->dest_folder = $this->source_folder;
				$this->dest_image = $this->new_image;
			}
			else
			{
				if (function_exists('realpath') AND @realpath($this->new_image) !== FALSE)
				{
					$full_dest_path = str_replace("\\", "/", realpath($this->new_image));
				}
				else
				{
					$full_dest_path = $this->new_image;
				}

				// Is there a file name?
				if ( ! preg_match("#\.(jpg|jpeg|gif|png)$#i", $full_dest_path))
				{
					$this->dest_folder = $full_dest_path.'/';
					$this->dest_image = $this->source_image;
				}
				else
				{
					$x = explode('/', $full_dest_path);
					$this->dest_image = end($x);
					$this->dest_folder = str_replace($this->dest_image, '', $full_dest_path);
				}
			}
		}

		/*
		 * Compile the finalized filenames/paths
		 *
		 * We'll create two master strings containing the
		 * full server path to the source image and the
		 * full server path to the destination image.
		 * We'll also split the destination image name
		 * so we can insert the thumbnail marker if needed.
		 *
		 */
		if ($this->create_thumb === FALSE OR $this->thumb_marker == '')
		{
			$this->thumb_marker = '';
		}

		$xp	= $this->explode_name($this->dest_image);

		$filename = $xp['name'];
		$file_ext = $xp['ext'];

		$this->full_src_path = $this->source_folder.$this->source_image;
		$this->full_dst_path = $this->dest_folder.$this->thumb_marker.$filename.$file_ext;

		/*
		 * Should we maintain image proportions?
		 *
		 * When creating thumbs or copies, the target width/height
		 * might not be in correct proportion with the source
		 * image's width/height.  We'll recalculate it here.
		 *
		 */
		if ($this->maintain_ratio === TRUE && ($this->width != '' AND $this->height != ''))
		{
			$this->image_reproportion();
		}

		/*
		 * Was a width and height specified?
		 *
		 * If the destination width/height was
		 * not submitted we will use the values
		 * from the actual file
		 *
		 */
		if ($this->width == '')
			$this->width = $this->orig_width;

		if ($this->height == '')
			$this->height = $this->orig_height;

		// Set the quality
		$this->quality = trim(str_replace("%", "", $this->quality));

		if ($this->quality == '' OR $this->quality == 0 OR ! is_numeric($this->quality))
			$this->quality = 90;

		// Set the x/y coordinates
		$this->x_axis = ($this->x_axis == '' OR ! is_numeric($this->x_axis)) ? 0 : $this->x_axis;
		$this->y_axis = ($this->y_axis == '' OR ! is_numeric($this->y_axis)) ? 0 : $this->y_axis;

		// Watermark-related Stuff...
		if ($this->wm_font_color != '')
		{
			if (strlen($this->wm_font_color) == 6)
			{
				$this->wm_font_color = '#'.$this->wm_font_color;
			}
		}

		if ($this->wm_shadow_color != '')
		{
			if (strlen($this->wm_shadow_color) == 6)
			{
				$this->wm_shadow_color = '#'.$this->wm_shadow_color;
			}
		}

		if ($this->wm_overlay_path != '')
		{
			$this->wm_overlay_path = str_replace("\\", "/", realpath($this->wm_overlay_path));
		}

		if ($this->wm_shadow_color != '')
		{
			$this->wm_use_drop_shadow = TRUE;
		}

		if ($this->wm_font_path != '')
		{
			$this->wm_use_truetype = TRUE;
		}

		return TRUE;
	}

	function image_process_gd($action = 'resize')
	{
	//echo $this->source_image;
	//die();
		
		
		$v2_override = FALSE;

		// If the target width/height match the source, AND if the new file name is not equal to the old file name
		// we'll simply make a copy of the original with the new name... assuming dynamic rendering is off.
		if ($this->dynamic_output === FALSE)
		{
			if ($this->orig_width == $this->width AND $this->orig_height == $this->height)
			{
 				if ($this->source_image != $this->new_image)
 				{
					if (@copy($this->full_src_path, $this->full_dst_path))
					{
						@chmod($this->full_dst_path, DIR_WRITE_MODE);
					}
				}

				return TRUE;
			}
		}

		// Let's set up our values based on the action
		if ($action == 'crop')
		{
			//  Reassign the source width/height if cropping
			$this->orig_width  = $this->width;
			$this->orig_height = $this->height;

			// GD 2.0 has a cropping bug so we'll test for it
			if ($this->gd_version() !== FALSE)
			{
				$gd_version = str_replace('0', '', $this->gd_version());
				$v2_override = ($gd_version == 2) ? TRUE : FALSE;
			}
		}
		else
		{
			// If resizing the x/y axis must be zero
			$this->x_axis = 0;
			$this->y_axis = 0;
		}

		//  Create the image handle
		if ( ! ($src_img = $this->image_create_gd()))
		{
			return FALSE;
		}

 		//  Create The Image
		//
		//  old conditional which users report cause problems with shared GD libs who report themselves as "2.0 or greater"
		//  it appears that this is no longer the issue that it was in 2004, so we've removed it, retaining it in the comment
		//  below should that ever prove inaccurate.
		//
		//  if ($this->image_library == 'gd2' AND function_exists('imagecreatetruecolor') AND $v2_override == FALSE)
 		if ($this->image_library == 'gd2' AND function_exists('imagecreatetruecolor'))
		{
			$create	= 'imagecreatetruecolor';
			$copy	= 'imagecopyresampled';
		}
		else
		{
			$create	= 'imagecreate';
			$copy	= 'imagecopyresized';
		}

		$dst_img = $create($this->width, $this->height);
			/*=========changed==============*/	
		
		//  Fetch  image properties
		$proprts 		= $this->get_image_properties($this->full_src_path, TRUE);
		$cr_img_type	= $proprts['image_type'];
		//$cr_width		= $proprts['width'];
		//$cr_height		= $proprts['height'];
					
					
		if ($cr_img_type == 3)// for png
		{
						
		    imagealphablending( $dst_img, false );
            imagesavealpha( $dst_img, true );
			$transparent_index = imagecolorallocatealpha($dst_img,0,255,0,127);
			imagefilledrectangle($dst_img, 0, 0, $this->width, $this->height, $transparent_index);
			$copy($dst_img, $src_img, 0, 0, $this->x_axis, $this->y_axis, $this->width, $this->height, $this->orig_width, $this->orig_height);
		   
		

		} 
		
		else if($cr_img_type == 1)// for gif
		
		{
			 $transparent_index = imagecolortransparent($src_img);
				  if ($transparent_index >= 0) {
					  imagepalettecopy($src_img, $dst_img);
					//  imagefill($dst_img, 0, 0, $transparent_index);
					  imagefilledrectangle($dst_img, 0, 0, $this->width, $this->height, $transparent_index);
					  imagecolortransparent($dst_img, $transparent_index);
					  imagetruecolortopalette($dst_img, true, 256);
				  } 
					
			$copy($dst_img, $src_img, 0, 0, $this->x_axis, $this->y_axis, $this->width, $this->height, $this->orig_width, $this->orig_height);
		}
		else{
			
		$copy($dst_img, $src_img, 0, 0, $this->x_axis, $this->y_axis, $this->width, $this->height, $this->orig_width, $this->orig_height);	
		
		}
			
					
	        /*=========changed==============*/
		//$copy($dst_img, $src_img, 0, 0, $this->x_axis, $this->y_axis, $this->width, $this->height, $this->orig_width, $this->orig_height);	

		//  Show the image
		if ($this->dynamic_output == TRUE)
		{
			$this->image_display_gd($dst_img);
		}
		else
		{
			// Or save it
			if ( ! $this->image_save_gd($dst_img))
			{
				return FALSE;
			}
		}

		//  Kill the file handles
		imagedestroy($dst_img);
		imagedestroy($src_img);

		// Set the file to 777
		@chmod($this->full_dst_path, DIR_WRITE_MODE);

		return TRUE;
	}
}

?>
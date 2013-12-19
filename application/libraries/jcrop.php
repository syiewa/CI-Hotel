<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Jcrop {
	private $CI;
	private $prefix;
	private $folder;
	private $target_w;
	private $target_h;
	private $form = '';
	private $create_thumb = FALSE;
	private $thumb_folder;
	
	
	public function __construct(){
		$this->CI = & get_instance();
		//$this->CI->load->library('session');
		$this->CI->load->helper('file');
	}
	
	public function set_data($set){
		if (is_array($set)){
			if(array_key_exists('prefix',$set)){$this->prefix = $set['prefix'];};
			if(array_key_exists('folder',$set)){$this->folder = $set['folder'];};
			if(array_key_exists('target_w',$set)){$this->target_w = $set['target_w'];};
			if(array_key_exists('target_h',$set)){$this->target_h = $set['target_h'];};
			if(array_key_exists('create_thumb',$set)){$this->create_thumb=$set['create_thumb'];};
			if(array_key_exists('thumb_folder',$set)){$this->thumb_folder=$set['thumb_folder'];};
		}else{
			echo "Set of data not valid";
		}
	}
	
	public function uploading(& $status = ''){
		$config['upload_path'] = $this->folder;
		$config['allowed_types'] = 'gif|jpeg|jpg|png';
		$config['max_size'] = '2048';
		$config['overwrite'] = TRUE;
		$config['remove_spaces'] = TRUE;
		
		$this->CI->load->library('upload',$config);
		
		if(!$this->CI->upload->do_upload($this->prefix.'picture')) {
			$status = $this->CI->upload->display_errors('<p>','</p><br />');
		} else {
			$upload_status = array($this->prefix.'uploaded'=>TRUE);
			foreach($this->CI->upload->data() as $key => $value ) {
				$imgdata[$this->prefix.$key] = $value;
			}
			$imgdata = array_merge($imgdata,$upload_status);
			//print_r($imgdata);
            
			$this->CI->session->set_userdata($imgdata);
		}
	}
	
	public function is_uploaded(& $thepicture,& $orig_w,& $orig_h,& $ratio){
		if($this->CI->session->userdata($this->prefix.'uploaded') == false){
			return false;
		}else{
			$orig_w = 677;
			$orig_h = ($this->CI->session->userdata($this->prefix.'image_height')/$this->CI->session->userdata($this->prefix.'image_width'))* $orig_w;
			$ratio	= $this->target_w/$this->target_h;
			
			$imgconf['image_library']	= 'gd2';
			$imgconf['source_image']	= $this->folder.$this->CI->session->userdata($this->prefix.'orig_name');
			$imgconf['maintain_ratio']	= TRUE;
			if($this->CI->session->userdata($this->prefix.'image_width') >= $orig_w) {
				$imgconf['width'] = $orig_w;
				$imgconf['height'] = $orig_h;
			} elseif ($this->CI->session->userdata($this->prefix.'image_width') < $orig_w) {
				$orig_w = $this->CI->session->userdata($this->prefix.'image_width');
				$orig_h = $this->CI->session->userdata($this->prefix.'image_height');
			}
			
            $new_session = array($this->prefix.'new_w'=>$orig_w,$this->prefix.'new_h'=>$orig_h);
            $this->CI->session->set_userdata($new_session);
            
			$this->CI->load->library('image_lib',$imgconf);
			$this->CI->image_lib->resize();
			
			$thepicture = base_url().$this->folder.$this->CI->session->userdata($this->prefix.'orig_name');
			return $thepicture;
			return $orig_w;
			return $orig_h;
			return $ratio;
			return true;
		}
	}
	
	public function cancel() {
		if(file_exists($this->CI->session->userdata($this->prefix.'full_path'))){
			unlink($this->CI->session->userdata($this->prefix.'full_path'));
		}
		
		$this->end_session();
	}
	
	public function add_form($forms) {
		if (is_array($forms)){
			$input = $this->form;
			foreach($forms as $key=>$val) {
				switch ($key) {
					case 'form_input':
					$input .= '<p><input type="text" ';	
					foreach ($val as $k=>$v){
						$input .= $k.'="'.$v.'" ';
					}
					$input .= ' /></p>';
					break;
					
					case 'form_textarea':
					$input .= '<p><textarea ';	
					foreach ($val as $k=>$v){
						if($k<>'value'){
							$input .= $k.'="'.$v.'" ';
						}
					}
					$input .= ' >'.$val['value'].'</textarea></p>';
					break;
					
					case 'form_dropdown':
					$input .= '<p><select ';
					$input .= 'name="'.$val[0].'" >';
					$input .= '<option selected>'.$val[2].'</option>';
					foreach( $val[1] as $k=>$v ){
						$input .= '<option value="'.$k.'">'.$v.'</option>';
					}
					$input .= '</select></p>';
					break;
				}
			}
		} else {
			$input = '';
		}
		$this->form = $input;
	}
	
	public function show_form($action,$option = FALSE) {
		
		if ($option == TRUE) {
			$enctype = '';
			$input = '
				<input type="hidden" id="x" name="'.$this->prefix.'x" />
				<input type="hidden" id="y" name="'.$this->prefix.'y" />
				<input type="hidden" id="w" name="'.$this->prefix.'w" />
				<input type="hidden" id="h" name="'.$this->prefix.'h" />	
			';
			$input .= $this->form;
			$input .= '<button type="submit" id="'.$this->prefix.'save" name="'.$this->prefix.'save" class="btn btn-primary btn-sm" >Save Croped Image!</button>';
			$input.= '<button type="submit" id="'.$this->prefix.'cancel" name="'.$this->prefix.'cancel" class="btn btn-default btn-sm" >Cancel</button>';
		} else {
			$enctype = ' enctype="multipart/form-data" ';
			$input = '<input type="file" name="'.$this->prefix.'picture" size="40"/><br /><br />';
			$input.= '<input type="submit" name="'.$this->prefix.'submit" value="Submit" class="btn btn-primary btn-sm">';
		}
		$form  = '<form method="POST" action="'.$action.'" class="jNice form-horizontal" '.$enctype.'><fieldset>';
		$form .= $input;
		$form .= '</fieldset></form>';
		return $form;
	}
	
	public function produce(& $pic_loc='',& $pic_path='',& $thumb_loc='',& $thumb_path='') {
        //print_r($this->CI->session);
       
		$x = $this->CI->input->post($this->prefix.'x') ;
		$y = $this->CI->input->post($this->prefix.'y');
		$width = $this->CI->input->post($this->prefix.'w');
		$height = $this->CI->input->post($this->prefix.'h');
		
		$pic_loc = base_url().$this->folder.$this->prefix.$this->CI->session->userdata($this->prefix.'orig_name');
		$pic_path = $this->folder.$this->prefix.$this->CI->session->userdata($this->prefix.'orig_name');
		$src = imagecreatefromjpeg($this->folder.$this->CI->session->userdata($this->prefix.'orig_name'));
		$tmp = imagecreatetruecolor($this->target_w, $this->target_h);
		imagecopyresampled($tmp, $src, 0,0,$x,$y,$this->target_w,$this->target_h,$width,$height);
		if($this->create_thumb == TRUE){
			imagejpeg($tmp,$this->thumb_folder.'thumb_'.$this->prefix.$this->CI->session->userdata($this->prefix.'orig_name'),100);
			$thumb_loc = base_url().$this->thumb_folder.'thumb_'.$this->prefix.$this->CI->session->userdata($this->prefix.'orig_name');
			$thumb_path = $this->thumb_folder.'thumb_'.$this->prefix.$this->CI->session->userdata($this->prefix.'orig_name');
		}else{
			imagejpeg($tmp,$this->folder.$this->prefix.$this->CI->session->userdata($this->prefix.'orig_name'),100);    
		}
        
        $tmp2 = imagecreatetruecolor($this->CI->session->userdata($this->prefix.'new_w'), $this->CI->session->userdata($this->prefix.'new_h'));
        imagecopyresampled($tmp2, $src, 0,0,0,0,$this->CI->session->userdata($this->prefix.'new_w'), $this->CI->session->userdata($this->prefix.'new_h'),$this->CI->session->userdata($this->prefix.'new_w'), $this->CI->session->userdata($this->prefix.'new_h'));
        imagejpeg($tmp2,$this->folder.$this->prefix.$this->CI->session->userdata($this->prefix.'orig_name'),100);
        
		imagedestroy($tmp);
        imagedestroy($tmp2);
		imagedestroy($src);
		
        if(file_exists($this->CI->session->userdata($this->prefix.'full_path'))){
			unlink($this->CI->session->userdata($this->prefix.'full_path'));
		}
		$this->end_session();
	}
	
	private function end_session() {
		$this->CI->session->unset_userdata(array(
			$this->prefix.'uploaded'=>'',$this->prefix.'file_name'=>'',$this->prefix.'file_type'=>'',
			$this->prefix.'file_path'=>'',$this->prefix.'full_path'=>'',$this->prefix.'raw_name'=>'',
			$this->prefix.'orig_name'=>'',$this->prefix.'file_ext'=>'',$this->prefix.'file_size'=>'',
			$this->prefix.'is_image'=>'',$this->prefix.'image_width'=>'',$this->prefix.'image_height'=>'',
			$this->prefix.'image_type'=>'',$this->prefix.'image_size_str'=>'',$this->prefix.'new_w'=>'',$this->prefix.'new_h'=>'')
		);
	}
	
}
?>
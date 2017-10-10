<?php
class PvngenField {
	function __construct($params = array()){
		
		$this->ci =& get_instance();
		$this->ci->load->config('pvngen');
		$this->field_wraps = isset($params['field_wraps'])?$params['field_wraps']:array();
	}
	
	public function set($field, $value){
		$this->$field = $value;
	}
	public function get($field){
		return isset($this->$field)?$this->$field:false;
	}
	
	function render($k, $f, $v = '', $a = ''){ 
		$field_html = '';
		switch($f['type']){
			case 'text':
			case 'password':
			case 'email':
			case 'number':
			case 'tel':
			case 'hidden':
			case 'url':
				$field_html = $this->textbox($k, $f, $v, $a);
				break;
			case 'textarea':
			case 'ckeditor':
				$field_html = $this->textarea($k, $f, $v, $a);
				break;
			case 'select':
			case 'select2':
				$field_html = $this->select($k, $f, $v, $a);
				break;
			case 'file':
				$field_html = $this->file($k, $f, $v, $a);
				break;
		}

		echo $field_html ;

	}

	function textbox($k, $f, $v = '', $a = ''){ 
		$required = (isset($f['required']) && $f['required'])?'required':'';
		$id = (isset($f['attributes']) && isset($f['attributes']['id']))?$f['attributes']['id']:'pvngen_'.$k;
		$id .= '_'.$a;
		if(!isset($f['attributes']) && !isset($f['attributes']['placeholder'])){
			$f['attributes']['placeholder'] = $f['label'];
		}
		$attr_str = '';
		if(isset($f['attributes']) && is_array($f['attributes'])){
			array_walk($f['attributes'], function($item, $index) use (&$attr_str){
				$attr_str .= ' '.$index.'="'.$item.'" ';
			});
		}
		$value = ($v)?$v:(isset($f['default'])?$f['default']:'');
		$field_wrap = ($f['type'] == 'hidden')?$this->field_wraps['hidden']:$this->field_wraps['simple'];
		
		$html = str_replace(
							array('{type}','{name}','{id}','{val}','{label}','{attributes}','{required}'),
							array($f['type'],$k,$id,$value,$f['label'],$attr_str,$required),
							$field_wrap
					);

		return $html;

	}
	function textarea($k, $f, $v = '', $a = ''){

		$required = (isset($f['required']) && $f['required'])?'required':'';

		$id = (isset($f['attributes']) && isset($f['attributes']['id']))?$f['attributes']['id']:'pvngen_'.$k;

		$id .= '_'.$a;

		$placeholder = (isset($f['attributes']) && isset($f['attributes']['placeholder']))?$f['attributes']['placeholder']:$f['label'];

		unset($f['attributes']['placeholder']);

		$attr_str = '';

		if(isset($f['attributes']) && is_array($f['attributes'])){

			array_walk($f['attributes'], function($item, $index) use (&$attr_str){

				$attr_str .= ' '.$index.'="'.$item.'" ';

			});

		}

		

		$value = ($v)?$v:(isset($f['default'])?$f['default']:'');

		$html = '<label for="'.$id.'" class="field prepend-icon">

						<textarea '.$required.' name="'.$k.'" id="'.$id.'" class="gui-textarea gen pvngen_'.$f["type"].'" value="'.$value.'"   placeholder="'.$placeholder.'" '.$attr_str.' >'.$value.'</textarea>';

		if($f['icon']){

			$html .= '<label for="'.$id.'" class="field-icon">

							<i class="fa '.$f['icon'].'"></i>

						</label>';

		}

		$html .= '</label>';

		return $html;

	}

	function select($k, $f, $v = '', $a = ''){ 

		$required = (isset($f['required']) && $f['required'])?'required':'';

		$id = (isset($f['attributes']) && isset($f['attributes']['id']))?$f['attributes']['id']:'pvngen_'.$k;

		$id .= '_'.$a;

		$placeholder = (isset($f['attributes']) && isset($f['attributes']['placeholder']))?$f['attributes']['placeholder']:$f['label'];

		unset($f['attributes']['placeholder']);

		$attr_str = '';

		if(isset($f['attributes']) && is_array($f['attributes'])){

			array_walk($f['attributes'], function($item, $index) use (&$attr_str){

				$attr_str .= ' '.$index.'="'.$item.'" ';

			});

		}

		$value = ($v)?$v:(isset($f['default'])?$f['default']:'');

		$html = '<label class="field select" for="'.$id.'">

					<select '.$required.' name="'.$k.'" id="'.$id.'" '.$attr_str.' >';

		$html .= 	'<option value="">Select '.$placeholder.'</option>';

		$html .= $this->get_source($k,$f, $v);

		$html .= '</select> <i class="arrow"></i>

				</label>';

		return $html;

	}

	
	

	function file($k, $f, $v = '', $a = ''){ 

		$required = (isset($f['required']) && $f['required'])?'required':'';

		$id = (isset($f['attributes']) && isset($f['attributes']['id']))?$f['attributes']['id']:'pvngen_'.$k;

		$id .= '_'.$a;

		$placeholder = (isset($f['attributes']) && isset($f['attributes']['placeholder']))?$f['attributes']['placeholder']:$f['label'];

		unset($f['attributes']['placeholder']);

		$attr_str = '';

		if(isset($f['attributes']) && is_array($f['attributes'])){

			array_walk($f['attributes'], function($item, $index) use (&$attr_str){

				$attr_str .= ' '.$index.'="'.$item.'" ';

			});

		}

		$nam = $k;

		if(isset($f['attributes']['multiple']) && $f['attributes']['multiple'] ){

			$nam .= '[]';

		}

		

		$value = ($v)?$v:(isset($f['default'])?$f['default']:'');

		$textbox = '<label for="'.$id.'" class="field prepend-icon file pvngen">';

        $textbox .= '<span class="button btn-primary">Choose File</span>';

        $textbox .= '<input '.$required.' name="'.$nam.'"  id="'.$id.'" class="gui-file" name="file1" id="file1" type="file" '.$attr_str.' >';

        $textbox .= '<input  class="gui-input uploader"  placeholder="'.$placeholder.'" type="text">';

        $textbox .= '<label class="field-icon">';

        $textbox .= '<i class="fa fa-cloud-upload"></i>';

        $textbox .= '</label>';

        $textbox .= '</label>';

		return $textbox;

	}


	
}
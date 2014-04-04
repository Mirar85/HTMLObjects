<?php
namespace de\chilan\HtmlObjects;

use \Exception as Exception;

class button extends attribute
{
	private $_accesskey = NULL;
	private $_datafld = NULL;
	private $_datasrc = NULL;
	private $_dataformatas = NULL;
	private $_disabled = false;
	private $_name = NULL;
	private $_onblur = NULL;
	private $_onfocus = NULL;
	private $_tabindex = NULL;
	private $_type = NULL;
	private $_value = NULL;

	public function __construct($z = NULL) { 
		$this->initDOM();
		if ($z != NULL) {
			$this->insert($z);
		}
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'accesskey': { $this->_accesskey = $this->cdata($x); }break;
			case 'datafld': { $this->_datafld = $this->cdata($x); }break;
			case 'datasrc': { $this->_datasrc = $this->cdata($x); }break;
			case 'dataformatas': { $this->_dataformatas = $this->is_dataformatas($x); }break;
			case 'disabled': { $this->_disabled = $this->is_boolvalue($x); }break;
			case 'name': { $this->_name = $this->cdata($x); }break;
			case 'onblur': { $this->_onblur = $this->cdata($x); }break;
			case 'onfocus': { $this->_onfocus = $this->cdata($x); }break;
			case 'tabindex': { $this->_tabindex = $this->zahlen($x); }break;
			case 'type': { $this->_type  = $this->is_type($x); }break;
			case 'value': { $this->_value = $this->cdata($x); }break;
			case 'text': {$this->insertnonconvert($x); }break;
			default:  parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'accesskey': { return $this->_accesskey; }break;
			case 'datafld': { return $this->_datafld; }break;
			case 'datasrc': { return $this->_datasrc; }break;
			case 'dataformatas': { return $this->_dataformatas; }break;
			case 'disabled': { return $this->_disabled; }break;
			case 'name': { return $this->_name; }break;
			case 'onblur': { return $this->_onblur; }break;
			case 'onfocus': { return $this->_onfocus; }break;
			case 'tabindex': { $this->_tabindex; }break;
			case 'type': { return $this->_type; }break;
			case 'value': { $this->_value; }break;
			default:  parent::__get($element);
		}
	}
	
	public function getAccesskey() { return $this->_accesskey; }
	public function getDatafld() { return $this->_datafld; }
	public function getDatasrc() { return $this->_datasrc; }
	public function getDataformatas() { return $this->_dataformatas; }
	public function getDisabled() { return $this->_disabled; }
	public function getName() { return $this->_name; }
	public function getOnblur() { return $this->_onblur; }
	public function getOnfocus() { return $this->_onfocus; }
	public function getTabindex() { return $this->_tabindex; }
	public function getType () { return $this->_type; }
	public function getValue() { return $this->_value; }
	
	protected function convertThis()
	{
		$this->_htmlCode = "<button";
		parent::convertThis();
		if ($this->_accesskey !== NULL) { $this->_htmlCode .= " accesskey=\"$this->_accesskey\""; }
		if ($this->_datafld !== NULL) { $this->_htmlCode .= " datafld=\"$this->_datafld\""; }
		if ($this->_datasrc !== NULL) { $this->_htmlCode .= " datasrc=\"$this->_datasrc\""; }
		if ($this->_dataformatas !== NULL) { $this->_htmlCode .= " dataformatas=\"$this->_dataformatas\""; }
		if ($this->_disabled === true) { $this->_htmlCode .= " disabled=\"disabled\""; }
		if ($this->_name !== NULL) { $this->_htmlCode .= " name=\"$this->_name\""; }
		if ($this->_onblur !== NULL) { $this->_htmlCode .= " onblur=\"$this->_onblur\""; }
		if ($this->_onfocus !== NULL) { $this->_htmlCode .= " onfocus=\"$this->_onfocus\""; }
		if ($this->_tabindex !== NULL) { $this->_htmlCode .= " tabindex=\"$this->_tabindex\""; }
		if ($this->_type !== NULL) { $this->_htmlCode .= " type=\"$this->_type\""; }
		if ($this->_value !== NULL) { $this->_htmlCode .= " value=\"$this->_value\""; }
		$this->_htmlCode .= ">\n";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</button>\n";
	}
}

class fieldset extends Attribute
{
	public function __construct($z = NULL) { 
		$this->initDOM();
		if ($z != NULL) {
			$this->insert($z);
		}
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			default:  parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			default:  parent::__get($element);
		}
	}
	
	protected function convertThis()
	{
		$this->_htmlCode = "<fieldset";
		parent::convertThis();
		$this->_htmlCode .= ">\n";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</fieldset>\n";
	}
}

class form extends attribute
{
	private $_action = "";
	private $_accept = NULL;
	private $_acceptcharset = NULL;
	private $_enctype = NULL; 
	private $_method = NULL;
	private $_name = NULL;
	private $_onreset = NULL;
	private $_onsubmit = NULL;
	private $_target = NULL;
	
	public function __construct($x,$z = NULL) { 
		$this->action = $this->cdata($x); 
		$this->initDOM();
		if ($z != NULL) {
			$this->insert($z);
		}
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'action': {$this->_action = $this->cdata($x); }break;
			case 'accept': {$this->_accept = $this->cdata($x); }break;
			case 'acceptcharset': {$this->_acceptcharset = $this->cdata($x); }break;
			case 'enctype': {$this->_enctype = $this->cdata($x); }break;
			case 'method': {$this->_method = $this->is_method($x); }break;
			case 'name': {$this->_name = $this->cdata($x); }break;
			case 'onreset': {$this->_onreset = $this->cdata($x); }break;
			case 'onsubmit': {$this->_onsubmit = $this->cdata($x); }break;
			case 'target': {$this->_target = $this->cdata($x); }break;
			default:  parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'action': {return $this->_action; }break;
			case 'accept': {return $this->_accept; }break;
			case 'acceptcharset': {return $this->_acceptcharset; }break;
			case 'enctype': {return $this->_enctype; }break;
			case 'method': {return $this->_method; }break;
			case 'name': {return $this->_name; }break;
			case 'onreset': {return $this->_onreset; }break;
			case 'onsubmit': {return $this->_onsubmit; }break;
			case 'target': {return $this->_target; }break;
			default:  parent::__get($element);
		}
	}
	
	public function getAction() {return $this->_action; }
	public function getAccept() {return $this->_accept; }
	public function getAcceptcharset() {return $this->_acceptcharset; }
	public function getEnctype() {return $this->_enctype; }
	public function getMethod() {return $this->_method; }
	public function getName() {return $this->_name; }
	public function getOnreset() {return $this->_onreset; }
	public function getOnsubmit() {return $this->_onsubmit; }
	public function getTarget() {return $this->_target; }

	protected function convertThis()
	{
		$this->_htmlCode = "<form";
		parent::convertThis();
		if ($this->_action !== NULL) { $this->_htmlCode .= " action=\"$this->_action\""; }
		if ($this->_accept !== NULL) { $this->_htmlCode .= " accept=\"$this->_accept\""; }
		if ($this->_acceptcharset !== NULL) { $this->_htmlCode .= " accept-charset=\"$this->_acceptcharset\""; }
		if ($this->_enctype !== NULL) { $this->_htmlCode .= " enctype=\"$this->_enctype\""; }
		if ($this->_method !== NULL) { $this->_htmlCode .= " method=\"$this->_method\""; }
		if ($this->_name !== NULL) { $this->_htmlCode .= " name=\"$this->_name\""; }
		if ($this->_onreset !== NULL) { $this->_htmlCode .= " onreset=\"$this->_onreset\""; }
		if ($this->_onsubmit !== NULL) { $this->_htmlCode .= " onsubmit=\"$this->_onsubmit\""; }
		if ($this->_target !== NULL) { $this->_htmlCode .= " target=\"$this->_target\""; }
		$this->_htmlCode .= ">\n";

		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</form>\n";
	}
}

class input extends attribute
{
	private $_accept = NULL;
	private $_accesskey = NULL;
	private $_align = NULL; 
	private $_alt = NULL;
	private $_checked = false;
	private $_datafld = NULL;
	private $_datasrc = NULL;
	private $_dataformatas = NULL;
	private $_disabled = false;
	private $_ismap = false;
	private $_maxlength = NULL;
	private $_name = NULL;
	private $_onblur = NULL;
	private $_onchange = NULL;
	private $_onfocus = NULL;
	private $_onselect = NULL;
	private $_readonly = false;
	private $_size = NULL;
	private $_src = NULL;
	private $_tabindex = NULL;
	private $_type = NULL;
	private $_usemap = NULL;
	private $_value = NULL;
	
	public function __construct($x = NULL) {
		$this->initDOM();
		if ($x != NULL) {
			$this->name = $this->cdata($x);
		}
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'accept': {$this->_accept = $this->cdata($x); }break;
			case 'accesskey': {$this->_accesskey = $this->cdata($x); }break;
			case 'align': {$this->_align = $this->is_align($x); }break;
			case 'alt': {$this->_alt = $this->cdata($x); }break;
			case 'checked': {$this->_checked = $this->is_boolvalue($x); }break;
			case 'datafld': {$this->_datafld = $this->cdata($x); }break;
			case 'datasrc': {$this->_datasrc = $this->cdata($x); }break;
			case 'dataformatas': {$this->_dataformatas = $this->is_dataformatas($x); }break;
			case 'disabled': {$this->_disabled = $this->is_boolvalue($x); }break;
			case 'ismap': {$this->_ismap = $this->is_boolvalue($x); }break;
			case 'maxlength': {$this->_maxlength = $this->zahlen($x); }break;
			case 'name': {$this->_name = $this->cdata($x); }break;
			case 'onblur': {$this->_onblur = $this->cdata($x); }break;
			case 'onchange': {$this->_onchange = $this->cdata($x); }break;
			case 'onfocus': {$this->_onfocus = $this->cdata($x); }break;
			case 'onselect': {$this->_onselect = $this->cdata($x); }break;
			case 'readonly': {$this->_readonly = $this->is_boolvalue($x); }break;
			case 'size': {$this->_size = $this->cdata($x); }break;
			case 'src': {$this->_src = $this->cdata($x); }break;
			case 'tabindex': {$this->_tabindex = $this->zahlen($x); }break;
			case 'type': {$this->_type = $this->is_inputtype($x); }break;
			case 'usemap': {$this->_usemap = $this->cdata($x); }break;
			case 'value': {$this->_value = $this->cdata($x); }break;
			default:  parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'accept': {return $this->_accept; }break;
			case 'accesskey': {return $this->_accesskey; }break;
			case 'align': {return $this->_align; }break;
			case 'alt': {return $this->_alt; }break;
			case 'checked': {return $this->_checked; }break;
			case 'datafld': {return $this->_datafld; }break;
			case 'datasrc': {return $this->_datasrc; }break;
			case 'dataformatas': {return $this->_dataformatas; }break;
			case 'disabled': {return $this->_disabled; }break;
			case 'ismap': {return $this->_ismap; }break;
			case 'maxlength': {return $this->_maxlength; }break;
			case 'name': {return $this->_name; }break;
			case 'onblur': {return $this->_onblur; }break;
			case 'onchange': {return $this->_onchange; }break;
			case 'onfocus': {return $this->_onfocus; }break;
			case 'onselect': {return $this->_onselect; }break;
			case 'readonly': {return $this->_readonly; }break;
			case 'size': {return $this->_size; }break;
			case 'src': {return $this->_src; }break;
			case 'tabindex': {return $this->_tabindex; }break;
			case 'type': {return $this->_type; }break;
			case 'usemap': {return $this->_usemap; }break;
			case 'value': {return $this->_value; }break;
			default:  parent::__get($element);
		}
	}
	
	public function getAccept() {return $this->_accept; }
	public function getAccesskey() {return $this->_accesskey; }
	public function getAlign() {return $this->_align; }
	public function getAlt() {return $this->_alt; }
	public function getChecked() {return $this->_checked; }
	public function getDatafld() {return $this->_datafld; }
	public function getDatasrc() {return $this->_datasrc; }
	public function getDataformatas() {return $this->_dataformatas; }
	public function getDisabled() {return $this->_disabled; }
	public function getIsmap() {return $this->_ismap; }
	public function getMaxlength() {return $this->_maxlength; }
	public function getName() {return $this->_name; }
	public function getOnblur() {return $this->_onblur; }
	public function getOnchange() {return $this->_onchange; }
	public function getOnfocus() {return $this->_onfocus; }
	public function getOnselect() {return $this->_onselect; }
	public function getReadonly() {return $this->_readonly; }
	public function getSize() {return $this->_size; }
	public function getSrc() {return $this->_src; }
	public function getTabindex() {return $this->_tabindex; }
	public function getType() {return $this->_type; }
	public function getUsemap() {return $this->_usemap; }
	public function getValue() { return $this->_value; }

	protected function convertThis()
	{
		$this->_htmlCode = "<input";
		parent::convertThis();
		if ($this->_accept !== NULL) { $this->_htmlCode .= " accept=\"$this->_accept\""; }
		if ($this->_accesskey !== NULL) { $this->_htmlCode .= " accesskey=\"$this->_accesskey\""; }
		if ($this->_align !== NULL) { $this->_htmlCode .= " align=\"$this->_align\""; }
		if ($this->_alt !== NULL) { $this->_htmlCode .= " alt=\"$this->_alt\""; }
		if ($this->_checked === true) { $this->_htmlCode .= " checked=\"checked\""; }
		if ($this->_datafld !== NULL) { $this->_htmlCode .= " datafld=\"$this->_datafld\""; }
		if ($this->_adatasrc !== NULL) { $this->_htmlCode .= " datasrc=\"$this->_datasrc\""; }
		if ($this->_dataformatas !== NULL) { $this->_htmlCode .= " dataformatas=\"$this->_dataformatas\""; }
		if ($this->_disabled === true) { $this->_htmlCode .= " disabled=\"disabled\""; }
		if ($this->_ismap === true) { $this->_htmlCode .= " ismap=\"ismap\""; }
		if ($this->_maxlength !== NULL) { $this->_htmlCode .= " maxlength=\"$this->_maxlength\""; }
		if ($this->_name !== NULL) { $this->_htmlCode .= " name=\"$this->_name\""; }
		if ($this->_onblur !== NULL) { $this->_htmlCode .= " onblur=\"$this->_onblur\""; }
		if ($this->_onchange !== NULL) { $this->_htmlCode .= " onchange=\"$this->_onchange\""; }
		if ($this->_onfocus !== NULL) { $this->_htmlCode .= " onfocus=\"$this->_onfocus\""; }
		if ($this->_onselect !== NULL) { $this->_htmlCode .= " onselect=\"$this->_onselect\""; }
		if ($this->_readonly === true) { $this->_htmlCode .= " readonly=\"readonly\""; }
		if ($this->_size !== NULL) { $this->_htmlCode .= " size=\"$this->_size\""; }
		if ($this->_src !== NULL) { $this->_htmlCode .= " src=\"$this->_src\""; }
		if ($this->_tabindex !== NULL) { $this->_htmlCode .= " tabindex=\"$this->_tabindex\""; }
		if ($this->_type !== NULL) { $this->_htmlCode .= " type=\"$this->_type\""; }
		if ($this->_usemap !== NULL) { $this->_htmlCode .= " usemap=\"$this->_usemap\""; }
		if ($this->_value !== NULL) { $this->_htmlCode .= " value=\"$this->_value\""; }
		return $this->_htmlCode .= " />\n";
	}
}

class label extends attribute
{
	private $_accesskey = NULL;
	private $_htmlfor = NULL; 
	private $_onblur = NULL;
	private $_onfocus = NULL;
	
	public function __construct($z = NULL) { 
		$this->initDOM();
		if ($z != NULL) {
			$this->insert($z);
		}
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'accesskey': {$this->_accesskey = $this->cdata($x); }break;
			case 'htmlfor': {$this->_htmlfor = $this->idref($x); }break;
			case 'onblur': {$this->_onblur = $this->cdata($x); }break;
			case 'onfocus': {$this->_onfocus = $this->cdata($x); }break;
			default:  parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'accesskey': {return $this->_accesskey; }break;
			case 'htmlfor': {return $this->_htmlfor; }break;
			case 'onblur': {return $this->_onblur; }break;
			case 'onfocus': {return $this->_onfocus; }break;
			default:  parent::__get($element);
		}
	}
	
	public function getAccesskey() { return $this->_accesskey; }
	public function getHtmlfor() { return $this->_htmlfor; }
	public function getOnblur() { return $this->_onblur; }
	public function getOnfocus() { return $this->_onfocus; }

	protected function convertThis()
	{
		$this->_htmlCode = "<label";
		parent::convertThis();
		if ($this->_accesskey !== NULL) { $this->_htmlCode .= " accesskey=\"$this->_accesskey\""; }
		if ($this->_htmlfor !== NULL) { $this->_htmlCode .= " for=\"$this->_htmlfor\""; }
		if ($this->_onblur !== NULL) { $this->_htmlCode .= " onblur=\"$this->_onblur\""; }
		if ($this->_onfocus !== NULL) { $this->_htmlCode .= " onfocus=\"$this->_onfocus\""; }
		$this->_htmlCode .= ">";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);

		return $this->_htmlCode .= "</label>\n";

	}
}

class legend extends attribute
{
	private $_accesskey = NULL;
	private $_align = NULL; 
	
	public function __construct($z = NULL) { 
		$this->initDOM();
		if ($z != NULL) {
			$this->insert($z);
		}
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'accesskey': {$this->_accesskey = $this->cdata($x); }break;
			case 'align': {$this->_align = $this->is_align($x); }break;;
			default:  parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'accesskey': {return $this->_accesskey; }break;
			case 'align': {return $this->_align; }break;;
			default:  parent::__get($element);
		}
	}
	
	public function getAccesskey() { return $this->_accesskey; }
	public function getAlign() { return $this->_align; }


	protected function convertThis()
	{
		$this->_htmlCode = "<legend";
		parent::convertThis();
		if ($this->accesskey !== NULL) { $this->_htmlCode .= " accesskey=\"$this->_accesskey\""; }
		if ($this->align !== NULL) { $this->_htmlCode .= " align=\"$this->_align\""; }
		$this->_htmlCode .= ">";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</legend>\n";

	}
}

class optgroup extends attribute
{
	private $_disabled = false;
	private $_label = NULL; 
	
	public function __construct($x,$z = NULL) {
		$this->initDOM();
		$this->label = $this->cdata($x); 
		if ($z != NULL) {
			$this->insert($z);
		}
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'label': {$this->_label = $this->cdata($x); }break;
			case 'disabled': {$this->_disabled = $this->is_boolvalue($x); }break;
			default:  parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'label': {$this->_label = $this->cdata($x); }break;
			case 'disabled': {$this->_disabled = $this->is_boolvalue($x); }break;
			default:  parent::__get($element);
		}
	}
	
	public function getLabel() { return $this->_label;}
	public function getDisabled() { return $this->_disabled; }

	protected function convertThis()
	{
		$this->_htmlCode = "<optgroup";
		parent::convertThis();
		if ($this->_label !== NULL) { $this->_htmlCode .= " label=\"$this->_label\""; }
		if ($this->_disabled === true) { $this->_htmlCode .= " disabled=\"disabled\""; }
		$this->_htmlCode .= ">\n";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</optgroup>\n";

	}
}

class option extends attribute
{
	private $_disabled = false;
	private $_label = NULL; 
	private $_selected = false;
	private $_value = NULL;
	
	public function __construct($z = NULL) {
		$this->initDOM();
		if ($z != NULL) {
			$this->insert($z);
		}
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'label': {$this->_label = $this->cdata($x); }break;
			case 'disabled': {$this->_disabled = $this->is_boolvalue($x); }break;
			case 'selected': {$this->_selected = $this->is_boolvalue($x); }break;
			case 'value': {$this->_value = $this->cdata($x); }break;
			default:  parent::__set($element,$x);
		} 
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'label': {return $this->_label; }break;
			case 'disabled': {return $this->_disabled; }break;
			case 'selected': {return $this->_selected; }break;
			case 'value': {return $this->_value; }break;
			default:  parent::__get($element);
		} 
	}
	
	public function getLabel() { return $this->_label; }
	public function getDisabled() { return $this->_disabled; }
	public function getSelected() { return $this->_selected; }
	public function getValue() { return $this->_value; }

	protected function convertThis()
	{
		$this->_htmlCode = "<option";
		parent::convertThis();
		if ($this->_label !== NULL) { $this->_htmlCode .= " label=\"$this->_label\""; }
		if ($this->_value !== NULL) { $this->_htmlCode .= " value=\"$this->_value\""; }
		if ($this->_disabled === true) { $this->_htmlCode .= " disabled=\"disabled\""; }
		if ($this->_selected === true) { $this->_htmlCode .= " selected=\"selected\""; }
		$this->_htmlCode .= ">";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</option>\n";

	}
}

class select extends attribute
{
	private $_disabled = false;
	private $_datafld = NULL; 
	private $_multiple = false;
	private $_datasrc = NULL;
	private $_dataformatas = NUll;
	private $_name = NULL;
	private $_onblur = NULL;
	private $_onchange = NULL;
	private $_onfocus = NULL;
	private $_size = NULL;
	private $_tabindex = NULL;
	
	public function __construct($x = NULL,$z = NULL) {
		$this->initDOM();
		if ($x != NULL) $this->name = $this->cdata($x);
		if ($z != NULL) {
			$this->insert($z);
		}
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'datafld': {$this->_datafld = $this->cdata($x); }break;
			case 'multiple': {$this->_multiple = $this->is_boolvalue($x); }break;
			case 'selected': {$this->_selected = $this->is_boolvalue($x); }break;
			case 'tabindex': {$this->_tabindex = $this->zahlen($x); }break;
			case 'datasrc': {$this->_datasrc = $this->cdata($x); }break;
			case 'dataformatas': {$this->_dataformatas = $this->is_dataformatas($x); }break;
			case 'name': {$this->_name = $this->cdata($x); }break;
			case 'onblur': {$this->_onblur = $this->cdata($x); }break;
			case 'onchange': {$this->_onchange = $this->cdata($x); }break;
			case 'size': {$this->_size = $this->cdata($x); }break;
			case 'onfocus': {$this->_onfocus = $this->cdata($x); }break;
			default:  parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'datafld': {return $this->_datafld; }break;
			case 'multiple': {return $this->_multiple; }break;
			case 'selected': {return $this->_selected; }break;
			case 'tabindex': {return $this->_tabindex; }break;
			case 'datasrc': {return $this->_datasrc; }break;
			case 'dataformatas': {return $this->_dataformatas; }break;
			case 'name': {return $this->_name; }break;
			case 'onblur': {return $this->_onblur; }break;
			case 'onchange': {return $this->_onchange; }break;
			case 'size': {return $this->_size; }break;
			case 'onfocus': {return $this->_onfocus; }break;
			default:  parent::__get($element);
		}
	}
	
	public function getDatafld() { return $this->_datafld; }
	public function getMultiple() { return $this->_multiple; }
	public function getSelected() { return $this->_selected; }
	public function getTabindex() { return $this->_tabindex; }
	public function getDatasrc() { return $this->_datasrc; }
	public function getDataformatas() { return $this->_dataformatas; }
	public function getName() { return $this->_name; }
	public function getOnblur() { return $this->_onblur; }
	public function getOnchange() { return $this->_onchange; }
	public function getSize() { return $this->_size; }
	public function getOnfocus() { return $this->_onfocus; }


	protected function convertThis()
	{
		$this->_htmlCode = "<select";
		parent::convertThis();
		if ($this->_datafld !== NULL) { $this->_htmlCode .= " datafld=\"$this->_datafld\""; }
		if ($this->_multiple === true) { $this->_htmlCode .= " multiple=\"multiple\""; }
		if ($this->_selected === true) { $this->_htmlCode .= " selected=\"selected\""; }
		if ($this->_name !== NULL) { $this->_htmlCode .= " name=\"$this->_name\""; }
		if ($this->_tabindex !== NULL) { $this->_htmlCode .= " tabindex=\"$this->_tabindex\""; }
		if ($this->_datasrc !== NULL) { $this->_htmlCode .= " datasrc=\"$this->_datasrc\""; }
		if ($this->_dataformatas !== NULL) { $this->_htmlCode .= " dataformatas=\"$this->_dataformatas\""; }
		if ($this->_size !== NULL) { $this->_htmlCode .= " size=\"$this->_size\""; }
		if ($this->_onblur !== NULL) { $this->_htmlCode .= " onblur=\"$this->_onblur\""; }
		if ($this->_onchange !== NULL) { $this->_htmlCode .= " onchange=\"$this->_onchange\""; }
		if ($this->_onfocus !== NULL) { $this->_htmlCode .= " onfocus=\"$this->_onfocus\""; }
		$this->_htmlCode .= ">\n";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</select>\n";

	}
}

class textarea extends attribute
{
	private $_accesskey = NULL;
	private $_cols = NULL;
	private $_disabled = false;
	private $_name = NULL;
	private $_onblur = NULL;
	private $_onchange = NULL;
	private $_onfocus = NULL;
	private $_onselect = NULL;
	private $_readonly = false;
	private $_rows = NULL;
	private $_tabindex = NULL;

	public function __construct ($x,$y,$a = NULL ,$z = NULL) {
		$this->initDOM();
		$this->cols = $this->zahlen($x);
		$this->rows = $this->zahlen($y); 
		if ($a !== NULL)$this->name = $this->cdata($a);
	
		if ($z != NULL) {
			$this->insert($z);
		}
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'accesskey': { $this->_accesskey = $this->cdata($x); }break;
			case 'cols': { $this->_cols = $this->zahlen($x); }break;
			case 'disabled': { $this->_disabled = $this->is_boolvalue($x); }break;
			case 'name': { $this->_name = $this->cdata($x); }break;
			case 'onblur': { $this->_onblur = $this->cdata($x); }break;
			case 'onchange': { $this->_onchange = $this->cdata($x); }break;
			case 'onfocus': { $this->_onfocus = $this->cdata($x); }break;
			case 'onselect': { $this->_onselect = $this->cdata($x); }break;
			case 'readonly': { $this->_readonly = $this->is_boolvalue($x); }break;
			case 'rows': { $this->_rows = $this->zahlen($x); }break;
			case 'tabindex': { $this->_tabindex = $this->zahlen($x); }break;
			default:  parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'accesskey': { return $this->_accesskey; }break;
			case 'cols': { return $this->_cols; }break;
			case 'disabled': { return $this->_disabled; }break;
			case 'name': { return $this->_name; }break;
			case 'onblur': { return $this->_onblur; }break;
			case 'onchange': { return $this->_onchange; }break;
			case 'onfocus': { return $this->_onfocus; }break;
			case 'onselect': { return $this->_onselect; }break;
			case 'readonly': { return $this->_readonly; }break;
			case 'rows': { return $this->_rows; }break;
			case 'tabindex': { return $this->_tabindex; }break;
			default:  parent::__get($element);
		}
	}	
	
	public function getAccesskey() {  return $this->_accesskey; }
	public function getCols() {  return $this->_cols; }
	public function getDisabled() {  return $this->_disabled; }
	public function getName() {  return $this->_name; }
	public function getOnblur() {  return $this->_onblur; }
	public function getOnchange() {  return $this->_onchange; }
	public function getOnfocus() {  return $this->_onfocus; }
	public function getOnselect() {  return $this->_onselect; }
	public function getReadonly() {  return $this->_readonly; }
	public function getRows() {  return $this->_rows; }
	public function getTabindex() {  return $this->_tabindex; }
	
	protected function convertThis()
	{
		$this->_htmlCode = "<textarea";
		parent::convertThis();
		if ($this->_accesskey !== NULL) { $this->_htmlCode .= " accesskey=\"$this->_accesskey\""; }
		if ($this->_cols !== NULL) { $this->_htmlCode .= " cols=\"$this->_cols\""; }
		if ($this->_rows !== NULL) { $this->_htmlCode .= " rows=\"$this->_rows\""; }
		if ($this->_name !== NULL) { $this->_htmlCode .= " name=\"$this->_name\""; }
		if ($this->_disabled === true) { $this->_htmlCode .= " disabled=\"disabled\""; }
		if ($this->_onblur !== NULL) { $this->_htmlCode .= " onblur=\"$this->_onblur\""; }
		if ($this->_onchange !== NULL) { $this->_htmlCode .= " onchange=\"$this->_onchange\""; }
		if ($this->_onfocus !== NULL) { $this->_htmlCode .= " onfocus=\"$this->_onfocus\""; }
		if ($this->_onselect !== NULL) { $this->_htmlCode .= " onselect=\"$this->_onselect\""; }
		if ($this->_readonly === true) { $this->_htmlCode .= " readonly=\"readonly\""; }
		if ($this->_tabindex !== NULL) { $this->_htmlCode .= " tabindex=\"$this->_tabindex\""; }
		$this->_htmlCode .= ">";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</textarea>\n";
	}
} 
?>
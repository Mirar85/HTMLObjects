<?php
namespace de\chilan\HtmlObjects;

use \Exception as Exception;

class div extends attribute
{
	private $_align = NULL;
	private $_dataformatas = NULL;
	private $_datafld = NULL;
	private $_datasrc = NULL;
	
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
			case 'align': {$this->_align = $this->is_align($x); }break;
			case 'datafld': {$this->_datafld = $this->cdata($x); }break;
			case 'datasrc':{$this->d_atasrc = $this->cdata($x); }break;
			case 'dataformatas': {$this->_dataformatas = $this->is_dataformatas($x); }break;
			default: parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'align': {return $this->_align; }break;
			case 'datafld': {return $this->_datafld; }break;
			case 'datasrc':{return $this->d_atasrc; }break;
			case 'dataformatas': {return $this->_dataformatas; }break;
			default: parent::__get($element);
		}
	}
	
	public function getAlign() {return $this->_align;}
	public function getDatafld() {return $this->_datafld;}
	public function getDatasrc() {return $this->_datasrc;}
	public function getDataformatas() {return $this->_dataformatas;}
	
	protected function convertThis()
	{
		$this->_htmlCode = "<div";
		parent::convertThis();
		if ($this->_align !== NULL) { $this->_htmlCode .= " align=\"$this->_align\""; }
		if ($this->_datafld !== NULL) { $this->_htmlCode .= " datafld=\"$this->_datafld\""; }
		if ($this->_datasrc !== NULL) { $this->_htmlCode .= " datasrc=\"$this->_datasrc\""; }
		if ($this->_dataformatas !== NULL) { $this->_htmlCode .= " dataformatas=\"$this->_dataformatas\""; }
		$this->_htmlCode .= ">\n";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</div>\n";
	}
}

class a extends attribute
{
	private $_accesskey = NULL;
	private $_charset = NULL;
	private $_coords = NULL;
	private $_href = "";
	private $_hreflang = NULL;
	private $_name = NULL;
	private $_onblur = NULL;
	private $_onfocus = NULL;
	private $_rel = NULL;
	private $_rev = NULL;
	private $_shape = NULL;
	private $_tabindex = NULL;
	private $_target = NULL;
	private $_type = NULL;
	
	public function __construct ($x = NULL, $y = NULL ,$z = NULL) { 
		$this->initDOM();
		if ($x !== NULL) $this->href = $this->cdataStrict($x); 
		if ($y !== NULL ) $this->name = $this->cdata($y); 
		if ($z != NULL) {
			$this->insert($z);
		} 
	}

	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'accesskey' :{ $this->_accesskey = $this->cdata($x); }break;
			case 'charset' :{ $this->_charset = $this->cdata($x); }break;
			case 'coords' :{ $this->_coords = $this->cdata($x); }break;
			case 'href' :{ $this->_href = $this->cdataStrict($x); }break;
			case 'hreflang' :{ $this->_hreflang = $this->cdata($x); }break;
			case 'name' :{ $this->_name = $this->cdata($x); }break;
			case 'onblur' :{ $this->_onblur = $this->cdata($x); }break;
			case 'onfocus' :{ $this->_onfocus = $this->cdata($x); }break;
			case 'rel' :{ $this->_rel = $this->cdata($x); }break;
			case 'rev' :{ $this->_rev = $this->cdata($x); }break;
			case 'shape' :{ $this->_shape = $this->is_shape($x); }break;
			case 'tabindex' :{ $this->_tabindex = $this->zahlen($x); }break;
			case 'target' :{ $this->_target = $this->cdata($x); }break;
			case 'type' :{ $this->_type = $this->cdata($x); }break;
			default: parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'accesskey' :{ return $this->_accesskey; }break;
			case 'charset' :{ return $this->_charset; }break;
			case 'coords' :{ return $this->_coords; }break;
			case 'href' :{ return $this->_href; }break;
			case 'hreflang' :{ return $this->_hreflang; }break;
			case 'name' :{ return $this->_name; }break;
			case 'onblur' :{ return $this->_onblur; }break;
			case 'onfocus' :{ return $this->_onfocus; }break;
			case 'rel' :{ return $this->_rel; }break;
			case 'rev' :{ return $this->_rev; }break;
			case 'shape' :{ return $this->_shape; }break;
			case 'tabindex' :{ return $this->_tabindex; }break;
			case 'target' :{ return $this->_target; }break;
			case 'type' :{ return $this->_type; }break;
			default: parent::__get($element);
		}
	}
	
	public function getAccesskey() { return $this->_accesskey;  }
	public function getCharset() { return $this->_charset;  }
	public function getCoords() { return $this->_coords;  }
	public function getHref() { return $this->_href;  }
	public function getHreflang() { return $this->_hreflang;  }
	public function getName() { return $this->_name; }
	public function getOnblur() { return $this->_onblur;  }
	public function getOnfocus() { return $this->_onfocus; }
	public function getRel() { return $this->_rel; }
	public function getRev() { return $this->_rev;  }
	public function getShape() { return $this->_shape;  }
	public function getTabindex() { return $this->_tabindex;  }
	public function getTarget() { return $this->_target;  }
	public function getType() { return $this->_type;  }
	
	protected function convertThis()
	{
		$this->_htmlCode = "<a";
		parent::convertThis();
		if ($this->_accesskey !== NULL) { $this->_htmlCode .= " accesskey=\"$this->_accesskey\""; }
		if ($this->_charset !== NULL) { $this->_htmlCode .= " charset=\"$this->_charset\""; }
		if ($this->_coords !== NULL) { $this->_htmlCode .= " coords=\"$this->_coords\""; }
		if ($this->_href !== NULL) { $this->_htmlCode .= " href=\"$this->_href\""; }
		if ($this->_hreflang !== NULL) { $this->_htmlCode .= " hreflang=\"$this->_hreflang\""; }
		if ($this->_name !== NULL) { $this->_htmlCode .= " name=\"$this->_name\""; }
		if ($this->_onblur !== NULL) { $this->_htmlCode .= " onblur=\"$this->_onblur\""; }
		if ($this->_onfocus !== NULL) { $this->_htmlCode .= " onfocus=\"$this->_onfocus\""; }
		if ($this->_rel !== NULL) { $this->_htmlCode .= " rel=\"$this->_rel\""; }
		if ($this->_rev !== NULL) { $this->_htmlCode .= " rev=\"$this->_rev\""; }
		if ($this->_shape !== NULL) { $this->_htmlCode .= " shape=\"$this->_shape\""; }
		if ($this->_tabindex !== NULL) { $this->_htmlCode .= " tabindex=\"$this->_tabindex\""; }
		if ($this->_target !== NULL) { $this->_htmlCode .= " target=\"$this->_target\""; }
		if ($this->_type !== NULL) { $this->_htmlCode .= " type=\"$this->_type\""; }
		$this->_htmlCode .= ">";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</a>\n";
	}
}

class img extends attribute
{
	private $_align = NULL;
	private $_alt = "";
	private $_border = NULL;
	private $_height = NULL;
	private $_hspace = NULL;
	private $_ismap = false;
	private $_longdesc = NULL;
	private $_name = NULL;
	private $_src = NULL;
	private $_usemap = NULL;
	private $_vspace = NULL;
	private $_width = NULL;
	
	public function __construct ($x,$y) { 
		$this->initDOM(); 
		$this->src = $this->cdataStrict($x); 
		$this->alt = $this->cdata($y); 
	}

	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'align': { $this->_align = $this->is_align($x); }break;
			case 'alt': { $this->_alt = $this->cdata($x); }break;
			case 'border': { $this->_border = $this->cdata($x); }break;
			case 'height': { $this->_height = $this->cdata($x); }break;
			case 'hspace': { $this->_hspace = $this->cdata($x); }break;
			case 'ismap': { $this->_ismap = $this->cdata($x); }break;
			case 'longdesc': { $this->_longdesc = $this->cdata($x); }break;
			case 'name': { $this->_name = $this->cdata($x); }break;
			case 'src': { $this->_src = $this->cdata($x); }break;
			case 'usemap': { $this->_usemap = $this->cdata($x); }break;
			case 'vspace': { $this->_vspace = $this->zahlen($x); }break;
			case 'width': { $this->_width = $this->cdata($x); }break;
			default: parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'align': { return $this->_align; }break;
			case 'alt': { return $this->_alt; }break;
			case 'border': { return $this->_border; }break;
			case 'height': { return $this->_height; }break;
			case 'hspace': { return $this->_hspace; }break;
			case 'ismap': { return $this->_ismap; }break;
			case 'longdesc': { return $this->_longdesc; }break;
			case 'name': { return $this->_name; }break;
			case 'src': { return $this->_src; }break;
			case 'usemap': { return $this->_usemap; }break;
			case 'vspace': { return $this->_vspace; }break;
			case 'width': { return $this->_width; }break;
			default: parent::__get($element);
		}
	}
	
	public function getAlign() { return $this->_align; }
	public function getAlt() { return $this->_alt; }
	public function getBorder() { return $this->_border; }
	public function getHeight() { return $this->_height; }
	public function getHspace() { return $this->_hspace; }
	public function getIsmap() { return $this->_ismap; }
	public function getLongdesc() { return $this->_longdesc; }
	public function getName() { return $this->_name; }
	public function getSrc() { return $this->_src; }
	public function getUsemap() { return $this->_usemap; }
	public function getVspace() { return $this->_vspace; }
	public function getWidth() { return $this->_width; }
	
	protected function convertThis()
	{
		$this->_htmlCode = "<img";
		parent::convertThis();
		if ($this->_align !== NULL) { $this->_htmlCode .= " align=\"$this->_align\""; }
		if ($this->_alt !== NULL) { $this->_htmlCode .= " alt=\"$this->_alt\""; }
		if ($this->_src !== NULL) { $this->_htmlCode .= " src=\"$this->_src\""; }
		if ($this->_border !== NULL) { $this->_htmlCode .= " border=\"$this->_border\""; }
		if ($this->_name !== NULL) { $this->_htmlCode .= " name=\"$this->_name\""; }
		if ($this->_height !== NULL) { $this->_htmlCode .= " height=\"$this->_height\""; }
		if ($this->_hspace !== NULL) { $this->_htmlCode .= " hspace=\"$this->_hspace\""; }
		if ($this->_vspace !== NULL) { $this->_htmlCode .= " vspace=\"$this->_vspace\""; }
		if ($this->_longdesc !== NULL) { $this->_htmlCode .= " longdesc=\"$this->_longdesc\""; }
		if ($this->_usemap !== NULL) { $this->_htmlCode .= " usemap=\"$this->_usemap\""; }
		if ($this->_width !== NULL) { $this->_htmlCode .= " width=\"$this->_width\""; }
		if ($this->_ismap === true) { $this->_htmlCode .= " ismap=\"ismap\""; }
		return $this->_htmlCode .= " />\n";
	}
}

class noscript extends attribute
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
			default: parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			default: parent::__get($element);
		}
	}
	
	protected function convertThis()
	{
		$this->_htmlCode = "<noscript";
		parent::convertThis();
		$this->_htmlCode .= ">\n";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</noscript>\n";
	}
}

class object extends attribute
{
	private $_align = NULL;
	private $_archive = NULL;
	private $_border = NULL;
	private $_classid= NULL;
	private $_codebase = NULL;
	private $_codetype = NULL;
	private $_data = NULL;
	private $_datafld = NULL;
	private $_datasrc = NULL;
	private $_dataformatas = NULL;
	private $_htmldeclare = false;
	private $_height = NULL;
	private $_hspace = NULL;
	private $_name = NULL;
	private $_standby = NULL;
	private $_tabindex = NULL;
	private $_type = NULL;
	private $_usemap = NULL;
	private $_vspace = NULL;
	private $_width = NULL;
	
	public function __construct ($z = NULL) { 
		$this->initDOM();
		if ($z != NULL) {
			$this->insert($z);
		}  
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'align': { $this->_align = $this->is_align($x); }break;
			case 'archive': { $this->_archive = $this->cdata($x); }break;
			case 'border': { $this->_border = $this->cdata($x); }break;
			case 'classid': { $this->_classid = $this->cdata($x); }break;
			case 'codebase': { $this->_codebase = $this->cdata($x); }break;
			case 'codetype': { $this->_codetype = $this->cdata($x); }break;
			case 'data': { $this->_data = $this->cdata($x); }break;
			case 'datafld': { $this->_datafld = $this->cdata($x); }break;
			case 'datasrc': { $this->_datasrc = $this->cdata($x); }break;
			case 'dataformatas': { $this->_dataformatas = $this->is_dataformatas($x); }break;
			case 'htmldeclare': { $this->_htmldeclare = $this->is_boolvalue($x); }break;
			case 'height': { $this->_height = $this->cdata($x); }break;
			case 'hspace': { $this->_hspace = $this->cdata($x); }break;
			case 'name': { $this->_name = $this->cdata($x); }break;
			case 'standby': { $this->_standby = $this->cdata($x); }break;
			case 'tabindex': { $this->_tabindex = $this->zahlen($x); }break;
			case 'type': { $this->_type = $this->cdata($x); }break;
			case 'usemap': { $this->_usemap = $this->cdata($x); }break;
			case 'vspace': { $this->_vspace = $this->cdata($x); }break;
			case 'width': { $this->_width = $this->cdata($x); }break;
			default: parent::__set($element,$x);
		} 
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'align': { return $this->_align; }break;
			case 'archive': { return $this->_archive; }break;
			case 'border': { return $this->_border; }break;
			case 'classid': { return $this->_classid; }break;
			case 'codebase': { return $this->_codebase; }break;
			case 'codetype': { return $this->_codetype; }break;
			case 'data': { return $this->_data; }break;
			case 'datafld': { return $this->_datafld; }break;
			case 'datasrc': { return $this->_datasrc; }break;
			case 'dataformatas': { return $this->_dataformatas; }break;
			case 'htmldeclare': { return $this->_htmldeclare; }break;
			case 'height': { return $this->_height; }break;
			case 'hspace': { return $this->_hspace; }break;
			case 'name': { return $this->_name; }break;
			case 'standby': { return $this->_standby; }break;
			case 'tabindex': { return $this->_tabindex; }break;
			case 'type': { return $this->_type; }break;
			case 'usemap': { return $this->_usemap; }break;
			case 'vspace': { return $this->_vspace; }break;
			case 'width': { return $this->_width; }break;
			default: parent::__get($element);
		} 
	}
	
	public function getAlign() { return $this->_align; }
	public function getArchive() { return $this->_archive; }
	public function getBorder() { return $this->_border; }
	public function getClassid() { return $this->_classid; }
	public function getCodebase() { return $this->_codebase; }
	public function getCodetype() { return $this->_codetype; }
	public function getData() { return $this->_data; }
	public function getDatafld() { return $this->_datafld; }
	public function getDatasrc() { return $this->_datasrc; }
	public function getDataformatas() { return $this->_dataformatas; }
	public function getHtmldeclare() { return $this->_htmldeclare; }
	public function getHeight() { return $this->_height; }
	public function getHspace() { return $this->_hspace; }
	public function getName() { return $this->_name; }
	public function getStandby() { return $this->_standby; }
	public function getTabindex() { return $this->_tabindex; }
	public function getType() { return $this->_type; }
	public function getUsemap() { return $this->_usemap; }
	public function getVspace() { return $this->_vspace; }
	public function getWidth() { return $this->_width; }
	
	protected function convertThis()
	{
		$this->_htmlCode = "<object";
		parent::convertThis();
		if ($this->_align !== NULL) { $this->_htmlCode .= " align=\"$this->_align\""; }
		if ($this->_archive !== NULL) { $this->_htmlCode .= " archive=\"$this->_archive\""; }
		if ($this->_border !== NULL) { $this->_htmlCode .= " border=\"$this->_border\""; }
		if ($this->_classid !== NULL) { $this->_htmlCode .= " classid=\"$this->_classid\""; }
		if ($this->_codebase !== NULL) { $this->_htmlCode .= " codebase=\"$this->_codebase\""; }
		if ($this->_codetype !== NULL) { $this->_htmlCode .= " codetype=\"$this->_codetype\""; }
		if ($this->_data !== NULL) { $this->_htmlCode .= " data=\"$this->_data\""; }
		if ($this->_datafld !== NULL) { $this->_htmlCode .= " datafld=\"$this->_datafld\""; }
		if ($this->_datasrc !== NULL) { $this->_htmlCode .= " datasrc=\"$this->_datasrc\""; }
		if ($this->_dataformatas !== NULL) { $this->_htmlCode .= " dataformatas=\"$this->_dataformatas\""; }
		if ($this->_htmldeclare === true) { $this->_htmlCode .= " declare=\"declare\""; }
		if ($this->_height !== NULL) { $this->_htmlCode .= " height=\"$this->_height\""; }
		if ($this->_hspace !== NULL) { $this->_htmlCode .= " hspace=\"$this->_hspace\""; }
		if ($this->_name !== NULL) { $this->_htmlCode .= " name=\"$this->_name\""; }
		if ($this->_standby !== NULL) { $this->_htmlCode .= " standby=\"$this->_standby\""; }
		if ($this->_tabindex !== NULL) { $this->_htmlCode .= " tabindex=\"$this->_tabindex\""; }
		if ($this->_type !== NULL) { $this->_htmlCode .= " type=\"$this->_type\""; }
		if ($this->_usemap !== NULL) { $this->_htmlCode .= " usemap=\"$this->_usemap\""; }
		if ($this->_vspace !== NULL) { $this->_htmlCode .= " vspace=\"$this->_vspace\""; }
		if ($this->_width !== NULL) { $this->_htmlCode .= " width=\"$this->_width\""; }
		$this->_htmlCode .= ">\n";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</object>\n";
	}
} 

class param extends first
{
	private $_id = NULL;
	private $_name = NULL;
	private $_value = NULL;
	private $_valuetype= NULL;
	private $_type = NULL;
	
	public function __construct ($x) {
		$this->initDOM();
		$this->name = $this->cdata($x);
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'id': { $this->_id = $this->idref($x); }break;
			case 'value': { $this->_value = $this->cdata($x); }break;
			case 'valuetype': { $this->_valuetype = $this->is_valuetype($x); }break;
			case 'type': { $this->_type = $this->cdata($x); }break;
			case 'name': { $this->_name = $this->cdata($x); }break;
			default:
			{
				try 
				{
					$error = "$element is not a attribute from ".get_class($this)."!";
					throw new Exception($error);
				}
				catch (Exception $e)
				{
					$var = $e->getTrace();
					die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[2][file]."</b> on line <b>".$var[2][line]."</b>\n<br />");
				}
			}
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'id': { return $this->_id; }break;
			case 'value': { return $this->_value; }break;
			case 'valuetype': { return $this->_valuetype; }break;
			case 'type': { return $this->_type; }break;
			case 'name': { return $this->_name; }break;
			default:
			{
				try 
				{
					$error = "$element is not a attribute from ".get_class($this)."!";
					throw new Exception($error);
				}
				catch (Exception $e)
				{
					$var = $e->getTrace();
					die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[2][file]."</b> on line <b>".$var[2][line]."</b>\n<br />");
				}
			}
		}
	}	
	
	public function getId() { return $this->_id; }
	public function getValue() { return $this->_value; }
	public function getValuetype() { return $this->_valuetype; }
	public function getType() { return $this->_type; }
	public function getName() { return $this->_name; }
	
	protected function convertThis()
	{
		$this->_htmlCode = "<param";
		if ($this->_id !== NULL) { $this->_htmlCode .= " id(=\"$this->_id(\""; }
		if ($this->_value !== NULL) { $this->_htmlCode .= " value=\"$this->_value\""; }
		if ($this->_valuetype !== NULL) { $this->_htmlCode .= " valuetype=\"$this->_valuetype\""; }
		if ($this->_type !== NULL) { $this->_htmlCode .= " type=\"$this->_type\""; }
		if ($this->_name !== NULL) { $this->_htmlCode .= " name=\"$this->_name\""; }
		return $this->_htmlCode .= " />\n";
	}
} 

// TODO JAVA implementation
class script extends checkInput
{
	private $_charset = NULL;
	private $_defer = false;
	private $_event = NULL;
	private $_language= NULL;
	private $_htmlfor = NULL;
	private $_src = NULL;
	private $_type = NULL;
	
	public function __construct ($x,$z = NULL) {
		$this->type = $this->cdata($x);
		$this->initDOM();
		if ($z != NULL) {
			$this->insert($z);
		} 
	 }
	 
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'charset': { $this->_charset = $this->cdata($x); }break;
			case 'defer': { $this->_defer = $this->is_boolvalue($x); }break;
			case 'event': { $this->_event = $this->cdata($x); }break;
			case 'language': { $this->_language = $this->cdata($x); }break;
			case 'htmlfor': { $this->_htmlfor = $this->idref($x); }break;
			case 'src': { $this->_src = $this->cdata($x); }break;
			case 'type': { $this->_type = $this->cdata($x); }break;
			default: parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'charset': { return $this->_charset; }break;
			case 'defer': { return $this->_defer; }break;
			case 'event': { return $this->_event; }break;
			case 'language': { return $this->_language; }break;
			case 'htmlfor': { return $this->_htmlfor; }break;
			case 'src': { return $this->_src; }break;
			case 'type': { return $this->_type; }break;
			default: parent::__get($element);
		}
	}	
		
	public function getCharset() { return $this->_charset; }
	public function getDefer() { return $this->_defer; }
	public function getEvent() { return $this->_event; }
	public function getLanguage() { return $this->_language; }
	public function getHtmlfor() { return $this->_htmlfor; }
	public function getSrc() { return $this->_src; }
	public function getType() { return $this->_type; }
	
	public function insertJava($value)
	{
		if (is_object($value))
		{
			$this->temp .= $value->fertig;
			$this->connvert($this);
		}
		else
		{
			if (is_array($value))
			{
				
				foreach ($value as $wert)
				{
					$this->insertJava($wert);
				}
				$this->connvert($this);
				
			}
			else
			{
				$this->temp .= nl2br($value)."\n";
				$this->connvert($this);
			}
		}
		return true;
	}
	
	protected function convertThis()
	{
		$this->_htmlCode = "<script";
		parent::convertThis();
		if ($this->_charset !== NULL) { $this->_htmlCode .= " charset=\"$this->_charset\""; }
		if ($this->_defer === true) { $this->_htmlCode .= " defer=\"defer\""; }
		if ($this->_event !== NULL) { $this->_htmlCode .= " event=\"$this->_event\""; }
		if ($this->_language !== NULL) { $this->_htmlCode .= " language=\"$this->_language\""; }
		if ($this->_htmlfor !== NULL) { $this->_htmlCode .= " for=\"$this->_htmlfor\""; }
		if ($this->_src !== NULL) { $this->_htmlCode .= " src=\"$this->_src\""; }
		if ($this->_type !== NULL) { $this->_htmlCode .= " type=\"$this->_type\""; }
		$this->_htmlCode .= ">";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</script>\n";
	}
} 

?>
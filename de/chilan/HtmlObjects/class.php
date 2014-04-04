<?php
/**
 * This is the main file that must include when you want to use
 * this framework. Its include the ground class "first". Every other 
 * HTMLObject class must have it extended. 
 *
 * Follow classes are in this file: first, attribute, checkInput,
 * xml, nothing, innerText, body, html
 *
 * @author Ulf Wohlers - Chilan.de
 * @package de\chilan\HtmlObjects
 */
 
namespace de\chilan\HtmlObjects;

use \Exception as Exception;

require_once("class_htmlobjectlist.php");
require_once("class_other.php");
require_once("class_formular.php");
require_once("class_head.php");
require_once("class_lists.php");
require_once("class_map.php");
require_once("class_standallone.php");
require_once("class_table.php");
require_once("class_textelements.php");

/**
* Class first is the ground class for all HTML objects. It includes all
* important methods for transaction with it. There also the methods for
* proof which type of data are allowed. (PCDATA, idref, etc.)
* Also it include the insert, insertAfter, etc. Methods
* 
* Class variables are $_text for simple text, $_htmlCode for the HTML Code 
* and $_domObject as an array of HTMLobjects (The array always starts at 0 
* and end at the length
* @abstract
*/
abstract class first
{
	protected $_text = NULL;
	protected $_htmlCode = NULL;
	protected $_domObject = null;
	
	abstract protected function convertThis();	
	abstract public function __set($element,$x);
	abstract public function __get($elemen);
	
	protected function getDomObject() {
		return $domObject;
	}
	
	protected function initDOM() {
		if ($this->_domObject === null) {
			$this->_domObject = new htmlobjectlist();
		}
	}
	
	/**
	* Proof if a given variable is a String and convert it when
	* it is a string into an innerText HTML object
	* @param $object - The varaible that will be checked
	* @param $nonconvert [optional] - if true it will add without 
	* 		 converting the text into html conform text. 
	*/
	private function is_string($object,$nonconvert = false) {
		if ($object === null) {
			$object = "";
		}
		if (is_string($object)) {
			if ($nonconvert === false) {
				$temp = new innerText($object);
				$object = $temp;
			}
			else {
				$temp = new innerText();
				$temp->writeHTML($object);
				$object = $temp;
			}
		}
		return $object;
	}
	
	/**
	* Insert a HTML object into the object where it will be called
	* Add the object at the end of an Array that starts with 0
	* @param $object - can be an HTML obejct or an Array of objects or strings
	*/
	public function insert($object) {
		
		$object = $this->is_string($object);
		
		if (is_array($object)) {
				foreach ($object as $wert)
				{
					$wert = $this->is_string($wert);

					if (is_array($wert)) {
						$this->insert($wert);
					}
					else if ($this->checkIfHTMLObject($wert)) {
						$this->_domObject->add($wert);
					}
				}
		} else if ($this->checkIfHTMLObject($object)) {
			$this->_domObject->add($object);
		}
	}

	/**
	* Insert a HTML object into the object where it will be called
	* Add the object at the start (Position 0) of an Array
	* @param $object - can be an HTML obejct or an Array of objects or strings
	*/	
	public function insertFirst($object) {
		$this->insertAfter($object,-1);
	}

	/**
	* Insert a HTML object into the object where it will be called
	* Add the object after the given position of an Array
	* @param $object - can be an HTML object or an Array of objects or strings
	* @param $x - The position where it will be add after
	*/	
	public function insertAfter($object,$x) {
		$object = $this->is_string($object);
		if (is_array($object)) {
				$y = 0;
				foreach ($object as $wert)
				{
					$wert = $this->is_string($wert);
					if (is_array($wert)) {
						$this->insertAfter($wert,$x+$y);
						$y = $y + count($wert);
					}
					else if ($this->checkIfHTMLObject($wert)) {
						$this->_domObject->addAfter($wert,$x+$y);
						$y++;
					}
				}
		} else if ($this->checkIfHTMLObject($object)) {
			$this->_domObject->addAfter($object,$x);
		} 
	}

	/**
	* Insert a HTML object into the object where it will be called
	* Add the object before the given position of an Array
	* @param $object - can be an HTML object or an Array of objects or strings
	* @param $x - The position where it will be add before
	*/		
	public function insertBefor($object,$x) {
		$this->insertAfter($object,$x-1);
	}

	/**
	* Insert a HTML object into the object where it will be called
	* HTML Code written as String will be not convert in a string
	* @param $value - can be an HTML object or an Array of objects or strings
	*/	
	public function insertnonconvert($value) {
		$value = $this->is_string($value,true);
		if (is_array($value)) {
			foreach ($value as $wert ) {
				$this->insertnonconvert($wert);
			}
		} 
		else {
					$this->insert($value);
		}
	}
	
	/**
	* Check if the HTML object are allowed to add
	* @param $x - The element that will be proofed
	* @return true,false
	* @throwException - When not allowed 
	*/
	protected function checkIfHTMLObject($x) {
		$htmlClass = htmlobjectlist::getAllHtmlClass();
		if (in_array(get_class($x),$htmlClass))
		{
			return true;
		} 
		else {
			throw new Exception("HTML class fault(Type error): You can add only HTML class objects to the list.");
		}
		return false;
	}
	
	/**
	* Convert the domObject into HTML Code
	* @param $htmlCode - HTML Code where others will be add
	* @return the new generated HTML code
	*/
	protected function convert($htmlCode) {
		if ($this->_domObject !== null) {
			for ($i=0;$i<$this->_domObject->getSize();$i++) {
				$htmlCode .= $this->_domObject->get($i)->convertThis();
			}
		}
		return $htmlCode;
	}
	
	/**
	* Proof if it a number
	* @param $input - The number that will be checked
	* @return true,false
	* @throwException Not a number
	*/
	protected function zahlen($input)
	{
		try
		{
			if (!(is_numeric($input)))
			{
					$error = "This HTML element akzept only a numeric value ";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	} 

	/**
	* Make input to cdata
	* @param $input - To change
	* @return The changed cdata
	*/	
	protected function cdata($input)
	{
			$input = htmlentities($input);
			$input = str_replace("&amp;","&",$input);
			$input = str_replace("&amp;#","&#",$input);
			return $input;
	}

	/**
	* Make input to cdataStrict
	* @param $input - To change
	* @return The changed cdataStrict
	*/
	protected function cdataStrict($input)
	{
			$input = htmlentities($input);
			return $input;
	}
	
	/**
	* Proof if it idref
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a idref
	*/
	protected function idref($input)
	{
		$input = (string)$input;
		try
		{
			if (!(preg_match('/^[a-zA-Z.:][\w\-_.:]*$/i', $input)))
			{
					$error = "This HTML element must beginn with a charakter and than only numbers, charakters or _";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return htmlentities($input);
	}

	/**
	* Change a string to cdata and change new line to <br>
	* @param $input - The string that will be checked
	* @return The changed string
	*/
	protected function nl3br ($input)
	{
		$input = $this->cdata($input);
		return nl2br($input);
	}

	/**
	* Method to insert XML Objects
	* @param $value - Should be a XML Object 
	*/
	public function insertxml($value)
	{
		$this->insert($value);
	}

	/**
	* Proof if is shape
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a shape
	*/
	protected function is_shape ($input)
	{
		try
		{
			if (!(in_array($input,array('rect','circle','poly','default'))))
			{
					$error = "This HTML element akzept only <b>rect</b>,<b>circle</b>,<b>poly</b>, or <b>default</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	/**
	* Proof if is clear
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a clear
	*/
	protected function is_clear ($input)
	{
		try
		{
			if (!(in_array($input,array('left','all','right','none'))))
			{
					$error = "This HTML element akzept only <b>left</b>,<b>all</b>,<b>right</b>, or <b>none</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is dir
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a dir
	*/
	protected function is_dir ($input)
	{
		try
		{
			if (!(in_array($input,array('ltr','rtl'))))
			{
					$error = "The dir HTML element akzept only <b>ltr</b> or <b>rtl</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is dataformatas
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a dataformatas
	*/
	protected function is_dataformatas ($input)
	{
		try
		{
			if (!(in_array($input,array('plaintext','html'))))
			{
					$error = "The dateformatas HTML element akzept only <b>plaintext</b> or <b>html</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is inputtype
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a inputtype
	*/
	protected function is_inputtype($input)
	{
		try
		{
			if (!(in_array($input,array('text','password','checkbox','radio','submit','reset','file','hidden','image','button'))))
			{
					$error = "The dir HTML element akzept only <b>text</b>,<b>password</b>,<b>checkbox</b>,<b>radio</b>,<b>submit</b>,<b>reset</b>,<b>file</b>,<b>hidden</b>,<b>image</b> or <b>button</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is type
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a type
	*/
	protected function is_type ($input)
	{
		try
		{
			if (!(in_array($input,array('button','submit','reset'))))
			{
					$error = "This HTML element akzept only <b>button</b>,<b>submit</b> or <b>reset</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}

	/**
	* Proof if is align
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a align
	*/
	protected function is_align ($input)
	{
		try
		{
			if (!(in_array($input,array('top','bottom','left','right','center','justify','char'))))
			{
					$error = "The dir HTML element akzept only <b>top</b>,<b>bottom</b>,<b>left</b>,<b>right</b>,<b>justify</b> or <b>char</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is valign
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a valign
	*/
	protected function is_valign ($input)
	{
		try
		{
			if (!(in_array($input,array('top','bottom','middle','baseline'))))
			{
					$error = "The dir HTML element akzept only <b>top</b>,<b>bottom</b>,<b>middle</b> or <b>baseline</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is compact
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a compact
	*/
	protected function is_compact ($input)
	{
		try
		{
			if (!(in_array($input,array('compact',''))))
			{
					$error = "The dir HTML element akzept only <b>compact</b> or '<b></b>' not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}

	/**
	* Proof if is method
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a method
	*/
	protected function is_method ($input)
	{
		try
		{
			if (!(in_array($input,array('get','post'))))
			{
					$error = "The dir HTML element akzept only <b>get</b> or <b>post</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is border
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a border
	*/
	protected function is_border ($input)
	{
		try
		{
			if (!(in_array($input,array('1','0'))))
			{
					$error = "The dir HTML element akzept only <b>1</b> or <b>0</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is scrolling
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a scrolling
	*/
	protected function is_scrolling ($input)
	{
		try
		{
			if (!(in_array($input,array('yes','no','auto'))))
			{
					$error = "The dir HTML element akzept only <b>yes</b>,<b>no</b> or <b>auto</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is litype
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a litype
	*/
	protected function is_litype ($input)
	{
		try
		{
			if (!(in_array($input,array('disc','square','circle','1','a','A','i','I'))))
			{
					$error = "The dir HTML element akzept only <b>disc</b>,<b>square</b>,<b>circle</b>,<b>1</b>,<b>a</b>,<b>A</b>,<b>i</b> or <b>I</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is oltype
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a oltype
	*/
	protected function is_oltype ($input)
	{
		try
		{
			if (!(in_array($input,array('1','a','A','i','I'))))
			{
					$error = "The dir HTML element akzept only <b>1</b>,<b>a</b>,<b>A</b>,<b>i</b> or <b>I</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is ultype
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a ultype
	*/
	protected function is_ultype ($input)
	{
		try
		{
			if (!(in_array($input,array('disc','square','circle'))))
			{
					$error = "The dir HTML element akzept only <b>disc</b>,<b>square</b> or <b>circle</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is valuetype
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a valuetype
	*/
	protected function is_valuetype ($input)
	{
		try
		{
			if (!(in_array($input,array('data','ref','object'))))
			{
					$error = "The dir HTML element akzept only <b>data</b>,<b>ref</b> or <b>object</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is boolvalue
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a boolvalue
	*/
	protected function is_boolvalue ($input) 
	{
		try
		{
			if (!(is_bool($input)))
			{
					$error = "The dir HTML element akzept only a boolean value like true or false not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is frame
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a frame
	*/
	protected function is_frame ($input)
	{
		try
		{
			if (!(in_array($input,array('void','above','below','hsides','lhs','rhs','vsides','box','border'))))
			{
					$error = "The dir HTML element akzept only <b>void</b>,<b>above</b>,<b>below</b>,<b>hsides</b>,<b>lhs</b>,<b>rhs</b>,<b>vsides</b>,<b>box</b> or <b>border</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is rules
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a rules
	*/
	protected function is_rules ($input)
	{
		try
		{
			if (!(in_array($input,array('none','groups','rows','cols','all'))))
			{
					$error = "The dir HTML element akzept only <b>none</b>,<b>groups</b>,<b>rows</b>,<b>cols</b> or <b>all</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Proof if is scope
	* @param $input - The string that will be checked
	* @return The changed string
	* @throwException Not a scope
	*/
	protected function is_scope ($input)
	{
		try
		{
			if (!(in_array($input,array('row','col','rowgroup','colgroup'))))
			{
					$error = "The dir HTML element akzept only <b>row</b>,<b>col</b>,<b>rowgroup</b> or <b>colgroup</b> not '".$input."'";
					throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Class Fault: </b>".$e->getMessage()." in <b>".$var[3][file]."</b> on line <b>".$var[3][line]."</b>\n<br />");
		}
		return $input;
	}
	
	/**
	* Change the HTML Code a little bit so that there
	* it looks better in the source code
	* @param $indent - How much space
	*/
	protected function formatHTML($indent = 0)
	{
		
		$zeile = explode("\n", $this->_htmlCode);
		$temp = "";
		
		$boolean = 0;
		for ($i=0;$i<count($zeile);$i++)
		{
			$_zeile[$i]= " ".$zeile[$i];
			$wert1 = strpos($_zeile[$i],"<");
			$wert2 = strpos($_zeile[$i],"</");
			$wert3 = strpos($_zeile[$i],"/>");
			$wert4 = $wert2;
			$wert5 = strpos($_zeile[$i],">");
			if ($wert5 !== false) $wert5 = $wert5-1;

			if ($wert2 === false) { $wert2 = $wert3; }
		
			if ((($wert1 !== false && $wert2 !== false) && ($wert1 === $wert2)))
			{ $boolean--; }
			
			if ($boolean < 1) { $boolean++; }
			if ((($wert4 > 1) && ($wert1 > 1)) || ($wert1 === false && $wert2 === false && $wert3 === false))
			{
				$temp .= "$zeile[$i]\n";
			}
			else
			{
				$temp .= str_repeat("    ", $boolean)."$zeile[$i]\n";
			}
			
			if ($wert3 !== false && $wert5 !== false)
			{
				if ($wert3 !== $wert5)
				{ $boolean++; }
			}
			if ($wert1 !== false && $wert2 === false)
			{ $boolean++; }
			
			// echo "$wert1 -- $wert2<br />";
		}
		$this->_htmlCode = $temp;
	}
	
	/**
	* Important Methode - it generate the HTML code and send it
	* to the client.
	*/
	public function echoHTML() {  
		$this->convertThis();
		$this->formatHTML(); 
		echo $this->_htmlCode; 
	}

}

/**
* Class that represent a XML object
* It extends from first
*/
class xml extends first
{
	private $_xmlobject = NULL;
	private $_xmlattribute = NULL;
	private $_xmlkopf = NULL;
	private $_xmlextra = NULL;
	private $_xmlempty = false;
	private $_cdata = false;
	
	public function __construct($x) { 
		$this->initDOM();
		$this->_xmlobject = $x;
	}
	
	public function __set($element,$x)
	{
		$x = $this->cdata($x);
		$element = str_replace("__",":",$element);
		if (preg_match("# $element=\".*\"#",$this->_xmlattribute))
		{
			$this->_xmlattribute = preg_replace("#(.*) $element=\".*\"(.*)#Uis"," $element=\"$x\"",$this->_xmlattribute);
		}
		else
		{
			$this->_xmlattribute .= " $element=\"$x\"";
		}
	}
	
	public function __get($element)
	{
		return preg_grep("#(.*) $element=\".*\"(.*)#Uis");
	}
	
	public function setCData($wert=true) {$this->_cdata = $wert;}
	public function xmlkopf($x) { $this->_xmlkopf = $x; }
//	public function deleteinsert() { $this->temp = ""; }
	public function echoXML() { 
		$this->convertThis();
		$this->formatHTML(); 
		echo $this->_xmlextra.$this->_htmlCode;
	}
	public function getXML() { return $this->_htmlCode; }
	public function xmlEmpty() { $this->_xmlempty = true; }
	public function setFirstLine($extra) {$this->_xmlextra = $extra."\n"; }
	public function deleteFirstLine() {$this->_xmlextra = NULL; }
	
	/**
	* Generate the XML Code with all objects that are in this XML object
	*/
	protected function convertThis()
	{
		if ($this->_xmlkopf !== NULL) 
		{
			$this->_htmlCode = $this->_xmlkopf."\n";
			$this->_htmlCode .= "<".$this->_xmlobject."";
		}
		else
		{
			$this->_htmlCode = "<".$this->_xmlobject."";
		}
		$this->_htmlCode .= $this->_xmlattribute;
		
		if ($this->_xmlempty === true)
		{
			$this->_htmlCode .= " />";
		}
		else
		{
			$this->_htmlCode .= ">";
			if ($this->_cdata === true) $this->_htmlCode .= "<![CDATA[";
			
			$this->_htmlCode = $this->convert($this->_htmlCode);
			
			if ($this->_cdata === true) $this->_htmlCode .= "]]>";
			$this->_htmlCode .= "</".$this->_xmlobject.">\n";
		}
		return $this->_htmlCode;
	}
}

/**
* Class that not really a usable class
* It is for give all HTML objects with dir and lang attributes
* this attributes.
* It extends from first
* @throwException wrong __set element
*/
class checkInput extends first
{
	protected $_dir = NULL;
	protected $_lang = NULL;
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'dir': {$this->_dir=$this->is_dir($x); };break;
			case 'lang': { $this->_lang=$this->cdata($x); }break;
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
			case 'dir': {return $this->_dir; };break;
			case 'lang': { return $this->_lang; }break;
			default:
		}
	}

	public function getLang() { return $this->_lang; }
	public function getDir() { return $this->_dir; }
	
	protected function convertThis()
	{
		if ($this->_dir !== NULL) { $this->_htmlCode .= " dir=\"$this->_dir\""; }
		if ($this->_lang !== NULL) { $this->_htmlCode .= " lang=\"$this->_lang\""; }
		
		return $this->_htmlCode;
	}

}

/**
* Class that not really a usable class
* It is for give all HTML objects with this here defined attributes
* It extends from checkInput
*/
class attribute extends checkInput
{
	protected $_class = NULL;
	protected $_id = NULL;
	protected $_style = NULL;
	protected $_title = NULL;
	
	protected $_onclick = NULL;
	protected $_ondblclick = NULL;
	protected $_onmousedown = NULL;
	protected $_onmouseup = NULL;
	protected $_onmouseover = NULL;
	protected $_onmousemove = NULL;
	protected $_onmouseout = NULL;
	protected $_onkeypress = NULL;
	protected $_onkeydown = NULL;
	protected $_onkeyup = NULL;
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'onclick': { $this->_onclick=$this->cdata($x); }break;
			case 'ondblclick': { $this->_ondblclick=$this->cdata($x); }break;
			case 'onmousedown': { $this->_onmousedown=$this->cdata($x); }break;
			case 'onmouseup': { $this->_onmouseup=$this->cdata($x); }break;
			case 'onmouseover': { $this->_onmouseover=$this->cdata($x); }break;
			case 'onmousemove': { $this->_onmousemove=$this->cdata($x); }break;
			case 'onmouseout': { $this->_onmouseout=$this->cdata($x); }break;
			case 'onkeypress': { $this->_onkeypress=$this->cdata($x); }break;
			case 'onkeydown': { $this->_onkeydown=$this->cdata($x); }break;
			case 'onkeyup': { $this->_onkeyup=$this->cdata($x); }break;
			case 'class': { $this->_class= $this->cdata($x); }break;
			case 'id': { $this->_id=$this->cdata($x); }break;
			case 'style': { $this->_style=$this->cdata($x); }break;
			case 'title': { $this->_title=$this->cdata($x); }break;
			default: parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'onclick': { return $this->_onclick; }break;
			case 'ondblclick': { return $this->_ondblclick; }break;
			case 'onmousedown': { return $this->_onmousedown; }break;
			case 'onmouseup': { return $this->_onmouseup; }break;
			case 'onmouseover': { return $this->_onmouseover; }break;
			case 'onmousemove': { return $this->_onmousemove; }break;
			case 'onmouseout': { return $this->_onmouseout; }break;
			case 'onkeypress': { return $this->_onkeypress; }break;
			case 'onkeydown': { return $this->_onkeydown; }break;
			case 'onkeyup': { return $this->_onkeyup; }break;
			case 'class': { return $this->_class; }break;
			case 'id': { return $this->_id; }break;
			case 'style': { return $this->_style; }break;
			case 'title': { return $this->_title; }break;
			default: parent::__get($element);
		}
	}
	
	public function getOnclick () { return $this->_onclick; }
	public function getOndblclick () { return $this->_ondblclick; }
	public function getOnmousedown () { return $this->_onmousedown; }
	public function getOnmouseup () { return $this->_onmouseup; }
	public function getOnmouseover () { return $this->_onmouseover; }
	public function getOnmousemove () { return $this->_onmousemove; }
	public function getOnmouseout () { return $this->_onmouseout; }
	public function getOnkeypress () { return $this->_onkeypress; }
	public function getOnkeydown () { return $this->_onkeydown; }
	public function getOnkeyup () { return $this->_onkeyup; }
	
	public function getClass() { return $this->_class; }
	public function getID() { return $this->_id; }
	public function getStyle() { return $this->_style; }
	public function getTitle() { return $this->_title; }
	
	protected function convertThis()
	{
		parent::convertThis();
		if ($this->_class !== NULL) { $this->_htmlCode .= " class=\"$this->_class\""; }
		if ($this->_id !== NULL) { $this->_htmlCode .= " id=\"$this->_id\""; }
		if ($this->_style !== NULL) { $this->_htmlCode .= " style=\"$this->_style\""; }
		if ($this->_title !== NULL) { $this->_htmlCode .= " title=\"$this->_title\""; }
		if ($this->_onclick !== NULL) { $this->_htmlCode .= " onclick=\"$this->_onclick\""; }
		if ($this->_ondblclick !== NULL) { $this->_htmlCode .= " ondblclick=\"$this->_ondblclick\""; }
		if ($this->_onmousedown !== NULL) { $this->_htmlCode .= " onmousedown=\"$this->_onmousedown\""; }
		if ($this->_onmouseup !== NULL) { $this->_htmlCode .= " onmouseup=\"$this->_onmouseup\""; }
		if ($this->_onmouseover !== NULL) { $this->_htmlCode .= " onmouseover=\"$this->_onmouseover\""; }
		if ($this->_onmousemove !== NULL) { $this->_htmlCode .= " onmousemove=\"$this->_onmousemove\""; }
		if ($this->_onmouseout !== NULL) { $this->_htmlCode .= " onmouseout=\"$this->_onmouseout\""; }
		if ($this->_onkeypress !== NULL) { $this->_htmlCode .= " onkeypress=\"$this->_onkeypress\""; }
		if ($this->_onkeydown !== NULL) { $this->_htmlCode .= " onkeydown=\"$this->_onkeydown\""; }
		if ($this->_onkeyup !== NULL) { $this->_htmlCode .= " onkeyup=\"$this->_onkeyup\""; }
		
		return $this->_htmlCode;
	}
}

/**
* Class that represent a HTML Object with nothing.
* Simple text for example can add here. It is a
* little bit redundant with innerText
*/
class nothing extends first
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
		return $this->_htmlCode = $this->convert($this->_htmlCode);
	}
}

/**
* This class represent a body tag in HTML 
*/
class body extends attribute
{
	private $_alink = NULL;
	private $_background = NULL;
	private $_bgcolor = NULL;
	private $_link = NULL;
	private $_onload = NULL;
	private $_onunload = NULL;
	private $_htmltext = NULL;
	private $_vlink = NULL;

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
			case 'alink' :{ $this->_alink = $this->cdata($x); }break;
			case 'background' :{ $this->_background = $this->cdata($x); }break;
			case 'bgcolor' :{ $this->_bgcolor = $this->cdata($x); }break;
			case 'link' :{ $this->_link = $this->cdata($x); }break;
			case 'onload' :{ $this->_onload = $this->cdata($x); }break;
			case 'onunload' :{ $this->_onunload = $this->cdata($x); }break;
			case 'htmltext' :{ $this->_htmltext = $this->cdata($x); }break;
			case 'vlink' :{ $this->_vlink = $this->cdata($x); }break;
			default: parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'alink' :{ return $this->_alink; }break;
			case 'background' :{ return $this->_background; }break;
			case 'bgcolor' :{ return $this->_bgcolor; }break;
			case 'link' :{ return $this->_link; }break;
			case 'onload' :{ return $this->_onload; }break;
			case 'onunload' :{ return $this->_onunload; }break;
			case 'htmltext' :{ return $this->_htmltext; }break;
			case 'vlink' :{ return $this->_vlink; }break;
			default: parent::__set($element,$x);
		}
	}
	
	public function getAlink() { return $this->_alink; }
	public function getBackground() { return $this->_background; }
	public function getBgcolor() { return $this->_bgcolor; }
	public function getLink() { return $this->_link; }
	public function getOnload() { return $this->_onload; }
	public function getOnunload() { return $this->_onunload; }
	public function getHtmltext() { return $this->_htmltext; }
	public function getVlink() { return $this->_vlink; }
	
	protected function convertThis()
	{
		
		$this->_htmlCode .= "<body";
		parent::convertThis();
		if ($this->_alink !== NULL) { $this->_htmlCode .= " alink=\"$this->_alink\""; }
		if ($this->_background !== NULL) { $this->_htmlCode .= " background=\"$this->_background\""; }
		if ($this->_bgcolor !== NULL) { $this->_htmlCode .= " bgcolor=\"$this->_bgcolor\""; }
		if ($this->_link !== NULL) { $this->_htmlCode .= " link=\"$this->_link\""; }
		if ($this->_onload !== NULL) { $this->_htmlCode .= " onload=\"$this->_onload\""; }
		if ($this->_onunload !== NULL) { $this->_htmlCode .= " onunload=\"$this->_onunload\""; }
		if ($this->_htmltext !== NULL) { $this->_htmlCode .= " text=\"$this->_htmltext\""; }
		if ($this->_vlink !== NULL) { $this->_htmlCode .= " vlink=\"$this->_vlink\""; }
		$this->_htmlCode .= ">\n";
		
		$this->_htmlCode = $this->convert($this->_htmlCode);
		
		return $this->_htmlCode .= "</body>\n";
		
	}
}

/**
* This class represent a html tag in HTML 
*/
class html extends checkInput
{
	private $_version = NULL;
	private $_xmlns = NULL;
	private $_extra = NULL;
	
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
			case 'version' :{ $this->_version = $this->cdata($x); }break;
			case 'xmlns' :{ $this->_xmlns = $this->cdata($x); }break;
			case 'extra':;break;
			default: parent::__set($element,$x);
		}
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'version' :{ return $this->getVersion(); }break;
			case 'xmlns' :{ return $this->getVersion();}break;
			case 'extra':;break;
			default: parent::__get($element);
		}
	}
	
	public function getVersion() { return $this->version; }
	public function getXmlns() { return $this->xmlns; }
	
	protected function convertThis()
	{
		$this->_extra = "<?xml version=\"1.0\" encoding=\"UTF-8\"?> 
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
    \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n\n";
		$this->_htmlCode .= "<html";
		parent::convertThis();
		if ($this->_version !== NULL) { $this->_htmlCode .= " version=\"$this->_version\""; }
		if ($this->_xmlns !== NULL) { $this->_htmlCode .= " xmlns=\"$this->_xmlns\""; }
		$this->_htmlCode .= ">\n";

		$this->_htmlCode = $this->convert($this->_htmlCode);

		return $this->_htmlCode .= "</html>";
		
	}

	/**
	* This method generate a hole html site and give it to the user
	*/
	public function echoHTML() {
		$this->convertThis();
		$this->formatHTML(); 
		echo $this->_extra; 
		echo $this->_htmlCode; 
	}
}

/**
* Class that represent a HTML Object with text in it.
* Simple text for example can add here. It is a
* little bit redundant with nothing
*/
class innerText extends first
{
	public function __construct($text = null) {
		$this->initDOM();
		if ($text !== null) {
			$this->_text = $this->nl3br($text);
		}
	}
	
	public function writeHTML($value) {
		$this->_text = html_entity_decode($value);
	}
	
	public function __set($element,$x)
	{
		switch ($element)
		{
			case 'value': { $this->_text = $this->nl3br($x); }break;
			default: parent::__set($element,$x);
		} 
	}
	
	public function __get($element)
	{
		switch ($element)
		{
			case 'value': { return $this->_text; }break;
			default: parent::__get($element);
		} 
	}
	
	public function getText() { return $this->_text; }
	
	protected function convertThis()
	{
		return $this->_htmlCode = $this->_text;
	}
}

?>
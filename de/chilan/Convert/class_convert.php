<?php

use de\chilan\HtmlObjects\sub,de\chilan\HtmlObjects\span,de\chilan\HtmlObjects\a,de\chilan\HtmlObjects\innerText,de\chilan\HtmlObjects\br,de\chilan\HtmlObjects\img;

class Convert //extends first
{
	public static function dateformular($var,$form,$stj,$akday = NULL,$akmonth = NULL,$akyear = NULL,$akhour = NULL,$akminute = NULL)
	{
	global $lang_january,$lang_february,$lang_march,$lang_april,$lang_may,$lang_juni,$lang_july,$lang_august,$lang_september,$lang_oktober,$lang_novenmber,$lang_dezember;


	$aus=	"<script language=\"javascript\" type=\"text/javascript\">
<!---
function changeDay$var()
{
	zus=document.$form.year$var.selectedIndex;

	switch (document.$form.month$var.selectedIndex)
	{
		case 0: anzahl=31;break;
		case 1:	if (document.$form.year$var.options[zus].text % 4 == 0){ anzahl=29; } else { anzahl=28; };break;
		case 2: anzahl=31;break;
		case 3: anzahl=30;break;
		case 4: anzahl=31;break;
		case 5: anzahl=30;break;
		case 6: anzahl=31;break;
		case 7: anzahl=31;break;
		case 8: anzahl=30;break;
		case 9: anzahl=31;break;
		case 10: anzahl=30;break;
		case 11: anzahl=31;break;
		default: anzahl=31;
	}
	vor=document.$form.day$var.selectedIndex;
	x=document.$form.day$var.length;
	for (var i=0;i<=x;i++)
	document.$form.day$var.options[0] = null;

	for (var i=1;i<=anzahl;i++)
	{
		if (i<10)
		{
			i= '0' + i;
		}
		neu= new Option(i, i);
		document.$form.day$var.options[document.$form.day$var.length]=neu;
	}
	if ((vor+1)<=anzahl)
	{
		document.$form.day$var.selectedIndex= vor;
	}

}
//-->
</script> 
<select name=\"day$var\" size=\"1\">";
	if ((empty($akyear)) || ($akyear === NULL)) $akyear=date("Y");
	if ((empty($akmonth)) || ($akmonth === NULL)) $akmonth=date("m");
	if ((empty($akhour)) || ($akhour === NULL)) $akhour=date("G");
	if ((empty($akminute)) || ($akminute === NULL)) $akminute=date("i");
	if (($akyear=='0000')&&($akmonth=='00')&&($akday=='00'))
	{
	$anzahl=31;
	$noav=7;
	$akmonth='13';
	}
			switch ($akmonth)
			{
				case 1: $anzahl=31;break;
				case 2:	if ($akyear % 4 == 0){$anzahl=29; } else { $anzahl=28; };break;
				case 3: $anzahl=31;break;
				case 4: $anzahl=30;break;
				case 5: $anzahl=31;break;
				case 6: $anzahl=30;break;
				case 7: $anzahl=31;break;
				case 8: $anzahl=31;break;
				case 9: $anzahl=30;break;
				case 10: $anzahl=31;break;
				case 11: $anzahl=30;break;
				case 12: $anzahl=31;break;
			}

	if ((empty($akday)) || ($akday === NULL)) $akday=date("d");

			for ($i=1;$i<=$anzahl;$i++)
			{
				if (strlen($i)==1) $i="0$i";
	$aus .=	"<option "; if($i==$akday) $aus .=" selected = \"selected\""; $aus .=">$i</option>";
			}
			if ($noav==7)
			{
	$aus.= 	"<option selected = \"selected\">--</option>";
			}
	$aus .=	"
</select>
<select name=\"month$var\" size=\"1\" onchange=\"changeDay$var()\">
<option value=\"01\""; if("01"==$akmonth) $aus .=" selected = \"selected\""; $aus .=">$lang_january</option>
<option value=\"02\""; if("02"==$akmonth) $aus .=" selected = \"selected\""; $aus .=">$lang_february</option>
<option value=\"03\""; if("03"==$akmonth) $aus .=" selected = \"selected\""; $aus .=">$lang_march</option>
<option value=\"04\""; if("04"==$akmonth) $aus .=" selected = \"selected\""; $aus .=">$lang_april</option>
<option value=\"05\""; if("05"==$akmonth) $aus .=" selected = \"selected\""; $aus .=">$lang_may</option>
<option value=\"06\""; if("06"==$akmonth) $aus .=" selected = \"selected\""; $aus .=">$lang_juni</option>
<option value=\"07\""; if("07"==$akmonth) $aus .=" selected = \"selected\""; $aus .=">$lang_july</option>
<option value=\"08\""; if("08"==$akmonth) $aus .=" selected = \"selected\""; $aus .=">$lang_august</option>
<option value=\"09\""; if("09"==$akmonth) $aus .=" selected = \"selected\""; $aus .=">$lang_september</option>
<option value=\"10\""; if("10"==$akmonth) $aus .=" selected = \"selected\""; $aus .=">$lang_oktober</option>
<option value=\"11\""; if("11"==$akmonth) $aus .=" selected = \"selected\""; $aus .=">$lang_novenmber</option>
<option value=\"12\""; if("12"==$akmonth) $aus .=" selected = \"selected\""; $aus .=">$lang_dezember</option>";
			if ($noav==7)
			{
	$aus.= 	"<option selected = \"selected\">-----</option>";
			}
	$aus .=	"</select><select name=\"year$var\" size=\"1\" onchange=\"changeDay$var()\">";

			for ($i=$stj;$i<=date("Y")+1;$i++)
			{
	$aus .=	"<option "; if($i==$akyear) $aus .=" selected = \"selected\""; $aus .=">$i</option>";
			}
			if ($noav==7)
			{
	$aus.= 	"<option selected =\"selected\">----</option>";
			}
	$aus .=	"</select>"; 
	$aus .= "<select name=\"hour$var\" size=\"1\">";
	for($i=0;$i<24;$i++)
	{
		if ($i<10) $i = "0$i";
		$aus .= "<option "; if ($i == $akhour) $aus .= "selected =\"selected\""; $aus .= ">$i</option>";
	}
	$aus .=	"</select>"; 
	$aus .= "<select name=\"minute$var\" size=\"1\">";
	for($i=0;$i<60;$i++)
	{
		if ($i<10) $i = "0$i";
		$aus .= "<option "; if ($i == $akminute) $aus .= "selected =\"selected\""; $aus .= ">$i</option>";
	}
	$aus .=	"</select>"; 
	
	return $aus;
	}
	
	public static function toModUrl($vars,$values,$ziele = NULL,$get = NULL)
	{
		global $_pfad, $_homepfad;
		
		if (true) //$_homepfad === "http://localhost")
		{
			if ($get === NULL)
			{
				$get = "";
			}
			if ($ziele !== NULL)
			{
				$server = preg_replace("#($_GET[target]/)(.+)\.html$#iU","$ziele/index.html",$_SERVER[REDIRECT_URL]);
			}
			else
			{
				$server = preg_replace("#($_GET[target]/)(.+)\.html$#iU","$1index.html",$_SERVER[REDIRECT_URL]);
			}

			if (is_array($vars) && is_array($values))
			{
				try 
				{
					if ((count($vars) != count($values)) || (count($vars)==0))
					{
						$error = "The Connvert Methode toModUrl muss be two strings or two eaqual length arrays!";
						throw new Exception($error);
					}
				}
				catch (Exception $e)
				{
					$var = $e->getTrace();
					die("<b>HTML Convert Fault: </b>".$e->getMessage()." in <b>".$var[1][file]."</b> on line <b>".$var[1][line]."</b>\n<br />");
				}
				
				
				for($i=0;$i<count($vars);$i++)
				{
					$get = preg_replace("#(&$vars[$i]=.*^&)|(&$vars[$i]=.)#iU","",$get);
					
					$temp = preg_replace("#".$vars[$i].",.*\.#iU","index.",$server).$get;
					
					$http1 = preg_replace("#(.+)index\.html$#iU","$1".$vars[$i].",".$values[$i].".html",$temp);
					$http2 = preg_replace("#(.+)\.html$#iU","$1,".$vars[$i].",".$values[$i].".html",$temp);
					if ($http1 == $server.$get)
					{ $http = $http2; }
					else 
					{ $http = $http1; }
					$server = $http;
				}
				return $_homepfad.$server;
			}
			else
			{
				$get = preg_replace("#(&$vars=.*^&)|(&$vars=.)#iU","",$get);
				$temp = preg_replace("#".$vars.",.*\.#iU","index.",$server).$get;

				$http1 = $_homepfad.preg_replace("#(.+)index\.html$#iU","$1".$vars.",".$values.".html",$temp);
				$http2 = $_homepfad.preg_replace("#(.+)\.html$#iU","$1,".$vars.",".$values.".html",$temp);
				
				if ($http1 == $_homepfad.$_SERVER[REDIRECT_URL].$get)
				{ $http = $http2; }
				else 
				{ $http = $http1; }
				return $http;
			}
		}
		else
		{
//print_r($_SERVER);
			$_GET[target] = str_replace(".php5","",$_GET[target]);
			if ($get === NULL)
			{
				$get = "";
			}
			if ($ziele !== NULL)
			{
				$server = preg_replace("#($_GET[target]/)(.+)\.html$#iU","$ziele/index.html",$_SERVER[REDIRECT_SCRIPT_URL]);
			}
			else
			{
				$server = preg_replace("#($_GET[target]/)(.+)\.html$#iU","$1index.html",$_SERVER[REDIRECT_SCRIPT_URL]);
			}

			if (is_array($vars) && is_array($values))
			{
				try 
				{
					if ((count($vars) != count($values)) || (count($vars)==0))
					{
						$error = "The Connvert Methode toModUrl muss be two strings or two eaqual length arrays!";
						throw new Exception($error);
					}
				}
				catch (Exception $e)
				{
					$var = $e->getTrace();
					die("<b>HTML Convert Fault: </b>".$e->getMessage()." in <b>".$var[1][file]."</b> on line <b>".$var[1][line]."</b>\n<br />");
				}
				
				
				for($i=0;$i<count($vars);$i++)
				{
					$get = preg_replace("#(&$vars[$i]=.*^&)|(&$vars[$i]=.)#iU","",$get);
					
					$temp = preg_replace("#".$vars[$i].",.*\.#iU","index.",$server).$get;
					
					$http1 = preg_replace("#(.+)index\.html$#iU","$1".$vars[$i].",".$values[$i].".html",$temp);
					$http2 = preg_replace("#(.+)\.html$#iU","$1,".$vars[$i].",".$values[$i].".html",$temp);
					if ($http1 == $server.$get)
					{ $http = $http2; }
					else 
					{ $http = $http1; }
					$server = $http;
				}
				return $_homepfad.$server;
			}
			else
			{
				$get = preg_replace("#(&$vars=.*^&)|(&$vars=.)#iU","",$get);
				$temp = preg_replace("#".$vars.",.*\.#iU","index.",$server).$get;

				$http1 = $_homepfad.preg_replace("#(.+)index\.html$#iU","$1".$vars.",".$values.".html",$temp);
				$http2 = $_homepfad.preg_replace("#(.+)\.html$#iU","$1,".$vars.",".$values.".html",$temp);
				
				if ($http1 == $_homepfad.$_SERVER[REDIRECT_SCRIPT_URL].$get)
				{ $http = $http2; }
				else 
				{ $http = $http1; }
				return $http;
			}
		}
	}
	public static function stdSeitenzahl($anzahl,&$offset = NULL,$proseite = 30,$get = NULL)
	{ 
		global $lang_site;
		if ($get === NULL)
		{
			$get = "?".$_SERVER[QUERY_STRING];
		}
		$get = preg_replace("#(&page=.*^&)|(&page=.)#iU","",$get);
		
		$start  = isset($_GET['page'])?(int)$_GET['page']:1;
		try 
		{
			if (empty($proseite) ||($proseite === 0) || (!(is_numeric($proseite))))
			{
				$error = "This Methode need on position 2 a numeric value!";
				throw new Exception($error);
			}
		}
		catch (Exception $e)
		{
			$var = $e->getTrace();
			die("<b>HTML Convert Fault: </b>".$e->getMessage()." in <b>".$var[1][file]."</b> on line <b>".$var[1][line]."</b>\n<br />");
		}
		
		$num_pages = ceil($anzahl/$proseite);
		if(!$num_pages)
		{
			$num_pages = 1;
		}
		if($start < 1) 
		{
			$start = 1;
		}
		if($start > $num_pages)
		{
			$start = $num_pages;
		}
		$offset = ($start - 1) * $proseite;

		$div = new span();
		$div->class = "seitenzahlen";

		if($num_pages > 1)
		{
			for($i = 1; $i <= $num_pages; $i++)
			{
				if($i == $start)
				{
					$div->text = $lang_site.$i."\n";
				}
				else
				{
					if ($num_pages>10)
					{
						if (($i>$num_pages-3)||($i<=3)||($i==$start+1)||($i==$start-1))
						{
							$a = new a("$get&page=$i",NULL,$lang_site.$i);
							$div->insertRaw($a);
							unset($a);
							//$div->text = "<a href=\"$ziel&amp;page=".$i."\">\n";
							//$div->text = $i."\n";
							//$div->text = "</a>\n";
						}
					}
					else
					{
						$a = new a("$get&page=$i",NULL,$lang_site.$i);
						$div->insertRaw($a);
						unset($a);
						//$div->text = "<a href=\"$ziel&amp;page=".$i."\">\n";
						//$div->text = $i."\n";
						//$div->text = "</a>\n";
					}

				}
				if ($num_pages>10)
				{
					if (($i==4)||($i==$num_pages-3))
					{
						if (($i==4)&&($start>=6))
						$div->text = "...";
						if (($i==$num_pages-3)&&($start<=$num_pages-6))
						$div->text = "...";
					}
				}

			}
		}
		else
		{
			$div->text = $lang_site."1";
		}
		
		return $div;
	}
	
	public static function modSeitenzahl($anzahl,$extra = NULL,&$offset = NULL,$proseite = 30,$get = NULL)
	{
		global $_pfad, $_homepfad;
		
		if (true) //$_homepfad === "http://localhost")
		{
			if ($get === NULL)
			{
				$get = "";
			}
			$get = preg_replace("#(&page=.*^&)|(&page=.)#iU","",$get);
			
			$start  = isset($_GET['page'])?(int)$_GET['page']:1;
			try 
			{
				if (empty($proseite) ||($proseite === 0) || (!(is_numeric($proseite))))
				{
					$error = "This Methode need on position 2 a numeric value!";
					throw new Exception($error);
				}
			}
			catch (Exception $e)
			{
				$var = $e->getTrace();
				die("<b>HTML Convert Fault: </b>".$e->getMessage()." in <b>".$var[1][file]."</b> on line <b>".$var[1][line]."</b>\n<br />");
			}
			
			$num_pages = ceil($anzahl/$proseite);
			if(!$num_pages)
			{
				$num_pages = 1;
			}
			if($start < 1) 
			{
				$start = 1;
			}
			if($start > $num_pages)
			{
				$start = $num_pages;
			}
			$offset = ($start - 1) * $proseite;

			$div = array();
			//$div->class = "seitenzahlen";

			if($num_pages > 1)
			{
				for($i = 1; $i <= $num_pages; $i++)
				{
					
					if($i == $start)
					{
						$div[$i] = new span($extra.$i);
					}
					else
					{
						$temp = preg_replace("#page,.*\.#iU","index.",$_SERVER[REDIRECT_URL]);
						$http1 = $_homepfad.preg_replace("#(.+)index\.html$#iU","$1page,$i.html",$temp).$get;
						$http2 = $_homepfad.preg_replace("#(.+)\.html$#iU","$1,page,$i.html",$temp).$get;
						if ($http1 == $_homepfad.$_SERVER[REDIRECT_URL].$get)
						{ $http = $http2; }
						else 
						{ $http = $http1; }
						
						if ($num_pages>10)
						{
							if (($i>$num_pages-3)||($i<=3)||($i==$start+1)||($i==$start-1))
							{
								$div[$i] = new a($http,NULL,$extra.$i);
							}
						}
						else
						{
							$div[$i] = new a($http,NULL,$extra.$i);
						}

					}
					if ($num_pages>10)
					{
						if (($i==4)||($i==$num_pages-3))
						{
							if ($i==4) { $x = $start-2; }
							if ($i==$num_pages-3) { $x = $start+2; }
							$temp = preg_replace("#page,.*\.#iU","index.",$_SERVER[REDIRECT_SCRIPT_URL]);
							$http1 = $_homepfad.preg_replace("#(.+)index\.html$#iU","$1page,$x.html",$temp).$get;
							$http2 = $_homepfad.preg_replace("#(.+)\.html$#iU","$1,page,$x.html",$temp).$get;
							if ($http1 == $_homepfad.$_SERVER[REDIRECT_SCRIPT_URL].$get)
							{ $http = $http2; }
							else 
							{ $http = $http1; }
							
							if (($i==4)&&($start>=6))
							$div[$i] = new a($http,NULL,"...");
							if (($i==$num_pages-3)&&($start<=$num_pages-5))
							$div[$i] = new a($http,NULL,"...");
						}
					}

				}
			}
			else
			{
				$div[0] = new span($extra."1");
			}
			
			return $div;

		}
		else
		{
			if ($get === NULL)
			{
				$get = "";
			}
			$get = preg_replace("#(&page=.*^&)|(&page=.)#iU","",$get);
			
			$start  = isset($_GET['page'])?(int)$_GET['page']:1;
			try 
			{
				if (empty($proseite) ||($proseite === 0) || (!(is_numeric($proseite))))
				{
					$error = "This Methode need on position 2 a numeric value!";
					throw new Exception($error);
				}
			}
			catch (Exception $e)
			{
				$var = $e->getTrace();
				die("<b>HTML Convert Fault: </b>".$e->getMessage()." in <b>".$var[1][file]."</b> on line <b>".$var[1][line]."</b>\n<br />");
			}
			
			$num_pages = ceil($anzahl/$proseite);
			if(!$num_pages)
			{
				$num_pages = 1;
			}
			if($start < 1) 
			{
				$start = 1;
			}
			if($start > $num_pages)
			{
				$start = $num_pages;
			}
			$offset = ($start - 1) * $proseite;

			$div = array();
			//$div->class = "seitenzahlen";

			if($num_pages > 1)
			{
				for($i = 1; $i <= $num_pages; $i++)
				{
					
					if($i == $start)
					{
						$div[$i] = new span($extra.$i);
					}
					else
					{
						$temp = preg_replace("#page,.*\.#iU","index.",$_SERVER[REDIRECT_SCRIPT_URL]);
						$http1 = $_homepfad.preg_replace("#(.+)index\.html$#iU","$1page,$i.html",$temp).$get;
						$http2 = $_homepfad.preg_replace("#(.+)\.html$#iU","$1,page,$i.html",$temp).$get;
						if ($http1 == $_homepfad.$_SERVER[REDIRECT_SCRIPT_URL].$get)
						{ $http = $http2; }
						else 
						{ $http = $http1; }
						
						if ($num_pages>10)
						{
							if (($i>$num_pages-3)||($i<=3)||($i==$start+1)||($i==$start-1))
							{
								$div[$i] = new a($http,NULL,$extra.$i);
							}
						}
						else
						{
							$div[$i] = new a($http,NULL,$extra.$i);
						}

					}
					if ($num_pages>10)
					{
						if (($i==4)||($i==$num_pages-3))
						{
							if ($i==4) { $x = $start-2; }
							if ($i==$num_pages-3) { $x = $start+2; }
							$temp = preg_replace("#page,.*\.#iU","index.",$_SERVER[REDIRECT_SCRIPT_URL]);
							$http1 = $_homepfad.preg_replace("#(.+)index\.html$#iU","$1page,$x.html",$temp).$get;
							$http2 = $_homepfad.preg_replace("#(.+)\.html$#iU","$1,page,$x.html",$temp).$get;
							if ($http1 == $_homepfad.$_SERVER[REDIRECT_SCRIPT_URL].$get)
							{ $http = $http2; }
							else 
							{ $http = $http1; }
							
							if (($i==4)&&($start>=6))
							$div[$i] = new a($http,NULL,"...");
							if (($i==$num_pages-3)&&($start<=$num_pages-5))
							$div[$i] = new a($http,NULL,"...");
						}
					}

				}
			}
			else
			{
				$div[0] = new span($extra."1");
			}
			
			return $div;
		}
	}
	
/*	public static function bbCode($x)
	{
		global $_pfad, $_homepfad;
		$array[0] = $x;
		$i=0;
		$posA = strpos($x,"[");
		$posE = strpos($x,"]");
		while (($posA !== false) && ($posE !== false))
		{

			$array[$i] = substr($x,0,$posA);
			$x = substr($x,$posA);
			$vergleich = substr($x,1,($posE-$posA)-1);
			
			$vergleich = explode("||",$vergleich);
			$setzer = strpos($vergleich[1],"[/".$vergleich[0]);

			if (($setzer === false) && ($posA < $posE) && (in_array($vergleich[0],array("b","i","del","code","small","sub","sup","q","ins","url","h1","h2","h3","h4","h5","h6","img","youtube")) || in_array($vergleich[0],array(":)",";)","8)",":(","^^","?("))) && (!(isset($vergleich[2]))))
			{
				$i++;

				$posX = strpos($x,"[".$vergleich[0]."]")+strlen($vergleich[0])+2;
				$posY = strpos($x,"[/".$vergleich[0]."]");

				if ($posY === false || $posX === false)
				{
					if (in_array($vergleich[0],array(":)",";)","8)",":(","^^","?(")))
					{
						$y = array_search($vergleich[0],array(":)",";)","8)",":(","^^","?("));
						$x = substr($x,$posY+strlen($vergleich[0])+2);
						$array[$i] = new img($_pfad."gfx/$y.gif",$vergleich[0]);	
					}
					else
					{
						if ($posY === false)
						{
							$zw = strpos($x,"]");
							$zwischen = substr($x,0,$zw+1);
							$x = substr($x,$zw+1);
								
							$zwischen = str_replace("[","",$zwischen);
							$zwischen = str_replace("]","",$zwischen);
							
							$x = $zwischen.$x;
						}
					}
					
				}
				else
				{
					if (($vergleich[1] != "") && (in_array($vergleich[0],array("img","url","q"))))
					{
						switch ($vergleich[0])
						{
							case 'img': 
							{
								$speicher = substr($x,$posX+strlen($vergleich[1])+2,$posY-(($posX+strlen($vergleich[1])+2)));
								$array[$i] = new img($speicher,$vergleich[1]);
								$array[$i]->style = "float: left;";
							}break;
							case 'url':
							{
								$speicher = substr($x,$posX+strlen($vergleich[1])+2,$posY-(($posX+strlen($vergleich[1])+2)));
								$vergleich[1] = str_replace("&","&amp;",$vergleich[1]);
								$array[$i] = new a($vergleich[1],NULL,$speicher);
								$array[$i]->title = "Klicke hier und verlasse die Seite";
if ($vergleich[1] == "http://technorati.com/claim/a5axa9zde8") $array[$i]->rel = "me";
							}break;
							case 'q':
							{
								$speicher = substr($x,$posX+strlen($vergleich[1])+2,$posY-(($posX+strlen($vergleich[1])+2)));
								$array[$i] = new q($speicher);
								$array[$i]->cite = $vergleich[1];
							}break;
							default:
							{
								$speicher = Convert::bbCode($speicher = substr($x,$posX+strlen($vergleich[1])+2,$posY-(($posX+strlen($vergleich[1])+2))));
								$array[$i] = new $vergleich[0]($speicher,$vergleich[1]);
							}break;
						}
						$x = substr($x,$posY+strlen($vergleich[0])+3);
					}
					else
					{
						$speicher = str_replace("[$vergleich[0]||$vergleich[1]]","[$vergleich[0]]",$x);
						$posS = strpos($speicher,"[".$vergleich[0]."]")+strlen($vergleich[0])+2;
						$posP = strpos($speicher,"[/".$vergleich[0]."]");
											
						
						switch ($vergleich[0])
						{
							case 'youtube': 
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$array[$i] = new object();
								$array[$i]->width = 425;
								$array[$i]->height = 350;
								$array[$i]->insertnonconvert("<param name=\"movie\" value=\"".$speicher."&hl=de_DE&fs=1&color1=0x3a3a3a&color2=0x999999\"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\"".$speicher."&hl=de_DE&fs=1&color1=0x3a3a3a&color2=0x999999\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width="425" height="350"></embed>");

							}break;
							case 'img': 
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$array[$i] = new img($speicher,$speicher);
							}break;
							case 'url':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$speicher = str_replace("&","&amp;",$speicher);
								$array[$i] = new a($speicher,NULL,$speicher);
								$array[$i]->title = "Klicke hier und verlasse die Seite";
							}break;
							case 'h1':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$array[$i] = new $vergleich[0]($speicher);
							}break;
							case 'h2':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$array[$i] = new $vergleich[0]($speicher);
							}break;
							case 'h3':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$array[$i] = new $vergleich[0]($speicher);
							}break;
							case 'h4':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$array[$i] = new $vergleich[0]($speicher);
							}break;
							case 'h5':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$array[$i] = new $vergleich[0]($speicher);
							}break;
							case 'h6':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$array[$i] = new $vergleich[0]($speicher);
							}break;
							default:
							{
								$speicher = Convert::bbCode(substr($speicher,$posS,$posP-$posS));
								$array[$i] = new $vergleich[0]($speicher);
							}break;
						}
						$x = substr($x,$posY+strlen($vergleich[0])+3);
					}
				}
			}
			else
			{
				$x = $array[$i].$x;
				
				if ($posE < $posA)
				{
					$x1 = substr($x,0,$posE);
					$x2 = substr($x,$posE+1);
					$x = $x1."".$x2; 
				}
				else
				{
					$x1 = substr($x,0,$posA);
					$x2 = substr($x,$posA+1);
					$x = $x1."".$x2;
				}
				$i--;		
			//echo "2X: $x /// Vergleich: $vergleich<br />";				
			}
			$posA = strpos($x,"[");
			$posE = strpos($x,"]");
			
			$i++;
			$array[$i] = $x;
			//if ($i>100) {echo "schwerer Fehler";break;}
		}
		$array[$i] = str_replace("]","",$array[$i]);
		$array[$i] = str_replace("[","",$array[$i]);
		
		for ($ii=0 ; $ii<count($array);$ii++)
		{
			if (!(is_object($array[$ii])))
			{
				$array[$ii] = str_replace("","]",$array[$ii]);
				$array[$ii] = str_replace("","[",$array[$ii]);
			}
		}
		
		return $array;
	}
*/
	public static function bbLightCode($x)
	{
		global $_pfad, $_homepfad;
		$array[0] = $x;
		$i=0;
		$posA = strpos($x,"[");
		$posE = strpos($x,"]");
		while (($posA !== false) && ($posE !== false))
		{

			$array[$i] = substr($x,0,$posA);
			$x = substr($x,$posA);
			$vergleich = substr($x,1,($posE-$posA)-1);
			
			$vergleich = explode("||",$vergleich);
			$setzer = strpos($vergleich[1],"[/".$vergleich[0]);

			if (($setzer === false) && ($posA < $posE) && (in_array($vergleich[0],array("b","i","del","code","small","sub","sup","ins")) || in_array($vergleich[0],array(":)",";)","8)",":(","^^","?("))) && (!(isset($vergleich[2]))))
			{
				$i++;

				$posX = strpos($x,"[".$vergleich[0]."]")+strlen($vergleich[0])+2;
				$posY = strpos($x,"[/".$vergleich[0]."]");

				if ($posY === false || $posX === false)
				{
					if (in_array($vergleich[0],array(":)",";)","8)",":(","^^","?(")))
					{
						$y = array_search($vergleich[0],array(":)",";)","8)",":(","^^","?("));
						$x = substr($x,$posY+strlen($vergleich[0])+2);
						$array[$i] = new img($_pfad."gfx/$y.gif",$vergleich[0]);	
					}
					else
					{
						if ($posY === false)
						{
							$zw = strpos($x,"]");
							$zwischen = substr($x,0,$zw+1);
							$x = substr($x,$zw+1);
								
							$zwischen = str_replace("[","",$zwischen);
							$zwischen = str_replace("]","",$zwischen);
							
							$x = $zwischen.$x;
						}
					}
					
				}
				else
				{
					if (($vergleich[1] != "") && (in_array($vergleich[0],array("img","url","q"))))
					{
						switch ($vergleich[0])
						{
							case 'img': 
							{
								$speicher = substr($x,$posX+strlen($vergleich[1])+2,$posY-(($posX+strlen($vergleich[1])+2)));
								$array[$i] = new img($speicher,$vergleich[1]);
							}break;
							case 'url':
							{
								$speicher = substr($x,$posX+strlen($vergleich[1])+2,$posY-(($posX+strlen($vergleich[1])+2)));
								$array[$i] = new a($vergleich[1],NULL,$speicher);
								$array[$i]->title = "Klicke hier und verlasse die Seite";
							}break;
							case 'q':
							{
								$speicher = substr($x,$posX+strlen($vergleich[1])+2,$posY-(($posX+strlen($vergleich[1])+2)));
								$array[$i] = new q($speicher);
								$array[$i]->cite = $vergleich[1];
							}break;
							default:
							{
								$speicher = Convert::bbLightCode($speicher = substr($x,$posX+strlen($vergleich[1])+2,$posY-(($posX+strlen($vergleich[1])+2))));
								$vergleich[0] = "de\\chilan\\HtmlObjects\\".$vergleich[0];
								$array[$i] = new $vergleich[0]($speicher,$vergleich[1]);
							}break;
						}
						$x = substr($x,$posY+strlen($vergleich[0])+3);
					}
					else
					{
						$speicher = str_replace("[$vergleich[0]||$vergleich[1]]","[$vergleich[0]]",$x);
						$posS = strpos($speicher,"[".$vergleich[0]."]")+strlen($vergleich[0])+2;
						$posP = strpos($speicher,"[/".$vergleich[0]."]");
						switch ($vergleich[0])
						{
							case 'img': 
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$array[$i] = new img($speicher,$speicher);
							}break;
							case 'url':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$array[$i] = new a($speicher,NULL,$speicher);
								$array[$i]->title = "Klicke hier und verlasse die Seite";
							}break;
							case 'h1':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$vergleich[0] = "de\\chilan\\HtmlObjects\\".$vergleich[0];
								$array[$i] = new $vergleich[0]($speicher);
							}break;
							case 'h2':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$vergleich[0] = "de\\chilan\\HtmlObjects\\".$vergleich[0];
								$array[$i] = new $vergleich[0]($speicher);
							}break;
							case 'h3':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$vergleich[0] = "de\\chilan\\HtmlObjects\\".$vergleich[0];
								$array[$i] = new $vergleich[0]($speicher);
							}break;
							case 'h4':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$vergleich[0] = "de\\chilan\\HtmlObjects\\".$vergleich[0];
								$array[$i] = new $vergleich[0]($speicher);
							}break;
							case 'h5':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$vergleich[0] = "de\\chilan\\HtmlObjects\\".$vergleich[0];
								$array[$i] = new $vergleich[0]($speicher);
							}break;
							case 'h6':
							{
								$speicher = substr($speicher,$posS,$posP-$posS);
								$vergleich[0] = "de\\chilan\\HtmlObjects\\".$vergleich[0];
								$array[$i] = new $vergleich[0]($speicher);
							}break;
							default:
							{
								$speicher = Convert::bbLightCode(substr($speicher,$posS,$posP-$posS));
								$vergleich[0] = "de\\chilan\\HtmlObjects\\".$vergleich[0];
								$array[$i] = new $vergleich[0]($speicher);
								
							}break;
						}
						$x = substr($x,$posY+strlen($vergleich[0])+3);
					}
				}
			}
			else
			{
				$x = $array[$i].$x;
				
				if ($posE < $posA)
				{
					$x1 = substr($x,0,$posE);
					$x2 = substr($x,$posE+1);
					$x = $x1."".$x2; 
				}
				else
				{
					$x1 = substr($x,0,$posA);
					$x2 = substr($x,$posA+1);
					$x = $x1."".$x2;
				}
				$i--;		
			//echo "2X: $x /// Vergleich: $vergleich<br />";				
			}
			$posA = strpos($x,"[");
			$posE = strpos($x,"]");
			
			$i++;
			$array[$i] = $x;
			//if ($i>100) {echo "schwerer Fehler";break;}
		}
		$array[$i] = str_replace("]","",$array[$i]);
		$array[$i] = str_replace("[","",$array[$i]);
		
		for ($ii=0 ; $ii<count($array);$ii++)
		{
			if (!(is_object($array[$ii])))
			{
				$array[$ii] = str_replace("","]",$array[$ii]);
				$array[$ii] = str_replace("","[",$array[$ii]);
			}
		}
		
		return $array;
	}
	
	public static function ArrayToString($array)
	{
		$str = "";
		if (is_array($array))
		{
			foreach($array as $temp)
			{
				if (is_array($temp))
				{
					$str .= Convert::ArrayToString($temp);
				}
				elseif (is_object($temp))
				{
					$str .= $temp->getHTML();
				}
				else
				{
					$str .= $temp;
				}
			}
		}
		elseif (is_object($array))
		{
			$str .= $array->getHTML();
		}
		else
		{
			$str = $array;
		}
	
		return $str;
	}
	
	public static function Bewertung($gesamtpunkte,$anzahlbewertungen)
	{
		if ($anzahlbewertungen == 0)
		{
			return false;
		}
		else
		{
			$durchschnitt = $gesamtpunkte / $anzahlbewertungen;
			$durchschnitt = round($durchschnitt,2);
			$abfrage = round($durchschnitt);
			
			switch ($abfrage)
			{
				case 0: $string = "Grauenhaft";break;
				case 1: $string = "Mißerabel";break;
				case 2: $string = "Sehr schlecht";break;
				case 3: $string = "Schlecht";break;
				case 4: $string = "Geht so";break;
				case 5: $string = "Durchschnitt";break;
				case 6: $string = "In Ordnung";break;
				case 7: $string = "Gut";break;
				case 8: $string = "Sehr Gut";break;
				case 9: $string = "Hervorragend";break;
				case 10: $string = "Außgezeichnet";break;
			}
			
			$rueckgabe[punkte] = $durchschnitt;
			$rueckgabe[wort] = $string;
			
			return $rueckgabe;
		}
	}
	public static function bbCodeToStringSimple($string)
	{
		$vergleich = array("[b]","[/b]","[i]","[/i]","[del]","[/del]","[code]","[/code]","[small]","[/small]","[sub]","[/sub]","[sup]","[/sup]","[q]","[/q]","[ins]","[/ins]","[url]","[/url]","[h1]","[/h1]","[h2]","[/h2]","[h3]","[/h3]","[h4]","[/h4]","[h5]","[/h5]","[h6]","[/h6]","[img]","[/img]","[youtube]","[/youtube]");
		foreach ($vergleich as $value)
		{
			$string = str_replace($value,"",$string);
		}
		return $string;
	}
	public function __set ($element,$x)
	{
		switch ($element)
		{
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
	
	protected function connvertThis()
	{
		$this->fertig = $this->temp;
	}
	
	public static function bbCode($x)
	{
		global $_pfad, $_homepfad;
		
		$x = str_replace("\n","<br />",$x);
		
	$x = str_replace("$$$",$_pfad,$x);
		
        $x = preg_replace("#\[b\](.*)\[/b\]#Uis","<b>$1</b>",$x);
       
        $x = preg_replace("#\[i\](.*)\[/i\]#Uis","<i>$1</i>",$x);
		$x = preg_replace("#\[del\](.*)\[/del\]#Uis","<del>$1</del>",$x);
		$x = preg_replace("#\[code\](.*)\[/code\]#Uis","<code>$1</code>",$x);
		$x = preg_replace("#\[small\](.*)\[/small\]#Uis","<small>$1</small>",$x);
		$x = preg_replace("#\[sub\](.*)\[/sub\]#Uis","<sub>$1</sub>",$x);
		$x = preg_replace("#\[sup\](.*)\[/sup\]#Uis","<sup>$1</sup>",$x);
		$x = preg_replace("#\[ins\](.*)\[/ins\]#Uis","<ins>$1</ins>",$x);
		$x = preg_replace("#\[q\](.*)\[/q\]#Uis","<q>$1</q>",$x);
		$x = preg_replace("#\[q\|\|(.*)\](.*)\[/q\]#Uis","<q cite=\"$1\">$2</q>",$x);
        $x = preg_replace("#\[url\](.*)\[/url\]#Uis","<a title=\"Klicken Sie hier und verlassen Sie diese Seite\" href=\"$1\" $style>$1</a>",$x);
        $x = preg_replace("#\[url\|\|(.*)\](.*)\[/url\]#Uis","<a title=\"Klicken Sie hier und verlassen Sie diese Seite\" href=\"$1\" $style>$2</a>",$x);
        $x = preg_replace("#\[img\](.*)\[/img\]#Uis","<img alt=\"$1\" src=\"$1\">",$x);
		$x = preg_replace("#\[url\|\|(.*)\](.*)\[/url\]#Uis","<a href=\"$1\" $style>$2</a>",$x);
		
		$x = preg_replace("#\[img\|\|(.*)\](.*)\[/img\]#Uis","<img alt=\"$1\" src=\"$2\" />",$x);
		$x = preg_replace("#\[img\](.*)\[/img\]#Uis","<img alt=\"$1\" src=\"$1\" />",$x);
		
		$x = preg_replace("#\[img_right\|\|(.*)\](.*)\[/img_right\]#Uis","<img alt=\"$1\" src=\"$2\" style=\"float: right;\" />",$x);
		$x = preg_replace("#\[img_right\](.*)\[/img_right\]#Uis","<img alt=\"$1\" src=\"$1\" style=\"float: right;\" />",$x);

		$x = preg_replace("#\[img_left\|\|(.*)\](.*)\[/img_left\]#Uis","<img alt=\"$1\" src=\"$2\" style=\"float: left;\" />",$x);
		$x = preg_replace("#\[img_left\](.*)\[/img_left\]#Uis","<img alt=\"$1\" src=\"$1\" style=\"float: left;\" />",$x);
		
		$x = preg_replace("#\[h1\](.*)\[/h1\]#Uis","<h1>$1</h1>",$x);
		$x = preg_replace("#\[h2\](.*)\[/h2\]#Uis","<h2>$1</h2>",$x);
		$x = preg_replace("#\[h3\](.*)\[/h3\]#Uis","<h3>$1</h3>",$x);
		$x = preg_replace("#\[h4\](.*)\[/h4\]#Uis","<h4>$1</h4>",$x);
		$x = preg_replace("#\[h5\](.*)\[/h5\]#Uis","<h5>$1</h5>",$x);
		$x = preg_replace("#\[h6\](.*)\[/h6\]#Uis","<h6>$1</h6>",$x);
		
		$convar = substr(md5(microtime()),0,8);
		$x = preg_replace("#\[youtube\](.*)\[/youtube\]#Uis","<object height=\"350\" width=\"450\" ><param name=\"movie\" value=\"$1&hl=de_DE&fs=1&color1=0x3a3a3a&color2=0x999999\"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\"$1&hl=de_DE&fs=1&color1=0x3a3a3a&color2=0x999999\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"450\" height=\"350\"></embed></object>",$x);
		$x = preg_replace("#\[video\](.*)\[/video\]#Uis","<div id=\"container".$convar."\"><a href=\"http://www.macromedia.com/go/getflashplayer\">Get the Flash Player</a> to see this player.</div><script type=\"text/javascript\" src=\"".$_homepfad."/swfobject.js\"></script><script type=\"text/javascript\">
		var s1 = new SWFObject(\"".$_homepfad."/player.swf\",\"ply\",\"500\",\"375\",\"9\",\"#FFFFFF\");
		s1.addParam(\"allowfullscreen\",\"true\");
		s1.addParam(\"allowscriptaccess\",\"always\");
		s1.addParam(\"flashvars\",\"file=$1\");
		s1.write(\"container$convar\");
		</script>",$x);
		$x = preg_replace("#\[video_small\](.*)\[/video_small\]#Uis","<div id=\"container$convar\"><a href=\"http://www.macromedia.com/go/getflashplayer\">Get the Flash Player</a> to see this player.</div><script type=\"text/javascript\" src=\"".$_homepfad."/swfobject.js\"></script><script type=\"text/javascript\">
		var s1 = new SWFObject(\"".$_homepfad."/player.swf\",\"ply\",\"150\",\"125\",\"9\",\"#FFFFFF\");
		s1.addParam(\"allowfullscreen\",\"true\");
		s1.addParam(\"allowscriptaccess\",\"always\");
		s1.addParam(\"flashvars\",\"file=$1\");
		s1.write(\"container$convar\");
		</script>",$x);

		$x = str_replace("[:)]", "<img src=\"".$_pfad."gfx/0.gif\" alt=\":)\" />", $x);
        $x = str_replace("[;)]", "<img src=\"".$_pfad."gfx/1.gif\" alt=\";)\" />", $x);
        $x = str_replace("[8)]", "<img src=\"".$_pfad."gfx/2.gif\" alt=\"8)\" />", $x);
		$x = str_replace("[:(]", "<img src=\"".$_pfad."gfx/3.gif\" alt=\":(\" />", $x);
		$x = str_replace("[^^]", "<img src=\"".$_pfad."gfx/4.gif\" alt=\"^^\" />", $x);
		$x = str_replace("[?(]", "<img src=\"".$_pfad."gfx/5.gif\" alt=\"?(\" />", $x);
		
		$code = new innerText();
		$code->writeHTML(str_replace("&","&amp;amp;",$x));
		//$code->writeHTML($x);
		
		return $code;
	}
	
	 public static function bot_erkennung($user_agent)
	 {
		$user_agent=strtolower($user_agent);
		
		if (substr_count($user_agent,"bot")>0) return true;
		if (substr_count($user_agent,"spider")>0) return true; 
		if (substr_count($user_agent,"spyder")>0) return true;
		if (substr_count($user_agent,"crawl")>0) return true;
		if (substr_count($user_agent,"robo")>0) return true;
		if (substr_count($user_agent,"agentname")>0) return true; 
		if (substr_count($user_agent,"altaVista intranet")>0) return true;
		if (substr_count($user_agent,"appie")>0) return true;
		if (substr_count($user_agent,"arachnoidea")>0) return true; 
		if (substr_count($user_agent,"asterias")>0) return true;
		if (substr_count($user_agent,"beholder")>0) return true;
		if (substr_count($user_agent,"bumblebee")>0) return true; 
		if (substr_count($user_agent,"cherrypicker")>0) return true;
		if (substr_count($user_agent,"cosmos")>0) return true;
		if (substr_count($user_agent,"openxxx")>0) return true; 
		if (substr_count($user_agent,"fido")>0) return true;
		if (substr_count($user_agent,"crescent")>0) return true;
		if (substr_count($user_agent,"emailsiphon")>0) return true; 
		if (substr_count($user_agent,"emailwolf")>0) return true;
		if (substr_count($user_agent,"extractorpro")>0) return true;
		if (substr_count($user_agent,"gazz")>0) return true; 
		if (substr_count($user_agent,"gigabaz")>0) return true;
		if (substr_count($user_agent,"gulliver")>0) return true;
		if (substr_count($user_agent,"hcat")>0) return true;
		if (substr_count($user_agent,"hloader")>0) return true;
		if (substr_count($user_agent,"homepagesearch")>0) return true;
		if (substr_count($user_agent,"htdig")>0) return true; 
		if (substr_count($user_agent,"httpglooton")>0) return true;
		if (substr_count($user_agent,"ia_archiver")>0) return true;
		if (substr_count($user_agent,"incywincy")>0) return true; 
		if (substr_count($user_agent,"infoseek")>0) return true;
		if (substr_count($user_agent,"inktomi")>0) return true;
		if (substr_count($user_agent,"link")>0) return true;
		if (substr_count($user_agent,"internetami")>0) return true;
		if (substr_count($user_agent,"internetseer")>0) return true;
		if (substr_count($user_agent,"scan")>0) return true; 
		if (substr_count($user_agent,"fireball")>0) return true;
		if (substr_count($user_agent,"larbin")>0) return true;
		if (substr_count($user_agent,"libweb")>0) return true; 
		if (substr_count($user_agent,"trivial")>0) return true;
		if (substr_count($user_agent,"mata hari")>0) return true;
		if (substr_count($user_agent,"medicalmatrix")>0) return true; 
		if (substr_count($user_agent,"mercator")>0) return true;
		if (substr_count($user_agent,"miixpc")>0) return true;
		if (substr_count($user_agent,"moget")>0) return true;
		if (substr_count($user_agent,"muscatferret")>0) return true;
		if (substr_count($user_agent,"slurp")>0) return true;
		if (substr_count($user_agent,"quosa")>0) return true;
		if (substr_count($user_agent,"scooter")>0) return true;
		if (substr_count($user_agent,"sly")>0) return true;
		if (substr_count($user_agent,"webbandit")>0) return true;
		if (substr_count($user_agent,"spy")>0) return true; 
		if (substr_count($user_agent,"wisewire")>0) return true;
		if (substr_count($user_agent,"ultraseek")>0) return true;
		if (substr_count($user_agent,"piranha")>0) return true; 
		if (substr_count($user_agent,"t-h-u-n-d-e-r-s-t-o-n-e")>0) return true;
		if (substr_count($user_agent,"indy library")>0) return true;
		if (substr_count($user_agent,"ezresult")>0) return true; 
		if (substr_count($user_agent,"informant")>0) return true;
		if (substr_count($user_agent,"swisssearch")>0) return true;
		if (substr_count($user_agent,"sqworm")>0) return true; 
		if (substr_count($user_agent,"ask jeeves")>0) return true;
		if (substr_count($user_agent,"googlebot")>0) return true;


		if (substr_count($user_agent,"seekport")>0) return true; 
		if (substr_count($user_agent,"tamu crawler")>0) return true;
		if (substr_count($user_agent,"w3c validator")>0) return true;
		if (substr_count($user_agent,"w3c_validator")>0) return true;
		if (substr_count($user_agent,"findlinks")>0) return true; 
		if (substr_count($user_agent,"picsearch")>0) return true;
		if (substr_count($user_agent,"voila")>0) return true;
		if (substr_count($user_agent,"gigablast")>0) return true; 
		if (substr_count($user_agent,"technorati")>0) return true;
		if (substr_count($user_agent,"robot")>0) return true;
		if (substr_count($user_agent,"entireweb")>0) return true; 
		if (substr_count($user_agent,"speedy spider")>0) return true;
		if (substr_count($user_agent,"google-sitemaps")>0) return true;
		if (substr_count($user_agent,"gigabot")>0) return true; 
		if (substr_count($user_agent,"tmCrawler")>0) return true;
		if (substr_count($user_agent,"msnbot")>0) return true;
		if (substr_count($user_agent,"voilabot")>0) return true; 
		if (substr_count($user_agent,"technoratibot")>0) return true;
		if (substr_count($user_agent,"python-url")>0) return true;
		if (substr_count($user_agent,"ms url control")>0) return true; 
		if (substr_count($user_agent,"ms-webdav")>0) return true;
		if (substr_count($user_agent,"wwwster")>0) return true;
		if (substr_count($user_agent,"alexa")>0) return true; 
		if (substr_count($user_agent,"majestic-12")>0) return true;
		if (substr_count($user_agent,"mirago")>0) return true;
		if (substr_count($user_agent,"entireweb")>0) return true; 
		if (substr_count($user_agent,"goo")>0) return true;
		if (substr_count($user_agent,"csscheck")>0) return true;
		if (substr_count($user_agent,"libwww")>0) return true;
		if (substr_count($user_agent,"jakarta commons")>0) return true;

		return false;
	} 
	
	public static function VarsToLog($var)
	{
		if (is_array($var))
		{
			$str .= " Array(";
			foreach($var as $key => $value)
			{
				if (is_array($value))
				{
					$str .= " $key =>";
					Convert::VarsToLog($value);
				}
				else
				{
					$str .= " [$key]=>$value";
				}
			}
			$str .= ")";
		}
		return $str;
	}
}

?>
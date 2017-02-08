<?php

/*
+---------------------------------------------------------------------------+
| Revive Adserver                                                           |
| http://www.revive-adserver.com                                            |
|                                                                           |
| Copyright: See the COPYRIGHT.txt file.                                    |
| License: GPLv2 or later, see the LICENSE.txt file.                        |
+---------------------------------------------------------------------------+
*/

require_once MAX_PATH . '/lib/OA/Creative/File.php';

/**
 * A class to deal with uploaded creatives
 *
 */
class OA_Creative_File_RichMedia extends OA_Creative_File
{
    function readCreativeDetails($fileName, $aTypes = null,$fileName)
    {
		
		if ( strpos( $fileName, ".html")> -1)  {
			$this->contentType = "htm";
			
			$upos = strrpos( $fileName, "_")+1;

			if ($upos > 1)
			{
				$size = substr($fileName,$upos,10);

				$upos1 = strpos( $size, "-")+1;
				$upos2 = strpos( $size, ".");

				$w = substr($size,0, $upos1);
				$h = substr($size,$upos1,$upos2-$upos1);

				$this->width   = $w*1;
				$this->height  = $h*1;
			}

			return true;
		}
		
        return true;
    }
}

?>
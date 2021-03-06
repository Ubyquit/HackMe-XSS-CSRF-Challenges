<?php
   function BB_coder($Text)
       {
         // Replace any html brackets with HTML Entities to prevent executing HTML or script
            // Don't use strip_tags here because it breaks [url] search by replacing & with amp
            $Text = str_replace("<", "&lt;", $Text);
            $Text = str_replace(">", "&gt;", $Text);

            // Convert new line chars to html <br /> tags
            $Text = nl2br($Text);

            // Set up the parameters for a URL search string
            $URLSearchString = " a-zA-Z0-9\:\/\-\?\&\.\=\_\~\#\'";
            // Set up the parameters for a MAIL search string
            $MAILSearchString = $URLSearchString . " a-zA-Z0-9\.@";

            // Perform URL Search
            $Text = preg_replace("/\[url\]([$URLSearchString]*)\[\/url\]/", '<a href="$1" target="_blank">$1</a>', $Text);
            $Text = preg_replace("(\[url\=([$URLSearchString]*)\](.+?)\[/url\])", '<a href="$1" target="_blank">$2</a>', $Text);
        	 //$Text = preg_replace("(\[url\=([$URLSearchString]*)\]([$URLSearchString]*)\[/url\])", '<a href="$1" target="_blank">$2</a>', $Text);
            $Text = preg_replace("/\[URL\]([$URLSearchString]*)\[\/URL\]/", '<a href="$1" target="_blank">$1</a>', $Text);
            $Text = preg_replace("(\[URL\=([$URLSearchString]*)\](.+?)\[/URL\])", '<a href="$1" target="_blank">$2</a>', $Text);
        	 //$Text = preg_replace("(\[URL\=([$URLSearchString]*)\]([$URLSearchString]*)\[/URL\])", '<a href="$1" target="_blank">$2</a>', $Text);


            // Perform MAIL Search
            $Text = preg_replace("(\[mail\]([$MAILSearchString]*)\[/mail\])", '<a href="mailto:$1">$1</a>', $Text);
            $Text = preg_replace("/\[mail\=([$MAILSearchString]*)\](.+?)\[\/mail\]/", '<a href="mailto:$1">$2</a>', $Text);
         
            // Check for bold text
            $Text = preg_replace("(\[b\](.+?)\[\/b])is",'<b>$1</b>',$Text);

            // Check for strike text
            $Text = preg_replace("(\[strike\](.+?)\[\/strike])is",'<strike>$1</strike>',$Text);

            // Check for center text
            $Text = preg_replace("(\[center\](.+?)\[\/center])is",'<center>$1</center>',$Text);

            // Check for <p></p> text
            $Text = preg_replace("(\[p\](.+?)\[\/p])is",'<p>$1</p>',$Text);

            // Check for Italics text
            $Text = preg_replace("(\[i\](.+?)\[\/i\])is",'<i>$1</i>',$Text);

            // Check for Underline text
            $Text = preg_replace("(\[u\](.+?)\[\/u\])is",'<u>$1</u>',$Text);

            // Check for strike-through text
            $Text = preg_replace("(\[s\](.+?)\[\/s\])is",'<strike>$1</strike>',$Text);

            // Check for over-line text
            $Text = preg_replace("(\[o\](.+?)\[\/o\])is",'<span class="overline">$1</span>',$Text);

            // Check for colored text
            $Text = preg_replace("(\[color=(.+?)\](.+?)\[\/color\])is","<span style=\"color: $1\">$2</span>",$Text);

            // Check for sized text
            $Text = preg_replace("(\[size=(.+?)\](.+?)\[\/size\])is","<span style=\"font-size: $1px\">$2</span>",$Text);

            // Check for list text
            $Text = preg_replace("/\[list\](.+?)\[\/list\]/is", '<ul class="listbullet">$1</ul>' ,$Text);
            $Text = preg_replace("/\[list=1\](.+?)\[\/list\]/is", '<ul class="listdecimal">$1</ul>' ,$Text);
            $Text = preg_replace("/\[list=i\](.+?)\[\/list\]/s", '<ul class="listlowerroman">$1</ul>' ,$Text);
            $Text = preg_replace("/\[list=I\](.+?)\[\/list\]/s", '<ul class="listupperroman">$1</ul>' ,$Text);
            $Text = preg_replace("/\[list=a\](.+?)\[\/list\]/s", '<ul class="listloweralpha">$1</ul>' ,$Text);
            $Text = preg_replace("/\[list=A\](.+?)\[\/list\]/s", '<ul class="listupperalpha">$1</ul>' ,$Text);
            $Text = str_replace("[*]", "<li>", $Text);

            // Check for font change text
            $Text = preg_replace("(\[font=(.+?)\](.+?)\[\/font\])","<span style=\"font-family: $1;\">$2</span>",$Text);

            // Declare the format for [code] layout
            $CodeLayout = '<fieldset>
                                    <legend>Code:</legend>
                                    $1
                           </fieldset>';
            // Check for [code] text
            $Text = preg_replace("/\[code\](.+?)\[\/code\]/is","$CodeLayout", $Text);
            // Declare the format for [php] layout
            $phpLayout = '<fieldset>
                                    <legend>Code:</legend>
                                    $1
                           </fieldset>';
            // Check for [php] text
            $Text = preg_replace("/\[php\](.+?)\[\/php\]/is",$phpLayout, $Text);

            // Declare the format for [quote] layout
            $QuoteLayout = '<fieldset>
                                    <legend>Quote:</legend>
                                    $1
                           </fieldset>';
                     
            // Check for [quote] text
            $Text = preg_replace("/\[quote\](.+?)\[\/quote\]/is","$QuoteLayout", $Text);

            // Declare the format for [quote from=] layout
            $QuotefromLayout = '<fieldset>
                                    <legend>Quote from $1:</legend>
                                    $2
                           </fieldset>';
                     
            // Check for [quote from=] text
            $Text = preg_replace("/\[quote from\=(.+?)\](.+?)\[\/quote\]/is","$QuotefromLayout", $Text);
         
            // Images
            // [img]pathtoimage[/img]
            $Text = preg_replace("/\[img\](.+?)\[\/img\]/", '<img src="$1">', $Text);
			//make it work for caps
            $Text = preg_replace("/\[IMG\](.+?)\[\/IMG\]/", '<img src="$1">', $Text);
         
            // [img=widthxheight]image source[/img]
            $Text = preg_replace("/\[img\=([0-9]*)x([0-9]*)\](.+?)\[\/img\]/", '<img src="$3" height="$2" width="$1">', $Text);
			//make it work for caps
            $Text = preg_replace("/\[IMG\=([0-9]*)x([0-9]*)\](.+?)\[\/IMG\]/", '<img src="$3" height="$2" width="$1">', $Text);
       

			//smileys
			$Text=str_replace(array("(ak)","(angel)","(bomb)","(canada)","(confused)",":)",":((","(cannibal)","(hammer)","(jump)","(laser)","(laugh)","(laugh2)","(lightsaber)",":(","(shot)","(sniper)",":P","(uk)","(usa)","(thumbu)","(thumbd)"),array("<img src=images/smileys/ak.gif>","<img src=images/smileys/angel.gif>","<img src=images/smileys/bomb.gif>","<img src=images/smileys/canada.gif>","<img src=images/smileys/confused.gif>","<img src=images/smileys/cool.gif>","<img src=images/smileys/cry.gif>","<img src=images/smileys/eat.gif>","<img src=images/smileys/hammer.gif>","<img src=images/smileys/jumping.gif>","<img src=images/smileys/laser.gif>","<img src=images/smileys/laugh.gif>","<img src=images/smileys/laugh2.gif>","<img src=images/smileys/lightsaber.gif>","<img src=images/smileys/sadface.gif>","<img src=images/smileys/shot.gif>","<img src=images/smileys/sniper.gif>","<img src=images/smileys/ts.gif>","<img src=images/smileys/uk.gif>","<img src=images/smileys/usa.gif>","<img src=images/smileys/tu.png>","<img src=images/smileys/td.png>"),$Text);
           return $Text;
      }
?>
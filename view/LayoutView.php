<?php

namespace view;

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

class LayoutView{

	public function render($nv,$v,$fv){
		echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Rating calculators</title>
          <link href="Style/main.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
          <h1>Rating calculators</h1>
          ' . $nv->show() . '
          <br />
          <div class="container">
              ' . $v->response() . '
          </div>
          
          ' . $fv->response() . '
         
         </body>
      </html>
    ';
	}
}
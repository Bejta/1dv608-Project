<?php

namespace view;



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
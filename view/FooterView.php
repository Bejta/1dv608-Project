<?php

namespace view;

class FooterView {

	
	public function response() {
		return '
                <div class="footer">   
                <img class="image" src="content/jasmin.jpg"></img>   
                <div class="Signature">This program is developed by Jasmin Bejtovic as a project in course Web Development with PHP on Linnaeus University in Kalmar and Vaxjo, Web Developement programme.</div>
                <div class="Signature">Email: jb223cp@student.lnu.se</div>
                <div class="Signature">GitHub: <a href="https://github.com/jb223cp">JB223CP</a></div>
                </div>
          		
		';
	}
}
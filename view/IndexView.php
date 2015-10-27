<?php 

namespace view;

class IndexView {

	
	public function response() {
		return '<form method="post"> 

		<div>
          <p>The Elo rating system is a method for calculating the relative skill levels of players in competitor-versus-competitor games such as chess. It is named after its creator Arpad Elo, a Hungarian-born American physics professor.</p>
          <p> Read more about Elo rating system on Wikipedia: <a href="https://en.wikipedia.org/wiki/Elo_rating_system">Elo rating system</a>.</p>
          <p> More mathematical details about Elo rating system: <a href="https://en.wikipedia.org/wiki/Elo_rating_system#Mathematical_details">Mathematical details</a>.</p>
		</div>
					
		</form>';
	}
}

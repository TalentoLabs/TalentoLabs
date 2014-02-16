<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		
		$test_array = array(
		'one' => __('One', 'theme_setup'),
		'two' => __('Two', 'theme_setup'),
		'three' => __('Three', 'theme_setup'),
		'four' => __('Four', 'theme_setup'),
		'five' => __('Five', 'theme_setup')
	);

 
	 
	$multicheck_array = array(
		'one' => __('French Toast', 'theme_setup'),
		'two' => __('Pancake', 'theme_setup'),
		'three' => __('Omelette', 'theme_setup'),
		'four' => __('Crepe', 'theme_setup'),
		'five' => __('Waffle', 'theme_setup')
	);

	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);
	
	 
	
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);

$imagepath =  get_template_directory_uri() . '/images/';
		
		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = STYLESHEETPATH. '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_bloginfo('template_url').'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		
		$font_sizes = array(
			'10' => '10',
			'11' => '11',
			'12' => '12',
			'13' => '13',
			'14' => '14',
			'15' => '15',
			'16' => '16',
			'17' => '17',
			'18' => '18',
			'19' => '19',
			'20' => '20',
			'21' => '21',
			'22' => '22',
			'23' => '23',
			'24' => '24',
			'25' => '25',
			'26' => '26',
			'27' => '27',
			'28' => '28',
			'29' => '29',
			'30' => '30',
			'31' => '31',
			'32' => '32',
			'33' => '33',
			'34' => '34',
			'35' => '35',
			'36' => '36',
			'37' => '37',
			'38' => '38',
			'39' => '39',
			'40' => '40',
			'41' => '41',
			'42' => '42',
			'43' => '43',
			'43' => '44',
			'45' => '45',
			'46' => '46',
			'47' => '47',
			'48' => '48',
			'49' => '49',
			'50' => '50',
		);

	$google_fonts = array(
							"0" => "",
							"Abel" => "Abel",
							"Abril Fatface" => "Abril Fatface",
							"Aclonica" => "Aclonica",
							"Acme" => "Acme",
							"Actor" => "Actor",
							"Adamina" => "Adamina",
							"Advent Pro" => "Advent Pro",
							"Aguafina Script" => "Aguafina Script",
							"Aladin" => "Aladin",
							"Aldrich" => "Aldrich",
							"Alegreya" => "Alegreya",
							"Alegreya SC" => "Alegreya SC",
							"Alex Brush" => "Alex Brush",
							"Alfa Slab One" => "Alfa Slab One",
							"Alice" => "Alice",
							"Alike" => "Alike",
							"Alike Angular" => "Alike Angular",
							"Allan" => "Allan",
							"Allerta" => "Allerta",
							"Allerta Stencil" => "Allerta Stencil",
							"Allura" => "Allura",
							"Almendra" => "Almendra",
							"Almendra SC" => "Almendra SC",
							"Amaranth" => "Amaranth",
							"Amatic SC" => "Amatic SC",
							"Amethysta" => "Amethysta",
							"Andada" => "Andada",
							"Andika" => "Andika",
							"Angkor" => "Angkor",
							"Annie Use Your Telescope" => "Annie Use Your Telescope",
							"Anonymous Pro" => "Anonymous Pro",
							"Antic" => "Antic",
							"Antic Didone" => "Antic Didone",
							"Antic Slab" => "Antic Slab",
							"Anton" => "Anton",
							"Arapey" => "Arapey",
							"Arbutus" => "Arbutus",
							"Architects Daughter" => "Architects Daughter",
							"Arimo" => "Arimo",
							"Arizonia" => "Arizonia",
							"Armata" => "Armata",
							"Artifika" => "Artifika",
							"Arvo" => "Arvo",
							"Asap" => "Asap",
							"Asset" => "Asset",
							"Astloch" => "Astloch",
							"Asul" => "Asul",
							"Atomic Age" => "Atomic Age",
							"Aubrey" => "Aubrey",
							"Audiowide" => "Audiowide",
							"Average" => "Average",
							"Averia Gruesa Libre" => "Averia Gruesa Libre",
							"Averia Libre" => "Averia Libre",
							"Averia Sans Libre" => "Averia Sans Libre",
							"Averia Serif Libre" => "Averia Serif Libre",
							"Bad Script" => "Bad Script",
							"Balthazar" => "Balthazar",
							"Bangers" => "Bangers",
							"Basic" => "Basic",
							"Battambang" => "Battambang",
							"Baumans" => "Baumans",
							"Bayon" => "Bayon",
							"Belgrano" => "Belgrano",
							"Belleza" => "Belleza",
							"Bentham" => "Bentham",
							"Berkshire Swash" => "Berkshire Swash",
							"Bevan" => "Bevan",
							"Bigshot One" => "Bigshot One",
							"Bilbo" => "Bilbo",
							"Bilbo Swash Caps" => "Bilbo Swash Caps",
							"Bitter" => "Bitter",
							"Black Ops One" => "Black Ops One",
							"Bokor" => "Bokor",
							"Bonbon" => "Bonbon",
							"Boogaloo" => "Boogaloo",
							"Bowlby One" => "Bowlby One",
							"Bowlby One SC" => "Bowlby One SC",
							"Brawler" => "Brawler",
							"Bree Serif" => "Bree Serif",
							"Bubblegum Sans" => "Bubblegum Sans",
							"Buda" => "Buda",
							"Buenard" => "Buenard",
							"Butcherman" => "Butcherman",
							"Butterfly Kids" => "Butterfly Kids",
							"Cabin" => "Cabin",
							"Cabin Condensed" => "Cabin Condensed",
							"Cabin Sketch" => "Cabin Sketch",
							"Caesar Dressing" => "Caesar Dressing",
							"Cagliostro" => "Cagliostro",
							"Calligraffitti" => "Calligraffitti",
							"Cambo" => "Cambo",
							"Candal" => "Candal",
							"Cantarell" => "Cantarell",
							"Cantata One" => "Cantata One",
							"Cardo" => "Cardo",
							"Carme" => "Carme",
							"Carter One" => "Carter One",
							"Caudex" => "Caudex",
							"Cedarville Cursive" => "Cedarville Cursive",
							"Ceviche One" => "Ceviche One",
							"Changa One" => "Changa One",
							"Chango" => "Chango",
							"Chau Philomene One" => "Chau Philomene One",
							"Chelsea Market" => "Chelsea Market",
							"Chenla" => "Chenla",
							"Cherry Cream Soda" => "Cherry Cream Soda",
							"Chewy" => "Chewy",
							"Chicle" => "Chicle",
							"Chivo" => "Chivo",
							"Coda" => "Coda",
							"Coda Caption" => "Coda Caption",
							"Codystar" => "Codystar",
							"Comfortaa" => "Comfortaa",
							"Coming Soon" => "Coming Soon",
							"Concert One" => "Concert One",
							"Condiment" => "Condiment",
							"Content" => "Content",
							"Contrail One" => "Contrail One",
							"Convergence" => "Convergence",
							"Cookie" => "Cookie",
							"Copse" => "Copse",
							"Corben" => "Corben",
							"Cousine" => "Cousine",
							"Coustard" => "Coustard",
							"Covered By Your Grace" => "Covered By Your Grace",
							"Crafty Girls" => "Crafty Girls",
							"Creepster" => "Creepster",
							"Crete Round" => "Crete Round",
							"Crimson Text" => "Crimson Text",
							"Crushed" => "Crushed",
							"Cuprum" => "Cuprum",
							"Cutive" => "Cutive",
							"Damion" => "Damion",
							"Dancing Script" => "Dancing Script",
							"Dangrek" => "Dangrek",
							"Dawning of a New Day" => "Dawning of a New Day",
							"Days One" => "Days One",
							"Delius" => "Delius",
							"Delius Swash Caps" => "Delius Swash Caps",
							"Delius Unicase" => "Delius Unicase",
							"Della Respira" => "Della Respira",
							"Devonshire" => "Devonshire",
							"Didact Gothic" => "Didact Gothic",
							"Diplomata" => "Diplomata",
							"Diplomata SC" => "Diplomata SC",
							"Doppio One" => "Doppio One",
							"Dorsa" => "Dorsa",
							"Dosis" => "Dosis",
							"Dr Sugiyama" => "Dr Sugiyama",
							"Droid Sans" => "Droid Sans",
							"Droid Sans Mono" => "Droid Sans Mono",
							"Droid Serif" => "Droid Serif",
							"Duru Sans" => "Duru Sans",
							"Dynalight" => "Dynalight",
							"EB Garamond" => "EB Garamond",
							"Eater" => "Eater",
							"Economica" => "Economica",
							"Electrolize" => "Electrolize",
							"Emblema One" => "Emblema One",
							"Emilys Candy" => "Emilys Candy",
							"Engagement" => "Engagement",
							"Enriqueta" => "Enriqueta",
							"Erica One" => "Erica One",
							"Esteban" => "Esteban",
							"Euphoria Script" => "Euphoria Script",
							"Ewert" => "Ewert",
							"Exo" => "Exo",
							"Expletus Sans" => "Expletus Sans",
							"Fanwood Text" => "Fanwood Text",
							"Fascinate" => "Fascinate",
							"Fascinate Inline" => "Fascinate Inline",
							"Federant" => "Federant",
							"Federo" => "Federo",
							"Felipa" => "Felipa",
							"Fjord One" => "Fjord One",
							"Flamenco" => "Flamenco",
							"Flavors" => "Flavors",
							"Fondamento" => "Fondamento",
							"Fontdiner Swanky" => "Fontdiner Swanky",
							"Forum" => "Forum",
							"Francois One" => "Francois One",
							"Fredericka the Great" => "Fredericka the Great",
							"Fredoka One" => "Fredoka One",
							"Freehand" => "Freehand",
							"Fresca" => "Fresca",
							"Frijole" => "Frijole",
							"Fugaz One" => "Fugaz One",
							"GFS Didot" => "GFS Didot",
							"GFS Neohellenic" => "GFS Neohellenic",
							"Galdeano" => "Galdeano",
							"Gentium Basic" => "Gentium Basic",
							"Gentium Book Basic" => "Gentium Book Basic",
							"Geo" => "Geo",
							"Geostar" => "Geostar",
							"Geostar Fill" => "Geostar Fill",
							"Germania One" => "Germania One",
							"Give You Glory" => "Give You Glory",
							"Glass Antiqua" => "Glass Antiqua",
							"Glegoo" => "Glegoo",
							"Gloria Hallelujah" => "Gloria Hallelujah",
							"Goblin One" => "Goblin One",
							"Gochi Hand" => "Gochi Hand",
							"Gorditas" => "Gorditas",
							"Goudy Bookletter 1911" => "Goudy Bookletter 1911",
							"Graduate" => "Graduate",
							"Gravitas One" => "Gravitas One",
							"Great Vibes" => "Great Vibes",
							"Gruppo" => "Gruppo",
							"Gudea" => "Gudea",
							"Habibi" => "Habibi",
							"Hammersmith One" => "Hammersmith One",
							"Handlee" => "Handlee",
							"Hanuman" => "Hanuman",
							"Happy Monkey" => "Happy Monkey",
							"Henny Penny" => "Henny Penny",
							"Herr Von Muellerhoff" => "Herr Von Muellerhoff",
							"Holtwood One SC" => "Holtwood One SC",
							"Homemade Apple" => "Homemade Apple",
							"Homenaje" => "Homenaje",
							"IM Fell DW Pica" => "IM Fell DW Pica",
							"IM Fell DW Pica SC" => "IM Fell DW Pica SC",
							"IM Fell Double Pica" => "IM Fell Double Pica",
							"IM Fell Double Pica SC" => "IM Fell Double Pica SC",
							"IM Fell English" => "IM Fell English",
							"IM Fell English SC" => "IM Fell English SC",
							"IM Fell French Canon" => "IM Fell French Canon",
							"IM Fell French Canon SC" => "IM Fell French Canon SC",
							"IM Fell Great Primer" => "IM Fell Great Primer",
							"IM Fell Great Primer SC" => "IM Fell Great Primer SC",
							"Iceberg" => "Iceberg",
							"Iceland" => "Iceland",
							"Imprima" => "Imprima",
							"Inconsolata" => "Inconsolata",
							"Inder" => "Inder",
							"Indie Flower" => "Indie Flower",
							"Inika" => "Inika",
							"Irish Grover" => "Irish Grover",
							"Istok Web" => "Istok Web",
							"Italiana" => "Italiana",
							"Italianno" => "Italianno",
							"Jim Nightshade" => "Jim Nightshade",
							"Jockey One" => "Jockey One",
							"Jolly Lodger" => "Jolly Lodger",
							"Josefin Sans" => "Josefin Sans",
							"Josefin Slab" => "Josefin Slab",
							"Judson" => "Judson",
							"Julee" => "Julee",
							"Junge" => "Junge",
							"Jura" => "Jura",
							"Just Another Hand" => "Just Another Hand",
							"Just Me Again Down Here" => "Just Me Again Down Here",
							"Kameron" => "Kameron",
							"Karla" => "Karla",
							"Kaushan Script" => "Kaushan Script",
							"Kelly Slab" => "Kelly Slab",
							"Kenia" => "Kenia",
							"Khmer" => "Khmer",
							"Knewave" => "Knewave",
							"Kotta One" => "Kotta One",
							"Koulen" => "Koulen",
							"Kranky" => "Kranky",
							"Kreon" => "Kreon",
							"Kristi" => "Kristi",
							"Krona One" => "Krona One",
							"La Belle Aurore" => "La Belle Aurore",
							"Lancelot" => "Lancelot",
							"Lato" => "Lato",
							"League Script" => "League Script",
							"Leckerli One" => "Leckerli One",
							"Ledger" => "Ledger",
							"Lekton" => "Lekton",
							"Lemon" => "Lemon",
							"Lilita One" => "Lilita One",
							"Limelight" => "Limelight",
							"Linden Hill" => "Linden Hill",
							"Lobster" => "Lobster",
							"Lobster Two" => "Lobster Two",
							"Londrina Outline" => "Londrina Outline",
							"Londrina Shadow" => "Londrina Shadow",
							"Londrina Sketch" => "Londrina Sketch",
							"Londrina Solid" => "Londrina Solid",
							"Lora" => "Lora",
							"Love Ya Like A Sister" => "Love Ya Like A Sister",
							"Loved by the King" => "Loved by the King",
							"Lovers Quarrel" => "Lovers Quarrel",
							"Luckiest Guy" => "Luckiest Guy",
							"Lusitana" => "Lusitana",
							"Lustria" => "Lustria",
							"Macondo" => "Macondo",
							"Macondo Swash Caps" => "Macondo Swash Caps",
							"Magra" => "Magra",
							"Maiden Orange" => "Maiden Orange",
							"Mako" => "Mako",
							"Marck Script" => "Marck Script",
							"Marko One" => "Marko One",
							"Marmelad" => "Marmelad",
							"Marvel" => "Marvel",
							"Mate" => "Mate",
							"Mate SC" => "Mate SC",
							"Maven Pro" => "Maven Pro",
							"Meddon" => "Meddon",
							"MedievalSharp" => "MedievalSharp",
							"Medula One" => "Medula One",
							"Megrim" => "Megrim",
							"Merienda One" => "Merienda One",
							"Merriweather" => "Merriweather",
							"Metal" => "Metal",
							"Metamorphous" => "Metamorphous",
							"Metrophobic" => "Metrophobic",
							"Michroma" => "Michroma",
							"Miltonian" => "Miltonian",
							"Miltonian Tattoo" => "Miltonian Tattoo",
							"Miniver" => "Miniver",
							"Miss Fajardose" => "Miss Fajardose",
							"Modern Antiqua" => "Modern Antiqua",
							"Molengo" => "Molengo",
							"Monofett" => "Monofett",
							"Monoton" => "Monoton",
							"Monsieur La Doulaise" => "Monsieur La Doulaise",
							"Montaga" => "Montaga",
							"Montez" => "Montez",
							"Montserrat" => "Montserrat",
							"Moul" => "Moul",
							"Moulpali" => "Moulpali",
							"Mountains of Christmas" => "Mountains of Christmas",
							"Mr Bedfort" => "Mr Bedfort",
							"Mr Dafoe" => "Mr Dafoe",
							"Mr De Haviland" => "Mr De Haviland",
							"Mrs Saint Delafield" => "Mrs Saint Delafield",
							"Mrs Sheppards" => "Mrs Sheppards",
							"Muli" => "Muli",
							"Mystery Quest" => "Mystery Quest",
							"Neucha" => "Neucha",
							"Neuton" => "Neuton",
							"News Cycle" => "News Cycle",
							"Niconne" => "Niconne",
							"Nixie One" => "Nixie One",
							"Nobile" => "Nobile",
							"Nokora" => "Nokora",
							"Norican" => "Norican",
							"Nosifer" => "Nosifer",
							"Nothing You Could Do" => "Nothing You Could Do",
							"Noticia Text" => "Noticia Text",
							"Nova Cut" => "Nova Cut",
							"Nova Flat" => "Nova Flat",
							"Nova Mono" => "Nova Mono",
							"Nova Oval" => "Nova Oval",
							"Nova Round" => "Nova Round",
							"Nova Script" => "Nova Script",
							"Nova Slim" => "Nova Slim",
							"Nova Square" => "Nova Square",
							"Numans" => "Numans",
							"Nunito" => "Nunito",
							"Odor Mean Chey" => "Odor Mean Chey",
							"Old Standard TT" => "Old Standard TT",
							"Oldenburg" => "Oldenburg",
							"Oleo Script" => "Oleo Script",
							"Open Sans" => "Open Sans",
							"Open Sans Condensed" => "Open Sans Condensed",
							"Orbitron" => "Orbitron",
							"Original Surfer" => "Original Surfer",
							"Oswald" => "Oswald",
							"Over the Rainbow" => "Over the Rainbow",
							"Overlock" => "Overlock",
							"Overlock SC" => "Overlock SC",
							"Ovo" => "Ovo",
							"Oxygen" => "Oxygen",
							"PT Mono" => "PT Mono",
							"PT Sans" => "PT Sans",
							"PT Sans Caption" => "PT Sans Caption",
							"PT Sans Narrow" => "PT Sans Narrow",
							"PT Serif" => "PT Serif",
							"PT Serif Caption" => "PT Serif Caption",
							"Pacifico" => "Pacifico",
							"Parisienne" => "Parisienne",
							"Passero One" => "Passero One",
							"Passion One" => "Passion One",
							"Patrick Hand" => "Patrick Hand",
							"Patua One" => "Patua One",
							"Paytone One" => "Paytone One",
							"Permanent Marker" => "Permanent Marker",
							"Petrona" => "Petrona",
							"Philosopher" => "Philosopher",
							"Piedra" => "Piedra",
							"Pinyon Script" => "Pinyon Script",
							"Plaster" => "Plaster",
							"Play" => "Play",
							"Playball" => "Playball",
							"Playfair Display" => "Playfair Display",
							"Podkova" => "Podkova",
							"Poiret One" => "Poiret One",
							"Poller One" => "Poller One",
							"Poly" => "Poly",
							"Pompiere" => "Pompiere",
							"Pontano Sans" => "Pontano Sans",
							"Port Lligat Sans" => "Port Lligat Sans",
							"Port Lligat Slab" => "Port Lligat Slab",
							"Prata" => "Prata",
							"Preahvihear" => "Preahvihear",
							"Press Start 2P" => "Press Start 2P",
							"Princess Sofia" => "Princess Sofia",
							"Prociono" => "Prociono",
							"Prosto One" => "Prosto One",
							"Puritan" => "Puritan",
							"Quantico" => "Quantico",
							"Quattrocento" => "Quattrocento",
							"Quattrocento Sans" => "Quattrocento Sans",
							"Questrial" => "Questrial",
							"Quicksand" => "Quicksand",
							"Qwigley" => "Qwigley",
							"Radley" => "Radley",
							"Raleway" => "Raleway",
							"Rammetto One" => "Rammetto One",
							"Rancho" => "Rancho",
							"Rationale" => "Rationale",
							"Redressed" => "Redressed",
							"Reenie Beanie" => "Reenie Beanie",
							"Revalia" => "Revalia",
							"Ribeye" => "Ribeye",
							"Ribeye Marrow" => "Ribeye Marrow",
							"Righteous" => "Righteous",
							"Rochester" => "Rochester",
							"Rock Salt" => "Rock Salt",
							"Rokkitt" => "Rokkitt",
							"Ropa Sans" => "Ropa Sans",
							"Rosario" => "Rosario",
							"Rosarivo" => "Rosarivo",
							"Rouge Script" => "Rouge Script",
							"Ruda" => "Ruda",
							"Ruge Boogie" => "Ruge Boogie",
							"Ruluko" => "Ruluko",
							"Ruslan Display" => "Ruslan Display",
							"Russo One" => "Russo One",
							"Ruthie" => "Ruthie",
							"Sail" => "Sail",
							"Salsa" => "Salsa",
							"Sancreek" => "Sancreek",
							"Sansita One" => "Sansita One",
							"Sarina" => "Sarina",
							"Satisfy" => "Satisfy",
							"Schoolbell" => "Schoolbell",
							"Seaweed Script" => "Seaweed Script",
							"Sevillana" => "Sevillana",
							"Shadows Into Light" => "Shadows Into Light",
							"Shadows Into Light Two" => "Shadows Into Light Two",
							"Shanti" => "Shanti",
							"Share" => "Share",
							"Shojumaru" => "Shojumaru",
							"Short Stack" => "Short Stack",
							"Siemreap" => "Siemreap",
							"Sigmar One" => "Sigmar One",
							"Signika" => "Signika",
							"Signika Negative" => "Signika Negative",
							"Simonetta" => "Simonetta",
							"Sirin Stencil" => "Sirin Stencil",
							"Six Caps" => "Six Caps",
							"Slackey" => "Slackey",
							"Smokum" => "Smokum",
							"Smythe" => "Smythe",
							"Sniglet" => "Sniglet",
							"Snippet" => "Snippet",
							"Sofia" => "Sofia",
							"Sonsie One" => "Sonsie One",
							"Sorts Mill Goudy" => "Sorts Mill Goudy",
							"Special Elite" => "Special Elite",
							"Spicy Rice" => "Spicy Rice",
							"Spinnaker" => "Spinnaker",
							"Spirax" => "Spirax",
							"Squada One" => "Squada One",
							"Stardos Stencil" => "Stardos Stencil",
							"Stint Ultra Condensed" => "Stint Ultra Condensed",
							"Stint Ultra Expanded" => "Stint Ultra Expanded",
							"Stoke" => "Stoke",
							"Sue Ellen Francisco" => "Sue Ellen Francisco",
							"Sunshiney" => "Sunshiney",
							"Supermercado One" => "Supermercado One",
							"Suwannaphum" => "Suwannaphum",
							"Swanky and Moo Moo" => "Swanky and Moo Moo",
							"Syncopate" => "Syncopate",
							"Tangerine" => "Tangerine",
							"Taprom" => "Taprom",
							"Telex" => "Telex",
							"Tenor Sans" => "Tenor Sans",
							"The Girl Next Door" => "The Girl Next Door",
							"Tienne" => "Tienne",
							"Tinos" => "Tinos",
							"Titan One" => "Titan One",
							"Trade Winds" => "Trade Winds",
							"Trocchi" => "Trocchi",
							"Trochut" => "Trochut",
							"Trykker" => "Trykker",
							"Tulpen One" => "Tulpen One",
							"Ubuntu" => "Ubuntu",
							"Ubuntu Condensed" => "Ubuntu Condensed",
							"Ubuntu Mono" => "Ubuntu Mono",
							"Ultra" => "Ultra",
							"Uncial Antiqua" => "Uncial Antiqua",
							"UnifrakturCook" => "UnifrakturCook",
							"UnifrakturMaguntia" => "UnifrakturMaguntia",
							"Unkempt" => "Unkempt",
							"Unlock" => "Unlock",
							"Unna" => "Unna",
							"VT323" => "VT323",
							"Varela" => "Varela",
							"Varela Round" => "Varela Round",
							"Vast Shadow" => "Vast Shadow",
							"Vibur" => "Vibur",
							"Vidaloka" => "Vidaloka",
							"Viga" => "Viga",
							"Voces" => "Voces",
							"Volkhov" => "Volkhov",
							"Vollkorn" => "Vollkorn",
							"Voltaire" => "Voltaire",
							"Waiting for the Sunrise" => "Waiting for the Sunrise",
							"Wallpoet" => "Wallpoet",
							"Walter Turncoat" => "Walter Turncoat",
							"Wellfleet" => "Wellfleet",
							"Wire One" => "Wire One",
							"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
							"Yellowtail" => "Yellowtail",
							"Yeseva One" => "Yeseva One",
							"Yesteryear" => "Yesteryear",
							"Zeyada" => "Zeyada",
						);

		
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();
					
$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);
					
        $of_options[] = array(
		'name' => __('Custom Logo', 'theme_setup'),
		'desc' => __('Upload a logo (180x45 px) for your theme, or specify an image URL directly.', 'theme_setup'),
		'id' => 'logo',
		'std' => $imagepath . 'logo.png',
		'type' => 'media');
				
		$of_options[] = array(
		'name' => __('Custom Favicon', 'theme_setup'),
		'desc' => __('Upload a 16px x 16px ico image that will represent your websites favicon. directly.', 'theme_setup'),
		'id' => 'Favicon',
		'std' => $imagepath . 'favicon.ico',
		'type' => 'media');

		$of_options[] = array(
		'name' => __('Tracking Code', 'theme_setup'),
		'desc' => __('You can insert your any tracking code like Google Analytics Tracking Code. It will automatically be added to the themes footer.', 'theme_setup'),
		'id' => 'tracking_code', 'theme_setup',
		'std' => '',
		'type' => 'textarea');
		
		$of_options[] = array(
		'name' => __('Footer Text', 'theme_setup'),
		'desc' => __('The copyright text at the bottom right of your site.', 'theme_setup'),
		'id' => 'footer_text',
		'std' => 'Copyright 2013. All rights reserved',
		"type" => "textarea"); 

		$of_options[] = array(
		'name' => __('Heading description for Archive pages', 'theme_setup'),
		'desc' => __('', 'theme_setup'),
		'id' => 'archive_desc',
		'std' => '',
		"type" => "textarea"); 

		$of_options[] = array( "name" => "Number of Portfolio Items show on Thumb Expand Portfolio",
		"desc" => "",
		"id" => "te_portfolio_items",
		"std" => "12",
		"type" => "text");

		$of_options[] = array( "name" => "Number of Portfolio Items show on Dynamic Grid Portfolio",
		"desc" => "",
		"id" => "dg_portfolio_items",
		"std" => "10",
		"type" => "text"); 

		$of_options[] = array( "name" => "Number of Blog post show on Grid Blog",
		"desc" => "",
		"id" => "grid_post_items",
		"std" => "10",
		"type" => "text");

		$of_options[] = array( "name" => "Number of Blog post show on Full Width  Blog",
		"desc" => "",
		"id" => "fw_post_items",
		"std" => "10",
		"type" => "text");


		$of_options[] = array( 	
		"name" => "Styling Options",
		"type" => "heading"
		);
				
		$of_options[] = array(
		'name' => __('Color Schemes ', 'theme_setup'),
		'desc' => __('Choose a custom color scheme .', 'theme_setup'),
		'id' => 'color_scheme',
		'std' => '#b92429',
		'type' => 'color' );	
	
		$of_options[] = array( 
		"name" => "Body Background",
		"desc" => "",
		"id" => "body_background",
		"std" => "<h3 style='margin: 0;''>Body Background</h3>", 
		"type" => "info");
		 
		$of_options[] = array( 	
		"name" 	=> " ",
		"desc" 	=> "Select a background pattern if you dont upload a background image.",
		"id" 	=> "background_pattern",
		'std'   => '',
		"type"	=> "tiles",
		"options" => $bg_images,
		);
				
		$of_options[] = array(
		"name" => "",
		'desc' => __('Upload custom background image if you dont select a background pattern.', 'theme_setup'),
		'id' => 'background_image',
		'std' => '',
		'type' => 'media');
				
		$of_options[] = array( 
		"name" => "",
		"desc" => "Background Repeat",
		"id" => "bg_repeat",
		"std" => "",
		"type" => "select",
		"options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));   
					
		$of_options[] = array(
		"name" => "",
		'desc' => __('Choose a custom background color.', 'theme_setup'),
		'id' => 'bg_color',
		'std' => '#f6f6f6',
		'type' => 'color' );
		
		$of_options[] = array( 
		"name" => "Page and Post Background",
		"desc" => "",
		"id" => "page_background",
		"std" => "<h3 style='margin: 0;''>Page Background</h3>", 
		"type" => "info" );
							
		$of_options[] = array( 	
		"name" 		=> " ",
		"desc" 		=> "Select a page background pattern if you dont upload a background image.",
		"id" 		=> "pagebg_pattern",
		'std'       => '',
		"type" 		=> "tiles",
		"options" 	=> $bg_images,
		);
				
		$of_options[] = array(
		"name" 		=> " ",
		'desc' => __('Upload custom page background image if you dont select a background pattern.', 'theme_setup'),
		'id' => 'pagebg_image',
		'std' => '',
		'type' => 'media');
				
		$of_options[] = array( 
		"name" => "",
		"desc" => " Page Background Repeat",
		"id" => "pagebg_repeat",
		"std" => "",
		"type" => "select",
		"options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));   
					
		$of_options[] = array(
		"name" => "",
		'desc' => __('Choose a custom Page background color.', 'theme_setup'),
		'id' => 'pagebg_color',
		'std' => '#fff',
		'type' => 'color' );
		
		$of_options[] = array( 
		"name" => " Before footer background",
		"desc" => "",
		"id" => "bf_background",
		"std" => "<h3 style='margin: 0;''> Before footer background</h3>", 
		"type" => "info");
					  
		$of_options[] = array(
		'name' => __('', 'theme_setup'),
		'desc' => __('Upload custom before footer background image.', 'theme_setup'),
		'id' => 'bfbg_image',
		 'std' => '',
		'type' => 'media');
				
		$of_options[] = array( "name" => "",
		"desc" => "before footer Background Repeat",
		"id" => "bfbg_repeat",
		"std" => "",
		"type" => "select",
		"options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));   
					
		$of_options[] = array(
		"name" => "",
		'desc' => __('Choose a custom before footer background color.', 'theme_setup'),
		'id' => 'bfbg_color',
		'std' => '',
		'type' => 'color' );	
		
		$of_options[] = array( "name" => "Footer background",
		"desc" => "",
		"id" => "f_background",
		"std" => "<h3 style='margin: 0;''>Footer background</h3>", 
		"type" => "info");
					 
		$of_options[] = array(
		"name" => "",
		'desc' => __('Choose a custom background color for footer.', 'theme_setup'),
		'id' => 'fbg_color',
		'std' => '',
		'type' => 'color' );
		
		$of_options[] = array(
		 "name" => "Custom CSS",
		 "desc" => "",
		 "id" => "custom_css",
		 "std" => '',
		 "type" => "textarea");	
		 
		$of_options[] = array( "name" => "Typography Options",
					"type" => "heading");
  

		$of_options[] = array( 
		"name" => "Google Fonts",
		"desc" => "",
		"id" => "google_fonts_intro",
		"std" => "<h3 style='margin: 0;''>Google Fonts</h3>", 
		"type" => "info");

		$of_options[] = array( 
		"name" => "Select Body Font Family",
		"desc" => "Select a font family for body text",
		"id" => "googlefont_body",
		"std" => "'Helvetica Neue', Helvetica, Arial, sans-serif",
		"type" 		=> "select_google_font",
		"options" => $google_fonts);

		$of_options[] = array( 
		"name" => "Select Menu Font",
		"desc" => "Select a font family for navigation",
		"id" => "googlefont_nav",
		"std" => "'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif",
		"type" 		=> "select_google_font",
		"options" => $google_fonts);

$of_options[] = array( "name" => "Select Headings Font",
					"desc" => "Select a font family for headings",
					"id" => "googlefont_headings",
					"std" => "'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif",
					"type" 		=> "select_google_font",
					"options" => $google_fonts);

$of_options[] = array( "name" => "Standard Fonts",
					"desc" => "",
					"id" => "standard_fonts_intro",
					"std" => "<h3 style='margin: 0; margin-bottom:10px;''>Standards Fonts</h3>If you have a Google Font selected above, it will override the standard font and want to use standard font then select here ",
					"icon" => true,
					"type" => "info");

    $os_faces = array(
    	"0" => "",
	    '"Oswald", sans-serif, arial' => 'Oswald sans-serif',
		'"PT Serif", Georgia, Times, serif' => 'PT Serif Georgia',
		'"Droid Serif", Georgia,Times,serif' => 'Droid Serif Georgia',
		'"Lato", "Helvetica Neue", Helvetica, Arial, sans-serif' => 'Lato Helvetica Neue',
		'"Helvetica Neue", Helvetica, Arial, sans-serif' => 'Helvetica Neue sans-serif',
		'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
        'Arial, sans-serif' => 'Arial',
        '"Avant Garde", sans-serif' => 'Avant Garde',
        'Cambria, Georgia, serif' => 'Cambria',
        'Copse, sans-serif' => 'Copse',
        'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
        'Georgia, serif' => 'Georgia',
        '"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
        'Tahoma, Geneva, sans-serif' => 'Tahoma'
    );

$of_options[] = array( "name" => "Select Body Font Family",
					"desc" => "Select a font family for body text",
					"id" => "standardfont_body",
					"std" => "'Helvetica Neue', Helvetica, Arial, sans-serif",
					"type" => "select",
					"options" => $os_faces);

$of_options[] = array( "name" => "Select Menu Font Family",
					"desc" => "Select a font family for menu navigation",
					"id" => "standardfont_nav",
					"std" => "'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif",
					"type" => "select",
					"options" => $os_faces);

$of_options[] = array( "name" => "Select Headings Font Family",
					"desc" => "Select a font family for headings",
					"id" => "standardfont_headings",
					"std" => "'Lato', 'Helvetica Neue', Helvetica, Arial, sans-serif",
					"type" => "select",
					"options" => $os_faces);

$of_options[] = array( "name" => "Font Sizes",
					"desc" => "",
					"id" => "font_size_intro",
					"std" => "<h3 style='margin: 0;'>Font Sizes</h3>",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" => "Body Font Size (px)",
					"desc" => "Default is 14",
					"id" => "bodyfont_size",
					"std" => "14",
					"type" => "select",
					"options" => $font_sizes);
   
$of_options[] = array( "name" => "Main nav fonT size (px)",
					"desc" => "Default is 17",
					"id" => "mnavfont_size",
					"std" => "17",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Copyright Font Size (px)",
					"desc" => "Default is 14",
					"id" => "cfont_size",
					"std" => "14",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading Font Size H1 (px)",
					"desc" => "Default is 36px",
					"id" => "h1font_size",
					"std" => "36",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading Font Size H2 (px)",
					"desc" => "Default is 30px",
					"id" => "h2font_size",
					"std" => "30",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading Font Size H3 (px)",
					"desc" => "Default is 24px",
					"id" => "h3font_size",
					"std" => "24",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading Font Size H4 (px)",
					"desc" => "Default is 18px",
					"id" => "h4font_size",
					"std" => "18",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading Font Size H5 (px)",
					"desc" => "Default is 14px",
					"id" => "h5font_size",
					"std" => "14",
					"type" => "select",
					"options" => $font_sizes);

$of_options[] = array( "name" => "Heading Font Size H6 (px)",
					"desc" => "Default is 12px",
					"id" => "h6font_size",
					"std" => "12",
					"type" => "select",
					"options" => $font_sizes);
					
$of_options[] = array( "name" => "Fonts Colors",
					"desc" => "",
					"id" => "fonts_colors",
					"std" => "<h3 style='margin: 0; margin-bottom:10px;''>Fonts Colors</h3> ",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array(
		"name" => "Font colors for page",
		'desc' => __('Choose a custom font color for page text.', 'theme_setup'),
		'id' => 'btext_color',
		'std' => '',
		'type' => 'color' );
	
$of_options[] = array(
		"name" => "",
		'desc' => __('Choose a custom font color for page text link.', 'theme_setup'),
		'id' => 'btextl_color',
		'std' => '',
		'type' => 'color' );
		
$of_options[] = array(
		"name" => "",
		'desc' => __('Choose a custom font color for page text link hover .', 'theme_setup'),
		'id' => 'btextlh_color',
		'std' => '',
		'type' => 'color' );
		
$of_options[] = array(
		"name" => "",
		'desc' => __('Choose a custom font color for heading.', 'theme_setup'),
		'id' => 'pageheading_color',
		'std' => '',
		'type' => 'color' );
	
$of_options[] = array(
		"name" => "",
		'desc' => __('Choose a custom font color for heading link.', 'theme_setup'),
		'id' => 'pageheadingl_color',
		'std' => '',
		'type' => 'color' );
		
$of_options[] = array(
		"name" => "",
		'desc' => __('Choose a custom font color for for page heading link hover .', 'theme_setup'),
		'id' => 'pageheadinglh_color',
		'std' => '',
		'type' => 'color' );


$of_options[] = array(
		           "name" => "Font colors for before footer",
		           'desc' => __('Choose a custom font color for before footer titles.', 'theme_setup'),
		           'id' => 'bfft_color',
		           'std' => '',
		           'type' => 'color' );	
		 
$of_options[] = array(
	           	   'name' => __('', 'theme_setup'),
		           'desc' => __('Before footer Link Color.', 'theme_setup'),
		           'id' => 'bottom_link_colorpicker',
		           'std' => '',
		           'type' => 'color' );
				
$of_options[] = array(
		'name' => __('', 'theme_setup'),
		'desc' => __('Before footer Link Hover Color', 'theme_setup'),
		'id' => 'bottom_hover_colorpicker',
		'std' => '',
		'type' => 'color' );
		
$of_options[] = array(
		"name" => "Font colors for footer",
		'desc' => __('Choose a custom font color for footer text.', 'theme_setup'),
		'id' => 'ft_color',
		'std' => '',
		'type' => 'color' );
		
$of_options[] = array(
		'name' => __('', 'theme_setup'),
		'desc' => __('Footer Link Color.', 'theme_setup'),
		'id' => 'footer_link',
		'std' => '',
		'type' => 'color' );
				
$of_options[] = array(
		'name' => __('', 'theme_setup'),
		'desc' => __('Footer Link Hover Color', 'theme_setup'),
		'id' => 'footer_linkhover',
		'std' => '',
		'type' => 'color' );
			
// Backup Options
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);
				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>

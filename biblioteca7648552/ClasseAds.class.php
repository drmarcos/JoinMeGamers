<?php
 class ClasseAds{
 
/* ----------------- [ FRASES ROTATE ] ----------------------------------- */

 	function rotateFrases(){
		$a = array(
				'A internet é o que você faz dela<font size=1px> &nbsp;&nbsp;&nbsp;&nbsp; <i>Autor: desconhecido</i></font>',
				' E=MC² :: Educação = Metodologia x Cultura²  <font size=1px> &nbsp;&nbsp;&nbsp;&nbsp; <i>Autor: M. Oliveira</i></font>',
				'Nada além do acaso é por acaso  <font size=1px> &nbsp;&nbsp;&nbsp;&nbsp; <i>Autor: M. Oliveira</i></font>',
				'A vida é para quem topa qualquer parada. Não para quem pára em qualquer topada.  <font size=1px> &nbsp;&nbsp;&nbsp;&nbsp; <i>Autor: Bob Marley</i></font>',
				'Escolhe um trabalho de que gostes, e não terás que trabalhar nem um dia na tua vida.  <font size=1px> &nbsp;&nbsp;&nbsp;&nbsp; <i>Autor: Confúcio</i></font>',
				'Aprender sem pensar é tempo perdido.  <font size=1px> &nbsp;&nbsp;&nbsp;&nbsp; <i>Autor: Confúcio</i></font>',
				'A primeira qualidade do estilo é a clareza.  <font size=1px> &nbsp;&nbsp;&nbsp;&nbsp; <i>Autor: Aristóteles</i></font>',
				'Você pode descobrir mais sobre uma pessoa em uma hora de brincadeira do que em um ano de conversa.  <font size=1px> &nbsp;&nbsp;&nbsp;&nbsp; <i>Autor: Platão</i></font>',
				'A imaginação é mais importante que o conhecimento.  <font size=1px> &nbsp;&nbsp;&nbsp;&nbsp; <i>Autor: Albert Einstein</i></font>',
				'Elo é aquilo que faz de você um prisioneiro de um sistema. <font size=1px> &nbsp;&nbsp;&nbsp;&nbsp; <i>Autor: M. Oliveira</i></font>',
				'Não há fatos eternos, como não há verdades absolutas.  <font size=1px> &nbsp;&nbsp;&nbsp;&nbsp; <i>Autor: Friedrich Nietzsche</i></font>'
				);
				shuffle($a);
				$na = array_slice($a, 0, 1);
				return implode('', $na);
	}
	
/* ----------------- [ BANNERS ROTATE ] ----------------------------------- */
 	
	function rotateBanners(){
	global $_PEGUE_SEU_AGORA,$DEBUG;

	$linkGooglePlay = 'https://play.google.com/store/apps/details?';
	$str = '';				

		$pasta = 'imagens/banners/';
		$arquivos = glob("$pasta{*.jpg,*.JPG,*.png,*.gif,*.bmp}", GLOB_BRACE);
		if($DEBUG != 0){			
			$str .= "Total de Jogos" . count($arquivos);
		}
		$rand = mt_rand(1, count($arquivos));
		switch($rand){
			case 1:
				$idLink = 'id=com.Owpoga.GamersNickNamesGen';
			break;			
			case 2:
				$idLink = 'id=com.Owpoga.TurfePlay';
			break;			
			case 3:
				$idLink = 'id=com.owpoga.kebrakokoSolar';
			break;			
			case 4:
				$idLink = 'id=com.Owpoga.PensamentosPositivos';
			break;			
			case 5:
				$idLink = 'id=com.Owpoga.KatwormaFullZoeira';
			break;			
			case 6:
				$idLink = 'id=com.Owpoga.NomesDeBebes';
			break;			
			case 7:
				$idLink = 'id=com.Owpoga.NickNameGen';
			break;			
			case 8:
				$idLink = 'id=com.owpoga.zapTurtle';
			break;			
			case 9:
				$idLink = 'id=com.owpoga.KebraKokoNumbersJapan';
			break;			
			case 10:
				$idLink = 'id=com.owpoga.KebraKokoJapanSignalLanguage';
			break;			
			case 11:
				$idLink = 'id=com.owpoga.KebraKokoAlphabetLibras';
			break;		
			case 12:
				$idLink = 'id=com.owpoga.kebrakokoRacingExtinction';
			break;	
			case 13:
				$idLink = 'id=com.owpoga.kebrakokoMandalaDragons';
			break;	
			case 14:
				$idLink = 'id=com.owpoga.kebrakokoArcaNoe';
			break;
			case 15:
				$idLink = 'id=com.owpoga.kebrakokoNumbers';
			break;
			case 16:
				$idLink = 'id=com.owpoga.kebrakokoPeriodic';
			break;
			case 17:
				$idLink = 'id=com.owpoga.zapGuitarIR';
			break;
			case 18:
				$idLink = 'id=com.owpoga.zapFootBallNL';
			break;
			case 19:
				$idLink = 'id=com.owpoga.zapFootBall';
			break;
			case 20:
				$idLink = 'id=com.owpoga.zapBeeOM';
			break;
			case 21:
				$idLink = 'id=com.owpoga.zapfish';
			break;
			case 22:
				$idLink = 'id=owpoga.com.zoombeeAWFree';
			break;
			/*
			default:
				$idLink = 'https://play.google.com/store/apps/dev?id=7396136443061298892';
			break;
			*/			
		}
		$exibeBanner = 'banner'.$rand.'.png';
		$montaLink = $linkGooglePlay.$idLink;
		$str .=	'<a href="'.$montaLink.'" title="'.$_PEGUE_SEU_AGORA.'" target="_blank"><img class="img-responsive" src="'.$pasta.'/'.$exibeBanner.'"></a>';

		return $str;
	}
	
/* ----------------- [ BANNERS ADSENSE ] ----------------------------------- */
	
	function MostraAds300x250(){
		$ads = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- banner300x250 -->
						<ins class="adsbygoogle"
						     style="display:inline-block;width:300px;height:250px"
						     data-ad-client="ca-pub-0818922531562498"
						     data-ad-slot="2765748123"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>';
			return $ads;
	}	

/* ----------------- [] ----------------------------------- */
	
	function MostraAds250x250(){		
		$ads =	'<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- responsivoLateral2018 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8534853200003363"
     data-ad-slot="6133699138"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';		
		return $ads;
	}	

/* ----------------- [] ----------------------------------- */

	function MostraAds728x90(){
		$ads = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- banner_728x90 -->
						<ins class="adsbygoogle"
						     style="display:inline-block;width:728px;height:90px"
						     data-ad-client="ca-pub-0818922531562498"
						     data-ad-slot="1428615720"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>';
			return $ads;
	}	

/* ----------------- [] ----------------------------------- */

	function ADsResponsivo2017(){
		$ads = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<!-- Responsivo2017 -->
					<ins class="adsbygoogle adslot_1"
					     style="display:block"
					     data-ad-client="ca-pub-0818922531562498"
					     data-ad-slot="8950624386"
					     data-ad-format="auto"></ins>
					<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
					</script>';
			return $ads;
	}	
	function ADsResponsivoTextual(){
	$ads = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- responsivo_apenas_texto -->
			<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-0818922531562498"
		     data-ad-slot="4585162486"
		     data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>';
			return $ads;
	}
 
	function ADsBannerBlog(){
	$ads = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-8534853200003363"
     data-ad-slot="3459178802"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>';
			return $ads;
	}
 }
?>
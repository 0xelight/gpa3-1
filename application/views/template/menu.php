<?php
//si classe()->compte existe
if(isset(classe()->compte))
{
	//Menu pour les utilisateurs simples
	if(classe()->compte == 1)
	{
		echo '	<ul id="menu-main-nav">
					<li>'.anchor('blog','<strong>News</strong><span class="navi-description">Nouveautés</span>').'</li>
					<li>'.anchor('planning','<strong>Planning</strong><span class="navi-description">Afficher le planning</span>').'</li>
					<li>'.anchor('reserver','<strong>Reserver</strong><span class="navi-description">Reserver une voiture</span>').'</li>
					<li>'.anchor('reserver/annuler','<strong>Annuler Reservation</strong><span class="navi-description">Supprimer une de vos reservations</span>').'</li>
					<li>'.anchor('reserver/remisage','<strong>Remisage</strong><span class="navi-description">Remisage à domicile</span>').'</li>';
		if(classe()->option_registre == true){	
		echo'		<li>'.anchor('registre','<strong>Registre</strong><span class="navi-description">Registre individuel</span>').'</li>';
		}
		if(classe()->voiture_attribue != null)
		{
			echo'	<li>'.anchor('recurrence','<strong>Récurrence</strong><span class="navi-description">Faire plusieurs réservation</span>').'</li>';
		}
		echo'		
					<li>'.anchor('utilisateur/mon_compte','<strong>Mon Compte</strong><span class="navi-description">Gérer mon compte</span>').'</li>
					<li>'.anchor('authentification/deconnexion','<strong>Déconnexion</strong>').'</li>
					</ul>';
	}
	//Menu pour les administrateur de service
	if(classe()->compte == 2)
	{
		echo '	<ul id="menu-main-nav">
					<li>'.anchor('blog','<strong>News</strong><span class="navi-description">Nouveautés</span>').'</li>
					<li>'.anchor('planning','<strong>Planning</strong><span class="navi-description">Afficher le planning</span>').'</li>
					<li>'.anchor('reserver' , '<strong>Reserver</strong><span class="navi-description">Reserver une voiture</span>').'</li>
					<li>'.anchor('reserver/annuler','<strong>Annuler Reservation</strong><span class="navi-description">Supprimer une de vos reservations</span>').'</li>
					<li>'.anchor('reserver/remisage','<strong>Remisage</strong><span class="navi-description">Remisage à domicile</span>').'</li>';
		if(classe()->option_registre == true){
			echo'	<li>'.anchor('registre','<strong>Registre</strong><span class="navi-description">Registre individuel</span>').'</li>';
		}
		if(classe()->voiture_attribue != null)
		{
			echo'	<li>'.anchor('recurrence','<strong>Récurrence</strong><span class="navi-description">Faire plusieurs réservation</span>').'</li>';
		}
			echo'	<li class="hover">'.anchor('utilisateur','<strong>Administration</strong><span class="navi-description">Panneau d\'administration</span>').'
						<ul class="sub-menu">
							<li>'.anchor('utilisateur','<span></span>Gestion utilisateur').'</li>
							<li>'.anchor('voiture','<span></span>Gestion voiture').'</li>
							<li>'.anchor('blog/gestion_blog','<span></span>Gestion articles').'</li>
							<li>'.anchor('reserver/remisage_agent','<span></span>Remisage à domicile des agents').'</li>';
					if(classe()->option_registre == true){
						echo'	<li>'.anchor('registre/registre_agent','<span></span>Registre des agents').'</li>';
					}
						echo'	<li>'.anchor('reserver/historique','<span></span>Historique réservation').'</li>
						</ul>
					</li>
					<li>'.anchor('utilisateur/mon_compte','<strong>Mon Compte</strong><span class="navi-description">Gérer mon compte</span>').'</li>
					<li>'.anchor('authentification/deconnexion','<strong>Déconnexion</strong>').'</li>
				</ul>';
	}
	if(classe()->compte == 3)
	{
		echo '	<ul id="menu-main-nav">
					<li>'.anchor('blog','<strong>News</strong><span class="navi-description">Nouveautés</span>').'</li>
					<li>'.anchor('demande/gestion_demande','<strong>Demandes</strong><span class="navi-description">Afficher les demandes</span>').'</li>
					<li>'.anchor('service/gestion_service','<strong>Service</strong><span class="navi-description">Gestion des services</span>').'</li>
					<li>'.anchor('utilisateur/gestion_utilisateur','<strong>Utilisateur</strong><span class="navi-description">Gestion des utilisateurs</span>').'</li>
					<li>'.anchor('voiture/gestion_voiture','<strong>Voiture</strong><span class="navi-description">Gestion des voitures</span>').'</li>
					<li>'.anchor('authentification/deconnexion','<strong>Déconnexion</strong>').'</li>
					</ul>';

	}						
}
?>
				<!-- ***************** - FIN Menu Principale - ***************** -->
				</div><!-- header-area -->
			</div><!-- end rays -->
		</div><!-- end header-holder -->
	</div><!-- end header -->
<div id="main">
<div class="main-area">
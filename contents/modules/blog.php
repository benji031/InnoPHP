<?php
	/**
	* Module Blog
	*/
	class BlogModule
	{

		function blog()
		{
			global $template;
			$template->assign("name", "Benjamin");
			echo "Page d'accueil du blog !";
		}

		/**
		 * Page qui affiche les articles en relation avec un tag dans l'url
		 *
		 * @url /tag/{$tag}
		 */
		function displayArticlesForTag($tag)
		{
			echo "Voici mon tag : ".$tag;
		}
	}
?>
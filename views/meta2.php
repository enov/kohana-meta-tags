<?php defined('SYSPATH') OR die('No direct script access.');

if ( ! isset($tags))
{
	$tags = Meta::instance()->get();
}
if ( ! Fragment::load(sha1(implode($tags)), Date::MINUTE * 5, TRUE))
{
	echo '<!-- meta tags begin -->';
	if (isset($tags['title']))
	{
		echo '<title>'.HTML::chars(implode(' - ', (array) $tags['title'])).'</title>';
		// echo '<title>'.HTML::entities(implode(' - ', (array) $tags['title'])).'</title>';
		unset($tags['title']);
	}
	$tags = array_filter($tags);
	foreach ($tags as $attributes)
	{
		echo '<meta'.HTML::attributes($attributes).'/>';
	}
	echo '<!-- meta tags end -->';
	Fragment::save();
}
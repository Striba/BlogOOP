<?php

return array (
	
        'note/post/([0-9]+)' => 'notes/post/$1', //actionPost NotesController $1 - $notes_id 
        'note/([0-9]+)' => 'notes/GetFullNotePage/$1',// actionGetFullNotePage 
        //в NotesController аргумент - $1 - id
	'post' => 'site/post', // actionPost в SiteController
	'' => 'site/index', // actionIndex в SiteController
	
);

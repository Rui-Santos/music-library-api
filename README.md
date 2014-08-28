Music Library API
=========

This API is a for of Recess Framework, a PHP based REST framework, created in the style of Ruby on Rails.
https://github.com/recess/recess

This is a project out of development, but it works for my purposes.  Redevelopment is in the pipeline using Node or Ruby.

I have modified elements of this core project to allow functions for fulltext searching, http authentication for API authorized users, individual authentication for site users (some of which has been removed from this repo for security purposes), as well as music library specific search functionality.

See specifically SqlBuilder.class.php, Controller.class.php, and the apps directory, for my additions.  Some are specific to these applications below, some are more generalized.

API is in use by the following projects:

www.thedinermusic.com
www.themusicplayground.com
www.takeourmusic.com

as well as a handful of other private applications.


<?
  
  namespace config\DB ;

  echo 'Configuration DataBase';

  const BASEDIR = ''; 

  const DBTYPE = '';
  const DBUSER = '';
  const DBPASS = '';
  const DBNAME = '';
  const DBHOST = '';
  const DBDSN  = DBTYPE.':host='.DBHOST.';dbname ='.DBNAME;


<?php
/**
* Installation controller for Amarok CMS. This file contains 
* everything to install the CMS, it checks if database.php in /config
* whether its empty or not, if not empty then it redirect to homepage 
* and if empty it show the installation form
*
* @package AmarokCMS
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install extends CI_Controller {



	 function __construct()
    	 {
    	     parent::__construct();
    	 }
    	 

	 
	public function index()
	{ 
	
	// Turn off all error reporting
	error_reporting(0);
	
	// load file helper
	$this->load->helper('file');
	
	#$dsn = 'mysql://root:@hostname/hyip';
	$dbfile = read_file('./application/config/database.php');
	
	// if the database config file has data then redirect to site
	if( !empty($dbfile)) {redirect(base_url());}
	
	
	
		echo '<html><head><title>AmarokCMS installation</title>
		
		<Style> body {
		background: #eee;
		font-weight:bold;
		color: #888;
		font-size: 12px;
		font-family:verdana; }
		
		#box {-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;width:300px; padding:20px 30px; margin: 50px auto; background: #fff;}
		h1 {font-size: 16px; text-align: center;}
		.text {-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;padding:8px; background: #Fafafa; border: 1px solid #ccc; margin-top: 2px; width:300px; margin-bottom:15px;}
		.text:focus {background: #fff;}
		.but {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
	background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#ededed", endColorstr="#dfdfdf");
	background-color:#ededed;
	-moz-border-radius:35px;
	-webkit-border-radius:35px;
	border-radius:35px;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#777777;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:1px 1px 0px #ffffff;
}.but:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) );
	background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#dfdfdf", endColorstr="#ededed");
	background-color:#dfdfdf;
}.but:active {
	position:relative;
	top:1px;
}</style>
		</head><body><div id="box">';
	
	

	$Form = form_open() . ' 
		<h1> Amarokcms v1.1 installation</h1>
	
		<label>Hostname</label><br />
		<input type="text" name="hostname" class="text" value="localhost"/><Br />

		<label>Username</label><br />
		<input type="text" name="username" class="text"/><Br />
		
		<label>Password</label><br />
		<input type="text" name="password" class="text"/><Br />
		
		<label>Database name</label><br />
		<input type="text" name="dbname" class="text"/><Br />
		<Center><input type="submit" name="submit" class="but" value="Install Now!" onclick="this.value='.'Please wait...'.'"/></center>
		'. form_close();
	
	
	
	// form helper
	$this->load->helper('form');
	
	//load form validation library
	$this->load->library('form_validation');

	// set validation rules
	$this->form_validation->set_rules('hostname', 'Hostname', 'required');
	$this->form_validation->set_rules('username', 'Username', 'required');
	$this->form_validation->set_rules('password', 'Password', '');
	$this->form_validation->set_rules('dbname', 'Database', 'required');
	
	
	// if form was submited and passed validation
	if ( $this->form_validation->run()  !== false ) {
	
	echo "<center>checking database info..</center><br />";

	# here we do the installation process	
	
	$connection = mysql_connect($this->input->post('hostname'), $this->input->post('username'), $this->input->post('password') );
	
	// if can not connect with provided info
	if( ! $connection ) {
		
		
		echo "<center>Couldn't connect to database</center><br />$Form";
		
	}
		
	else 
	
	{
		
	$selected_db = mysql_select_db($this->input->post('dbname'), $connection);
	
	
	// if can't select database
		if ( ! $selected_db ) {
			
			echo "<center>Couldn't select database, are you sure " .$this->input->post('dbname'). " exist?</center>";
			echo $Form;
			
			}
			
	# everything ok, lets go
	# first we try to write the info to database config file
	
	
	else {
			
		echo "<center><span style='color:green'>OK</span></center><br />";	
		
$database  = '<?php  if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\');
$active_group = \'default\';
$active_record = TRUE;
		
$db[\'default\'][\'hostname\'] = \''.$this->input->post('hostname').'\';
$db[\'default\'][\'username\'] = \''.$this->input->post('username').'\';
$db[\'default\'][\'password\'] = \''.$this->input->post('password').'\';
$db[\'default\'][\'database\'] = \''.$this->input->post('dbname').'\';

$db[\'default\'][\'dbdriver\'] = \'mysql\';
$db[\'default\'][\'dbprefix\'] = \'\';
$db[\'default\'][\'pconnect\'] = TRUE;
$db[\'default\'][\'db_debug\'] = TRUE;
$db[\'default\'][\'cache_on\'] = FALSE;
$db[\'default\'][\'cachedir\'] = \'\';
$db[\'default\'][\'char_set\'] = \'utf8\';
$db[\'default\'][\'dbcollat\'] = \'utf8_general_ci\';
$db[\'default\'][\'swap_pre\'] = \'\';
$db[\'default\'][\'autoinit\'] = TRUE;
$db[\'default\'][\'stricton\'] = FALSE;
		
		';
		
	// start writing to database.php
	echo "<center>Saving database info...</center><br />";
	
	
		if ( ! write_file('./application/config/database.php', $database) ) {
			
			echo "<center><span style='color:red'>FAILED</span></center><br />
			You may need to change /application/config/database.php file permision to 777<br />
			$Form";
			
			}
			
			else {
				
				echo "<center><span style='color:green'>OK</span></center><br />";
			
			// load the database class now
			$this->load->database();
			
				echo "<center>Creating Tables...</center><br />";
				
			// lets put sql dumb in variable
			
			$sql = "
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `content` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `category` varchar(40) NOT NULL,
  `visible` varchar(3) NOT NULL,
  `slug` text NOT NULL,
  `article_date` date NOT NULL,
  `sidebar` text NOT NULL,
  `page_order` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48		
			";
			
			$this->db->query($sql);

			
	// settings table			
			$sql = "
CREATE TABLE IF NOT EXISTS `settings` (
  `home_page` int(11) NOT NULL,
  `template` varchar(50) NOT NULL,
  `sitename` varchar(250) NOT NULL,
  `email_address` varchar(200) NOT NULL,
  `password` text NOT NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
			
	
	$this->db->query($sql);
	// insert sample data
		
		
			$sql = "
INSERT INTO `articles` (`id`, `name`, `title`, `description`, `keywords`, `content`, `type`, `category`, `visible`, `slug`, `article_date`, `sidebar`, `page_order`, `parent`) VALUES
(27, 'Home', 'My Website', 'My Website', 'My Website', '<p>\r\n <strong>Home Page</strong></p>\r\n<p>\r\n Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<p>\r\n It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '', '', 'No', 'home', '0000-00-00', '<p>\r\n <strong>Where does it come from?</strong></p>\r\n<p>\r\n Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC</p>\r\n', 1, 0),
(45, 'Drop down', 'Parent page', 'Parent page', 'Parent page', '<p>\r\n <strong>This page is a parent of other child pages.</strong></p>\r\n<p>\r\n It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '', '', 'Yes', 'dropdown', '0000-00-00', '<p>\r\n <strong>Sidebar content</strong></p>\r\n<p>\r\n It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 2, 0),
(46, 'Child Page', 'Child page', 'Child page', 'Child page', '<p>\r\n <strong>This page is a child of Drop down page</strong></p>\r\n<p>\r\n Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n', '', '', '', 'Child-Page', '0000-00-00', '<p>\r\n <strong>Child page</strong></p>\r\n<p>\r\n Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n', 1, 45),
(47, 'Another Child', 'another child', 'another child', 'another child', '<p>\r\n <strong>another child page</strong></p>\r\n<p>\r\n Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n', '', '', '', 'another', '0000-00-00', '<ol>\r\n <li>\r\n  Cras a tincidunt eros.</li>\r\n <li>\r\n  Sed et mauris non arcu pretium</li>\r\n <li>\r\n  molestie sit amet at tortor.</li>\r\n <li>\r\n  Nunc dolor erat, accumsan ut</li>\r\n <li>\r\n  porttitor sit amet, sagittis sit amet</li>\r\n <li>\r\n  purus. Morbi nec orci lorem,</li>\r\n <li>\r\n  a laoreet turpis. Duis iaculis</li>\r\n</ol>\r\n', 2, 45);
";

		$this->db->query($sql);
		
		
		
		$sql = "
		
INSERT INTO `settings` (`home_page`, `template`, `sitename`, `email_address`, `password`) VALUES
(27, 'plan', 'My Website', 'you@email.com', '21232f297a57a5a743894a0e4a801fc3');

		";
		
		
		$this->db->query($sql);
		
		echo "<center>Done!<br />";
		echo "Your can now login using the following details: <br /><a href=\"".base_url()."admin\">".base_url()."/admin</a><br />";
		echo "Username: admin<br />Password: admin</center>";
		
		
		
		

			}
			
			
		}	
			
		
	}	
		
		
	# end installation process	
		
	}
		
	else {	
	
	echo "<center>".validation_errors() ."</center>";
		
	echo form_open();	
	echo '<h1> Amarokcms v1.1 installation</h1>
	
		<label>Hostname</label><br />
		<input type="text" name="hostname" class="text" value="localhost"/><Br />

		<label>Username</label><br />
		<input type="text" name="username" class="text"/><Br />
		
		<label>Password</label><br />
		<input type="text" name="password" class="text"/><Br />
		
		<label>Database name</label><br />
		<input type="text" name="dbname" class="text"/><Br />
		<Center><input type="submit" name="submit" class="but" value="Install Now!" onclick="this.value='.'Please wait...'.'"/></center>
		';
	
	echo form_close();
	
	echo '</div></body></html>';
		
		}
	}
	
	

		


	
}
?>

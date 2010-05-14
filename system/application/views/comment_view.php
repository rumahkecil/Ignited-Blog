<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="description" content="Personal blog discussing various projects and ideas. Authored by Joshua Kehn at http://joshuakehn.com" /> 
	<meta name="keywords" content="joshua kehn, blog, programming, php, mysql, java, brighton, michigan, new york, long island, javascript, python, ruby, perl, thoughts" /> 
	
	<title><?php echo($title); ?></title>
	
	<script src="<?php echo(base_url()); ?>js/jquery-1_4_2.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo(base_url()); ?>js/script.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href='<?php echo(base_url()); ?>css/blueprint/screen.css' type="text/css" media="screen, projection" /> 
	<link rel="stylesheet" href='<?php echo(base_url()); ?>css/blueprint/print.css' type="text/css" media="print" /> 
	<!--[if lt IE 8]>
	    <link rel="stylesheet" href='<?php echo(base_url()); ?>css/blueprint/ie.css' type="text/css" media="screen, projection">
	  <![endif]-->
	<link rel="stylesheet" href='<?php echo(base_url()); ?>css/style.css' type="text/css" media="screen, projection" /> 
</head>
<body>
	<div class="container">
		<div id="masthead" class="span-24 last">
			<?php $this->load->view('masthead_view'); ?>
		</div>
		<div id="navigation" class="span-24 last">
			<?php
				if($this->session->userdata('loggedin'))
				{
					?>
					<ul>
						<li><a href="<?php echo(base_url()); ?>index.php/blog/insert" title="Create New Post">New Post</a></li>
						<li><a href="<?php echo(base_url()); ?>index.php/blog/logout" title="Logout">Logout</a></li>
					</ul>
					<?php
				}
			
			?>
		</div>
		<div class="span-24 last" id="content">
			<div class="span-18" id="comments">
				<?php $this->load->view('message_view'); ?>
				<?php
					if(isset($post) and isset($comments))
					{
						?>
						<h2>Comments for <a href="<?php echo(base_url()); ?>index.php/blog/view/<?php echo($post->id)?>/<?php echo(str_replace(' ', '-', $post->title)); ?>/" 
							title="<?php echo($post->title)?>"><?php echo($post->title); ?></a>
						<?php
						if(!$post->commentlock)
						{
							?>[Locked]<?php
						}
						?>
						</h2>
						<h4><a href="<?php echo(base_url()); ?>index.php/blog/view/<?php echo($post->id)?>/<?php echo(str_replace(' ', '-', $post->title)); ?>/" 
							title="<?php echo($post->title)?>">Back to post</a></h4>
						<?php
						
						foreach($comments as $c)
						{
							if($c->flagged == "false" or ($c->flagged == "true" and $c->flagcount <= 2))
							{
								?>
								<div class="comment span-12">
								
								<h5>
								<?php
								if(isset($c->website))
								{
									?>
									<a href="<?php echo($c->website);?>"><?php echo($c->author); ?></a> wrote:
									<?php
								}
								else
								{
									echo($c->author); ?> wrote:
									<?php
								}
								?>
								</h5>
								<div class="date"><?php echo($c->date); ?></div>
								<div class="commentbody">
								<?php
								echo($c->body);
								?>
								</div>
								
								<div class="commenttoolbar">
								<a href="<?php echo(base_url()); ?>index.php/blog/flag/comment/<?php echo($c->id); ?>/" title="Flag as spam, offensive, or requires attention">Flag</a>
								</div>
								</div>
								<?php
							}
						}
						?>						
						<div id="postfooter" class="span-12">
							<a href="<?php echo(base_url()); ?>index.php/blog/comments/<?php echo($post->id); ?>/add/" title="Add comment">Add Comment</a>
							<br />
							<a href="<?php echo(base_url()); ?>index.php/blog/" title="Back to home page">Back to home page</a>
						</div>
						<?php
					}
				?>
				
			</div>
			<div class="span-4 last" id="sidebar">
				<?php $this->load->view('sidebar_view'); ?>
			</div>
		</div>
		
		<div class="span-24 last" id="footer">
			<?php $this->load->view('footer'); ?>
		</div>
	</div>
</body>
</html>
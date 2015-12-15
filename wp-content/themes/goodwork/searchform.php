<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
        <input type="text" value="<?php _e('Search the site', 'goodwork'); ?>" name="s" id="s" />
        <div class="holder">
	        <input type="submit" id="searchsubmit" value="Search" />
	        <i class="krown-icon-search"></i>
   		</div>
    </div>
</form>
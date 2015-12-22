<?php
/*---------------------------------
	Single Page Templte
------------------------------------*/
if (is_page('People')) {
get_header();

	if ( have_posts() ) while ( have_posts() ) : the_post();


$args = array(
			'post_type' => 'portfolio'

		);

$portfolio_posts = new WP_Query( $args );

if( $portfolio_posts->have_posts() ) {

                        $faculty = array();
                        $students = array();
			while( $portfolio_posts->have_posts() ) {
				$portfolio_posts->the_post();

				$content = apply_filters( 'the_content', get_the_content() );
				$content = str_replace( ']]>', ']]&gt;', $content );


                                $begContent = stripos($content,'<div class="rbTeam');
                                $endContent = stripos($content, '<hr /></div>');
                                $endContent+=12;
                                $length = $endContent-$begContent;
                                $person = substr($content,$begContent,$length);

                                # get last name and set as key for sorting. this will break if there is more than one space in the name
                                	$nameBeg = stripos($person,"<h3>");
                                	$nameBeg += 4;
                                	$nameEnd = stripos($person,"</h3>");
                                	$nameLength = $nameEnd-$nameBeg;
                                	$name = substr($person,$nameBeg,$nameLength);
                                	$nameSplit = explode(" ",$name);
                                	$lastname = $nameSplit[1];
                                  $firstname = $nameSplit[0];

																	$url = home_url();

																	if (stripos($person,'id="faculty_title"')) {
	                                     if (!in_array($person,$faculty)) {
	                                          $person = str_replace("<h3>","<h3><a href='".$url."/projects/?f=$firstname-$lastname'>",$person);
	                                           $person = str_replace("</h3>","</a></h3>",$person);

	                                           $lastname=$lastname.$firstname;


	                                           $faculty[$lastname] = $person;



	                                     }
	                                }
                                if (stripos($person,'id="student_yrmajor"')) {
                                     if (!in_array($person,$students)) {

                                           $lastname=$lastname.$firstname;
                                           $students[$lastname] = $person;
                                     }
                                }

                              # loop through the rest of the content of the rest of the posts
															$nextContent = stripos($content,'<div class="rbTeam',$endContent);

															while ($nextContent!=false) {
																	 $nextEndContent = stripos($content, '<hr /></div>',$nextContent);
																	 $nextEndContent+=12;
																	 $nextLength = $nextEndContent-$nextContent;
																	 $nextPerson = substr($content,$nextContent,$nextLength);

																	 # get last name and set as key for sorting. this will break if there is more than one space in the name
																$nameBeg = stripos($nextPerson,"<h3>");
																$nameBeg += 4;
																$nameEnd = stripos($nextPerson,"</h3>");
																$nameLength = $nameEnd-$nameBeg;
																$name = substr($nextPerson,$nameBeg,$nameLength);
																$nameSplit = explode(" ",$name);
																$lastname = $nameSplit[1];
																			$firstname = $nameSplit[0];


                                      if (stripos($nextPerson,'id="faculty_title"')) {
                                     	if (!in_array($nextPerson,$faculty)) {
                                             $person = str_replace("<h3>","<h3><a href='".$url."/projects/?f=$firstname-$lastname'>",$person);
                                             $nextPerson = str_replace("</h3>","</a></h3>",$nextPerson);

                                             $lastname=$lastname.$firstname;
                                             $faculty[$lastname]=$nextPerson;
                                     	}
                                     }
                                     if (stripos($nextPerson,'id="student_yrmajor"')) {
                                     	if (!in_array($nextPerson,$students)) {

                                             $lastname=$lastname.$firstname;
                                             $students[$lastname]=$nextPerson;
                                     	}
                                     }

                                     $nextContent = stripos($content,'<div class="rbTeam',$nextEndContent);


                                } //end while nextContent



			} //end while porfolio posts

                    ?>

										<div id="faculty">
                            <h2>Faculty</h2>

                       <?php

                          ksort($faculty);
                          foreach ($faculty as $professor) {
                               echo $professor;
                          }



 ?>
		      </div>

                      <div id="students">
                             <h2>Students</h2>
                       <?php ksort($students);?>
                       <?php foreach ($students as $student) {
				echo $student;
                             } ?>

		      </div>
<?php

		} else {
			echo "D'oh! No researchers yet.";
		}






		if(comments_open() && ot_get_option('rb_allow_page_comments', 'false') == 'true')
			comments_template( '', true );

	endwhile;

get_footer();
} else {
get_header();
       if ( have_posts() ) while ( have_posts() ) : the_post();
       the_content();
		if(comments_open() && ot_get_option('rb_allow_page_comments', 'false') == 'true')
			comments_template( '', true );

	endwhile;

get_footer();

}
?>

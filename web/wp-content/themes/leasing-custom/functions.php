<?php
/*
** The Theme's functions file.
*/

session_start();

include 'theme-functions/theme-setup.php';
//include 'theme-functions/calendar.php';
include 'theme-functions/Database/DBHandler.php';
include 'theme-functions/Spreadsheet/SpreadsheetHandler.php';
include 'theme-functions/Mobile-Detect/Mobile_Detect.php';
include 'theme-functions/platform/units.php';
include 'theme-functions/platform/search.php';

function get_the_content_by_id($post_id) {
	$page_data = get_page($post_id);

	if ($page_data) {
		return $page_data->post_content;
	}

	else return false;
}

function addNewsletterToRepo($cfdata) {
	$formTitle = $cfdata->title;
	
	if (strpos($formTitle, 'Newsletter Form') !== false) {

		//LOCAL DB
		/*$host = 'localhost';
        $db_name = 'leasing_leads';
        $user = 'root';
        $pwd = 'root';*/

        //STAGING
        /*$host = 'localhost:3306';
        $db_name = 'leasing_leads';
        $user = 'staging_leasing';
        $pwd = 'leasingLeads$$##';*/

        //LIVE
        $host = '205.186.138.226';
        $db_name = 'leasing_leads';
        $user = 'leasingLeadsProd';
        $pwd = 'leads$$123%%';

        $link = mysqli_connect($host, $user, $pwd);
        $db_selected = mysqli_select_db($link, $db_name);
        $date_subscribed = date('Y-m-d H:i:s');

        $query = "INSERT INTO `contact_forms` (name, email, page_converted, date_added, type, optin_status) VALUES ('".$_POST['name']."', '".$_POST['email']."', '".$_SERVER['HTTP_REFERER']."', '".$date_subscribed."', 'subscriber', '0')";
        $sql = mysqli_query($link, $query);

        $_SESSION['thank-you'] = 1;

	} else if (strpos($formTitle, 'Commercial Property Form') !== false) {
        //LOCAL DB
        /*$host = 'localhost';
        $db_name = 'leasing_leads';
        $user = 'root';
        $pwd = 'root';*/
        $ss = new SpreadsheetHandler;

        //STAGING
        /*$host = 'localhost:3306';
        $db_name = 'leasing_leads';
        $user = 'staging_leasing';
        $pwd = 'leasingLeads$$##';*/

        //LIVE
        $host = '205.186.138.226';
        $db_name = 'leasing_leads';
        $user = 'leasingLeadsProd';
        $pwd = 'leads$$123%%';

        $name = $_POST['fname'].' '.$_POST['lname'];

        $link = mysqli_connect($host, $user, $pwd);
        $db_selected = mysqli_select_db($link, $db_name);
        $date_subscribed = date('Y-m-d H:i:s');

        $query = "INSERT INTO `contact_forms` (name, contact, email, page_converted, client_ip, date_added, status, message, type, property) VALUES ('".$name."', '".$_POST['contact']."', '".$_POST['email']."', '".$_SERVER['HTTP_REFERER']."', '".$_POST['clientIp']."' , '".$date_subscribed."', '', '".$_POST['message']."', '".$_POST['propertyType']."', '".$_POST['property']."')";
        $sql = mysqli_query($link, $query);
        
        $data = array(
            'name' => $name,
            'contactnumber' => $_POST['contact'],
            'email' => $_POST['email'],
            'pageconverted' => $_SERVER['HTTP_REFERER'],
            'propertytype' => $_POST['propertyType'],
            'property' => $_POST['property'],
            'message' => $_POST['message'],
            'dateinquired' => $date_subscribed,
        );
        $ss->addContactLeadToDocs($data);

        $_SESSION['thank-you'] = 1;


    } else if (strpos($formTitle, 'Contact Us') !== false) {
        //LOCAL DB
        /*$host = 'localhost';
        $db_name = 'leasing_leads';
        $user = 'root';
        $pwd = 'root';*/
        $ss = new SpreadsheetHandler;

        //STAGING
        /*$host = 'localhost:3306';
        $db_name = 'leasing_leads';
        $user = 'staging_leasing';
        $pwd = 'leasingLeads$$##';*/

        //LIVE
        $host = '205.186.138.226';
        $db_name = 'leasing_leads';
        $user = 'leasingLeadsProd';
        $pwd = 'leads$$123%%';

        $link = mysqli_connect($host, $user, $pwd);
        $db_selected = mysqli_select_db($link, $db_name);
        $date_subscribed = date('Y-m-d H:i:s');

        $query = "INSERT INTO `contact_forms` (name, contact, email, page_converted, date_added, message, type) VALUES ('".$_POST['name']."', '".$_POST['contact']."', '".$_POST['email']."', '".$_SERVER['HTTP_REFERER']."', '".$date_subscribed."', '".$_POST['message']."', 'inquiries')";
        $sql = mysqli_query($link, $query);
        
        $data = array(
            'name' => $_POST['name'],
            'contact' => $contact,
            'email' => $_POST['email'],
            'page_converted' => $_SERVER['HTTP_REFERER'],
            'date' => $date_subscribed,
            'message' => $_POST['message'],
            'status' => 'inquiries',
        );
        $ss->addContactFormLead($data);

        $_SESSION['thank-you'] = 1;
    }
}
add_action('wpcf7_mail_sent', 'addNewsletterToRepo', 1);

function getDatesFromRange($start, $end) {
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(
         new DateTime($start),
         $interval,
         $realEnd
    );

    foreach($period as $date) { 
        $array[] = $date->format('Y-m-d'); 
    }

    return $array;
}

function getAllBookings($id) {
    $db = new DBHandler();
    $db->connect();
    $data = $db->getAllApprovedBookings($id);
    $return = array();

    if (!empty($data)) :
        $i = 0;
        foreach ($data as $d) {
            $start = substr($d['check_in'], 6, 4).'-'.substr($d['check_in'], 0, 2).'-'.substr($d['check_in'], 3, 2);
            $end = substr($d['check_out'], 6, 4).'-'.substr($d['check_out'], 0, 2).'-'.substr($d['check_out'], 3, 2);

            $return[$i]['start'] = $start;
            $return[$i]['end'] = $end;

            $i++;
        }
    endif;

    return $return;
}

function getAllAppointments($id) {
    $db = new DBHandler();
    $db->connect();
    $data = $db->getAllAppointmentsApproved($id);
    $return = array();

    if (!empty($data)) {
        $i = 0;
        foreach ($data as $d) {
            $preferred_date = substr($d['preferred_date'], 6, 4).'-'.substr($d['preferred_date'], 0, 2).'-'.substr($d['preferred_date'], 3, 2);
            $preferred_time = $d['preferred_time'];

            $return[$i]['preferred_date'] = $preferred_date;
            $return[$i]['preferred_time'] = $preferred_time;
        }
    }

    return $return;
}

add_action('load-post.php', 'calendar_metabox_setup');
add_action('load-post-new.php', 'calendar_metabox_setup');

function calendar_metabox_setup() {
    add_action('add_meta_boxes', 'add_calendar_metabox');
    add_action('save_post', 'save_calendar_metabox', 10, 2);
}

function add_calendar_metabox() {
    add_meta_box(
        'calendar',
        esc_html__('Calendar', 'caledar'),
        'calendar_metabox',
        'booking_calendar',
        'normal',
        'high'
    );
}

function calendar_metabox($object, $box) { ?>

    <div id="unitCalendar" class="responsive-calendar">

        <div class="controls">
            <a class="pull-left" data-go="prev"><div class="btn"><i class="glyphicon glyphicon-chevron-left"></i></div></a>
            <h4><span data-head-year></span> <span data-head-month></span></h4>
            <a class="pull-right" data-go="next"><div class="btn"><i class="glyphicon glyphicon-chevron-right"></i></div></a>
        </div>

        <div class="day-headers">
            <div class="day header">Mon</div>
            <div class="day header">Tue</div>
            <div class="day header">Wed</div>
            <div class="day header">Thu</div>
            <div class="day header">Fri</div>
            <div class="day header">Sat</div>
            <div class="day header">Sun</div>
        </div>

        <div class="days" data-group="days">

        </div>
    </div>

    <script src="http://leasing.dmcihomes.com/wp-admin/js/responsive-calendar.js"></script>

    <?php
        $start = get_post_meta($object->ID, 'availability_start', true);
        $end = get_post_meta($object->ID, 'availability_end', true);
        $dates = getDatesFromRange($start, $end);
        $temp = getAllBookings($object->ID);
        $bookedDates = getDatesFromRange($temp['start'], $temp['end']);
    ?>

    
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.responsive-calendar').responsiveCalendar({
                activateNonCurrentMonths: true,
                allRows: false,
                events: {
                    <?php
                        foreach ($dates as $date) {
                            echo "\"".$date."\": {},\n";
                        }
                    ?>

                    <?php
                        foreach ($bookedDates as $bookedDate) {
                            echo "\"".$bookedDate."\": {\"class\": \"active booked\"}, \n";
                        }
                    ?>
                }
            });
        });
    </script>
<?php
}

function save_calendar_metabox($post_id, $post) {

    /* Verify the nonce before proceeding. */
    if (!isset( $_POST['slide_link_nonce'] ) || !wp_verify_nonce($_POST['slide_link_nonce'], basename( __FILE__ )))
    return $post_id;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

    /* Get the posted data */
    if(isset( $_POST['slide-link'] )) :
        $new_meta_value = $_POST['slide-link'];
    endif;

    /* Get the meta key. */
    $meta_key = 'calendar';

    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta( $post_id, $meta_key, true );

    /* If a new meta value was added and there was no previous value, add it. */
    if ( $new_meta_value && '' == $meta_value )
        add_post_meta( $post_id, $meta_key, $new_meta_value, true );

    /* If the new meta value does not match the old value, update it. */
    elseif ( $new_meta_value && $new_meta_value != $meta_value )
        update_post_meta( $post_id, $meta_key, $new_meta_value );

    /* If there is no new meta value but an old value exists, delete it. */
    elseif ('' == $new_meta_value && $meta_value )
        delete_post_meta( $post_id, $meta_key, $meta_value );
}

function leasing_paging_nav() {
    // Don't print empty markup if there's only one page.
    if ($GLOBALS['wp_query']->max_num_pages < 2) {
        return;
    }

    $paged        = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $query_args   = array();
    $url_parts    = explode('?', $pagenum_link);

    if (isset( $url_parts[1])) {
        wp_parse_str($url_parts[1], $query_args);
    }

    $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
    $pagenum_link = trailingslashit($pagenum_link).'%_%';

    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links(array(
        'base'     => $pagenum_link,
        'format'   => $format,
        'total'    => $GLOBALS['wp_query']->max_num_pages,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => __( '<span aria-hidden="true">&laquo;</span>', 'nuhartph' ),
        'next_text' => __( '<span aria-hidden="true">&raquo;</span>', 'nuhartph' ),
        'type'     => 'list'
    ));

    if ($links) :
?>
    <nav>
        <?php echo $links; ?>
    </nav>
<?php
    endif;
}

function leasing_post_nav() {

    $previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);

    if (!$next && !$previous) {
        return;
    }

    ?>
    <nav class="navigation post-navigation" role="navigation">
        <div class="nav-links">
            <?php
                previous_post_link( '%link', __('<span class="meta-nav"><span class="glyphicon glyphicon-chevron-left"></span> Previous</span>', 'nuhart') );
                next_post_link( '%link', __('<span class="meta-nav">Next Post <span class="glyphicon glyphicon-chevron-right"></span></span>', 'nuhart') );
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}

//function to call first uploaded image in functions file
function main_image() {
    global $post, $posts;

    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    return $first_img;
}

function getImage($num) {
    global $more;
    $more = 1;
    $link = get_permalink();
    $content = get_the_content();
    $count = substr_count($content, '<img');
    $start = 0;

    for ($i = 1; $i <= $count; $i++) {
        $imgBeg = strpos($content, '<img', $start);
        $post = substr($content, $imgBeg);
        $imgEnd = strpos($post, '>');
        $postOutput = substr($post, 0, $imgEnd+1);
        $postOutput = preg_replace('/width="([0-9]*)" height="([0-9]*)"/', '',$postOutput);;
        $image[$i] = $postOutput;
        $start = $imgEnd+1;
    }

    if (stristr($image[$num],'<img')) { 
        echo $image[$num]; 
    }
    $more = 0;
}

function getClientIp() {
    $ip = getenv('HTTP_CLIENT_IP')?:
    getenv('HTTP_X_FORWARDED_FOR')?:
    getenv('HTTP_X_FORWARDED')?:
    getenv('HTTP_FORWARDED_FOR')?:
    getenv('HTTP_FORWARDED')?:
    getenv('REMOTE_ADDR');

    return $ip;
}

function propertyBreadcrumbs() {
    global $post;

    $breadcrumb = '<span prefix="v: http://rdf.data-vocabulary.org/#">';

    //Home
    $breadcrumb .= '<span typeof="v:Breadcrumb">';
    $breadcrumb .= '<a href="'.get_site_url().'" rel="v:url" property="v:title">Home</a>';
    $breadcrumb .= '</span> / ';

    //Property Location
    $loc = get_post_meta($post->ID, 'property_location', true);
    $locTerm = get_term_by('name', $loc, 'location', ARRAY_A);
    $url = get_site_url().'/'.$locTerm['slug'].'/';

    $breadcrumb .= '<span typeof="v:Breadcrumb">';
    $breadcrumb .= '<a href="'.$url.'" rel="v:url" property="v:title">Properties in '.$loc.'</a>';
    $breadcrumb .= '</span> / ';

    $breadcrumb .= '<span typeof="v:Breadcrumb">';
    $breadcrumb .= '<strong class="breadcrumb_last" property="v:title">'.get_the_title($post->ID).'</strong>';
    $breadcrumb .= '</span>';

    echo $breadcrumb;
}

function unitBreadcrumbs() {
    global $post;
    global $wpdb;

    $breadcrumb = '<span prefix="v: http://rdf.data-vocabulary.org/#">';

    //Home
    $breadcrumb .= '<span typeof="v:Breadcrumb">';
    $breadcrumb .= '<a href="'.get_site_url().'" rel="v:url" property="v:title">Home</a>';
    $breadcrumb .= '</span> / ';

    //Property
    $wpdb->query("
        SELECT `id`, `post_title`
        FROM $wpdb->posts
        WHERE `post_type` = 'page'
    ");

    $property = 0;

    foreach ($wpdb->last_result as $v) {
        if (strpos(get_the_title(), $v->post_title) !== false) {
            $property = $v->id;
        }
    }

    //Property Location
    $loc = get_post_meta($property, 'property_location', true);
    $locTerm = get_term_by('name', $loc, 'location', ARRAY_A);
    $url = get_site_url().'/'.$locTerm['slug'].'/';

    $breadcrumb .= '<span typeof="v:Breadcrumb">';
    $breadcrumb .= '<a href="'.$url.'" rel="v:url" property="v:title">Properties in '.$loc.'</a>';
    $breadcrumb .= '</span> / ';

    $breadcrumb .= '<span typeof="v:Breadcrumb">';
    $breadcrumb .= '<a href="'.get_the_permalink($property).'" rel="v:url" property="v:title">'.get_the_title($property).'</a>';
    $breadcrumb .= '</span> / ';

    //Unit
    $breadcrumb .= '<span typeof="v:Breadcrumb">';
    $breadcrumb .= '<strong class="breadcrumb_last" property="v:title">'.get_the_title($post->ID).'</strong>';
    $breadcrumb .= '</span>';

    echo $breadcrumb;
}

function nonResidentialBreadcrumbs() {
    global $post;

    $breadcrumb = '<span prefix="v: http://rdf.data-vocabulary.org/#">';

    //Home
    $breadcrumb .= '<span typeof="v:Breadcrumb">';
    $breadcrumb .= '<a href="'.get_site_url().'" rel="v:url" property="v:title">Home</a>';
    $breadcrumb .= '</span> / ';

    //Commercial or Event
    if ($post->post_type == 'commercial') {
        $breadcrumb .= '<span typeof="v:Breadcrumb">';
        $breadcrumb .= '<a href="'.get_site_url().'/?property_type=rent-commercial" rel="v:url" property="v:title">Commercial Properties</a>';
        $breadcrumb .= '</span> / ';
    } else {
        $breadcrumb .= '<span typeof="v:Breadcrumb">';
        $breadcrumb .= '<a href="'.get_site_url().'/?property_type=rent-events" rel="v:url" property="v:title">Events Venues</a>';
        $breadcrumb .= '</span> / ';
    }

    $breadcrumb .= '<span typeof="v:Breadcrumb">';
    $breadcrumb .= '<strong class="breadcrumb_last" property="v:title">'.get_the_title($post->ID).'</strong>';
    $breadcrumb .= '</span>';

    echo $breadcrumb;
}

?>
<?php
/*
Plugin Name: Ajax Social
Plugin URI:  http://bigmikestudios.com/
Description: Adds ajax actions to retrieve social media
Version:     0.1-alpha
Author:      Mike Lathrop
Author URI:  http://bigmikestudios.com
*/

// make sure ajaxurl is defined:

add_action('wp_head','pluginname_ajaxurl');
function pluginname_ajaxurl() {
    ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
<?php
}

/*session_start();
require_once("twitteroauth-master/twitteroauth/twitteroauth.php"); //Path to twitteroauth library

$twitteruser = "iafbc";
$notweets = 2;
$consumerkey = "PlxuNdfmNQg1rt9pnF0L8K1kU";
$consumersecret = "Wkulo79SOsEmlQvqmSCDaiDbO8ywRa0JIvvoBMFdaYPL2d5gH6";
$accesstoken = "14864996-Ya9fNZarCjMYNyK6HPluj0Mothx3LpioeOdJYCEM5";
$accesstokensecret = "lqGV9eWg3X6mEWDSnuz4no83cGMXtIZYV6QSNd2jprC0f";

function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
    $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
    return $connection;
}

$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

echo json_encode($tweets);*/


function get_tweets() {
    // The $_REQUEST contains all the data sent via ajax
    if ( isset($_REQUEST) ) {

        /*// get Vancouver weather from Environment Canada
        $xml=simplexml_load_file("https://weather.gc.ca/rss/city/bc-74_e.xml") or $xml = null;

        $weather = "";
        if ($xml) {
            $weather = $xml->entry[1]->title;
            $weather = substr($weather, 20); // removes "Current Conditions: " from beginning.


            $date = $xml->entry[1]->updated;
            $date = new DateTime($date);
            $date = $date->format('d/m/y');
            $weather = $date." | ".$weather;
        }

        echo ($weather);*/


        require_once("twitteroauth-master/twitteroauth/twitteroauth.php"); //Path to twitteroauth library

        $twitteruser = "fieldhockeycan";
        $notweets = 2;
        $consumerkey = "PlxuNdfmNQg1rt9pnF0L8K1kU";
        $consumersecret = "Wkulo79SOsEmlQvqmSCDaiDbO8ywRa0JIvvoBMFdaYPL2d5gH6";
        $accesstoken = "14864996-Ya9fNZarCjMYNyK6HPluj0Mothx3LpioeOdJYCEM5";
        $accesstokensecret = "lqGV9eWg3X6mEWDSnuz4no83cGMXtIZYV6QSNd2jprC0f";

        function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
            $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
            return $connection;
        }

        $connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

        $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

        echo json_encode($tweets);

    }

    // Always die in functions echoing ajax content
    die();
}

add_action( 'wp_ajax_get_tweets', 'get_tweets' );
add_action( 'wp_ajax_nopriv_get_tweets', 'get_tweets' );
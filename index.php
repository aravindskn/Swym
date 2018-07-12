<!DOCTYPE HTML>
<html>
<head>
    <title>Tweets</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="is-preload">
<div id="page-wrapper">

    <!-- Header -->
    <header id="header">
        <h1><a href="index.html">Tweets</a></h1>
        <nav id="nav">

        </nav>
    </header>

    <!-- Main -->
    <section id="main" class="container">
        <header>
            <h2>DashBoard</h2>
            <p>Most Popular Tweets.</p>
        </header>
        <?php
        if(array_key_exists('btn',$_POST))
        {

                $name = $_POST["name"];
                $count = $_POST["count"];

            fun1($name,$count);
        }
        function fun1($name,$count)
        {
            require_once('TwitterAPIExchange.php');
            $settings = array(   'oauth_access_token' => "1017293751473995777-I6NyJRZgEUAjfHk9TABlC3BV2azizg",
                'oauth_access_token_secret' => "YMnUB6rbgwWhZEV9xrOZvkHKPPj370kkAmg0qDBXS56h4",
                'consumer_key' => "ve11Y5gDvzMDocOklgB308swW",
                'consumer_secret' => "olc01NKLEHA3ksxlrKzdAHcNSsc9e84aPbDbrULCeWB1V0zMZs"
            );

            $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
            $url2 = '&count=';
            $requestMethod = 'GET';
            $getfield = '?screen_name='.$name.'&count='.$count;
            $requestMethod = 'GET';

            $twitter = new TwitterAPIExchange($settings);
            //$twitter->setGetfield($getfield)
            //      ->buildOauth($url, $requestMethod)
            //    ->performRequest();
            $string = json_decode($twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest(),$assoc = TRUE);
            array_multisort($string);
            function val_sort($array,$key) {

                //Loop through and get the values of our specified key
                foreach($array as $k=>$v) {
                    $b[] = strtolower($v[$key]);
                }

                //  print_r($b);

                arsort($b);

                // echo '<br />';

                // print_r($b);

                foreach($b as $k=>$v) {
                    $c[] = $array[$k];
                }

                return $c;
            }
            $sorted = val_sort($string, 'retweet_count');
            foreach($sorted as $items)
            {
                echo "Time and Date of Tweet: ".$items['created_at']."<br />";
                echo "Tweet: ". $items['text']."<br />";
                echo "Tweeted by: ". $items['user']['name']."<br />";
                echo "Screen name: ". $items['user']['screen_name']."<br />";
                echo "Followers: ". $items['user']['followers_count']."<br />";
                echo "Friends: ". $items['user']['friends_count']."<br />";
                echo "Listed: ". $items['user']['listed_count']."<br />";
                echo "Retweet Count: ".$items['retweet_count']."<br/><hr/>";
            }

        }
        ?>
        <div class="row">
            <div class="col-12">
                <section class="box">
                    <form name="invent" method="post" action="#">
                        <div class="row gtr-uniform gtr-50">
                            <div class="col-12">
                                <input type="text" name="name" id="name" value="" placeholder="Pleas Enter User Handle" required="" />
                            </div>
                            <div class="col-12">
                                <input type="text" name="count" id="count" value="" placeholder="Pleas Enter Number of Tweet to be Searched" required="" />
                            </div>
                            <div class="col-12">
                                <ul class="actions">
                                    <li><input type="submit" name="btn" id="btn" value="Search"></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </section>

            </div>
        </div>


    </section>
</div>
</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.dropotron.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Guest Book</title>

    <style type="text/css">

        ::selection { background-color: #E13300; color: white; }
        ::-moz-selection { background-color: #E13300; color: white; }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }
    </style>
</head>
<body>

<div id="container">
    <h1>GUEST BOOK</h1>

    <div id="body">
        <h3>--- Silakan Input ---</h3>
        <form action="post.php" method="post">
            <strong>Nama:</strong><br/> <input type="text" name="name" /><br/>
            <strong>Email:</strong><br/> <input type="text" name="email" /><br/>
            <strong>Pesan:</strong><br/> <textarea name="message" rows="5" cols="25"></textarea><br/>
            <input type="submit" value="Kirim Pesan" name="kirim">
        </form>

        <h3>List Guest Book :</h3>



        <?php
        include_once("classes/config.php");
        //require_once 'config.php';

        function timeAgo($time_ago){
            $cur_time 	= time();
            $time_elapsed 	= $cur_time - $time_ago;
            $seconds 	= $time_elapsed ;
            $minutes 	= round($time_elapsed / 60 );
            $hours 		= round($time_elapsed / 3600);
            $days 		= round($time_elapsed / 86400 );
            $weeks 		= round($time_elapsed / 604800);
            $months 	= round($time_elapsed / 2600640 );
            $years 		= round($time_elapsed / 31207680 );
// Seconds
            if($seconds <= 60){
                echo "$seconds seconds ago";
            }
//Minutes
            else if($minutes <=60){
                if($minutes==1){
                    echo "one minute ago";
                }
                else{
                    echo "$minutes minutes ago";
                }
            }
//Hours
            else if($hours <=24){
                if($hours==1){
                    echo "an hour ago";
                }else{
                    echo "$hours hours ago";
                }
            }
//Days
            else if($days <= 7){
                if($days==1){
                    echo "yesterday";
                }else{
                    echo "$days days ago";
                }
            }
//Weeks
            else if($weeks <= 4.3){
                if($weeks==1){
                    echo "a week ago";
                }else{
                    echo "$weeks weeks ago";
                }
            }
//Months
            else if($months <=12){
                if($months==1){
                    echo "a month ago";
                }else{
                    echo "$months months ago";
                }
            }
//Years
            else{
                if($years==1){
                    echo "one year ago";
                }else{
                    echo "$years years ago";
                }
            }
        }



        $allPostsQuery = mysql_query("select * from tbl_guest order by timestamp DESC ");

        //if($result === FALSE) {
        // die(mysql_error()); // TODO: better error handling
        //}

        //while

        if(mysql_num_rows($allPostsQuery) < 1) {
            echo "No comments were found!";
        } else {
            while($comment = mysql_fetch_assoc($allPostsQuery)) {
                //$postdate=$comment['timestamp'];
                // $this->load->helper('date');
                // $time_line= timespan($postdate,$now);
                echo "<b>Nama:</b> {$comment['name']} <br/>";
                echo "<b>Email:</b> {$comment['email']} <br/>";
                echo "<b>Pesan:</b> {$comment['message']} <br/>";
                $t=$comment['timestamp'];
                $time_ago =strtotime(date('m/d/Y H:i:s', $t));
                echo "<b>Posted :</b>";
                echo timeAgo($time_ago);

                echo "<br/>";
                echo "<br/>";
            }
        }


        ?>
    </div>


</div>

</body>
</html>
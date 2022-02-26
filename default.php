<!--    <?php //$conn = mysqli_connect('localhost:3308', 'admin', 'admin', 'task_report');    //pc
        $conn = mysqli_connect('localhost', 'u225520479_zionet_task', '=R8x~aEDn~', 'u225520479_zionet_task');      //server
        mysqli_set_charset($conn, "utf8"); 
        if( postSet('task_status') && postSet('name')  && postSetEmpty('comment') ){
            $results =  queryStmt("INSERT INTO `tasks` (`name`, `status`, `comment`, `closed`) VALUES (?, ?, ?, 'open');",
            array( postSet('name'), postSet('task_status'),  postSet('comment') ) );    }    
        if( postSet('password') == "haim" ){ $result =  query("UPDATE `tasks` SET `closed` = 'closed' WHERE `tasks`.`closed` = 'open';"); } ?>  //-->

<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml"><head><meta charset="utf-8" />
    <title>Task Report - Zionet</title>
    <style>
        body{ background-color: rgb(67, 83, 134); color:rgb(12, 85, 12); }
        h1, .thanks{ color:rgb(154, 218, 154); }
        .thanks a{ color: rgba(164, 233, 201, 0.4); }
        .database_result{ color: rgb(34, 152, 207); } 
        input{ font-weight: bold; color:rgb(0, 122, 0); background-color: rgba(252, 253, 242, 0.918); text-align: center; }
        li { margin: 5px; }

        .green{ background-color:rgb(4, 160, 4); }
        .yellow{ background-color:rgb(247, 242, 0); }
        .red{ background-color:rgb(255, 55, 55); }
        .center{ text-align: center; }
        .right{ text-align: right; }
        .left{ text-align: left; }

        .globalpage, .row{width: 100%;display: block;text-align: center; }
        .main{ width: 800px; display: inline-block; text-align: left; }

        .row{width: 100%; display: block;  }
        .row95 input{ width: 94%; }
        .sizingpersent, .s50percent, .s40percent, .s25percent, .s20percent, .s10percent, .s60percent{
            display: inline-block;
            vertical-align: top;
            margin: 5px }
        .s10percent{ width: 7%; }
        .s20percent{ width: 15%; }
        .s25percent{ width: 22%; }
        .s40percent{ width: 34%; }
        .s50percent{ width: 45%; }
        .s60percent{ width: 54%; }
    </style>
    <script> if ( window.history.replaceState ) { window.history.replaceState( null, null, window.location.href ); } /*Refresh POST prevent*/ </script>
</head><body>
    <div class="center globalpage">
      <div class="main">
            <h1> Zionet - Task Report</h1>
            <div class="row">
                <div class="s40percent">
                    <form class="row" action="default.php" method="post">    
                        <p class="row">
                            <div class="row">
                                <div class="s60percent"><input class="row95" type="text" name="name" placeholder="YourName" maxlength="20" /></div>
                                <div class="s40percent"><button  class="row95 red" type="submit" name="task_status" value="moretime">✘✍</button></div>
                            </div>
                            <div class="row">
                                <div class="s60percent"><input class="row95" type="text" name="comment" placeholder="Comments" maxlength="80" /></div>
                                <div class="s40percent"><button class="row95 yellow" type="submit" name="task_status" value="develop">⌛✍</button></div>
                            </div>
                            <div class="row">
                                <button class="s40percent green" type="submit" name="task_status" value="done">√✍</button><br />
                            </div>
                        </p>
                    </form>
                </div>
                <div class="s60percent">
                    <p class="row">
                        <ul class="row left">

<?php $query = "SELECT * FROM `tasks` WHERE `tasks`.`closed` = 'open' ORDER BY `id` DESC;";
$results = query($query);
$datas=mysqli_fetch_all($results, MYSQLI_ASSOC);
mysqli_free_result($results);
foreach ($datas as $row){ $name = html($row['name']); $comment = html($row['comment']); $status = html($row['status']);
        $color=""; if($status == "develop"){$color = "yellow";} else if($status == "moretime"){$color = "red";} else if($status == "done"){$color = "green";}
        echo "<li class=\"$color\"><b>$name</b>| $comment</li>";    }   ?>

                        </ul>
                        <form class="row right" action="./default.php" method="post">
                                <input class="s20percent" type="text" name="password" placeholder="Password" maxlength="10" />
                                <input class="s20percent" type="submit" value="clean all" />
                        </form>
                    </p>          
                </div>
            </div>
            <p class="thanks"> Thanks For Usage.<br />Version (0.2.0) Develop by (Arthur) For (Haim, Zionet).  <a href="https://github.com/w3arthur/TaskReport-WebApplication/" target="_blank">GitHub</a> .<br /></p>
        </div>
      </div>  
</body></html>

<!--    <?php   
function query($query){global $conn;    //return mysqli_query
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $query)){return false;};
    return  mysqli_query($conn, $query);}
function queryStmt($query, $params, $types=''){global $conn;    //do updata/delete/insert
    if($types==''){$types = $types ?: str_repeat("s", count($params));}
    $variables=$params;
    $stmt = mysqli_stmt_init($conn);               
    if(mysqli_stmt_prepare($stmt, $query)){
        mysqli_stmt_bind_param($stmt, $types, ...$variables);
        if(!mysqli_stmt_execute($stmt)){return false;}
        if(mysqli_stmt_get_result($stmt)){return mysqli_stmt_fetch($stmt);}
        return true;}
    return false;}
function html($string){ return htmlspecialchars( $string , ENT_NOQUOTES, "UTF-8") ;} //safe from tags
function db($string){global $conn; return mysqli_real_escape_string($conn, $string);}//set correct data to mysql query
function postSet($value){if(!empty($_POST[$value] )&&postSetEmpty($value) ){return db($_POST[$value] );} return false;}        
function postSetEmpty($value){return isset($_POST[$value]);}
mysqli_close($conn);    ?>  //-->
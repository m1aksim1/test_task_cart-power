<?php
function getCountPage(){
    include 'config.php';
    $link = mysqli_connect($server, $user, $password, $database);
    if($admin_edit == 2){
        $admin_edit = null;
    }
    if($complated == 2){
        $complated = null;
    }
    $sql = "
        SELECT COUNT(*) 
        FROM `$table_name` 
        WHERE (`email` = '$email' OR '$email' = '')
        AND (`user_name` = '$username' OR '$username' = '')
        AND (`admin_edit` = '$admin_edit' OR '$admin_edit' = '')
        AND (`completed` = '$complated' OR '$complated' = '')";
    $result = mysqli_query($link,$sql);
    mysqli_close($link);
    if($result) {
        $countPage = floor(mysqli_fetch_row($result)[0] / $page_per_window);
        return $countPage;
    }
    else{
        return 0;
    }
}
function goToPage($page){
    include 'config.php';
    $countPage = getCountPage();
    if($page>$countPage){
        header("Location: index.php?page=$countPage");
    }
    else if($page<0){
        header("Location: index.php?page=0");
    }
    else{
        header("Location: index.php?page=$page");
    }
}
function createTask($email,$username,$task){
    include 'config.php';
    $link = mysqli_connect($server, $user, $password, $database);

    $sql = "INSERT INTO `$table_name` (`email`, `user_name`, `text_task`) VALUES ('$email', '$username','$task');";
    $result = mysqli_query($link,$sql);
    mysqli_close($link);
    header("Location: index.php");
}
function outputIcon($item){
    if ($item['completed']) {
        echo('
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bookmark-check" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
              <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
            </svg>');
    } else {
        echo('
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
            </svg>');
    }
    if ($item['admin_edit']) {
        echo('
            <div class="pt-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-chat-text" viewBox="0 0 16 16">
                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                    <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </div>');
    }
}

function outputTasks($thisPage){
        include 'config.php';
        if(isset($thisPage)){
            $page = $_GET['page'];
        }
        else{
            $page = 0;
        }
        $link = mysqli_connect($server, $user, $password, $database);
        $number_task = $page * $page_per_window;
        $sql = "SELECT * FROM `$table_name` LIMIT $number_task, $page_per_window";
        $result = mysqli_query($link,$sql);
        mysqli_close($link);
        foreach ($result as $item):?>
            <div class="row py-3">
                <div class="border border-dark col">
                Username: <?php echo $item['user_name'];?><br>
                Email: <?php echo $item['email']; ?><br>
                Task: <?php echo $item['text_task'];?>
                </div>
                <div class="px-2" style="width: 3%;">
                   <?php outputIcon($item);?>
                </div>
            </div>
        <?php endforeach;
}
function outputTasksSort($thisPage, $username, $email, $admin_edit, $complated){
    include 'config.php';
    if(isset($thisPage)){
        $page = $_GET['page'];
    }
    else{
        $page = 0;
    }
    if($admin_edit == 2){
        $admin_edit = null;
    }
    if($complated == 2){
        $complated = null;
    }
    $link = mysqli_connect($server, $user, $password, $database);
    $number_task = $page * $page_per_window;
    $sql = "
        SELECT * 
        FROM `$table_name` 
        WHERE (`email` = '$email' OR '$email' = '')
        AND (`user_name` = '$username' OR '$username' = '')
        AND (`admin_edit` = '$admin_edit' OR '$admin_edit' = '')
        AND (`completed` = '$complated' OR '$complated' = '')
        LIMIT  $number_task, $page_per_window";
    $result = mysqli_query($link,$sql);
    mysqli_close($link);
    foreach ($result as $item):?>
        <div class="row py-3">
            <div class="border border-dark col">
                Username: <?php echo $item['user_name'];?><br>
                Email: <?php echo $item['email']; ?><br>
                Task: <?php echo $item['text_task'];?>
            </div>
            <div class="px-2" style="width: 3%;">
                <?php outputIcon($item);?>
            </div>
        </div>
    <?php endforeach;
}
?>
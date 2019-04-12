<?php

function users_online() {
    $session = session_id();
    $time_out_in_seconds = 10;
    $time = time() + $time_out_in_seconds;
    $current_time = time();

    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $send_query = makeQuery($query);
    $count = mysqli_num_rows($send_query);

    if($count == NULL) {
        makeQuery("INSERT INTO users_online(session, time) VALUES('$session', '$time')");

    } else {
        makeQuery("UPDATE users_online SET time = '$time' WHERE session = '$session'");
    }

    $users_online_query = makeQuery("SELECT * FROM users_online WHERE time > '$current_time'");
    return $count_user = mysqli_num_rows($users_online_query);
}
<?php

    use Illuminate\Support\Facades\DB;

    if (!function_exists('get_all_users')) {
        function get_all_users()
        {
            $query = "select * from users";
            $user = DB::select($query);
            return $user;
        }
    }

?>
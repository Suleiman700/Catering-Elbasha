<?php
require_once '../../inc/db.php';
include_once '../../functions/indexes_manager.php';
$parent_dir = basename(__DIR__);
$cur_dir = explode('\\', getcwd());
$master_dir=$cur_dir[count($cur_dir)-2];

save_logs("Trying to access: ./$master_dir/$parent_dir/"); //Save logs

require constant("base_path").'pages/404.php';
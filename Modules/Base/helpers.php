<?php
if (!function_exists('makeDefaultColumn')) {
    function makeDefaultColumn(\Illuminate\Database\Schema\Blueprint $table){
        $table->string('lang',30)->default('1');
        $table->integer('admin_id')->default('1');
        $table->enum('state',[1,2])->nullable();
        $table->enum('state_main',[1,2])->nullable();
        $table->integer('order')->default(0);
    }
}
?>

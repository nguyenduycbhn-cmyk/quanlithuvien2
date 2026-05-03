<?php
//phat
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::table('borrows', function (Blueprint $table) {
        $table->date('due_date')->nullable();
        $table->integer('penalty')->default(0);
    });
}

public function down()
{
    Schema::table('borrows', function (Blueprint $table) {
        $table->dropColumn('due_date');
        $table->dropColumn('penalty');
    });
}
};

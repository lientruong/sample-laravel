<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            //$table->string('id')->primary();
            $table->increments('id');
            // your custom columns may go here

            $table->timestamps();
            $table->json('data')->nullable();
        });

/*        Schema::table('users', function(Blueprint $t) {
            $t->foreign('tenant_id', 'u_fidx1')
                ->references('id')
                ->on('tenants')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $t) {
            $t->dropIndex('u_fidx1');
        });
        Schema::dropIfExists('tenants');
    }
}

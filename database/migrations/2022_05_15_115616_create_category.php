<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

class CreateCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('name',100);
            $table->timestamps();
        //
        });
        
        Category::create(['name'=>'Hidráulica']);
        Category::create(['name'=>'Eléctrica']);
        Category::create(['name'=>'Arquitetónica']);
        Category::create(['name'=>'Detetização']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Info;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image', 20);
            $table->timestamps();
        });

        Info::create([
            "description" => "สตูดิโอถ่ายภาพชั้นนำของประเทศผู้เชี่ยวชาญด้านการถ่ายภาพ ครบวงจร ด้วยอุปกรณ์ครบครันทันสมัยพร้อมทีมงานคุณภาพที่มี ประสบการณ์ ยาวนานกว่า 20 ปี",
            "image" => "history.png"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('infos');
    }
}
